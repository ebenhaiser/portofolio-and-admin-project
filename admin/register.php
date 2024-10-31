<?php
include 'controller/connection.php';
session_start();
session_destroy();

if (isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    if(empty($last_name)) {
        $first_name = ucwords(strtolower($first_name));
        $username = $first_name;

        $first_name = strtolower($first_name);
        $username_for_index = $first_name;
    } else {
        $first_name = ucwords(strtolower($first_name));
        $last_name = ucwords(strtolower($last_name));
        $username = $first_name. ' '. $last_name;

        $first_name = strtolower($first_name);
        $username_for_index = $first_name.$last_name;
    }
    $first_name = ucwords(strtolower($first_name));
    $last_name = ucwords(strtolower($last_name));
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password1 = mysqli_real_escape_string($connection, $_POST['password1']);
    $password2 = mysqli_real_escape_string($connection, $_POST['password2']);

    // Cek apakah password cocok
    if ($password1 !== $password2) {
        echo "<script>alert('Password tidak cocok');</script>";
    } else {
        // Query untuk cek apakah email sudah ada
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            // Jika email sudah ada
            echo "<script>alert('Email sudah terdaftar');</script>";
        } else {
            // Jika email belum ada, lakukan pendaftaran
            $query = "INSERT INTO users (username, email, password, username_for_index, first_name, last_name) VALUES ('$username', '$email', '$password1', '$username_for_index', '$first_name', '$last_name')";

            if (mysqli_query($connection, $query)) {
                $first_name = '';
                $last_name = '';
                $email = '';
                $password1 = '';
                $password2 = '';
                $username_for_index = '';
                $first_name = '';
                $last_name = '';

                echo "<script>alert('Pendaftaran berhasil'); window.location.href = 'login.php';</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan saat mendaftar');</script>";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="col-lg-7 mx-auto">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="first_name" id="examplefirst_name"
                                            placeholder="First Name" value="<?php echo isset($first_name) ? $first_name : '' ?>" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="last_name" id="examplelast_name"
                                            placeholder="Last Name" value="<?php echo isset($last_name) ? $last_name : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password1" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" name="password2" required>
                                    </div>
                                </div>
                                    <button name="register" class="btn btn-primary btn-user btn-block" type="submit">Register Account</button>
                                <hr>
                                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> -->
                            </form>
                            <hr>
                            <!-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div> -->
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>