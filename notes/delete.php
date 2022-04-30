<?php
session_start();
if (!isset($_SESSION["email"])) {
    $_SESSION['error'] = "Sorry, you have to login first";
    header("Location: ../login.php");
}
if (isset($_GET['id'])) {
    include '../lib/koneksi.php';
    $id = $_GET['id'];
    $query = mysqli_query($connection, "DELETE FROM mynotes WHERE id='$id'");

    if ($query) {
        $_SESSION['success'] = "Congratulation, your notes has been succesfully deleted from the database";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Sorry, your notes was not failed to be deleted in the database";
        header("Location: index.php");
    }
}
