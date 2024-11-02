<?php
if (isset($_GET['edit_brand'])) {
    $edit_brand = $_GET['edit_brand'];

    // Fetch brand data based on the brand_id
    $get_brands = "SELECT * FROM `brands` WHERE brand_id=$edit_brand";
    $result = mysqli_query($con, $get_brands);

    // Fetch the result and store the brand title
    if ($row = mysqli_fetch_assoc($result)) {
        $brand_title = $row['brand_title'];
    } else {
        echo "<script>alert('Brand not found');</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
        exit();
    }
}

if (isset($_POST['edit_brand'])) {
    $brand_title = $_POST['brand_title'];

    // Update the brand title
    $update_query = "UPDATE `brands` SET brand_title='$brand_title' WHERE brand_id=$edit_brand";
    $result_brand = mysqli_query($con, $update_query);

    if ($result_brand) {
        echo "<script>alert('Brand has been updated successfully');</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
    } else {
        echo "<script>alert('Failed to update brand');</script>";
    }
}
?>

<div class="container mt-3">
    <h1 class="text-center text-success">Edit Brands</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_title" class="form-label">Brand Title</label>
            <input type="text" name="brand_title" id="brand_title" class="form-control" required="required"
                value="<?php echo htmlspecialchars($brand_title); ?>">
        </div>
        <input type="submit" value="Update Brand" class="btn btn-info px-3 mb-3" name="edit_brand">
    </form>
</div>