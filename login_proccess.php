<?php 
if(isset($_POST['login'])){
    include 'lib/koneksi.php';
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password = sha1($password);
    $sql = "SELECT * FROM users WHERE email='$email' && password='$password'";
    $query = mysqli_query($connection, $sql);
    $data = mysqli_fetch_array($query);

    if(mysqli_num_rows($query) == 1){
        $_SESSION['email'] = $data['email'];
        $_SESSION['success'] = "Login Succesfull";
        header("Location: notes/index.php");
    }else{
        $_SESSION['error'] = "Login Failed";
        header("Location: login.php");
    }
}