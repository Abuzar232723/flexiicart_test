<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    
    $username = $_SESSION['username'] ?? '';

    if ($username) {
        $get_user = "SELECT * FROM `user_table` WHERE username='$username'";
        $result = mysqli_query($con, $get_user);

        if ($result && mysqli_num_rows($result) > 0) {
            $row_fetch = mysqli_fetch_assoc($result);
            $user_id = $row_fetch['user_id'] ?? '';
        } else {
            $user_id = '';
        }
    } else {
        $user_id = '';
    }

    //echo $user_id;
    ?>

    <h3 class="text-success">All My Orders</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr>
                <th>Sl no</th>
                <th>Amount Due</th>
                <th>Total Products</th>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Complete/Incomplete</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">

            <?php
            if ($user_id) {
                $get_order_details = "SELECT * FROM `user_orders` WHERE user_id=$user_id";
                $result_orders = mysqli_query($con, $get_order_details);
                $number = 1;

                while ($row_orders = mysqli_fetch_assoc($result_orders)) {
                    $order_id = $row_orders['order_id'];
                    $amount_due = htmlspecialchars($row_orders['amount_due'], ENT_QUOTES, 'UTF-8');
                    $total_products = htmlspecialchars($row_orders['total_products'], ENT_QUOTES, 'UTF-8');
                    $invoice_number = htmlspecialchars($row_orders['invoice_number'], ENT_QUOTES, 'UTF-8');
                    $order_date = htmlspecialchars($row_orders['order_date'], ENT_QUOTES, 'UTF-8');
                    $order_status = htmlspecialchars($row_orders['order_status'], ENT_QUOTES, 'UTF-8');

                    if ($order_status == 'pending') {
                        $order_status = 'Incomplete';
                    } else {
                        $order_status = 'Complete';
                    }

                    echo "<tr>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$total_products</td>
                    <td>$invoice_number</td>
                    <td>$order_date</td>
                    <td>$order_status</td>";

                    if ($order_status == 'Complete') {
                        echo "<td>Paid</td>";
                    } else {
                        echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td>";
                    }

                    echo "</tr>";

                    $number++;
                }
            } else {
                echo "<tr><td colspan='7'>No orders found.</td></tr>";
            }
            ?>

        </tbody>
    </table>
</body>

</html>