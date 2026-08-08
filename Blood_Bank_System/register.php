<?php
include("./includes/session.php");
include("database/connection.php");
include("includes/header.php");
include("includes/navbar.php");

?>

<section class="register-section">

<div class="container">

<div class="text-center mb-5">

<h1 class="fw-bold">

Create Your Account

</h1>

<p>

Choose your registration type

</p>

</div>

<div class="row justify-content-center g-4">

<!-- Donor -->

<div class="col-lg-4 col-md-6">

<div class="register-card">

<i class="fa-solid fa-hand-holding-droplet register-icon"></i>

<h3>Donor</h3>

<p>

Become a blood donor and help save lives.

</p>

<a href="donor_register.php" class="btn btn-main">

Register

</a>

</div>

</div>

<!-- Hospital -->

<div class="col-lg-4 col-md-6">

<div class="register-card">

<i class="fa-solid fa-hospital register-icon"></i>

<h3>Hospital</h3>

<p>

Register your hospital to request blood.

</p>

<a href="hospital_register.php" class="btn btn-main">

Register

</a>

</div>

</div>

<!-- NGO -->

<div class="col-lg-4 col-md-6">

<div class="register-card">

<i class="fa-solid fa-handshake register-icon"></i>

<h3>NGO</h3>

<p>

Organize blood donation camps.

</p>

<a href="ngo_register.php" class="btn btn-main">

Register

</a>

</div>

</div>

</div>

</div>

</section>



<?php include("includes/footer.php"); ?>