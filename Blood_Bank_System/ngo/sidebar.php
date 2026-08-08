<?php

$current_page = basename($_SERVER['PHP_SELF']);

?>

<div class="sidebar">

<div class="logo">

<i class="fa-solid fa-hand-holding-heart"></i>

Blood Bank

</div>

<ul>

<li class="<?php if($current_page=="dashboard.php") echo "active"; ?>">

<a href="dashboard.php">

<i class="fa-solid fa-gauge"></i>

Dashboard

</a>

</li>

<li class="<?php if($current_page=="ngo.php") echo "active"; ?>">

<a href="ngo.php">

<i class="fa-solid fa-tents"></i>

Management

</a>

</li>

<li class="<?php if($current_page=="organize_camp.php") echo "active"; ?>">

<a href="organize_camp.php">

<i class="fa-solid fa-tents"></i>

Organize Camp

</a>

</li>

<li class="<?php if($current_page=="camp_history.php") echo "active"; ?>">

<a href="camp_history.php">

<i class="fa-solid fa-list"></i>

Camp History

</a>

</li>

<li class="<?php if($current_page=="change_password.php") echo "active"; ?>">

<a href="change_password.php">

<i class="fa-solid fa-key"></i>

Change Password

</a>

</li>

<li>

<a href="logout.php">

<i class="fa-solid fa-right-from-bracket"></i>

Logout

</a>

</li>

</ul>

</div>