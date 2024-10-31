<?php
    session_start();
    include'controller/connection.php';
    if (empty($_SESSION)) {
      header("Location: controller/logout.php");
  }
    $profileUserID = $_SESSION['id'];
    $queryProfile = mysqli_query($connection, "SELECT * FROM users WHERE id='$profileUserID'");
    $rowProfile = mysqli_fetch_assoc($queryProfile);

    if(isset($_POST['save'])) {
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

        if (mysqli_num_rows($queryProfile) > 0) {
            // update query 
            if (!empty($_FILES['profilePicture']['name'])) {
                $img_name = $_FILES['profilePicture']['name'];
                $img_size = $_FILES['profilePicture']['size'];
    
                // png, jpg, jpeg
                $ext = array('png', 'jpg', 'jpeg');
                $extFoto = pathinfo($img_name, PATHINFO_EXTENSION);
    
                // JIKA EXTENSI FOTO TIDAK ADA EXT YANG TERDAFTAR DI ARRAY EXT
                if (!in_array($extFoto, $ext)) {
                    echo "Extension tidak ditemukan";
                    die;
                } else {
                    // pindahkan gambar dari tmp folder ke folder yang sudah kita buat
                    // unlink() : me-delete file
                    unlink('img/profilePicture/' . $rowProfile['profilePicture']);
                    $newImageName = 'profilePicture'.$profileUserID.'.'.$extFoto;
                    move_uploaded_file($_FILES['profilePicture']['tmp_name'], 'img/profilePicture/' . $newImageName);
    
                    $update = mysqli_query($connection, "UPDATE users SET username='$username', email='$email', profilePicture='$newImageName', username_for_index='$username_for_index', first_name='$first_name', last_name='$last_name' WHERE id ='$profileUserID'");
                    if (!$update) {
                        echo "Error updating record: " . mysqli_error($connection);
                        die;
                    }
                };
            } else {
                $update = mysqli_query($connection, "UPDATE users SET username='$username', email='$email', username_for_index='$username_for_index', first_name='$first_name', last_name='$last_name' WHERE id ='$profileUserID'");
            };
        } else {
            // insert query
            if (!empty($_FILES['profilePicture']['name'])) {
                $img_name = $_FILES['profilePicture']['name'];
                $img_size = $_FILES['profilePicture']['size'];
    
                // png, jpg, jpeg
                $ext = array('png', 'jpg', 'jpeg');
                $extFoto = pathinfo($img_name, PATHINFO_EXTENSION);
    
                // JIKA EXTENSI FOTO TIDAK ADA EXT YANG TERDAFTAR DI ARRAY EXT
                if (!in_array($extFoto, $ext)) {
                    echo "Extension tidak ditemukan";
                    die;
                } else {
                    // pindahkan gambar dari tmp folder ke folder yang sudah kita buat
                    $newImageName = 'profilePicture'.$profileUserID.'.'.$extFoto;
                    move_uploaded_file($_FILES['profilePicture']['tmp_name'], 'img/profilePicture/' . $newImageName);
    
                    $insert = mysqli_query($connection, "INSERT INTO users (id, username, email, profilePicture, username_for_index, first_name, last_name) VALUES ('$profileUserID','$username','$email','$newImageName', '$username_for_index', '$first_name', '$last_name')");
                };
            } else {
              $insert = mysqli_query($connection, "INSERT INTO users (id, username, email, username_for_index, first_name, last_name) VALUES ('$profileUserID','$username','$email', '$username_for_index', '$first_name', '$last_name')");
            };
        };
        header('location: profile-editor.php?edit=success');
    };
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin | Home Editor</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include'inc/sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include'inc/topbar.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Profile Editor</h1>
          <p class="mb-4">This is the section where you can edit the 'profile' section of your portfolio website.</p>

          <!-- Content Row -->
          <!-- Area Chart -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit your account profile</h6>
            </div>
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label for="">First Name: </label>
                    <input type="text" class="form-control" id="" name="first_name" placeholder="Enter your name"
                      value="<?php echo isset($rowProfile['first_name']) ? $rowProfile['first_name'] : '' ?>">
                  </div>
                  <div class="col-sm-6 form-group">
                    <label for="">Last Name: </label>
                    <input type="text" class="form-control" id="" name="last_name" placeholder="Enter your name"
                      value="<?php echo isset($rowProfile['last_name']) ? $rowProfile['last_name'] : '' ?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label for="">Email: </label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email"
                      value="<?php echo isset($rowProfile['email']) ? $rowProfile['email'] : '' ?>">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="">Profile Picture: </label>
                    <input type="file" class="form-control" id="profilePicture" name="profilePicture" value="">
                    <style>
                    .logo-website-settings-upload {
                      border-radius: 10px;
                      border: solid 1px black;
                      width: 100%;
                    }
                    </style>
                    <img class="logo-website-settings-upload mt-3"
                      src="img/profilePicture/<?php echo !empty($rowProfile['profilePicture']) ? $rowProfile['profilePicture'] : 'default.jpg' ?>"
                      alt="">
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary" name="save" type="submit">
                    Simpan
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="js/demo/chart-bar-demo.js"></script>

</body>

</html>