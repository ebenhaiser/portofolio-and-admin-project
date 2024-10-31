<?php
    session_start();
    if (empty($_SESSION)) {
      header("Location: controller/logout.php");
  }

    include'controller/connection.php';
    $skillsUserID = $_SESSION['id'];
    $querySkills = mysqli_query($connection, "SELECT * FROM portofolio_message WHERE userId='$skillsUserID' ORDER BY status_id ASC, sent_date DESC");
    
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $queryDelete = mysqli_query($connection, "DELETE FROM portofolio_message WHERE id='$id'");
        header('location: message.php');
    }

    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $queryEdit = mysqli_query($connection, "SELECT * FROM portofolio_message WHERE id='$id'");
        $rowEdit = mysqli_fetch_assoc($queryEdit);
    }

    if(isset($_POST['edit'])) {
        $id = $_GET['edit'];
        $status_id = $_POST['status_id'];

        $queryEdit = mysqli_query($connection, "UPDATE portofolio_message SET status_id='$status_id' WHERE id='$id'");
        header('location: message.php');
    }

    $queryStatus = mysqli_query($connection, "SELECT * FROM portofolio_message_read_status");
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
          <h1 class="h3 mb-2 text-gray-800">Message</h1>
          <p class="mb-4">This is the section where you can read the 'message' section of your portfolio website.</p>

          <!-- Content Row -->
          <!-- Area Chart -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Message you receive in Your Portofolio</h6>
            </div>
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3 row">

                  <div class="col-sm-6">
                    <label for="">Status : </label>
                    <select name="status_id" class="form-control" id="">
                      <?php while($rowStatus = mysqli_fetch_assoc($queryStatus)): ?>
                      <option
                        <?php echo isset($_GET['edit']) ? ($rowStatus['id'] == $rowEdit['status_id'] ? 'selected' : '') : '' ?>
                        value="<?php echo $rowStatus['id'] ?>">
                        <?php echo $rowStatus['status_name'] ?></option>
                      <?php endwhile ?>
                    </select>
                  </div>
                </div>
                <div class="mb-3 row">
                  <div class="col-sm-6">
                    <label for="">Name : </label>
                    <input type="text" class="form-control" name="name"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['name'] : '' ?>" readonly>
                  </div>
                  <div class="col-sm-6">
                    <label for="">Email : </label>
                    <input type="text" class="form-control" name="email"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['email'] : '' ?>" readonly>
                  </div>
                </div>
                <div class="mb-3 row">
                  <div class="col-sm-6">
                    <label for="">Phone : </label>
                    <input type="text" class="form-control" name="phone"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['phone'] : '' ?>" readonly>
                  </div>
                  <div class="col-sm-6">
                    <label for="">Time : </label>
                    <input type="text" class="form-control" name="sent_date"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['sent_date'] : '' ?>" readonly>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="">Message : </label>
                  <textarea class="form-control" name="message" readonly><?php echo isset($_GET['edit']) ? $rowEdit['message'] : ''; ?>
                    </textarea>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary" name="edit" type="submit">
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