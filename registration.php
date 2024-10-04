<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Motorcycle Brand - Registration & Login</title>
    <link rel="stylesheet" href="assets_front/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap">
    <style>
        /* Glassmorphism Effect for Container */
        .glass-container {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        /* Background and Layout */
        body {
            background: linear-gradient(rgba(153, 150, 151, 0.65), rgba(255, 192, 0, 0.65), rgba(255, 5, 5, 0.65)), url('assets_front/img/bg-1.png');
            background-position: center;
            font-family: 'Raleway', sans-serif;
        }

        /* Form Styles */
        .form-container {
            max-width: 800px; /* Increased width for larger form */
            margin: 0 auto;
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            color: #fff;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #f8c471;
        }

        .btn-custom {
            background-color: #f8c471;
            border-color: #f8c471;
            color: #000;
        }

        .btn-custom:hover {
            background-color: #d4a354;
            border-color: #d4a354;
        }

        .text-custom {
            color: #f8c471;
        }
    </style>
</head>

<body>

    <div class="text-center">
        <img src="assets_front/img/logo.jpg" alt="Motorcycle Brand Logo" class="img-fluid" style="width: 500px; height: 250px; margin: 20px; padding: 10px;">
    </div>

    <?php include("navigation.php"); ?>

    <!-- Registration Form -->
    <section id="registerSection" class="page-section">
        <div class="container">
            <div class="row">
                <!-- Registration Form -->
                <div class="col-md-6">
                    <div class="glass-container form-container">
                        <h2>Registration Form</h2>
                        <form class="row g-4" action="process/customer_registration.php" method="POST"> <!-- Changed g-3 to g-4 for more space -->
                            <div class="col-md-12">
                                <label for="firstname" class="form-label">Firstname</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required>
                            </div>

                            <div class="col-md-12">
                                <label for="middlename" class="form-label">Middlename</label>
                                <input type="text" class="form-control" id="middlename" name="middlename" required>
                            </div>

                            <div class="col-md-12">
                                <label for="lastname" class="form-label">Lastname</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="text-center col-12">
                                <button type="submit" class="btn btn-custom">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End Multi Columns Form -->
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="col-md-6">
                    <div class="text-center cta-inner rounded glass-container p-4">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper">Come On In</span>
                            <span class="section-heading-lower">We're Open</span>
                        </h2>
                        <ul class="list-unstyled text-start mx-auto list-hours mb-5">
                            <li class="d-flex list-unstyled-item list-hours-item">Sunday<span class="ms-auto">Closed</span></li>
                            <li class="d-flex list-unstyled-item list-hours-item">Monday<span class="ms-auto">7:00 AM to 8:00 PM</span></li>
                            <li class="d-flex list-unstyled-item list-hours-item">Tuesday<span class="ms-auto">7:00 AM to 8:00 PM</span></li>
                            <li class="d-flex list-unstyled-item list-hours-item">Wednesday<span class="ms-auto">7:00 AM to 8:00 PM</span></li>
                            <li class="d-flex list-unstyled-item list-hours-item">Thursday<span class="ms-auto">7:00 AM to 8:00 PM</span></li>
                            <li class="d-flex list-unstyled-item list-hours-item">Friday<span class="ms-auto">7:00 AM to 8:00 PM</span></li>
                            <li class="d-flex list-unstyled-item list-hours-item">Saturday<span class="ms-auto">9:00 AM to 5:00 PM</span></li>
                        </ul>
                        <p class="address mb-5">
                            <em><strong>1116 Orchard Street</strong><span><br>Golden Valley, Minnesota</span></em>
                        </p>
                        <p class="address mb-0">
                            <small><em>Call Anytime</em></small><span><br>(317) 585-8468</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center footer text-faded py-5">
        <div class="container">
            <p class="m-0 small">Copyright © SPECj 2024</p>
        </div>
    </footer>

    <script src="assets_front/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
