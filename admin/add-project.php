<?php
  session_start();
  if (empty($_SESSION)) {
    header("Location: controller/logout.php");
}

  include'controller/connection.php';
  $projectUserID = $_SESSION['id'];
  $queryCertificate = mysqli_query($connection, "SELECT * FROM portofolio_project WHERE userId='$projectUserID' ORDER BY project_sequence ASC");

  if(isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $queryDelete = mysqli_query($connection, "DELETE FROM portofolio_project WHERE id='$id'");
    header('location: project.php');
  }
  
  if(isset($_POST['add'])) {
    $projectSequence = $_POST['project_sequence'];
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $category = mysqli_real_escape_string($connection, $_POST['category']);
    $client = mysqli_real_escape_string($connection, $_POST['client']);
    $start_date = mysqli_real_escape_string($connection, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($connection, $_POST['end_date']);
    $url = mysqli_real_escape_string($connection, $_POST['url']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);

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
        $newImageName = 'projectPicture'.$id.'.'.$img_ext;
        move_uploaded_file($_FILES['picture']['tmp_name'], 'img/projectPicture/' . $newImageName);
        $queryInsert = mysqli_query($connection, "INSERT INTO portofolio_project(userId, project_sequence, title, picture, category, client, start_date, end_date, url, description) VALUES ('$projectUserID', '$projectSequence', '$title', '$newImageName', '$category', '$client', '$start_date', '$end_date', '$url', '$description')");
      };
    } else {
      $queryInsert = mysqli_query($connection, "INSERT INTO portofolio_project(userId, project_sequence, title, category, client, start_date, end_date, url, description) VALUES ('$projectUserID', '$projectSequence', '$title', '$category', '$client', '$start_date', '$end_date', '$url', '$description')");
    };

    header('location: project.php');
  }

  if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $queryEdit = mysqli_query($connection, "SELECT * FROM portofolio_project WHERE id='$id'");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
  }

  if(isset($_POST['edit'])) {
    $id = $_GET['edit'];
    $projectSequence = $_POST['project_sequence'];
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $category = mysqli_real_escape_string($connection, $_POST['category']);
    $client = mysqli_real_escape_string($connection, $_POST['client']);
    $start_date = mysqli_real_escape_string($connection, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($connection, $_POST['end_date']);
    $url = mysqli_real_escape_string($connection, $_POST['url']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);

    if(!empty($_FILES['picture']['name'])) {
      $img_name = $_FILES['picture']['name'];
      $img_size = $_FILES['picture']['size'];
  
      $ext = array('png', 'jpg', 'jpeg','jfif');
      $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
  
      if(!in_array($img_ext, $ext)){
        echo "Upload failed, picture extension does not match requirement";
        die;
      } else {
        unlink('img/projectPicture/' . $rowEdit['picture']);
        $newImageName = 'projectPicture'.$id.'.'.$img_ext;
        move_uploaded_file($_FILES['picture']['tmp_name'], 'img/projectPicture/' . $newImageName);
  
        // coding ubah/update disini
        $updateUser = mysqli_query($connection, "UPDATE portofolio_project SET project_sequence='$projectSequence', title='$title', category='$category', client='$client', start_date='$start_date', end_date='$end_date', url='$url', description='$description', picture='$newImageName' WHERE id='$id' ");
      }
      
    } else {
      // kondisi kalo user tidak ingin memasukkan gambar
      $updateUser = mysqli_query($connection, "UPDATE portofolio_project SET project_sequence='$projectSequence', title='$title', category='$category', client='$client', start_date='$start_date', end_date='$end_date', url='$url', description='$description' WHERE id='$id' ");
    }
  
    header('location: project.php?edit=success');

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

  <title>Admin | Project Editor</title>

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
          <h1 class="h3 mb-2 text-gray-800">Project Editor</h1>
          <p class="mb-4">This is the section where you can edit the 'project' section of your portfolio website.</p>

          <!-- Content Row -->
          <!-- Area Chart -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Project Section of Your Portofolio</h6>
            </div>
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="form-group col-sm-6">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                      placeholder="Insert you project title"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['title'] : '' ?>" required>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="project_sequence">Project Sequence</label>
                    <input type="text" class="form-control" id="project_sequence" name="project_sequence"
                      placeholder="Insert you project sequence"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['project_sequence'] : '' ?>" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-6">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" id="category" name="category"
                      placeholder="Insert you project category"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['category'] : '' ?>">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="client">Client</label>
                    <input type="text" class="form-control" id="client" name="client"
                      placeholder="Insert you project client"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['client'] : '' ?>">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-6">
                    <label for="start_date">Start Date</label>
                    <input type="text" class="form-control" id="start_date" name="start_date"
                      placeholder="Insert you project start date"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['start_date'] : '' ?>">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="end_date">End Date</label>
                    <input type="text" class="form-control" id="end_date" name="end_date"
                      placeholder="Insert you project end date"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['end_date'] : '' ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" id="description" name="description"
                    rows="5"><?php echo isset($_GET['edit']) ? $rowEdit['description'] : ''; ?></textarea>
                </div>
                <div class="row">
                  <div class="form-group col-sm-6">
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
                      src="img/projectPicture/<?php echo isset($_GET['edit']) ? $rowEdit['picture'] : '' ?>" alt="">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="url">URL</label>
                    <input type="url" class="form-control" id="url" name="url" placeholder="Insert you project url"
                      value="<?php echo isset($_GET['edit']) ? $rowEdit['url'] : '' ?>">
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'add' ?>"
                    type="submit">
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