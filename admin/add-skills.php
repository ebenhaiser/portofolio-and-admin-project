<?php
    session_start();
    if (empty($_SESSION)) {
      header("Location: controller/logout.php");
  }

    include'controller/connection.php';
    $skillsUserID = $_SESSION['id'];
    $querySkills = mysqli_query($connection, "SELECT * FROM portofolio_skills WHERE userId='$skillsUserID' ORDER BY category_id ASC ");
    
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $queryDelete = mysqli_query($connection, "DELETE FROM portofolio_skills WHERE id='$id'");
        header('location: skills.php');
    }

    if(isset($_POST['add'])) {
      $skill_name = mysqli_real_escape_string($connection, $_POST['skill_name']);
      $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);

      $queryAdd = mysqli_query($connection, "INSERT INTO portofolio_skills(userId, category_id, skill_name) VALUES ('$skillsUserID', '$category_id', '$skill_name')");

      header('location: skills.php');
    }

    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $queryEdit = mysqli_query($connection, "SELECT * FROM portofolio_skills WHERE id='$id'");
        $rowEdit = mysqli_fetch_assoc($queryEdit);
    }

    if(isset($_POST['edit'])) {
        $id = $_GET['edit'];
        $skill_name = mysqli_real_escape_string($connection, $_POST['skill_name']);
        $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);

        $queryEdit = mysqli_query($connection, "UPDATE portofolio_skills SET skill_name='$skill_name', category_id='$category_id' WHERE id='$id'");
        header('location: skills.php');
    }

    $queryCategory = mysqli_query($connection, "SELECT * FROM portofolio_skills_category");
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
          <h1 class="h3 mb-2 text-gray-800">Skills</h1>
          <p class="mb-4">This is the section where you can edit the 'skills' section of your portfolio website.</p>

          <!-- Content Row -->
          <!-- Area Chart -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Skills in Resume Section of Your Portofolio</h6>
            </div>
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3 row">
                  <div class="col-sm-6">
                    <label for="">Skill Name : </label>
                    <input type="text" class="form-control" name="skill_name" placeholder="Insert you skill name"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['skill_name'] : '' ?>" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="">Category : </label>
                    <select name="category_id" class="form-control" id="">
                      <option value="">Choose Category</option>
                      <?php while($rowCategory = mysqli_fetch_assoc($queryCategory)): ?>
                      <option
                        <?php echo isset($_GET['edit']) ? ($rowCategory['id'] == $rowEdit['category_id'] ? 'selected' : '') : '' ?>
                        value="<?php echo $rowCategory['id'] ?>">
                        <?php echo $rowCategory['category_name'] ?></option>
                      <?php endwhile ?>
                    </select>
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