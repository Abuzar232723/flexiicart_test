<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center text-success mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/Admin-reg.png" alt="Admin Registration" class="img-fluid">
            </div>

            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="admin_name" name="admin_name" placeholder="Enter Your Username" required class="form-control w-50">
                    </div>

                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="admin_password" name="admin_password" placeholder="Enter Your Password" required class="form-control w-50">
                    </div>

                    <div>
                        <input type="submit" class="bg-dark text-light py-2 px-3 border-0" name="admin_Login" value="Login">
                        <p class="small fw-bold mt-2 pt-1">Don't Have You An Account? <a href="admin_registration.php" class="text-danger"> Register</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['admin_Login'])) {

    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];
    // Select query to find the admin
    $select_query = "select * from `admin_table` where admin_name ='$admin_name'";
    $result_admin = mysqli_query($con, $select_query);

    if (!$result_admin) {
        // Check for errors in the query
        die("Query failed: " . mysqli_error($con));
    }

    // echo ("<script>console.log( $result_admin);</script>");
    $row_count = mysqli_num_rows($result_admin);
    echo ("<script>console.log('row: " . $row_count . "');</script>");

    $row_data = mysqli_fetch_assoc($result_admin);
    echo ("<script>console.log('row data: " . $row_data['admin_password'] . "');</script>");
    if ($row_count > 0) {

        // Verify the password
        $_SESSION['admin_name'] = $admin_name;
        if (password_verify($admin_password, $row_data['admin_password'])) {
            $_SESSION['admin_name'] = $admin_name;
            echo "<script>alert('Login Successful');</script>";
            // Redirect or further actions can be added here
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            echo "<script>alert('Invalid Credentials from inner if.');</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials outer if');</script>";
    }
}
?>