<!-- Ce document va lister tout les appels  -->
<?php
  session_start();
  require('../config.php');
  if ($_SESSION['status'] == "Admin") {
    // Nombre d'appels à afficher par page
    $nombreParPage = 10;

    // Page actuelle, par défaut 1
    $page = isset($_GET['page']) ? $_GET['page'] : 1; 

    // Calcul de l'offset pour la requête SQL
    $offset = ($page - 1) * $nombreParPage;

    // Requête SQL avec LIMIT et OFFSET
    $sql = "SELECT date_enregistrement FROM `appel` GROUP BY `appel`.`date_enregistrement` ORDER BY `appel`.`date_enregistrement` DESC LIMIT $nombreParPage OFFSET $offset";
    $result = $conn->prepare($sql);
    $result->execute();
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

    // Compter le nombre total d'appels
    $sqlCount = "SELECT COUNT(DISTINCT date_enregistrement) as total FROM `appel`";
    $resultCount = $conn->prepare($sqlCount);
    $resultCount->execute();
    $countResult = $resultCount->fetch(PDO::FETCH_ASSOC);
    $totalAppels = $countResult['total'];

    // Calcul du nombre total de pages
    $nombreDePages = ceil($totalAppels / $nombreParPage);
  } else{
    header("location:../index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<head>
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css"
    rel="stylesheet"
    />
        <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css"
    rel="stylesheet"
    />
    <!-- MDB -->
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"
    ></script>
</head>
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

  thead{
    background-color: #2ecc71;
    color: white;
  }
  .feuille{
    margin: 1rem;
    padding: 0; /* pour enlever les marges */
    border: 1px solid rgb(241, 236, 236); 
    width: 100%;
    border-radius: 5px;
    box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
  }
  .feuille h1{
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 2rem;
    width: 100%;
    text-align: center; /* pour centrer le titre */
    padding: 1rem;
    border-bottom: 1px solid rgb(241, 236, 236);
  }
  
  .feuille table{
    width: 100%; /* largeur du tableau à 100% de la div */
  }
  
  .feuille td{
    padding: 5px;
    width: 25%; /*donner une width au td pour que tout soit aligner */
    text-align: center;
  }
  
  .feuille input[type="text"]:disabled{
    border: none !important;
    width: 100%;
    color: black;
    text-align: center;
  }
  
  .feuille input[type="text"]{
    border: 1px solid black!important;
    border-radius: 5px;
    width: 100%;
    color: black;
    text-align: center;
  }
  
  .feuille input[type="checkbox"]{
    width: 100%;
    height: 25px;
  }

  .feuille input[type="checkbox"]:hover{
    cursor: pointer;
  }
  
  .feuille input[type="submit"]{
    width: 100%;
    height: 60px;
    border-radius: 3px;
    border: none;
    background-color: #3ad177;
    color: white;
    padding: 5px;
    box-shadow: #d6e4dc;
  }
  .feuille input[type="submit"]:hover{
    background-color: #d6e4dc;
  }
  .pagination{
    margin: 1rem;
    padding: 0; /* pour enlever les marges */
    width: 100%;
    text-align: center;
    align-items: baseline;
  }
  .pagination a{
    text-decoration: none;
    color: black;
    padding: 5px;
    border-radius: 5px;
  }
  .pagination a:hover{
    background-color: #d6e4dc;
  }
  .pagination a.active{
    background-color: #3ad177;
    color: white;
  }
</style>

<body>
  <!--Main Navigation-->
<header>
    <!-- Sidebar -->
    <nav
    id="sidebarMenu"
    class="collapse d-lg-block sidebar collapse bg-white"
    >
 <div class="position-sticky">
   <div class="list-group list-group-flush mx-3 mt-4">
     <a
        href="./dashboard.php"
        class="list-group-item list-group-item-action py-2 ripple "
      
        >
       <i class="fas fa-tachometer-alt fa-fw me-3"></i
         ><span>Main dashboard</span>
     </a>
     <a
        href="./addCandidats.php"
        class="list-group-item list-group-item-action py-2 ripple  "
       
        >
       <i class="fas fa-user-graduate me-3"></i
         ><span>Ajouter des candidats</span>
     </a>
                                        <a href="List_rdv.php" class="list-group-item list-group-item-action py-2 ripple  " ><i class="fas fa-lock fa-fw me-3"></i><span>Gérer RDV</span></a>
     <a
        href="#"
        class="list-group-item list-group-item-action py-2 ripple"
        ><i class="fas fa-chart-line fa-fw me-3"></i
       ><span>Analytics</span></a
       >
     <a
        href="./Calendar.php"
        class="list-group-item list-group-item-action py-2 ripple"
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
        class="list-group-item list-group-item-action py-2 ripple ripple active"
        ><i class="fa-sharp fa-solid fa-list me-3"></i>
        <span>Liste d'appels</span></a
       >
     <a
        href="./presence.php"
        class="list-group-item list-group-item-action py-2"
        aria-current="true"
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
    <nav
         id="main-navbar"
         class="navbar navbar-expand-lg navbar-light bg-white fixed-top"
         >
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation"
                >
          <i class="fas fa-bars"></i>
        </button>
  
        <!-- Brand -->
        <a class="navbar-brand" href="#">
          <img
               src="../images/icon.png"
               height="25"
               alt="KJJJ"
         
               />
        </a>
        <!-- Search form -->
        <form class="d-none d-md-flex input-group w-auto my-auto">
          <input
                 autocomplete="off"
                 type="search"
                 class="form-control rounded"
                 placeholder='Search (ctrl + "/" to focus)'
                 style="min-width: 225px"
                 />
          <span class="input-group-text border-0"
                ><i class="fas fa-search"></i
            ></span>
        </form>
  
        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <!-- Notification dropdown -->
          <li class="nav-item dropdown">
            <a
               class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow"
               href="#"
               id="navbarDropdownMenuLink"
               role="button"
               data-mdb-toggle="dropdown"
               aria-expanded="false"
               >
              <i class="fas fa-bell"></i>
              <span class="badge rounded-pill badge-notification bg-danger"
                    >1</span
                >
            </a>
            <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="navbarDropdownMenuLink"
                >
              <li><a class="dropdown-item" href="#">Some news</a></li>
              <li><a class="dropdown-item" href="#">Another news</a></li>
              <li>
                <a class="dropdown-item" href="#">Something else here</a>
              </li>
            </ul>
          </li>
  
          <!-- Icon -->
          <li class="nav-item">
            <a class="nav-link me-3 me-lg-0" href="#">
              <i class="fas fa-fill-drip"></i>
            </a>
          </li>
          <!-- Icon -->
          <li class="nav-item me-3 me-lg-0">
            <a class="nav-link" href="#">
              <i class="fab fa-github"></i>
            </a>
          </li>
  
          <!-- Icon dropdown -->
          <li class="nav-item dropdown">
            <a
               class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow"
               href="#"
               id="navbarDropdown"
               role="button"
               data-mdb-toggle="dropdown"
               aria-expanded="false"
               >
              <i class="united kingdom flag m-0"></i>
            </a>
            <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="navbarDropdown"
                >
              <li>
                <a class="dropdown-item" href="#"
                   ><i class="united kingdom flag"></i>English
                  <i class="fa fa-check text-success ms-2"></i
                    ></a>
              </li>
              <li><hr class="dropdown-divider" /></li>
              <li>
                <a class="dropdown-item" href="#"
                   ><i class="poland flag"></i>Polski</a
                  >
              </li>
              <li>
                <a class="dropdown-item" href="#"
                   ><i class="china flag"></i>中文</a
                  >
              </li>
              <li>
                <a class="dropdown-item" href="#"
                   ><i class="japan flag"></i>日本語</a
                  >
              </li>
              <li>
                <a class="dropdown-item" href="#"
                   ><i class="germany flag"></i>Deutsch</a
                  >
              </li>
              <li>
                <a class="dropdown-item" href="#"
                   ><i class="france flag"></i>Français</a
                  >
              </li>
              <li>
                <a class="dropdown-item" href="#"
                   ><i class="spain flag"></i>Español</a
                  >
              </li>
              <li>
                <a class="dropdown-item" href="#"
                   ><i class="russia flag"></i>Русский</a
                  >
              </li>
              <li>
                <a class="dropdown-item" href="#"
                   ><i class="portugal flag"></i>Português</a
                  >
              </li>
            </ul>
          </li>
  
          <!-- Avatar -->
          <li class="nav-item dropdown">
            <a
               class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
               href="#"
               id="navbarDropdownMenuLink"
               role="button"
               data-mdb-toggle="dropdown"
               aria-expanded="false"
               >
              <img
                   src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg"
                   class="rounded-circle"
                   height="22"
                   alt=""
                   loading="lazy"
                   />
            </a>
            <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="navbarDropdownMenuLink"
                >
              <li><a class="dropdown-item" href="#">My profile</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
<!--Main Navigation-->

<!--Main layout-->

<main class="pt-5 mx-lg-5">
  <div class="container-fluid mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="feuille">
          <table>
            <thead>
              <tr>
                <h1>Liste des appels</h1>
              </tr>
            </thead>
            <br>
            <tbody>
              <?php
                foreach ($rows as $row) {
                  $date_enregistrement = $row['date_enregistrement'];
                  $date_Appel = date("d/m/Y", strtotime($date_enregistrement));
                  echo "<tr>";
                  echo "<td> <h3> Appel du <b> <a href='detailsAppel.php?date=".$date_Appel."'>".$date_Appel."</a> </b> </h3> </td>";
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
          
          <!-- Ajout des boutons de navigation -->
          <div class="pagination">
            <?php
              echo "Page:" ;
              for ($i = 1; $i <= $nombreDePages; $i++) {
                echo " <a href='?page=".$i."'>".$i."</a> ";
              }
            ?>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</main>

</body>
