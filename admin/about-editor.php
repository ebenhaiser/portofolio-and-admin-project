<?php
    session_start();
    include'controller/connection.php';
    if (empty($_SESSION)) {
      header("Location: controller/logout.php");
  }
    $aboutUserID = $_SESSION['id'];
    $queryAboutEditor = mysqli_query($connection, "SELECT * FROM portofolio_about WHERE userId='$aboutUserID'");
    $rowAboutEditor = mysqli_fetch_assoc($queryAboutEditor);

    if(isset($_POST['save'])) {
        $aboutName = mysqli_real_escape_string($connection, $_POST['aboutName']);
        $aboutSummary = mysqli_real_escape_string($connection, $_POST['aboutSummary']);

        if (mysqli_num_rows($queryAboutEditor) > 0) {
            // update query 
            if (!empty($_FILES['picture']['name'])) {
                $img_name = $_FILES['picture']['name'];
                $img_size = $_FILES['picture']['size'];
    
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
                    unlink('img/aboutPicture/' . $rowAboutEditor['picture']);
                    $newImageName = 'aboutPicture'.$aboutUserID.'.'.$extFoto;
                    move_uploaded_file($_FILES['picture']['tmp_name'], 'img/aboutPicture/' . $newImageName);
    
                    $update = mysqli_query($connection, "UPDATE portofolio_about SET name='$aboutName', summary='$aboutSummary', picture='$newImageName' WHERE userId ='$aboutUserID'");
                    if (!$update) {
                        echo "Error updating record: " . mysqli_error($connection);
                        die;
                    }
                };
            } else {
                $update = mysqli_query($connection, "UPDATE portofolio_about SET name='$aboutName', summary='$aboutSummary' WHERE userId ='$aboutUserID'");
            };
        } else {
            // insert query
            if (!empty($_FILES['picture']['name'])) {
                $img_name = $_FILES['picture']['name'];
                $img_size = $_FILES['picture']['size'];
    
                // png, jpg, jpeg
                $ext = array('png', 'jpg', 'jpeg');
                $extFoto = pathinfo($img_name, PATHINFO_EXTENSION);
    
                // JIKA EXTENSI FOTO TIDAK ADA EXT YANG TERDAFTAR DI ARRAY EXT
                if (!in_array($extFoto, $ext)) {
                    echo "Extension tidak ditemukan";
                    die;
                } else {
                    // pindahkan gambar dari tmp folder ke folder yang sudah kita buat
                    $newImageName = 'aboutPicture'.$aboutUserID.'.'.$extFoto;
                    move_uploaded_file($_FILES['picture']['tmp_name'], 'img/aboutPicture/' . $newImageName);
    
                    $insert = mysqli_query($connection, "INSERT INTO portofolio_about (userId, name, summary, picture) VALUES ('$aboutUserID', '$aboutName','$aboutSummary','$newImageName')");
                };
            } else {
                $insert = mysqli_query($connection, "INSERT INTO portofolio_about (userId, name, summary) VALUES ('$aboutUserID', '$aboutName','$aboutSummary')");
            };
        };
        header('location: about-editor.php?edit=success');
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
          <h1 class="h3 mb-2 text-gray-800">About Me Editor</h1>
          <p class="mb-4">This is the section where you can edit the 'about me' section of your portfolio website.</p>

          <!-- Content Row -->
          <!-- Area Chart -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">About Me Section of Your Portofolio</h6>
            </div>
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="aboutName">Name</label>
                  <input type="text" class="form-control" id="aboutName" name="aboutName"
                    value="<?php echo isset($rowAboutEditor['name']) ? $rowAboutEditor['name'] : '' ?>">
                </div>
                <div class="form-group">
                  <label for="aboutSummary">Summary</label>
                  <textarea class="form-control" id="aboutSummary" name="aboutSummary"
                    rows="5"><?php echo isset($rowAboutEditor['summary']) ? $rowAboutEditor['summary'] : ''; ?></textarea>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="banner">Picture</label>
                      <input type="file" class="form-control" id="banner" name="picture" value="">
                      <style>
                      .logo-website-settings-upload {
                        border-radius: 10px;
                        border: solid 1px black;
                        width: 100%;
                      }
                      </style>
                      <img class="logo-website-settings-upload mt-3"
                        src="img/aboutPicture/<?php echo isset($rowAboutEditor['picture']) ? $rowAboutEditor['picture'] : '' ?>"
                        alt="">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <!-- <div class="form-group">
                                            <label for="cv">Curriculum Vitae</label>
                                            <input type="file" class="form-control" id="cv" name="cv"
                                                value="<?php echo isset($rowAboutEditor['cv']) ? $rowAboutEditor['cv'] : '' ?>">
                                        </div> -->
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