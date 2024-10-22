<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="user_dashboard.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->


  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#service-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-tools"></i><span>Service Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>

   


    <ul id="service-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">


    <li>
        <a href="services_page.php">
          <i class="bi bi-circle"></i><span>List of Services</span>
        </a>
      </li>



      <li>
        <a href="services_calendar_schedule.php">
          <i class="bi bi-circle"></i><span>View Calendar Schedule</span>
        </a>
      </li>

      
      </li><!-- End Components Nav -->

    </ul>
    <li class="nav-item">
    <a class="nav-link " href="schedule_services_page.php">
      <i class="bi bi-person"></i>
      <span>Schedule Service</span>
    </a>
  </li>



  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#Customer-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-person"></i><span>Vehicle Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="Customer-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">



      <li>
        <a href="customer_vehicle_registration.php">
          <i class="bi bi-circle"></i><span>Registered Vehicle</span>
        </a>
      </li>


      <li>
        <a href="customer_service_history.php">
          <i class="bi bi-circle"></i><span>Service History</span>
        </a>
      </li>




    </ul>
  </li><!-- End Components Nav -->

</ul>

</aside>