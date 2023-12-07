<?php
// Database Connection
include '../config.php';
session_start();

if (!isset($_SESSION['email'])) {
  header("Location: ../failedAccess.php");
}

// Fonction pour récupérer les données des étudiants selon student.code_profile dans l'url
$code_profile = $_GET['code_profile'];
$query = $conn->prepare("SELECT * FROM student WHERE code_profile = '$code_profile'"); // $code_profile est récupéré dans l'url
$query->execute();
$result = $query->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

  <!-- Material Dashboard CSS -->
  <link rel="stylesheet" href="assets/css/material-dashboard?v=2.1.2.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js "></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />



  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css" rel="stylesheet" />
  <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
  <script src="js/bootstrap-datetimepicker.min.js"></script>
  <style>
    body {
      background-color: #fbfbfb;
    }

    @media (min-width: 991.98px) {
      main {
        width: 100%;
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

    ul.timeline-3 {
      list-style-type: none;
      position: relative;
    }

    ul.timeline-3:before {
      content: " ";
      background: #d4d9df;
      display: inline-block;
      position: absolute;
      left: 29px;
      width: 2px;
      height: 100%;
      z-index: 400;
    }

    ul.timeline-3>li {
      margin: 20px 0;
      padding-left: 20px;
    }

    ul.timeline-3>li:before {
      content: " ";
      background: white;
      display: inline-block;
      position: absolute;
      border-radius: 50%;
      border: 3px solid #22c0e8;
      left: 20px;
      width: 20px;
      height: 20px;
      z-index: 400;
    }
  </style>

</head>


<body>
  <!--Main Navigation-->
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
                <a class="nav-link" href="#">Accueil</a>
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
              <img src="https://img.freepik.com/photos-gratuite/icone-profil-utilisateur-recto_187299-39596.jpg?w=826&t=st=1700233197~exp=1700233797~hmac=ecf017b3fc31a8df3b9f1610d6b32041d2d9f7610b1d33ab8664b0e0ec680208" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy" />
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
  <!--Main Navigation-->

  <!--Main layout-->
  <main id='Profile'>
    <div class="container pt-4">

      <div class="container py-5">
        <div class="row">
          <div class="col-lg-4">
            <div class="card mb-4">
              <div class="card-body text-center">
              <?php 
              if( $result['gender']=='femme'){
                echo "<img src='../images/femme.jpg' alt='avatar' style='width: 250px;  border: 2px solid blue;
                padding: 10px;
                border-radius: 50px 20px;'>";
              }else{
                echo "<img src='../images/homme.jpg' alt='avatar' style='width: 250px;border-radius: 25px;'>";
              }
              
              ?>

                <h5 class="my-3">Etudiant : <?php echo $result['code_profile'] ?></h5>
                <p class="text-muted mb-1"><?php echo $result['designation'] ?></p>
                <p class="text-muted mb-4"><b><?php echo $result['ville'] ?></b></p>
                <div class="d-flex justify-content-center mb-2">
                  <button type="button" class="btn btn-primary" onclick="downloadPDF()">Télécharger le profil</button>

                  <button type="button" class="btn btn-outline-primary ms-1" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#exampleModal">obtenir un entretien avec le candidat </button>
                </div>

              </div>
            </div>
            <div class="card mb-4 ">
              <div class="shadow-lg p-3 mb-5 bg-body  rounded">
                <p class="text-muted"><b>PROFIL</b></p>
              </div>
              <div class="card-body ">

                <P> <?php echo $result['description'] ?></P>
              </div>
            </div>
            <!--langues-->
            <div class="card mb-4 ">
              <div class="shadow-lg p-3 mb-5 bg-body  rounded">
                <p class="text-muted"><b>LANGUES</b></p>
              </div>
              <div class="card-body ">
                <ul>

                  <?php
                  //get list of  Languages
                  $queryLanguages = "SELECT * FROM `languages` RIGHT JOIN(SELECT * FROM `language` WHERE `id_student`=$result[id]) as L ON languages.id=L.id_language;";
                  $stmtLanguages = $conn->prepare($queryLanguages);
                  $stmtLanguages->execute();
                  $Languages =  $stmtLanguages->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($Languages as $Language) {
                    echo " <li class='list-group-item d-flex justify-content-between align-items-center'>
                      <span class='badge'><i class='flag flag-$Language[code]'></i> </span>
                      <div class='fw-bold'>$Language[nom_language] :</div> <div class='fw-normal'>$Language[language_level] </div>
                    
                    
                      </li> <br>";
                  }
                  ?>


                </ul>


                <P> </P>
              </div>
            </div>
            <!--langues end-->
          </div>
          <div class="col-lg-8">
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Code étudiant</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $result['code_profile'] ?></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Véhiculé</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $result['Vehicule'] ?></p>
                  </div>
                </div>


                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Disponibilité</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"> <?php echo $result['disponibility'] ?><b></b></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Mobilité</p>
                  </div>
                  <div class="col-sm-9">
                    <?php
                    // recuperation mobilite 
                    $queryMobility = "SELECT * FROM `villes_france_free` RIGHT JOIN (SELECT * FROM `student_mobility` WHERE `student_id`=113) as mo ON mo.id=villes_france_free.ville_id";
                    $stmtMobility = $conn->prepare($queryMobility);
                    $stmtMobility->execute();
                    $Mobility =  $stmtMobility->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($Mobility as $ville) {
                      echo "                  <label class='form-label' for='textAreaExample'><b>$ville[ville_code_postal]</b>_$ville[ville_nom]</label>  <span>&ensp;</span>; <span>&ensp;</span>";
                    }
                    ?>




                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="card mb-4 mb-md-0">
                  <div class="card-body">
                    <p class="mb-4"><b> COMPÉTENCES & LOGICIELS </b> </p>
                    </p>
                    <?php
                    //récupération des compétences du candidat 
                    $querySkills = "SELECT * FROM `skills` RIGHT JOIN (SELECT `value_skills`,`id_skills` FROM `student_skills` WHERE `id_student`= $result[id]) as t ON skills.id=t.id_skills;   ";
                    $stmtSkills = $conn->prepare($querySkills);
                    $stmtSkills->execute();
                    $Skills =  $stmtSkills->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($Skills as $x) {
                      $skill = $x["nom_skills"];
                      $valueSkill = $x["value_skills"];
                      if ($valueSkill != 0) {
                        echo "<p class='mb-1' style='font-size: .77rem;'>$skill</p>
   
    <div class='progress   rounded'  style='height: 25px;'>
    <div class='progress-bar' role='progressbar' style='width:$valueSkill%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$valueSkill%</div>
 
    </div>";
                      }
                    }
                    ?>



                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card mb-4 mb-md-0">
                  <h5 class="card-header shadow-inner">Compétences générales</h5>
                  <div class="card-body">
                    <ul>
                      <?php
                      // recuperation CENTRES D'INTERET
                      $querySkills = "SELECT * FROM `soft_skills` RIGHT JOIN (SELECT * FROM `student_soft_skills` WHERE `student_id`=113) as SF ON soft_skills.id=SF.soft_skills_id;";
                      $stmtSkills = $conn->prepare($querySkills);
                      $stmtSkills->execute();
                      $Skills =  $stmtSkills->fetchAll(PDO::FETCH_ASSOC);

                      foreach ($Skills as $Skill) {
                        echo " <li>
            <p class='card-text'>$Skill[soft_skills_name]</p>
            </li>";
                      }
                      ?>


                    </ul>

                  </div>
                </div>

              </div>

            </div>
            <!-- end time line -->
            <div class="row" style='margin-top: 5%;'>
              <!-- parcours de formation -->

              <div class="card">
                <div class="card-body">
                  <div class="container my-5">
                    <div class="row">
                      <div class="col-md-6 offset-md-3">
                        <h4 style="margin-left: 1.2rem;">FORMATION</h4>
                        <ul class="timeline-3">
                          <?php $queryFormations = "SELECT * FROM `formation` RIGHT JOIN (SELECT * FROM `student_formation` WHERE `student_id`=113) as F ON formation.id=F.formation_id ORDER BY `F`.`start_date` DESC";
                          $stmtFormations = $conn->prepare($queryFormations);
                          $stmtFormations->execute();
                          $Formations =  $stmtFormations->fetchAll(PDO::FETCH_ASSOC);

                          foreach ($Formations as $Formation) {
                            echo " <li>
            <a href='#!'>$Formation[nom_formation]</a><br>
            <a href='#!' class='float-end'>$Formation[start_date], $Formation[end_date]</a><br>
            <p class='mt-2'>$Formation[description]</p>
          </li>";
                          } ?>





                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <!-- end time line -->

            <!--CENTRES D'INTERET-->
            <div class="row" style='margin-top: 5%;'>
              <div class="card">
                <h5 class="card-header">CENTRES D'INTERET</h5>
                <div class="card-body">
                  <ul>
                    <?php
                    // recuperation CENTRES D'INTERET
                    $queryHobbies = "SELECT * FROM `hobbies` WHERE `id_student`=$result[id]";
                    $stmtHobbies = $conn->prepare($queryHobbies);
                    $stmtHobbies->execute();
                    $Hobbies =  $stmtHobbies->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($Hobbies as $Hobbie) {
                      echo " <li>
            <p class='card-text'>$Hobbie[hobbies_name]</p>
            </li>";
                    }
                    ?>


                  </ul>

                </div>
              </div>
            </div>
            <!-- end CENTRES D'INTERET-->
          </div>
        </div>
        </section>
      </div>
      <!-- model obtenir un entretien avec le candidat -->
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="connect_condidat.php?code_profile=<?php echo $result['code_profile'] ?>" method='post'>
                <label>Select Date: </label>
                <label for="c1">Choose a time for your appointment:</label>
                <ul class="list-group list-group-light">
                  <li class="list-group-item">
                    <label class="form-label" for="form12">Example label c1</label> <span></span> <input type="datetime-local"  name="C1" value=""  required/>
                  </li>

                  <li class="list-group-item">
                    <label class="form-label" for="form12">Example label C1</label> <span></span> <input type="datetime-local" name="C2" value="" required/>
                  </li>
                  <li class="list-group-item">
                    <label class="form-label" for="form12">Example label C1</label> <span></span>
                    <input type="datetime-local" name="C3" value="" required />
                  </li>

                </ul>






            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" data-mdb-ripple-init value='<?php echo $result['id'] ?>' name='condidatId'>Save changes</button>
              </form>
            </div>
          </div>
        </div>
      </div>
  </main>
  <!--Main layout-->

  <!-- MDB -->


  <script>
    var docPDF = new jsPDF();

    function downloadPDF() {
      var elementHTML = document.getElementById("Profile");

      html2canvas(elementHTML).then(function(canvas) {
        var imgData = canvas.toDataURL('image/png');
        docPDF.addImage(imgData, 'PNG', 15, 15, 180, 180);

        //  Sauvegarder le fichier PDF
        docPDF.save('profil_<?php echo $result['code_profile'] ?>.pdf');
      });
    }


    //bar
  </script>
  <script>
    window.jsPDF = window.jspdf.jsPDF;
    var docPDF = new jsPDF();

    function print() {
      var elementHTML = document.querySelector("#Profile");
      docPDF.html(elementHTML, {
        callback: function(docPDF) {
          docPDF.save('HTML Linuxhint web page.pdf');
        },
        x: 15,
        y: 15,
        width: 100,
        windowWidth: 100


      });
    }
  </script>
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.umd.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
</body>


</html>