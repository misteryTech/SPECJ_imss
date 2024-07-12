<?php
include("admin_header.php");
?>
<body>

<!-- ======= Header ======= -->
<!-- ======= Sidebar ======= -->
<?php
include("admin_topnav.php");
include("admin_sidenav.php");
?>

<!-- Main -->
<main id="main" class="main">

<div class="pagetitle">
    <h1>Scheduled Deliveries</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Calendar View</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Scheduled Delivery Calendar</h5>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</section>
</main><!-- End #main -->

<!-- Modal for Supplier Details -->
<div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="supplierModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="supplierModalLabel">Supplier Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Oder Number:</strong> <span id="orderNumber"></span></p>
        <p><strong>Oder Price:</strong> <span id="price"></span></p>
        <p><strong>Supplier Name:</strong> <span id="supplierName"></span></p>

        <p><strong>Quantity Reoder:</strong> <span id="quantity_to_reorder"></span></p>

        <p><strong>status:</strong> <span id="status"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- ======= Footer ======= -->
<?php
include("admin_footer.php");
?>

<!-- JavaScript to initialize the calendar -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: 'process_code/load_delivery_scheduled.php', // URL to fetch events from the server
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        eventClick: function(info) {
            var eventObj = info.event.extendedProps;

            // Display supplier details in the modal
            $('#orderNumber').text(eventObj.reorder_id);
            $('#supplierName').text(eventObj.supplier_id);
            $('#status').text(eventObj.status);
            $('#price').text(eventObj.price);
            $('#quantity_to_reorder').text(eventObj.quantity_to_reorder);
            $('#address').text(eventObj.address);

            // Show the modal
            $('#supplierModal').modal('show');
        }
    });

    calendar.render();
});
</script>

</body>
