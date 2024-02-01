<?php
session_start();
// Database Connection
include '../config.php';

if (!isset($_SESSION['email'])) {
  header("Location: ../index.php");
}

$queryFavorites = "SELECT * FROM `student` WHERE `id` IN (SELECT `id_candidate` FROM `favorites_profil` WHERE `id_client`=$_SESSION[id])";
$stmtFavorites = $conn->prepare($queryFavorites);
$stmtFavorites->execute();
$Favorites = $stmtFavorites->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <base href="/Dashboard_startZupv1/Dashboard_client/">
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

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/3181ebab68.js" crossorigin="anonymous"></script>

  <!-- FONT (OPTIONAL) -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Saira+Semi+Condensed:300,400,700" />
  <style>
    body {
      background-color: #fbfbfb;
      overflow-x: hidden;
    }

    .title-page {
      padding: 2rem;
      width: 90%;
      margin: 0 auto;
      justify-content: center;
      background-color: #fff;
      margin-top: 2rem;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

    /* css card fifa */
    .btn-fav-student {
      border: none;
      background-color: transparent;
      font-size: 1.5rem;
    }

    .btn-fav-student:focus {
      outline: none;
      box-shadow: none;
    }

    .fut-player-card {
      cursor: pointer;
      margin: 20px;
      position: relative;
      width: 300px;
      height: 485px;
      background-image: url(https://selimdoyranli.com/cdn/fut-player-card/img/card_bg.png);
      background-position: center center;
      background-size: 100% 100%;
      background-repeat: no-repeat;
      padding: 3.8rem 0;
      z-index: 2;
      -webkit-transition: 200ms ease-in;
      -o-transition: 200ms ease-in;
      transition: 200ms ease-in;
    }

    .fut-player-card:hover {
      -webkit-transform: scale(1.05);
      -ms-transform: scale(1.05);
      transform: scale(1.05);
      z-index: 3;
    }

    .fut-player-card .player-card-top {
      position: relative;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      color: #e9cc74;
      padding: 0 1.5rem;
      /* height: 100px; */
    }

    .fut-player-card .player-card-top .player-master-info {
      /* position: absolute; */
      line-height: 2.2rem;
      font-weight: 300;
      padding: 1.5rem 0;
      text-transform: uppercase;
    }

    .fut-player-card .player-card-top .player-master-info .player-rating {
      font-size: 2rem;
    }

    .fut-player-card .player-card-top .player-master-info .player-position {
      font-size: 1.4rem;
    }

    .fut-player-card .player-card-top .player-master-info .player-nation {
      display: block;
      width: 2rem;
      height: 25px;
      margin: 0.3rem 0;
    }

    .fut-player-card .player-card-top .player-master-info .player-nation img {
      width: 100%;
      height: 100%;
      -o-object-fit: contain;
      object-fit: contain;
    }

    .fut-player-card .player-card-top .player-master-info .player-club {
      display: block;
      width: 2.1rem;
      height: 40px;
    }

    .fut-player-card .player-card-top .player-master-info .player-club img {
      width: 100%;
      height: 100%;
      -o-object-fit: contain;
      object-fit: contain;
    }

    .fut-player-card .player-card-top .player-picture {
      width: 200px;
      margin: 0 auto;
      overflow: hidden;
    }

    .fut-player-card .player-card-top .player-picture img {
      width: 100%;
      height: 100%;
      -o-object-fit: contain;
      object-fit: contain;
      position: relative;
      right: -1rem;
      bottom: 0;
    }

    .fut-player-card .player-card-top .player-picture .player-extra {
      position: absolute;
      right: 0;
      bottom: -0.5rem;
      overflow: hidden;
      font-size: 1rem;
      font-weight: 700;
      text-transform: uppercase;
      width: 100%;
      height: 2rem;
      padding: 0 1.5rem;
      text-align: right;
      background: none;
    }

    .fut-player-card .player-card-top .player-picture .player-extra span {
      margin-left: 0.6rem;
      text-shadow: 2px 2px #333;
    }

    .fut-player-card .player-card-bottom {
      position: relative;
    }

    .fut-player-card .player-card-bottom .player-info {
      display: block;
      padding: 0.3rem 0;
      color: #e9cc74;
      width: 90%;
      margin: 0 auto;
      height: auto;
      position: relative;
      z-index: 2;
    }

    .fut-player-card .player-card-bottom .player-info .player-name {
      width: 100%;
      display: block;
      text-align: center;
      font-size: 1.6rem;
      text-transform: uppercase;
      border-bottom: 2px solid rgba(233, 204, 116, 0.1);
      padding-bottom: 0.3rem;
      overflow: hidden;
    }

    #code-etu {
      font-size: 0.7rem;

    }

    .fut-player-card .player-card-bottom .player-info .player-name span {
      display: block;
      text-shadow: 2px 2px #111;
    }

    .fut-player-card .player-card-bottom .player-info .player-features {
      height: 75px !important;
      margin: 0.5rem auto;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      align-items: center;
      justify-content: space-around;
    }

    .fut-player-card .player-card-bottom .player-info .player-features .player-features-col {
      width: 130px !important;
      height: 100%;
      margin: 0 0.5rem;
      /* border-right: 2px solid rgba(233, 204, 116, 0.1); */
    }

    .barre-features-col {
      width: 2px !important;
      height: 100%;
      background-color: rgba(233, 204, 116, 0.1);
    }

    .fut-player-card .player-card-bottom .player-info .player-features .player-features-col span {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      font-size: 1.2rem;
      text-transform: uppercase;
    }

    .fut-player-card .player-card-bottom .player-info .player-features .player-features-col span .player-feature-value {
      margin-right: 0.3rem;
      font-weight: 700;
    }

    .fut-player-card .player-card-bottom .player-info .player-features .player-features-col span .player-feature-title {
      font-weight: 300;
    }

    .fut-player-card .player-card-bottom .player-info .player-features .player-features-col:last-child {
      border: 0;
    }

    .fut-player-card a {
      text-decoration: none;
      color: #e9cc74;
    }

    .skills-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
    }

    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 1rem;
    }

    .pagination a {
      background-color: #e7d696;
      color: #1a160c;
      border: none;
      margin: 0 0.5rem 2rem 0.5rem;
      /* sens: haut et bas, gauche et droite */
    }

    .pagination a:hover {
      background-color: #1a160c;
      color: #e7d696;
    }

    .pagination a:active {
      background-color: #e7d696 !important;
      color: #1a160c !important;
    }

    .pagination a:focus {
      background-color: #1a160c;
      color: #e7d696;
      box-shadow: none;
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
                <a class="nav-link" href="/Dashboard_startZupv1/home">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/Dashboard_startZupv1/les-stagiaires"> Les
                  stagiaires</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/Dashboard_startZupv1/favoris">List
                  des favoris</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/Dashboard_startZupv1/votre-calendrier">Calendrier</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/Dashboard_startZupv1/contact">Contact</a>
              </li>
              <?php if ($_SESSION['status'] == 'Admin') { ?>
                  <li class="nav-item">
                    <a class="nav-link btn btn-warning text-white"
                      href="/Dashboard_startZupv1/accueil">Dashboard Admin</a>
                  </li>
                <?php } ?>
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
    <!-- <div class="title-page">
      <h1>Liste de vos étudiants favoris</h1>
    </div> -->

    <div class="container-fluid" style="margin-top: 8px;">
      <div class="card">
        <div class="card-body">
          <center>
            Liste de vos étudiants favoris
            <center>
        </center></center></div>
      </div>
    </div>

    <div style="margin-top: 2rem; padding: 2rem; justify-content: center;" class="row">
      <?php foreach ($Favorites as $row) {
        echo '<div class="fut-player-card">
            <a href="/Dashboard_startZupv1/profil-' . $row['code_profile'] . '">
            <div class="player-card-top">
              <div class="player-master-info">
                <div class="player-rating">
                  <span>97</span>
                </div>
                <div class="player-position">
                  <span></span>
                </div>';
              //get list of  Languages
              $queryLanguages = "SELECT * FROM `languages` RIGHT JOIN(SELECT * FROM `student_languages` WHERE `id_student`=$row[id]) as L ON languages.id=L.id_language;";
              $stmtLanguages = $conn->prepare($queryLanguages);
              $stmtLanguages->execute();
              $Languages =  $stmtLanguages->fetchAll(PDO::FETCH_ASSOC);

              foreach ($Languages as $Language) {
                echo '<div class="player-nation">
                  <img src="'.$Language["flag"].'" alt="" draggable="false"/>
                </div>';
              };
              echo '</div>
              <div class="player-picture">';
        if ($row['gender'] == "homme") {
          echo '<img src="../images/homme-bg-remove.png" alt="avatar" draggable="false"/>';
        } else {
          echo '<img src="../images/femme-bg-remove.png" alt="avatar" draggable="false"/>';
        }
        echo '<div class="player-extra">
                  <span></span>
                  <span></span>
                </div>
              </div>
              <div class="player-master-info">
                <div class="player-rating">
                  <span>';
        //TEST Favorites EXIST
        $condidatId = $row['id'];
        $query = $conn->prepare("SELECT `id_client`,`id_candidate` FROM `favorites_profil` WHERE `id_client`=$_SESSION[id] AND `id_candidate`=$condidatId");
        $query->execute();
        $Favorites = $query->fetch();
        if ($Favorites) {
          echo "<form action='./removeFavorites.php' method='POST'><button title='Retirer des favoris' id='starButton' type='submit' class='btn btn-fav-student fav' value='$condidatId' name='condidatId'><i class='fas fa-star' style='color: #ffdd00;'></i></button></form>";
        } else {
          echo "<form action='./addFavorites.php' method='POST'><button title='Mettre en favori' type='submit'  id='starButton' class='btn btn-fav-student not-fav' value='$condidatId' name='condidatId'><i class='far fa-star' style='color: #ffdd00;'></i></button></form>";
        }
        echo '</span>
                </div>
              </div>
            </div>
            <div class="player-card-bottom">
              <div class="player-info">
                <!-- Player Name-->
                <div class="player-name">
                  <span>' . $row["code_profile"] . '</span>
                  <small id="code-etu">' . $row["designation"] . '</small>
                </div>
                <!-- Player Features-->';
        //récupérer les compétence de candidat
        $querySkills = "SELECT skills.`nom_skills`, student_skills.`value_skills`
                                FROM `skills`
                                INNER JOIN `student_skills` ON skills.`id` = student_skills.`id_skills`
                                WHERE student_skills.`id_student` = $row[id]
                                ORDER BY student_skills.`value_skills` DESC";
        $stmtSkills = $conn->prepare($querySkills);
        $stmtSkills->execute();
        $Skills =  $stmtSkills->fetchAll(PDO::FETCH_ASSOC);
        echo '<div class="player-features">
                  <div class="player-features-col">';
        // Les 3 premières compétences
        $numSkills = count($Skills);
        for ($i = 0; $i < min(3, $numSkills); $i++) {
          echo '<span>
                        <div class="player-feature-value">' . $Skills[$i]["value_skills"] . '</div>
                        <div class="player-feature-title">' . $Skills[$i]["nom_skills"] . '</div>
                      </span>';
        };
        echo '</div>
                    <div class="barre-features-col">
                    </div>
                  <div class="player-features-col">';
        for ($i = 3; $i < min(6, $numSkills); $i++) {
          echo '<span>
                        <div class="player-feature-value">' . $Skills[$i]["value_skills"] . '</div>
                        <div class="player-feature-title">' . $Skills[$i]["nom_skills"] . '</div>
                      </span>';
        };
        $querySoftSkills = "SELECT *
                                    FROM soft_skills
                                    JOIN student_soft_skills ON soft_skills.id = student_soft_skills.soft_skills_id
                                    JOIN student ON student.id = student_soft_skills.student_id
                                    WHERE student.id = $row[id]";
        $stmtSoftSkills = $conn->prepare($querySoftSkills);
        $stmtSoftSkills->execute();
        $SoftSkills =  $stmtSoftSkills->fetchAll(PDO::FETCH_ASSOC);

        if ($SoftSkills == null) {
          $SoftSkills = array(
            array(
              "nom_soft_skills" => "Aucune compétence soft",
              "value_skills" => 0
            )
          );
        }
        foreach ($SoftSkills as $softSkill) {
          $moyenneSoftSkills = 0;
          $total = 0;
          $total += $softSkill["value_skills"];
          $diviseur = count($SoftSkills);
          $moyenneSoftSkills = $total / $diviseur;
        }
        echo '<span>
                      <div class="player-feature-value">' . $moyenneSoftSkills . '</div>
                      <div class="player-feature-title">SOFT</div>
                    </span>
                  </div>
                </div>
                <div class="disponibilite" style="display: flex; justify-content: center;">';
        if ($row["disponibility"] > date("Y-m-d")) {
          $Disponibility = date("d-m-Y", strtotime($row["disponibility"]));
          echo '<button type="submit" class="btn btn-dispo-student" value="" name="condidatId" style="background-color: #F38D68; font-size: 0.8rem; font-weight: 600; border-radius: 5px; border: none; margin-top: 0.5rem;">' . $Disponibility . '</button>';
        } else {
          $Disponibility = 'Disponible';
          echo '<button type="submit" class="btn btn-dispo-student" value="" name="condidatId" style="background-color: #D4DF9E; font-size: 0.8rem; font-weight: 600; border-radius: 5px; border: none; margin-top: 0.5rem;">' . $Disponibility . '</button>';
        }
        echo '</div>
              </div>
            </div>
            </a>
            </div>';
      } ?>
    </div>
  </main>
</body>

</html>