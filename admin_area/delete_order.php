<?php
if (isset($_GET['delete_order'])) {
    $delete_id = $_GET['delete_order'];

    
    $delete_order_query = "DELETE FROM `user_orders` WHERE `order_id` = $delete_id";
    $result_order = mysqli_query($con, $delete_order_query);

    if ($result_order) {
        echo "<script>alert('Product Deleted Successfully.')</script>";
        echo "<script>window.open('./index.php?list_orders.php','_self')</script>";
    } else {
        echo "<script>alert('Failed to delete product.')</script>";
    }
}

?>