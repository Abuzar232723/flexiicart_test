<?php
if (isset($_GET['delete_list_user'])) {
    
    $delete_id = intval($_GET['delete_list_user']);

    
    $delete_list_user = "DELETE FROM `user_table` WHERE `user_id` = $delete_id";
    $result_payment = mysqli_query($con, $delete_list_user);

    if ($result_payment) {
        echo "<script>alert('User Deleted Successfully.')</script>";
        echo "<script>window.open('index.php?list_users','_self')</script>";
    } else {
        echo "<script>alert('Failed to delete User.')</script>";
    }
}
