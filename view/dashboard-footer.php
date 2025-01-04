<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>

  <script>
    $(document).ready(function() {
      const newUserAdded = <?php echo json_encode(isset($_SESSION["new_user_added"]) ? $_SESSION["new_user_added"] : "false"); ?>;

      successSweetAlert(newUserAdded, "New user added successfully.");

      function successSweetAlert(session, text) {
        if(session === true) {
          Swal.fire({
            title: "Success",
            text: text,
            icon: "success",
            timer: 1500,
            showConfirmButton: false
          });      

          fetch("../controller/sweet-alert-controller.php")
            .then(() => {
              console.log("Successful unset");
            })
            .catch(error => {
              console.error("Error: ", error)
            });
        }
      }
    });
</script>
