<?php
include("../config.php");

session_start();
// Si l'utilisateur n'ai pas administrateur, il est redirigé vers la page d'accueil
if ($_SESSION['status'] != "Admin") {
  header("Location: /Dashboard_startZupv1/acces-echoue");
}

$allStudents = "SELECT * FROM student";
$stmt = $conn->prepare($allStudents);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les infos de l'étudiant
$queryEtudiant = "SELECT * FROM student WHERE nom = :nom AND prenom = :prenom";
$stmt = $conn->prepare($queryEtudiant);
$stmt->bindParam(':nom', $_POST['nomStudent']);
$stmt->bindParam(':prenom', $_POST['prenomStudent']);
$stmt->execute();
$etudiant = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fonction pour récupérer le taux d'absence chaque semaine
function getAbsenceSemaine($weekStartDate, $weekEndDate, $conn){
  try {
    // calculer le taux d'absence pour chaque étudiant un par un
    $stmtSelect = $conn->prepare("SELECT nom, prenom, date_enregistrement, COUNT(*) AS total, SUM(CASE WHEN matin = 'absent' AND apres_midi = 'absent' THEN 2 WHEN matin = 'absent' OR apres_midi = 'absent' THEN 1 ELSE 0 END) AS absence_count FROM appel WHERE date_enregistrement BETWEEN ? AND ? AND nom = ? AND prenom = ? GROUP BY nom, prenom");
    $stmtSelect->bindParam(1, $weekStartDate);
    $stmtSelect->bindParam(2, $weekEndDate);
    $stmtSelect->bindParam(3, $_POST['nomStudent']);
    $stmtSelect->bindParam(4, $_POST['prenomStudent']);
    $stmtSelect->execute();
    $resultSelect = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);

    $totalCoursSemaine = 10;

    foreach ($resultSelect as $index => $etudiant) {
      if ($etudiant['total'] > 0) {
        // Somme des absence d'un étudiant
        $absenceCountEtudiant = $etudiant['absence_count'];
        
        // Calculer le taux d'absence d'un étudiant
        $absenceRateEtudiant = number_format((($absenceCountEtudiant / $totalCoursSemaine) * 100),2,'.','');
        // Ajouter le taux d'absence d'un étudiant dans le tableau
        $resultSelect[$index]['absence_rate'] = $absenceRateEtudiant;
        // Ajouter la liste de jours ou l'étudiant est absent 
        $stmtSelect = $conn->prepare("SELECT date_enregistrement, matin, apres_midi FROM appel WHERE nom = ? AND prenom = ? AND date_enregistrement BETWEEN ? AND ?");
        $stmtSelect->bindParam(1, $etudiant['nom']);
        $stmtSelect->bindParam(2, $etudiant['prenom']);
        $stmtSelect->bindParam(3, $weekStartDate);
        $stmtSelect->bindParam(4, $weekEndDate);
        $stmtSelect->execute();
        $resultSelectEtudiant = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
        $resultSelect[$index]['absence_list'] = $resultSelectEtudiant;
      } else {            
        $absenceRateEtudiant = 0;
        $resultSelect[$index]['absence_rate'] = $absenceRateEtudiant;
      }
    }

    // Calcul du taux d'absence total de la semaine
    // Somme des absence de tous les étudiants
    $absenceCount = array_sum(array_column($resultSelect, 'absence_count')); // array_sum() permet de sommer les valeurs d'un tableau et array_column() permet de récupérer les valeurs d'une colonne d'un tableau cette ligne permet de récupérer les valeurs de la colonne 'absence_count' du tableau $resultSelect
    // Nombre total de demi-journée de cours dans la semaine
    $totalCoursSemaine = 10;

    // Calculer le taux d'absence total de la semaine
    $absenceRate = ($absenceCount / $totalCoursSemaine) * 100;

    return ['success' => true, 'absence_rate_etudiant' => $resultSelect, 'absence_rate' => $absenceRate];
  } catch (PDOException $e) {
    return ['success' => false, 'message' => 'Erreur lors de la récupération du taux d\'absence: ' . $e->getMessage()];
  }
}

if (isset($_POST['date'])) {
  $dateExacte = $_POST['date'];
} else {
  $dateExacte = "";
}
if (isset($_POST['semaineOfYear'])) {
  $semaineOfYear = $_POST['semaineOfYear'];
} else {
  $semaineOfYear = "";
}
if (isset($_POST['mois'])) {
  $mois = $_POST['mois'];
} else {
  $mois = "";
}

$currentYear = date('Y');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // On défini quel variable on utilise pour récupérer les informations selon se qui est rempli dans le formulaire

  if ($dateExacte && isset($_POST['nomStudent']) && isset($_POST['prenomStudent'])) {
    $weekStartDate = $dateExacte;
    $weekEndDate = $dateExacte;
    $infosEtudiant = getAbsenceSemaine($weekStartDate, $weekEndDate, $conn);
  } else if ($semaineOfYear && isset($_POST['nomStudent']) && isset($_POST['prenomStudent'])) {
    // Créer une date à partir de l'année et de la semaine
    $startDate = new DateTime();
    $startDate->setISODate($currentYear, $semaineOfYear);

    // Obtenez le début de la semaine
    $weekStartDate = $startDate->format('Y-m-d');

    // Obtenez la fin de la semaine (vendredi)
    $weekEndDate = $startDate->modify('+4 days')->format('Y-m-d');
    
    $infosEtudiant = getAbsenceSemaine($weekStartDate, $weekEndDate, $conn);
  }
  else if ($mois && isset($_POST['nomStudent']) && isset($_POST['prenomStudent'])) {
    $weekStartDate = date('Y-m-d', strtotime($currentYear . '-' . $mois . '-01'));
    $weekEndDate = date('Y-m-d', strtotime($currentYear . '-' . $mois . '-31'));
    $infosEtudiant = getAbsenceSemaine($weekStartDate, $weekEndDate, $conn);
  }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <base href="/Dashboard_startZupv1/Dashboard_admin/">
  <meta charset="UTF-8" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />

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

    .form-control{
      border-bottom: 1px solid #c4c4c4 !important;
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
          <a href="/Dashboard_startZupv1/accueil" class="list-group-item list-group-item-action py-2 ripple " aria-current="true"><i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span></a>
          <a href="/Dashboard_startZupv1/ajouter-un-candidat" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-user-graduate me-3"></i><span>Ajouter des candidats</span></a>
          <a href="/Dashboard_startZupv1/ajouter-client-admin" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-users fa-fw me-3"></i><span>Ajouter client & administrateur</span></a>
          <a href="/Dashboard_startZupv1/liste-de-rdv" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-lock fa-fw me-3"></i><span>Gérer RDV</span></a>
          <a href="/Dashboard_startZupv1/calendrier" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-calendar fa-fw me-3"></i><span>CALENDRIER</span></a>
          <a href="/Dashboard_startZupv1/ajouter-un-skill" class="list-group-item list-group-item-action py-2 ripple"><i class="fa-solid fa-brain me-3"></i><span>Ajouter un skill</span></a>
          <a href="/Dashboard_startZupv1/liste-des-appels" class="list-group-item list-group-item-action py-2 ripple ripple s"><i class="fa-sharp fa-solid fa-list me-3"></i><span>Liste d'appels</span></a>
          <a href="/Dashboard_startZupv1/appel" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-calendar fa-fw me-3"></i><span>Présence</span></a>
          <a href="/Dashboard_startZupv1/tracer-un-etudiant" class="list-group-item list-group-item-action py-2 ripple active"><i class="fas fa-binoculars me-3"></i><span>Tracer un étudiant</span></a>
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
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="#">
          <img src="../images/icon.png" height="25" alt="" />
        </a>
        <?php if ($_SESSION['status'] === "Admin") : ?>
          <a class="btn btn-warning d-none d-md-flex input-group w-auto my-auto" href="/Dashboard_StartZupv1/home">Aller vers le côté client</a>
        <?php endif; ?>
          <!-- Search form -->
        <!-- <form class="d-none d-md-flex input-group w-auto my-auto">
          <input autocomplete="off" type="search" class="form-control rounded" placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px" />
          <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
        </form> -->
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!-- Main Navigation -->

  <!-- Main layout -->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
      <h3 class="text-center">
        Entrez les informations afin de récupérer les présences et absences de l'étudiant concerné.
      </h3>

      <form action="" method="POST">
        <div class="row">
          <h4>
            Informations de l'étudiant
          </h4>
          <div class="col-md-3">
            <div class="form-outline mb-4">
              <label class="form-label" for="nomStudent">Nom de l'étudiant</label>
              <select name="nomStudent" id="nomStudent" class="form-control" onchange="updatePrenoms()">
                <option value="">Séléctionnez un nom</option>
                <?php foreach ($students as $student) : ?>
                  <option  value="<?= $student['nom'] ?>"><?= $student['nom'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-outline mb-4">
              <label class="form-label " for="prenomStudent">Prénom de l'étudiant</label>
              <select name="prenomStudent" id="prenomStudent" class="form-control">
                <option value="">Séléctionnez un prénom</option>
                
                <script>
                  function updatePrenoms() {
                      let nomSelect = document.getElementById('nomStudent');
                      let prenomSelect = document.getElementById('prenomStudent');

                      prenomSelect.innerHTML = "<option value=''>Sélectionnez un prénom</option>";

                      if (nomSelect.value !== '') {
                          <?php
                          foreach ($students as $student) {
                              echo "if ('" . $student['nom'] . "' === nomSelect.value) {";
                              echo "    var option = document.createElement('option');";
                              echo "    option.value = '" . $student['prenom'] . "';";
                              echo "    option.text = '" . $student['prenom'] . "';";
                              echo "    prenomSelect.add(option);";
                              echo "}";
                          }
                          ?>
                      }
                  }
              </script>

              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <h4>
            Date souhaitée
          </h2>
          <div class="col-md-3">
            <div class="form-outline mb-4">
              <label class="form-label" for="date">Date exacte </label>
              <input type="date" id="date" name="date" class="form-control" />
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-outline mb-4">
              <label class="form-label" for="semaineOfYear">Semaine de l'année</label>
              <select name="semaineOfYear" id="semaineOfYear" class="form-control">
                <option value="">Choisissez une semaine</option>
                <?php
                  $weeksOfyear = [];
                  $currentYear = date('Y');
                  $currentWeek = date('W');
                  for ($i = 1; $i <= $currentWeek; $i++) {
                    $weeksOfyear[] += $i;
                  }
                  foreach ($weeksOfyear as $week) {
                    echo "<option value='" . $week . "'> Semaine " . $week . "</option>";
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-outline mb-4">
              <label class="form-label" for="mois">Mois complet</label>
              <select class="form-control" name="mois" id="mois">
                <option value="">Choisissez un mois</option>
                <option value="1">Janvier</option>
                <option value="2">Février</option>
                <option value="3">Mars</option>
                <option value="4">Avril</option>
                <option value="5">Mai</option>
                <option value="6">Juin</option>
                <option value="7">Juillet</option>
                <option value="8">Août</option>
                <option value="9">Septembre</option>
                <option value="10">Octobre</option>
                <option value="11">Novembre</option>
                <option value="12">Décembre</option>
              </select>
            </div>
          </div>

        </div>
        <button type="submit" class="btn btn-primary">Rechercher</button>
          
      </form>
    </div>

      <div class="container" style="width: 100%; margin-top: 4rem;">
        <div class="row">
          <div class="col-12">
            <h1 class="text-center">Absence pour la date séléctionner</h1>
            <table class="table table-striped">
              <thead>
                  <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Taux d'absence</th>
                    <th scope="col">Jours d'absence</th>
                  </tr>
              </thead>
              <tbody>
              <?php if ( $_SERVER['REQUEST_METHOD'] === 'POST' && $infosEtudiant && !empty($infosEtudiant['absence_rate_etudiant'])) : ?>
                <?php foreach ($infosEtudiant['absence_rate_etudiant'] as $absence) { ?>
                  <tr>
                    <td><?= $absence['nom'] ?></td>
                    <td><?= $absence['prenom'] ?></td>
                    <td><?= $absence['absence_rate'] . "%" ?></td>
                    <td>
                    <?php foreach ($absence['absence_list'] as $absenceList) { ?>
                      <?php if ($absenceList['matin'] == 'absent' && $absenceList['apres_midi'] == 'absent') { ?>
                        <p><?php echo $absenceList['date_enregistrement']; ?> : Journée complète</p>
                      <?php } else if ($absenceList['matin'] == 'absent') { ?>
                        <p><?php echo $absenceList['date_enregistrement']; ?> : <?php echo $absenceList['matin']; ?> le matin</p>
                      <?php } else if ($absenceList['apres_midi'] == 'absent') { ?>
                        <p><?php echo $absenceList['date_enregistrement']; ?> : <?php echo $absenceList['apres_midi']; ?> l'après-midi</p>
                      <?php } else { ?>
                        <!-- rien car il est présent-->
                      <?php } ?>
                    <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              <?php elseif ( $_SERVER['REQUEST_METHOD'] === 'POST' && $infosEtudiant ): ?>
                <tr>
                  <td colspan="4">Aucune donnée disponible pour cette date</td>
                </tr>
              <?php else : ?>
                <tr>
                  <td colspan="4">Les informations seront afficher ici</td>
                </tr>
              
              <?php endif; ?>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </main>
  <!-- Main layout -->
  
</body>

</html>