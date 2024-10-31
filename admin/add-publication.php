<?php
    session_start();
    if (empty($_SESSION)) {
      header("Location: controller/logout.php");
  }

    include'controller/connection.php';
    $publicationUserID = $_SESSION['id'];
    $queryPublication = mysqli_query($connection, "SELECT * FROM portofolio_publication WHERE userId='$publicationUserID' ORDER BY publication_sequence ASC ");
    
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $queryDelete = mysqli_query($connection, "DELETE FROM portofolio_publication WHERE id='$id'");
        header('location: publication.php');
    }

    if(isset($_POST['add'])) {
        $publicationSequence = ($_POST['publicationSequence']);
        $title = $_POST['title'];
        $publisher = $_POST['publisher'];
        $time_of_publication = $_POST['time_of_publication'];
        $link = $_POST['link'];

        $queryAdd = mysqli_query($connection, "INSERT INTO portofolio_publication(userId, publication_sequence, title, publisher, time_of_publication, link) VALUES ('$publicationUserID', '$publicationSequence', '$title', '$publisher', '$time_of_publication', '$link')");

        header('location: publication.php');
    }

    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $queryEdit = mysqli_query($connection, "SELECT * FROM portofolio_publication WHERE id='$id'");
        $rowEdit = mysqli_fetch_assoc($queryEdit);
    }

    if(isset($_POST['edit'])) {
      $id = $_GET['edit'];
      $publicationSequence = $_POST['publicationSequence'];
      $title = mysqli_real_escape_string($connection, $_POST['title']);
      $publisher = mysqli_real_escape_string($connection, $_POST['publisher']);
      $time_of_publication = mysqli_real_escape_string($connection, $_POST['time_of_publication']);
      $link = mysqli_real_escape_string($connection, $_POST['link']);

      $queryEdit = mysqli_query($connection, "UPDATE portofolio_publication SET publication_sequence='$publicationSequence', title='$title', publisher='$publisher', time_of_publication='$time_of_publication', link='$link' WHERE id='$id'");
      header('location: publication.php');
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
          <h1 class="h3 mb-2 text-gray-800">Education</h1>
          <p class="mb-4">This is the section where you can edit the 'education' section of your portfolio website.</p>

          <!-- Content Row -->
          <!-- Area Chart -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Education in Resume Section of Your Portofolio</h6>
            </div>
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3 row">
                  <div class="col-sm-6 ">
                    <label for="">Publication Sequence : </label>
                    <input type="number" class="form-control" name="publicationSequence"
                      placeholder="Insert your education sequence"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['publication_sequence'] : '' ?>" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="">Time of Publication : </label>
                    <input type="text" class="form-control" name="time_of_publication"
                      placeholder="Insert your time of publication"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['time_of_publication'] : '' ?>" required>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="">Title : </label>
                  <input type="text" class="form-control" name="title" placeholder="Insert you title"
                    value="<?php echo isset($_GET['edit']) ? $rowEdit['title'] : '' ?>" required>
                </div>
                <div class="mb-3 row">
                  <div class="col-sm-6">
                    <label for="">Publisher : </label>
                    <input type="text" class="form-control" name="publisher" placeholder="Insert your publisher"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['publisher'] : '' ?>" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="">Link : </label>
                    <input type="text" class="form-control" name="link" placeholder="Insert your link"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['link'] : '' ?>">
                  </div>
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