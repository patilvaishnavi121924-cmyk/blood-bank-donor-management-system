
<?php
include("includes/session.php");
include("database/connection.php");
include("includes/header.php");
include("includes/navbar.php");

// Total Donors
$result = mysqli_query($conn,"SELECT COUNT(*) AS total FROM donors");
$donors = mysqli_fetch_assoc($result)['total'];

// Total Hospitals
$result = mysqli_query($conn,"SELECT COUNT(*) AS total FROM hospitals");
$hospitals = mysqli_fetch_assoc($result)['total'];

// Total NGOs
$result = mysqli_query($conn,"SELECT COUNT(*) AS total FROM ngos");
$ngos = mysqli_fetch_assoc($result)['total'];

// Total Blood Units
$result = mysqli_query($conn,"SELECT SUM(units) AS total FROM blood_stock");
$row = mysqli_fetch_assoc($result);
$blood_units = $row['total'];

if($blood_units=="")
{
    $blood_units=0;
}

?>

<?php

$bloodStock = [];

$query = mysqli_query($conn, "SELECT blood_group, units FROM blood_stock");

while($row = mysqli_fetch_assoc($query))
{
    $bloodStock[$row['blood_group']] = $row['units'];
}

?>

<!-- Navbar will come here -->

<!-- ================= HERO SECTION START ================= -->

<section class="hero">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6" data-aos="fade-right">

                <span class="hero-tag">

                    ❤️ Donate Blood • Save Lives

                </span>

                <h1>

                    Every Drop of Blood <br>

                    Can Save Someone's Life

                </h1>

                <p>

                    Join our Blood Bank & Donor Management System.<br>
                    Search blood instantly, register as a donor, and help hospitals
                    save lives.

                </p>

                <a href="register.php" class="btn btn-main me-3">

                    Become a Donor

                </a>

                <a href="search_blood.php" class="btn btn-outline-main">

                    Search Blood

                </a>

            </div>

            <div class="col-lg-6 text-center" data-aos="fade-left">

                <img src="images/hero.jpg"

                     class="img-fluid hero-image float-animation"

                     alt="Blood Donation">

            </div>

        </div>

    </div>

</section>

<!-- ================= HERO SECTION END ================= -->

<!-- Blood Groups -->

<!-- ================= STATISTICS START ================= -->

<section class="stats-section py-5">

    <div class="container">

        <div class="row g-4">

            <div class="col-lg-3 col-md-6">

                <div class="stat-card text-center">

                    <i class="fa-solid fa-users"></i>

                    <h2 class="counter"><?php echo $donors; ?></h2>

                    <p>Registered Donors</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="stat-card text-center">

                    <i class="fa-solid fa-droplet"></i>

                    <h2 class="counter"><?php echo $blood_units; ?></h2>

                    <p>Blood Units</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="stat-card text-center">

                    <i class="fa-solid fa-hospital"></i>

                    <h2 class="counter"><?php echo $hospitals; ?></h2>

                    <p>Hospitals</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="stat-card text-center">

                    <i class="fa-solid fa-handshake"></i>

                    <h2 class="counter"><?php echo $ngos; ?></h2>

                    <p>NGOs</p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= STATISTICS END ================= -->

<!-- ================= BLOOD GROUPS START ================= -->

<section class="blood-section py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="section-title">

                Blood Availability

            </h2>

            <p>

                Search available blood groups quickly.

            </p>

        </div>

        <div class="row g-4">

            <div class="col-lg-3 col-md-4 col-6">

                <div class="blood-card">

                    <h3>A+</h3>

                    <p><?php echo isset($bloodStock['A+']) ? $bloodStock['A+'] : 0; ?> Units</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-4 col-6">

                <div class="blood-card">

                    <h3>A-</h3>

                    <p><?php echo isset($bloodStock['A-']) ? $bloodStock['A-'] : 0; ?> Units</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-4 col-6">

                <div class="blood-card">

                    <h3>B+</h3>

                    <p><?php echo isset($bloodStock['B+']) ? $bloodStock['B+'] : 0; ?> Units</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-4 col-6">

                <div class="blood-card">

                    <h3>B-</h3>

                    <p><?php echo isset($bloodStock['B-']) ? $bloodStock['B-'] : 0; ?> Units</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-4 col-6">

                <div class="blood-card">

                    <h3>AB+</h3>

                    <p><?php echo isset($bloodStock['AB+']) ? $bloodStock['AB+'] : 0; ?> Units</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-4 col-6">

                <div class="blood-card">

                    <h3>AB-</h3>

                    <p><?php echo isset($bloodStock['AB-']) ? $bloodStock['AB-'] : 0; ?> Units</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-4 col-6">

                <div class="blood-card">

                    <h3>O+</h3>

                    <p><?php echo isset($bloodStock['O+']) ? $bloodStock['O+'] : 0; ?> Units</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-4 col-6">

                <div class="blood-card">

                    <h3>O-</h3>

                    <p><?php echo isset($bloodStock['O-']) ? $bloodStock['O-'] : 0; ?> Units</p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= BLOOD GROUPS END ================= -->

<!-- ================= WHY DONATE BLOOD START ================= -->

<section class="why-donate py-5">

    <div class="container">

        <div class="text-center mb-5" data-aos="fade-up">

            <h2 class="section-title">Why Donate Blood?</h2>

            <p>Your one donation can save up to three lives.</p>

        </div>

        <div class="row g-4">

            <div class="col-lg-4" data-aos="fade-up">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="fa-solid fa-heart-circle-check"></i>
                    </div>

                    <h4>Save Lives</h4>

                    <p>
                        Blood donation helps accident victims,
                        surgery patients and people suffering from
                        serious illnesses.
                    </p>

                </div>

            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>

                    <h4>Healthy Habit</h4>

                    <p>
                        Regular blood donation supports blood
                        circulation and encourages a healthy lifestyle.
                    </p>

                </div>

            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <h4>Support Community</h4>

                    <p>
                        Become a lifesaver and contribute to your
                        community by helping patients in emergencies.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= WHY DONATE BLOOD END ================= -->

<!-- ================= SERVICES START ================= -->

<section class="services py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="section-title">

                Our Services

            </h2>

        </div>

        <div class="row g-4">

            <div class="col-lg-3 col-md-6">

                <div class="service-card">

                    <i class="fa-solid fa-droplet"></i>

                    <h5>Blood Donation</h5>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="service-card">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <h5>Search Blood</h5>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="service-card">

                    <i class="fa-solid fa-hospital"></i>

                    <h5>Hospital Requests</h5>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="service-card">

                    <i class="fa-solid fa-handshake"></i>

                    <h5>NGO Camps</h5>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= SERVICES END ================= -->

<!-- ================= HOW IT WORKS START ================= -->

<section class="how-it-works py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="section-title">How It Works</h2>

            <p>Simple steps to save a life.</p>

        </div>

        <div class="row text-center g-4">

            <div class="col-lg-3 col-md-6">

                <div class="step-card">

                    <div class="step-number">1</div>

                    <i class="fa-solid fa-user-plus"></i>

                    <h5>Register</h5>

                    <p>Create your account.</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="step-card">

                    <div class="step-number">2</div>

                    <i class="fa-solid fa-droplet"></i>

                    <h5>Donate Blood</h5>

                    <p>Donate safely.</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="step-card">

                    <div class="step-number">3</div>

                    <i class="fa-solid fa-warehouse"></i>

                    <h5>Blood Stored</h5>

                    <p>Stored securely.</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="step-card">

                    <div class="step-number">4</div>

                    <i class="fa-solid fa-heart-circle-check"></i>

                    <h5>Save Lives</h5>

                    <p>Help patients in need.</p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= HOW IT WORKS END ================= -->
<!-- ================= TESTIMONIALS START ================= -->

<section class="testimonials py-5">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

What People Say

</h2>

</div>

<div class="row g-4">

<div class="col-lg-4">

<div class="testimonial-card">

<img src="images/user1.jpg" class="testimonial-img">

<h5>Rajan Shukla</h5>

<p>

"The website made blood donation easy and quick."

</p>

</div>

</div>

<div class="col-lg-4">

<div class="testimonial-card">

<img src="images/user2.jpg" class="testimonial-img">

<h5>Nilesh Pal</h5>

<p>

"I found blood for my father within minutes."

</p>

</div>

</div>

<div class="col-lg-4">

<div class="testimonial-card">

<img src="images/user3.jpg" class="testimonial-img">

<h5>Dhanashree Nikam</h5>

<p>

"Excellent platform for hospitals and donors."

</p>

</div>

</div>

</div>

</div>

</section>

<!-- ================= TESTIMONIALS END ================= -->

<!-- Footer -->

<?php include("includes/footer.php"); ?>