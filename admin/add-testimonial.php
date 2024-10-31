<?php
    session_start();
    if (empty($_SESSION)) {
        header("Location: controller/logout.php");
    }

    include'controller/connection.php';
    $testimonialUserID = $_SESSION['id'];
    $queryTestimonial = mysqli_query($connection, "SELECT * FROM portofolio_testimonial WHERE userId='$testimonialUserID' ORDER BY id ASC ");
    
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $queryDelete = mysqli_query($connection, "DELETE FROM portofolio_testimonial WHERE id='$id'");
        header('location: testimonial.php');
    }

    if(isset($_POST['add'])) {
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $affiliation = mysqli_real_escape_string($connection, $_POST['affiliation']);
        $testimony = mysqli_real_escape_string($connection, $_POST['testimony']);

        if(!empty($_FILES['picture']['name'])) {
          $img_name = $_FILES['picture']['name'];
          $img_size = $_FILES['picture']['size'];
        
          $ext = array('png', 'jpg', 'jpeg');
          $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
        
          // JIKA EXTENSI FOTO TIDAK ADA EXT YANG TERDAFTAR DI ARRAY EXT
          if(!in_array($img_ext, $ext)) {
            echo "Upload failed, picture extension does not match requirement";
            die;
          } else {
            // pindahkan gambar dari tmp 
            $newImageName = 'testimonialPicture'.$id.'.'.$img_ext;
            move_uploaded_file($_FILES['picture']['tmp_name'], 'img/testimonialPicture/' . $newImageName);
            $queryInsert = mysqli_query($connection, "INSERT INTO portofolio_testimonial(userId, name, affiliation, testimony, picture) VALUES ('$testimonialUserID', '$name', '$affiliation', '$testimony', '$newImageName')");
          };
        } else {
          $queryInsert = mysqli_query($connection, "INSERT INTO portofolio_testimonial(userId, name, affiliation, testimony) VALUES ('$testimonialUserID', '$name', '$affiliation', '$testimony')");
        };
      header('location: testimonial.php?add=success');
    };

    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $queryEdit = mysqli_query($connection, "SELECT * FROM portofolio_testimonial WHERE id='$id'");
        $rowEdit = mysqli_fetch_assoc($queryEdit);
    }

    if(isset($_POST['edit'])) {
      $id = $_GET['edit'];
      $name = mysqli_real_escape_string($connection, $_POST['name']);
      $affiliation = mysqli_real_escape_string($connection, $_POST['affiliation']);
      $testimony = mysqli_real_escape_string($connection, $_POST['testimony']);

      if(!empty($_FILES['picture']['name'])) {
        $img_name = $_FILES['picture']['name'];
        $img_size = $_FILES['picture']['size'];
    
        $ext = array('png', 'jpg', 'jpeg');
        $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
    
        if(!in_array($img_ext, $ext)){
          echo "Upload failed, picture extension does not match requirement";
          die;
        } else {
          unlink('img/testimonialPicture/' . $rowEdit['picture']);
          $newImageName = 'testimonialPicture'.$id.'.'.$img_ext;
          move_uploaded_file($_FILES['picture']['tmp_name'], 'img/testimonialPicture/' . $newImageName);
    
          // coding ubah/update disini
          $updateUser = mysqli_query($connection, "UPDATE portofolio_testimonial SET name='$name', picture='$newImageName', affiliation='$affiliation', testimony='$testimony' WHERE id='$id' ");
        }
        
      } else {
        // kondisi kalo user tidak ingin memasukkan gambar
        $updateUser = mysqli_query($connection, "UPDATE portofolio_testimonial SET name='$name', affiliation='$affiliation', testimony='$testimony' WHERE id='$id' ");
      }
      header('location: testimonial.php?add=success');
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
          <h1 class="h3 mb-2 text-gray-800">Testimonial</h1>
          <p class="mb-4">This is the section where you can edit the 'testimonial' section of your portfolio website.
          </p>

          <!-- Content Row -->
          <!-- Area Chart -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Testimonial in Resume Section of Your Portofolio</h6>
            </div>
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3 row">
                  <div class="col-sm-6 ">
                    <label for="">Name : </label>
                    <input type="text" class="form-control" name="name" placeholder="Insert his/her name"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['name'] : '' ?>" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="">Affiliation : </label>
                    <input type="text" class="form-control" name="affiliation" placeholder="Insert his/her affiliation"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['affiliation'] : '' ?>">
                  </div>
                </div>
                <div class="mb-3">
                  <label for="">Testimonial : </label>
                  <textarea class="form-control" name="testimony"
                    placeholder="Insert his/her testimonial"><?php echo isset($_GET['edit']) ? $rowEdit['testimony'] : ''; ?></textarea>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Picture :</label>
                      <input type="file" class="form-control" id="" name="picture" value="">
                      <style>
                      .logo-website-settings-upload {
                        border-radius: 10px;
                        border: solid 1px black;
                        width: 100%;
                      }
                      </style>
                      <img class="logo-website-settings-upload mt-3"
                        src="img/testimonialPicture/<?php echo isset($_GET['edit']) ? $rowEdit['picture'] : '' ?>"
                        alt="">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'add' ?>"
                    type="submit">
                    Save
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