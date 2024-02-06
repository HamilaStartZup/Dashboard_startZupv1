<?php
// Database Connection
include '../config.php';

session_start();

if ($_SESSION['status'] != "Admin") {
    header("Location: /Dashboard_startZupv1/acces-echoue");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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

        .themeStatutEmployable {
            color: green;
        }

        .themeStatutNonEmployable {
            color: red;
        }

        .colBtnEmploie {
            display: flex;
            align-items: center;
            justify-content: end;
            margin: 5px;
        }

        .colStatutActuel {
            display: flex;
            align-items: center;
            justify-content: end;
        }
        .container{
            margin-top: 5rem;
        }
        .formulaire{
            width: 80%;
            margin: auto;
            margin-top: 2rem;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            /* From https://css.glass */
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);

        }
        #add_skills{
            margin-top: 15rem;
        }
        .exist-data{
            width: 80%;
            margin: 2rem auto;
        }
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
                <a href="/Dashboard_startZupv1/ajouter-un-candidat" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-user-graduate me-3"></i><span>Ajouter des candidats</span></a>
                <a href="/Dashboard_startZupv1/ajouter-client-admin" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-users fa-fw me-3"></i><span>Ajouter client & administrateur</span></a>
                <a href="/Dashboard_startZupv1/liste-de-rdv" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-lock fa-fw me-3"></i><span>Gérer RDV</span></a>
                <a href="/Dashboard_startZupv1/calendrier" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-calendar fa-fw me-3"></i><span>CALENDRIER</span></a>
                <a href="/Dashboard_startZupv1/ajouter-un-skill" class="list-group-item list-group-item-action py-2 ripple active"><i class="fa-solid fa-brain me-3"></i><span>Ajouter un skill</span></a>
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

    <main class="main" id="add_skills">
    <form action="./addPromo.php" method="POST" class="formulaire" enctype="multipart/form-data">
        <h3>Créer une nouvelle promotions !</h3>
        <div class="mb-3">
            <label for="nom_promo" class="form-label">Nom de la nouvelle promotions</label>
            <input type="text" class="form-control" id="nom_promo" name="nom_promo" required>
            <label for="date_debut" class="form-label">Date de rentrée</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" required>
            <label for="date_fin" class="form-label">Date de fin</label>
            <input type="date" class="form-control" id="date_fin" name="date_fin" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    
    <div class="exist-data">
        <h1>Promotions(s) existante(s)</h1>
        <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom de la promotion</th>
                <th scope="col">Nombre d'étudiant</th>
                <th scope="col">Date de rentrée</th>
                <th scope="col">Date de fin</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM promo";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $promos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($promos as $promo) {
                    $sqlNbEtu = "SELECT COUNT(*) FROM student where id_promo = $promo[id]";
                    $stmtNbEtu = $conn->prepare($sqlNbEtu);
                    $stmtNbEtu->execute();
                    $nbEtu = $stmtNbEtu->fetch(PDO::FETCH_ASSOC);
                    echo "<tr>";
                    echo "<td>" . $promo['nom'] . "</td>";
                    echo "<td>" . $nbEtu['COUNT(*)'] . "</td>";
                    echo "<td>" . $promo['date_debut'] . "</td>";
                    echo "<td>" . $promo['date_fin'] . "</td>";
                    echo "<td>" . "<a href='addPromo.php?edit=$promo[id]'><i class='fa-solid fa-pen'></i></a>" . "</td>";
                    echo "<td>" . "<a href='addPromo.php?delete=$promo[id]'><i class='fa-solid fa-trash'></i></a>" . "</td>";
                    echo "</tr>";
                }
                ?>
        </tbody>
    </div>
    </main>


<?php
include('../config.php');

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $name = $_POST['nom_promo'];
//     $dateReg = $_POST['date_debut'];
//     $dateEnd = $_POST['date_fin'];
//     addPromo($conn, $name, $dateReg, $dateEnd);
// }

function addPromo($conn, $name, $dateReg, $dateEnd) {
    if ($dateEnd == "") {
        $dateEnd = NULL;
    } else if ($dateEnd < $dateReg) {
        echo "<p style='color:red;'>La date de fin doit être supérieure à la date de début<p>";
        return;
    } else if ($dateEnd == $dateReg) {
        echo "<p style='color:red;'>La date de fin doit être supérieure à la date de début<p>";
        return;
    } else{
        $sql = "INSERT INTO promo (nom, date_debut, date_fin) VALUES (:nom_promo, :date_debut, :date_fin)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom_promo', $name);
        $stmt->bindParam(':date_debut', $dateReg);
        $stmt->bindParam(':date_fin', $dateEnd);
        $stmt->execute();
        echo "<script>window.location.href = 'addPromo.php';</script>";
    }
}

// Recuperer le btn de suppression
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; // Recuperer l'id de la promo dans l'url
    $sql = "DELETE FROM promo WHERE id=$id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // recharger la page sans header qui fait une erreur
    echo "<script>window.location.href = 'addPromo.php';</script>";
}

// Lorsque je clique sur le btn de modification les textes deviennent des inputs modifiables et un btn de validation apparait
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM promo WHERE id=$id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $promo = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<form action='' method='POST' class='formulaire' enctype='multipart/form-data'>";
    echo "<input type='hidden' name='_method' value='PUT'>";    
    echo "<h3>Modifier la promotion</h3>";
    echo "<div class='mb-3'>";
    echo "<label for='nom_promo' class='form-label'>Nom de la nouvelle promotions</label>";
    echo "<input type='text' class='form-control' id='new_nom_promo' name='new_nom_promo' value='$promo[nom]' required>";
    echo "<label for='new_date_debut' class='form-label'>Date de rentrée</label>";
    echo "<input type='date' class='form-control' id='new_date_debut' name='new_date_debut' value='$promo[date_debut]' required>";
    echo "<label for='new_date_fin' class='form-label'>Date de fin</label>";
    echo "<input type='date' class='form-control' id='new_date_fin' name='new_date_fin' value='$promo[date_fin]' required>";
    echo "<input type='hidden' name='id' value='$promo[id]'>";
    echo "</div>";
    echo "<button type='submit' class='btn btn-primary'>Modifier</button>";
    echo "</form>";

    // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
    //     $name = $_POST['new_nom_promo'];
    //     $dateReg = $_POST['new_date_debut'];
    //     $dateEnd = $_POST['new_date_fin'];
    //     $id = $_POST['id'];
    //     updatePromo($conn, $name, $dateReg, $dateEnd, $id);
    // }

    function updatePromo($conn, $name, $dateReg, $dateEnd, $id) {
        $sql = "UPDATE promo SET nom=:new_nom_promo, date_debut=:new_date_debut, date_fin=:new_date_fin WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':new_nom_promo', $name);
        $stmt->bindParam(':new_date_debut', $dateReg);
        $stmt->bindParam(':new_date_fin', $dateEnd);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo "<script>window.location.href = 'addPromo.php';</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
        // Traitement pour la méthode PUT (modification de la promo)
        $name = $_POST['new_nom_promo'];
        $dateReg = $_POST['new_date_debut'];
        $dateEnd = $_POST['new_date_fin'];
        $id = $_POST['id'];
        updatePromo($conn, $name, $dateReg, $dateEnd, $id);
    } else {
        // Traitement pour la méthode POST (ajout d'une nouvelle promo)
        $name = $_POST['nom_promo'];
        $dateReg = $_POST['date_debut'];
        $dateEnd = $_POST['date_fin'];
        addPromo($conn, $name, $dateReg, $dateEnd);
    }
}

?>
