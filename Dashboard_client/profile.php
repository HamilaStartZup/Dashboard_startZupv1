<?php
// Database Connection
include '../config.php';
session_start();

if(!isset($_SESSION['email'])){
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
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <a class="navbar-brand" href="#">
          <img
               src="../images/icon.png"
               height="25"
               alt="KJJJ"
         
               />
        
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
    
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuLink"
        >
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
        <a
          class="dropdown-toggle d-flex align-items-center hidden-arrow"
          href="#"
          id="navbarDropdownMenuAvatar"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="https://img.freepik.com/photos-gratuite/icone-profil-utilisateur-recto_187299-39596.jpg?w=826&t=st=1700233197~exp=1700233797~hmac=ecf017b3fc31a8df3b9f1610d6b32041d2d9f7610b1d33ab8664b0e0ec680208"
            class="rounded-circle"
            height="25"
            alt="Black and White Portrait of a Man"
            loading="lazy"
          />
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuAvatar"
        >
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
  <main   id='Profile'>
    <div class="container pt-4">
   
        <div class="container py-5">
          <div class="row">
            <div class="col-lg-4">
              <div class="card mb-4">
                <div class="card-body text-center">
                  <img src="https://img.freepik.com/photos-gratuite/icone-profil-utilisateur-recto_187299-39596.jpg?w=826&t=st=1700233197~exp=1700233797~hmac=ecf017b3fc31a8df3b9f1610d6b32041d2d9f7610b1d33ab8664b0e0ec680208" alt="avatar"
                    class="rounded-circle img-fluid" style="width: 150px;">
                  <h5 class="my-3">Etudiant <?php echo $result['code_profile'] ?></h5>
                  <p class="text-muted mb-1"><?php echo $result['designation'] ?></p>
                  <p class="text-muted mb-4"><b>LOCATION A RAJOUTER EN BDD</b></p>
                  <div class="d-flex justify-content-center mb-2">
                    <button type="button" class="btn btn-primary" onclick="downloadPDF()">Télécharger le profil</button>

                    <button type="button"  onclick="sendEmail();" class="btn btn-outline-primary ms-1">Envoyer un email</button>
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
                      <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">Indisponible</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Téléphone</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">Indisponible</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Mobile</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">Indisponible</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Addresse</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"><b>LOCATION A RAJOUTER EN BDD</b></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="card mb-4 mb-md-0">
                    <div class="card-body">
                      <p class="mb-4"><span class="text-primary font-italic me-1">Statut</span> des project afféctés</p>
                      </p>
                      <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                      <div class="progress rounded" style="height: 5px;">
                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                      <div class="progress rounded" style="height: 5px;">
                        <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                      <div class="progress rounded" style="height: 5px;">
                        <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                      <div class="progress rounded" style="height: 5px;">
                        <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                      <div class="progress rounded mb-2" style="height: 5px;">
                        <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
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
            </div>
          </div>
      </section>
    </div>
  </main>
  <!--Main layout-->

  <!-- MDB -->

  <script>
    function sendEmail() {
        var email = 'start-zup@gmail.com';
        var subject = 'Intérêt pour le profil <?php echo $result['code_profile'] ?>';
        var mailtoLink = 'mailto:' + email + '?subject=' + encodeURIComponent(subject); 
        window.location.href = mailtoLink;
    }
    // var docPDF = new jsPDF();

    // function downloadPDF() {
    //   var elementHTML = document.getElementById("Profile");

    //   html2canvas(elementHTML).then(function (canvas) {
    //     var imgData = canvas.toDataURL('image/png');
    //     docPDF.addImage(imgData, 'PNG', 15, 15, 180, 180);

    //     // Sauvegarder le fichier PDF
    //     docPDF.save('profil_<?php echo $result['code_profile']?>.pdf');
    //   });
    // }

    
    //bar
    var ctxB = document.getElementById("barChart").getContext('2d');
    var myBarChart = new Chart(ctxB, {
      type: 'bar',
      data: {
        labels: ["communication", "apprentissage"],
        datasets: [{
          label: '# compétences générales',
          data: [10, 90,100],
          backgroundColor: [
            'rgba(25, 255, 255)',
            'rgba(54, 162, 235)',
            'rgba(255, 206, 86)',
            'rgba(75, 192, 192)',
         
          ],
    
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
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