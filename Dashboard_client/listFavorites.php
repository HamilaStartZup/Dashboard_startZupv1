<?php
session_start();
// Database Connection
include '../config.php';
$queryFavorites = "SELECT * FROM `student` WHERE `id` IN (SELECT `id_candidate` FROM `favorites_profil` WHERE `id_client`=$_SESSION[id])";
$stmtFavorites = $conn->prepare($queryFavorites);
$stmtFavorites->execute();
$Favorites = $stmtFavorites->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html>

<head>
    <meta content="initial-scale=1, maximum-scale=1, 
		user-scalable=0" name="viewport" />

    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!--Datatable plugin CSS file -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

    <!--jQuery library file -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js">
    </script>

    <!--Datatable plugin JS library file -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
    </script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #fbfbfb;
        }

        /* The actual timeline (the vertical ruler) */
        .main-timeline-2 {
            position: relative;
        }

        /* The actual timeline (the vertical ruler) */
        .main-timeline-2::after {
            content: "";
            position: absolute;
            width: 3px;
            background-color: #26c6da;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }

        /* Container around content */
        .timeline-2 {
            position: relative;
            background-color: inherit;
            width: 50%;
        }

        /* The circles on the timeline */
        .timeline-2::after {
            content: "";
            position: absolute;
            width: 25px;
            height: 25px;
            right: -11px;
            background-color: #26c6da;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }

        /* Place the container to the left */
        .left-2 {
            padding: 0px 40px 20px 0px;
            left: 0;
        }

        /* Place the container to the right */
        .right-2 {
            padding: 0px 0px 20px 40px;
            left: 50%;
        }

        /* Add arrows to the left container (pointing right) */
        .left-2::before {
            content: " ";
            position: absolute;
            top: 18px;
            z-index: 1;
            right: 30px;
            border: medium solid white;
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent white;
        }

        /* Add arrows to the right container (pointing left) */
        .right-2::before {
            content: " ";
            position: absolute;
            top: 18px;
            z-index: 1;
            left: 30px;
            border: medium solid white;
            border-width: 10px 10px 10px 0;
            border-color: transparent white transparent transparent;
        }

        /* Fix the circle for containers on the right side */
        .right-2::after {
            left: -14px;
        }

        /* Media queries - Responsive timeline on screens less than 600px wide */
        @media screen and (max-width: 600px) {

            /* Place the timelime to the left */
            .main-timeline-2::after {
                left: 31px;
            }

            /* Full-width containers */
            .timeline-2 {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            /* Make sure that all arrows are pointing leftwards */
            .timeline-2::before {
                left: 60px;
                border: medium solid white;
                border-width: 10px 10px 10px 0;
                border-color: transparent white transparent transparent;
            }

            /* Make sure all circles are at the same spot */
            .left-2::after,
            .right-2::after {
                left: 18px;
            }

            .left-2::before {
                right: auto;
            }

            /* Make all right containers behave like the left ones */
            .right-2 {
                left: 0%;
            }
        }

        td.details-control {
            /* Image in the first column to 
				indicate expand*/
            background: url('images/more.png') no-repeat center;

            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('images/shrinkdata.PNG') no-repeat center;
        }
    </style>

</head>

<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar brand -->
                    <a class="navbar-brand mt-2 mt-lg-0" href="#">
                        <a class="navbar-brand" href="#">
                            <img src="../images/icon.png" height="25" alt="KJJJ" />

                        </a>
                        <!-- Left links -->
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="./dashboard_client.html">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./interns.php"> Les stagiaires</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./listFavorites.php">List des favoris</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./contact_us.html">Contact</a>
                            </li>
                        </ul>
                        <!-- Left links -->
                </div>
                <!-- Collapsible wrapper -->

                <!-- Right elements -->
                <div class="d-flex align-items-center">
                    <!-- Icon -->


                    <!-- Notifications -->
                    <div class="dropdown">

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="#">Some news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Another news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Avatar -->
                    <div class="dropdown">
                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                            <li>
                                <a class="dropdown-item" href="#">My profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Settings</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Right elements -->
            </div>
            <!-- Container wrapper -->

        </nav>
        <!-- Navbar -->
    </header>
    <main>

        <div style="margin-top: 18px" class="row">
            <?php foreach ($Favorites as $row) { ?>
                <div class="col-sm-4">


                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-lg shadow-lg p-3 mb-5  rounded" style="background-color:#A648C2 ;"><?php echo $row['code_profile'] ?></button>
                                </div>
                                <div class="col-md-8">
                                    <div class="pb-3">
                                        <h5 class="card-title"><?php echo $row['designation'] ?></h5>
                                    </div>


                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-success"><span class="bi bi-alarm-fill"></span> Disponibilité: <span></span><?php echo $row['disponibility'] ?></button>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <?php
                            echo "<form action='./removeFavorites.php?prev=2' method='POST'><button type='submit' value='$row[id]' name='condidatId'class='btn btn-danger'><span class='bi bi-trash'></span> Retirer de la liste de favoris</button><span></span>";
                            ?>
                            <?php
                            $url = "./profile.php?code_profile=" . $row["code_profile"];
                            echo "<a  href='$url'><button type='button' class='btn btn-primary'><span class='bi bi-arrow-up-right-square-fill'></span> Voir plus</button></a>";
                            ?>
                        </div>
                    </div>
                    <br>
                </div>
            <?php } ?>
        </div>





        <footer class="bg-light text-center  rounded-3 text-white" style="margin-top: 18px;">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
                <!-- Section: Social media -->
                <section class="mb-4">
                    <!-- Facebook -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #878f99;" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

                    <!-- Twitter -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #55acee;" href="#!" role="button"><i class="fab fa-twitter"></i></a>

                    <!-- Google -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #dd4b39;" href="#!" role="button"><i class="fab fa-google"></i></a>

                    <!-- Instagram -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #ac2bac;" href="#!" role="button"><i class="fab fa-instagram"></i></a>

                    <!-- Linkedin -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #0082ca;" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
                    <!-- Github -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #333333;" href="#!" role="button"><i class="fab fa-github"></i></a>
                </section>
                <!-- Section: Social media -->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2020 Copyright:
                <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </div>
            <!-- Copyright -->
        </footer>
    </main>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
    <script>
        // Initialization for ES Users
        import {
            Ripple,
            initMDB
        } from "mdb-ui-kit";

        initMDB({
            Ripple
        });
    </script>
</body>

</html>