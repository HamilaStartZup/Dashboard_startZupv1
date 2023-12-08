<?php
include("../config.php");

session_start();
// Si l'utilisateur n'ai pas administrateur, il est redirigé vers la page d'accueil
if ($_SESSION['status'] != "Admin") {
    header("Location: ../failedAccess.php");
}

 // requête pour récupérer la liste des  client qui ont  des  rdv et le nombre de  rdv  par  client
 $queryRDV = "SELECT  users_id,username,logo,rdv_number,Email  from users INNER JOIN (SELECT COUNT(*) as rdv_number,`users_id` FROM `rdv` GROUP BY`users_id`) as R ON users.id=R.users_id;";
 $stmtRDV = $conn->prepare($queryRDV);
 $stmtRDV ->execute();
 $RDVS = $stmtRDV ->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />
    <!--Datatable plugin CSS file -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

    <!--jQuery library file -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js">
    </script>

    <!--Datatable plugin JS library file -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
    </script>
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            /* Height of navbar */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollable contents if viewport is shorter than content. */
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 1rem;
        }

        .pagination a {
            margin: 0 0.5rem;
        }
    </style>
</head>

<body>
    <!-- Main Navigation -->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="./dashboard.php" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
                    </a>
                    <a href="./addCandidats.php" class="list-group-item list-group-item-action py-2 ripple ">
                        <i class="fas fa-user-graduate me-3"></i><span>Ajouter des candidats</span>
                    </a>
                                     <a href="List_rdv.php" class="list-group-item list-group-item-action py-2 ripple active " aria-current="true"><i class="fas fa-lock fa-fw me-3"></i><span>Gérer RDV</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-chart-line fa-fw me-3"></i><span>Analytics</span></a>
                    <a href="./Calendar.php" class="list-group-item list-group-item-action py-2 ripple">
                  <i class="fas fa-calendar fa-fw me-3"></i><span>CALENDRIER</span>
                    </a>
                    
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-globe fa-fw me-3"></i><span>International</span></a>
                    <a href="listeAppels.php" class="list-group-item list-group-item-action py-2 ripple ripple s"><i class="fa-sharp fa-solid fa-list me-3"></i>
                        <span>Liste d'appels</span></a>
                    <a href="./presence.php" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-calendar fa-fw me-3"></i><span>Présence</span></a>
                    <a href="./add_client_admin.php" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-users fa-fw me-3"></i><span>Ajouter client & administrateur</span></a>
                    <a href="../logout.php" class="list-group-item list-group-item-action py-2 ripple"><i class="fa-solid fa-right-from-bracket me-3"></i><span>Logout</span></a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <img src="../images/icon.png" height="25" alt="KJJJ" />
                </a>
                <!-- Search form -->
                <form class="d-none d-md-flex input-group w-auto my-auto">
                    <input autocomplete="off" type="search" class="form-control rounded" placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px" />
                    <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                </form>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!-- Main Navigation -->

    <!-- Main layout -->
    <main style="margin-top: 58px">
        <div class="container pt-4">

            <!-- Section: Sales Performance KPIs -->
            <section class="mb-4">
                <div class="card">
                    <div class="card-header text-center py-3">
                        <h5 class="mb-0 text-center">
                            <strong>List RDV</strong>
                        </h5>


                    </div>
                    <div class="card-body">

                        <table id="example" class="table table-striped nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Logo entreprise</th>
                                    <th>Nom de l'entreprise</th>
                                    <th>nomdre de demande</th>
                                    <th>voir plus</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                     foreach ($RDVS as $RDV) {
                                            echo'       <tr>
                                            <td>';
        
                                               echo"<img src='$RDV[logo]' alt='' style='width: 45px; height: 45px' />";
        
                                           echo' </td>
                                            <td>';
        
       echo$RDV['username'];
        
        echo'</td>
        <td> <h3> <span class="badge badge-primary">';echo$RDV['rdv_number'];echo'</span></h3>';
     
        echo'</td>';
        $url="./mange_rdv.php?users_id=".$RDV["users_id"]."& email=".$RDV["Email"];
        echo"<td> <a  href='$url'><i class='fas fa-angles-right'></i></a></td> ";
        
                                       echo' </tr>';


                                        
                                     }
                                
                                ?>
                         


                            </tbody>
                        </table>
                    </div>
                </div>




            </section>
            <!-- Section: Statistics with subtitles -->

        </div>
    </main>
    <!-- Main layout -->

    <!-- MDB -->
    <script>
        $('#example').DataTable({
            responsive: true
        });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
</body>

</html>