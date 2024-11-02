<?php
if (isset($_GET['delete_list_payment'])) {
    // ইনপুট নিরাপত্তার জন্য intval ব্যবহার করা হয়েছে
    $delete_id = intval($_GET['delete_list_payment']);

    // SQL কুয়েরি প্রস্তুত করা হয়েছে
    $delete_list_payment = "DELETE FROM `user_payments` WHERE `payment_id` = $delete_id";
    $result_payment = mysqli_query($con, $delete_list_payment);

    if ($result_payment) {
        echo "<script>alert('Payment Deleted Successfully.')</script>";
        echo "<script>window.open('index.php?list_payments','_self')</script>";
    } else {
        echo "<script>alert('Failed to delete Payment.')</script>";
    }
}
?>