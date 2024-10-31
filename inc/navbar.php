<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
  <div class="container">
    <!-- <a class="navbar-brand js-scroll-trigger" href="#page-top">
			<img class="img-fluid" src="images/logo.png" alt="" />
		</a> -->
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation">
      Menu
      <i class="fa fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav text-uppercase mx-auto">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger active" href="#hero">Home</a>
        </li>
        <?php if(mysqli_num_rows($queryAbout) > 0) : ?>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#about">About</a>
        </li>
        <?php endif ?>
        <?php if (
          mysqli_num_rows($queryEducation) > 0 ||
          mysqli_num_rows($queryWorkExperience) > 0 ||
          mysqli_num_rows($queryPublication) > 0 ||
          mysqli_num_rows($queryCertificate) > 0
        ) :
        ?>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#resume">Resume</a>
        </li>
        <?php endif ?>
        <?php if(mysqli_num_rows($querySkills) > 0) : ?>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#skills">Skills</a>
        </li>
        <?php endif ?>
        <?php if(mysqli_num_rows($queryProject) > 0) : ?>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#project">Project</a>
        </li>
        <?php endif ?>
        <?php if(mysqli_num_rows($queryTestimonial) > 0) : ?>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#testimonials">Testimonials</a>
        </li>
        <?php endif ?>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>