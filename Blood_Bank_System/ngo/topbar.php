<?php

if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}

?>

<div class="topbar">

<div class="d-flex justify-content-between align-items-center">

<h4 class="mb-0">

NGO Dashboard

</h4>

<div>

<span class="me-3">

<i class="fa-solid fa-user-circle"></i>

<?php echo $_SESSION['user_name']; ?>

</span>

<a href="logout.php" class="btn btn-danger btn-sm">

<i class="fa-solid fa-right-from-bracket"></i>

Logout

</a>

</div>

</div>

</div>