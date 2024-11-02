<?php

if(isset($_GET['delete_category'])){

    $delete_category=$_GET['delete_category'];
    //echo $delete_category;

    $delete_query="Delete from `categories` where category_id=$delete_category";
    $resilt_query=mysqli_query($con, $delete_query);
    if($resilt_query){
        echo "<script>alert('Category is been deleted successfully')</script>";
        echo "<script>window.open('./index.php?view_category.php','_self')</script>";
    }

}




?>