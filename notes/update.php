<?php 
session_start();
if (!isset($_SESSION["email"])) {
    $_SESSION['error'] = "Sorry, you have to login first";
    header("Location: ../login.php");
}

if(isset($_POST['update'])){
    include '../lib/koneksi.php';
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $notes = $_POST['notes'];
    $updated_at = date('Y-m-d H:i:s');

    $query = mysqli_query($connection,"UPDATE mynotes SET title='$title', description='$description', notes='$notes', updated_at='$updated_at' WHERE id='$id'");

    if ($query) {
        $_SESSION['success'] = "Congratulation, your notes has been succesfully";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Sorry, your notes was not succesfully updated in the database";
        header("Location: index.php");
    }
}