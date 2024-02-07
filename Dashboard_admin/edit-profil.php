<?php
include('../config.php');

session_start();
if ($_SESSION['status'] != "Admin") {
    header("Location: /Dashboard_startZupv1/acces-echoue");
  }
$id_student = $_GET['id'];
$queryUser = "SELECT * FROM student WHERE id = '$id_student'";
$stmt = $conn->prepare($queryUser);
$stmt->execute();
$student = $stmt->fetch();

// requête pour récupérer les competences
$queryEtudiants = "SELECT * FROM skills";
$stmtEtudiants = $conn->prepare($queryEtudiants);
$stmtEtudiants ->execute();
$Skills = $stmtEtudiants ->fetchAll(PDO::FETCH_ASSOC);

// requête pour récupérer les soft skills
$querySoftKills = "SELECT * FROM soft_skills";
$stmtSoftKills = $conn->prepare($querySoftKills);
$stmtSoftKills->execute();
$softSkills = $stmtSoftKills->fetchAll(PDO::FETCH_ASSOC);

// requête pour requpere les competences de l'étudiant
$queryEtudiants = "SELECT * FROM student_skills WHERE id_student = '$id_student'";
$stmtEtudiants = $conn->prepare($queryEtudiants);
$stmtEtudiants ->execute();
$SkillsEtudiant = $stmtEtudiants ->fetchAll(PDO::FETCH_ASSOC);

// requête pour recupere les soft skills de l'étudiant
$querySoftSkillsEtudiant = "SELECT * FROM student_soft_skills WHERE student_id = '$id_student'";
$stmtSoftSkillsEtudiant = $conn->prepare($querySoftSkillsEtudiant);
$stmtSoftSkillsEtudiant->execute();
$softSkillsEtudiant = $stmtSoftSkillsEtudiant->fetchAll(PDO::FETCH_ASSOC);

// requête pour recuperer toutes les langues
$queryLangues = "SELECT * FROM languages";
$stmtLangues = $conn->prepare($queryLangues);
$stmtLangues->execute();
$langues = $stmtLangues->fetchAll(PDO::FETCH_ASSOC);

// requête pour recupere les langues parler par l'étudiant
$queryLanguesEtudiant = "SELECT * FROM student_languages WHERE id_student = '$id_student'";
$stmtLanguesEtudiant = $conn->prepare($queryLanguesEtudiant);
$stmtLanguesEtudiant->execute();
$languesEtudiant = $stmtLanguesEtudiant->fetchAll(PDO::FETCH_ASSOC);


if ($_SESSION['status'] === "Admin" && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id_promo = $_POST['promo'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $genre = $_POST['genre'];
    $date_naissance = $_POST['date_naissance'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $statut = $_POST['status'];
    $designation = $_POST['designation'];
    $code_profile = $_POST['code_profile'];
    $disponibility = $_POST['disponibility'];
    $pretEmploi = $_POST['pretEmploi'];
    $vehicule = $_POST['vehicule'];
    $description = $_POST['description'];
    $commentaire = $_POST['commentaire'];
    $competences =$_POST['ary']; // tableau des compétences
    $valueCompetences = $_POST['competences']; // tableau des valeurs des compétences
    // Si tout les skills sont décoché on supprime tout les skills de l'étudiant
    if(!$competences){
        $queryDelete = "DELETE FROM student_skills WHERE id_student = :id_student";
        $stmtDelete = $conn->prepare($queryDelete);
        $stmtDelete->bindParam(':id_student', $id_student, PDO::PARAM_INT);
        $stmtDelete->execute();
        $competences = array();  // Réinitialisation du tableau des compétences

    } else if ($competences && count($competences) > 0 && $Skills){

        // SI UNE COMPETENCE EST COCHEE ON L'AJOUTE DANS LA TABLE student_skills SINON ON LA SUPPRIME
        foreach($Skills as $skill){
            $idSkill = $skill['id'];
            $queryEtudiants = "SELECT * FROM student_skills WHERE id_student = '$id_student' AND id_skills = '$idSkill'";
            $stmtEtudiants = $conn->prepare($queryEtudiants);
            $stmtEtudiants ->execute();
            $SkillsEtudiant = $stmtEtudiants ->fetchAll(PDO::FETCH_ASSOC);
            if ($competences){
    
                if(in_array($idSkill, $competences)){
                    if(count($SkillsEtudiant) == 0){
                        $queryInsert = "INSERT INTO student_skills (id_student, id_skills) VALUES (:id_student, :idSkill)";
                        $stmtInsert = $conn->prepare($queryInsert);
                        $stmtInsert->bindParam(':id_student', $id_student, PDO::PARAM_INT);
                        $stmtInsert->bindParam(':idSkill', $idSkill, PDO::PARAM_INT);
                        $stmtInsert->execute();
                    }
                }else if(count($SkillsEtudiant) > 0){
                    $queryDelete = "DELETE FROM student_skills WHERE id_student = :id_student AND id_skills = :idSkill";
                    $stmtDelete = $conn->prepare($queryDelete);
                    $stmtDelete->bindParam(':id_student', $id_student, PDO::PARAM_INT);
                    $stmtDelete->bindParam(':idSkill', $idSkill, PDO::PARAM_INT);
                    $stmtDelete->execute();
                }
            }
        }
    }

    // SI UNE VALEUR DE COMPETENCE EST MODIFIER ON LA MODIFIE DANS LA TABLE student_skills
    foreach($competences as $competence){
        // éviter le illegal string offset
        $idCompetences = $competence; 
        $queryEtudiants = "SELECT * FROM student_skills WHERE id_student = '$id_student' AND id_skills = $idCompetences";
        $stmtEtudiants = $conn->prepare($queryEtudiants);
        $stmtEtudiants ->execute();
        $SkillsEtudiant = $stmtEtudiants ->fetchAll(PDO::FETCH_ASSOC);
        if ($SkillsEtudiant && count($SkillsEtudiant) > 0){
            $queryUpdate = "UPDATE student_skills SET value_skills = :value_skills WHERE id_student = :id_student AND id_skills = :id_skills";
            $stmtUpdate = $conn->prepare($queryUpdate);
            $stmtUpdate->bindParam(':value_skills', $_POST['competences'][$idCompetences]);
            $stmtUpdate->bindParam(':id_student', $id_student);
            $stmtUpdate->bindParam(':id_skills', $idCompetences);
        
            if ($stmtUpdate->execute()) {
                
            } else {
                echo "Erreur lors de la mise à jour : " . implode(" ", $stmtUpdate->errorInfo());
            }
        }
        
    }

    // Récupération des compétences cochées dans le formulaire
    $SoftcompetencesCoches = isset($_POST['softSkills']) ? $_POST['softSkills'] : array();

    // Si un soft skill est coché, on l'ajoute dans la table student_soft_skills, sinon on le supprime
    foreach ($softSkills as $softSkill) {
        $idSoftSkill = $softSkill['id'];
        
        // Vérification si la compétence est cochée dans le formulaire
        $cocheDansFormulaire = in_array($idSoftSkill, $SoftcompetencesCoches);

        $querySoftSkillsEtudiant = "SELECT * FROM student_soft_skills WHERE student_id = '$id_student' AND soft_skills_id = '$idSoftSkill'";
        $stmtSoftSkillsEtudiant = $conn->prepare($querySoftSkillsEtudiant);
        $stmtSoftSkillsEtudiant->execute();
        $softSkillsEtudiant = $stmtSoftSkillsEtudiant->fetchAll(PDO::FETCH_ASSOC);

        if ($cocheDansFormulaire) {
            // Si la compétence est cochée dans le formulaire
            if (count($softSkillsEtudiant) == 0) {
                // Si elle n'est pas présente dans la base de données, on l'ajoute
                $queryInsert = "INSERT INTO student_soft_skills (student_id, soft_skills_id) VALUES (:id_student, :idSoftSkill)";
                $stmtInsert = $conn->prepare($queryInsert);
                $stmtInsert->bindParam(':id_student', $id_student, PDO::PARAM_INT);
                $stmtInsert->bindParam(':idSoftSkill', $idSoftSkill, PDO::PARAM_INT);
                $stmtInsert->execute();
            }
        } else {
            // Si la compétence n'est pas cochée dans le formulaire
            if (count($softSkillsEtudiant) > 0) {
                // Si elle est présente dans la base de données, on la supprime
                $queryDelete = "DELETE FROM student_soft_skills WHERE student_id = :id_student AND soft_skills_id = :idSoftSkill";
                $stmtDelete = $conn->prepare($queryDelete);
                $stmtDelete->bindParam(':id_student', $id_student, PDO::PARAM_INT);
                $stmtDelete->bindParam(':idSoftSkill', $idSoftSkill, PDO::PARAM_INT);
                $stmtDelete->execute();
            }
        }
    }

    // Si une valeur de soft skill est modifiée on la modifie dans la table student_soft_skills
    foreach($softSkills as $softSkill){
        $idSoftSkill = $softSkill['id'];
        $querySoftSkillsEtudiant = "SELECT * FROM student_soft_skills WHERE student_id = '$id_student' AND soft_skills_id = '$idSoftSkill'";
        $stmtSoftSkillsEtudiant = $conn->prepare($querySoftSkillsEtudiant);
        $stmtSoftSkillsEtudiant->execute();
        $softSkillsEtudiant = $stmtSoftSkillsEtudiant->fetchAll(PDO::FETCH_ASSOC);
        if ($softSkillsEtudiant && count($softSkillsEtudiant) > 0){
            $queryUpdate = "UPDATE student_soft_skills SET value_skills = :value_skills WHERE student_id = :student_id AND soft_skills_id = :soft_skills_id";
            $stmtUpdate = $conn->prepare($queryUpdate);
            $stmtUpdate->bindParam(':value_skills', $_POST['softSkillsValues'][$idSoftSkill]);
            $stmtUpdate->bindParam(':student_id', $id_student);
            $stmtUpdate->bindParam(':soft_skills_id', $idSoftSkill);
            if ($stmtUpdate->execute()) {
            } else {
                echo "Erreur lors de la mise à jour : " . implode(" ", $stmtUpdate->errorInfo());
            }
        }
        
    }

    // Si une langue est cochée, on l'ajoute dans la table student_languages, sinon on la supprime
    $languesCoches = isset($_POST['langues']) ? $_POST['langues'] : array();

    foreach ($langues as $langue) {
        $idLangue = $langue['id'];
        // Vérification si la langue est cochée dans le formulaire
        $cocheDansFormulaire = in_array($idLangue, $languesCoches);

        $queryLanguesEtudiant = "SELECT * FROM student_languages WHERE id_student = '$id_student' AND id_language = '$idLangue'";
        $stmtLanguesEtudiant = $conn->prepare($queryLanguesEtudiant);
        $stmtLanguesEtudiant->execute();
        $languesEtudiant = $stmtLanguesEtudiant->fetchAll(PDO::FETCH_ASSOC);


        if ($cocheDansFormulaire) {
            // Si la langue est cochée dans le formulaire
            if (count($languesEtudiant) == 0) {
                // Si elle n'est pas présente dans la base de données, on l'ajoute
                $queryInsert = "INSERT INTO student_languages (id_student, id_language) VALUES (:id_student, :idLangue)";
                $stmtInsert = $conn->prepare($queryInsert);
                $stmtInsert->bindParam(':id_student', $id_student, PDO::PARAM_INT);
                $stmtInsert->bindParam(':idLangue', $idLangue, PDO::PARAM_INT);
                $stmtInsert->execute();
            }
        } else {
            // Si la langue n'est pas cochée dans le formulaire
            if (count($languesEtudiant) > 0) {
                // Si elle est présente dans la base de données, on la supprime
                $queryDelete = "DELETE FROM student_languages WHERE id_student = :id_student AND id_language = :idLangue";
                $stmtDelete = $conn->prepare($queryDelete);
                $stmtDelete->bindParam(':id_student', $id_student, PDO::PARAM_INT);
                $stmtDelete->bindParam(':idLangue', $idLangue, PDO::PARAM_INT);
                $stmtDelete->execute();
            }
        }
    }

    // Si une valeur de langue est coché on la modifie dans la table student_languages
    foreach($langues as $langue){
        $idLangue = $langue['id'];
        $cocheDansFormulaire = in_array($idLangue, $languesCoches);
        $queryLanguesEtudiant = "SELECT * FROM student_languages WHERE id_student = '$id_student' AND id_language = '$idLangue'";
        $stmtLanguesEtudiant = $conn->prepare($queryLanguesEtudiant);
        $stmtLanguesEtudiant->execute();
        $languesEtudiant = $stmtLanguesEtudiant->fetchAll(PDO::FETCH_ASSOC);

        if ($languesEtudiant && count($languesEtudiant) > 0){
            $queryUpdate = "UPDATE student_languages SET language_level = :language_level WHERE id_student = :id_student AND id_language = :id_language";
            $stmtUpdate = $conn->prepare($queryUpdate);
            $stmtUpdate->bindParam(':language_level', $_POST['languesValues'][$idLangue]);
            $stmtUpdate->bindParam(':id_student', $id_student);
            $stmtUpdate->bindParam(':id_language', $idLangue);
            if ($stmtUpdate->execute()) {
            } else {
                echo "Erreur lors de la mise à jour : " . implode(" ", $stmtUpdate->errorInfo());
            }
        }
    }
    


    if ($_FILES['avatar']['size'] && $_FILES['avatar']['size'] > 0) {
        $upload_dir = './uploads/candidats/' . $nom . $prenom . '/';
        $photo = $nom . "_" . $prenom . "_" . (isset($_FILES['avatar']['name']) ? basename($_FILES['avatar']['name']) : '');
        $photoPath = $upload_dir . $photo;
        
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        } else {
            $files = glob($upload_dir . '*'); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file)) {
                    unlink($file); // delete file
                }
            }
        }

        move_uploaded_file($_FILES['avatar']['tmp_name'], $photoPath);

        // Mettre à jour l'image dans la base de données
        $queryUpdateImage = "UPDATE student SET avatar = :avatar WHERE id = :id"; 
        $stmtUpdateImage = $conn->prepare($queryUpdateImage);
        $stmtUpdateImage->bindParam(':avatar', $photoPath);
        $stmtUpdateImage->bindParam(':id', $id);
        $stmtUpdateImage->execute();
    }

    $queryUpdate = "UPDATE student SET
                    id_promo = :id_promo,
                    nom = :nom,
                    prenom = :prenom,
                    gender = :genre,
                    date_naissance = :date_naissance,
                    email = :email,
                    phone = :telephone,
                    adresse = :adresse,
                    status = :statut,
                    designation = :designation,
                    code_profile = :code_profile,
                    disponibility = :disponibility,
                    pretEmploi = :pretEmploi,
                    Vehicule = :vehicule,
                    description = :description,
                    commentaire = :commentaire
                    WHERE id = :id";

    $stmtUpdate = $conn->prepare($queryUpdate);

    $stmtUpdate->bindParam(':id_promo', $id_promo);
    $stmtUpdate->bindParam(':nom', $nom);
    $stmtUpdate->bindParam(':prenom', $prenom);
    $stmtUpdate->bindParam(':genre', $genre);
    $stmtUpdate->bindParam(':date_naissance', $date_naissance);
    $stmtUpdate->bindParam(':email', $email);
    $stmtUpdate->bindParam(':telephone', $telephone);
    $stmtUpdate->bindParam(':adresse', $adresse);
    $stmtUpdate->bindParam(':statut', $statut);
    $stmtUpdate->bindParam(':designation', $designation);
    $stmtUpdate->bindParam(':code_profile', $code_profile);
    $stmtUpdate->bindParam(':disponibility', $disponibility);
    $stmtUpdate->bindParam(':pretEmploi', $pretEmploi);
    $stmtUpdate->bindParam(':vehicule', $vehicule);
    $stmtUpdate->bindParam(':description', $description);
    $stmtUpdate->bindParam(':commentaire', $commentaire);
    $stmtUpdate->bindParam(':id', $id);

    if ($stmtUpdate->execute()) {

    } else {
        echo "Erreur lors de l'enregistrement des modifications.";
    }
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
    </style>
</head>
<body>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                <a href="/Dashboard_startZupv1/accueil" class="list-group-item list-group-item-action py-2 ripple active " aria-current="true"><i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span></a>
                <a href="/Dashboard_startZupv1/ajouter-un-candidat" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-user-graduate me-3"></i><span>Ajouter des candidats</span></a>
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

    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Modifier le profil de <?php echo $student['nom'] ?> <?php echo $student['prenom'] ?></h1>
                    <form action="" method="POST" class="formulaire" enctype="multipart/form-data">
                        <h3>Informations personnelles</h3>
                        <input type="hidden" name="id" value="<?php echo $student['id'] ?>">
                        <div class="mb-3">
                            <label for="matricule" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" value="<?php echo $student['avatar'] ?>">
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $student['nom'] ?>">
                            </div>
                            <div class="col">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $student['prenom'] ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre</label>
                            <select class="form-select" aria-label="Default select example" name="genre">
                                <option value="Homme" <?php if ($student['gender'] == "homme") {echo "selected";} ?>>Homme</option>
                                <option value="Femme" <?php if ($student['gender'] == "femme") {echo "selected";} ?>>Femme</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date_naissance" class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?php echo $student['date_naissance'] ?>">
                        </div>
                        <h3>Contacts</h3>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $student['email'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Numéro de téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $student['phone'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $student['adresse'] ?>">
                        </div>
                        <h3>Compétences</h3>
                        <div class="mb-4">
                            <label for="competences" class="form-label">Compétences</label>
                            <div class="row">
                                <div class="col">
                                    <table class="table">
                                        <tbody>
                                            <?php
                                            foreach ($Skills as $skill) {
                                                $idSkill = $skill['id'];
                                                $queryEtudiants = "SELECT * FROM student_skills WHERE id_student = '$id_student' AND id_skills = '$idSkill'";
                                                $stmtEtudiants = $conn->prepare($queryEtudiants);
                                                $stmtEtudiants->execute();
                                                $SkillsEtudiant = $stmtEtudiants->fetchAll(PDO::FETCH_ASSOC);

                                                echo '<tr>';
                                                echo '<td>';
                                                echo '<div class="form-check">';
                                                echo '<input class="form-check-input" type="checkbox" value="' . $skill['id'] . '" id="' . $skill['id'] . '" name="ary[]" ' . (count($SkillsEtudiant) > 0 ? 'checked' : '') . '>';
                                                echo '<label class="form-check-label" for="' . $skill['id'] . '">';
                                                echo $skill['nom_skills'];
                                                echo '</label>';
                                                echo '</div>';
                                                echo '</td>';

                                                echo '<td>';
                                                if ($SkillsEtudiant && count($SkillsEtudiant) > 0) {
                                                    foreach ($SkillsEtudiant as $skillEtudiant) {
                                                        echo '<input type="text" class="form-control" id="competences_'. $skill['id'] .'" name="competences['. $skill['id'] .']" value="' . $skillEtudiant['value_skills'] . '">';
                                                    }
                                                } else {
                                                    echo '<input type="text" class="form-control" id="competences_'. $skill['id'] .'" name="competences['. $skill['id'] .']">';
                                                }
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- checkbox des compétences -->
                        </div>
                        <h3>Compétences générals</h3>
                        <div class="mb-4">
                        <label for="softSkills" class="form-label">Compétences générals</label>
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <tbody>
                                        <?php
                                        foreach ($softSkills as $softSkill) {
                                            $idSoftSkill = $softSkill['id'];
                                            $querySoftSkillsEtudiant = "SELECT * FROM student_soft_skills WHERE student_id = '$id_student' AND soft_skills_id = '$idSoftSkill'";
                                            $stmtSoftSkillsEtudiant = $conn->prepare($querySoftSkillsEtudiant);
                                            $stmtSoftSkillsEtudiant->execute();
                                            $softSkillsEtudiant = $stmtSoftSkillsEtudiant->fetchAll(PDO::FETCH_ASSOC);

                                            echo '<tr>';
                                            echo '<td>';
                                            echo '<div class="form-check">';
                                            echo '<input class="form-check-input" type="checkbox" value="' . $softSkill['id'] . '" id="' . $softSkill['id'] . '" name="softSkills[]" ' . (count($softSkillsEtudiant) > 0 ? 'checked' : '') . '>';
                                            echo '<label class="form-check-label" for="' . $softSkill['id'] . '">';
                                            echo $softSkill['soft_skills_name'];
                                            echo '</label>';
                                            echo '</div>';
                                            echo '</td>';

                                            echo '<td>';
                                            if ($softSkillsEtudiant && count($softSkillsEtudiant) > 0) {
                                                foreach ($softSkillsEtudiant as $softSkillEtudiant) {
                                                    echo '<input type="text" class="form-control" id="softSkills_' . $softSkill['id'] . '" name="softSkillsValues[' . $softSkill['id'] . ']" value="' . $softSkillEtudiant['value_skills'] . '">';
                                                }
                                            } else {
                                                echo '<input type="text" class="form-control" id="softSkills_' . $softSkill['id'] . '" name="softSkillsValues[' . $softSkill['id'] . ']">';
                                            }
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <h3>Langues parler</h3>
                        <div class="mb-4">
                            <label for="langues" class="form-label">Langues parler</label>
                            <div class="row">
                                <div class="col">
                                    <table class="table">
                                        <tbody>
                                            <?php
                                            foreach ($langues as $langue) {
                                                $idLangue = $langue['id'];

                                                $queryLanguesEtudiant = "SELECT * FROM student_languages WHERE id_student = '$id_student' AND id_language = '$idLangue'";
                                                $stmtLanguesEtudiant = $conn->prepare($queryLanguesEtudiant);
                                                $stmtLanguesEtudiant->execute();
                                                $languesEtudiant = $stmtLanguesEtudiant->fetchAll(PDO::FETCH_ASSOC);

                                                $idLangue = $langue['id'];
                                                // requête pour recupere le niveau de l'étudiant dans les langues
                                                $queryLanguesEtudiant = "SELECT * FROM student_languages WHERE id_student = '$id_student' AND id_language = '$idLangue'";
                                                $stmtLanguesEtudiant = $conn->prepare($queryLanguesEtudiant);
                                                $stmtLanguesEtudiant->execute();
                                                $niveauLanguesEtudiant = $stmtLanguesEtudiant->fetchAll(PDO::FETCH_ASSOC);
                                                
                                                echo '<tr>';
                                                echo '<td>';
                                                echo '<div class="form-check">';
                                                echo '<input class="form-check-input" type="checkbox" value="' . $langue['id'] . '" id="' . $langue['id'] . '" name="langues[]" ' . (count($languesEtudiant) > 0 ? 'checked' : '') . '>';
                                                echo '<label class="form-check-label" for="' . $langue['id'] . '">';
                                                echo $langue['nom_language'];
                                                echo '</label>';
                                                echo '</div>';
                                                echo '</td>';
                                                
                                                echo '<td>';
                                                // Les valeurs dans $niveau doivent être écrit EXACTEMENT comme dans la base de donnée
                                                $niveau = ["débutant", "élémentaire", "intermédiaire", "Avancé", "Fonctionnel", "Professionnel"];
                                                foreach ($niveau as $n) {
                                                    echo '<div class="form-check">';
                                                    // la langue est coché dans le formulaire si elle est défini dans la base de données et que le niveau est égale à la valeur de la boucle qui stocke les niveaux
                                                    echo '<input class="form-check-input" type="radio" name="languesValues[' . $langue['id'] . ']" value="' . $n . '" id="' . $n . '" ' . (isset($niveauLanguesEtudiant[0]['language_level']) && $niveauLanguesEtudiant[0]['language_level'] == $n ? 'checked' : '') . '>';
                                                    // print_r(isset($niveauLanguesEtudiant[0]['language_level']) ? $niveauLanguesEtudiant[0]['language_level'] : 'Non défini');
                                                    // la ligne au dessus permet d'afficher la valeur de la langue de l'étudiant si elle est défini
                                                    echo '<label class="form-check-label" for="' . $n . '">' . $n . '</label>';
                                                    echo '</div>';
                                                }                        
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                        
                        <h3>
                            Informations professionnelles
                        </h3>
                        <div class="mb-3">
                            <label for="promo" class="form-label">Promotion</label>
                            <select class="form-select" aria-label="Default select example"  name="promo" id="promo">
                                <?php 
                                    $sqlPromo = "SELECT * FROM promo WHERE date_fin > NOW()"; // On récupère les promos actives
                                    $stmtPromo = $conn->prepare($sqlPromo);
                                    $stmtPromo->execute();
                                    $promos = $stmtPromo->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($promos as $promo) {
                                        echo '<option value="' . $promo['id'] . '" ' . ($student['promo_id'] == $promo['id'] ? 'selected' : '') . '>' . $promo['nom'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut scolaire</label>
                            <select class="form-select" aria-label="Default select example" name="status">
                                <option value="active" <?php if ($student['status'] == "active") {echo "selected";} ?>>Actif</option>
                                <option value="not active" <?php if ($student['status'] == "not active") {echo "selected";} ?>>Non actif</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="designation" class="form-label">Désignation</label>
                            <input type="text" class="form-control" id="designation" name="designation" value="<?php echo $student['designation'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="code_profile" class="form-label">Code profil</label>
                            <input type="text" class="form-control" id="code_profile" name="code_profile" value="<?php echo $student['code_profile'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="disponibility" class="form-label">Disponibilité</label>
                            <input type="date" class="form-control" id="disponibility" name="disponibility" value="<?php echo $student['disponibility'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="pretEmploi" class="form-label">Prêt(e) à l'emploi</label>
                            <select name="pretEmploi" id="pretEmploi" class="form-select" aria-label="Default select example">
                                <option value="Oui" <?php if ($student['pretEmploi'] == "oui") {echo "selected";} ?>>Oui</option>
                                <option value="Non" <?php if ($student['pretEmploi'] == "non") {echo "selected";} ?>>Non</option>
                            </select>
                        </div>
                        
                        <h3>Informations complémentaires</h3>
                        <div class="mb-3">
                            <label for="vehicule" class="form-label">Véhiculé(e)</label>
                            <select name="vehicule" id="vehicule" class="form-select" aria-label="Default select example">
                                <option value="Oui" <?php if ($student['Vehicule'] == "oui") {echo "selected";} ?>>Oui</option>
                                <option value="Non" <?php if ($student['Vehicule'] == "non") {echo "selected";} ?>>Non</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea rows="5" class="form-control" id="description" name="description"><?php echo $student['description'] ?> </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="commentaire" class="form-label">Commentaire</label>
                            <textarea rows="5" class="form-control" id="commentaire" name="commentaire"><?php echo $student['commentaire'] ?></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>                    
                    </form>
                </div>
            </div>
        </div>
    </main>