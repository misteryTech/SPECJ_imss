<?php
        include("include/header.php");


?>
<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">


              <div class="card mb-3">

                <div class="card-body">
                <img src="assets_front/img/logo.jpg" alt="Motorcycle Brand Logo" class="img-fluid" style="width: 400px; height:200px; margin: 20px; padding: 10px;">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Supplier Login</h5>
                                    <p class="text-center small">Enter your username & password to login</p>
                                </div>

                  <form action="process/supplier_login_process.php" method="POST" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="registration.php">Create an account</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">

SPECJ Motor Services <a href="#"> Inventory Management System</a>
</div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->


  <?php
  include("include/footer.php");
?>
