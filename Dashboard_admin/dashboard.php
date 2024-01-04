<?php
  include("../config.php");

  session_start();
  // Si l'utilisateur n'ai pas administrateur, il est redirigé vers la page d'accueil
  if ($_SESSION['status'] != "Admin") {
    header("Location: ../failedAccess.php");
  }

  // Script qui permet d'afficher les étudiants 8 par 8
  $limit = 8;
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $start = ($page - 1) * $limit;

  $query = "SELECT * FROM student LIMIT $start, $limit";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $queryTotal = "SELECT COUNT(*) AS total FROM student";
  $stmtTotal = $conn->prepare($queryTotal);
  $stmtTotal->execute();

  $resultTotal = $stmtTotal->fetch(PDO::FETCH_ASSOC);
  $total = $resultTotal['total'];
  $pages = ceil($total / $limit);

  $Previous = $page - 1;
  $Next = $page + 1;

  // requête pour compter le nombre total d'étudiants
  $queryTotalCandidates = "SELECT COUNT(*) AS totalCandidates FROM student";
  $TotalEtudiants = $conn->prepare($queryTotalCandidates);
  $TotalEtudiants->execute();
  $resultTotalEtudiants = $TotalEtudiants->fetch(PDO::FETCH_ASSOC);
  $length = $resultTotalEtudiants['totalCandidates'];

  // requête pour récupérer la liste des candidats
  $queryEtudiants = "SELECT * FROM student";
  $stmtEtudiants = $conn->prepare($queryEtudiants);
  $stmtEtudiants ->execute();
  // $etudiants = $stmtEtudiants ->fetchAll(PDO::FETCH_ASSOC);

  $etuActif = array_filter($etudiants, function($etudiant) { // on filtre le tableau pour ne garder que les étudiants actifs
    return $etudiant['status'] === "active";
  });
  $etuInactif = array_filter($etudiants, function($etudiant) { // on filtre le tableau pour ne garder que les étudiants inactifs
    return $etudiant['status'] === "not active";
  });

  $nombreActifs = count($etuActif); // on compte le nombre d'étudiants actifs
  $nombreInactifs = count($etuInactif); // on compte le nombre d'étudiants inactifs
  $nombreTotal = count($etudiants); // on compte le nombre total d'étudiants

  $pourcentageActif = ($nombreActifs / $nombreTotal) * 100; // puis on calcule le pourcentage d'étudiants actifs
  $pourcentageActif = round($pourcentageActif, 2); // on arrondi le pourcentage à 2 chiffres après la virgule

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet"/>

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
        padding: 58px 0 0; /* Height of navbar */
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
        overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
    }
    .pagination{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 1rem;
    }
    .pagination a{
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
      <a
          href="./dashboard.php"
          class="list-group-item list-group-item-action py-2 ripple active "
          aria-current="true"
          >
        <i class="fas fa-tachometer-alt fa-fw me-3"></i
          ><span>Main dashboard</span>
      </a>
      <a
          href="./addCandidats.php"
          class="list-group-item list-group-item-action py-2 ripple "
        
          >
        <i class="fas fa-user-graduate me-3"></i
          ><span>Ajouter des candidats</span>
      </a>
      <a
          href="./List_rdv.php"
          class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-lock fa-fw me-3"></i><span>Gérer RDV</span></a
        >
      <a
          href="#"
          class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-chart-line fa-fw me-3"></i
        ><span>Analytics</span></a
        >
        <a
          href="./Calendar.php"
          class="list-group-item list-group-item-action py-2 ripple "
          
          >
          <i class="fas fa-calendar fa-fw me-3"></i><span>CALENDRIER</span>
      </a>
      <a
          href="#"
          class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span></a
        >
      <a
          href="#"
          class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-globe fa-fw me-3"></i
        ><span>International</span></a
        >
        <a
          href="listeAppels.php"
          class="list-group-item list-group-item-action py-2 ripple ripple s"
          ><i class="fa-sharp fa-solid fa-list me-3"></i>
          <span>Liste d'appels</span></a
        >
      <a
          href="./presence.php"
          class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-calendar fa-fw me-3"></i
        ><span>Présence</span></a
        >
      <a
          href="./add_client_admin.php"
          class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-users fa-fw me-3"></i><span>Ajouter client & administrateur</span></a
        >
      <a
      href="../logout.php"
          class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fa-solid fa-right-from-bracket me-3"></i><span>Logout</span></a
        >
    </div>
  </div>
</nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="#">
                <img src="../images/icon.png" height="25" alt="KJJJ"/>
            </a>
            <!-- Search form -->
            <form class="d-none d-md-flex input-group w-auto my-auto">
                <input autocomplete="off" type="search" class="form-control rounded"
                       placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px"/>
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

        <!-- Section: Statistics with subtitles -->
        <section>
            <div class="row" style="display: flex">
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="fas fa-user text-success fa-3x me-4"></i>
                                    </div>
                                    <div>
                                        <h4>Nombre total de candidats</h4>
                                        <p class="mb-0"></p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <?php
                                    echo "<h2 class='h1 mb-0'>$length</h2>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between p-md-1">
                      <div class="d-flex flex-row">
                        <div class="align-self-center">
                          <i class="fas fa-chart-pie text-warning fa-3x me-4"></i>
                        </div>
                        <div>
                          <h4>candidats actifs</h4>
                          <p class="mb-0"></p>
                        </div>
                      </div>
                      <div class="align-self-center">
                        <h2 class="h1 mb-0"><?php echo $pourcentageActif . "%";?></h2>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

          </div>
          </div>
        </section>
        <!-- Section: Main chart -->

        <!-- Section: Sales Performance KPIs -->
        <section class="mb-4">
            <div class="card">
                <div class="card-header text-center py-3">
                    <h5 class="mb-0 text-center">
                        <strong>Liste candidat</strong>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 bg-white">
                            <thead class="bg-light">
                            <tr>
                                <th>Name</th>
                                <th>commentaire</th>
                                <th>Status</th>
                                <th>Promotion</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                              foreach ($etudiants as $etudiant) {
                                  echo "<tr>";
                                  echo "<td>";
                                  echo "<div class='d-flex align-items-center'>";
                                  echo "<img src='$etudiant[avatar]' alt='' style='width: 45px; height: 45px' class='rounded-circle'/>";
                                  echo "<div class='ms-3'>";
                                  echo "<p class='fw-bold mb-1'>$etudiant[prenom] <span></span> $etudiant[nom]</p>";
                                  echo "<p class='text-muted mb-0'>$etudiant[email]</p>";
                                  echo "</div>";
                                  echo "</div>";
                                  echo "</td>";
                                  echo "<td>";
                                  echo "<p class='fw-normal mb-1'>$etudiant[designation]</p>";
                                  echo "<p class='text-muted mb-0'>$etudiant[code_profile]</p>";
                                  echo "</td>";
                                  echo "<td>";
                                  if ($etudiant['status'] == "active") {
                                      echo "<span class='badge badge-success rounded-pill d-inline'>$etudiant[status]</span>";
                                  } else {
                                      echo "<span class='badge badge-secondary rounded-pill d-inline'>$etudiant[status]</span>";
                                  }
                                  echo "</td>";
                                  echo "<td> $etudiant[designation]</td>";
                                  echo "<td>";
                                $url="./profile.php?id=$etudiant[id]";
                                
                                  echo " <a  href='$url'    class='btn btn-link btn-sm btn-rounded'>Voir</a>";

                                  
                                  echo "</td>";
                                  echo "</tr>";
                              }
                            ?>
                            </tbody>
                        </table>
                        <!-- Ajout des boutons de navigation -->
                        <div class="pagination">
                            <?php for ($i = 1; $i <= $pages; $i++): ?>
                                <a href="dashboard.php?page=<?php echo $i; ?>" class="btn btn-info"><?php echo $i; ?></a>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section: Statistics with subtitles -->

    </div>
</main>
<!-- Main layout -->

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
</body>
</html>
