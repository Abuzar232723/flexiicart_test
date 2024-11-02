<?php include('../includes/connect.php');
include('../functions/common_function.php');

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
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
        <h2 class="text-center text-success mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/Admin-reg.png" alt="Admin Registration" class="img-fluid">
            </div>

            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username"
                            placeholder="Enter Your Username" required="required" class="form-control w-50">
                    </div>

                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email"
                            placeholder="Enter Your Email" required="required" class="form-control w-50">
                    </div>

                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="admin_password" name="admin_password"
                            placeholder="Enter Your Password" required="required" class="form-control w-50">
                    </div>

                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_admin_password" name="conf_admin_password"
                            placeholder="Enter Your Password" required="required" class="form-control w-50">
                    </div>

                    <div>
                        <input type="submit" class="bg-dark text-light py-2 px-3 border-0"
                            name="admin_registration" value="Register">
                        <p class="small fw-bold mt-2 pt-1">Have You An Account? <a href="admin_login.php" class="text-danger"> Login</a></p>
                    </div>

                </form>
            </div>

        </div>
    </div>
</body>

</html>




<?php

if (isset($_POST['admin_registration'])) {

   
    $username = $_POST['username'];
    $email = $_POST['email'];
    $admin_password = $_POST['admin_password'];
    $conf_admin_password = $_POST['conf_admin_password'];

    // Hashing the password
    $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);

    // Check if username or email already exists
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$username' OR admin_email='$email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        echo "<script>alert('Admin-name or Email Already Exists.')</script>";
    } else if ($admin_password != $conf_admin_password) {
        echo "<script>alert('Passwords Do Not Match.')</script>";
    } else {
        // Insert the new admin record
        $insert_query = "insert into `admin_table` (admin_name, admin_email, admin_password) values ('$username', '$email', '$hash_password')";
        $result_admin = mysqli_query($con, $insert_query);

        if ($result_admin) {
            echo "<script>alert('Registration Successful.')</script>";
        } else {
            echo "<script>alert('Registration Failed. Please try again.')</script>";
            echo "Error: " . mysqli_error($con); // Add this line to see the error
        }
    }
}
?>