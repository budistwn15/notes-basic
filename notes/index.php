<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <title>Notes</title>
</head>

<body>

    <?php
    session_start();
    if(!isset($_SESSION["email"])){
        $_SESSION['error'] = "Sorry, you have to login first";
        header("Location: ../login.php");
    }
    include '../lib/koneksi.php';
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Notes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-3">My Notes</h2>
                <a href="create.php" class="btn btn-light rounded-pill">Add Note</a>
            </div>
        </div>
        <div class="row">
            <?php
            $query = mysqli_query($connection, "SELECT * FROM mynotes ORDER BY updated_at DESC");
            if (mysqli_num_rows($query) > 0) {
                foreach ($query as $data) {
            ?>
                    <div class="col-md-4 mb-2">
                        <div class="body mt-4">
                            <div class="card bg-light p-4">
                                <div class="d-flex justify-content-between">
                                    <p><?= date('d M', strtotime($data['created_at'])) ?></p>
                                    <div>
                                        <a href="edit.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-light border">
                                            <i class="bi bi-pen"></i>
                                        </a>
                                        <a href="delete.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-light border" onclick="return confirm('Are you sure yo want to delete notes?')">
                                            <i class="bi bi-trash text-danger"></i>
                                        </a>
                                    </div>
                                </div>
                                <a href="show.php?id=<?=$data['id']?>" class="text-decoration-none ">
                                    <h4><?= $data['title'];  ?></h4>
                                </a>
                                <p class="lead"><?= $data['description'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="col-md-4 mx-auto">
                    <img src="../images/img_nodata.png" class="img-fluid">
                    <p class="text-center text-secondary">Opps.... You dont have notes in my web</p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <?php
    if (isset($_SESSION['success'])) { ?>
        <script>
            swal("Success", "<?php echo $_SESSION['success']; ?>", "success");
        </script>
    <?php
        unset($_SESSION['success']);
    } else if (isset($_SESSION['error'])) { ?>
        <script>
            swal("Error", "<?php echo $_SESSION['error']; ?>", "error");
        </script>
    <?php
        unset($_SESSION['error']);
    }
    ?>
</body>

</html>