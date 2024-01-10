<?php
include("../config.php");

session_start();
// Si l'utilisateur n'ai pas administrateur, il est redirigé vers la page d'accueil
if ($_SESSION['status'] != "Admin") {
    header("Location: ../failedAccess.php");
}

 // requête pour récupérer la liste des   rdv par client  x avec les  detalle du condidate
 $queryInterview= "SELECT code_profile,nom , prenom ,designation ,phone ,rdv.id as id_rdv,`student_id` FROM `rdv` INNER JOIN student ON rdv.student_id= student.id WHERE rdv.`users_id`=14 ;";
 $stmtInterview = $conn->prepare($queryInterview);
 $stmtInterview ->execute();
 $Interviews = $stmtInterview ->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <base href="/Dashboard_startZupv1/Dashboard_admin/">
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
            border-radius: 5px!important;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%) !important;
            z-index: 2!important;
            color: var(--mdb-list-group-active-color) !important;
            background-color: var(--mdb-list-group-active-bg) !important;
            border-color: var(--mdb-list-group-active-border-color) !important;
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<body>
    <!-- Main Navigation -->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                <a href="/Dashboard_startZupv1/accueil" class="list-group-item list-group-item-action py-2 ripple" aria-current="true"><i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span></a>
                <a href="/Dashboard_startZupv1/ajouter-un-candidat" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-user-graduate me-3"></i><span>Ajouter des candidats</span></a>
                <a href="/Dashboard_startZupv1/ajouter-client-admin" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-users fa-fw me-3"></i><span>Ajouter client & administrateur</span></a>
                <a href="/Dashboard_startZupv1/liste-de-rdv" class="list-group-item list-group-item-action py-2 ripple active"><i class="fas fa-lock fa-fw me-3"></i><span>Gérer RDV</span></a>
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
            
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <?php foreach($Interviews as $Interview){
              echo'<div class="card mb-5" style="border-radius: 15px;">
              <div class="card-body p-4">
              <div class="row">
                <div class="col-2">';
                echo"<button type='button' class='btn btn-lg shadow-lg p-3 mb-5  rounded' style='background-color:#A648C2 ;'> $Interview[code_profile]</button>";
            echo'</div>
            <div class="col">';
           echo" <h3 class='mb-3'> $Interview[nom]   $Interview[prenom]</h3>
            <h6>$Interview[designation]</h6>
            <h6> phone numbre : $Interview[phone]</h6>
            </div>";
            echo'
        </div>
        <!-- row2-->
      
        <div class="row">
           <div class="col-2">
     
           </div>
           <div class="col">
           <!-- Default checkbox -->';
           // SLECT  LES  CRENAUX PROSE PAR  CONDIDAT
           $queryCreneaux= " SELECT * FROM `rdv` INNER JOIN creneaux ON rdv.id=creneaux.id_rdv WHERE `student_id`= $Interview[student_id] &&`users_id`=$_GET[users_id];";
           $stmtCreneaux = $conn->prepare($queryCreneaux);
           $stmtCreneaux ->execute();
           $Creneaux = $stmtCreneaux->fetchAll(PDO::FETCH_ASSOC);
          foreach($Creneaux as $C){

   echo" <form action='validate_rdv.php?code=$Interview[code_profile]&userMail=$_GET[email]&id=$_GET[users_id]' method='post'>

   <div class='form-check'>
      <input class='form-check-input' type='radio' value='$C[id]'  name='creneaux' id='flexCheckDefault' required='required'/>
      <label class='form-check-label' for='flexCheckDefault'>$C[start_event]</label>
    </div>";
    

}
         echo'  </div>
        </div>    
                
               
            
        <button type="submit" class="btn btn-success" data-mdb-ripple-init>valider</button>
        </from>';


        echo"
         <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#staticBackdrop' data-mdb-ripple-init>annuler</button> </div>
            </div>";  
          
            echo'<!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  tu es sur tu veux supprimer le rdv?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>';
                   echo"<a href='delete_rdv.php?id=$Interview[id_rdv]&id_student=$_GET[users_id]' ><button type='button' class='btn btn-primary'>OUI</button></a>";
                 echo' </div>
                </div>
              </div>
            </div>';
        }?>
      
    
      </div>
    </div>
    </div>




            </section>
            <!-- Section: Statistics with subtitles -->

        </div>
    </main>
    <!-- Main layout -->

 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
</body>

</html>