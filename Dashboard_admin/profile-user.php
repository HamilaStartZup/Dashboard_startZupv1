<?php
  ob_start(); // sert à mettre en tampon la sortie

  include("../config.php");

  session_start();
// Si l'utilisateur n'ai pas administrateur, il est redirigé vers la page d'accueil
  if ($_SESSION['status'] != "Admin") {
    header("Location: /Dashboard_startZupv1/acces-echoue");
  }
  
// requête pour récupérer profile Etudiant
  $queryProfilEtudiant = "SELECT * FROM users WHERE id=$_GET[id]";
  $stmtEtudiant = $conn->prepare($queryProfilEtudiant);
  $stmtEtudiant ->execute();
  $etudiant = $stmtEtudiant ->fetchAll(PDO::FETCH_ASSOC);

//profile 
  $Profile =$etudiant[0];

// requête pour récupérer les mobilité
  $queryMobility = "SELECT * FROM villes_france_free 
  INNER JOIN student_mobility ON villes_france_free.ville_id = student_mobility.ville_id
  INNER JOIN student ON student_mobility.student_id = student.id
  WHERE student_id=$_GET[id]";
  $stmtMobility = $conn->prepare($queryMobility);
  $stmtMobility ->execute();
  $mobility = $stmtMobility ->fetchAll(PDO::FETCH_ASSOC);

  // sert à vider le tampon de sortie pour que le refresh lors de la modif de pretEmploi fonctionne
  ob_flush() 
?>
<!DOCTYPE html>
<html lang="en">  
<head>
  <meta charset="UTF-8" />
  <base href="/Dashboard_startZupv1/Dashboard_admin/">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js "></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>

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

    .text-small {
      font-size: 0.9rem;
    }

    .rounded {
      border-radius: 1rem;
    }

    .position-center {
      top: 50%;
      left: 50%;
      transform: translateX(-50%) translateY(-50%);
    }

    a {
      color: inherit;
      text-decoration: none;
    }
    .themeStatutEmployable{
      color: green;
    }
    .themeStatutNonEmployable{
      color: red;
    }
    .colBtnEmploie{
      display: flex;
      align-items: center;
      justify-content: end;
      margin: 5px;
    }
    .colStatutActuel{
      display: flex;
      align-items: center;
      justify-content: end;}
  </style>

</head>


<body>
  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a href="/Dashboard_startZupv1/accueil" class="list-group-item list-group-item-action py-2 ripple" aria-current="true"><i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span></a>
          <a href="/Dashboard_startZupv1/ajouter-un-candidat" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-user-graduate me-3"></i><span>Ajouter des candidats</span></a>
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
  <!--Main Navigation-->

  <!--Main layout-->
  <main   id='Profile' style="margin-top: 58px">
    <div class="container">
      <div class="row">
        <div class="col">
            <!-- Bouton modifier a revoir quand une page de modification de profil user sera créer -->
          <?php 
        //   $url = "./edit-profil.php?id=$Profile[id]";
        //   echo "<a class='btn btn-info' href='$url'>Modifier</a>"
          ?>
        </div>
        <div class="col">
          
        </div>
      </div>
    </div>
    <div class="container pt-4">
   
        <div class="container py-5">
          <div class="row">
            <div class="col-lg-4">
              <div class="card mb-4">
                <div class="card-body text-center">
                  <?php
                    if ($Profile['logo'] == null || $Profile['logo'] == "") {
                      echo "<img src='https://mdbootstrap.com/img/new/avatars/8.jpg' alt='avatar' class='rounded-circle img-fluid' style='width: 150px;'>";
                    } else {
                      echo "<img src='$Profile[logo]' alt='avatar' class='rounded-circle img-fluid' style='width: 150px;'>";
                    }
                  ?>
                  <h5 class="my-3"> <?php echo "$Profile[username]";?> </h5>
                  <p class="text-muted mb-1"> <?php echo "$Profile[lastname]";?> </p>
                  <p class="text-muted mb-4"><?php echo "$Profile[firstname]";?></p>
                  <div class="d-flex justify-content-center mb-2">
                    <button type="button" class="btn btn-primary" onclick="print()">Télécharger le profil</button>

                    <button type="button"  onclick="window.location.href='mailto:<?php echo `$Profile[Email]` ;?>';"class="btn btn-outline-primary ms-1">Envoyer un email</button>
                  </div>
                </div>
              </div>
              <div class="card mb-4 mb-lg-0">
                <div class="card-body p-0">
                  <ul class="list-group list-group-flush rounded-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fas fa-globe fa-lg text-warning"></i>
                      <p class="mb-0">Site internet</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                      <p class="mb-0">Github</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                      <p class="mb-0">Réseau sociaux</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                      <p class="mb-0">Réseau sociaux</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                      <p class="mb-0">Réseau sociaux</p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Nom complet</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"> <?php echo "$Profile[lastname]";?>  <span></span>  <?php echo "$Profile[firstname]";?> </p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"> <?php echo "$Profile[Email]";?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Numero de téléphone</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"> \\\ A ajouter ///</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Commentaire</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"> <?php echo "$Profile[comment]";?> </p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Description</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"> <?php echo "$Profile[description]";?> </p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Date d'inscription</p>
                    </div>
                    <div class="col-sm-9">
                    <?php
                    $date = date("d-m-Y", strtotime($Profile['reg_date']));
                        echo "<p class='text-muted mb-0'> $date </p>";
                    ?>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
      </section>
    </div>
  </main>
  <!--Main layout-->

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
</body>

</html>