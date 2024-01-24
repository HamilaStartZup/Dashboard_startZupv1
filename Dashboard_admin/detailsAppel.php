<?php
session_start();
require('../config.php');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SESSION['status'] == "Admin") {
    // Récupérer la date envoyée par l'URL
    $date = $_GET['date'];

    // Vérifier si la date est définie dans l'URL
    if (!isset($date)) {
        echo "La date n'est pas définie dans l'URL.";
        exit; // Arrêter l'exécution du script
    }

    // Convertir la date en format aaaa-mm-dd
    $dateTime = DateTime::createFromFormat('d/m/Y', $date);

    // Vérifier si la conversion de date est réussie
    if (!$dateTime) {
        echo "La conversion de la date a échoué.";
        exit; // Arrêter l'exécution du script
    }

    // Récupérer la date au format aaaa-mm-dd car elle à été convertie dans listeAppel.php ligne 485
    $dateParams = $dateTime->format('Y-m-d');

    $sql = "SELECT * FROM `appel` WHERE `appel`.`date_enregistrement` = '$dateParams'"; // selectionner tous les appels de la date envoyée par l'URL
    $result = $conn->prepare($sql);
    $result->execute();
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

    // Afficher les résultats
    // echo "Date récupérée de l'URL : " . $date . "<br>";
    // echo "Date convertie : " . $dateParams . "<br>";
    // echo json_encode($rows);
} else {
    header('Location: /Dashboard_startZupv1/acces-echoue');
}




// Fonction pour récupérer le taux d'absence chaque semaine
function getAbsenceSemaine($weekStartDate, $weekEndDate, $conn)
{
    try {
        // calculer le taux d'absence pour chaque étudiant un par un
        $stmtSelect = $conn->prepare("SELECT nom, prenom, date_enregistrement, COUNT(*) AS total, SUM(CASE WHEN matin = 'absent' AND apres_midi = 'absent' THEN 2 WHEN matin = 'absent' OR apres_midi = 'absent' THEN 1 ELSE 0 END) AS absence_count FROM appel WHERE date_enregistrement BETWEEN ? AND ? GROUP BY nom, prenom");
        $stmtSelect->bindParam(1, $weekStartDate);
        $stmtSelect->bindParam(2, $weekEndDate);
        $stmtSelect->execute();
        $resultSelect = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultSelect as $index => $etudiant) {
          if ($etudiant['total'] > 0) {
            // Somme des absence d'un étudiant
            $absenceCountEtudiant = $etudiant['absence_count'];
            
            // Nombre total de demi-journée de cours dans la semaine
            $totalCoursSemaine = 10;
            // Calculer le taux d'absence d'un étudiant
            $absenceRateEtudiant = ($absenceCountEtudiant / $totalCoursSemaine) * 100;
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
        $absenceCount = array_sum(array_column($resultSelect, 'absence_count'));
        // Nombre total de demi-journée de cours dans la semaine
        $totalCoursSemaine = 10;

        // Calculer le taux d'absence total de la semaine
        $absenceRate = ($absenceCount / $totalCoursSemaine) * 100;


        // return ['success' => true, 'absence_rate' => $absenceRate, 'absence_rate_etudiant' => $resultSelect];
        return ['success' => true, 'absence_rate_etudiant' => $resultSelect, 'absence_rate' => $absenceRate];
    } catch (PDOException $e) {
        return ['success' => false, 'message' => 'Erreur lors de la récupération du taux d\'absence: ' . $e->getMessage()];
    }
}

// Définir la semaine de la date d'appel consultée avec dateParams
$currentWeekNumber = date('W', strtotime($dateParams)); // Obtenir le numéro de la semaine avec la date d'appel consultée
$currentYear = date('Y', strtotime($dateParams)); // Obtenir l'année avec la date d'appel consultée

// Obtenir la date de début de la semaine
$weekStartDate = date('Y-m-d', strtotime($currentYear . 'W' . str_pad($currentWeekNumber, 2, '1', STR_PAD_LEFT)));

// Obtenir la date de fin de la semaine
$weekEndDate = date('Y-m-d', strtotime($weekStartDate . ' +4 days'));


// Appeler la fonction getAbsenceSemaine avec la semaine actuelle
$result = getAbsenceSemaine($weekStartDate, $weekEndDate, $conn);

// Appeler la fonction pour pouvoir télécharger le fichier Excel du tau d'absence de la semaine
RapportSemaineExcel($result);  // Voir quand appeler la fonction efficacement

// Fonction pour pouvoir télécharger le fichier Excel du tau d'absence de la semaine
function RapportSemaineExcel($result)
{
  require_once '../vendor/autoload.php'; // Inclure le fichier d'autoloading de PhpSpreadsheet
  // initialisation de la date pour récupérer le numéro de la semaine
  $date = date('Y-m-d');
  $dateTime = DateTime::createFromFormat('Y-m-d', $date);
  $currentWeekNumber = date('W', strtotime($date)); // Obtenir le numéro de la semaine avec la date d'appel consultée
  $currentYear = date('Y', strtotime($date)); // Obtenir l'année avec la date d'appel consultée
  $currentMonth = date('F', strtotime($date)); // Obtenir le mois avec la date d'appel consultée
  // Créer le fichier Excel
  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();

  // Ajouter les données dans le fichier Excel
  $sheet->setCellValue('A1', 'Nom');
  $sheet->setCellValue('B1', 'Prénom');
  $sheet->setCellValue('C1', 'Taux d\'absence');
  $sheet->setCellValue('D1', 'Jours d\'absence');
  $sheet->setCellValue('E1', 'Nombre de jours d\'absence');

  $sheet->getColumnDimension('A')->setWidth(25);
  $sheet->getColumnDimension('B')->setWidth(25);
  $sheet->getColumnDimension('C')->setWidth(25);
  $sheet->getColumnDimension('D')->setWidth(45);
  $sheet->getColumnDimension('E')->setWidth(25);
  $spreadsheet->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);

  // Ajouter les données dans le fichier Excel
  $row = 2;
  foreach ($result['absence_rate_etudiant'] as $etudiant) { // Parcourir les étudiants
      $sheet->setCellValue('A' . $row, $etudiant['nom']); // Ajouter le nom de l'étudiant
      $sheet->setCellValue('B' . $row, $etudiant['prenom']); // Ajouter le prénom de l'étudiant
      $sheet->setCellValue('C' . $row, $etudiant['absence_rate'] . ' %'); // Ajouter le taux d'absence de l'étudiant
      
      // Initialiser une variable pour stocker les informations sur les absences
      $absenceInfo = '';

      foreach ($etudiant['absence_list'] as $absence) {
        $formattedDate = date('l d', strtotime($absence['date_enregistrement'])); // Formatage de la date
        if ($absence['matin'] == 'absent' && $absence['apres_midi'] == 'absent') {
          $absenceInfo .= $formattedDate . ' : Journée complète, ' . "\n";
        } elseif ($absence['matin'] == 'absent') {
            $absenceInfo .= $formattedDate . ' : ' . $absence['matin'] . ' le matin, ' . "\n";
        } elseif ($absence['apres_midi'] == 'absent') {
            $absenceInfo .= $formattedDate . ' : ' . $absence['apres_midi'] . ' l\'après-midi, ' . "\n";
        } else {
            // Si l'étudiant est présent, vous pouvez ajouter un message ou laisser vide selon vos besoins
        }
      }
      // Ajouter les informations d'absence à la cellule 'D' . $row
      $sheet->setCellValue('D' . $row, $absenceInfo);
      $sheet->setCellValue('E' . $row, $etudiant['absence_count']); // Ajouter le nombre de jours d'absence de l'étudiant
      $row++; // Incrémenter le numéro de ligne
  }

  // Enregistrer le fichier Excel
  $dir = './appel/rapport_semaine/' . date('m_Y') . '/'; // Créer un répertoire pour stocker les fichiers Excel

  if (!is_dir($dir)) { // Vérifier si le répertoire existe
      mkdir($dir, 0777, true); // Créer le répertoire
  }

  $excelFilePath = $dir . 'semaine_' . $currentWeekNumber . '_' . $currentMonth . '_' . $currentYear  . '.xlsx'; // Nom du fichier Excel
  $writer = new Xlsx($spreadsheet); // Créer un objet PhpSpreadsheet
  $writer->save($excelFilePath); // Enregistrer le fichier Excel

  return $excelFilePath;


  // Télécharger le fichier Excel
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="' . $excelFilePath . '"');
  header('Cache-Control: max-age=0');
  header('Expires: Fri, 11 Nov 2011 11:11:11 GMT');
  header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
  header('Cache-Control: cache, must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($excelFilePath));
  readfile($excelFilePath);
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<head>
    <meta charset="UTF-8" />
    <base href="/Dashboard_startZupv1/Dashboard_admin/">
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
    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</head>
<style>
  body {
    background-color: #fbfbfb;
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
  .feuilleDAppel{
    margin-top: 5rem;
    width: 100%;
  }
  .feuilleDAppel .table{
    margin-top: 2rem;
  }
  .feuilleDAppel .btnDelete{
    margin-top: 2rem;
    width: 100%;
  }
</style>

<body>
  <!--Main Navigation-->
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a href="/Dashboard_startZupv1/accueil" class="list-group-item list-group-item-action py-2 ripple" aria-current="true"><i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span></a>
          <a href="/Dashboard_startZupv1/ajouter-un-candidat" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-user-graduate me-3"></i><span>Ajouter des candidats</span></a>
          <a href="/Dashboard_startZupv1/ajouter-client-admin" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-users fa-fw me-3"></i><span>Ajouter client & administrateur</span></a>
          <a href="/Dashboard_startZupv1/liste-de-rdv" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-lock fa-fw me-3"></i><span>Gérer RDV</span></a>
          <a href="/Dashboard_startZupv1/calendrier" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-calendar fa-fw me-3"></i><span>CALENDRIER</span></a>
          <a href="/Dashboard_startZupv1/ajouter-un-skill" class="list-group-item list-group-item-action py-2 ripple"><i class="fa-solid fa-brain me-3"></i><span>Ajouter un skill</span></a>
          <a href="/Dashboard_startZupv1/liste-des-appels" class="list-group-item list-group-item-action py-2 ripple ripple active"><i class="fa-sharp fa-solid fa-list me-3"></i><span>Liste d'appels</span></a>
          <a href="/Dashboard_startZupv1/appel" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-calendar fa-fw me-3"></i><span>Présence</span></a>
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-chart-line fa-fw me-3"></i><span>Futur lien...</span></a>
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-chart-bar fa-fw me-3"></i><span>Futur lien...</span></a>
          <a href="../logout.php" class="list-group-item list-group-item-action py-2 ripple"><i class="fa-solid fa-right-from-bracket me-3"></i><span>Logout</span></a>
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

<!-- Feuille d'appel -->
<div class="feuilleDAppel">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="text-center">Feuille d'appel</h1>
        <h2 class="text-center">Date : <?php echo $date; ?></h2>
        <form action="" method="POST">
          <?php 
            // Initialisation des variables de date pour leurs utilisations global
            $currentWeekNumber = date('W', strtotime($dateParams)); // Obtenir le numéro de la semaine avec la date d'appel consultée
            $currentYear = date('Y', strtotime($dateParams)); // Obtenir l'année avec la date d'appel consultée
            $currentMonth = date('F', strtotime($dateParams)); // Obtenir le mois avec la date d'appel consultée
          ?>
          <a style="float: right;" href="./appel/rapport_semaine/<?php echo date('m_Y', strtotime($dateParams)); ?>/semaine_<?php echo $currentWeekNumber; ?>_<?php echo $currentMonth; ?>_<?php echo $currentYear; ?>.xlsx" class="btn btn-warning" style="margin-bottom: 1rem;"><i class="bi bi-download"></i> Télécharger le rapport hebdomadaire</a>
          <a href="./appel/<?php echo date('m_Y', strtotime($dateParams)); ?>/<?php echo date('d', strtotime($dateParams)); ?>.xlsx " class="btn btn-success" style="float: right; margin-right: 20px;"><i class="bi bi-download"></i> Télécharger l'appel du jours</a>
          
          <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Statut</th>
                <th scope="col">Matin</th>
                <th scope="col">Après-midi</th>
                <th scope="col">Commentaire</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) { ?>
                <tr>
                    <td><?php echo $row['nom']; ?></td>
                    <td><?php echo $row['prenom']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['matin']; ?></td>
                    <td><?php echo $row['apres_midi']; ?></td>
                    <td><?php echo $row['commentaire']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
          </table>
          <input type="hidden" name="_method" value="DELETE">
          <button type="button" class="btn btn-danger btnDelete" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class='bi bi-trash3-fill'></i></button>
          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Suppression</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Êtes vous sûr de vouloir supprimer l'appel ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <input type="submit" value="Valider" class="btn btn-danger">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- afficher les taux d'absence de la semaine de chaque étudiants -->
  <!-- on affiche si vendredi -->
  <?php if (date('l', strtotime($dateParams)) == 'Friday') { ?>
      <div class="container" style="width: 100%; margin-top: 4rem;">
        <div class="row">
          <div class="col-12">
            <h1 class="text-center">Taux d'absence de la semaine</h1>
            <table class="table table-striped">
              <thead>
                  <tr>
                    <?php $currentMonth = date('F', strtotime($date)); // Obtenir le mois avec la date d'appel consultée ?>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Taux d'absence</th>
                    <th scope="col">Jours d'absence</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($result['absence_rate_etudiant'] as $row) { ?>
                  <tr>
                      <td><?php echo $row['nom']; ?></td>
                      <td><?php echo $row['prenom']; ?></td>
                      <td><?php echo $row['absence_rate']; ?>%</td>
                      <td>
                        <?php foreach ($row['absence_list'] as $absence) { ?>
                          <?php if ($absence['matin'] == 'absent' && $absence['apres_midi'] == 'absent') { ?>
                            <p><?php echo $absence['date_enregistrement']; ?> : Journée complète</p>
                          <?php } else if ($absence['matin'] == 'absent') { ?>
                            <p><?php echo $absence['date_enregistrement']; ?> : <?php echo $absence['matin']; ?> le matin</p>
                          <?php } else if ($absence['apres_midi'] == 'absent') { ?>
                            <p><?php echo $absence['date_enregistrement']; ?> : <?php echo $absence['apres_midi']; ?> l'après-midi</p>
                          <?php } else { ?>
                            <!-- rien car il est présent-->
                          <?php } ?>
                        <?php } ?>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  <?php } ?>
</div>
<?php
// Supprimer cette appel
$dateParams = $dateTime->format('Y-m-d');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
  $sql = "DELETE FROM `appel` WHERE `appel`.`date_enregistrement` = '$dateParams'"; // selectionner tous les appels de la date envoyée par l'URL
  $result = $conn->prepare($sql);
  $result->execute();
  $rows = $result->fetchAll(PDO::FETCH_ASSOC);
  echo "<script>
  window.location.href = '/Dashboard_startZupv1/liste-des-appels'
  </script>";
}
?>