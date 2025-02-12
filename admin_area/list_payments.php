<h3 class="text-center text-success">ALL Payments</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info text-light text-center">
        <?php
        $get_payments = "SELECT * FROM `user_payments`";
        $result = mysqli_query($con, $get_payments);
        $row_count = mysqli_num_rows($result);

        if ($row_count == 0) {
            echo "<h2 class='text-danger text-center mt-5'>NO Payments Yet</h2>";
        } else {
            echo "<tr>
                <th>SL NO</th>
                <th>Invoice Number</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Order Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class='bg-dark text-light text-center'>";

            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $payment_id = $row_data['payment_id'] ?? '';
                $amount = $row_data['amount'];
                $invoice_number = $row_data['invoice_number'];
                $payment_mode = $row_data['payment_mode'];
                $date = $row_data['date'];
                $number++;

                echo "<tr>
                    <td>$number</td>
                    <td>$invoice_number</td>
                    <td>$amount</td>
                    <td>$payment_mode</td>
                    <td>$date</td>
                    <td><a href='index.php?delete_list_payment=$payment_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";
            }

            echo "</tbody>";
        }
        ?>
</table>