<!-- rajouter la date du jour en variable dynamique dans le titre de la page -->
<!-- enregistrer la date du jour en variable dynamique dans le back -->
<!-- ajouter les retards -->
<?php
  include("../config.php");

  session_start();
// requête pour récupérer profile Etudiant
  $queryProfilEtudiant = "SELECT * FROM student WHERE id=$_GET[id]";
  $stmtEtudiant = $conn->prepare($queryProfilEtudiant);
  $stmtEtudiant ->execute();
  $etudiant = $stmtEtudiant ->fetchAll(PDO::FETCH_ASSOC);

  //profile 
   $Profile =$etudiant[0];

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
    <!-- Sidebar -->
    <nav
    id="sidebarMenu"
    class="collapse d-lg-block sidebar collapse bg-white"
    >
 <div class="position-sticky">
   <div class="list-group list-group-flush mx-3 mt-4">
     <a
        href="./dashboard.php"
        class="list-group-item list-group-item-action py-2 ripple active "
        aria-current="true"
        >
       <i class="fas fa-tachometer-alt fa-fw me-3"></i
         ><span>Main dashboard</span>
     </a>
     <a
        href="./addCandidats.php"
        class="list-group-item list-group-item-action py-2 ripple "
       
        >
       <i class="fas fa-user-graduate me-3"></i
         ><span>Ajouter des candidats</span>
     </a>
     <a
        href="#"
        class="list-group-item list-group-item-action py-2 ripple"
        ><i class="fas fa-lock fa-fw me-3"></i><span>Password</span></a
       >
     <a
        href="#"
        class="list-group-item list-group-item-action py-2 ripple"
        ><i class="fas fa-chart-line fa-fw me-3"></i
       ><span>Analytics</span></a
       >
     <a
        href="#"
        class="list-group-item list-group-item-action py-2 ripple"
        >
       <i class="fas fa-chart-pie fa-fw me-3"></i><span>SEO</span>
     </a>
     <a
        href="#"
        class="list-group-item list-group-item-action py-2 ripple"
        ><i class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span></a
       >
     <a
        href="#"
        class="list-group-item list-group-item-action py-2 ripple"
        ><i class="fas fa-globe fa-fw me-3"></i
       ><span>International</span></a
       >
     <a
        href="#"
        class="list-group-item list-group-item-action py-2 ripple"
        ><i class="fas fa-building fa-fw me-3"></i
       ><span>Partners</span></a
       >
     <a
        href="./presence.php"
        class="list-group-item list-group-item-action py-2 ripple"
        ><i class="fas fa-calendar fa-fw me-3"></i
       ><span>Présence</span></a
       >
      <a
      href="listeAppels.php"
      class="list-group-item list-group-item-action py-2 ripple ripple active"
      ><i class="fa-sharp fa-solid fa-list me-3"></i>
      <span>Liste d'appels</span></a
      >
     <a
     href="../logout.php"
        class="list-group-item list-group-item-action py-2 ripple"
        ><i class="fa-solid fa-right-from-bracket me-3"></i><span>Logout</span></a
       >
   </div>
 </div>
</nav>
    <!-- Sidebar -->
  
    <!-- Navbar -->
 
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main   id='Profile' style="margin-top: 58px">
    <div class="container pt-4">
   
        <div class="container py-5">
          <div class="row">
            <div class="col-lg-4">
              <div class="card mb-4">
                <div class="card-body text-center">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                    class="rounded-circle img-fluid" style="width: 150px;">
                  <h5 class="my-3"> <?php echo "$Profile[nom]";?> </h5>
                  <p class="text-muted mb-1"> <?php echo "$Profile[designation]";?> </p>
                  <p class="text-muted mb-4"><?php echo "$Profile[adresse]";?></p>
                  <div class="d-flex justify-content-center mb-2">
                    <button type="button" class="btn btn-primary" onclick="print()">Télécharger le profil</button>

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
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="card mb-4 mb-md-0">
                    <div class="card-body">
                      <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
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