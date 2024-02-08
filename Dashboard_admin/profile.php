<?php
  ob_start(); // sert à mettre en tampon la sortie

  include("../config.php");

  session_start();
  // Si l'utilisateur n'ai pas administrateur, il est redirigé vers la page d'accueil
  if ($_SESSION['status'] != "Admin") {
    header("Location: /Dashboard_startZupv1/acces-echoue");
  }
  
// requête pour récupérer profile Etudiant
  $queryProfilEtudiant = "SELECT * FROM student WHERE id=$_GET[id]";
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
      margin: 0;
      font-size: large;
    }
    .themeStatutNonEmployable{
      color: red;
      margin: 0;
      font-size: large;
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
          <a href="/Dashboard_startZupv1/accueil" class="list-group-item list-group-item-action py-2 ripple active" aria-current="true"><i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span></a>
          <a href="/Dashboard_startZupv1/ajouter-un-candidat" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-user-graduate me-3"></i><span>Ajouter des candidats</span></a>
          <a href="/Dashboard_startZupv1/ajouter-client-admin" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-users fa-fw me-3"></i><span>Ajouter client & administrateur</span></a>
          <a href="/Dashboard_startZupv1/liste-de-rdv" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-lock fa-fw me-3"></i><span>Gérer RDV</span></a>
          <a href="/Dashboard_startZupv1/calendrier" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-calendar fa-fw me-3"></i><span>CALENDRIER</span></a>
          <a href="/Dashboard_startZupv1/ajouter-un-skill" class="list-group-item list-group-item-action py-2 ripple"><i class="fa-solid fa-brain me-3"></i><span>Ajouter un skill</span></a>
          <a href="/Dashboard_startZupv1/liste-des-appels" class="list-group-item list-group-item-action py-2 ripple ripple s"><i class="fa-sharp fa-solid fa-list me-3"></i><span>Liste d'appels</span></a>
          <a href="/Dashboard_startZupv1/appel" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-calendar fa-fw me-3"></i><span>Présence</span></a>
          <a href="/Dashboard_startZupv1/ajouter-une-langue" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-chart-line fa-fw me-3"></i><span>Ajouter une langue</span></a>
          <a href="/Dashboard_startZupv1/ajouter-une-promotion" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-chart-bar fa-fw me-3"></i><span>Ajouter une promotion</span></a>
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
            <?php if ($_SESSION['status'] === "Admin") : ?>
              <a class="btn btn-warning d-none d-md-flex input-group w-auto my-auto" href="/Dashboard_StartZupv1/home">Aller vers le côté client</a>
            <?php endif; ?>
            <!-- Search form -->
            <!-- <form class="d-none d-md-flex input-group w-auto my-auto">
                <input autocomplete="off" type="search" class="form-control rounded"
                       placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px"/>
                <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
            </form> -->
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
        <div class="col" data-html2canvas-ignore>
          <?php 
          $url = "/Dashboard_startZupv1/modifier-profil-$Profile[id]";
          echo "<a class='btn btn-info' href='$url'>Modifier</a>"
          ?>
        </div>
        <div class="col">
          
        </div>
        <div class="col employabilité" style="display: flex; flex-direction:row-reverse; align-items:center;">
          <div class="colBtnEmploie" data-html2canvas-ignore> 
            <!-- <b>Prêt à l'emploi : </b> -->
            <?php

            if (isset($_GET['id']) && is_numeric($_GET['id'])){
              $student_id = $_GET['id'];
              if (isset($_POST['id']) && is_numeric($_POST['id'])){
                if ($Profile['pretEmploi'] == "non"){
                  $edit = "UPDATE student SET pretEmploi='oui' WHERE id='$student_id'";
                  $resEdit = $conn->prepare($edit);
                  $resEdit->execute();
                  header("Location: profil-$student_id");
                } else {
                  $edit = "UPDATE student SET pretEmploi='non' WHERE id='$student_id'";
                  $resEdit = $conn->prepare($edit);
                  $resEdit->execute();
                  header("Location: profil-$student_id");
                }
              }
              echo "<form action='' method='POST'>";
              if ($Profile['pretEmploi'] == "non"){
                echo "<button type='submit' class='btn btn-danger'>Changer de statut</button>";
                echo "<input type='hidden' name='id' value='$student_id'>";
              } else {
                echo "<button type='submit' class='btn btn-success'>Changer de statut</button>";
                echo "<input type='hidden' name='id' value='$student_id'>";
              }
              echo "</form>";
            }
          echo "</div>";

          echo "<div class='colStatutActuel'>";
            if ($Profile['pretEmploi'] == "non"){ 
              echo "<p class='themeStatutNonEmployable'>Statut actuel: non employable </p>";
            } else {
              echo "<p class='themeStatutEmployable'>Statut actuel: employable</p>";
            }
          echo "</div>";
          ?>
        </div>
      </div>
    </div>
    <div class="container pt-4">
   
        <div class="container py-5">
          <div class="row">
            <div class="col-lg-4">
              <div class="card mb-4">
                <div class="card-body text-center">
                  <img src="<?php echo "$Profile[avatar]"; ?>" alt="avatar"
                    class="rounded-circle img-fluid" style="width: 150px;">
                  <h5 class="my-3"> <?php echo "$Profile[nom]";?> </h5>
                  <p class="text-muted mb-1"> <?php echo "$Profile[designation]";?> </p>
                  <p class="text-muted mb-4"><?php echo "$Profile[adresse]";?></p>
                  <div class="d-flex justify-content-center mb-2">
                    <button type="button" class="btn btn-primary" onclick="downloadPDF()">Télécharger le profil</button>

                    <button type="button"  onclick="window.location.href='mailto:<?php echo "$Profile[email]";?>';"class="btn btn-outline-primary ms-1">Envoyer un email</button>
                  </div>
                </div>
              </div>
              <div class="card mb-4 mb-lg-0">
                <div class="card-body p-0">
                  <ul class="list-group list-group-flush rounded-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fas fa-globe fa-lg text-warning"></i>
                      <p class="mb-0">https://mdbootstrap.com</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                      <p class="mb-0">mdbootstrap</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                      <p class="mb-0">@mdbootstrap</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                      <p class="mb-0">mdbootstrap</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                      <p class="mb-0">mdbootstrap</p>
                    </li>
                  </ul>
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
                  $queryLanguages = "SELECT * FROM `languages` RIGHT JOIN(SELECT * FROM `student_languages` WHERE `id_student`=$Profile[id]) as L ON languages.id=L.id_language;";
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
                      <p class="mb-0">Full Name</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"> <?php echo "$Profile[prenom]";?>  <span></span>  <?php echo "$Profile[nom]";?> </p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"> <?php echo "$Profile[email]";?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Phone</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"> <?php echo "$Profile[phone]";?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Code Profile</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"> <?php echo "$Profile[code_profile]";?> </p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Address</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"> <?php echo "$Profile[adresse]";?> </p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Mobilité</p>
                    </div>
                    <div class="col-sm-9">
                    <?php
                    if ($mobility){
                      foreach ($mobility as $key => $value) {
                        echo "<div class='col-sm-9' style='display: flex;'>";
                        echo "<p class='text-muted mb-0'> $value[ville_code_postal] </p>";
                        echo "<span> - </span>";
                        echo "<p class='text-muted mb-0'> $value[ville_nom_reel] </p>";
                        echo "</div>";
                      }
                    } else {
                      echo "<p> Aucune mobilité n'a été enregistré pour ce profil </p>";
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
                        <?php 
                        if (isset($_GET['id']) && is_numeric($_GET['id'])){
                          $student_id = $_GET['id'];
                          //récupération des compétences du candidat 
                          $querySkills = "SELECT * FROM `skills` RIGHT JOIN (SELECT `value_skills`,`id_skills` FROM `student_skills` WHERE `id_student`= $student_id) as t ON skills.id=t.id_skills;";
                          $stmtSkills = $conn->prepare($querySkills);
                          $stmtSkills->execute();
                          $Skills =  $stmtSkills->fetchAll(PDO::FETCH_ASSOC);

                          foreach ($Skills as $x) {
                            $skill = $x["nom_skills"];
                            $valueSkill = $x["value_skills"];
                            if( $valueSkill>=0){
                            echo "<p class='mb-1' style='font-size: .77rem;'>$skill</p>
                            <div class='progress   rounded'  style='height: 25px;'>
                            <div class='progress-bar' role='progressbar' style='width:$valueSkill%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$valueSkill%</div>
                            </div>";} 
                            elseif ($valueSkill == "aucun" || $valueSkill == null) {
                              echo "<p> Aucune compétence n'a été enregistré pour ce profil </p>";                            
                            }
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
                      <canvas id="barChart"></canvas>
                     <!-- <h5 class="card-header shadow-inner">Featured</h5>
                     
                      <canvas id="doughnutChart1"></canvas>--> 
                    </div>
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4 mb-md-0">
                    <div class="card-body">
                      <p class="mb-4"><b> Commentaire </b> </p>
                      <p class="text-mutedmb-0"> <?php echo "$Profile[commentaire]";?> </p>

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

  <!-- MDB -->
<?php
  try {
    // Validation des données d'entrée
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $student_id = $_GET['id'];

        // Préparez la requête SQL
        $query = "SELECT *
                  FROM soft_skills
                  JOIN student_soft_skills ON soft_skills.id = student_soft_skills.soft_skills_id
                  JOIN student ON student.id = student_soft_skills.student_id
                  WHERE student.id = $student_id";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        // Récupérez les données
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  // Convertissez les données PHP en format compatible avec Chart.js
  var labels = <?php echo json_encode(array_column($data, 'soft_skills_name')); ?>;
  var values = <?php echo json_encode(array_column($data, 'value_skills')); ?>;

  // Créez un contexte pour le canvas
  var ctx = document.getElementById('barChart').getContext('2d');

  // Créez le graphique à barres avec Chart.js
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: labels,
          datasets: [{
              label: 'Soft Skills',
              data: values,
              backgroundColor: 'rgba(75, 192, 192, 0.2)', // Couleur de fond des barres
              borderColor: 'rgba(75, 192, 192, 1)', // Couleur de la bordure des barres
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true, // Commencez à 0
                  max: 100 // Valeur maximale de l'axe Y
              }
          }
      }
  });
  </script>

  <?php
  } else {
    throw new Exception('ID invalide');
}
} catch (Exception $e) {
echo $e->getMessage();
}
?>
<script>
    var docPDF = new jsPDF('p', 'mm', 'a4');
    function downloadPDF() {
      var elementHTML = document.getElementById("Profile");
      var largeurNav = document.getElementById("sidebarMenu").offsetWidth;
      var option = {
        scrollY: 0,
        scrollX:0,
        x : largeurNav,
      };
      html2canvas(elementHTML, option).then(function(canvas) {
        var imgwidth= 255;
        var imgheight= canvas.height * imgwidth / canvas.width ;
        var imgX = 3;
        var imgData = canvas.toDataURL('image/png');
        docPDF.addImage(imgData, 'PNG', imgX, 5, (imgwidth - 2*imgX),(1.2*imgheight));

        //  Sauvegarder le fichier PDF
        docPDF.save('profil_<?php echo $student_id ?>.pdf');
      });
    }
    //bar
  </script>
  <script>
    
    window.jsPDF = window.jspdf.jsPDF;
var docPDF = new jsPDF();
function print(){
var elementHTML = document.querySelector("#Profile");
docPDF.html(elementHTML, {
 callback: function(docPDF) {
  docPDF.save('HTML Linuxhint web page.pdf');
 },
 x: 15,
 y: 15,
 width:100,
 windowWidth: 100


});
}
  </script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
</body>

</html>