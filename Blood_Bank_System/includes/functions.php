<?php

/* ===========================
   Clean Input
=========================== */

function cleanInput($conn, $data)
{
    return mysqli_real_escape_string($conn, trim($data));
}

/* ===========================
   Redirect
=========================== */

function redirect($location)
{
    header("Location: ".$location);
    exit();
}

/* ===========================
   Count Records
=========================== */

function getCount($conn, $table)
{
    $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM $table");
    $row = mysqli_fetch_assoc($query);

    return $row['total'];
}

/* ===========================
   Sum Blood Units
=========================== */

function getBloodUnits($conn)
{
    $query = mysqli_query($conn, "SELECT SUM(units) AS total FROM blood_stock");
    $row = mysqli_fetch_assoc($query);

    return ($row['total']) ? $row['total'] : 0;
}

/* ===========================
   Check Email Exists
=========================== */

function emailExists($conn, $table, $email)
{
    $query = mysqli_query($conn,
    "SELECT * FROM $table WHERE email='$email'");

    return mysqli_num_rows($query);
}

/* ===========================
   Check Mobile Exists
=========================== */

function mobileExists($conn, $table, $mobile)
{
    $query = mysqli_query($conn,
    "SELECT * FROM $table WHERE mobile='$mobile'");

    return mysqli_num_rows($query);
}



?>