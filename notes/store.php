<?php
session_start();
if (!isset($_SESSION["email"])) {
    $_SESSION['error'] = "Sorry, you have to login first";
    header("Location: ../login.php");
}
if (isset($_POST['create'])) {
    include '../lib/koneksi.php';

    $title = $_POST['title'];
    $description = $_POST['description'];
    $notes = $_POST['notes'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = $created_at;

    $query = mysqli_query($connection, "INSERT INTO mynotes VALUES(null,'$title','$description','$notes','$created_at','$updated_at')");

    if ($query) {
        $_SESSION['success'] = "Congratulation, your notes has been succesfully";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Sorry, your notes was not succesfully saved in the database";
        header("Location: create.php");
    }
}
