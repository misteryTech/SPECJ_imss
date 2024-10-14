<?php
include("user_header.php");
?>
<body>

<!-- ======= Header ======= -->
<!-- ======= Sidebar ======= -->
<?php
include("user_topnav.php");
include("user_sidenav.php");
?>

<!-- Main -->
<main id="main" class="main">

<div class="pagetitle">
    <h1>Services Management</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">View Calendar Services Schedule</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Scheduled Services Calendar</h5>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</section>
</main><!-- End #main -->

<div class="modal fade" id="servicesModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scheduleModalLabel">Service Schedule Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <!-- Service ID and Customer Info -->
          <div class="row mb-3">
            <div class="col-md-6">
              <p><strong>Schedule Service ID:</strong> <span id="servidId" class="badge bg-primary data-font"></span></p>
            </div>
            <div class="col-md-6">
              <p><strong>Customer Name:</strong> <span id="customer_name" class="badge bg-info data-font"></span></p>
            </div>
          </div>

          <!-- Vehicle and Service Info -->
          <div class="row mb-3">
            <div class="col-md-6">
              <p><strong>Vehicle Plate Number:</strong> <span id="vehicle_no" class="badge bg-warning data-font"></span></p>
            </div>
            <div class="col-md-6">
              <p><strong>Service:</strong> <span id="service" class="badge bg-success data-font"></span></p>
            </div>
          </div>

          <!-- Service Description -->
          <div class="row mb-3">
            <div class="col-md-12">
              <p><strong>Service Description:</strong></p>
              <p id="description" class="border p-2 rounded data-font"></p>
            </div>
          </div>

          <!-- Time and Mechanist Info -->
          <div class="row mb-3">
            <div class="col-md-6">
              <p><strong>Time:</strong> <span id="time" class="badge bg-secondary data-font"></span></p>
            </div>
            <div class="col-md-6">
              <p><strong>Mechanist Name:</strong> <span id="mechanist" class="badge bg-dark data-font"></span></p>
            </div>
          </div>

          <!-- Technician Notes -->
          <div class="row mb-3">
            <div class="col-md-12">
              <p><strong>Technician Notes:</strong></p>
              <p id="technote" class="border p-2 rounded data-font"></p>
            </div>
          </div>

          <!-- Customer Notes -->
          <div class="row mb-3">
            <div class="col-md-12">
              <p><strong>Customer Notes:</strong></p>
              <p id="customernote" class="border p-2 rounded data-font"></p>
            </div>
          </div>

          <!-- Instructions -->
          <div class="row mb-3">
            <div class="col-md-12">
              <p><strong>Instructions:</strong></p>
              <p id="instruction" class="border p-2 rounded data-font"></p>
            </div>
          </div>

          <!-- Status -->
          <div class="row mb-3">
            <div class="col-md-12">
              <p><strong>Status:</strong> <span id="status" class="badge bg-success data-font"></span></p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- ======= Footer ======= -->
<?php
include("user_footer.php");
?>

<!-- JavaScript to initialize the calendar -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: 'process_code/load_services_scheduled.php', // URL to fetch events from the server
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth'
        },
        eventClick: function(info) {
            var eventObj = info.event.extendedProps;

            // Display supplier details in the modal
            $('#servidId').text(eventObj.sched_service_id);
            $('#customer_name').text(eventObj.customer_name);
            $('#vehicle_no').text(eventObj.license_plate);
            $('#service').text(eventObj.services_name);
            $('#description').text(eventObj.service_description);
            $('#time').text(eventObj.preferred_time);
            $('#mechanist').text(eventObj.mechanist_name);
            $('#technote').text(eventObj.technician_notes);
            $('#customernote').text(eventObj.customer_comment);
            $('#instruction').text(eventObj.special_instruction);
            $('#status').text(eventObj.status);

            // Show the modal
            $('#servicesModal').modal('show');
        }
    });

    calendar.render();
});
</script>

</body>
