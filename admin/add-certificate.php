<?php
    session_start();
    if (empty($_SESSION)) {
      header("Location: controller/logout.php");
  }

    include'controller/connection.php';
    $certificateUserID = $_SESSION['id'];
    $queryCertificate = mysqli_query($connection, "SELECT * FROM portofolio_certificate WHERE userId='$certificateUserID' ORDER BY certificate_sequence ASC ");
    
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $queryDelete = mysqli_query($connection, "DELETE FROM portofolio_certificate WHERE id='$id'");
        header('location: certificate.php');
    }

    if(isset($_POST['add'])) {
        $certificateSequence = $_POST['certificate_sequence'];
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $credential = mysqli_real_escape_string($connection, $_POST['credential']);
        $issue_date = mysqli_real_escape_string($connection, $_POST['issue_date']);
        $exp_date = mysqli_real_escape_string($connection, $_POST['exp_date']);

        $queryAdd = mysqli_query($connection, "INSERT INTO portofolio_certificate(userId, certificate_sequence, name, credential, issue_date, exp_date) VALUES ('$certificateUserID', '$certificateSequence', '$name', '$credential', '$issue_date', '$exp_date')");

        header('location: certificate.php');
    }

    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $queryEdit = mysqli_query($connection, "SELECT * FROM portofolio_certificate WHERE id='$id'");
        $rowEdit = mysqli_fetch_assoc($queryEdit);
    }

    if(isset($_POST['edit'])) {
        $id = $_GET['edit'];
        $certificateSequence = $_POST['certificate_sequence'];
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $credential = mysqli_real_escape_string($connection, $_POST['credential']);
        $issue_date = mysqli_real_escape_string($connection, $_POST['issue_date']);
        $exp_date = mysqli_real_escape_string($connection, $_POST['exp_date']);

        $queryEdit = mysqli_query($connection, "UPDATE portofolio_certificate SET certificate_sequence='$certificateSequence', name='$name', credential='$credential', issue_date='$issue_date', exp_date='$exp_date' WHERE id='$id'");
        header('location: certificate.php');
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

  <title>Admin | Certificate Editor</title>

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
          <h1 class="h3 mb-2 text-gray-800">Certificate</h1>
          <p class="mb-4">This is the section where you can edit the 'certificate' section of your portfolio website.
          </p>

          <!-- Content Row -->
          <!-- Area Chart -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Certificate in Resume Section of Your Portofolio</h6>
            </div>
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="">Certificate Name : </label>
                  <input type="text" class="form-control" name="name" placeholder="Insert you certificate name"
                    value="<?php echo isset($_GET['edit']) ? $rowEdit['name'] : '' ?>" required>
                </div>
                <div class="mb-3 row">
                  <div class="col-sm-6 ">
                    <label for="">Certificate Sequence : </label>
                    <input type="number" class="form-control" name="certificate_sequence"
                      placeholder="Insert your certificate sequence"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['certificate_sequence'] : '' ?>" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="">Credential : </label>
                    <input type="text" class="form-control" name="credential"
                      placeholder="Insert your certificate credential"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['credential'] : '' ?>">
                  </div>
                </div>
                <div class="mb-3 row">
                  <div class="col-sm-6">
                    <label for="">Issue Date : </label>
                    <input type="text" class="form-control" name="issue_date" placeholder="Insert your start year"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['issue_date'] : '' ?>" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="">Expired Date : </label>
                    <input type="text" class="form-control" name="exp_date" placeholder="Insert your end year"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['exp_date'] : '' ?>">
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