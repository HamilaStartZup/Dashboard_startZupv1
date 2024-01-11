<?php
  include("../config.php");

  session_start();
  // Si l'utilisateur n'ai pas administrateur, il est redirigé vers la page d'accueil
  if ($_SESSION['status'] != "Admin") {
    header("Location: /Dashboard_startZupv1/acces-echoue");
  }

  // requête pour compter le nombre total d'étudiants

  // requête pour récupérer la liste des candidats
  $queryUsers = "SELECT * FROM users";
  $stmtUsers = $conn->prepare($queryUsers);
  $stmtUsers ->execute();
  $Users = $stmtUsers ->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<base href="/Dashboard_startZupv1/Dashboard_admin/">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet"/>
      <!-- Style CSS -->
      <link rel="stylesheet" href="./css/style.css">
    
      <!-- Material Icons -->
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>


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
  </style>
</head>

<body>
<!-- Main Navigation -->
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a href="/Dashboard_startZupv1/accueil" class="list-group-item list-group-item-action py-2 ripple" aria-current="true"><i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span></a>
          <a href="/Dashboard_startZupv1/ajouter-un-candidat" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-user-graduate me-3"></i><span>Ajouter des candidats</span></a>
          <a href="/Dashboard_startZupv1/ajouter-client-admin" class="list-group-item list-group-item-action py-2 ripple active"><i class="fas fa-users fa-fw me-3"></i><span>Ajouter client & administrateur</span></a>
          <a href="/Dashboard_startZupv1/liste-de-rdv" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-lock fa-fw me-3"></i><span>Gérer RDV</span></a>
          <a href="/Dashboard_startZupv1/calendrier" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-calendar fa-fw me-3"></i><span>CALENDRIER</span></a>
          <a href="/Dashboard_startZupv1/ajouter-un-skill" class="list-group-item list-group-item-action py-2 ripple"><i class="fa-solid fa-brain me-3"></i><span>Ajouter un skill</span></a>
          <a href="/Dashboard_startZupv1/liste-des-appels" class="list-group-item list-group-item-action py-2 ripple ripple s"><i class="fa-sharp fa-solid fa-list me-3"></i><span>Liste d'appels</span></a>
          <a href="/Dashboard_startZupv1/appel" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-calendar fa-fw me-3"></i><span>Présence</span></a>
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-chart-line fa-fw me-3"></i><span>Futur lien...</span></a>
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-chart-bar fa-fw me-3"></i><span>Futur lien...</span></a>
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

        <!-- Section: Sales Performance KPIs -->
        <section class="mb-4">
            <div class="card">
                <div class="card-header text-center py-3">
                    <h5 class="mb-0 text-center">
                        <strong>List Users</strong>
                    </h5>
                    <div class="input-group">
                      <div class="form-outline">
                        <form method="GET" action="" class="d-none d-md-flex input-group w-auto my-auto form-outline">
                          <input type="search" id="searchProfil" name="searchProfil" class="form-control" />
                          <label class="form-label" for="searchProfil">Search</label>
                        </div>
                        <button type="submit" class="btn btn-primary">
                          <i class="fas fa-search"></i>
                        </button>
                      </form>
                    </div>
                    
                  </div>
                  <div class="card-body">
                    
                    <div class="table-responsive">
                      <table class="table align-middle mb-0 bg-white">
                        <thead class="bg-light">
                          <tr>
                            <th>Name</th>
                            <th>description</th>
                            <th>Status</th>
                            <th>commentaire</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                              $UsersSearch = array(); 

                              if (isset($_GET['searchProfil']) && !empty($_GET['searchProfil'])) {
                                $searchProfil = $_GET['searchProfil'];
                                $queryUsers = "SELECT * FROM users WHERE firstname LIKE :searchProfil OR lastname LIKE :searchProfil OR Email LIKE :searchProfil";  
                                $stmtUsers = $conn->prepare($queryUsers);
                                $stmtUsers->bindParam(':searchProfil', $searchProfil, PDO::PARAM_STR);
                                $stmtUsers->execute();
                                $UsersSearch = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
                              } else {
                                $queryUsers = "SELECT * FROM users";
                                $stmtUsers = $conn->prepare($queryUsers);
                                $stmtUsers->execute();
                                $UsersSearch = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
                              }
                            
                                foreach ($UsersSearch as $user) {
                                  echo "<tr>";
                                  echo "<td>";
                                  echo "<div class='d-flex align-items-center'>";
                                  if ($user['logo'] != null) {
                                      echo "<img src='$user[logo]' alt='' style='width: 45px; height: 45px' class='rounded-circle'/>";
                                    } else {
                                      echo "<img src='https://mdbootstrap.com/img/new/avatars/8.jpg' alt='' style='width: 45px; height: 45px' class='rounded-circle'/>";
                                  }
                                  echo "<div class='ms-3'>";
                                  echo "<p class='fw-bold mb-1'>$user[lastname] <span></span> $user[firstname]</p>";
                                  echo "<p class='text-muted mb-0'>$user[Email]</p>";
                                  echo "</div>";
                                  echo "</div>";
                                  echo "</td>";
                                
                                  echo "<td> $user[description]</td>";
                               
                                  echo "<td>";
                                  if ($user['status'] == "Admin") {
                                      echo "<span class='badge badge-success rounded-pill d-inline'>$user[status]</span>";
                                  } else {
                                      echo "<span class='badge badge-secondary rounded-pill d-inline'>$user[status]</span>";
                                  }
                                  echo "</td>";
                                  echo "<td> $user[comment]</td>";
                                  echo "<td>";
                                  $url="/Dashboard_startZupv1/client-$user[id]";
                                
                                  echo " <a  href='$url'    class='btn btn-link btn-sm btn-rounded'>Voir</a>";

                                  
                                  echo "</td>";
                                  echo "</tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="fab-container">
  <div class="fab shadow">
    <div class="fab-content">
    <span class="material-icons">
group_add
</span>
    </div>
  </div>
  <div class="sub-button shadow" >
    
  <a class="text-white"  data-mdb-toggle="modal" data-mdb-target="#AdminModal" href="#" >Admin</a>
  
  </div>
  <div class="sub-button  shadow">
  <a class="text-white"  data-mdb-toggle="modal" data-mdb-target="#ClientModal" href="#" >Client</a>
  </div>


</div>

<!-- Modal  Admin-->
<div class="modal fade" id="AdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter un administrateur à notre équipe</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> <form  action="./Ajouter_admin_DB.php" method="post"    class="mx-1 mx-md-4">

<div class="d-flex flex-row align-items-center mb-4">
  <i class="fas fa-user fa-lg me-3 fa-fw"></i>
  <div class="form-outline flex-fill mb-0">
    <input type="text" id="form3Example1c" name="nomClient" class="form-control" />
    <label class="form-label" for="form3Example1c">Your Name</label>
  </div>
</div>

<div class="d-flex flex-row align-items-center mb-4">
  <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
  <div class="form-outline flex-fill mb-0">
    <input type="email" id="form3Example3c" name="emailClient" class="form-control" />
    <label class="form-label" for="form3Example3c">Your Email</label>
  </div>
</div>
<div class="d-flex flex-row align-items-center mb-4">
  <i class="fas fa-sticky-note fa-lg me-3 fa-fw"></i>
  <div class="form-outline flex-fill mb-0">
    <input type="text" id="form4Example4c"  name="descriptionClient" class="form-control" />
    <label class="form-label" for="form3Example3c">des</label>
  </div>
</div>
<div class="d-flex flex-row align-items-center mb-4">
  <i class="fas fa-file-alt fa-lg me-3 fa-fw"></i>
  <div class="form-outline flex-fill mb-0">
    <input type="textarea" id="form5Example5c" name="comentaireClient" class="form-control" />
    <label class="form-label" for="form3Example3c">commentaire</label>
  </div>
</div>
<div class="d-flex flex-row align-items-center mb-4">
  <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
  <div class="form-outline flex-fill mb-0">
    <input type="password" id="pass"  name='passwordClient' class="form-control" />
    <label class="form-label" for="form3Example4c">Password</label>
  </div>
</div>

<div class="d-flex flex-row align-items-center mb-4">
  <i class="fas fa-key fa-lg me-3 fa-fw"></i>
  <div class="form-outline flex-fill mb-0">
    <input type="password" id="confirm_pass" class="form-control" onkeyup="validate_password()" />
    <label class="form-label" for="form3Example4cd">Repeat your password</label>
  </div>
</div>

<span id="wrong_pass_alert"></span>





</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
<button type="submit" id="create"  onclick="wrong_pass_alert()" class="btn btn-primary">Ajouter</button>
</div>
</form>
      <!-- -->
    </div>
  </div>
</div>
<!-- Modal Client -->
<div class="modal fade" id="ClientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter un compte  client</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form  action="./Ajouter_client_DB.php" method="post"    class="mx-1 mx-md-4" enctype="multipart/form-data">
                  <div class="d-flex flex-row align-items-center mb-4"> 
                    <i class="far fa-image fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="file" class="form-control" id="logoClient" name="logoClient">
                      <label class="form-label" for="form3Example1c"><i class="fas fa-download"></i> Importer un logo</label>
                    </div>
                  </div>

                  <style>
                    #logoClient{
                      opacity: 0;
                      z-index: -1;
                    }
                    label{
                      cursor: pointer;
                    }
                  </style>

                  <div class="d-flex flex-row align-items-center mb-4"> 
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" name="nomClient" class="form-control" />
                      <label class="form-label" for="form3Example1c">Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" name="emailClient" class="form-control" />
                      <label class="form-label" for="form3Example3c">Your Email</label>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-sticky-note fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form4Example4c"  name="descriptionClient" class="form-control" />
                      <label class="form-label" for="form3Example3c">des</label>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-file-alt fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="textarea" id="form5Example5c" name="comentaireClient" class="form-control" />
                      <label class="form-label" for="form3Example3c">commentaire</label>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="pass"  name='passwordClient' class="form-control" />
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="confirm_pass" class="form-control" onkeyup="validate_password()" />
                      <label class="form-label" for="form3Example4cd">Repeat your password</label>
                    </div>
                  </div>

                  <span id="wrong_pass_alert"></span>
   
              

               

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
        <button type="submit" id="create"  onclick="wrong_pass_alert()" class="btn btn-primary">Ajouter</button>
      </div>
      </form>
    </div>
  </div>
</div>
        </section>
        <!-- Section: Statistics with subtitles -->

    </div>
</main>
<!-- Main layout -->

<!-- MDB -->
<script>
        function validate_password() {
 
            var pass = document.getElementById('pass').value;
            var confirm_pass = document.getElementById('confirm_pass').value;
            if (pass != confirm_pass) {
                document.getElementById('wrong_pass_alert').style.color = 'red';
                document.getElementById('wrong_pass_alert').innerHTML
                    = '☒ Use same password';
                document.getElementById('create').disabled = true;
                document.getElementById('create').style.opacity = (0.4);
            } else {
                document.getElementById('wrong_pass_alert').style.color = 'green';
                document.getElementById('wrong_pass_alert').innerHTML =
                    '🗹 Password Matched';
                document.getElementById('create').disabled = false;
                document.getElementById('create').style.opacity = (1);
            }
        }
 
        function wrong_pass_alert() {
            if (document.getElementById('pass').value != "" &&
                document.getElementById('confirm_pass').value != "") {
               
            } else {
                alert("Veuillez remplir tous les champs");
            }
        }
    </script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
</body>
</html>
