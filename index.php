<?php
    include'admin/controller/connection.php';
    session_start();

    if (isset($_GET['user'])) {
      $username = $_GET['user'];
      $queryUsername = mysqli_query($connection, "SELECT * FROM users WHERE username_for_index='$username' ");
      $rowUsername = mysqli_fetch_assoc($queryUsername);
      if(mysqli_num_rows($queryUsername) > 0) {
        $userID = $rowUsername['id'];
      } else {
        $username = 'ebenhaiser';
        header("location: index.php?user=$username");
      }
      
    } elseif(isset($_GET['id'])) {
      $usernameId = $_GET['id'];
      $queryUserId = mysqli_query($connection, "SELECT * FROM users WHERE id='$usernameId' ");

      if(mysqli_num_rows($queryUserId) > 0) {
        $rowUserid = mysqli_fetch_assoc($queryUserId);
        $username = $rowUserid['username_for_index'];
        header("location: index.php?user=$username");
      } else {
        $username = 'ebenhaiser';
        header("location: index.php?user=$username");
      }

    } else {
      $username = 'ebenhaiser';
      header("location: index.php?user=$username");
    }

    // HERO SECTION
    $queryHero = mysqli_query($connection, "SELECT * FROM portofolio_hero WHERE userId='$userID'");
    $rowHero = mysqli_fetch_assoc($queryHero);

    // ABOUT SECTION
    $queryAbout = mysqli_query($connection, "SELECT * FROM portofolio_about WHERE userId='$userID'");
    $rowAbout = mysqli_fetch_assoc($queryAbout);

    // RESUME | EDUCATION
    $queryEducation = mysqli_query($connection, "SELECT * FROM portofolio_education WHERE userId='$userID' ORDER BY education_sequence ASC");

    // RESUME | WORK EXPERIENCE
    $queryWorkExperience =  mysqli_query($connection, "SELECT * FROM portofolio_work_experience WHERE userId='$userID' ORDER BY work_sequence ASC");

    // RESUME | PUBLICATION
    $queryPublication =  mysqli_query($connection, "SELECT * FROM portofolio_publication WHERE userId='$userID' ORDER BY publication_sequence ASC");
    
    // RESUME | CERTIFICATE
    $queryCertificate =  mysqli_query($connection, "SELECT * FROM portofolio_certificate WHERE userId='$userID' ORDER BY certificate_sequence ASC");

    // PROJECT
    $queryProject =  mysqli_query($connection, "SELECT * FROM portofolio_project WHERE userId='$userID' ORDER BY project_sequence DESC");
    $queryProjectModal =  mysqli_query($connection, "SELECT * FROM portofolio_project WHERE userId='$userID' ORDER BY project_sequence DESC");

    // TESTIMONIAL
    $queryTestimonial = mysqli_query($connection, "SELECT * FROM portofolio_testimonial WHERE userId='$userID' ORDER BY id DESC");

    // SKILLS
    $querySkills = mysqli_query($connection, "SELECT * FROM portofolio_skills WHERE userId='$userID' ORDER BY id DESC");
    $queryHardSkills = mysqli_query($connection, "SELECT * FROM portofolio_skills WHERE userId='$userID' AND category_id=1 ORDER BY id DESC");
    $querySoftSkills = mysqli_query($connection, "SELECT * FROM portofolio_skills WHERE userId='$userID' AND category_id=2 ORDER BY id DESC");


    
?>
<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Site Metas -->
<title><?php echo isset($rowHero['title']) ? $rowHero['title'] : '' ?></title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="admin/img/profilePicture/default.jpg" type="image/x-icon" />
<link rel="apple-touch-icon" href="admin/img/profilePicture/default.jpg">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Site CSS -->
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="css/skills.css">
<!-- Responsive CSS -->
<link rel="stylesheet" href="css/responsive.css">
<!-- Custom CSS -->
<link rel="stylesheet" href="css/custom.css">
<link rel="stylesheet" href="css/modal.css">
<script src="js/modernizr.js"></script> <!-- Modernizr -->

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="politics_version">

  <!-- LOADER -->
  <div id="preloader">
    <div id="main-ld">
      <div id="loader"></div>
    </div>
  </div><!-- end loader -->
  <!-- END LOADER -->

  <!-- Navigation -->
  <?php include 'inc/navbar.php' ?>

  <section id="hero" class="main-banner parallaxie"
    style="background: url('admin/img/heroBanner/<?php echo isset($rowHero['banner']) ? $rowHero['banner'] : 'default.jpg' ?>')">
    <div class="heading">
      <h1>hello, i'm<br><?php echo isset($rowHero['title']) ? $rowHero['title'] : '' ?></h1>
      <!-- <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p> -->
      <h3 class="cd-headline clip is-full-width">
        <span><?php echo isset($rowHero['subtitle']) ? $rowHero['subtitle'] : '' ?></span>
      </h3>
    </div>
  </section>

  <svg id="clouds" class="hidden-xs" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100"
    viewBox="0 0 85 100" preserveAspectRatio="none">
    <path d="M-5 100 Q 0 20 5 100 Z
            M0 100 Q 5 0 10 100
            M5 100 Q 10 30 15 100
            M10 100 Q 15 10 20 100
            M15 100 Q 20 30 25 100
            M20 100 Q 25 -10 30 100
            M25 100 Q 30 10 35 100
            M30 100 Q 35 30 40 100
            M35 100 Q 40 10 45 100
            M40 100 Q 45 50 50 100
            M45 100 Q 50 20 55 100
            M50 100 Q 55 40 60 100
            M55 100 Q 60 60 65 100
            M60 100 Q 65 50 70 100
            M65 100 Q 70 20 75 100
            M70 100 Q 75 45 80 100
            M75 100 Q 80 30 85 100
            M80 100 Q 85 20 90 100
            M85 100 Q 90 50 95 100
            M90 100 Q 95 25 100 100
            M95 100 Q 100 15 105 100 Z">
    </path>
  </svg>

  <!-- ABOUT SECTION -->
  <?php if(mysqli_num_rows($queryAbout) > 0) : ?>
  <div id="about" class="section wb">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="message-box">
            <h2>About <?php echo isset($rowAbout['name']) ? $rowAbout['name'] : 'Me' ?></h2>
            <p> <?php echo isset($rowAbout['summary']) ? $rowAbout['summary'] : 'Just find me on linkedIn' ?> </p>

            <?php if(!empty($rowAbout['cv'])) : ?>
            <a href="admin/cv_directory/<?php echo $rowAbout['cv'] ?>" class="sim-btn btn-hover-new"
              data-text="Download CV"><span>Download CV</span></a>
            <?php endif ?>
          </div><!-- end messagebox -->
        </div><!-- end col -->

        <div class="col-md-6">
          <?php if(!empty($rowAbout['picture'])) : ?>
          <div class="right-box-pro wow fadeIn">
            <img width="100%"
              src="admin/img/aboutPicture/<?php echo isset($rowAbout['picture']) ? $rowAbout['picture'] : 'default.jpg' ?>"
              alt="Profil Picture" class="img-fluid img-rounded">
          </div><!-- end media -->
          <?php endif ?>
        </div><!-- end col -->
      </div><!-- end row -->
    </div><!-- end container -->
  </div>
  <?php endif ?>
  <!-- end section -->

  <!-- RESUME SECTION -->
  <?php if (
          mysqli_num_rows($queryEducation) > 0 ||
          mysqli_num_rows($queryWorkExperience) > 0 ||
          mysqli_num_rows($queryPublication) > 0 ||
          mysqli_num_rows($queryCertificate) > 0
        ) :
  ?>
  <div id="resume" class="section lb">
    <div class="container">
      <div class="section-title text-left">
        <h3>Resume</h3>
        <!-- <p>Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non aliquam risus.</p> -->
      </div><!-- end title -->

      <style>
      ul.timeline {
        list-style-type: none;
        position: relative;
      }

      ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
      }

      ul.timeline>li {
        margin: 10px 0;
        padding-left: 20px;
        margin-left: 30px;
      }

      ul.timeline>li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid black;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
      }

      #resume h4 {
        font-weight: 700;
        font-size: 20px;
      }

      #resume h5 {
        font-size: 17px;
      }
      </style>
      <div class="container mt-5 mb-5">
        <div class="row">
          <?php if(mysqli_num_rows($queryEducation) > 0) : ?>
          <div class="col-sm-6 mb-4 mx-auto">
            <h4>Education</h4>
            <?php while($rowEducation = mysqli_fetch_assoc($queryEducation)) : ?>
            <ul class="timeline">
              <li>
                <h5><?php echo isset($rowEducation['major']) ? $rowEducation['major'] : '' ?></h5>
                <h6><?php echo isset($rowEducation['start_year']) ? $rowEducation['start_year'] : '' ?>
                  <?php echo isset($rowEducation['end_year']) ? '- ' . $rowEducation['end_year'] : ''; ?></h6>
                <p><i><?php echo isset($rowEducation['school']) ? $rowEducation['school'] : '' ?></i></p>
                <p><?php echo isset($rowEducation['summary']) ? $rowEducation['summary'] : '' ?></p>
              </li>
            </ul>
            <?php endwhile ?>
          </div>
          <?php endif ?>

          <?php if(mysqli_num_rows($queryWorkExperience) > 0) : ?>
          <div class="col-sm-6 mb-4 mx-auto">
            <h4>Work Experience</h4>
            <?php while($rowWorkExperience = mysqli_fetch_assoc($queryWorkExperience)) : ?>
            <ul class="timeline">
              <li>
                <h5><?php echo isset($rowWorkExperience['position']) ? $rowWorkExperience['position'] : '' ?></h5>
                <h6><?php echo isset($rowWorkExperience['start_year']) ? $rowWorkExperience['start_year'] : '' ?>
                  <?php echo isset($rowWorkExperience['end_year']) ? '- ' . $rowWorkExperience['end_year'] : ''; ?></h6>
                <p>
                  <i><?php echo isset($rowWorkExperience['company_name']) ? $rowWorkExperience['company_name'] : '' ?></i>
                </p>
                <p><?php echo isset($rowWorkExperience['summary']) ? $rowWorkExperience['summary'] : '' ?></p>
              </li>
            </ul>
            <?php endwhile ?>
          </div>
          <?php endif ?>

          <?php if(mysqli_num_rows($queryPublication) > 0) : ?>
          <div class="col-sm-6 mb-4 mx-auto">
            <h4>Publication</h4>
            <ul class="timeline">
              <?php while($rowPublication = mysqli_fetch_assoc($queryPublication)) : ?>
              <li>
                <h5><?php echo isset($rowPublication['title']) ? $rowPublication['title'] : '' ?></h5>
                <h6>
                  <?php echo isset($rowPublication['time_of_publication']) ? $rowPublication['time_of_publication'] : '' ?>
                </h6>
                <p><?php echo isset($rowPublication['publisher']) ? $rowPublication['publisher'] : '' ?></p>
                <a
                  href="<?php echo isset($rowPublication['link']) ? $rowPublication['link'] : '' ?>"><?php echo isset($rowPublication['link']) ? $rowPublication['link'] : '' ?></a>
              </li>
              <?php endwhile ?>
            </ul>
          </div>
          <?php endif ?>

          <?php if(mysqli_num_rows($queryCertificate) > 0 ) : ?>
          <div class="col-sm-6 mb-3 mx-auto">
            <h4>Certificate</h4>
            <ul class="timeline">
              <?php while($rowCertificate = mysqli_fetch_assoc($queryCertificate)) : ?>
              <li>
                <h5><?php echo isset($rowCertificate['name']) ? $rowCertificate['name'] : '' ?></h5>
                <h6><?php echo isset($rowCertificate['issue_date']) ? $rowCertificate['issue_date'] : '' ?>
                  <?php echo isset($rowCertificate['exp_date']) ? '- ' . $rowCertificate['exp_date'] : ''; ?></h6>
                <p><?php echo isset($rowCertificate['credential']) ? $rowCertificate['credential'] : '' ?></p>
              </li>
              <?php endwhile ?>
            </ul>
          </div>
          <?php endif ?>

        </div>
      </div>
    </div><!-- end container -->
  </div>
  <?php endif ?>
  <!-- end resume section -->

  <style>
  .skills .skills-title {
    font-size: 500px;
    font-weight: bold;
    margin-bottom: 20px;
  }
  </style>
  <!-- SKILLS SECTION -->
  <?php if(mysqli_num_rows($querySkills) > 0) : ?>
  <div id="skills" class="section lb">
    <div class="container">
      <div class="section-title text-left">
        <h3>Skills</h3>
        <p>Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non aliquam risus.</p>
      </div><!-- end title -->

      <div data-aos="fade-up">
        <div class="skills-title text-center mb-4">
          Hard Skills
        </div>
        <div class="skillBox">
          <div class="container">
            <?php while($rowHardSkills = mysqli_fetch_assoc($queryHardSkills)) : ?>
            <h3><?php echo isset($rowHardSkills['skill_name']) ? $rowHardSkills['skill_name'] : '' ?></h3>
            <?php endwhile ?>
          </div>
        </div>
      </div>

      <br>
      <br>
      <br>
      <br>

      <div data-aos="fade-up">
        <div class="skills-title text-center mb-4">Soft Skills</div>
        <div class="skillBox">
          <div class="container">
            <?php while($rowSoftSkills = mysqli_fetch_assoc($querySoftSkills)) : ?>
            <h3><?php echo isset($rowSoftSkills['skill_name']) ? $rowSoftSkills['skill_name'] : '' ?></h3>
            <?php endwhile ?>
          </div>
        </div>
      </div>


    </div>
  </div>
  <?php endif ?>
  <!-- end skills section -->

  <!-- portofolio section -->
  <?php if(mysqli_num_rows($queryProject) > 0) : ?>
  <div id="project" class="section lb">
    <div class="container">
      <div class="section-title text-left">
        <h3>Project</h3>
        <!-- <p>Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non aliquam risus.</p> -->
      </div><!-- end title -->

      <style>
      #portfolio .card-header {
        color: black;
        font-weight: 500;
        font-size: 1rem;
      }

      .card-photo {
        border-radius: 10px;
      }
      </style>

      <div class="row">
        <?php while($rowProject = mysqli_fetch_assoc($queryProject)) : ?>
        <div class="col-sm-4 mb-5">
          <div class="card">
            <div align="center" class="card-header">
              <?php echo isset($rowProject['title']) ? $rowProject['title'] : '' ?>
            </div>
            <div class="card-body">
              <img class="card-picture" width="100%"
                src="admin/img/projectPicture/<?php echo isset($rowProject['picture']) ? $rowProject['picture'] : 'default.jpg' ?>"
                alt="" srcset="">
            </div>
            <div align="center" class="card-footer">
              <button class="btn openModal" data-bs-toggle="modal"
                data-bs-target="#modal<?php echo $rowProject['id'] ?>">Read
                More</button>
            </div>
          </div>
        </div>


        <?php endwhile ?>
      </div>

    </div>
  </div>
  </div>
  <?php endif ?>
  <!-- end portofolio section -->

  <?php while($rowProjectModal = mysqli_fetch_assoc($queryProjectModal)) : ?>
  <div id="modal<?php echo $rowProjectModal['id'] ?>" class="modal">
    <div class="modal-content modal-dialog mt-5 mb-5">
      <span data-bs-dismiss="modal" class="close mr-auto">&times;</span>
      <h2 class="mx-auto mb-5"><?php echo isset($rowProjectModal['title']) ? $rowProjectModal['title'] : '' ?></h2>
      <img class="mx-auto mb-3 card-photo" width="100%" max-height="350px"
        src="admin/img/projectPicture/<?php echo isset($rowProjectModal['picture']) ? $rowProjectModal['picture'] : 'default.jpg' ?>"
        alt="">
      <div class="portfolio-info mb-3">
        <h3>Project information</h3>
        <ul>
          <?php if(!empty($rowProjectModal['category'])) : ?>
          <li><strong>Category</strong>:
            <?php echo isset($rowProjectModal['category']) ? $rowProjectModal['category'] : '' ?>
          </li>
          <?php endif ?>
          <?php if(!empty($rowProjectModal['client'])) : ?>
          <li><strong>Client</strong>:
            <?php echo isset($rowProjectModal['client']) ? $rowProjectModal['client'] : '' ?>
          </li>
          <?php endif ?>
          <?php if(isset($rowProjectModal['start_date'])) : ?>
          <li><strong>Project Month</strong>:
            <?php echo isset($rowProjectModal['start_date']) ? $rowProjectModal['start_date'] : '' ?>
            <?php echo isset($rowProjectModal['end_date']) ? '- ' . $rowProjectModal['end_date'] : '' ?>
          </li>
          <?php endif ?>
          <?php if(!empty($rowProjectModal['url'])) : ?>
          <li><strong>Project URL</strong>: <a
              href="<?php echo isset($rowProjectModal['url']) ? $rowProjectModal['url'] : '' ?>"
              target="_blank"><?php echo isset($rowProjectModal['url']) ? $rowProjectModal['url'] : '' ?></a>
          </li>
          <?php endif ?>
        </ul>
      </div>
      <?php if(!empty($rowProjectModal['description'])) : ?>
      <div class="portfolio-description">
        <h2>Detail</h2>
        <p><?php echo isset($rowProjectModal['description']) ? $rowProjectModal['description'] : '' ?></p>
      </div>
      <?php endif ?>
    </div>
  </div>
  <?php endwhile ?>

  <!-- testimonial section -->
  <?php if(mysqli_num_rows($queryTestimonial) > 0) : ?>
  <div id="testimonials" class="section wb">
    <div class="container">
      <div class="section-title text-left">
        <h3>Testimonials</h3>
        <p>We thanks for all our awesome testimonials! There are hundreds of our happy customers! </p>
      </div><!-- end title -->

      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="testi-carousel owl-carousel owl-theme">

            <?php while($rowTestimonial = mysqli_fetch_assoc($queryTestimonial)) : ?>
            <div class="testimonial clearfix">
              <div class="desc">
                <p class="lead"><i class="fa fa-quote-left"></i>
                  <?php echo isset($rowTestimonial['testimony']) ? $rowTestimonial['testimony'] : '' ?></p>
              </div>
              <div class="testi-meta">
                <img
                  src="admin/img/testimonialPicture/<?php echo isset($rowTestimonial['picture']) ? $rowTestimonial['picture'] : 'default.jpg' ?>"
                  alt="" class="img-fluid alignleft">
                <h4><?php echo isset($rowTestimonial['name']) ? $rowTestimonial['name'] : '' ?> <small>-
                    <?php echo isset($rowTestimonial['affiliation']) ? $rowTestimonial['affiliation'] : '' ?></small>
                </h4>
              </div>
              <!-- end testi-meta -->
            </div>
            <!-- end testimonial -->
            <?php endwhile ?>

          </div><!-- end carousel -->
        </div><!-- end col -->
      </div><!-- end row -->
    </div><!-- end container -->
  </div><!-- end section -->
  <?php endif ?>
  <!-- end testimonial section -->



  <div id="contact" class="section db">
    <div class="container">
      <div class="section-title text-left">
        <h3>Contact</h3>
        <p>Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non aliquam risus.
        </p>
      </div><!-- end title -->

      <div class="row">
        <div class="col-md-12">
          <div class="contact_form">
            <div id="message"></div>
            <form method="post" action="controller/message-control.php?send=<?php echo $userID; ?>">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Your Name" required name="name">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Your Email" name="email">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone" name="phone">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Your Message" required
                      name="message"></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button class="sim-btn btn-hover-new" type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div><!-- end col -->
      </div><!-- end row -->
    </div><!-- end container -->
    <br><br><br><br><br><br><br><br>
  </div><!-- end section -->

  <div class="copyrights">
    <div class="container">
      <div class="footer-distributed">
        <div class="footer-left">
          <p class="footer-links">
            <a href="admin/index.php" target="_blank">Admin</a>
          </p>
          <p class="footer-company-name">All Rights Reserved. &copy; 2018 <a href="#">Dominic</a> Design By :
            <a href="https://html.design/">html design</a>
          </p>
        </div>
      </div>
    </div><!-- end container -->
  </div><!-- end copyrights -->

  <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

  <!-- ALL JS FILES -->
  <script src="js/script.js"></script>
  <script src="js/all.js"></script>
  <!-- Camera Slider -->
  <script src="js/jquery.mobile.customized.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/parallaxie.js"></script>
  <script src="js/headline.js"></script>
  <!-- Contact form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- ALL PLUGINS -->
  <script src="js/custom.js"></script>
  <script src="js/jquery.vide.js"></script>

</body>

</html>