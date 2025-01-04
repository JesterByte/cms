<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <?php 
    $pageTitle = "Help & Support";
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

        <!-- Help & Support Section -->
        <section>
          <h3>Frequently Asked Questions (FAQs)</h3>
          <div class="accordion" id="faqAccordion">
            <!-- FAQ Item 1 -->
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  How can I create a new reservation?
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  To create a new reservation, go to the "Reservations" tab in the navigation menu and click on "New Reservation." Fill out the necessary information, including the date and the plot number, and submit the form.
                </div>
              </div>
            </div>
            <!-- FAQ Item 2 -->
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  How do I view my past payments?
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  To view your past payments, navigate to the "Payments" section, where you can see a detailed history of all your payment transactions, including amounts, dates, and payment status.
                </div>
              </div>
            </div>
            <!-- FAQ Item 3 -->
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  How can I get support if I need help with the system?
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  If you need assistance with the system, you can contact our support team by using the contact form below or emailing support@cemeterysystem.com. Our team will get back to you as soon as possible.
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Contact Form Section -->
        <section class="mt-4">
          <h3>Contact Support</h3>
          <form action="send_support_request.php" method="POST">
            <div class="mb-3">
              <label for="name" class="form-label">Your Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Your Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Request</button>
          </form>
        </section>

        <!-- Additional Resources Section -->
        <section class="mt-4">
          <h3>Additional Resources</h3>
          <p>For more detailed documentation and guides, check out the following links:</p>
          <ul>
            <li><a href="user_guide.pdf" target="_blank">User Guide</a></li>
            <li><a href="https://cemeterysystem.com/faq" target="_blank">Online FAQs</a></li>
            <li><a href="https://cemeterysystem.com/support" target="_blank">Community Support Forum</a></li>
          </ul>
        </section>

      </main>
    </div>
  </div>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <?php include_once "dashboard-footer.php"; ?>

</body>
</html>
