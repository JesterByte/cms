<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <?php 
    $pageTitle = "About";
    include_once "dashboard-header.php"; 
  ?>
</head>
<body>
  <?php 
    include_once "theme.html";
    include_once "dashboard-symbols.php"; 
    include_once "navbar.html";
  ?>
  
  <div class="container-fluid">
    <div class="row">
      <?php include_once "sidebar.php"; ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2"><?php echo $pageTitle; ?></h1>
        </div>

        <!-- About Content -->
        <section>
          <h3>Project Overview</h3>
          <p>Our project, titled <strong>"Digitalization of Cemetery Transaction Management and Mapping System for Green Haven Memorial Park"</strong>, aims to create a more efficient and systematic way of managing cemetery transactions and mapping cemetery plots for Green Haven Memorial Park.</p>
          
          <h3>Team Information</h3>
          <p>We are Group 1 of CS41A, S.Y. 2024-2025 at ACLC College of Sta. Maria. Our team consists of the following members:</p>
          
          <ul>
            <li><strong>Leader:</strong> Eugine Jester Jose</li>
            <li><strong>Member:</strong> Mhark Joseph Legaspi (Frontend Developer)</li>
            <li><strong>Member:</strong> Paul John Raymundo (Tester)</li>
          </ul>
          
          <h3>Course and Section</h3>
          <p>We are currently enrolled in the course <strong>BS Computer Science</strong>, section <strong>CS41A</strong>, at ACLC College of Sta. Maria for the school year <strong>S.Y. 2024-2025</strong>.</p>
          
          <h3>Our Mission</h3>
          <p>Our mission is to enhance the management and mapping of cemetery plots, ensuring a streamlined process that improves the overall efficiency and organization of cemetery transactions.</p>
        </section>
      </main>
    </div>
  </div>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
