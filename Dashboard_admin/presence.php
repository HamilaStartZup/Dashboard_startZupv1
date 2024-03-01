<?php
include('../config.php');
session_start();
// Si l'utilisateur n'ai pas administrateur ou formateur, il est redirigé vers la page d'accueil
if ($_SESSION['status'] !== 'Admin' && $_SESSION['status'] !== 'Formateur') {
  header('Location:/Dashboard_startZupv1/acces-echoue');
  exit;
}


$query = $conn->prepare("SELECT * FROM student INNER JOIN promo ON id_promo = promo.id WHERE NOW() BETWEEN promo.date_debut AND promo.date_fin");
$query->execute();
$etudiants = $query->fetchAll();
$length = count($etudiants);
$actif = 0;
foreach ($etudiants as $index => $etudiant) {
  if ($etudiant['status'] === 'active') {
    $actif++;
  }
}
$pourcentageActif = ($actif / $length) * 100;

// Requête pour vérifier si l'appel a été fait aujourd'hui
$date = date('Y-m-d');
$sql = "SELECT * FROM `appel` WHERE `appel`.`date_enregistrement` = '$date'"; // selectionner tous les appels du jour
$result = $conn->prepare($sql);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">

<head>
  <meta charset="UTF-8" />
  <base href="/Dashboard_startZupv1/Dashboard_admin/">
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <!-- AJAX -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

  thead {
    background-color: #2ecc71;
    color: white;
  }

  .feuille {
    margin: 1rem;
    padding: 0;
    /* pour enlever les marges */
    border: 1px solid rgb(241, 236, 236);
  }

  .feuille h1 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 2rem;
    width: 100%;
    text-align: center;
    /* pour centrer le titre */
  }

  .feuille form{
    padding: 20px;
  }
  .headerTableau {
    display: flex;
    justify-content: space-evenly;
    /* pour que les nom de champs soient espacés de manière égale */
    width: 100%;
    background-color: #2ecc71;
    color: white;
    font-family: 'Roboto', sans-serif;
    font-weight: 500;
    font-size: 1.2rem;
  }

  .listeTableau {
    display: flex;
    justify-content: space-evenly;
    /* pour que les noms d'éléves soient espacés de manière égale */
    align-items: center;
    width: 100%;
    background-color: white;
    color: black;
    font-family: 'Roboto', sans-serif;
    font-weight: 500;
    font-size: 1.2rem;
  }

  .feuille table {
    width: 100%;
    /* largeur du tableau à 100% de la div */
  }

  .feuille td {
    padding: 5px;
    width: 25%;
    /*donner une width au td pour que tout soit aligner */
    text-align: center;
    display: flex;
    align-items: center;
  }
  .feuille th {
    padding: 5px;
    width: 25%;
    /*donner une width au td pour que tout soit aligner */
    text-align: center;
  }
  .feuille input[type="text"]:disabled {
    border: none !important;
    width: 100%;
    color: black;
    text-align: center;
  }

  .feuille input[type="text"] {
    border: 1px solid black !important;
    border-radius: 5px;
    width: 100%;
    color: black;
    text-align: center;
  }

  .feuille input[type="checkbox"] {
    width: 100%;
    height: 25px;
  }

  .feuille input[type="checkbox"]:hover {
    cursor: pointer;
  }

  .btn-validation{
    width: 100%;
    height: 60px;
    border-radius: 3px;
    border: none;
    background-color: #3ad177;
    color: white;
    padding: 5px;
    box-shadow: none;
  }
  /* bloque le css bootstrap */
  .btn-validation:hover {
    background-color: #2ecc71 !important;
    box-shadow: none !important;
  }

  .btn-validation:focus {
    background-color: #2ecc71 !important;
    box-shadow: none !important;
  }

  .btn-validation:active {
    background-color: #2ecc71 !important;
    box-shadow: none !important;
  }

  .btn-validation:focus-visible {
    background-color: #2ecc71 !important;
    box-shadow: none !important;
  }

  .btn-validation:disabled {
    background-color: #3ad177 !important;
    box-shadow: none !important;
  }
  /* bloque le css bootstrap */

  .table-responsive{
    overflow-x: unset !important;
  }

</style>

<body>
  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <?php if ($_SESSION['status'] == 'Admin'){?>
            <a href="/Dashboard_startZupv1/accueil" class="list-group-item list-group-item-action py-2 ripple" aria-current="true"><i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span></a>
            <a href="/Dashboard_startZupv1/ajouter-un-candidat" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-user-graduate me-3"></i><span>Ajouter des candidats</span></a>
            <a href="/Dashboard_startZupv1/ajouter-client-admin" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-users fa-fw me-3"></i><span>Ajouter client & administrateur</span></a>
            <a href="/Dashboard_startZupv1/liste-de-rdv" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-lock fa-fw me-3"></i><span>Gérer RDV</span></a>
            <a href="/Dashboard_startZupv1/calendrier" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-calendar fa-fw me-3"></i><span>CALENDRIER</span></a>
            <a href="/Dashboard_startZupv1/ajouter-un-skill" class="list-group-item list-group-item-action py-2 ripple"><i class="fa-solid fa-brain me-3"></i><span>Ajouter un skill</span></a>
          <?php } ?>
          <a href="/Dashboard_startZupv1/liste-des-appels" class="list-group-item list-group-item-action py-2 ripple ripple s"><i class="fa-sharp fa-solid fa-list me-3"></i><span>Liste d'appels</span></a>
          <a href="/Dashboard_startZupv1/appel" class="list-group-item list-group-item-action py-2 ripple active"><i class="fas fa-calendar fa-fw me-3"></i><span>Présence</span></a>
          <a href="/Dashboard_startZupv1/tracer-un-etudiant" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-binoculars me-3"></i><span>Tracer un étudiant</span></a>
          <?php if ($_SESSION['status'] == 'Admin'){?>
            <a href="/Dashboard_startZupv1/ajouter-une-langue" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-chart-line fa-fw me-3"></i><span>Ajouter une langue</span></a>
            <a href="/Dashboard_startZupv1/ajouter-une-promotion" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-chart-bar fa-fw me-3"></i><span>Ajouter une promotion</span></a>
          <?php } ?>
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
  <!--Main Navigation-->

  <!-- Main layout -->
  <main style="margin-top: 58px">
    <div class="container pt-4">
      <!-- Section: Statistics with subtitles -->
      <section>
        <div class="row">
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
                    <h2 class="h1 mb-0"><?php echo $length; ?></h2>
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
                    <h2 class="h1 mb-0"><?php echo number_format($pourcentageActif, 0); ?> %</h2>
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
              <strong>
                <?php
                $formattedDate = date('d/m/Y');
                echo "<h1>Feuille de présence - $formattedDate</h1>";
                ?>
              </strong>
            </h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <?php if (count($rows) > 0) : ?>
              <div class="alert alert-info" role="alert">
                L'appel a déjà été enregistré pour aujourd'hui.
              </div> 
            <?php endif; ?>
              <!-- Feuille de présence -->
              <div class="row">
                <div class="col-sm feuille ">
                  <form action="./fonctions/saveAppel.php" method="POST" id="formId">
                    <table>
                      <tbody>
                        <tr class="headerTableau shadow py-3 mb-5 rounded">
                          <th>Nom</th>
                          <th>Prénom</th>
                          <th>Matin</th>
                          <th>Après-midi</th>
                          <th>Commentaire</th>
                        </tr>
                        <?php foreach ($etudiants as $index => $etudiant)  : ?>
                          <?php if ($etudiant['status'] !== 'active') : ?>
                            <tr class="listeTableau" style="opacity: 0.5;pointer-events:none; background-image: repeating-linear-gradient(135deg, rgba(0,0,0, 0.46) 0px, rgba(0,0,0, 0.46) 2px,transparent 2px, transparent 4px),linear-gradient(90deg, rgba(213,213,213, 0.23),rgba(213,213,213, 0.23));">
                              <td class="nom">
                                <input type="text" name="nom[<?php echo $index; ?>]" value="<?php echo $etudiant['nom']; ?>" disabled="disabled">
                              </td>
                              <td class="prenom">
                                <input type="text" name="prenom[<?php echo $index; ?>]" value="<?php echo $etudiant['prenom']; ?>" disabled="disabled">
                              </td>
                              <td><input type="checkbox" value="🚫" disabled><br><br></td>
                              <td><input type="checkbox" value="🚫" disabled><br><br></td>
                              <td><input type="text" value="🚫" disabled><br><br></td>
                            </tr>
                          <?php else : ?>
                            <tr class="listeTableau">
                              <td class="nom">
                                <input type="text" name="nom[<?php echo $index; ?>]" value="<?php echo $etudiant['nom']; ?>" disabled="disabled">
                              </td>
                              <td class="prenom">
                                <input type="text" name="prenom[<?php echo $index; ?>]" value="<?php echo $etudiant['prenom']; ?>" disabled="disabled">
                              </td>
                              <td>
                                <input type="checkbox" id="presentM<?php echo $index; ?>" name="presentM[<?php echo $index; ?>]" <?php echo isset($rows[$index]['matin']) && $rows[$index]['matin'] === 'présent' ? 'checked' : ''; ?>><br><br>
                              </td>
                              <td>
                                <input type="checkbox" id="presentAM<?php echo $index; ?>" name="presentAM[<?php echo $index; ?>]" <?php echo isset($rows[$index]['apres_midi']) && $rows[$index]['apres_midi'] === 'présent' ? 'checked' : ''; ?>><br><br>
                              </td>
                              <td>
                                <input type="text" id="commentaire<?php echo $index; ?>" name="commentaire<?php echo $index; ?>" value="<?php echo isset($rows[$index]['commentaire']) ? $rows[$index]['commentaire'] : ''; ?>" ><br><br>
                              </td>
                            </tr>
                          <?php endif; ?>
                        <?php endforeach; ?>
                        <?php foreach ($etudiants as $index => $etudiant) : ?>
                            <input type="hidden" name="etudiants[<?php echo $index; ?>][nom]" value="<?php echo $etudiant['nom']; ?>">
                            <input type="hidden" name="etudiants[<?php echo $index; ?>][prenom]" value="<?php echo $etudiant['prenom']; ?>">
                            <input type="hidden" name="etudiants[<?php echo $index; ?>][presentM]" value="<?php echo isset($_POST['presentM'][$index]) ? 'présent' : 'absent'; ?>">
                            <input type="hidden" name="etudiants[<?php echo $index; ?>][presentAM]" value="<?php echo isset($_POST['presentAM'][$index]) ? 'présent' : 'absent'; ?>">
                            <input type="hidden" name="etudiants[<?php echo $index; ?>][commentaire]" value="<?php echo isset($_POST['commentaire'][$index]) ? $_POST['commentaire'][$index] : ''; ?>">
                            <input type="hidden" name="etudiants[<?php echo $index; ?>][status]" value="<?php echo $etudiant['status']; ?>">
                            <input type="hidden" name="etudiants[<?php echo $index; ?>][email]" value="<?php echo $etudiant['email']; ?>">
                          <?php  ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <?php if (count($rows) == 0 ): ?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-validation" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      Valider
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Validation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Êtes vous sûr de vouloir valider l'appel ?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="Valider" class="btn btn-primary" name="btn-submit">
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php else : ?>
                      <button type="button" class="btn btn-primary btn-validation" disabled>
                        Valider
                      </button> 
                    <?php endif; ?>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script>
 // Ajoutez un gestionnaire d'événements change aux cases à cocher
$('input').blur(function() {
  // Récupération des données du formulaire
  const formData = $('#formId').serialize(); 
  // Envoyez les données au serveur via AJAX
  $.ajax({
    url: './fonctions/saveAppel.php',
    type: 'POST',
    data: formData,
    success: function(response) {
      console.log('Base de données mise à jour avec succès !');
    },
    error: function(xhr, status, error) {
      console.error('Erreur lors de la mise à jour de la base de données : ' + error);
    }
  });
});
        </script>
      </section>
      <!-- Section: Statistics with subtitles -->
    </div>
  </main>
  <!-- Main layout -->