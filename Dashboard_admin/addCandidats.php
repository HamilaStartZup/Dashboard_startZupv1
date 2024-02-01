<!-- rajouter la date du jour en variable dynamique dans le titre de la page -->
<!-- enregistrer la date du jour en variable dynamique dans le back -->
<!-- ajouter les retards -->
<?php
session_start();
// Si l'utilisateur n'ai pas administrateur, il est redirigé vers la page d'accueil
if ($_SESSION['status'] != "Admin") {
  header("Location: /Dashboard_startZupv1/acces-echoue");
}
//conx
require('../config.php');
// requête pour requpere les competences
$queryEtudiants = "SELECT * FROM skills";
$stmtEtudiants = $conn->prepare($queryEtudiants);
$stmtEtudiants->execute();
$Skills = $stmtEtudiants->fetchAll(PDO::FETCH_ASSOC);

// requête pour requpere les competences générales
$querySoftSkills = "SELECT * FROM soft_skills";
$stmtSoftSkills = $conn->prepare($querySoftSkills);
$stmtSoftSkills->execute();
$SoftSkills = $stmtSoftSkills->fetchAll(PDO::FETCH_ASSOC);


// reqûete pour requpere les langues
$queryLangues = "SELECT * FROM languages";
$stmtLangues = $conn->prepare($queryLangues);
$stmtLangues->execute();
$langues = $stmtLangues->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">

<head>
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

    * {
      box-sizing: border-box;
    }




    h1 {
      text-align: center;
    }

    input {
      padding: 10px;
      width: 100%;
      font-size: 17px;
      font-family: Raleway;
      border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
      background-color: #04AA6D;
    }

    /* Hide all steps by default: */
    .tab {
      display: none;
    }

    button {
      background-color: #04AA6D;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      font-size: 17px;
      font-family: Raleway;
      cursor: pointer;
    }

    button:hover {
      opacity: 0.8;
    }

    #prevBtn {
      background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbbbbb;
      border: none;
      border-radius: 50%;
      display: inline-block;
      opacity: 0.5;
    }

    .step.active {
      opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
      background-color: #04AA6D;
    }

    .select2-selection__choice {
      background-color: var(--bs-gray-200);
      border: none !important;
      font-size: 12px;
      font-size: 0.85rem !important;
    }
  </style>
  <base href="/Dashboard_startZupv1/Dashboard_admin/">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
  <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.0/dist/js/multi-select-tag.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>


<body>
  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a href="/Dashboard_startZupv1/accueil" class="list-group-item list-group-item-action py-2 ripple" aria-current="true"><i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span></a>
          <a href="/Dashboard_startZupv1/ajouter-un-candidat" class="list-group-item list-group-item-action py-2 ripple active"><i class="fas fa-user-graduate me-3"></i><span>Ajouter des candidats</span></a>
          <a href="/Dashboard_startZupv1/ajouter-client-admin" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-users fa-fw me-3"></i><span>Ajouter client & administrateur</span></a>
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

  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">

      <section class="mb-4">
        <div class="card">
          <div class="card-header text-center py-3">
            <h5 class="mb-0 text-center">
              <strong>Ajouter des candidats </strong>
            </h5>

          </div>
          <div class="card-body">
            <form method="POST" action="./Ajouter_candidats_DB.php" enctype="multipart/form-data">
              <!-- file import -->
              <div class="form-outline mb-4">
                <input type="file" class="form-control" id="avatar" name="avatar" value="">

              </div>
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row mb-4">
                <div class="col">

                  <div class="form-outline">
                    <input type="text" id="Nom" class="form-control" name="Nom" required />
                    <label class="form-label" for="form6Example1">Nom</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <input type="text" id="Prenom" class="form-control" name="Prenom" required />
                    <label class="form-label" for="form6Example2">Prénom</label>
                  </div>
                </div>
              </div>

              <!-- Text input -->
              <div class="form-outline mb-4">
                <input type="date" id="birthday" class="form-control" name="birthday" required>
                <label class="form-label" for="form6Example3">Date de naissance</label>
              </div>

              <!-- Text input -->
              <div class="form-outline mb-4">
                <input type="text" id="Adresse" class="form-control" name="Adresse" required />
                <label class="form-label" for="form6Example4">Addresse</label>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" id="Email" class="form-control" name="Email" required />
                <label class="form-label" for="form6Example5">Email</label>
              </div>

              <!-- PHONE input -->
              <div class="form-outline mb-4">
                <input type="text" id="Tel" class="form-control" name="Tel" required />
                <label class="form-label" for="form6Example6">Numéro de téléphone</label>
              </div>

              <div class="row mb-4">
                <!-- genre input -->
                <div class="col">
                  <label class="form-label" for="gender">Genre</label>
                  <select name="gender" id="gender" class="form-control">
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                  </select>
                </div>

                <div class="col">
                  <label class="form-label" for="vehicule">Véhiculé</label>
                  <select name="vehicule" id="vehicule" class="form-control">
                    <option value="oui">Oui</option>
                    <option value="non">Non</option>
                  </select>
                </div>
              </div>
              <!--  competence -->
              <div class="form-outline mb-4">
                <label class="form-label" for="form6Example11">Compétences</label>
                <select aria-placeholder="liste de compétences" name="ary[]" id="competences" multiple>
                  <?php foreach ($Skills as $row) {
                    $r = $row['id'];
                    echo "<option value='$r'>" . $row['nom_skills'] . "</option>";
                  } ?>
                </select>
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="softSkills">Compétences générales</label>
                <select placeholder="liste de compétences général" name="softSkills[]" id="softSkills" multiple>
                  <?php foreach ($SoftSkills as $row) {
                    $r = $row['id'];
                    echo "<option value='$r'>" . $row['soft_skills_name'] . "</option>";
                  } ?>
                </select>
              </div>
              <!--  langue -->
              <div class="form-outline mb-4">
                <label class="form-label" for="langues">Langues parler</label>
                <select placeholder="liste de langues" name="langues[]" id="langues" multiple>
                  <?php foreach ($langues as $row) {
                    $r = $row['id'];
                    echo "<option value='$r'>" . $row['nom_language'] . "</option>";
                  } ?>
                </select>
              </div>
              <!--  langue -->

              <!-- Message input -->
              <div class="form-outline mb-4">
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                <label class="form-label" for="description">Description...</label>
              </div>

              <!-- Designation -->
              <div class="form-outline mb-4">
                <input class="form-control" type="text" value="" id="designation" name="designation" required />
                <label class="form-label" for="form6Example9">Designation de profil</label>
              </div>
              <!-- Disponibility -->
              <div class="form-outline mb-4">
                <input type="date" id="disponibility" class="form-control" name="disponibility" required />
                <label class="form-label" for="form6Example10"> Disponible à partir de...</label>
              </div>
              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">Ajouter</button>
            </form>
          </div>
        </div>
      </section>

    </div>
  </main>
  <!--Main layout-->
  <!-- MDB -->

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
  <script>
    new MultiSelectTag('competences', {
      rounded: true, // default true
      shadow: true, // default false
      placeholder: 'Search', // default Search...
      onChange: function(values) {

        console.log(values)
      }
    })

    new MultiSelectTag('softSkills', {
      rounded: true, // default true
      shadow: true, // default false
      placeholder: 'Search', // default Search...
      onChange: function(values) {

        console.log(values)
      }
    })

    new MultiSelectTag('langues', {
      rounded: true, // default true
      shadow: true, // default false
      placeholder: 'Search', // default Search...
      onChange: function(values) {

        console.log(values)
      }
    })
  </script>
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>