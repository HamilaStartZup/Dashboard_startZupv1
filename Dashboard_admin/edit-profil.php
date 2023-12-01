<?php
include('../config.php');

session_start();
if ($_SESSION['status'] != "Admin") {
    header("Location: ../index.php");
}
$id_student = $_GET['id'];
$queryUser = "SELECT * FROM student WHERE id = '$id_student'";
$stmt = $conn->prepare($queryUser);
$stmt->execute();
$student = $stmt->fetch();

// requête pour requpere les competences
$queryEtudiants = "SELECT * FROM skills";
$stmtEtudiants = $conn->prepare($queryEtudiants);
$stmtEtudiants ->execute();
$Skills = $stmtEtudiants ->fetchAll(PDO::FETCH_ASSOC);

// requête pour requpere les competences de l'étudiant
$queryEtudiants = "SELECT * FROM student_skills WHERE id_student = '$id_student'";
$stmtEtudiants = $conn->prepare($queryEtudiants);
$stmtEtudiants ->execute();
$SkillsEtudiant = $stmtEtudiants ->fetchAll(PDO::FETCH_ASSOC);

if ($_SESSION['status'] === "Admin" && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $genre = $_POST['genre'];
    $date_naissance = $_POST['date_naissance'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $statut = $_POST['statut'];
    $designation = $_POST['designation'];
    $code_profile = $_POST['code_profile'];
    $disponibility = $_POST['disponibility'];
    $pretEmploi = $_POST['pretEmploi'];
    $vehicule = $_POST['vehicule'];
    $description = $_POST['description'];

    $competences =$_POST['ary']; // tableau des compétences

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
                    $queryInsert = "INSERT INTO student_skills (id_student, id_skills) VALUES ('$id_student', '$idSkill')";
                    $stmtInsert = $conn->prepare($queryInsert);
                    $stmtInsert->execute();
                }
            }else{
                if(count($SkillsEtudiant) > 0){
                    $queryDelete = "DELETE FROM student_skills WHERE id_student = '$id_student' AND id_skills = '$idSkill'";
                    $stmtDelete = $conn->prepare($queryDelete);
                    $stmtDelete->execute();
                }
            }
        }
    }
    // SI UNE VALEUR DE COMPETENCE EST MODIFIER
    


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
                    description = :description
                    WHERE id = :id";

    $stmtUpdate = $conn->prepare($queryUpdate);

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
    $stmtUpdate->bindParam(':id', $id);

    if ($stmtUpdate->execute()) {
        echo "<script> Modifications enregistrées avec succès. </script>";
    } else {
        echo "<script> Erreur lors de l'enregistrement des modifications. </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
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
                    <a href="./dashboard.php" class="list-group-item list-group-item-action py-2 ripple active " aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
                    </a>
                    <a href="./addCandidats.php" class="list-group-item list-group-item-action py-2 ripple ">
                        <i class="fas fa-user-graduate me-3"></i><span>Ajouter des candidats</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-lock fa-fw me-3"></i><span>Password</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-chart-line fa-fw me-3"></i><span>Analytics</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-pie fa-fw me-3"></i><span>SEO</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-globe fa-fw me-3"></i><span>International</span></a>
                    <a href="listeAppels.php" class="list-group-item list-group-item-action py-2 ripple ripple "><i class="fa-sharp fa-solid fa-list me-3"></i>
                        <span>Liste d'appels</span></a>
                    <a href="./presence.php" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-calendar fa-fw me-3"></i><span>Présence</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-users fa-fw me-3"></i><span>Ajouter client & administrateur</span></a>
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
            <!-- Search form -->
            <form class="d-none d-md-flex input-group w-auto my-auto">
                <input autocomplete="off" type="search" class="form-control rounded"
                       placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px"/>
                <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
            </form>
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
                                    <?php
                                    foreach($Skills as $skill){
                                        $idSkill = $skill['id'];
                                        $queryEtudiants = "SELECT * FROM student_skills WHERE id_student = '$id_student' AND id_skills = '$idSkill'";
                                        $stmtEtudiants = $conn->prepare($queryEtudiants);
                                        $stmtEtudiants ->execute();
                                        $SkillsEtudiant = $stmtEtudiants ->fetchAll(PDO::FETCH_ASSOC);
                                        if(count($SkillsEtudiant) > 0){
                                            echo '<div class="form-check">';
                                            echo '<input class="form-check-input" type="checkbox" value="'.$skill['id'].'" id="'.$skill['id'].'" name="ary[]" checked>';
                                            echo '<label class="form-check-label" for="'.$skill['id'].'">';
                                            echo $skill['nom_skills'];
                                            echo '</label>';
                                            echo '</div>';
                                        }else{
                                            echo '<div class="form-check">';
                                            echo '<input class="form-check-input" type="checkbox" value="'.$skill['id'].'" id="'.$skill['id'].'" name="ary[]">';
                                            echo '<label class="form-check-label" for="'.$skill['id'].'">';
                                            echo $skill['nom_skills'];
                                            echo '</label>';
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col">
                                <?php
                                    foreach($Skills as $skill){
                                        $idSkill = $skill['id'];
                                        $queryEtudiants = "SELECT * FROM student_skills WHERE id_student = '$id_student' AND id_skills = '$idSkill'";
                                        $stmtEtudiants = $conn->prepare($queryEtudiants);
                                        $stmtEtudiants ->execute();
                                        $SkillsEtudiant = $stmtEtudiants ->fetchAll(PDO::FETCH_ASSOC);
                                        // recupére les valeurs de la table student_skills pour chaque compétence cochée dans un input text
                                        if ($SkillsEtudiant && count($SkillsEtudiant) > 0){
                                        foreach($SkillsEtudiant as $skillEtudiant){
                                            echo ''.$skill["nom_skills"].': <input type="text" class="form-control" id="competences" name="competences[]" value="'.$skillEtudiant['value_skills'].'">';
                                        }
                                        }else{
                                            echo ''.$skill["nom_skills"].':<input type="text" class="form-control" id="competences" name="competences[]">';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- checkbox des compétences -->
                        </div>
                        <h3>
                            Informations professionnelles
                        </h3>
                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select class="form-select" aria-label="Default select example" name="statut">
                                <option value="Employable" <?php if ($student['status'] == "Employable") {echo "selected";} ?>>Employable</option>
                                <option value="Non employable" <?php if ($student['status'] == "Non employable") {echo "selected";} ?>>
                                    Non employable
                                </option>
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
                            <input type="textarea" class="form-control" id="description" name="description" value="<?php echo $student['description'] ?>">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>                    
                    </form>
                </div>
            </div>
        </div>
    </main>