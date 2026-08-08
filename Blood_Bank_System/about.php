<?php
include("includes/session.php");
include("database/connection.php");
include("includes/header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>About | LifeDrop</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<?php include("includes/navbar.php"); ?>

<section class="about-section py-5">

<div class="container">
	<div class="card shadow">

<div class="card-header">


<div class="text-center mb-5">

<h1 class="display-4 fw-bold text-danger">
About LifeDrop
</h1>

<p class="lead text-blue">
Connecting Donors, Hospitals and NGOs to save lives.
</p>

</div>

<!-- Mission & Vision -->

<div class="row g-4 mb-5">

<div class="col-lg-6">

<div class="card border-0 shadow h-100">

<div class="card-body p-4">

<h3 class="text-danger mb-3">

<i class="fa-solid fa-bullseye"></i>

Our Mission

</h3>

<p class="text-blue">

LifeDrop is a Blood Bank Management System developed to make blood donation,
blood requests, and donor management simple, secure, and fast.
It connects donors, hospitals, blood banks and NGOs on one platform,
helping save lives through quick and reliable blood availability.

</p>

</div>

</div>

</div>

<div class="col-lg-6">

<div class="card border-0 shadow h-100">

<div class="card-body p-4">

<h3 class="text-danger mb-3">

<i class="fa-solid fa-eye"></i>

Our Vision

</h3>

<p class="text-blue">

To build a trusted digital blood donation network where every patient
receives the right blood at the right time by connecting donors,
hospitals and NGOs through one efficient platform.

</p>

</div>

</div>

</div>

</div>

<!-- Features -->

<div class="row g-4 text-center">

<div class="col-md-4">

<div class="card border-0 shadow h-100">

<div class="card-body p-4">

<i class="fa-solid fa-hand-holding-heart fa-3x text-danger mb-3"></i>

<h4>Easy Donation</h4>

<p class="text-blue">

Quick donor registration, blood donation records,
and simple management.

</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card border-0 shadow h-100">

<div class="card-body p-4">

<i class="fa-solid fa-hospital fa-3x text-danger mb-3"></i>

<h4>Hospital Support</h4>

<p class="text-blue">

Hospitals can search blood availability,
request blood and track request history instantly.

</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card border-0 shadow h-100">

<div class="card-body p-4">

<i class="fa-solid fa-users fa-3x text-danger mb-3"></i>

<h4>NGO Participation</h4>

<p class="text-blue">

NGOs can organize blood donation camps,
manage volunteers and support blood collection drives.

</p>

</div>

</div>

</div>

</div>

</div>

</section>

<?php include("includes/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>