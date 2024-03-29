<?php
// Database Connection
include '../config.php';
session_start();

if (!isset($_SESSION['email'])) {
  header('Location: /Dashboard_startZupv1/acces-echoue');
}
?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <base href="/Dashboard_startZupv1/Dashboard_client/">
    <meta content="initial-scale=1, maximum-scale=1, 
		user-scalable=0" name="viewport" />

    <meta name="viewport" content="width=device-width" />

    <!--Datatable plugin CSS file -->
    <link rel="stylesheet"
      href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

    <!--jQuery library file -->
    <script type="text/javascript"
      src="https://code.jquery.com/jquery-3.5.1.js"> 
	</script>

    <!--Datatable plugin JS library file -->
    <script type="text/javascript"
      src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"> 
	</script>
    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet" />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet" />
    <!-- MDB -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css"
      rel="stylesheet" />

    <style> 
    body {
      background-color: #fbfbfb;
    }
  /* The actual timeline (the vertical ruler) */
.main-timeline-2 {
  position: relative;
}

/* The actual timeline (the vertical ruler) */
.main-timeline-2::after {
  content: "";
  position: absolute;
  width: 3px;
  background-color: #26c6da;
  top: 0;
  bottom: 0;
  left: 50%;
  margin-left: -3px;
}

/* Container around content */
.timeline-2 {
  position: relative;
  background-color: inherit;
  width: 50%;
}

/* The circles on the timeline */
.timeline-2::after {
  content: "";
  position: absolute;
  width: 25px;
  height: 25px;
  right: -11px;
  background-color: #26c6da;
  top: 15px;
  border-radius: 50%;
  z-index: 1;
}

/* Place the container to the left */
.left-2 {
  padding: 0px 40px 20px 0px;
  left: 0;
}

/* Place the container to the right */
.right-2 {
  padding: 0px 0px 20px 40px;
  left: 50%;
}

/* Add arrows to the left container (pointing right) */
.left-2::before {
  content: " ";
  position: absolute;
  top: 18px;
  z-index: 1;
  right: 30px;
  border: medium solid white;
  border-width: 10px 0 10px 10px;
  border-color: transparent transparent transparent white;
}

/* Add arrows to the right container (pointing left) */
.right-2::before {
  content: " ";
  position: absolute;
  top: 18px;
  z-index: 1;
  left: 30px;
  border: medium solid white;
  border-width: 10px 10px 10px 0;
  border-color: transparent white transparent transparent;
}

/* Fix the circle for containers on the right side */
.right-2::after {
  left: -14px;
}

/* Media queries - Responsive timeline on screens less than 600px wide */
@media screen and (max-width: 600px) {
  /* Place the timelime to the left */
  .main-timeline-2::after {
    left: 31px;
  }

  /* Full-width containers */
  .timeline-2 {
    width: 100%;
    padding-left: 70px;
    padding-right: 25px;
  }

  /* Make sure that all arrows are pointing leftwards */
  .timeline-2::before {
    left: 60px;
    border: medium solid white;
    border-width: 10px 10px 10px 0;
    border-color: transparent white transparent transparent;
  }

  /* Make sure all circles are at the same spot */
  .left-2::after,
  .right-2::after {
    left: 18px;
  }

  .left-2::before {
    right: auto;
  }

  /* Make all right containers behave like the left ones */
  .right-2 {
    left: 0%;
  }
}
		td.details-control { 
			/* Image in the first column to 
				indicate expand*/ 
			background: url('images/more.png') 
				no-repeat center; 
				
			cursor: pointer; 
		} 

		tr.shown td.details-control { 
			background: url('images/shrinkdata.PNG') 
				no-repeat center; 
		} 
	</style>

  </head>

  <body>
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
            aria-label="Toggle navigation">
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
                  alt="KJJJ" />

              </a>
              <!-- Left links -->
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link"
                    href="/Dashboard_startZupv1/home">Accueil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"
                    href="/Dashboard_startZupv1/les-stagiaires"> Les
                    stagiaires</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/Dashboard_startZupv1/favoris">List
                    des favoris</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"
                    href="/Dashboard_startZupv1/votre-calendrier">Calendrier</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"
                    href="/Dashboard_startZupv1/contact">Contact</a>
                </li>
                <?php if ($_SESSION['status'] == 'Admin') { ?>
                  <li class="nav-item">
                    <a class="nav-link btn btn-warning text-white"
                      href="/Dashboard_startZupv1/accueil">Dashboard Admin</a>
                  </li>
                <?php } ?>
                
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
                  aria-labelledby="navbarDropdownMenuLink">
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
                  aria-expanded="false">
                  <img
                    src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp"
                    class="rounded-circle"
                    height="25"
                    alt="Black and White Portrait of a Man"
                    loading="lazy" />
                </a>
                <ul
                  class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="navbarDropdownMenuAvatar">
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
      <main style="margin-top: 58px">
        <div class="container">
          <div class="card">
            <div class="card-body">
              <h1 class="text-center" style="color: #3614DF;">Obtenir le profil
                le plus performant du stagiaire.</h1>
            </div>
          </div>

          <div class="container py-5">
            <div class="main-timeline-2">
              <div class="timeline-2 left-2">
                <div class="card">
                  <img src="../images/Hiring.gif" class="card-img-top"
                    alt="Responsive image">
                  <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Ut enim ad minim veniam</h4>
                    <p class="text-muted mb-4"><i class="far fa-clock"
                        aria-hidden="true"></i> 2017</p>
                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur
                      adipiscing elit, sed do eiusmod tempor
                    </p>
                  </div>
                </div>
              </div>
              <div class="timeline-2 right-2">
                <div class="card">
                  <svg class="animated" id="freepik_stories-connecting-teams"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 500 500" version="1.1"
                    xmlns:svgjs="http://svgjs.com/svgjs"><style>svg#freepik_stories-connecting-teams:not(.animated) .animable {opacity: 0;}svg#freepik_stories-connecting-teams.animated #freepik--gear-3--inject-29 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideLeft,1.5s Infinite  linear heartbeat;animation-delay: 0s,1s;}svg#freepik_stories-connecting-teams.animated #freepik--Character2--inject-29 {animation: 1.5s Infinite  linear heartbeat;animation-delay: 0s;}svg#freepik_stories-connecting-teams.animated #freepik--gear-1--inject-29 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideUp;animation-delay: 0s;}            @keyframes slideLeft {                0% {                    opacity: 0;                    transform: translateX(-30px);                }                100% {                    opacity: 1;                    transform: translateX(0);                }            }                    @keyframes heartbeat {                0% {                    transform: scale(1);                }                10% {                    transform: scale(1.1);                }                30% {                    transform: scale(1);                }                40% {                    transform: scale(1);                }                50% {                    transform: scale(1.1);                }                60% {                    transform: scale(1);                }                100% {                    transform: scale(1);                }            }                    @keyframes slideUp {                0% {                    opacity: 0;                    transform: translateY(30px);                }                100% {                    opacity: 1;                    transform: inherit;                }            }        </style><g
                      id="freepik--background-simple--inject-29"
                      style="transform-origin: 251.923px 255.51px 0px;"
                      class="animable"><path
                        d="M387.62,116.72S330.07,67.63,254.74,74.4s-96.47,43.16-120.17,82.94c-18.65,31.31-28.2,68.15-40,102.37C83.84,291.05,61.89,322,65.14,356.51c4.11,43.7,47.1,72.17,87.15,79.21,55.89,9.83,90-29.45,132.21-58.67l.24-.16a145.76,145.76,0,0,1,19.09-11.36c52.47-25.39,106.64-3.38,127.79-63.47S425.7,158.19,387.62,116.72Z"
                        style="fill: rgb(146, 227, 169); transform-origin: 251.923px 255.51px 0px;"
                        id="elmx7431zhv3" class="animable"></path><g
                        id="elpuc062cmdz"><path
                          d="M387.62,116.72S330.07,67.63,254.74,74.4s-96.47,43.16-120.17,82.94c-18.65,31.31-28.2,68.15-40,102.37C83.84,291.05,61.89,322,65.14,356.51c4.11,43.7,47.1,72.17,87.15,79.21,55.89,9.83,90-29.45,132.21-58.67l.24-.16a145.76,145.76,0,0,1,19.09-11.36c52.47-25.39,106.64-3.38,127.79-63.47S425.7,158.19,387.62,116.72Z"
                          style="fill: rgb(255, 255, 255); opacity: 0.7; transform-origin: 251.923px 255.51px 0px;"
                          class="animable"></path></g></g><g
                      id="freepik--character-3--inject-29"
                      style="transform-origin: 329.987px 342.919px 0px;"
                      class="animable"><g
                        style="clip-path: url(&quot;#freepik--clip-path--inject-29&quot;); transform-origin: 329.987px 342.919px 0px;"
                        id="elasv0bi4ku6" class="animable"><path
                          d="M311.71,286.65a86.39,86.39,0,0,1-12.9.91c-7.46,0-21,.68-21.72,14.71s11.32,17.2,18.1,17S305.83,317,305.83,317s4.07,20.36-3.62,31-17,15.38-19.69,28.06-1.13,16.52-1.13,16.52,36.21,14,61.1,5.88,27.6-5.66,40.95-25.35-1.58-25.11-10.18-33-19.23-15.62-16.52-26.7S362,297.52,352,288s-20.36-9.05-26-5.65S311.71,286.65,311.71,286.65Z"
                          style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 332.912px 340.56px 0px;"
                          id="elcit46sz05p9" class="animable"></path><path
                          d="M287.13,301.71c1.84-.21,4.14.29,6.86,2.32,7.79,5.85,15.53,7.53,24.78.71a97.75,97.75,0,0,0,14-12.23"
                          style="fill: none; stroke: rgb(255, 255, 255); stroke-linecap: round; stroke-linejoin: round; transform-origin: 309.95px 300.844px 0px;"
                          id="eliq3gdayauys" class="animable"></path><path
                          d="M281.81,305A8.26,8.26,0,0,1,284,302.9"
                          style="fill: none; stroke: rgb(255, 255, 255); stroke-linecap: round; stroke-linejoin: round; transform-origin: 282.905px 303.95px 0px;"
                          id="el11eh84dq7ad" class="animable"></path><path
                          d="M364.75,380.18a10.09,10.09,0,0,1-4,2.76"
                          style="fill: none; stroke: rgb(255, 255, 255); stroke-linecap: round; stroke-linejoin: round; transform-origin: 362.75px 381.56px 0px;"
                          id="elbobawuorr2t" class="animable"></path><path
                          d="M334.9,304s-5.84,7.8-1.95,14.62,17.54,7.79,29.72,23.37c7.74,9.91,8.78,22.38,6,31"
                          style="fill: none; stroke: rgb(255, 255, 255); stroke-linecap: round; stroke-linejoin: round; transform-origin: 350.842px 338.495px 0px;"
                          id="eljr0cdo9svg" class="animable"></path><path
                          d="M364.13,338.13s21.91,15.1,14.12,36"
                          style="fill: none; stroke: rgb(255, 255, 255); stroke-linecap: round; stroke-linejoin: round; transform-origin: 372.028px 356.13px 0px;"
                          id="elubsksvtcc9j" class="animable"></path><path
                          d="M271.21,379.2s21-4.29,31.9-10.86,18.56-5.88,23.54-3.62,22,19.92,30.55,23.31l8.59,3.39s-9.27,10.87-36.43,10.19-40.73-5-48.2-10.19A28,28,0,0,1,271.21,379.2Z"
                          style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 318.5px 382.382px 0px;"
                          id="eln56zk26txb" class="animable"></path><path
                          d="M315.56,353.41a83.67,83.67,0,0,1-5.66,14.71c-4.07,8.37-5.65,14.93.46,15.38s14.93-9.05,17-14.25,6.79-26,6.79-26Z"
                          style="fill: rgb(255, 255, 255); transform-origin: 320.226px 363.383px 0px;"
                          id="el5hnjqtthhwg" class="animable"></path><g
                          style="clip-path: url(&quot;#freepik--clip-path-2--inject-29&quot;); transform-origin: 320.211px 363.366px 0px;"
                          id="elqu22aohixw" class="animable"><path
                            d="M309.9,368.12c-4.07,8.37-5.65,14.93.46,15.38a9,9,0,0,0,4.57-1.12c3.84-6,3.84-15.12,3.84-15.12l13.35-15.57c1.14-4.71,2-8.46,2-8.46l-18.56,10.18A83.67,83.67,0,0,1,309.9,368.12Z"
                            style="fill: rgb(146, 227, 169); transform-origin: 320.211px 363.366px 0px;"
                            id="elg60y9cm8hf6" class="animable"></path><g
                            id="elvnc95q8rcu"><path
                              d="M309.9,368.12c-4.07,8.37-5.65,14.93.46,15.38a9,9,0,0,0,4.57-1.12c3.84-6,3.84-15.12,3.84-15.12l13.35-15.57c1.14-4.71,2-8.46,2-8.46l-18.56,10.18A83.67,83.67,0,0,1,309.9,368.12Z"
                              style="fill: rgb(255, 255, 255); opacity: 0.5; transform-origin: 320.211px 363.366px 0px;"
                              class="animable"></path></g></g><path
                          d="M315.56,353.41a83.67,83.67,0,0,1-5.66,14.71c-4.07,8.37-5.65,14.93.46,15.38s14.93-9.05,17-14.25,6.79-26,6.79-26Z"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 320.226px 363.383px 0px;"
                          id="elxxwgehx3yfe" class="animable"></path><path
                          d="M300.4,310.19s-2.72,20.36-3.17,31.68,5.66,17.65,10.64,17.42,25.79-12.44,26-13.12,3.39-2.49,3.39-2.49.91,2.94,4.3.45,5.43-12.22,4.53-14.93-1.81-2.27-2.72-1.81-4.52,2.94-8.6,2.48-11.76-5-12.67-13.12-.22-10.86-.22-10.86S311.71,316.07,300.4,310.19Z"
                          style="fill: rgb(255, 255, 255); transform-origin: 321.755px 332.593px 0px;"
                          id="elast19ajthoi" class="animable"></path><g
                          style="clip-path: url(&quot;#freepik--clip-path-3--inject-29&quot;); transform-origin: 319.393px 332.583px 0px;"
                          id="elxx5i8s7e2bp" class="animable"><path
                            d="M309.71,353.22c-6.8,1.36-8.61-4.08-8.61-7.7s1.81-13.14,1.81-13.14c-4.08-1.81-2.51-2.05,2.69-5s4.11-9.06,4.11-9.06l12-10.87a9.7,9.7,0,0,1,.19-1.57s-10.19,10.18-21.5,4.3c0,0-2.72,20.36-3.17,31.68s5.66,17.65,10.64,17.42c4.51-.2,22.05-10.27,25.45-12.65C325.37,349,314,352.37,309.71,353.22Z"
                            style="fill: rgb(146, 227, 169); transform-origin: 315.263px 332.583px 0px;"
                            id="el8fbg620hqn" class="animable"></path><path
                            d="M341.58,344.13l-3,.91C339.27,345.25,340.22,345.13,341.58,344.13Z"
                            style="fill: rgb(146, 227, 169); transform-origin: 340.08px 344.629px 0px;"
                            id="eljln4xe25rm" class="animable"></path><g
                            id="elayfftililjk"><g
                              style="opacity: 0.5; transform-origin: 319.393px 332.583px 0px;"
                              class="animable"><path
                                d="M309.71,353.22c-6.8,1.36-8.61-4.08-8.61-7.7s1.81-13.14,1.81-13.14c-4.08-1.81-2.51-2.05,2.69-5s4.11-9.06,4.11-9.06l12-10.87a9.7,9.7,0,0,1,.19-1.57s-10.19,10.18-21.5,4.3c0,0-2.72,20.36-3.17,31.68s5.66,17.65,10.64,17.42c4.51-.2,22.05-10.27,25.45-12.65C325.37,349,314,352.37,309.71,353.22Z"
                                style="fill: rgb(255, 255, 255); transform-origin: 315.263px 332.583px 0px;"
                                id="el3sa3zuxmhdj" class="animable"></path><path
                                d="M341.58,344.13l-3,.91C339.27,345.25,340.22,345.13,341.58,344.13Z"
                                style="fill: rgb(255, 255, 255); transform-origin: 340.08px 344.629px 0px;"
                                id="el75cz88q7545"
                                class="animable"></path></g></g></g><path
                          d="M300.4,310.19s-2.72,20.36-3.17,31.68,5.66,17.65,10.64,17.42,25.79-12.44,26-13.12,3.39-2.49,3.39-2.49.91,2.94,4.3.45,5.43-12.22,4.53-14.93-1.81-2.27-2.72-1.81-4.52,2.94-8.6,2.48-11.76-5-12.67-13.12-.22-10.86-.22-10.86S311.71,316.07,300.4,310.19Z"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 321.755px 332.593px 0px;"
                          id="el0lnkx1h6p6u" class="animable"></path><path
                          d="M309.45,320.82a13.41,13.41,0,0,1-3.85,6.57c-2.94,2.48-5.2,1.13-5.2,2.94s5.88,2.26,5.88,2.26"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 304.925px 326.705px 0px;"
                          id="elmp5xk9rfaq" class="animable"></path><path
                          d="M304.47,337.79s7.7,4.08,16.29-1.81"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 312.615px 337.573px 0px;"
                          id="el29rlwsse10w" class="animable"></path><path
                          d="M307.23,338.82s-1,8,1.77,7.8,6.56-7.92,6.56-7.92S309.74,340.08,307.23,338.82Z"
                          style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 311.307px 342.662px 0px;"
                          id="elubqas8oxpqi" class="animable"></path><path
                          d="M318.25,324.41c-.31,1.46-1,2.57-1.45,2.46s-.63-1.38-.31-2.84,1-2.57,1.45-2.47S318.57,322.94,318.25,324.41Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 317.37px 324.216px 0px;"
                          id="elvx9o2vo7t3" class="animable"></path><path
                          d="M307.17,321.47c-.32,1.46-1,2.57-1.46,2.46s-.63-1.38-.31-2.85,1-2.56,1.46-2.46S307.48,320,307.17,321.47Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 306.283px 321.276px 0px;"
                          id="elwwixxdf58i" class="animable"></path><path
                          d="M303.73,314.26s2.44-4.38,5.85,1.46"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 306.655px 314.202px 0px;"
                          id="el7dt9itwwdqg" class="animable"></path><path
                          d="M315.42,317.18s5.84-3.4,8.28,6.82"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 319.56px 320.319px 0px;"
                          id="elnle8j7l827q" class="animable"></path><path
                          d="M345,321.05s3-8.94-4.76-21.72c-5.88-9.73-16.06-13.81-19.91-13.58s-8.6.9-8.6.9L325.29,281s12.45,1.81,18.78,11.76,6.34,22.86,5,27.38l-1.36,4.53Z"
                          style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 330.755px 302.835px 0px;"
                          id="elban43mar6qq" class="animable"></path><path
                          d="M320.38,355.82a2.45,2.45,0,0,1,1.85.86c17.51-6,18.32-18.82,18.34-19.4a1.18,1.18,0,0,1,1.22-1.2,1.24,1.24,0,0,1,1.12,1.31c0,.64-.83,15.17-20,21.69a2.63,2.63,0,0,1-2.52,2.24,2.76,2.76,0,0,1,0-5.5Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 330.389px 348.7px 0px;"
                          id="elec584nfufwo" class="animable"></path><ellipse
                          cx="344.01" cy="329.69" rx="8.4" ry="10.19"
                          style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 344.01px 329.69px 0px;"
                          id="elkxrrgce6d6g" class="animable"></ellipse><path
                          d="M345.88,333.5s-1.13-1.82-2,3.16-.91,17-.91,17-2.26.23-5.2-6.11-2.49-7.92-3.62-4.29,2.71,10.63,3.84,12.89a22.51,22.51,0,0,0,1.81,3.17s-9,5.66-9.5,9.73,2.26,36.66,2.26,36.66l12.22-2.26-5.2-27.61s16.29-17.88,17.87-21.27-4.3-14-6.11-20.14-4.07-5.66-4.3-4.07a28.8,28.8,0,0,0-.22,3.39s-.46,13.13.45,18.1Z"
                          style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 343.978px 367.52px 0px;"
                          id="elm5khikw04og" class="animable"></path><path
                          d="M351.31,334.4s.91,12.45,2,16.75"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 352.31px 342.775px 0px;"
                          id="elaz3va7ysifj" class="animable"></path></g></g><g
                      id="freepik--gear-3--inject-29"
                      style="transform-origin: 320.89px 335.47px 0px;"
                      class="animable"><path
                        d="M410.57,346.93V328.51l-10.29-2.34a79,79,0,0,0-4.77-18.12l7.81-7.23-9.21-16L384,288a80.89,80.89,0,0,0-13.19-13.29L374,264.51l-16-9.22L350.86,263a79.81,79.81,0,0,0-18.08-4.93l-2.36-10.37H312L309.66,258a79,79,0,0,0-18.12,4.77L284.3,255l-15.95,9.21,3.12,10.09a80.84,80.84,0,0,0-13.29,13.18L248,284.32l-9.21,15.95,7.73,7.17a79.28,79.28,0,0,0-4.92,18.08l-10.38,2.36V346.3l10.29,2.34a80,80,0,0,0,4.77,18.12L238.46,374l9.22,16,10.09-3.12A80.44,80.44,0,0,0,271,400.12l-3.15,10.19,16,9.21,7.16-7.74A78.87,78.87,0,0,0,309,416.71l2.35,10.38h18.43l2.34-10.29A80.16,80.16,0,0,0,350.25,412l7.23,7.8,16-9.21-3.12-10.09a80.83,80.83,0,0,0,13.29-13.18l10.18,3.15,9.21-16-7.73-7.16a80,80,0,0,0,4.93-18.09Zm-22.77-9.52a66.91,66.91,0,1,1-66.91-66.91A66.91,66.91,0,0,1,387.8,337.41Z"
                        style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-miterlimit: 10; stroke-width: 1.05114px; transform-origin: 320.895px 337.395px 0px;"
                        id="el4bxdigwsa9h" class="animable"></path><path
                        d="M410.57,343.05V324.63l-10.29-2.34a79,79,0,0,0-4.77-18.12l7.81-7.23-9.21-16L384,284.1a80.89,80.89,0,0,0-13.19-13.29L374,260.63l-16-9.22-7.17,7.74a79.81,79.81,0,0,0-18.08-4.93l-2.36-10.37H312l-2.34,10.29a79,79,0,0,0-18.12,4.77l-7.24-7.81-15.95,9.21,3.12,10.09a80.84,80.84,0,0,0-13.29,13.18L248,280.44l-9.21,15.95,7.73,7.17a79.28,79.28,0,0,0-4.92,18.08L231.21,324v18.42l10.29,2.34a80,80,0,0,0,4.77,18.12l-7.81,7.23,9.22,16L257.77,383A80.44,80.44,0,0,0,271,396.24l-3.15,10.19,16,9.21,7.16-7.74A78.87,78.87,0,0,0,309,412.83l2.35,10.38h18.43l2.34-10.29a80.16,80.16,0,0,0,18.12-4.77l7.23,7.8,16-9.21-3.12-10.09a80.83,80.83,0,0,0,13.29-13.18l10.18,3.15,9.21-16-7.73-7.16a79.9,79.9,0,0,0,4.93-18.09Zm-22.77-9.52a66.91,66.91,0,1,1-66.91-66.91A66.91,66.91,0,0,1,387.8,333.53Z"
                        style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 320.89px 333.53px 0px;"
                        id="el345jlsrqj2" class="animable"></path></g><g
                      id="freepik--Character2--inject-29"
                      style="transform-origin: 307.355px 169.378px 0px;"
                      class="animable animator-active"><g
                        style="clip-path: url(&quot;#freepik--clip-path-4--inject-29&quot;); transform-origin: 307.355px 169.378px 0px;"
                        id="eledw16tr6t45" class="animable"><path
                          d="M251.93,219.93s24.42-20.59,44.8-26.84,67,9.68,67,9.68-5.05,18.37-35.72,27.65-44,8.68-60.54,2S251.93,219.93,251.93,219.93Z"
                          style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 307.824px 214.527px 0px;"
                          id="eljlq35ko94po" class="animable"></path><path
                          d="M285.43,185.42a171.13,171.13,0,0,1,5.65,19.17c2.22,9.89,6.46,16.14,13.52,8.68s8.88-22.4,8.88-27-.4-13.53-.4-13.53-9.69,14.94-14.94,16.35S285.43,185.42,285.43,185.42Z"
                          style="fill: rgb(255, 255, 255); transform-origin: 299.455px 194.648px 0px;"
                          id="el9rn9yk3gzfo" class="animable"></path><g
                          style="clip-path: url(&quot;#freepik--clip-path-5--inject-29&quot;); transform-origin: 298.21px 196.795px 0px;"
                          id="elv16fpnt995g" class="animable"><path
                            d="M309.65,177.62c-3.3,4.48-8.25,10.55-11.51,11.43-5.24,1.41-12.71-3.63-12.71-3.63a171.13,171.13,0,0,1,5.65,19.17c1.23,5.49,3.09,9.86,5.71,11.38l14.2-36.3Z"
                            style="fill: rgb(146, 227, 169); transform-origin: 298.21px 196.795px 0px;"
                            id="elbxw0odne1pv" class="animable"></path><g
                            id="elyyp1piiax6e"><path
                              d="M309.65,177.62c-3.3,4.48-8.25,10.55-11.51,11.43-5.24,1.41-12.71-3.63-12.71-3.63a171.13,171.13,0,0,1,5.65,19.17c1.23,5.49,3.09,9.86,5.71,11.38l14.2-36.3Z"
                              style="fill: rgb(255, 255, 255); opacity: 0.5; transform-origin: 298.21px 196.795px 0px;"
                              class="animable"></path></g></g><path
                          d="M285.43,185.42a171.13,171.13,0,0,1,5.65,19.17c2.22,9.89,6.46,16.14,13.52,8.68s8.88-22.4,8.88-27-.4-13.53-.4-13.53-9.69,14.94-14.94,16.35S285.43,185.42,285.43,185.42Z"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 299.455px 194.648px 0px;"
                          id="el5xnoicqmhtq" class="animable"></path><path
                          d="M272.31,157s-2.62-4.23-4.64-.4.81,9.49,2.83,11.91,5.24,4.23,5.65,2S272.31,157,272.31,157Z"
                          style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 271.577px 163.259px 0px;"
                          id="elm6jblwmjnpg" class="animable"></path><path
                          d="M257.14,120.68s-4.79,1.84-5.42,6.49a11,11,0,0,0,2,7.86s-3.39,3.34-2.63,7.59,5.78,6.22,5.78,6.22-1.35,4.22,1.06,7.21,5.89.93,5.89.93a4.76,4.76,0,0,0,2.87,4.27c3,1.31,6.93.1,6.93.1a12.48,12.48,0,0,0,3.59.68c2.67.25,5.47-2.89,5.47-2.89l43.14-6.41a7.29,7.29,0,0,0,5.18-4c1.47-3.37-2.4-11.47-2.4-11.47s4-1.64,2.82-7.58-3-7.24-3-7.24,2.5-8.23-2.17-11.89-7.54-1.8-7.54-1.8-3.69-7.88-9.5-7.54-7.47,1.6-7.47,1.6S297.46,99,293,99.55s-5.74,3.74-5.74,3.74-8.38-3.08-12.3-.16a20,20,0,0,0-5.57,6.06s-5.12-.91-7.14,2.24a14.26,14.26,0,0,0-2,7S258.16,117.94,257.14,120.68Z"
                          style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 291.308px 130.77px 0px;"
                          id="elfso1jhaivhl" class="animable"></path><path
                          d="M268.68,145.06a193.57,193.57,0,0,0,7.47,27.85c5,14.12,11.7,19.37,18.56,21.59s17.16-11.71,19.78-20.58,2.42-10.5,2.42-10.5,7.27-1.81,9.28-8.88-3-11.5-7.06-9.89-4.84,6.87-4.84,6.87-6.86-3.64-9.49-8.28-2.22-8.07-2.22-8.07-6.66-5.45-19.17-3.23A17.89,17.89,0,0,0,268.68,145.06Z"
                          style="fill: rgb(255, 255, 255); transform-origin: 297.664px 163.072px 0px;"
                          id="elmugedmf6ly" class="animable"></path><g
                          style="clip-path: url(&quot;#freepik--clip-path-6--inject-29&quot;); transform-origin: 291.585px 163.903px 0px;"
                          id="elp34mmeebi0m" class="animable"><path
                            d="M290.68,190.34c-4-4.15-1.1-13.16-1.1-13.16-5.48-1.1-4.93-9.88-4.93-9.88l-3.84,6s-7.68-23.05-8.23-29.08c-.46-5.08,4.88-9.75,6.59-11.11a17.71,17.71,0,0,0-10.49,11.91,193.57,193.57,0,0,0,7.47,27.85c5,14.12,11.7,19.37,18.56,21.59s17.16-11.71,19.78-20.58c0,0-6.8,9.84-9,12.58S294.71,194.5,290.68,190.34Z"
                            style="fill: rgb(146, 227, 169); transform-origin: 291.585px 163.903px 0px;"
                            id="eluszmyt0up5" class="animable"></path><g
                            id="el0aju4jwafh8q"><path
                              d="M290.68,190.34c-4-4.15-1.1-13.16-1.1-13.16-5.48-1.1-4.93-9.88-4.93-9.88l-3.84,6s-7.68-23.05-8.23-29.08c-.46-5.08,4.88-9.75,6.59-11.11a17.71,17.71,0,0,0-10.49,11.91,193.57,193.57,0,0,0,7.47,27.85c5,14.12,11.7,19.37,18.56,21.59s17.16-11.71,19.78-20.58c0,0-6.8,9.84-9,12.58S294.71,194.5,290.68,190.34Z"
                              style="fill: rgb(255, 255, 255); opacity: 0.5; transform-origin: 291.585px 163.903px 0px;"
                              class="animable"></path></g></g><path
                          d="M268.68,145.06a193.57,193.57,0,0,0,7.47,27.85c5,14.12,11.7,19.37,18.56,21.59s17.16-11.71,19.78-20.58,2.42-10.5,2.42-10.5,7.27-1.81,9.28-8.88-3-11.5-7.06-9.89-4.84,6.87-4.84,6.87-6.86-3.64-9.49-8.28-2.22-8.07-2.22-8.07-6.66-5.45-19.17-3.23A17.89,17.89,0,0,0,268.68,145.06Z"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 297.664px 163.072px 0px;"
                          id="eliukp61inc4" class="animable"></path><path
                          d="M285.23,161.2s-2.62,9.89-.4,12.51,6.65,3.23,9.68,1.82,3.43-5.05,3-5.85"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 290.796px 168.734px 0px;"
                          id="el159nlp6nztj" class="animable"></path><path
                          d="M286.64,180.17s6.06,4,13.12-1.61"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 293.2px 180.056px 0px;"
                          id="el55kt3rs6bso" class="animable"></path><path
                          d="M291.08,181.58s0,3.64,2.62,3.64,3.44-4.85,3.44-4.85A14.11,14.11,0,0,1,291.08,181.58Z"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 294.11px 182.795px 0px;"
                          id="elp64rxrisi5k" class="animable"></path><ellipse
                          cx="299.66" cy="161.81" rx="1.31" ry="2.02"
                          style="fill: rgb(38, 50, 56); transform-origin: 299.66px 161.81px 0px;"
                          id="elcljne2so6xi" class="animable"></ellipse><ellipse
                          cx="280.69" cy="163.83" rx="1.31" ry="2.02"
                          style="fill: rgb(38, 50, 56); transform-origin: 280.69px 163.83px 0px;"
                          id="elzqdqb4rgdu" class="animable"></ellipse><path
                          d="M274.13,155.75a8.51,8.51,0,0,1,7.87-4.64"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2.38218px; transform-origin: 278.065px 153.428px 0px;"
                          id="elhgv7q3i30jv" class="animable"></path><path
                          d="M293.3,150.3s6.46-2.42,10.49,2.83"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2.38218px; transform-origin: 298.545px 151.437px 0px;"
                          id="elmm1fufm0h6" class="animable"></path><path
                          d="M319.94,161.2a77.36,77.36,0,0,1-6.86,27.65,106.35,106.35,0,0,1-16.35,24s-6.86-.8-16.34-15.74a68.2,68.2,0,0,1-10.3-29.66"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 295.015px 187.025px 0px;"
                          id="elexldvptmuj" class="animable"></path><path
                          d="M322.16,157.77s1.41-4.24-.2-5.25-3.23,1.82-2.83,3.23l.4,1.42s-.2,3.83.41,4S322.16,157.77,322.16,157.77Z"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 320.9px 156.741px 0px;"
                          id="el8fla1xswztx" class="animable"></path><path
                          d="M296.73,212.86s2,16.75,5.45,26"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 299.455px 225.86px 0px;"
                          id="el0sjn78e58alb" class="animable"></path><path
                          d="M315.7,182.39s-6.46,3.23-5.85,5.65a3,3,0,0,0,4.24,2c1.41-.61,5.24-2,5.24-2l2.63,5.25s-4.44-2.83-6.66-2a15.34,15.34,0,0,0-4.24,2.62,2.48,2.48,0,0,0-3.43,1,10.63,10.63,0,0,0-1.62,4,5.86,5.86,0,0,0-2.22,4.44c0,2.82,0,5,1.82,6.66s3,1.61,3,1.61l1.61,1s-4,8.88-1.61,13.52,3.63,4.24,3.63,4.24l4.84,8.88L330,236.07l-6.66-14.93s11.1-22.81,9.89-26.44S327,186.43,324,183.4A6.36,6.36,0,0,0,315.7,182.39Z"
                          style="fill: rgb(255, 255, 255); transform-origin: 318.556px 210.276px 0px;"
                          id="elcpki0cfdjlk" class="animable"></path><g
                          style="clip-path: url(&quot;#freepik--clip-path-7--inject-29&quot;); transform-origin: 314.205px 208.506px 0px;"
                          id="elpghefu47px" class="animable"><path
                            d="M309.82,205c-1.3-.21-3.57-2.37-5.33-4.23a5.29,5.29,0,0,0-.7,2.63c0,2.82,0,5,1.82,6.66s3,1.61,3,1.61l1.61,1s-4,8.88-1.61,13.52,3.63,4.24,3.63,4.24c-2.62-3.39,1.45-9.47,1.84-14.53S312.16,205.37,309.82,205Z"
                            style="fill: rgb(146, 227, 169); transform-origin: 308.957px 215.604px 0px;"
                            id="elfymd4wavlz" class="animable"></path><path
                            d="M312.27,230.42l1.21,2.22A9.14,9.14,0,0,0,312.27,230.42Z"
                            style="fill: rgb(146, 227, 169); transform-origin: 312.875px 231.53px 0px;"
                            id="elnzfi68hjoj" class="animable"></path><path
                            d="M314,191.87a17.07,17.07,0,0,0-2.92,2,2.65,2.65,0,0,0-1.95-.22l8.11,3.91S313.59,193.46,314,191.87Z"
                            style="fill: rgb(146, 227, 169); transform-origin: 313.185px 194.715px 0px;"
                            id="el67svtutw2qw" class="animable"></path><path
                            d="M305.35,199.56l6.42,3.09L307.55,195a10.7,10.7,0,0,0-1.54,3.9A5.71,5.71,0,0,0,305.35,199.56Z"
                            style="fill: rgb(146, 227, 169); transform-origin: 308.56px 198.825px 0px;"
                            id="el2bs7as9ixe4" class="animable"></path><path
                            d="M314.09,190.06c1.41-.61,5.24-2,5.24-2l2.63,5.25s-4.44-2.83-6.66-2c3.91.31,9.32,5.15,9.32,5.15s-2.33-12.47-7-12.08a23.4,23.4,0,0,0-7.31,2.09,2,2,0,0,0-.45,1.61A3,3,0,0,0,314.09,190.06Z"
                            style="fill: rgb(146, 227, 169); transform-origin: 317.227px 190.416px 0px;"
                            id="elbdfh7fhv6jg" class="animable"></path><g
                            id="elgz9m6dfqwht"><g
                              style="opacity: 0.5; transform-origin: 314.205px 208.506px 0px;"
                              class="animable"><path
                                d="M309.82,205c-1.3-.21-3.57-2.37-5.33-4.23a5.29,5.29,0,0,0-.7,2.63c0,2.82,0,5,1.82,6.66s3,1.61,3,1.61l1.61,1s-4,8.88-1.61,13.52,3.63,4.24,3.63,4.24c-2.62-3.39,1.45-9.47,1.84-14.53S312.16,205.37,309.82,205Z"
                                style="fill: rgb(255, 255, 255); transform-origin: 308.957px 215.604px 0px;"
                                id="elbehjwuqi77a" class="animable"></path><path
                                d="M312.27,230.42l1.21,2.22A9.14,9.14,0,0,0,312.27,230.42Z"
                                style="fill: rgb(255, 255, 255); transform-origin: 312.875px 231.53px 0px;"
                                id="elr5vobvoswt" class="animable"></path><path
                                d="M314,191.87a17.07,17.07,0,0,0-2.92,2,2.65,2.65,0,0,0-1.95-.22l8.11,3.91S313.59,193.46,314,191.87Z"
                                style="fill: rgb(255, 255, 255); transform-origin: 313.185px 194.715px 0px;"
                                id="elzmdvraqhcck" class="animable"></path><path
                                d="M305.35,199.56l6.42,3.09L307.55,195a10.7,10.7,0,0,0-1.54,3.9A5.71,5.71,0,0,0,305.35,199.56Z"
                                style="fill: rgb(255, 255, 255); transform-origin: 308.56px 198.825px 0px;"
                                id="elwnd4pr3l0sg" class="animable"></path><path
                                d="M314.09,190.06c1.41-.61,5.24-2,5.24-2l2.63,5.25s-4.44-2.83-6.66-2c3.91.31,9.32,5.15,9.32,5.15s-2.33-12.47-7-12.08a23.4,23.4,0,0,0-7.31,2.09,2,2,0,0,0-.45,1.61A3,3,0,0,0,314.09,190.06Z"
                                style="fill: rgb(255, 255, 255); transform-origin: 317.227px 190.416px 0px;"
                                id="el7bwhmw4nbky"
                                class="animable"></path></g></g></g><path
                          d="M315.7,182.39s-6.46,3.23-5.85,5.65a3,3,0,0,0,4.24,2c1.41-.61,5.24-2,5.24-2l2.63,5.25s-4.44-2.83-6.66-2a15.34,15.34,0,0,0-4.24,2.62,2.48,2.48,0,0,0-3.43,1,10.63,10.63,0,0,0-1.62,4,5.86,5.86,0,0,0-2.22,4.44c0,2.82,0,5,1.82,6.66s3,1.61,3,1.61l1.61,1s-4,8.88-1.61,13.52,3.63,4.24,3.63,4.24l4.84,8.88L330,236.07l-6.66-14.93s11.1-22.81,9.89-26.44S327,186.43,324,183.4A6.36,6.36,0,0,0,315.7,182.39Z"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 318.556px 210.276px 0px;"
                          id="eljpq1x2ocycm" class="animable"></path><line
                          x1="321.96" y1="193.29" x2="325.59" y2="197.73"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 323.775px 195.51px 0px;"
                          id="eltccojoo0np" class="animable"></line><line
                          x1="311.06" y1="193.89" x2="319.13" y2="200.15"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 315.095px 197.02px 0px;"
                          id="elstiphqt7to" class="animable"></line><line
                          x1="306.01" y1="198.94" x2="313.88" y2="204.59"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 309.945px 201.765px 0px;"
                          id="el7w7wqumulk" class="animable"></line><path
                          d="M310.25,212.66a8.28,8.28,0,0,1-2.82-5.85"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 308.84px 209.735px 0px;"
                          id="elk7p5n892vh9" class="animable"></path></g></g><g
                      id="freepik--gear-2--inject-29"
                      style="transform-origin: 297.305px 163.605px 0px;"
                      class="animable"><path
                        d="M387,175.09V156.66l-10.29-2.34a79.64,79.64,0,0,0-4.77-18.12l7.81-7.23-9.21-16-10.09,3.12a81,81,0,0,0-13.19-13.3l3.15-10.18-15.95-9.21-7.17,7.73a79.81,79.81,0,0,0-18.08-4.93l-2.36-10.37H288.4l-2.34,10.29a79.37,79.37,0,0,0-18.12,4.77l-7.24-7.81-15.95,9.21,3.12,10.09a80.5,80.5,0,0,0-13.29,13.19l-10.19-3.15-9.21,15.95,7.73,7.17A79.81,79.81,0,0,0,218,153.67L207.61,156v18.42l10.29,2.35a79.94,79.94,0,0,0,4.77,18.11l-7.81,7.24,9.21,15.95,10.1-3.12a80.06,80.06,0,0,0,13.18,13.29l-3.15,10.19,16,9.21,7.16-7.73a80,80,0,0,0,18.08,4.93l2.36,10.37h18.43L308.53,245a80.16,80.16,0,0,0,18.12-4.77l7.23,7.81,15.95-9.21-3.12-10.1A80.5,80.5,0,0,0,360,215.5l10.18,3.15,9.21-16-7.73-7.17a79.81,79.81,0,0,0,4.93-18.08Zm-22.77-9.53a66.91,66.91,0,1,1-66.91-66.9A66.91,66.91,0,0,1,364.2,165.56Z"
                        style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-miterlimit: 10; stroke-width: 1.05114px; transform-origin: 297.305px 165.52px 0px;"
                        id="elvog0q1ycqo" class="animable"></path><path
                        d="M387,171.21V152.78l-10.29-2.34a79.42,79.42,0,0,0-4.77-18.11l7.81-7.24-9.21-16-10.09,3.12A81,81,0,0,0,347.23,99l3.15-10.18-15.95-9.21-7.17,7.73a79.81,79.81,0,0,0-18.08-4.93L306.82,72H288.4l-2.34,10.29a79.37,79.37,0,0,0-18.12,4.77l-7.24-7.81-15.95,9.21,3.12,10.1a80.06,80.06,0,0,0-13.29,13.18l-10.19-3.15-9.21,16,7.73,7.17A79.81,79.81,0,0,0,218,149.79l-10.37,2.36v18.42l10.29,2.35A79.94,79.94,0,0,0,222.67,191l-7.81,7.24,9.21,15.95,10.1-3.12a80.5,80.5,0,0,0,13.18,13.3l-3.15,10.18,16,9.21,7.16-7.73A80,80,0,0,0,285.4,241l2.36,10.37h18.43l2.34-10.29a80.16,80.16,0,0,0,18.12-4.77l7.23,7.81,15.95-9.21-3.12-10.1A80.5,80.5,0,0,0,360,211.62l10.18,3.15,9.21-16-7.73-7.17a79.81,79.81,0,0,0,4.93-18.08Zm-22.77-9.53a66.91,66.91,0,1,1-66.91-66.9A66.91,66.91,0,0,1,364.2,161.68Z"
                        style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 297.315px 161.685px 0px;"
                        id="ell2zbm0vv4lr" class="animable"></path></g><g
                      id="freepik--character-1--inject-29"
                      style="transform-origin: 160.165px 278.9px 0px;"
                      class="animable"><g
                        style="clip-path: url(&quot;#freepik--clip-path-8--inject-29&quot;); transform-origin: 160.165px 278.9px 0px;"
                        id="el8242dtzh0wa" class="animable"><path
                          d="M139.5,304.76s5,18.95,10.05,27.32,8,11.45,8,11.45a81.57,81.57,0,0,1-35.62-13.21C105,318.64,93.84,296,93.84,296l29.68-11.45Z"
                          style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.32365px; transform-origin: 125.695px 314.04px 0px;"
                          id="elko0ca6mir68" class="animable"></path><path
                          d="M148.08,303.23a25.72,25.72,0,0,0-1.29,6c-.22,3,0,6.86-1.29,6s-4.71-8.15-4.71-8.15Z"
                          style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 144.435px 309.291px 0px;"
                          id="eli1aqa6x1d5c" class="animable"></path><polygon
                          points="136.28 288.87 148.07 303.23 138 311.16 130.28 297.23 136.28 288.87"
                          style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 139.175px 300.015px 0px;"
                          id="el7oshx03nodw" class="animable"></polygon><path
                          d="M136.28,257.57s-3.21,10.72-5.78,16.51a73.86,73.86,0,0,0-3.43,8.78,33.45,33.45,0,0,0,3.21,9.44c2.79,5.79,5.15,9.64,5.36,9s-1.28-4.93,4.93-12.65,9.22-11.14,9.22-11.14Z"
                          style="fill: rgb(255, 255, 255); transform-origin: 138.43px 279.47px 0px;"
                          id="elnl3wk8zoiyr" class="animable"></path><g
                          style="clip-path: url(&quot;#freepik--clip-path-9--inject-29&quot;); transform-origin: 137.54px 272.935px 0px;"
                          id="el2fdi2t41s5v" class="animable"><path
                            d="M146.82,281l1.21-2L144.39,271l-.66-2.41-6.12-9-2,.16c-1.07,3.42-3.27,10.19-5.13,14.39a73.86,73.86,0,0,0-3.43,8.78,16.49,16.49,0,0,0,.41,2l15.06,1.36C144.29,284.07,145.71,282.34,146.82,281Z"
                            style="fill: rgb(146, 227, 169); transform-origin: 137.54px 272.935px 0px;"
                            id="eleccdi0ivhg" class="animable"></path><g
                            id="elebvqfefqicr"><path
                              d="M146.82,281l1.21-2L144.39,271l-.66-2.41-6.12-9-2,.16c-1.07,3.42-3.27,10.19-5.13,14.39a73.86,73.86,0,0,0-3.43,8.78,16.49,16.49,0,0,0,.41,2l15.06,1.36C144.29,284.07,145.71,282.34,146.82,281Z"
                              style="fill: rgb(255, 255, 255); opacity: 0.5; transform-origin: 137.54px 272.935px 0px;"
                              class="animable"></path></g></g><path
                          d="M136.28,257.57s-3.21,10.72-5.78,16.51a73.86,73.86,0,0,0-3.43,8.78,33.45,33.45,0,0,0,3.21,9.44c2.79,5.79,5.15,9.64,5.36,9s-1.28-4.93,4.93-12.65,9.22-11.14,9.22-11.14Z"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 138.43px 279.47px 0px;"
                          id="el9fhjk8y7607" class="animable"></path><path
                          d="M126.85,276.43a35.88,35.88,0,0,0,5.36,14.37,111.09,111.09,0,0,0,8.15,10.72L128,316.33a53.9,53.9,0,0,0-4.15-16.1,53.13,53.13,0,0,1-4.29-14.58Z"
                          style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 129.96px 296.38px 0px;"
                          id="elm2eqi93nx1n" class="animable"></path><path
                          d="M186.23,246.85s-6,22.29-13.93,34.3-14.36,13.29-19.94,10.93-11.79-15-13.72-19.93-3-7.72-3-7.72-3.64,6.22-7.93-1.29-3.43-14.58-.64-17.58a11,11,0,0,1,6-3.43s9.22-1.28,7.72-6.21,14.36-16.94,32.58-13.08S186.23,246.85,186.23,246.85Z"
                          style="fill: rgb(255, 255, 255); transform-origin: 155.85px 257.573px 0px;"
                          id="elq45ekyhfbg" class="animable"></path><g
                          style="clip-path: url(&quot;#freepik--clip-path-10--inject-29&quot;); transform-origin: 155.85px 257.571px 0px;"
                          id="elmomcet5vv7s" class="animable"><path
                            d="M173.37,222.84c-18.22-3.86-34.08,8.15-32.58,13.08s-7.72,6.21-7.72,6.21a11,11,0,0,0-6,3.43c-2.79,3-3.65,10.08.64,17.58s7.93,1.29,7.93,1.29,1.07,2.79,3,7.72,8.15,17.57,13.72,19.93c3.95,1.67,8.33,1.51,13.36-3a25.33,25.33,0,0,1-11.23.86c-8.89-1.62-13.33-15.35-11.71-24.24s4-14.54,8.07-19.79a13.45,13.45,0,0,0,2.83-10.5s12.62,11.64,16.16,12.12,5.65-3.64,5.65-3.64,5.25,8.89,8.89,8.89h.1c1.12-3.58,1.75-5.93,1.75-5.93S191.59,226.7,173.37,222.84Z"
                            style="fill: rgb(146, 227, 169); transform-origin: 155.85px 257.571px 0px;"
                            id="elpwkokysdrc" class="animable"></path><g
                            id="elhg49pikv89m"><path
                              d="M173.37,222.84c-18.22-3.86-34.08,8.15-32.58,13.08s-7.72,6.21-7.72,6.21a11,11,0,0,0-6,3.43c-2.79,3-3.65,10.08.64,17.58s7.93,1.29,7.93,1.29,1.07,2.79,3,7.72,8.15,17.57,13.72,19.93c3.95,1.67,8.33,1.51,13.36-3a25.33,25.33,0,0,1-11.23.86c-8.89-1.62-13.33-15.35-11.71-24.24s4-14.54,8.07-19.79a13.45,13.45,0,0,0,2.83-10.5s12.62,11.64,16.16,12.12,5.65-3.64,5.65-3.64,5.25,8.89,8.89,8.89h.1c1.12-3.58,1.75-5.93,1.75-5.93S191.59,226.7,173.37,222.84Z"
                              style="fill: rgb(255, 255, 255); opacity: 0.5; transform-origin: 155.85px 257.571px 0px;"
                              class="animable"></path></g><path
                            d="M160.26,263.84s6.32-14.38,5.79-9.16-1.21,14.5-3.08,14.3S160.26,263.84,160.26,263.84Z"
                            style="fill: rgb(146, 227, 169); transform-origin: 163.171px 261.261px 0px;"
                            id="elp6yc4ptiavm" class="animable"></path><g
                            id="elbfsi1bx2ska"><path
                              d="M160.26,263.84s6.32-14.38,5.79-9.16-1.21,14.5-3.08,14.3S160.26,263.84,160.26,263.84Z"
                              style="fill: rgb(255, 255, 255); opacity: 0.5; transform-origin: 163.171px 261.261px 0px;"
                              class="animable"></path></g></g><path
                          d="M186.23,246.85s-6,22.29-13.93,34.3-14.36,13.29-19.94,10.93-11.79-15-13.72-19.93-3-7.72-3-7.72-3.64,6.22-7.93-1.29-3.43-14.58-.64-17.58a11,11,0,0,1,6-3.43s9.22-1.28,7.72-6.21,14.36-16.94,32.58-13.08S186.23,246.85,186.23,246.85Z"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 155.85px 257.573px 0px;"
                          id="elov2bf4bmbu" class="animable"></path><path
                          d="M172.3,254.35s-2.36,10.29-2.79,15-.43,5.57-4.93,3.86-5.79-7.08-5.79-7.08"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 165.545px 264.186px 0px;"
                          id="el72949zjg9ot" class="animable"></path><path
                          d="M152.36,264.86c-.85,0-6,1.28-6,1.28"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 149.36px 265.5px 0px;"
                          id="el5g6or2ndfg" class="animable"></path><path
                          d="M149.58,265.93s.85,7.93,6.64,9.65"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 152.9px 270.755px 0px;"
                          id="eljzbbplbpi6" class="animable"></path><path
                          d="M163.27,254.4c-.32,1.39-1.1,2.39-1.73,2.24s-.89-1.38-.57-2.77,1.09-2.38,1.73-2.24S163.59,253,163.27,254.4Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 162.121px 254.136px 0px;"
                          id="eldenne8srxv" class="animable"></path><path
                          d="M177.45,259.07c-.32,1.38-1.1,2.39-1.73,2.24s-.89-1.39-.57-2.77,1.09-2.39,1.73-2.24S177.77,257.68,177.45,259.07Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 176.301px 258.805px 0px;"
                          id="elqhd2qqqlqq" class="animable"></path><path
                          d="M158.79,247.92s2.79-4.29,7.51-.86"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 162.545px 246.825px 0px;"
                          id="elijn7hh78rx" class="animable"></path><path
                          d="M174.66,251.78s4.29-3.22,6.86,3"
                          style="fill: none; stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 178.09px 252.863px 0px;"
                          id="elw87pt8ktmd" class="animable"></path><path
                          d="M145.29,246.42a5.21,5.21,0,0,0-2.36,3.43c-.43,2.36.43,6.86-3.22,7.29s-7.71-3.22-9.21-3.86-3.43,2.79-6.22-6.43,2.36-24.65,7.93-26.8,12.86-1.71,12.86-1.71,4.93-5.79,21.87-5.79,29.58,8.15,26.58,10.29-4.71,2.36-4.71,2.36,9.43,7.29,9,15.86-7.93,9.86-14.15,7.29-11.57-12.43-11.57-12.43,3.64,10.29-.86,8.79-9.43-9.22-16.29-11.58-8.15-1.29-8.15-1.29,10.5,3.86,6.22,8.58S145.29,246.42,145.29,246.42Z"
                          style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 160.661px 234.863px 0px;"
                          id="elsbkho71xfj" class="animable"></path><path
                          d="M129.21,247.06s4.72-28.72,11.58-31.51,8.57-.86,8.57-.86-12,14.79-15.86,31.3Z"
                          style="fill: rgb(255, 255, 255); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 139.285px 230.55px 0px;"
                          id="elcz27fnjcgz4" class="animable"></path><path
                          d="M157.29,281.37a2.75,2.75,0,0,0-2,.87c-19-6-19.86-19-19.89-19.58a1.23,1.23,0,0,0-1.31-1.21,1.26,1.26,0,0,0-1.21,1.32c0,.64.89,15.32,21.69,21.9a2.78,2.78,0,1,0,2.72-3.3Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 146.48px 274.189px 0px;"
                          id="el5m86dias03c" class="animable"></path><ellipse
                          cx="131.68" cy="255" rx="9.11" ry="10.29"
                          style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 131.68px 255px 0px;"
                          id="eldy37v45kuyw" class="animable"></ellipse><path
                          d="M156.65,345.25,166.36,320a4.86,4.86,0,0,1,3.79-3.07l54.21-8.65a1.84,1.84,0,0,1,1.95,2.61L216,332.39Z"
                          style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 191.57px 326.754px 0px;"
                          id="ellt5tclml41k" class="animable"></path></g></g><g
                      id="freepik--gear-1--inject-29"
                      style="transform-origin: 159.07px 269.77px 0px;"
                      class="animable"><path
                        d="M248.75,281.25V262.83l-10.29-2.34a80,80,0,0,0-4.77-18.12l7.8-7.23-9.21-16-10.09,3.12A80.44,80.44,0,0,0,209,209l3.15-10.19-16-9.21L189,197.35A79,79,0,0,0,171,192.42l-2.36-10.37H150.17l-2.34,10.28a80,80,0,0,0-18.12,4.77l-7.23-7.8-16,9.21,3.12,10.09a80.83,80.83,0,0,0-13.29,13.18l-10.18-3.15-9.22,16,7.74,7.16a80,80,0,0,0-4.93,18.09L69.39,262.2v18.42L79.68,283a79,79,0,0,0,4.77,18.12l-7.81,7.23,9.21,16,10.09-3.12a81.23,81.23,0,0,0,13.18,13.29L106,344.63l16,9.21,7.17-7.74A79.3,79.3,0,0,0,147.18,351l2.36,10.37H168l2.34-10.29a79.49,79.49,0,0,0,18.12-4.76l7.23,7.8,16-9.21-3.12-10.09a80.44,80.44,0,0,0,13.29-13.18L232,324.82l9.21-16-7.74-7.17a78.79,78.79,0,0,0,4.93-18.08ZM226,271.72a66.91,66.91,0,1,1-66.9-66.9A66.91,66.91,0,0,1,226,271.72Z"
                        style="fill: rgb(38, 50, 56); stroke: rgb(38, 50, 56); stroke-miterlimit: 10; stroke-width: 1.05114px; transform-origin: 159.07px 271.71px 0px;"
                        id="elgnb1gn6yb57" class="animable"></path><path
                        d="M248.75,277.37V259l-10.29-2.34a80,80,0,0,0-4.77-18.12l7.8-7.23-9.21-16-10.09,3.12A80.44,80.44,0,0,0,209,205.13l3.15-10.19-16-9.21L189,193.47A79.52,79.52,0,0,0,171,188.54l-2.36-10.37H150.17l-2.34,10.29a79.49,79.49,0,0,0-18.12,4.76l-7.23-7.8-16,9.21,3.12,10.09A80.83,80.83,0,0,0,96.35,217.9l-10.18-3.15-9.22,16,7.74,7.16A80,80,0,0,0,79.76,256l-10.37,2.36v18.42l10.29,2.34a79,79,0,0,0,4.77,18.12l-7.81,7.23,9.21,16,10.09-3.12a81.23,81.23,0,0,0,13.18,13.29L106,340.75l16,9.21,7.17-7.74a79.3,79.3,0,0,0,18.08,4.93l2.36,10.37H168l2.34-10.29a79.49,79.49,0,0,0,18.12-4.76l7.23,7.8,16-9.21L208.49,331a80.44,80.44,0,0,0,13.29-13.18L232,320.94l9.21-16-7.74-7.16a79,79,0,0,0,4.93-18.09ZM226,267.84a66.91,66.91,0,1,1-66.9-66.9A66.91,66.91,0,0,1,226,267.84Z"
                        style="fill: rgb(146, 227, 169); stroke: rgb(38, 50, 56); stroke-linecap: round; stroke-linejoin: round; transform-origin: 159.07px 267.845px 0px;"
                        id="el6z4iikpgnnr" class="animable"></path></g><defs>
                      <filter id="active" height="200%"> <femorphology
                          in="SourceAlpha" result="DILATED" operator="dilate"
                          radius="2"></femorphology> <feflood
                          flood-color="#32DFEC" flood-opacity="1"
                          result="PINK"></feflood> <fecomposite in="PINK"
                          in2="DILATED" operator="in"
                          result="OUTLINE"></fecomposite> <femerge> <femergenode
                            in="OUTLINE"></femergenode> <femergenode
                            in="SourceGraphic"></femergenode> </femerge>
                      </filter> <filter id="hover" height="200%"> <femorphology
                          in="SourceAlpha" result="DILATED" operator="dilate"
                          radius="2"></femorphology> <feflood
                          flood-color="#ff0000" flood-opacity="0.5"
                          result="PINK"></feflood> <fecomposite in="PINK"
                          in2="DILATED" operator="in"
                          result="OUTLINE"></fecomposite> <femerge> <femergenode
                            in="OUTLINE"></femergenode> <femergenode
                            in="SourceGraphic"></femergenode> </femerge>
                        <fecolormatrix type="matrix"
                          values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 "></fecolormatrix>
                      </filter></defs><defs><clippath
                        id="freepik--clip-path--inject-29"><circle cx="320.89"
                          cy="333.53" r="73.75"
                          style="fill:none"></circle></clippath><clippath
                        id="freepik--clip-path-2--inject-29"><path
                          d="M315.56,353.41a83.67,83.67,0,0,1-5.66,14.71c-4.07,8.37-5.65,14.93.46,15.38s14.93-9.05,17-14.25,6.79-26,6.79-26Z"
                          style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></path></clippath><clippath
                        id="freepik--clip-path-3--inject-29"><path
                          d="M300.4,310.19s-2.72,20.36-3.17,31.68,5.66,17.65,10.64,17.42,25.79-12.44,26-13.12,3.39-2.49,3.39-2.49.91,2.94,4.3.45,5.43-12.22,4.53-14.93-1.81-2.27-2.72-1.81-4.52,2.94-8.6,2.48-11.76-5-12.67-13.12-.22-10.86-.22-10.86S311.71,316.07,300.4,310.19Z"
                          style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></path></clippath><clippath
                        id="freepik--clip-path-4--inject-29"><circle cx="297.29"
                          cy="161.68" r="73.75"
                          transform="translate(-27.25 257.57) rotate(-45)"
                          style="fill:none"></circle></clippath><clippath
                        id="freepik--clip-path-5--inject-29"><path
                          d="M285.43,185.42a171.13,171.13,0,0,1,5.65,19.17c2.22,9.89,6.46,16.14,13.52,8.68s8.88-22.4,8.88-27-.4-13.53-.4-13.53-9.69,14.94-14.94,16.35S285.43,185.42,285.43,185.42Z"
                          style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></path></clippath><clippath
                        id="freepik--clip-path-6--inject-29"><path
                          d="M268.68,145.06a193.57,193.57,0,0,0,7.47,27.85c5,14.12,11.7,19.37,18.56,21.59s17.16-11.71,19.78-20.58,2.42-10.5,2.42-10.5,7.27-1.81,9.28-8.88-3-11.5-7.06-9.89-4.84,6.87-4.84,6.87-6.86-3.64-9.49-8.28-2.22-8.07-2.22-8.07-6.66-5.45-19.17-3.23A17.89,17.89,0,0,0,268.68,145.06Z"
                          style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></path></clippath><clippath
                        id="freepik--clip-path-7--inject-29"><path
                          d="M315.7,182.39s-6.46,3.23-5.85,5.65a3,3,0,0,0,4.24,2c1.41-.61,5.24-2,5.24-2l2.63,5.25s-4.44-2.83-6.66-2a15.34,15.34,0,0,0-4.24,2.62,2.48,2.48,0,0,0-3.43,1,10.63,10.63,0,0,0-1.62,4,5.86,5.86,0,0,0-2.22,4.44c0,2.82,0,5,1.82,6.66s3,1.61,3,1.61l1.61,1s-4,8.88-1.61,13.52,3.63,4.24,3.63,4.24l4.84,8.88L330,236.07l-6.66-14.93s11.1-22.81,9.89-26.44S327,186.43,324,183.4A6.36,6.36,0,0,0,315.7,182.39Z"
                          style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></path></clippath><clippath
                        id="freepik--clip-path-8--inject-29"><circle cx="159.07"
                          cy="267.84" r="73.75"
                          style="fill:none"></circle></clippath><clippath
                        id="freepik--clip-path-9--inject-29"><path
                          d="M136.28,257.57s-3.21,10.72-5.78,16.51a73.86,73.86,0,0,0-3.43,8.78,33.45,33.45,0,0,0,3.21,9.44c2.79,5.79,5.15,9.64,5.36,9s-1.28-4.93,4.93-12.65,9.22-11.14,9.22-11.14Z"
                          style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></path></clippath><clippath
                        id="freepik--clip-path-10--inject-29"><path
                          d="M186.23,246.85s-6,22.29-13.93,34.3-14.36,13.29-19.94,10.93-11.79-15-13.72-19.93-3-7.72-3-7.72-3.64,6.22-7.93-1.29-3.43-14.58-.64-17.58a11,11,0,0,1,6-3.43s9.22-1.28,7.72-6.21,14.36-16.94,32.58-13.08S186.23,246.85,186.23,246.85Z"
                          style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></path></clippath></defs></svg>
                  <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Duis aute irure dolor</h4>
                    <p class="text-muted mb-4"><i class="far fa-clock"
                        aria-hidden="true"></i> 2016</p>
                    <p class="mb-0">Sed ut perspiciatis unde omnis iste natus
                      error sit voluptatem accusantium
                      doloremque laudantium, totam rem aperiam, eaque ipsa quae
                      ab illo inventore veritatis et quasi
                      architecto beatae vitae dicta sunt explicabo. Nemo enim
                      ipsam voluptatem quia voluptas sit
                      aspernatur aut odit aut fugit, sed quia consequuntur magni
                      dolores eos qui ratione voluptatem
                      sequi nesciunt.</p>
                  </div>
                </div>
              </div>
              <div class="timeline-2 left-2">
                <div class="card">
                  <img src="../images/Internship.gif" class="card-img-top"
                    alt="Responsive image">
                  <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Sed ut nihil unde omnis</h4>
                    <p class="text-muted mb-4"><i class="far fa-clock"
                        aria-hidden="true"></i> 2015</p>
                    <p class="mb-0">Neque porro quisquam est, qui dolorem ipsum
                      quia dolor sit amet, consectetur,
                      adipisci velit, sed quia non numquam eius modi tempora
                      incidunt ut labore et dolore magnam
                      aliquam quaerat voluptatem. Ut enim ad minima veniam, quis
                      nostrum exercitationem ullam corporis
                      nulla pariatur?</p>
                  </div>
                </div>
              </div>
              <div class="timeline-2 right-2">
                <div class="card">
                  <svg class="animated" id="freepik_stories-interview"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500"
                    version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    xmlns:svgjs="http://svgjs.com/svgjs"><style>svg#freepik_stories-interview:not(.animated) .animable {opacity: 0;}svg#freepik_stories-interview.animated #freepik--Floor--inject-3 {animation: 1.5s Infinite  linear heartbeat;animation-delay: 0s;}svg#freepik_stories-interview.animated #freepik--speech-bubbles--inject-3 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) fadeIn;animation-delay: 0s;}            @keyframes heartbeat {                0% {                    transform: scale(1);                }                10% {                    transform: scale(1.1);                }                30% {                    transform: scale(1);                }                40% {                    transform: scale(1);                }                50% {                    transform: scale(1.1);                }                60% {                    transform: scale(1);                }                100% {                    transform: scale(1);                }            }                    @keyframes fadeIn {                0% {                    opacity: 0;                }                100% {                    opacity: 1;                }            }        </style><g
                      id="freepik--Floor--inject-3"
                      style="transform-origin: 248.63px 349.09px 0px;"
                      class="animable animator-active"><ellipse
                        id="freepik--floor--inject-3" cx="248.63" cy="349.09"
                        rx="227.34" ry="136.12"
                        style="fill: rgb(245, 245, 245); transform-origin: 248.63px 349.09px 0px;"
                        class="animable"></ellipse></g><g
                      id="freepik--Shadows--inject-3"
                      style="transform-origin: 244.19px 362.24px 0px;"
                      class="animable"><ellipse id="freepik--Shadow--inject-3"
                        cx="385.6" cy="314.11" rx="69" ry="39.84"
                        style="fill: rgb(224, 224, 224); transform-origin: 385.6px 314.11px 0px;"
                        class="animable"></ellipse><ellipse
                        id="freepik--shadow--inject-3" cx="364.99" cy="438.04"
                        rx="21.08" ry="12.17"
                        style="fill: rgb(224, 224, 224); transform-origin: 364.99px 438.04px 0px;"
                        class="animable"></ellipse><ellipse
                        id="freepik--shadow--inject-3" cx="102.78" cy="331.87"
                        rx="69" ry="39.84"
                        style="fill: rgb(224, 224, 224); transform-origin: 102.78px 331.87px 0px;"
                        class="animable"></ellipse><ellipse
                        id="freepik--shadow--inject-3" cx="158.51" cy="361.11"
                        rx="47.19" ry="27.25"
                        style="fill: rgb(224, 224, 224); transform-origin: 158.51px 361.11px 0px;"
                        class="animable"></ellipse><path
                        id="freepik--shadow--inject-3"
                        d="M124,418.7l-12.56,7a7.65,7.65,0,0,1-6.94,0L49.61,394c-1.91-1.11-1.91-2.9,0-4l12.56-7a7.65,7.65,0,0,1,6.94,0L124,414.69C125.92,415.8,125.92,417.59,124,418.7Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 86.8088px 404.35px 0px;"
                        class="animable"></path><path
                        id="freepik--shadow--inject-3"
                        d="M340,432.66l85.3-49.17a1.24,1.24,0,0,0,0-2.34L255.43,282.61a4.48,4.48,0,0,0-4.05,0l-85.3,49.18a1.23,1.23,0,0,0,0,2.33L336,432.66A4.45,4.45,0,0,0,340,432.66Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 295.687px 357.631px 0px;"
                        class="animable"></path></g><g
                      id="freepik--character-2--inject-3"
                      style="transform-origin: 399.356px 214.222px 0px;"
                      class="animable"><g id="freepik--Character--inject-3"
                        style="transform-origin: 399.356px 214.222px 0px;"
                        class="animable"><path
                          d="M433.81,325a5.32,5.32,0,0,1-.12,1.11,2.56,2.56,0,0,1-1,1.56l0,0a2.91,2.91,0,0,1-3.09-.24A9.37,9.37,0,0,1,425.3,320a3,3,0,0,1,1.2-2.69h0l.2-.12h0a2.64,2.64,0,0,1,1.81-.08,5.25,5.25,0,0,1,1.05.46A9.4,9.4,0,0,1,433.81,325Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 429.548px 322.496px 0px;"
                          id="elkn2ec5yn3p7" class="animable"></path><path
                          d="M432.65,315.81a3.92,3.92,0,0,0-1.9-.57,2.26,2.26,0,0,0-1.19.33l-.11.06-2.75,1.59a2.64,2.64,0,0,1,1.81-.08,5.25,5.25,0,0,1,1.05.46,9.4,9.4,0,0,1,4.25,7.36,5.32,5.32,0,0,1-.12,1.11,2.56,2.56,0,0,1-1,1.56L435.5,326l.05,0,.24-.15a.15.15,0,0,0,.07-.05,3.1,3.1,0,0,0,1-2.61A9.39,9.39,0,0,0,432.65,315.81Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 431.788px 321.435px 0px;"
                          id="el98suyjoly04" class="animable"></path><path
                          d="M387.79,300.21a5.32,5.32,0,0,1-.12,1.11,2.56,2.56,0,0,1-1,1.56l0,0a3,3,0,0,1-3.09-.24,9.39,9.39,0,0,1-4.25-7.37,3,3,0,0,1,1.2-2.7h0l.21-.12h0a2.58,2.58,0,0,1,1.81-.07,4.61,4.61,0,0,1,1,.45A9.4,9.4,0,0,1,387.79,300.21Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 383.553px 297.724px 0px;"
                          id="elaphbh7qr1la" class="animable"></path><path
                          d="M386.62,291.07a3.8,3.8,0,0,0-1.89-.58,2.24,2.24,0,0,0-1.2.34l-.11.06-2.74,1.58a2.58,2.58,0,0,1,1.81-.07,4.61,4.61,0,0,1,1,.45,9.4,9.4,0,0,1,4.26,7.36,5.32,5.32,0,0,1-.12,1.11,2.56,2.56,0,0,1-1,1.56l2.82-1.63,0,0,.24-.14.08,0a3.16,3.16,0,0,0,1-2.62A9.38,9.38,0,0,0,386.62,291.07Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 385.732px 296.685px 0px;"
                          id="elg843fpq53ml" class="animable"></path><path
                          d="M396,334.62a4.87,4.87,0,0,0,.12,1.12,2.55,2.55,0,0,0,1,1.55l0,0a3,3,0,0,0,3.09-.24,9.41,9.41,0,0,0,4.26-7.37,3,3,0,0,0-1.2-2.7h0l-.21-.12h0a2.63,2.63,0,0,0-1.81-.07,4.81,4.81,0,0,0-1,.45A9.39,9.39,0,0,0,396,334.62Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 400.242px 332.136px 0px;"
                          id="el2p0rqvz1cxq" class="animable"></path><path
                          d="M397.16,325.48a3.83,3.83,0,0,1,1.89-.58,2.21,2.21,0,0,1,1.2.34l.11.06,2.74,1.58a2.63,2.63,0,0,0-1.81-.07,4.81,4.81,0,0,0-1,.45,9.39,9.39,0,0,0-4.25,7.36,4.87,4.87,0,0,0,.12,1.12,2.55,2.55,0,0,0,1,1.55l-2.81-1.63-.05,0-.24-.14-.07-.05a3.13,3.13,0,0,1-1.05-2.61A9.39,9.39,0,0,1,397.16,325.48Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 398.015px 331.095px 0px;"
                          id="el7pt4xae2kg" class="animable"></path><path
                          d="M366.12,320a5.32,5.32,0,0,0,.12,1.11,2.56,2.56,0,0,0,1,1.56l0,0a2.93,2.93,0,0,0,3.1-.24,9.41,9.41,0,0,0,4.25-7.37,3,3,0,0,0-1.2-2.69h0l-.2-.12h0a2.64,2.64,0,0,0-1.81-.08,4.94,4.94,0,0,0-1,.46A9.39,9.39,0,0,0,366.12,320Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 370.362px 317.526px 0px;"
                          id="el01p2po7ylm33" class="animable"></path><path
                          d="M367.28,310.84a3.92,3.92,0,0,1,1.9-.57,2.32,2.32,0,0,1,1.2.33l.1.06,2.75,1.59a2.64,2.64,0,0,0-1.81-.08,4.94,4.94,0,0,0-1,.46,9.39,9.39,0,0,0-4.26,7.36,5.32,5.32,0,0,0,.12,1.11,2.56,2.56,0,0,0,1,1.56L364.43,321l-.05,0-.24-.15-.07-.05a3.12,3.12,0,0,1-1-2.61A9.39,9.39,0,0,1,367.28,310.84Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 368.142px 316.465px 0px;"
                          id="elkb16kdi9dlo" class="animable"></path><path
                          d="M423.87,302a5.32,5.32,0,0,0,.12,1.11,2.56,2.56,0,0,0,1,1.56l0,0a3,3,0,0,0,3.09-.24,9.41,9.41,0,0,0,4.26-7.37,3,3,0,0,0-1.2-2.7h0l-.2-.12h0a2.58,2.58,0,0,0-1.81-.07,4.68,4.68,0,0,0-1.05.45A9.42,9.42,0,0,0,423.87,302Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 428.112px 299.514px 0px;"
                          id="el9rfoiqzik0n" class="animable"></path><path
                          d="M425,292.9a3.84,3.84,0,0,1,1.9-.58,2.18,2.18,0,0,1,1.19.34l.11.06L431,294.3a2.58,2.58,0,0,0-1.81-.07,4.68,4.68,0,0,0-1.05.45,9.42,9.42,0,0,0-4.25,7.36,5.32,5.32,0,0,0,.12,1.11,2.56,2.56,0,0,0,1,1.56l-2.82-1.63-.05,0-.24-.15-.07,0a3.13,3.13,0,0,1-1-2.62A9.37,9.37,0,0,1,425,292.9Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 425.907px 298.515px 0px;"
                          id="elp1evx0yvr59" class="animable"></path><polygon
                          points="398.47 293.05 383.28 288.69 383.28 291.94 398.47 300.7 398.47 293.05"
                          style="fill: rgb(240, 240, 240); transform-origin: 390.875px 294.695px 0px;"
                          id="elg92hndj4ka" class="animable"></polygon><polygon
                          points="398.47 293.05 399.97 292.13 384.74 287.97 383.28 288.69 398.47 293.05"
                          style="fill: rgb(250, 250, 250); transform-origin: 391.625px 290.51px 0px;"
                          id="eldjqq6jox5z" class="animable"></polygon><polygon
                          points="405.04 302.73 426.58 294.66 426.58 291.38 405.04 293.3 405.04 302.73"
                          style="fill: rgb(240, 240, 240); transform-origin: 415.81px 297.055px 0px;"
                          id="elzyuvhxlfaas" class="animable"></polygon><polygon
                          points="426.58 291.38 425 290.96 403.76 292.33 405.04 293.3 426.58 291.38"
                          style="fill: rgb(250, 250, 250); transform-origin: 415.17px 292.13px 0px;"
                          id="eljal85lwv5vm" class="animable"></polygon><path
                          d="M405.62,301.69c0,2.44-7.49,2.44-7.49,0V280.4h7.49Z"
                          style="fill: rgb(250, 250, 250); transform-origin: 401.875px 291.96px 0px;"
                          id="elrpn1e71i4x9" class="animable"></path><path
                          d="M400,296.15l-4.12,26.74h2.81l3.86-26.74A4.68,4.68,0,0,1,400,296.15Z"
                          style="fill: rgb(250, 250, 250); transform-origin: 399.215px 309.52px 0px;"
                          id="elijym53mnr4a" class="animable"></path><polygon
                          points="402.56 296.15 402.56 303.49 398.7 327.42 398.7 322.89 402.56 296.15"
                          style="fill: rgb(240, 240, 240); transform-origin: 400.63px 311.785px 0px;"
                          id="el6wek9lpb4fc" class="animable"></polygon><rect
                          x="395.89" y="322.89" width="2.82" height="4.53"
                          style="fill: rgb(224, 224, 224); transform-origin: 397.3px 325.155px 0px;"
                          id="elhlnfenzljpl" class="animable"></rect><polygon
                          points="403.84 303.27 431.61 317.83 431.61 313.35 403.84 296.17 403.84 303.27"
                          style="fill: rgb(240, 240, 240); transform-origin: 417.725px 307px 0px;"
                          id="elgk6dvrmzwia" class="animable"></polygon><path
                          d="M403.84,296.17a3.07,3.07,0,0,0,1.78-.81l27.72,16.82-1.73,1.17Z"
                          style="fill: rgb(250, 250, 250); transform-origin: 418.59px 304.355px 0px;"
                          id="el4fqi2ojr9wl" class="animable"></path><polygon
                          points="431.61 317.83 431.61 313.35 433.34 312.18 433.34 316.52 431.61 317.83"
                          style="fill: rgb(224, 224, 224); transform-origin: 432.475px 315.005px 0px;"
                          id="el8ng1q0isyqs" class="animable"></polygon><polygon
                          points="368.83 312.69 398.5 302.53 398.5 295.87 368.83 308.21 368.83 312.69"
                          style="fill: rgb(240, 240, 240); transform-origin: 383.665px 304.28px 0px;"
                          id="eladu81oiwbhh" class="animable"></polygon><path
                          d="M398.5,295.87c-.25-.07-.35-.5-.37-1.15L368,307.85l.88.36Z"
                          style="fill: rgb(250, 250, 250); transform-origin: 383.25px 301.465px 0px;"
                          id="elor52tr8yr9i" class="animable"></path><polygon
                          points="367.95 307.85 367.95 312.18 368.83 312.69 368.83 308.21 367.95 307.85"
                          style="fill: rgb(224, 224, 224); transform-origin: 368.39px 310.27px 0px;"
                          id="elfnhqjm1dls7" class="animable"></polygon><g
                          id="elvxwcsfqsxvg"><rect x="395.89" y="322.89"
                            width="2.82" height="4.53"
                            style="fill: rgb(240, 240, 240); opacity: 0.1; transform-origin: 397.3px 325.155px 0px;"
                            class="animable"></rect></g><g
                          id="eltfiayi013nd"><polygon
                            points="431.61 317.83 431.61 313.35 433.34 312.18 433.34 316.52 431.61 317.83"
                            style="fill: rgb(240, 240, 240); opacity: 0.1; transform-origin: 432.475px 315.005px 0px;"
                            class="animable"></polygon></g><g
                          id="elomlhrdbisxn"><polygon
                            points="367.95 307.85 367.95 312.18 368.83 312.69 368.83 308.21 367.95 307.85"
                            style="opacity: 0.1; transform-origin: 368.39px 310.27px 0px;"
                            class="animable"></polygon></g><path
                          d="M395.53,243.3h12.69v43.92c0,3.64-12.69,3.64-12.69,0Z"
                          style="fill: rgb(240, 240, 240); transform-origin: 401.875px 266.625px 0px;"
                          id="el38gf7tscdmo" class="animable"></path><g
                          id="freepik--Chair--inject-3"
                          style="transform-origin: 407.915px 198.444px 0px;"
                          class="animable"><path
                            d="M446.86,237.21l-48.61-25.38s-3.41-16.63,8.1-34.75c0,0-3.42-32.29,2.33-43,4.2-8.2,9.25-7.08,9.25-7.08l55.19,24.93Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 435.449px 182.079px 0px;"
                            id="elbgz554vomy" class="animable"></path><g
                            id="el5oewbggtua9"><path
                              d="M446.86,237.21l-48.61-25.38s-3.41-16.63,8.1-34.75c0,0-3.42-32.29,2.33-43,4.2-8.2,9.25-7.08,9.25-7.08l55.19,24.93Z"
                              style="opacity: 0.1; transform-origin: 435.449px 182.079px 0px;"
                              class="animable"></path></g><path
                            d="M417.93,127l55.19,24.93-1.81,5.89-60.37-27.26C414.5,126.22,417.93,127,417.93,127Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 442.03px 142.383px 0px;"
                            id="elais3sq7wk8g" class="animable"></path><path
                            d="M342.71,232.53v2.68a9.69,9.69,0,0,0,4.73,7.83l54.18,28.44a10.82,10.82,0,0,0,9.36-.19l31.25-18a10.26,10.26,0,0,0,4.63-8v-2.67a9.68,9.68,0,0,0-4.74-7.82L390.84,208a11.78,11.78,0,0,0-9.52-.08L347.48,224.8A9.45,9.45,0,0,0,342.71,232.53Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 394.785px 239.703px 0px;"
                            id="elqbjm5hyvmka" class="animable"></path><g
                            id="elam4zwfl87t8"><path
                              d="M342.71,232.53v2.68a9.69,9.69,0,0,0,4.73,7.83l54.18,28.44a10.82,10.82,0,0,0,9.36-.19l31.25-18a10.26,10.26,0,0,0,4.63-8v-2.67a9.68,9.68,0,0,0-4.74-7.82L390.84,208a11.78,11.78,0,0,0-9.52-.08L347.48,224.8A9.45,9.45,0,0,0,342.71,232.53Z"
                              style="opacity: 0.1; transform-origin: 394.785px 239.703px 0px;"
                              class="animable"></path></g><path
                            d="M401.62,258.12l-54.18-28.45c-2.62-1.37-2.6-3.55,0-4.87l33.84-16.93a11.78,11.78,0,0,1,9.52.08l51.28,26.79c2.62,1.37,2.66,3.67.11,5.14L411,257.93A10.82,10.82,0,0,1,401.62,258.12Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 394.778px 233.001px 0px;"
                            id="el1ulfnjdvxdk" class="animable"></path><g
                            id="elahn21rx06mr"><path
                              d="M405.1,272.41a10.57,10.57,0,0,0,5.88-1.12l31.25-18a10.24,10.24,0,0,0,4.62-8v-2.69a9.77,9.77,0,0,0-4.06-7.4c1.93,1.39,1.75,3.4-.56,4.73L411,257.93a10,10,0,0,1-4.78,1.15Z"
                              style="opacity: 0.2; transform-origin: 425.975px 253.831px 0px;"
                              class="animable"></path></g><path
                            d="M417.93,127s-8-5.41-16.42-.54-5.64,21.22-4.74,31.76,1.2,28.91-6.18,35.6-31.55-2.2-42.1-2.2l9.3,34.29c10.26-5.59,26.66-11.32,40.46-14,0,0-.45-21.38,9.35-33.6,0,0-3.61-8.55-1.25-25.68C408.54,136.69,411.5,130.68,417.93,127Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 383.21px 175.169px 0px;"
                            id="elpnuvyea86am" class="animable"></path><g
                            id="elpn4k1s0afke"><path
                              d="M417.93,127s-8-5.41-16.42-.54-5.64,21.22-4.74,31.76,1.2,28.91-6.18,35.6-31.55-2.2-42.1-2.2l9.3,34.29c10.26-5.59,26.66-11.32,40.46-14,0,0-.45-21.38,9.35-33.6,0,0-3.61-8.55-1.25-25.68C408.54,136.69,411.5,130.68,417.93,127Z"
                              style="opacity: 0.2; transform-origin: 383.21px 175.169px 0px;"
                              class="animable"></path></g><path
                            d="M357.79,225.88c.48-3.07,2.42-20.71-.87-28.4-2.86-6.68-10.37-7.07-12.74-4.21s-.25,6.34,3.51,11.24c3.17,4.14,4.32,8,4.32,18Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 350.988px 208.732px 0px;"
                            id="elvfvypf5fevc" class="animable"></path><g
                            id="elgzzpqu38zmr"><path
                              d="M357.79,225.88c.48-3.07,2.42-20.71-.87-28.4-2.86-6.68-10.37-7.07-12.74-4.21s-.25,6.34,3.51,11.24c3.17,4.14,4.32,8,4.32,18Z"
                              style="opacity: 0.1; transform-origin: 350.988px 208.732px 0px;"
                              class="animable"></path></g></g><g
                          id="freepik--character--inject-3"
                          style="transform-origin: 376.846px 214.222px 0px;"
                          class="animable"><path
                            d="M387.74,145.46c-4,4-24.64,25.89-24.64,25.89l-14.6-14.64c-3.46-3.47-4-7.5-6.08-10.49s-4.55-4-6.92-6.57-3.19-4.43-4.35-2.63,1.36,5.54,1.77,6.42,3.19,3.19-.82,2.51-11.13-6.31-12.9-7.4-2.1,1.22-1.42,2.85-.28,5.81.4,8.66,2.3,4.74,5.77,7.06c3.22,2.15,11.49,4.3,14,6.38h0c5.2,6.9,15,19.81,17.62,22.3,3.57,3.42,6.52,5.64,13.27.63s27.61-24.55,27.61-24.55l6.37-21.14C396.91,139.71,392.55,140.59,387.74,145.46Z"
                            style="fill: rgb(255, 168, 167); transform-origin: 360.136px 162.834px 0px;"
                            id="elkcg6mzx74wl" class="animable"></path><path
                            d="M402.5,140.69c-6.46-1.94-9.08-1.46-12,.5s-4.34,5.59-14.33,15.83c-7.62,7.81-13,13.35-13,13.35l-9.94-8.88a22.16,22.16,0,0,1-10.06,8.95s5.36,7.77,9.61,13,7.32,7.05,8.56,7.25,4.12-.91,12.87-8,30.48-27.16,30.48-27.16Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 373.93px 165.083px 0px;"
                            id="el1zbqyf5npxn" class="animable"></path><g
                            id="eli5zf2ahpiml"><path
                              d="M402.5,140.69c-6.46-1.94-9.08-1.46-12,.5s-4.34,5.59-14.33,15.83c-7.62,7.81-13,13.35-13,13.35l-9.94-8.88a22.16,22.16,0,0,1-10.06,8.95s5.36,7.77,9.61,13,7.32,7.05,8.56,7.25,4.12-.91,12.87-8,30.48-27.16,30.48-27.16Z"
                              style="fill: rgb(255, 255, 255); opacity: 0.85; transform-origin: 373.93px 165.083px 0px;"
                              class="animable"></path></g><path
                            d="M404.89,89.39l.12.08c5.57,3.59,11.92,4.7,16.91,9.38s7.37,10.53,6.61,16.54c-1.35,10.65-7,15-10.48,20.11-.14.2-5.71,3.66-5.94,3.67l-3.63.16c-.88,0-2,.51-2.83.24-1.11-.35-1.93-1.82-2.59-2.69a35,35,0,0,0-8.83-8c-1.45-1-2.46-3-3.14-4.61a17,17,0,0,1-1.35-5.47,2.2,2.2,0,0,0-2.47-2.7,11.37,11.37,0,0,1-5.42-1.88,7.69,7.69,0,0,1-3.2-4.68,6,6,0,0,1,2.31-6,6.58,6.58,0,0,1,6.82-10.3c-1.08-2.42.24-5.46,2.5-6.86a9.47,9.47,0,0,1,7.7-.61A28.5,28.5,0,0,1,404.89,89.39Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 403.601px 112.437px 0px;"
                            id="elxawlym51h5" class="animable"></path><path
                            d="M380.28,269.78c4.24-.72,8,2.56,8.4,3.64.52,1.46.47,4.45-1.14,8.2a25.51,25.51,0,0,0-1.48,11.66c.43,3.36,2.33,11.72-.92,16.06s-10.68,8.3-13.57,2.6c-.94-1.86.6-8.48,1.22-13.3,1.23-9.59,2.11-19.11,2.11-19.11Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 380.124px 292.226px 0px;"
                            id="el2c446m8yxf9" class="animable"></path><path
                            d="M381.88,277.35a92.78,92.78,0,0,0-.59,14c.26,5.12-.7,8.52-2.39,10.86-1.86,2.59-6.69,4.17-6.29-1.12.27-3.68,2.29-21.59,2.29-21.59Z"
                            style="fill: rgb(255, 168, 167); transform-origin: 377.233px 290.979px 0px;"
                            id="eltboms0df16" class="animable"></path><g
                            id="el3bv4jps7i5u"><path
                              d="M387.2,271.79c.31,3.14-1.09,11.57-5.11,18.73s-9.79,15.32-10.78,20.26c-.19-2.25.61-6.41,1.18-10.1,0-.08,0-.16,0-.25s.06-.42.1-.63,0-.2,0-.3c0-.27.07-.54.11-.81v-.05c.38-3,.73-6,1-8.68.25-2.16.45-4.13.62-5.76.08-.81.16-1.54.22-2.17,0-.32.06-.6.09-.86.1-1.05.15-1.64.15-1.64l5.38-9.75a7.9,7.9,0,0,1,.82-.09A9.42,9.42,0,0,1,387.2,271.79Z"
                              style="opacity: 0.15; transform-origin: 379.262px 290.233px 0px;"
                              class="animable"></path></g><path
                            d="M360.79,218.55C374.27,210,391,205,391,205l14.65,10.72-14.08,13.43-18.07,13.1s-3.54-.17-1.2,5.27c.74,1.73,1.89,5.2,3.11,9.12l-7.82,23.9s-4.88-8.07-12.07-22.79c-6.68-13.68-8.47-22.82-7.94-25.91C348.21,227.81,349.88,225.48,360.79,218.55Z"
                            style="fill: rgb(55, 71, 79); transform-origin: 376.571px 242.77px 0px;"
                            id="el1zs1fh7e2mb" class="animable"></path><path
                            d="M393.38,222.46l1.74-1.31c-4.92-2.35-6.6-8.11-6.6-8.11a14.68,14.68,0,0,0,3.67,8.76c-1.24.78-19.14,12.06-22.42,16s-5.5,5.37-5.62,14.58c-.1,7.78-.74,21.39-.74,21.39l23.71-31.4,10.07-17.53Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 380.3px 243.405px 0px;"
                            id="elnodq5h1fpw" class="animable"></path><path
                            d="M372.39,310.69c1-.1,1.16,1.67,1.87,3.9a11.54,11.54,0,0,1,.55,6.74c-.76,2.87-5.24,3.6-7.32,7.45s-5,10.74-12.92,13.27-14.29.49-16-1.75-.64-4.66,4.22-8.12c5.15-3.68,6.6-4.76,6.6-4.76Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 356.443px 326.952px 0px;"
                            id="el04l67nbaocg5" class="animable"></path><path
                            d="M361.18,297.64a122.77,122.77,0,0,1-3.58,14.18c-1.86,5.18-5.12,10.24-8.82,15-.81,1-2.67,3-3.33,3.84a1.56,1.56,0,0,0,.3,2.39c1.85,1.58,9.32,1.57,13.33-1.79s7.44-10.24,9.8-12.89c.88-1,1.71-2,2.49-3.09a5.22,5.22,0,0,0,1.09-3.4,15.25,15.25,0,0,1,.05-4.83,55.5,55.5,0,0,1,1.63-6.3Z"
                            style="fill: rgb(255, 168, 167); transform-origin: 359.582px 315.855px 0px;"
                            id="elc4283no9zf" class="animable"></path><path
                            d="M429.52,196.52c6,9.39,7,21.31,4.92,27.35-2.77,8.24-6,12-17,19.24-9.08,6-21.84,9.85-24.57,11.25s-3.56,4.52-4.68,10.07c-1.06,5.27-2.33,13.78-7.67,25.07-5.64,11.93-7.16,15.45-7.16,15.45s-7.46,3.24-13.51-2.06c0,0,6.34-49.63,8.34-56.75s30.5-27.61,30.5-27.61-4.25-11.38-6.78-19.33Z"
                            style="fill: rgb(55, 71, 79); transform-origin: 397.64px 251.225px 0px;"
                            id="eluzl2o4lo59q" class="animable"></path><path
                            d="M432.65,198.69a26.93,26.93,0,0,1-2-5.32c-1.67-7,1.26-14.15,2.68-21.21a51,51,0,0,0,.92-13c-.19-3.34,0-9-3.15-10.9a20.08,20.08,0,0,0-3.55-1.52l-9.61-3.58s-9.57-1.67-14.66-2.34c-2.8-.38-4.51.54-7.76,3.78s-9.48,10.68-11.77,16.88a13.76,13.76,0,0,0,6.07,16.27c.65,4.27,1.12,12.36,1.35,15.79s-2.13,9.24-2.86,11.83c2.4,6,9.68,11.77,23.63,13a55.65,55.65,0,0,0,10.95-.1c4.18-.48,12.57-3.76,13.35-5.74a24.26,24.26,0,0,0-.78-5.56A38.63,38.63,0,0,0,432.65,198.69Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 409.632px 179.666px 0px;"
                            id="el07t28dl2vdrb" class="animable"></path><g
                            id="el7dtndcvre5n"><path
                              d="M432.65,198.69a26.93,26.93,0,0,1-2-5.32c-1.67-7,1.26-14.15,2.68-21.21a51,51,0,0,0,.92-13c-.19-3.34,0-9-3.15-10.9a20.08,20.08,0,0,0-3.55-1.52l-9.61-3.58s-9.57-1.67-14.66-2.34c-2.8-.38-4.51.54-7.76,3.78s-9.48,10.68-11.77,16.88a13.76,13.76,0,0,0,6.07,16.27c.65,4.27,1.12,12.36,1.35,15.79s-2.13,9.24-2.86,11.83c2.4,6,9.68,11.77,23.63,13a55.65,55.65,0,0,0,10.95-.1c4.18-.48,12.57-3.76,13.35-5.74a24.26,24.26,0,0,0-.78-5.56A38.63,38.63,0,0,0,432.65,198.69Z"
                              style="fill: rgb(255, 255, 255); opacity: 0.75; transform-origin: 409.632px 179.666px 0px;"
                              class="animable"></path></g><path
                            d="M400,179.43s3.75,4.84,11.42,4.15c7.92-.71,9.6-7.23,9.6-7.23s.15,8.59-9.31,9.44A11.38,11.38,0,0,1,400,179.43Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 410.51px 181.117px 0px;"
                            id="elrvesn4gosvo" class="animable"></path><g
                            id="elkzipqh17i8q"><path
                              d="M400,179.43s3.75,4.84,11.42,4.15c7.92-.71,9.6-7.23,9.6-7.23s.15,8.59-9.31,9.44A11.38,11.38,0,0,1,400,179.43Z"
                              style="opacity: 0.05; transform-origin: 410.51px 181.117px 0px;"
                              class="animable"></path></g><path
                            d="M391.67,100.58c-2.56,1.51-5.74,7.94-5.45,21.44.24,11.44,3.95,14.27,5.81,15.09s6.71.11,10.21-.47l.57,8.14c-3.8,9.86-3.22,14.88-4,21.45,0,0,5.32-9,10.81-14.06a102.22,102.22,0,0,1,9-7.59l-1.1-17.19s1.77,1.08,4.17-.77c3.24-2.48,3.74-7,1.15-9.32-1.67-1.53-6.2-2-7.59,2,0,0-4.69-.42-12.09-4.51A23.93,23.93,0,0,1,391.67,100.58Z"
                            style="fill: rgb(255, 168, 167); transform-origin: 405.348px 133.405px 0px;"
                            id="elfyd3nxe30c" class="animable"></path><path
                            d="M415.25,123.35h0v-6h-3.84v2.18A3.83,3.83,0,0,0,415.25,123.35Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 413.33px 120.35px 0px;"
                            id="el07w5grfqzl8p" class="animable"></path><path
                            d="M400.28,119.17a1.44,1.44,0,1,0,2.87.14,1.45,1.45,0,0,0-1.35-1.56A1.47,1.47,0,0,0,400.28,119.17Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 401.712px 119.263px 0px;"
                            id="el284uk99fjby" class="animable"></path><path
                            d="M399.35,128.64,395,130a2.26,2.26,0,0,0,2.86,1.58A2.41,2.41,0,0,0,399.35,128.64Z"
                            style="fill: rgb(242, 143, 143); transform-origin: 397.223px 130.162px 0px;"
                            id="elepsp09efi4e" class="animable"></path><path
                            d="M387.53,114.73l2.92-2a1.7,1.7,0,0,0-2.42-.5A1.86,1.86,0,0,0,387.53,114.73Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 388.849px 113.327px 0px;"
                            id="elhm07egi82fo" class="animable"></path><path
                            d="M388.2,118.11a1.44,1.44,0,1,0,1.51-1.42A1.46,1.46,0,0,0,388.2,118.11Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 389.64px 118.129px 0px;"
                            id="el50mljx2vgkn" class="animable"></path><polygon
                            points="396.19 117.3 395.94 125.96 391.38 124.54 396.19 117.3"
                            style="fill: rgb(242, 143, 143); transform-origin: 393.785px 121.63px 0px;"
                            id="el1o4etw2a3l3" class="animable"></polygon><path
                            d="M402.24,136.64c4.28-.91,9.72-3.44,10.91-6.43a7.42,7.42,0,0,1-2.4,4.84c-2.27,1.94-8.37,3.7-8.37,3.7Z"
                            style="fill: rgb(242, 143, 143); transform-origin: 407.695px 134.48px 0px;"
                            id="el9zdqitgpmym" class="animable"></path><path
                            d="M346.48,175.06c1.32-.2,6.67-3.39,8.32-6.93,0,0-.6,5.16-7.13,8.56Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 350.64px 172.41px 0px;"
                            id="elzebwqvet24b" class="animable"></path><g
                            id="ellz0xmy5hllf"><path
                              d="M346.48,175.06c1.32-.2,6.67-3.39,8.32-6.93,0,0-.6,5.16-7.13,8.56Z"
                              style="opacity: 0.05; transform-origin: 350.64px 172.41px 0px;"
                              class="animable"></path></g></g><path
                          d="M448.87,252.24l-37.53,18.84.8-13.82-5.79-3.34c.42-10.72,3.36-21.72,10.94-24.15,9.49-3,21.8-4,29.18-10.66s7.09-25.05,6.19-35.59-3.68-26.9,4.74-31.76,16.41.54,16.41.54c3.6,2.34,7.78,4,7.43,6.86a3.05,3.05,0,0,1-2.56,2.89l-20.94,79.26A17.2,17.2,0,0,1,448.87,252.24Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 443.805px 210.406px 0px;"
                          id="el8domu1rdh23" class="animable"></path><g
                          id="elqb673v5hx7d"><g
                            style="opacity: 0.3; transform-origin: 443.805px 210.406px 0px;"
                            class="animable"><path
                              d="M448.87,252.24l-37.53,18.84.8-13.82-5.79-3.34c.42-10.72,3.36-21.72,10.94-24.15,9.49-3,21.8-4,29.18-10.66s7.09-25.05,6.19-35.59-3.68-26.9,4.74-31.76,16.41.54,16.41.54c3.6,2.34,7.78,4,7.43,6.86a3.05,3.05,0,0,1-2.56,2.89l-20.94,79.26A17.2,17.2,0,0,1,448.87,252.24Z"
                              id="elra97rt51i9"
                              style="transform-origin: 443.805px 210.406px 0px;"
                              class="animable"></path></g></g><path
                          d="M462.91,161.53c-3.37,4-5.1,10.44-4.48,26.18s.37,28.43-5.79,36.14c-7.3,9.15-32.34,16.44-32.34,16.44l-9.78-4.48a12.29,12.29,0,0,1,6.77-6c9.49-3,21.8-4,29.18-10.66s7.09-25.05,6.19-35.59-3.69-26.9,4.74-31.76,16.41.54,16.41.54c3.6,2.34,7.78,4,7.43,6.86a3.05,3.05,0,0,1-2.56,2.89C474,160.51,466.28,157.5,462.91,161.53Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 445.89px 195.031px 0px;"
                          id="el0yhpw8nyfr9" class="animable"></path><g
                          id="elan9zfpkt3nr"><g
                            style="opacity: 0.2; transform-origin: 445.89px 195.031px 0px;"
                            class="animable"><path
                              d="M462.91,161.53c-3.37,4-5.1,10.44-4.48,26.18s.37,28.43-5.79,36.14c-7.3,9.15-32.34,16.44-32.34,16.44l-9.78-4.48a12.29,12.29,0,0,1,6.77-6c9.49-3,21.8-4,29.18-10.66s7.09-25.05,6.19-35.59-3.69-26.9,4.74-31.76,16.41.54,16.41.54c3.6,2.34,7.78,4,7.43,6.86a3.05,3.05,0,0,1-2.56,2.89C474,160.51,466.28,157.5,462.91,161.53Z"
                              id="eldol68v831lb"
                              style="transform-origin: 445.89px 195.031px 0px;"
                              class="animable"></path></g></g><path
                          d="M412.14,257.26l-5.79-3.34c0-6.42,1.66-20.36,9.77-23.73,6.45-2.67,9.56,1.26,9.49,3.68-.08,2.74-2.05,4.54-5.31,6.42C416,242.77,412.14,247.24,412.14,257.26Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 415.981px 243.278px 0px;"
                          id="elj418yadffkr" class="animable"></path><g
                          id="el76g7lvc881d"><path
                            d="M412.14,257.26l-5.79-3.34c0-6.42,1.66-20.36,9.77-23.73,6.45-2.67,9.56,1.26,9.49,3.68-.08,2.74-2.05,4.54-5.31,6.42C416,242.77,412.14,247.24,412.14,257.26Z"
                            style="opacity: 0.1; transform-origin: 415.981px 243.278px 0px;"
                            class="animable"></path></g><g
                          id="freepik--Arm--inject-3"
                          style="transform-origin: 427.354px 199.17px 0px;"
                          class="animable"><path
                            d="M451.33,196.49c-1.67-6.72-5.69-25-9.27-38.7-1.19-4.55-6-7.12-10.25-9.27-9.56,7.43-3.41,23.64-3.41,23.64l7.09,28.43-21.6,19.26h0a59.13,59.13,0,0,0-5.11,4.4,25.05,25.05,0,0,0-3.9,5c-2.09,3.38-2.66,7.13-3,10.94a10.75,10.75,0,0,0,.33,5.08,8,8,0,0,0,3,3.42c1.09.78,2.69,2.09,4.12,1.77,2.58-.58,2.52-3.25,3.4-6.55s2.56-5.55,5.23-8.57,1.42-7.34,5.63-10c0,0,15.76-9.2,23.31-14.35C454.9,205.53,452.46,201,451.33,196.49Z"
                            style="fill: rgb(255, 168, 167); transform-origin: 427.149px 199.515px 0px;"
                            id="el91gtgsowcht" class="animable"></path><path
                            d="M430.59,147.83c2.29,1.24,7.78.47,10.31,4.18s3.12,11.45,4.71,16.49,5.44,25.87,6.36,28.88,3,9.15-3.94,13.38c-6.22,3.8-16.63,10-16.63,10a8.5,8.5,0,0,0-2-5.42c-2.16-2.51-6.5-3.46-6.5-3.46L435,200.43,428.29,174s-4.83-7.85-2.22-16.57S430.59,147.83,430.59,147.83Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 437.946px 184.295px 0px;"
                            id="elfwie573kqww" class="animable"></path><g
                            id="elk4xz1ruasep"><path
                              d="M430.59,147.83c2.29,1.24,7.78.47,10.31,4.18s3.12,11.45,4.71,16.49,5.44,25.87,6.36,28.88,3,9.15-3.94,13.38c-6.22,3.8-16.63,10-16.63,10a8.5,8.5,0,0,0-2-5.42c-2.16-2.51-6.5-3.46-6.5-3.46L435,200.43,428.29,174s-4.83-7.85-2.22-16.57S430.59,147.83,430.59,147.83Z"
                              style="fill: rgb(255, 255, 255); opacity: 0.85; transform-origin: 437.946px 184.295px 0px;"
                              class="animable"></path></g><path
                            d="M435,200.43c2.55-2,7.67-1.7,10.38-.71,0,0-2.74-3.87-11.32-1.55Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 439.72px 198.93px 0px;"
                            id="elj27ygfnibm" class="animable"></path><g
                            id="eld50y3t257mq"><path
                              d="M435,200.43c2.55-2,7.67-1.7,10.38-.71,0,0-2.74-3.87-11.32-1.55Z"
                              style="opacity: 0.05; transform-origin: 439.72px 198.93px 0px;"
                              class="animable"></path></g></g></g></g><g
                      id="freepik--Desk--inject-3"
                      style="transform-origin: 295.35px 306.21px 0px;"
                      class="animable"><g id="freepik--desk--inject-3"
                        style="transform-origin: 295.35px 306.21px 0px;"
                        class="animable"><g id="freepik--desk--inject-3"
                          style="transform-origin: 295.35px 306.62px 0px;"
                          class="animable"><polygon
                            points="338.4 324.75 416.79 279.6 252.31 184.64 173.91 229.79 338.4 324.75"
                            style="fill: rgb(186, 104, 200); transform-origin: 295.35px 254.695px 0px;"
                            id="elmnx08xdq8b" class="animable"></polygon><g
                            id="el41scigxkpb4"><polygon
                              points="338.4 324.75 416.79 279.6 252.31 184.64 173.91 229.79 338.4 324.75"
                              style="opacity: 0.3; transform-origin: 295.35px 254.695px 0px;"
                              class="animable"></polygon></g><polygon
                            points="416.79 279.6 416.79 383.45 412.06 386.18 412.06 309.54 343.13 349.23 343.13 425.87 338.4 428.6 338.4 324.75 416.79 279.6"
                            style="fill: rgb(186, 104, 200); transform-origin: 377.595px 354.1px 0px;"
                            id="elhc3yblfosjh" class="animable"></polygon><g
                            id="elawi28pohn89"><polygon
                              points="416.79 279.6 416.79 383.45 412.06 386.18 412.06 309.54 343.13 349.23 343.13 425.87 338.4 428.6 338.4 324.75 416.79 279.6"
                              style="opacity: 0.5; transform-origin: 377.595px 354.1px 0px;"
                              class="animable"></polygon></g><polygon
                            points="412.06 386.18 407.33 383.45 407.33 312.27 412.06 309.54 412.06 386.18"
                            style="fill: rgb(186, 104, 200); transform-origin: 409.695px 347.86px 0px;"
                            id="eliy8sswjoxkd" class="animable"></polygon><g
                            id="elsbwzg29ddb"><polygon
                              points="412.06 386.18 407.33 383.45 407.33 312.27 412.06 309.54 412.06 386.18"
                              style="opacity: 0.6; transform-origin: 409.695px 347.86px 0px;"
                              class="animable"></polygon></g><polygon
                            points="338.4 428.6 333.66 425.87 333.66 349.23 178.64 259.73 178.64 336.37 173.91 333.64 173.91 229.79 338.4 324.75 338.4 428.6"
                            style="fill: rgb(186, 104, 200); transform-origin: 256.155px 329.195px 0px;"
                            id="elfx8rip7iyxi" class="animable"></polygon><g
                            id="elmu5iuxg5dgf"><polygon
                              points="338.4 428.6 333.66 425.87 333.66 349.23 178.64 259.73 178.64 336.37 173.91 333.64 173.91 229.79 338.4 324.75 338.4 428.6"
                              style="opacity: 0.4; transform-origin: 256.155px 329.195px 0px;"
                              class="animable"></polygon></g><polygon
                            points="178.64 336.37 183.37 333.64 183.38 262.46 178.64 259.73 178.64 336.37"
                            style="fill: rgb(186, 104, 200); transform-origin: 181.01px 298.05px 0px;"
                            id="elz9f8ir9j9j" class="animable"></polygon><g
                            id="elvvl42pb13t"><g
                              style="opacity: 0.6; transform-origin: 181.01px 298.05px 0px;"
                              class="animable"><polygon
                                points="178.64 336.37 183.37 333.64 183.38 262.46 178.64 259.73 178.64 336.37"
                                id="el8vhrk61kfny"
                                style="transform-origin: 181.01px 298.05px 0px;"
                                class="animable"></polygon></g></g></g><g
                          id="freepik--Sheets--inject-3"
                          style="transform-origin: 337.98px 272.39px 0px;"
                          class="animable"><g id="elamldhgzw9jj"><g
                              style="opacity: 0.2; transform-origin: 337.98px 275.055px 0px;"
                              class="animable"><path
                                d="M369.11,273l-34.83,20.11a2.18,2.18,0,0,1-2,0l-25.63-14.8a.59.59,0,0,1,0-1.13L341.52,257a2.18,2.18,0,0,1,2,0l25.63,14.8A.6.6,0,0,1,369.11,273Z"
                                id="elsgx6zofczo"
                                style="transform-origin: 337.98px 275.055px 0px;"
                                class="animable"></path></g></g><path
                            d="M369.11,271.15l-34.83,20.11a2.18,2.18,0,0,1-2,0l-25.63-14.8c-.54-.32-.54-.82,0-1.13l34.83-20.11a2.12,2.12,0,0,1,2,0L369.11,270A.6.6,0,0,1,369.11,271.15Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 337.892px 273.236px 0px;"
                            id="elt0v081hou6h" class="animable"></path><path
                            d="M343.48,255.22l24.34,14-33.54,19.36a2.18,2.18,0,0,1-2,0L308,274.58l33.54-19.36A2.12,2.12,0,0,1,343.48,255.22Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 337.91px 271.904px 0px;"
                            id="el980s35oawo6" class="animable"></path><path
                            d="M369.11,267.61l-34.83,20.11a2.18,2.18,0,0,1-2,0l-25.63-14.8c-.55-.32-.55-.82,0-1.14l34.83-20.11a2.18,2.18,0,0,1,2,0l25.63,14.8A.6.6,0,0,1,369.11,267.61Z"
                            style="fill: rgb(250, 250, 250); transform-origin: 337.88px 269.695px 0px;"
                            id="elubfm071b2i" class="animable"></path></g><g
                          id="freepik--Pen--inject-3"
                          style="transform-origin: 375.961px 282.201px 0px;"
                          class="animable"><g id="elw7o6413rdm"><path
                              d="M391.24,276.47l-25.81,14.91-4.41.9a.14.14,0,0,1-.15-.2l1.38-2.53,25.82-14.92C388.94,274.13,391.93,276.07,391.24,276.47Z"
                              style="opacity: 0.2; transform-origin: 376.099px 283.415px 0px;"
                              class="animable"></path></g><g
                            id="freepik--pen--inject-3"
                            style="transform-origin: 375.464px 281.145px 0px;"
                            class="animable"><path
                              d="M388.18,272.8a2.59,2.59,0,0,0,1.19,2.05,1,1,0,0,0,.68.15l-.13.1.28-.16h0l0,0,.05,0,0,0h0l0,0a.51.51,0,0,0,.09-.18l0-.05a0,0,0,0,0,0,0l0-.06a1.23,1.23,0,0,0,0-.29,2.63,2.63,0,0,0-1.18-2.05,1.1,1.1,0,0,0-.53-.16h-.08l-.07,0h-.07l0,0h0l-.05,0-.25.14.13,0A.92.92,0,0,0,388.18,272.8Zm1.95,2.17h0Z"
                              style="fill: rgb(186, 104, 200); transform-origin: 389.229px 273.625px 0px;"
                              id="elokj9ggnqtd" class="animable"></path><path
                              d="M363.62,286.42l1.66,2.9.29-.16,24.35-14.06.13-.1a1,1,0,0,0,.21-.67,2.63,2.63,0,0,0-1.18-2.05,1.07,1.07,0,0,0-.53-.16l-.15,0-.13,0h0Z"
                              style="fill: rgb(240, 240, 240); transform-origin: 376.941px 280.72px 0px;"
                              id="elq301vijz83q" class="animable"></path><path
                              d="M364.45,286.5c-.65-.38-1.18-.07-1.18.68a2.6,2.6,0,0,0,1.18,2.05c.66.38,1.19.07,1.19-.68A2.62,2.62,0,0,0,364.45,286.5Z"
                              style="fill: rgb(186, 104, 200); transform-origin: 364.455px 287.865px 0px;"
                              id="elhk8xocj2jf5" class="animable"></path><path
                              d="M361.91,288.26l0,0,1.51-1.66h0l0,0,0,0h0a.77.77,0,0,1,.94,0,2.62,2.62,0,0,1,1.19,2.05.76.76,0,0,1-.46.81h0l-.08,0h0l-2.19.48a.56.56,0,0,1-.38-.08,1.51,1.51,0,0,1-.68-1.17A.53.53,0,0,1,361.91,288.26Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 363.657px 288.193px 0px;"
                              id="el71rv3rhq8gb" class="animable"></path><path
                              d="M381.24,277.49h0l0,0a.31.31,0,0,1,.27,0,.91.91,0,0,1,.43.73.29.29,0,0,1-.1.25h0l-.06,0-18,10.38-1.18-.68Z"
                              style="fill: rgb(69, 90, 100); transform-origin: 372.271px 283.155px 0px;"
                              id="el7wtof1z43p9" class="animable"></path><path
                              d="M365.53,287.93l-1.67,1-1.18-.68,2.26-1.31A2.94,2.94,0,0,1,365.53,287.93Z"
                              style="fill: rgb(55, 71, 79); transform-origin: 364.105px 287.935px 0px;"
                              id="elt7t6avzimvf" class="animable"></path><path
                              d="M361.31,289.05h0l1.37-1.51,0,0a.53.53,0,0,1,.67,0,1.81,1.81,0,0,1,.84,1.44.55.55,0,0,1-.32.58h-.07l-2,.44h0a.31.31,0,0,1-.22-.05.83.83,0,0,1-.38-.65A.32.32,0,0,1,361.31,289.05Z"
                              style="fill: rgb(186, 104, 200); transform-origin: 362.698px 288.712px 0px;"
                              id="elsti3urudj3" class="animable"></path><g
                              id="elxnkvfor6far"><path
                                d="M361.31,289.05h0l1.37-1.51,0,0a.53.53,0,0,1,.67,0,1.81,1.81,0,0,1,.84,1.44.55.55,0,0,1-.32.58h-.07l-2,.44h0a.31.31,0,0,1-.22-.05.83.83,0,0,1-.38-.65A.32.32,0,0,1,361.31,289.05Z"
                                style="opacity: 0.1; transform-origin: 362.698px 288.712px 0px;"
                                class="animable"></path></g><path
                              d="M361.24,289.27a.83.83,0,0,0,.38.65.3.3,0,0,0,.21.05h0l1-.22c.16,0,.26-.18.26-.43a1.35,1.35,0,0,0-.6-1.05.39.39,0,0,0-.49,0l0,0-.68.75h0A.32.32,0,0,0,361.24,289.27Z"
                              style="fill: rgb(186, 104, 200); transform-origin: 362.164px 289.078px 0px;"
                              id="ellp9jr7tk5kn" class="animable"></path><g
                              id="elyw9xsvu4b4"><path
                                d="M361.62,289.05c-.21-.13-.38,0-.38.22a.83.83,0,0,0,.38.65c.21.13.38,0,.38-.22A.83.83,0,0,0,361.62,289.05Z"
                                style="opacity: 0.1; transform-origin: 361.62px 289.485px 0px;"
                                class="animable"></path></g><path
                              d="M385.72,274.9a.33.33,0,0,1,.3,0,.91.91,0,0,1,.41.73.28.28,0,0,1-.12.27h0l-4.42,2.55a.29.29,0,0,0,.1-.25.91.91,0,0,0-.43-.73.31.31,0,0,0-.27,0Z"
                              style="fill: rgb(250, 250, 250); transform-origin: 383.861px 276.657px 0px;"
                              id="elkk8cswva55f" class="animable"></path><path
                              d="M385.6,275.17a.9.9,0,0,0,.42.73.31.31,0,0,0,.29,0,.28.28,0,0,0,.12-.27.91.91,0,0,0-.41-.73.33.33,0,0,0-.3,0A.29.29,0,0,0,385.6,275.17Z"
                              style="fill: rgb(245, 245, 245); transform-origin: 386.015px 275.4px 0px;"
                              id="el4e1swtszb2k" class="animable"></path><path
                              d="M386.53,273.38h0l1.75-1,0,0h0a.78.78,0,0,1,.72.09,2.35,2.35,0,0,1,1.07,1.84.76.76,0,0,1-.32.69h0l-1.77,1h0a.71.71,0,0,1-.73-.08,2.35,2.35,0,0,1-1.07-1.84A.77.77,0,0,1,386.53,273.38Z"
                              style="fill: rgb(186, 104, 200); transform-origin: 388.126px 274.198px 0px;"
                              id="ele3ke5anvbj" class="animable"></path><g
                              id="elxzcbs9tdpeo"><path
                                d="M386.53,273.38h0l1.75-1,0,0h0a.78.78,0,0,1,.72.09,2.35,2.35,0,0,1,1.07,1.84.76.76,0,0,1-.32.69h0l-1.77,1h0a.71.71,0,0,1-.73-.08,2.35,2.35,0,0,1-1.07-1.84A.77.77,0,0,1,386.53,273.38Z"
                                style="opacity: 0.05; transform-origin: 388.126px 274.198px 0px;"
                                class="animable"></path></g><g
                              id="elb5g611oi6vp"><path
                                d="M387.31,273.44c-.59-.34-1.07-.06-1.07.62a2.35,2.35,0,0,0,1.07,1.84c.58.34,1.06.07,1.06-.61A2.38,2.38,0,0,0,387.31,273.44Z"
                                style="opacity: 0.1; transform-origin: 387.305px 274.671px 0px;"
                                class="animable"></path></g><path
                              d="M360.76,289.68h0l.72-.43h0a.14.14,0,0,1,.14,0,.41.41,0,0,1,.19.34.14.14,0,0,1-.05.12h0l-.72.44h0a.32.32,0,0,1-.14,0,.27.27,0,0,1-.27-.27A.28.28,0,0,1,360.76,289.68Z"
                              style="fill: rgb(69, 90, 100); transform-origin: 361.22px 289.694px 0px;"
                              id="elaknjd1udvkh" class="animable"></path><path
                              d="M360.71,289.71h0l0,0h0a.19.19,0,0,1,.12,0,.45.45,0,0,1,.2.34.12.12,0,0,1-.06.12h-.12a.27.27,0,0,1-.27-.27A.3.3,0,0,1,360.71,289.71Z"
                              style="fill: rgb(38, 50, 56); transform-origin: 360.806px 289.935px 0px;"
                              id="eln2jyujml42i"
                              class="animable"></path></g></g><g
                          id="freepik--shadow--inject-3"><g
                            style="opacity: 0.2; transform-origin: 198.724px 228.54px 0px;"
                            class="animable"><path
                              d="M191.36,224.29c-4.06,2.35-4.06,6.15,0,8.5a16.25,16.25,0,0,0,14.72,0c4.07-2.35,4.07-6.15,0-8.5A16.25,16.25,0,0,0,191.36,224.29Z"
                              id="el3hxl9xmkwcj"
                              style="transform-origin: 198.724px 228.54px 0px;"
                              class="animable"></path></g></g><g
                          id="freepik--Pot--inject-3"
                          style="transform-origin: 198.811px 215.038px 0px;"
                          class="animable"><path
                            d="M192.54,229c-3.28-3.35-5.21-11.71-2-14.37h16.3c3.2,2.66,1.27,11-2,14.37l-.09.09-.11.11-.3.27-.08.06-.24.18c-.14.1-.29.2-.43.28a10.87,10.87,0,0,1-9.78,0h0c-.14-.08-.29-.18-.43-.28l-.23-.17-.09-.08a3.74,3.74,0,0,1-.29-.25,1.59,1.59,0,0,1-.13-.13Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 198.687px 222.891px 0px;"
                            id="elft3kwgg3en" class="animable"></path><path
                            d="M205.41,213.55c3.72,2.14,3.72,5.63,0,7.77a14.85,14.85,0,0,1-13.46,0c-3.72-2.14-3.72-5.62,0-7.77A14.85,14.85,0,0,1,205.41,213.55Z"
                            style="fill: rgb(250, 250, 250); transform-origin: 198.68px 217.435px 0px;"
                            id="elco8sk7rrhz5" class="animable"></path><path
                            d="M202.78,215.07c2.26,1.31,2.26,3.42,0,4.73a9,9,0,0,1-8.19,0c-2.27-1.31-2.27-3.42,0-4.73A9,9,0,0,1,202.78,215.07Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 198.681px 217.435px 0px;"
                            id="el9vhcvcxblms" class="animable"></path><path
                            d="M194.59,217.32a9.06,9.06,0,0,1,8.19,0,3.83,3.83,0,0,1,1.35,1.25,3.81,3.81,0,0,1-1.35,1.24,9,9,0,0,1-8.19,0,3.77,3.77,0,0,1-1.36-1.24A3.68,3.68,0,0,1,194.59,217.32Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 198.68px 218.569px 0px;"
                            id="elks3p3hydqte" class="animable"></path><path
                            d="M197.2,219.07a12.14,12.14,0,0,1-5-6.34c-1.5-4.39-.61-9.7.73-11.9,1.82-3,6.25-2.63,4.93,2.33s-2.11,10.35,0,14Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 194.76px 208.997px 0px;"
                            id="elvjc5dguyip8" class="animable"></path><g
                            id="el6a2ja39k0q8"><g
                              style="opacity: 0.35; transform-origin: 194.76px 208.997px 0px;"
                              class="animable"><path
                                d="M197.2,219.07a12.14,12.14,0,0,1-5-6.34c-1.5-4.39-.61-9.7.73-11.9,1.82-3,6.25-2.63,4.93,2.33s-2.11,10.35,0,14Z"
                                id="elbm3a9vnz2qm"
                                style="transform-origin: 194.76px 208.997px 0px;"
                                class="animable"></path></g></g><path
                            d="M197.05,218.17a.19.19,0,0,0,.13,0,.19.19,0,0,0,0-.28A14.5,14.5,0,0,1,193.49,207c.23-3.59,1.57-6.19,2.06-6.62a.19.19,0,0,0,0-.28.19.19,0,0,0-.28,0c-.67.58-2,3.38-2.2,6.9a14.9,14.9,0,0,0,3.81,11.09A.19.19,0,0,0,197.05,218.17Z"
                            style="fill: rgb(250, 250, 250); transform-origin: 195.136px 209.11px 0px;"
                            id="el9yiy4d6a618" class="animable"></path><path
                            d="M201,219.07a1.94,1.94,0,0,1,.81-1.06,7.57,7.57,0,0,1,1.46-.63c.88-.32,2-.78,2.11-1.84a2.87,2.87,0,0,0-.13-1.12,2.43,2.43,0,0,1-.15-1.54c.19-.47.69-.72,1.12-1a3.58,3.58,0,0,0,1.18-1.11,2.34,2.34,0,0,0,.34-1.36c-.08-1-1-1.63-1.05-2.61,0-1.42,3.29-3.35,1.51-4.7-2.27-1.72-5.83.28-6.85,1.74s-1,2.11-2.88,3.35c-1.54,1-3.36,1.24-3.36,3.26s2.6,2.12.55,4.42c-1.23,1.37.8,2.57,1.54,4.2A3.37,3.37,0,0,0,201,219.07Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 201.919px 210.547px 0px;"
                            id="elnf2sxs7i9w" class="animable"></path><path
                            d="M199,219.66h0a.21.21,0,0,0,.2-.21c-.45-11.76,5.54-15.9,6.73-16.22A.2.2,0,0,0,206,203a.2.2,0,0,0-.24-.14c-2,.55-7.46,5.52-7,16.63A.2.2,0,0,0,199,219.66Z"
                            style="fill: rgb(250, 250, 250); transform-origin: 202.372px 211.259px 0px;"
                            id="el2qyxqzofhxv" class="animable"></path><path
                            d="M200.11,210.89a.19.19,0,0,0,.13,0c1.74-1.53,5.13-1.49,5.17-1.49a.2.2,0,0,0,.2-.2.19.19,0,0,0-.19-.2c-.15,0-3.59,0-5.44,1.59a.2.2,0,0,0,0,.28A.19.19,0,0,0,200.11,210.89Z"
                            style="fill: rgb(250, 250, 250); transform-origin: 202.767px 209.951px 0px;"
                            id="elv1mhkp3fs2" class="animable"></path></g><g
                          id="freepik--Notebooks--inject-3"
                          style="transform-origin: 336.635px 259.607px 0px;"
                          class="animable"><g id="el51my5y5t3a6"><path
                              d="M332.56,277.14a1.64,1.64,0,0,0,.78-.19l29.91-17.28a.84.84,0,0,0,.47-.73.85.85,0,0,0-.47-.73l-21.7-12.53-32,18.45L331.78,277A1.64,1.64,0,0,0,332.56,277.14Z"
                              style="opacity: 0.2; transform-origin: 336.635px 261.412px 0px;"
                              class="animable"></path></g><path
                            d="M340.55,244.67l22.7,12,.47.74V258a.85.85,0,0,1-.47.73L333.34,276a1.62,1.62,0,0,1-1.56,0l-22.19-12.81v-.59Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 336.655px 260.435px 0px;"
                            id="elpk8hj8au8me" class="animable"></path><path
                            d="M332.56,275.55a1.53,1.53,0,0,0,.78-.19l29.91-17.27a.81.81,0,0,0,0-1.47l-21.7-12.53-32,18.46,22.19,12.81A1.53,1.53,0,0,0,332.56,275.55Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 336.635px 259.821px 0px;"
                            id="eluwvl5s9ndcp" class="animable"></path><path
                            d="M341.55,242.36,363,254.75l.22.3v2.31h0a.37.37,0,0,1-.22.3l-29.92,17.28a1.17,1.17,0,0,1-1.06,0l-21.46-12.39v-2.3Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 336.89px 258.713px 0px;"
                            id="el5krteql568g" class="animable"></path><path
                            d="M310.57,260.25l.27.15,3.49,2,.65.37,17,9.84a1.17,1.17,0,0,0,1.06,0L363,255.36a.33.33,0,0,0,0-.62l-.29-.16-21.17-12.22-30.71,17.73-.07,0Z"
                            style="fill: rgb(240, 240, 240); transform-origin: 336.893px 257.548px 0px;"
                            id="elhf7k6hvweap" class="animable"></path><path
                            d="M332.56,272.76v2.3a1.12,1.12,0,0,0,.53-.12L363,257.66a.37.37,0,0,0,.22-.31v-2.3a.4.4,0,0,1-.22.31l-29.92,17.27A1,1,0,0,1,332.56,272.76Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 347.89px 265.055px 0px;"
                            id="elmh4xbqatbu" class="animable"></path><path
                            d="M310.57,259.94l3.86,2.23.61.35,17,9.81a1.17,1.17,0,0,0,1.06,0l26.79-15.47.68-.39a6.52,6.52,0,0,0,2.16-1.89.35.35,0,0,0,0-.08.33.33,0,0,0,.07-.16.48.48,0,0,0-.37-.54,9.49,9.49,0,0,1-2-.84l0,0-18.87-10.89Z"
                            style="fill: rgb(255, 255, 255); transform-origin: 336.688px 257.264px 0px;"
                            id="el1snztmns44z" class="animable"></path><g
                            id="eld5izel3m5p9"><path
                              d="M314.57,259.67a.31.31,0,0,1,0,.58,1.08,1.08,0,0,1-1,0,.31.31,0,0,1,0-.58A1.08,1.08,0,0,1,314.57,259.67Z"
                              style="opacity: 0.1; transform-origin: 314.07px 259.96px 0px;"
                              class="animable"></path></g><path
                            d="M310.68,259.36a4,4,0,0,0,0,.49l.35-.2a2.83,2.83,0,0,1,0-.29,1.39,1.39,0,0,1,.51-1.24.74.74,0,0,1,.36-.09,1.22,1.22,0,0,1,.61.19,3.74,3.74,0,0,1,1.5,2.14.87.87,0,0,0,.36,0,4.13,4.13,0,0,0-1.68-2.42,1.33,1.33,0,0,0-1.34-.1A1.74,1.74,0,0,0,310.68,259.36Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 312.521px 259.042px 0px;"
                            id="eltfdmrn2u01o" class="animable"></path><path
                            d="M310.76,260.05s0,.05,0,.08l.07,0Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 310.795px 260.09px 0px;"
                            id="el4szgq0knu0q" class="animable"></path><g
                            id="ellgqpyx596wo"><path
                              d="M317.57,257.94a.31.31,0,0,1,0,.58,1.13,1.13,0,0,1-1,0,.31.31,0,0,1,0-.58A1.1,1.1,0,0,1,317.57,257.94Z"
                              style="opacity: 0.1; transform-origin: 317.07px 258.228px 0px;"
                              class="animable"></path></g><path
                            d="M313.68,257.63a2.7,2.7,0,0,0,0,.49l.35-.2c0-.1,0-.2,0-.29a1.39,1.39,0,0,1,.51-1.24.68.68,0,0,1,.35-.09,1.17,1.17,0,0,1,.61.19,3.76,3.76,0,0,1,1.51,2.14,1.08,1.08,0,0,0,.36,0,4.13,4.13,0,0,0-1.68-2.42,1.31,1.31,0,0,0-1.34-.1A1.72,1.72,0,0,0,313.68,257.63Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 315.519px 257.308px 0px;"
                            id="el1aktqfmb2d3" class="animable"></path><g
                            id="elcenrjgbdk4"><path
                              d="M320.57,256.21a.3.3,0,0,1,0,.57,1.1,1.1,0,0,1-1,0,.3.3,0,0,1,0-.57A1.1,1.1,0,0,1,320.57,256.21Z"
                              style="opacity: 0.1; transform-origin: 320.07px 256.495px 0px;"
                              class="animable"></path></g><path
                            d="M316.68,255.89a2.81,2.81,0,0,0,0,.5l.35-.2a1.51,1.51,0,0,1,0-.3,1.38,1.38,0,0,1,.5-1.23.74.74,0,0,1,.36-.09,1.17,1.17,0,0,1,.61.19,3.7,3.7,0,0,1,1.5,2.14,1.11,1.11,0,0,0,.37,0,4.13,4.13,0,0,0-1.68-2.42,1.31,1.31,0,0,0-1.34-.1A1.71,1.71,0,0,0,316.68,255.89Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 318.519px 255.579px 0px;"
                            id="el20ctxlhbxw9" class="animable"></path><g
                            id="elzp816e4eawj"><path
                              d="M323.56,254.48c.28.16.28.41,0,.57a1.08,1.08,0,0,1-1,0c-.28-.16-.28-.41,0-.57A1.08,1.08,0,0,1,323.56,254.48Z"
                              style="opacity: 0.1; transform-origin: 323.06px 254.765px 0px;"
                              class="animable"></path></g><path
                            d="M319.68,254.16a2.81,2.81,0,0,0,0,.5l.35-.2a1.51,1.51,0,0,1,0-.3,1.38,1.38,0,0,1,.5-1.23.74.74,0,0,1,.36-.09,1.25,1.25,0,0,1,.61.18,3.72,3.72,0,0,1,1.5,2.15,1.11,1.11,0,0,0,.37,0,4.18,4.18,0,0,0-1.68-2.43,1.33,1.33,0,0,0-1.34-.09A1.7,1.7,0,0,0,319.68,254.16Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 321.519px 253.848px 0px;"
                            id="el2uvc6ym5999" class="animable"></path><g
                            id="el88qd34nvu5s"><path
                              d="M326.56,252.75c.28.15.28.41,0,.57a1.08,1.08,0,0,1-1,0c-.28-.16-.28-.42,0-.57A1.08,1.08,0,0,1,326.56,252.75Z"
                              style="opacity: 0.1; transform-origin: 326.06px 253.035px 0px;"
                              class="animable"></path></g><path
                            d="M322.68,252.43a4.19,4.19,0,0,0,0,.5l.35-.2c0-.1,0-.2,0-.3a1.36,1.36,0,0,1,.5-1.23.74.74,0,0,1,.36-.09,1.28,1.28,0,0,1,.61.18,3.77,3.77,0,0,1,1.5,2.15.92.92,0,0,0,.37-.05A4.25,4.25,0,0,0,324.7,251a1.31,1.31,0,0,0-1.33-.09A1.7,1.7,0,0,0,322.68,252.43Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 324.521px 252.106px 0px;"
                            id="elivvfekt4x7" class="animable"></path><g
                            id="elhzkzt9qau5"><path
                              d="M329.56,251a.31.31,0,0,1,0,.58,1.08,1.08,0,0,1-1,0,.31.31,0,0,1,0-.58A1.15,1.15,0,0,1,329.56,251Z"
                              style="opacity: 0.1; transform-origin: 329.06px 251.294px 0px;"
                              class="animable"></path></g><path
                            d="M325.68,250.7a4.32,4.32,0,0,0,0,.5l.35-.2c0-.1,0-.2,0-.3a1.36,1.36,0,0,1,.51-1.23.74.74,0,0,1,.36-.09,1.28,1.28,0,0,1,.61.18,3.77,3.77,0,0,1,1.5,2.15,1,1,0,0,0,.37-.05,4.25,4.25,0,0,0-1.69-2.42,1.31,1.31,0,0,0-1.34-.09A1.72,1.72,0,0,0,325.68,250.7Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 327.525px 250.359px 0px;"
                            id="elw677y2lmck" class="animable"></path><g
                            id="eli778mza6x2r"><path
                              d="M332.56,249.28a.31.31,0,0,1,0,.58,1.1,1.1,0,0,1-1,0,.31.31,0,0,1,0-.58A1.1,1.1,0,0,1,332.56,249.28Z"
                              style="opacity: 0.1; transform-origin: 332.06px 249.57px 0px;"
                              class="animable"></path></g><path
                            d="M328.67,249a4.38,4.38,0,0,0,0,.5l.35-.2c0-.1,0-.2,0-.3a1.36,1.36,0,0,1,.51-1.23.75.75,0,0,1,.36-.1,1.33,1.33,0,0,1,.61.19A3.77,3.77,0,0,1,332,250a1.08,1.08,0,0,0,.36,0,4.19,4.19,0,0,0-1.68-2.42,1.31,1.31,0,0,0-1.34-.09A1.7,1.7,0,0,0,328.67,249Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 330.511px 248.681px 0px;"
                            id="elrewdy0hqwz" class="animable"></path><g
                            id="eloq3ya4u0cms"><path
                              d="M335.56,247.55a.31.31,0,0,1,0,.58,1.1,1.1,0,0,1-1,0,.31.31,0,0,1,0-.58A1.1,1.1,0,0,1,335.56,247.55Z"
                              style="opacity: 0.1; transform-origin: 335.06px 247.84px 0px;"
                              class="animable"></path></g><path
                            d="M331.67,247.24a2.89,2.89,0,0,0,0,.5l.35-.21a2.64,2.64,0,0,1,0-.29,1.36,1.36,0,0,1,.51-1.23.69.69,0,0,1,.36-.1,1.33,1.33,0,0,1,.61.19,3.77,3.77,0,0,1,1.5,2.15,1.08,1.08,0,0,0,.36-.05,4.19,4.19,0,0,0-1.68-2.42,1.31,1.31,0,0,0-1.34-.09A1.7,1.7,0,0,0,331.67,247.24Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 333.51px 246.899px 0px;"
                            id="elqasjzmqgaz9" class="animable"></path><g
                            id="ellh56ip88add"><path
                              d="M338.56,245.82a.31.31,0,0,1,0,.58,1.1,1.1,0,0,1-1,0,.31.31,0,0,1,0-.58A1.1,1.1,0,0,1,338.56,245.82Z"
                              style="opacity: 0.1; transform-origin: 338.06px 246.11px 0px;"
                              class="animable"></path></g><path
                            d="M334.67,245.51a2.89,2.89,0,0,0,0,.5l.35-.21a1.42,1.42,0,0,1,0-.29,1.35,1.35,0,0,1,.5-1.23.65.65,0,0,1,.36-.1,1.27,1.27,0,0,1,.61.19,3.73,3.73,0,0,1,1.5,2.14.9.9,0,0,0,.37,0,4.13,4.13,0,0,0-1.68-2.42,1.31,1.31,0,0,0-1.34-.09A1.69,1.69,0,0,0,334.67,245.51Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 336.51px 245.193px 0px;"
                            id="elxg0073jsbk" class="animable"></path><g
                            id="elhhouyfyjsfe"><path
                              d="M341.55,244.09a.31.31,0,0,1,0,.58,1.08,1.08,0,0,1-1,0,.31.31,0,0,1,0-.58A1.08,1.08,0,0,1,341.55,244.09Z"
                              style="opacity: 0.1; transform-origin: 341.05px 244.38px 0px;"
                              class="animable"></path></g><path
                            d="M337.67,243.78a2.7,2.7,0,0,0,0,.49l.35-.2a1.42,1.42,0,0,1,0-.29,1.38,1.38,0,0,1,.5-1.24.74.74,0,0,1,.36-.09,1.27,1.27,0,0,1,.61.19,3.7,3.7,0,0,1,1.5,2.14.9.9,0,0,0,.37,0,4.13,4.13,0,0,0-1.68-2.42,1.34,1.34,0,0,0-1.34-.1A1.72,1.72,0,0,0,337.67,243.78Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 339.509px 243.463px 0px;"
                            id="el6k61h2v6u5q" class="animable"></path><path
                            d="M335.56,269.53a.62.62,0,0,1-.32-.09l-16.5-9.52a.63.63,0,0,1,.63-1.09l16.5,9.53a.63.63,0,0,1-.31,1.17Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 327.311px 264.144px 0px;"
                            id="elcygky1eb9rj" class="animable"></path><path
                            d="M337.55,268.37a.6.6,0,0,1-.31-.08l-16.5-9.53a.62.62,0,0,1-.23-.86.61.61,0,0,1,.85-.22l16.51,9.52a.63.63,0,0,1-.32,1.17Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 329.299px 262.98px 0px;"
                            id="elgyhqntmprii" class="animable"></path><path
                            d="M339.55,267.22a.71.71,0,0,1-.31-.08l-16.5-9.53a.63.63,0,0,1,.62-1.09l16.51,9.53a.63.63,0,0,1-.32,1.17Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 331.324px 261.843px 0px;"
                            id="eln2mm485no7h" class="animable"></path><path
                            d="M341.55,266.07a.61.61,0,0,1-.31-.09l-16.5-9.53a.62.62,0,1,1,.62-1.08l16.51,9.53a.62.62,0,0,1,.23.85A.65.65,0,0,1,341.55,266.07Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 333.305px 260.679px 0px;"
                            id="elqnkdveju29" class="animable"></path><path
                            d="M343.55,264.91a.71.71,0,0,1-.31-.08l-16.51-9.53a.63.63,0,0,1,.63-1.09l16.51,9.53a.63.63,0,0,1-.32,1.17Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 335.306px 259.524px 0px;"
                            id="el8mb21x26fnw" class="animable"></path><path
                            d="M345.55,263.76a.61.61,0,0,1-.31-.09l-16.51-9.53a.62.62,0,0,1-.23-.85.64.64,0,0,1,.86-.23l16.51,9.53a.61.61,0,0,1,.22.85A.6.6,0,0,1,345.55,263.76Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 337.298px 258.37px 0px;"
                            id="elqwfxkkpa2w" class="animable"></path><path
                            d="M347.55,262.6a.58.58,0,0,1-.31-.08L330.73,253a.63.63,0,0,1,.63-1.09l16.5,9.53a.63.63,0,0,1,.23.86A.61.61,0,0,1,347.55,262.6Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 339.306px 257.219px 0px;"
                            id="elo512lfh5job" class="animable"></path><path
                            d="M349.55,261.45a.65.65,0,0,1-.31-.08l-16.51-9.53a.63.63,0,0,1,.63-1.09l16.5,9.53a.62.62,0,0,1,.23.86A.61.61,0,0,1,349.55,261.45Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 341.308px 256.064px 0px;"
                            id="elrbwxw8ccu5" class="animable"></path><path
                            d="M351.55,260.3a.56.56,0,0,1-.31-.09l-16.51-9.53a.63.63,0,1,1,.63-1.08l16.5,9.53a.62.62,0,0,1,.23.85A.63.63,0,0,1,351.55,260.3Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 343.261px 254.885px 0px;"
                            id="elkktxbvayi5" class="animable"></path><path
                            d="M353.55,259.14a.72.72,0,0,1-.32-.08l-16.5-9.53a.63.63,0,0,1,.63-1.09l16.5,9.53a.63.63,0,0,1-.31,1.17Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 345.301px 253.754px 0px;"
                            id="el5m06szq0kgr" class="animable"></path><path
                            d="M355.55,258a.62.62,0,0,1-.32-.09l-16.5-9.53a.63.63,0,1,1,.63-1.08l16.5,9.53a.63.63,0,0,1-.31,1.17Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 347.257px 252.585px 0px;"
                            id="elrft9601gyzq" class="animable"></path><path
                            d="M357.54,256.83a.6.6,0,0,1-.31-.08l-16.5-9.53a.63.63,0,0,1-.23-.86.62.62,0,0,1,.85-.23l16.51,9.53a.63.63,0,0,1-.32,1.17Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 349.291px 251.438px 0px;"
                            id="el8tnhykni2ri" class="animable"></path><path
                            d="M359.54,255.68a.61.61,0,0,1-.31-.09l-16.5-9.52a.63.63,0,0,1,.62-1.09l16.51,9.53a.63.63,0,0,1-.32,1.17Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 351.314px 250.303px 0px;"
                            id="elpo3xar6yuxd" class="animable"></path><path
                            d="M333.53,270.68a.61.61,0,0,1-.32-.08l-17.45-10.1a.62.62,0,0,1-.23-.86.61.61,0,0,1,.85-.22l17.46,10.09a.63.63,0,0,1-.31,1.17Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 324.794px 265.005px 0px;"
                            id="el55h8yd87ylx" class="animable"></path><path
                            d="M325.2,258.16a2.51,2.51,0,0,0,.84-.87.74.74,0,0,1,.38-.08c.48.06.07.25,0,.43a.08.08,0,0,0,.09.11c.34-.06,1.15-.26.93.29a.08.08,0,0,0,.05.1c.1,0,.56.09.51.21a.08.08,0,0,0,.07.1,9.38,9.38,0,0,1,1.06,0,3.37,3.37,0,0,1,.49,0c.11.13-.07.41-.12.5a.09.09,0,0,0,0,.12c.18.08.32.19.2.38s0,.11,0,.12c.46.13,1.28-.25,1.41.3.08.33,0,.41.44.38.08,0,.13-.15,0-.16-.44,0-.12-.5-.37-.67s-.85.16-1.13,0,.05-.19-.11-.38-.15,0-.18-.08-.07-.07-.08-.07a.27.27,0,0,0,0-.13c0-.09.06-.08.07-.13.11-.51-.71-.39-1-.42a4,4,0,0,1-.6,0s0-.12,0-.14-.48-.18-.48-.2.1-.19.05-.3-.7-.12-.91-.11h-.16a.16.16,0,0,0,.14-.14c0-.07.05-.11,0-.2s-.17-.16-.31-.17a.84.84,0,0,0-.43.08.79.79,0,0,0,.07-.46c-.12-.5-.69-.14-1,0-.07,0-.09.16,0,.13a2,2,0,0,1,.64-.18c.27.05.06.44-.09.69l-.32.16a1.49,1.49,0,0,0-.68.44C324.56,258.22,324.88,258.33,325.2,258.16Zm.18-.52.25-.14a1.14,1.14,0,0,1-.42.45s-.36.13-.26,0A1,1,0,0,1,325.38,257.64Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 328.139px 258.285px 0px;"
                            id="ely1pj8ap2mfq" class="animable"></path><path
                            d="M332.31,262.15a.08.08,0,0,0,.05.07c.4.12.76-.34.89-.79.15,0,.45-.07.51.16l-.09.23c0,.05,0,.07.08.08.21,0,.89-.25.78.12a.07.07,0,0,0,0,.08c.18.12.57-.08.62.19,0,.12-.24.25-.09.43s.3,0,.43,0,.16-.12.24-.09,0,.09,0,.13.06.1.1.13.13,0,.2,0,.09-.08.14-.08a.83.83,0,0,1,.27.07s.38.17.34.11c.06.1-.17.28-.06.44s.69,0,.85,0,.14-.17,0-.16l-.4.05c-.34-.15-.25-.26-.19-.43s0-.1-.06-.1c-.23,0-.39-.21-.57-.21s-.24.11-.28.11c-.27,0-.14-.09-.14-.27a.07.07,0,0,0-.1-.06c-.16.05-.56.37-.57,0,0-.06.17-.16.18-.24s-.05-.22-.21-.26a1,1,0,0,0-.34.05c-.43.07-.07,0-.22-.11a.41.41,0,0,0-.4-.13.86.86,0,0,1-.27,0c-.24-.06-.08,0-.09-.15s.09-.19.05-.3-.19-.2-.38-.16a1.27,1.27,0,0,0-.37.13c0-.32-.06-.57-.36-.57-.08,0-.15.15-.05.17s.22.29.16.52C332.69,261.54,332.34,261.85,332.31,262.15Zm.38-.29a.89.89,0,0,1,.28-.27l-.05.11C332.88,261.76,332.61,262.09,332.69,261.86Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 334.996px 262.061px 0px;"
                            id="elr9lf2l4uu9a" class="animable"></path><path
                            d="M327.46,264.08a2.6,2.6,0,0,0,.84-.87.86.86,0,0,1,.37-.09c.49.07.08.25,0,.44s0,.11.09.1c.34-.05,1.15-.25.93.29a.07.07,0,0,0,0,.1c.1,0,.57.1.52.21s0,.11.06.1c.36,0,.72,0,1.07,0a3.46,3.46,0,0,1,.49.06c.11.13-.07.4-.12.49a.08.08,0,0,0,0,.12c.18.08.32.19.2.39a.08.08,0,0,0,0,.12c.46.12,1.28-.25,1.41.29.07.34,0,.42.44.38.07,0,.13-.15,0-.15-.44,0-.11-.5-.36-.68s-.85.16-1.13,0,0-.19-.11-.39-.16,0-.19-.08-.06-.07-.07-.07,0-.05,0-.12.06-.08.07-.14c.1-.51-.71-.38-1-.41a3.86,3.86,0,0,1-.6,0s0-.12,0-.14-.48-.18-.49-.2.11-.19.05-.29c-.13-.26-.7-.12-.9-.12l-.16,0a.18.18,0,0,0,.14-.15c0-.06,0-.1,0-.19s-.17-.17-.31-.18a.94.94,0,0,0-.43.08.69.69,0,0,0,.06-.46c-.12-.5-.68-.14-1,0-.07,0-.09.17,0,.14s.49-.22.65-.19.06.45-.09.69l-.33.17a1.44,1.44,0,0,0-.67.43C326.81,264.13,327.14,264.25,327.46,264.08Zm.18-.53.25-.13a1.24,1.24,0,0,1-.43.45s-.35.13-.25,0A1,1,0,0,1,327.64,263.55Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 330.357px 264.241px 0px;"
                            id="elxa91jed7xrj" class="animable"></path><path
                            d="M321.24,260.39a.08.08,0,0,0,.05.07c.39.12.76-.34.89-.79.14,0,.45-.06.51.16,0,0-.08.2-.09.24a.08.08,0,0,0,.08.07c.21,0,.89-.25.78.12a.1.1,0,0,0,0,.09c.18.12.56-.09.62.18s-.24.25-.1.43.31,0,.44,0,.16-.11.24-.08,0,.09,0,.13.06.1.1.12.13,0,.2,0,.09-.08.14-.08a2.13,2.13,0,0,1,.27.07s.37.18.34.11c.05.1-.18.28-.06.44s.69,0,.85,0,.14-.17,0-.17l-.4.05c-.34-.15-.25-.25-.19-.42s0-.11-.06-.11c-.23,0-.39-.21-.57-.21s-.24.11-.28.11c-.27,0-.14-.08-.15-.27a.06.06,0,0,0-.09-.06c-.16.06-.56.38-.57,0,0-.05.17-.16.18-.24s-.06-.22-.21-.25a1,1,0,0,0-.34,0c-.43.07-.07,0-.22-.11s-.16-.13-.4-.12a1.27,1.27,0,0,1-.27,0c-.24-.06-.08,0-.09-.15s.09-.18.05-.3-.19-.19-.39-.16a2.08,2.08,0,0,0-.37.13c0-.31-.05-.57-.35-.56-.08,0-.15.14-.05.16s.22.29.16.53C321.62,259.78,321.27,260.09,321.24,260.39Zm.38-.28a.89.89,0,0,1,.28-.28.36.36,0,0,1-.06.11C321.81,260,321.54,260.33,321.62,260.11Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 323.926px 260.285px 0px;"
                            id="elc2i7inph3r9" class="animable"></path><path
                            d="M337.39,251.43a2.76,2.76,0,0,0,.85-.88.69.69,0,0,1,.37-.08c.48.06.07.25,0,.43a.08.08,0,0,0,.09.11c.34-.06,1.15-.26.93.29a.08.08,0,0,0,.05.1c.1,0,.56.09.51.21a.08.08,0,0,0,.07.1,9.55,9.55,0,0,1,1.07,0,2.33,2.33,0,0,1,.48.06c.11.12-.06.4-.11.49a.08.08,0,0,0,0,.12c.18.08.32.19.2.38,0,0,0,.11,0,.12.45.13,1.27-.25,1.4.3.08.34,0,.41.45.38.07,0,.13-.15,0-.15-.44,0-.12-.51-.37-.68s-.85.16-1.12,0,0-.19-.12-.38-.15,0-.18-.08-.07-.07-.08-.07a.4.4,0,0,0,0-.13c0-.08.05-.08.06-.13.11-.51-.71-.39-1-.41a3.86,3.86,0,0,1-.6,0s0-.12,0-.14-.47-.18-.48-.2.1-.19.05-.3-.7-.12-.91-.11h-.16a.16.16,0,0,0,.14-.14c0-.07.05-.11,0-.19s-.17-.17-.31-.18a.86.86,0,0,0-.43.08.79.79,0,0,0,.07-.46c-.12-.5-.68-.14-1,0-.07,0-.09.16,0,.14a1.79,1.79,0,0,1,.64-.19c.27.05.07.45-.09.69l-.32.17a1.44,1.44,0,0,0-.68.43C336.75,251.48,337.07,251.59,337.39,251.43Zm.18-.53.25-.14a1.17,1.17,0,0,1-.42.46s-.36.12-.26,0A1,1,0,0,1,337.57,250.9Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 340.332px 251.6px 0px;"
                            id="elmo34aszqvr9" class="animable"></path><path
                            d="M344.51,255.41s0,.06,0,.07c.4.12.76-.34.9-.79.14,0,.45-.07.5.16a2,2,0,0,0-.08.23s0,.07.07.08c.21,0,.89-.25.78.12a.08.08,0,0,0,0,.09c.17.12.56-.09.61.18,0,.12-.24.25-.09.43s.3,0,.43,0,.16-.11.24-.08,0,.08.05.12.05.11.09.13.14,0,.2,0,.09-.08.14-.08a1.19,1.19,0,0,1,.27.07s.38.17.34.11c.06.1-.17.28-.06.44s.69,0,.85,0,.14-.17,0-.16l-.39.05c-.35-.15-.26-.25-.19-.43a.07.07,0,0,0-.07-.1c-.23,0-.39-.21-.56-.21a2.74,2.74,0,0,0-.28.11c-.28,0-.14-.09-.15-.27a.07.07,0,0,0-.1-.06c-.15.05-.56.38-.57,0,0,0,.17-.16.18-.24s-.05-.22-.21-.25a.78.78,0,0,0-.34,0c-.43.07-.07,0-.21-.11a.43.43,0,0,0-.41-.13.83.83,0,0,1-.27,0c-.23-.06-.08,0-.09-.15s.09-.18.05-.3-.19-.19-.38-.16a1.65,1.65,0,0,0-.37.13c0-.31-.06-.57-.36-.56-.08,0-.15.14,0,.16s.21.29.15.53C344.88,254.8,344.53,255.11,344.51,255.41Zm.37-.29a1,1,0,0,1,.28-.27l-.05.11C345.07,255,344.81,255.35,344.88,255.12Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 347.186px 255.305px 0px;"
                            id="elclpqwki8l2" class="animable"></path><path
                            d="M339.65,257.34a2.51,2.51,0,0,0,.84-.87.89.89,0,0,1,.37-.09c.49.07.08.25,0,.44a.08.08,0,0,0,.09.1c.34-.05,1.15-.25.93.3a.07.07,0,0,0,0,.09c.11,0,.57.1.52.21a.07.07,0,0,0,.07.1c.35,0,.71,0,1.06,0a3.28,3.28,0,0,1,.49.06c.11.13-.07.4-.12.49a.08.08,0,0,0,0,.12c.18.08.32.19.2.39a.08.08,0,0,0,0,.12c.46.12,1.28-.25,1.41.29.08.34,0,.42.44.38.08,0,.13-.15,0-.15-.44,0-.12-.5-.37-.68s-.85.16-1.13,0,.05-.19-.11-.39-.16,0-.18-.08-.07-.07-.08-.07a.22.22,0,0,0,0-.12c0-.09.06-.08.07-.14.11-.51-.71-.38-1-.41a6,6,0,0,1-.6,0s0-.13,0-.15-.48-.18-.49-.2.11-.18.06-.29-.7-.12-.91-.11h-.16s.13,0,.14-.14a.43.43,0,0,0,0-.2c0-.16-.17-.17-.31-.18a1,1,0,0,0-.43.08.77.77,0,0,0,.07-.46c-.12-.5-.69-.13-1,0-.07,0-.09.17,0,.14s.48-.22.64-.19.06.45-.09.69l-.32.17a1.47,1.47,0,0,0-.68.43C339,257.4,339.33,257.51,339.65,257.34Zm.18-.53.25-.13a1.21,1.21,0,0,1-.42.45s-.36.13-.26,0A1,1,0,0,1,339.83,256.81Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 342.545px 257.503px 0px;"
                            id="elq907jidmhvl" class="animable"></path><path
                            d="M333.43,253.65a.08.08,0,0,0,.05.07c.4.12.76-.33.89-.79.15,0,.46-.06.51.16,0,0-.08.2-.09.24a.08.08,0,0,0,.08.07c.21,0,.89-.25.78.13a.08.08,0,0,0,0,.08c.18.12.57-.09.62.18s-.24.25-.09.43.3,0,.43,0,.16-.11.24-.08,0,.09,0,.13.06.1.1.13.14,0,.2,0,.09-.08.14-.08a1.2,1.2,0,0,1,.27.08s.38.17.34.1c.06.1-.17.28-.06.44s.69,0,.85,0,.14-.17,0-.17l-.39.05c-.35-.15-.26-.25-.19-.42s0-.11-.07-.1c-.23,0-.39-.22-.56-.21a2.91,2.91,0,0,0-.28.1c-.28,0-.15-.08-.15-.27a.07.07,0,0,0-.1-.06c-.16.06-.56.38-.57,0,0-.05.17-.16.18-.23s-.05-.23-.21-.26a.78.78,0,0,0-.34.05c-.43.06-.07,0-.22-.12s-.16-.13-.4-.12a1.27,1.27,0,0,1-.27,0c-.23-.06-.08,0-.09-.15s.09-.18.05-.3-.19-.19-.38-.16a1.65,1.65,0,0,0-.37.13c0-.31-.06-.57-.36-.56-.08,0-.15.15-.05.16s.22.29.16.53C333.81,253,333.46,253.35,333.43,253.65Zm.38-.28a.9.9,0,0,1,.28-.27l0,.1C334,253.27,333.74,253.59,333.81,253.37Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 336.116px 253.575px 0px;"
                            id="elulpd7mrhx2c" class="animable"></path><path
                            d="M338.4,261.41a2.51,2.51,0,0,0,.84-.87.86.86,0,0,1,.37-.09c.48.07.08.25,0,.44a.08.08,0,0,0,.1.1c.34-.05,1.15-.25.93.3a.06.06,0,0,0,0,.09c.1,0,.57.1.51.21a.07.07,0,0,0,.07.1c.36,0,.71,0,1.07,0a3.46,3.46,0,0,1,.49.06c.1.13-.07.4-.12.49a.08.08,0,0,0,0,.12c.19.08.33.19.21.39a.08.08,0,0,0,0,.12c.46.12,1.28-.25,1.4.29.08.34,0,.42.45.38.07,0,.13-.15,0-.15-.44,0-.11-.5-.36-.68s-.86.16-1.13,0,0-.19-.11-.39-.16,0-.19-.08-.06-.07-.07-.07l0-.12c0-.09.05-.08.07-.14.1-.51-.71-.38-1.05-.41a6,6,0,0,1-.6,0s0-.13,0-.15-.48-.18-.49-.2.11-.18.05-.29-.7-.12-.91-.11h-.15s.13,0,.14-.14,0-.11,0-.2-.16-.17-.3-.18a.94.94,0,0,0-.43.08.69.69,0,0,0,.06-.46c-.12-.5-.68-.14-1,0-.07,0-.09.17,0,.14s.49-.22.64-.19.07.45-.08.69c-.12.06-.23.13-.33.17a1.44,1.44,0,0,0-.67.43C337.75,261.47,338.08,261.58,338.4,261.41Zm.18-.53.25-.13c-.12.16-.24.37-.43.45,0,0-.35.13-.25,0A.9.9,0,0,1,338.58,260.88Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 341.3px 261.571px 0px;"
                            id="el4eyox5mlmn" class="animable"></path><path
                            d="M333.24,258.09a.06.06,0,0,0,0,.07c.4.13.76-.33.9-.79.14,0,.45-.06.5.16a2.23,2.23,0,0,0-.08.24s0,.07.07.08c.21,0,.89-.26.78.12a.07.07,0,0,0,0,.08c.17.12.56-.08.61.19s-.24.24-.09.42.3,0,.43,0,.16-.11.24-.08,0,.09.05.13,0,.1.09.13a.45.45,0,0,0,.2,0c.05,0,.09-.07.14-.08a1.2,1.2,0,0,1,.27.08s.38.17.34.1c.06.1-.17.29-.06.44s.7,0,.85,0,.14-.17.05-.17l-.4.05c-.35-.15-.26-.25-.19-.42a.07.07,0,0,0-.07-.1c-.23,0-.39-.22-.56-.21a2.91,2.91,0,0,0-.28.1c-.28,0-.14-.08-.15-.27s-.06-.07-.1-.06-.56.38-.57,0c0,0,.17-.15.18-.23s0-.22-.21-.26a.78.78,0,0,0-.34,0c-.43.07-.07,0-.21-.12s-.17-.13-.41-.12a2.48,2.48,0,0,1-.27,0c-.23-.06-.08,0-.09-.16s.09-.18.05-.3-.19-.19-.38-.15a1.58,1.58,0,0,0-.37.12c0-.31-.06-.57-.36-.56-.08,0-.15.15,0,.16s.21.29.15.53C333.61,257.48,333.26,257.79,333.24,258.09Zm.37-.28a.9.9,0,0,1,.28-.27l-.05.1C333.8,257.71,333.54,258,333.61,257.81Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 335.912px 257.983px 0px;"
                            id="elx48t7k72m9f" class="animable"></path><path
                            d="M329.4,254.28a1.1,1.1,0,0,1,0,.48c0,.05,0,.07.08.08.21,0,.89-.25.78.12a.1.1,0,0,0,0,.09c.18.12.57-.09.62.18s-.24.25-.1.43.31,0,.44,0,.16-.11.24-.08,0,.08,0,.12.06.11.1.13.13,0,.2,0,.09-.08.14-.08a1.19,1.19,0,0,1,.27.07s.37.17.34.11c0,.1-.17.28-.06.44s.69,0,.85,0,.14-.17.05-.16l-.41.05c-.34-.15-.25-.25-.19-.43s0-.1-.06-.1c-.23,0-.39-.21-.57-.21s-.24.11-.28.11c-.27,0-.14-.09-.14-.27a.07.07,0,0,0-.1-.06c-.16.05-.56.38-.57,0,0-.05.17-.16.18-.24s-.06-.22-.21-.25a.78.78,0,0,0-.34,0c-.43.07-.07,0-.22-.11a.41.41,0,0,0-.4-.13.86.86,0,0,1-.27,0c-.24-.06-.08,0-.09-.15s.09-.19.05-.3-.32-.32-.38-.09a.14.14,0,0,0,0,.09A.36.36,0,0,0,329.4,254.28Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 331.381px 255.184px 0px;"
                            id="el5gtjlim36tt" class="animable"></path></g><g
                          id="freepik--Pencil--inject-3"
                          style="transform-origin: 307.99px 268.649px 0px;"
                          class="animable"><g
                            id="freepik--shadow--inject-3"><path
                              d="M321.85,275.68q-.48,1.31-2.79,1.62l-22-12.9-2.87-2.9a.22.22,0,0,1,.23-.36l5.27,1.74Z"
                              style="opacity: 0.2; transform-origin: 307.99px 269.214px 0px;"
                              class="animable"></path></g><path
                            d="M299.47,260.92l-4.69-.92a.15.15,0,0,0-.14.24l3.18,3.6Z"
                            style="fill: rgb(255, 168, 167); transform-origin: 297.039px 261.919px 0px;"
                            id="elkgmwb68tk69" class="animable"></path><path
                            d="M294.64,260.24a.15.15,0,0,1,.14-.24l.91.18h0a.8.8,0,0,0-.37.75V261Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 295.149px 260.499px 0px;"
                            id="elwwdms75b03d" class="animable"></path><path
                            d="M315.32,273.88l-.39-.23-.46-.26-16.65-9.55a2.14,2.14,0,0,1,.14-1.55,2.18,2.18,0,0,1,1.51-1.37l16.63,9.54.89.51C316.4,270.67,314.73,273.57,315.32,273.88Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 307.363px 267.4px 0px;"
                            id="el3n169501ubd" class="animable"></path><path
                            d="M313.85,273l-.85-.49c-.26-.14-.11-.76.19-1.4.39-.85,1.16-1.68,1.49-1.5l.63.36.23.13c-.34-.17-1.11.65-1.5,1.51-.28.61-.43,1.21-.21,1.37h0Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 314.203px 271.293px 0px;"
                            id="eleo653qeufdd" class="animable"></path><path
                            d="M313.64,272.92c-.59-.31,1.1-3.21,1.68-2.9l.86.49c-.58-.31-2.27,2.59-1.68,2.9Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 314.848px 271.703px 0px;"
                            id="elnnqayjuqbur" class="animable"></path><path
                            d="M315.32,273.88l-.85-.49c-.58-.3,1-3.11,1.63-2.93l0,0,.85.49C316.4,270.67,314.73,273.57,315.32,273.88Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 315.647px 272.166px 0px;"
                            id="elte7lc09ua2s" class="animable"></path><g
                            id="elyoalnxzardk"><path
                              d="M294.62,260.08l.16-.08,3.4,1.86,17.6,10.1s.06,0,.09,0c-.5.78-.88,1.76-.55,1.94l-.39-.23-.46-.26-16.65-9.55h0l-3.18-3.6A.16.16,0,0,1,294.62,260.08Z"
                              style="opacity: 0.15; transform-origin: 305.236px 266.95px 0px;"
                              class="animable"></path></g><path
                            d="M318.91,275.93l-3.59-2.05c-.25-.14-.12-.75.18-1.39.38-.86,1.15-1.69,1.49-1.52h0L320.6,273c.72.41.06,2-.74,2.66A.86.86,0,0,1,318.91,275.93Z"
                            style="fill: rgb(242, 143, 143); transform-origin: 318.048px 273.463px 0px;"
                            id="elft0bhm3uank" class="animable"></path><g
                            id="elghu6j041vt"><path
                              d="M318.7,274.82a2.6,2.6,0,0,1,1.47-1.78.59.59,0,0,1,.53.07c.54.51-.08,1.93-.84,2.59a.87.87,0,0,1-.93.24C318.66,275.78,318.56,275.37,318.7,274.82Z"
                              style="opacity: 0.1; transform-origin: 319.77px 274.497px 0px;"
                              class="animable"></path></g></g><g
                          id="freepik--Laptop--inject-3"
                          style="transform-origin: 268.851px 222.96px 0px;"
                          class="animable"><g id="el93tfp7a585q"><path
                              d="M224.75,227.47l33.64-19.42a1.92,1.92,0,0,1,1.94,0l58.36,33.7a.42.42,0,0,1,0,.74l-34,19.61Z"
                              style="opacity: 0.2; transform-origin: 271.831px 234.943px 0px;"
                              class="animable"></path></g><path
                            d="M227.26,223.38v.75a3.1,3.1,0,0,0,1.55,2.69l54.37,31.39a3.15,3.15,0,0,0,3.11,0l29.64-17.06a3.11,3.11,0,0,0,1.55-2.69v-1h0a.38.38,0,0,1-.2.34l-32.54,18.79Z"
                            style="fill: rgb(55, 71, 79); transform-origin: 272.37px 241px 0px;"
                            id="elb38bniyac8p" class="animable"></path><path
                            d="M227.26,223.37l32.23-18.61a1.87,1.87,0,0,1,1.86,0l55.92,32.3a.41.41,0,0,1,0,.71l-32.54,18.79Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 272.367px 230.536px 0px;"
                            id="elgfl878td55i" class="animable"></path><polygon
                            points="285.03 253.82 302.42 243.79 251.58 214.44 234.1 224.42 285.03 253.82"
                            style="fill: rgb(55, 71, 79); transform-origin: 268.26px 234.13px 0px;"
                            id="el305kdcpuxd4"
                            class="animable"></polygon><polygon
                            points="234.1 224.42 234.76 224.8 251.58 215.21 301.75 244.18 302.41 243.79 251.58 214.44 234.1 224.42"
                            style="fill: rgb(186, 104, 200); transform-origin: 268.255px 229.31px 0px;"
                            id="eleo1du0hfcuq"
                            class="animable"></polygon><polygon
                            points="234.1 224.42 234.76 224.8 251.58 215.21 301.75 244.18 302.41 243.79 251.58 214.44 234.1 224.42"
                            style="fill: rgb(38, 50, 56); transform-origin: 268.255px 229.31px 0px;"
                            id="eloajncfcfke"
                            class="animable"></polygon><polygon
                            points="293.57 225.93 293.25 226.11 284.73 231.03 269.58 222.28 269.26 222.1 278.1 217 293.57 225.93"
                            style="fill: rgb(38, 50, 56); transform-origin: 281.415px 224.015px 0px;"
                            id="elhak6qknc4yv"
                            class="animable"></polygon><polygon
                            points="293.25 226.11 284.73 231.03 269.58 222.28 278.1 217.36 293.25 226.11"
                            style="fill: rgb(55, 71, 79); transform-origin: 281.415px 224.195px 0px;"
                            id="eluj8993t7g3i" class="animable"></polygon><path
                            d="M284.73,256.56v2.06a3.08,3.08,0,0,1-1.55-.41l-54.37-31.39a3.1,3.1,0,0,1-1.55-2.69v-.76Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 255.995px 240.995px 0px;"
                            id="elqfuev34b0b" class="animable"></path><path
                            d="M284.73,256.56v2.06a3.08,3.08,0,0,1-1.55-.41l-54.37-31.39a3.1,3.1,0,0,1-1.55-2.69v-.76Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 255.995px 240.995px 0px;"
                            id="ela50ydbexel7" class="animable"></path><path
                            d="M283.86,257a3.71,3.71,0,0,1-3.18-.25l-54.12-31.25a3.64,3.64,0,0,1-1.79-2.57l-5.93-35.34a4.07,4.07,0,0,1-.05-.61,3.66,3.66,0,0,1,1.09-2.61l56.25,32.48a2.71,2.71,0,0,1,1.32,1.9Z"
                            style="fill: rgb(55, 71, 79); transform-origin: 251.325px 220.808px 0px;"
                            id="elxffb628xzm" class="animable"></path><path
                            d="M284.73,256.56l-.37.21-.5.25-6.41-38.25a2.71,2.71,0,0,0-1.32-1.9l-56.25-32.48a3.53,3.53,0,0,1,.75-.57L277,216.36a2.71,2.71,0,0,1,1.33,1.9Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 252.305px 220.42px 0px;"
                            id="elmymlh730kzr" class="animable"></path><path
                            d="M276.93,217.59l.87-.51a2.85,2.85,0,0,1,.52,1.18l6.41,38.3-.37.21-.5.25-6.41-38.25A2.63,2.63,0,0,0,276.93,217.59Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 280.83px 237.05px 0px;"
                            id="el59ioede9zne" class="animable"></path><path
                            d="M253.37,224.39c-.4-2.36-2.84-5.5-5.45-7s-4.42-.81-4,1.55,2.84,5.51,5.45,7S253.77,226.76,253.37,224.39Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 248.643px 221.664px 0px;"
                            id="el4swlye2p3fv" class="animable"></path></g><g
                          id="freepik--Coffee--inject-3"
                          style="transform-origin: 338.996px 299.063px 0px;"
                          class="animable"><g
                            id="freepik--shadow--inject-3"><path
                              d="M345.67,306.83c3.79,2.1,3.79,5.5,0,7.6a15.75,15.75,0,0,1-13.73,0c-3.79-2.1-3.79-5.5,0-7.6A15.75,15.75,0,0,1,345.67,306.83Z"
                              style="opacity: 0.1; transform-origin: 338.805px 310.63px 0px;"
                              class="animable"></path></g><g
                            id="freepik--coffee--inject-3"
                            style="transform-origin: 339.047px 298.036px 0px;"
                            class="animable"><path
                              d="M332.92,294.41a20,20,0,0,1,12.08.31c3.25,1.33,3.2,3.36-.12,4.52a19.88,19.88,0,0,1-12.08-.31C329.44,297.6,329.49,295.57,332.92,294.41Z"
                              style="fill: rgb(38, 50, 56); transform-origin: 338.859px 296.828px 0px;"
                              id="elujgjvh547tb" class="animable"></path><path
                              d="M330.32,290.23l17.41.46-1.85,20.48h0c-.1.74-.82,1.46-2.16,2a15.46,15.46,0,0,1-10.45-.27c-1.36-.61-2.06-1.36-2.12-2.11h0Z"
                              style="fill: rgb(250, 250, 250); transform-origin: 339.025px 302.09px 0px;"
                              id="elj0khboalyn" class="animable"></path><path
                              d="M347.73,290.69l-.38,4.16a7.45,7.45,0,0,1-1.47.74,21.1,21.1,0,0,1-13.87-.35l-.46-.23a9.16,9.16,0,0,1-1.07-.64l-.16-4.14Z"
                              style="fill: rgb(235, 235, 235); transform-origin: 339.025px 293.412px 0px;"
                              id="eluwyvkfutns" class="animable"></path><path
                              d="M329.2,290.8l.08-3.13,2,.05c.28-.14.58-.26.9-.39a21.25,21.25,0,0,1,13.87.36c.31.14.58.29.84.43l2,.05-.08,3.14h0c0,1-1,2-2.89,2.75a21.16,21.16,0,0,1-13.87-.36C330.12,292.87,329.18,291.82,329.2,290.8Z"
                              style="fill: rgb(55, 71, 79); transform-origin: 339.045px 290.698px 0px;"
                              id="el8p55rw30fvu" class="animable"></path><path
                              d="M332.28,284.92a21.09,21.09,0,0,1,13.86.36c3.73,1.66,3.66,4.18-.14,5.64a21.1,21.1,0,0,1-13.87-.35C328.28,288.91,328.34,286.38,332.28,284.92Z"
                              style="fill: rgb(69, 90, 100); transform-origin: 339.089px 287.923px 0px;"
                              id="eluel9m8y34rk" class="animable"></path><path
                              d="M331.11,287h0l.69-2.57,5,.13a20.47,20.47,0,0,1,5,.13l4.84.12.56,2.6h0c.29.95-.48,1.92-2.32,2.59a18.19,18.19,0,0,1-11.43-.29C331.5,288.9,330.76,287.89,331.11,287Z"
                              style="fill: rgb(55, 71, 79); transform-origin: 339.143px 287.606px 0px;"
                              id="eltakl0642ala" class="animable"></path><path
                              d="M334,282.8a17.45,17.45,0,0,1,10.49.27c2.82,1.14,2.78,2.88-.1,3.88a17.52,17.52,0,0,1-10.5-.27C331,285.53,331,283.79,334,282.8Z"
                              style="fill: rgb(69, 90, 100); transform-origin: 339.157px 284.874px 0px;"
                              id="el36zlos6bjtm" class="animable"></path><path
                              d="M332.77,284.71s.07.18.31.37a5.07,5.07,0,0,0,1.2.65,15.4,15.4,0,0,0,4.91.87,14.72,14.72,0,0,0,4.88-.61,4.17,4.17,0,0,0,1.18-.59c.25-.19.32-.33.32-.37s-.24-.53-1.45-1a14.46,14.46,0,0,0-4.84-.86,15.11,15.11,0,0,0-4.95.61C333.09,284.18,332.77,284.62,332.77,284.71Z"
                              style="fill: rgb(38, 50, 56); transform-origin: 339.17px 284.885px 0px;"
                              id="elswdly2cmkq" class="animable"></path><path
                              d="M333.08,285.08a5.07,5.07,0,0,0,1.2.65,15.4,15.4,0,0,0,4.91.87,14.72,14.72,0,0,0,4.88-.61,4.17,4.17,0,0,0,1.18-.59,4.33,4.33,0,0,0-1.15-.65,14.46,14.46,0,0,0-4.84-.86,15.11,15.11,0,0,0-4.95.61A5.09,5.09,0,0,0,333.08,285.08Z"
                              style="fill: rgb(55, 71, 79); transform-origin: 339.165px 285.245px 0px;"
                              id="elocso1n5e6f" class="animable"></path><g
                              id="els9tfx6uxd7o"><g
                                style="opacity: 0.5; transform-origin: 335.613px 285.44px 0px;"
                                class="animable"><path
                                  d="M336,285.23a1.47,1.47,0,0,0-1.17-.25c-.21.11-.05.41.38.67a1.45,1.45,0,0,0,1.16.25C336.62,285.78,336.46,285.48,336,285.23Z"
                                  id="el59s7uon232w"
                                  style="transform-origin: 335.613px 285.44px 0px;"
                                  class="animable"></path></g></g><path
                              d="M346.71,304.56c0,.77-.81,1.52-2.37,2.07a18.76,18.76,0,0,1-11.38-.29c-1.58-.63-2.36-1.42-2.35-2.19l-.3-7.55c0,.82.81,1.66,2.49,2.33a19.88,19.88,0,0,0,12.08.31c1.66-.58,2.5-1.38,2.52-2.19Z"
                              style="fill: rgb(69, 90, 100); transform-origin: 338.855px 301.988px 0px;"
                              id="elluieakeer7f" class="animable"></path><path
                              d="M341.39,304.87a10.42,10.42,0,0,0,.71-1.26,3.82,3.82,0,0,1,2-1.69.25.25,0,0,1,.31.12,3,3,0,0,1-3.77,3.62s-.06-.12,0-.14A2.58,2.58,0,0,0,341.39,304.87Z"
                              style="fill: rgb(186, 104, 200); transform-origin: 342.559px 303.846px 0px;"
                              id="elnxmexrsg75" class="animable"></path><path
                              d="M343.65,301.67a4.16,4.16,0,0,0-1.26.73,3.67,3.67,0,0,0-.93,1.21,3.7,3.7,0,0,1-1.17,1.47A.25.25,0,0,1,340,305a2.6,2.6,0,0,1,.69-3.16,2.67,2.67,0,0,1,3.05-.62A.24.24,0,0,1,343.65,301.67Z"
                              style="fill: rgb(186, 104, 200); transform-origin: 341.8px 303.042px 0px;"
                              id="el7eaq73mazq7"
                              class="animable"></path></g></g></g></g><g
                      id="freepik--Plant--inject-3"
                      style="transform-origin: 367.065px 400.806px 0px;"
                      class="animable"><g id="freepik--pot--inject-3"
                        style="transform-origin: 367.065px 400.806px 0px;"
                        class="animable"><path
                          d="M352.38,439.66c-7.06-7.29-11.21-37-4.32-42.74h35.06c6.89,5.78,2.74,35.44-4.32,42.73l-.19.2a2.83,2.83,0,0,1-.25.24c-.19.2-.41.39-.63.58l-.17.13c-.18.14-.35.28-.54.41a8.28,8.28,0,0,1-.91.59c-5.81,3.39-15.23,3.39-21,0h0a10.2,10.2,0,0,1-.92-.59l-.5-.38-.21-.17c-.22-.18-.42-.37-.61-.55l-.28-.28Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 365.59px 420.631px 0px;"
                          id="el028rkhuf6frr" class="animable"></path><g
                          id="el2sqs5pvbx7i"><g
                            style="opacity: 0.65; transform-origin: 365.59px 420.631px 0px;"
                            class="animable"><path
                              d="M352.38,439.66c-7.06-7.29-11.21-37-4.32-42.74h35.06c6.89,5.78,2.74,35.44-4.32,42.73l-.19.2a2.83,2.83,0,0,1-.25.24c-.19.2-.41.39-.63.58l-.17.13c-.18.14-.35.28-.54.41a8.28,8.28,0,0,1-.91.59c-5.81,3.39-15.23,3.39-21,0h0a10.2,10.2,0,0,1-.92-.59l-.5-.38-.21-.17c-.22-.18-.42-.37-.61-.55l-.28-.28Z"
                              style="fill: rgb(255, 255, 255); transform-origin: 365.59px 420.631px 0px;"
                              id="elj3idnx0qk2m"
                              class="animable"></path></g></g><path
                          d="M380.07,394.6c8,4.67,8,12.24,0,16.91s-21,4.67-29,0-8-12.24,0-16.91S372.07,389.93,380.07,394.6Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 365.57px 403.055px 0px;"
                          id="el0q1poqbgz32" class="animable"></path><g
                          id="el06lmzxdl4xp2"><g
                            style="opacity: 0.8; transform-origin: 365.57px 403.055px 0px;"
                            class="animable"><path
                              d="M380.07,394.6c8,4.67,8,12.24,0,16.91s-21,4.67-29,0-8-12.24,0-16.91S372.07,389.93,380.07,394.6Z"
                              style="fill: rgb(255, 255, 255); transform-origin: 365.57px 403.055px 0px;"
                              id="elwuqrixiz2v"
                              class="animable"></path></g></g><path
                          d="M376.23,396.84c5.87,3.43,5.87,9,0,12.42s-15.4,3.43-21.28,0-5.87-9,0-12.42S370.35,393.41,376.23,396.84Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 365.588px 403.05px 0px;"
                          id="elnpv8drs07a" class="animable"></path><g
                          id="ellqyxgk2p9ls"><g
                            style="opacity: 0.3; transform-origin: 365.588px 403.05px 0px;"
                            class="animable"><path
                              d="M376.23,396.84c5.87,3.43,5.87,9,0,12.42s-15.4,3.43-21.28,0-5.87-9,0-12.42S370.35,393.41,376.23,396.84Z"
                              id="elvntbj9iqeb"
                              style="transform-origin: 365.588px 403.05px 0px;"
                              class="animable"></path></g></g><path
                          d="M355,402.74c5.88-3.43,15.4-3.43,21.28,0a9.71,9.71,0,0,1,3.51,3.26,9.71,9.71,0,0,1-3.51,3.26c-5.88,3.43-15.4,3.43-21.28,0a9.83,9.83,0,0,1-3.52-3.26A9.83,9.83,0,0,1,355,402.74Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 365.635px 406px 0px;"
                          id="el696exmax51n" class="animable"></path><g
                          id="freepik--Plants--inject-3"
                          style="transform-origin: 367.065px 383.095px 0px;"
                          class="animable"><path
                            d="M362.72,387.77a10.22,10.22,0,0,1-.9-2.56,6,6,0,0,1,1.87-5.9c.69-.52,1.58-.91,1.88-1.72a2.73,2.73,0,0,0,0-1.42c-.32-1.82-.93-3.7-.43-5.48a6.16,6.16,0,0,1,3.4-3.64,18.7,18.7,0,0,1,5-1.3,7.67,7.67,0,0,0,2.62-.75c1-.54,1.28-1.51,1.89-2.36a16.28,16.28,0,0,1,2.41-2.57,9.38,9.38,0,0,1,6.49-2.8c5.16.23,5,4.67,3.52,8s-1.88,4.46,1.34,8,3.23,7.83-.61,10.25-6.35,2.73-4.83,7.39c1.36,4.16,2.2,7.71-1.64,12.15a12.56,12.56,0,0,1-10.13,4.75,16.82,16.82,0,0,1-5-1.16c-1.17-.58-.38-1.49-.78-2.64l-2.55-7.44a52.57,52.57,0,0,0-2-5.86C363.77,389.68,363.2,388.74,362.72,387.77Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 377.906px 382.542px 0px;"
                            id="elcvjwbza68vs" class="animable"></path><g
                            id="el42hswelx5r3"><g
                              style="opacity: 0.15; transform-origin: 377.906px 382.542px 0px;"
                              class="animable"><path
                                d="M362.72,387.77a10.22,10.22,0,0,1-.9-2.56,6,6,0,0,1,1.87-5.9c.69-.52,1.58-.91,1.88-1.72a2.73,2.73,0,0,0,0-1.42c-.32-1.82-.93-3.7-.43-5.48a6.16,6.16,0,0,1,3.4-3.64,18.7,18.7,0,0,1,5-1.3,7.67,7.67,0,0,0,2.62-.75c1-.54,1.28-1.51,1.89-2.36a16.28,16.28,0,0,1,2.41-2.57,9.38,9.38,0,0,1,6.49-2.8c5.16.23,5,4.67,3.52,8s-1.88,4.46,1.34,8,3.23,7.83-.61,10.25-6.35,2.73-4.83,7.39c1.36,4.16,2.2,7.71-1.64,12.15a12.56,12.56,0,0,1-10.13,4.75,16.82,16.82,0,0,1-5-1.16c-1.17-.58-.38-1.49-.78-2.64l-2.55-7.44a52.57,52.57,0,0,0-2-5.86C363.77,389.68,363.2,388.74,362.72,387.77Z"
                                id="elz6k232o6ew9"
                                style="transform-origin: 377.906px 382.542px 0px;"
                                class="animable"></path></g></g><path
                            d="M369.73,406.62a.38.38,0,0,0,.25-.37c-.21-25.47,13.82-40.67,14-40.82a.4.4,0,0,0,0-.55.37.37,0,0,0-.53,0c-.15.15-14.4,15.56-14.18,41.36a.4.4,0,0,0,.39.38Z"
                            style="fill: rgb(255, 255, 255); transform-origin: 376.679px 385.694px 0px;"
                            id="elyv8krbbxmj" class="animable"></path><path
                            d="M373.81,382.93a.2.2,0,0,0,.08,0c4.57-2.87,12.72-5,12.8-5a.38.38,0,0,0-.19-.74c-.34.08-8.34,2.19-13,5.13a.38.38,0,0,0,.32.69Z"
                            style="fill: rgb(255, 255, 255); transform-origin: 380.128px 380.112px 0px;"
                            id="ele5ccs4ube4d" class="animable"></path><path
                            d="M375.23,379.44h0a.39.39,0,0,0,.2-.5,29.81,29.81,0,0,0-4.21-7.09.38.38,0,0,0-.58.5,29,29,0,0,1,4.09,6.88A.39.39,0,0,0,375.23,379.44Z"
                            style="fill: rgb(255, 255, 255); transform-origin: 373.003px 375.592px 0px;"
                            id="el6vm4vghl91y" class="animable"></path><path
                            d="M367.14,408.5l-.33.11c-1.85.53-3.89.22-5.78.21a21.82,21.82,0,0,1-6.43-1.29,11.64,11.64,0,0,1-5.56-3.76,7,7,0,0,1-1.21-6.42,7,7,0,0,0,.76-2.54,3.13,3.13,0,0,0-1.4-2.26,16,16,0,0,0-2.44-1.25,8.44,8.44,0,0,1-3.28-2.53,4.67,4.67,0,0,1-.9-3.62c.26-1.15,1.21-2,1.48-3.17.42-1.88-.91-3-1.39-4.68-.39-1.34-.93-3.15-.57-4.52.51-1.93,2.64-3,4.61-3.22a11.57,11.57,0,0,1,7.59,2c2.19,1.59,3.92,3.6,6.82,3.84,1.34.11,2.72-.21,4,.09a5.78,5.78,0,0,1,3.9,3.8,13.42,13.42,0,0,1,.48,5.61,6.24,6.24,0,0,0,.4,3.69c.7,1.19,2.13,1.71,3.28,2.48,2.57,1.71,3.56,4.77,3.43,7.74-.13,3.13-2.84,6.3-5.17,8.12A10.92,10.92,0,0,1,367.14,408.5Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 357.292px 389.217px 0px;"
                            id="elmh4i3scbr5g" class="animable"></path><path
                            d="M367,408.81a.36.36,0,0,1-.23-.32c-1-12.15-14.57-31.14-20.59-34.95a.37.37,0,0,1,.39-.63c6.11,3.88,19.94,23.18,20.92,35.53a.35.35,0,0,1-.33.39A.29.29,0,0,1,367,408.81Z"
                            style="fill: rgb(255, 255, 255); transform-origin: 356.748px 390.844px 0px;"
                            id="el1xj7mpt36xn" class="animable"></path><path
                            d="M358.56,388a.33.33,0,0,1-.19-.06c-3.36-2-8.7-1.91-11.28-1.36a.37.37,0,0,1-.45-.28.39.39,0,0,1,.29-.45c2.69-.58,8.29-.7,11.82,1.45a.38.38,0,0,1-.19.7Z"
                            style="fill: rgb(255, 255, 255); transform-origin: 352.779px 386.743px 0px;"
                            id="eluv5svekjzwj" class="animable"></path><path
                            d="M360.94,391.78a.37.37,0,0,1-.37-.3,20.76,20.76,0,0,1,1.88-10.18.37.37,0,1,1,.65.36,20.22,20.22,0,0,0-1.8,9.67.38.38,0,0,1-.29.44Z"
                            style="fill: rgb(255, 255, 255); transform-origin: 361.833px 386.444px 0px;"
                            id="elskcg3wmv83e"
                            class="animable"></path></g></g></g><g
                      id="freepik--character-1--inject-3"
                      style="transform-origin: 111.596px 249.991px 0px;"
                      class="animable"><g id="freepik--character--inject-3"
                        style="transform-origin: 111.596px 249.991px 0px;"
                        class="animable"><g id="freepik--chair--inject-3"
                          style="transform-origin: 100.843px 271.278px 0px;"
                          class="animable"><path
                            d="M99.35,370.56a1.33,1.33,0,0,1-1.3-1.36V281.85a1.31,1.31,0,1,1,2.61,0V369.2A1.33,1.33,0,0,1,99.35,370.56Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 99.355px 325.493px 0px;"
                            id="elh5jmyzi630c" class="animable"></path><path
                            d="M151.21,338.76a1.29,1.29,0,0,1-1.21-.86l-25.7-67.79a1.38,1.38,0,0,1,.73-1.77,1.28,1.28,0,0,1,1.69.77l25.7,67.8a1.37,1.37,0,0,1-.73,1.76A1.36,1.36,0,0,1,151.21,338.76Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 138.36px 303.503px 0px;"
                            id="elw94pzsnnegc" class="animable"></path><path
                            d="M148.12,330.62a1.24,1.24,0,0,1-.94-.43L99.35,277.45,51.62,330a1.27,1.27,0,0,1-1.85,0,1.41,1.41,0,0,1-.05-1.92l48.69-53.56a1.27,1.27,0,0,1,.94-.42h0a1.27,1.27,0,0,1,.94.42l48.77,53.79a1.4,1.4,0,0,1,0,1.92A1.26,1.26,0,0,1,148.12,330.62Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 99.404px 302.36px 0px;"
                            id="el47lbp6lh8w2" class="animable"></path><path
                            d="M47.5,338.76a1.36,1.36,0,0,1-.48-.09,1.37,1.37,0,0,1-.73-1.76L72,269.11a1.28,1.28,0,0,1,1.69-.77,1.38,1.38,0,0,1,.73,1.77L48.71,337.9A1.29,1.29,0,0,1,47.5,338.76Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 60.3553px 303.503px 0px;"
                            id="elrzr8knfs3u" class="animable"></path><path
                            d="M149.44,328.53l3.4,9.34a1,1,0,0,1,0,.24v.17a1.08,1.08,0,0,1-.51.59,2.23,2.23,0,0,1-2.07,0,.91.91,0,0,1-.4-.44v0l0-.12-3.16-8.77Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 149.774px 333.827px 0px;"
                            id="el3pb1kehfobj" class="animable"></path><path
                            d="M49.27,328.53l-3.4,9.34a1,1,0,0,0,0,.24v.17a1.08,1.08,0,0,0,.51.59,2.23,2.23,0,0,0,2.07,0,.91.91,0,0,0,.4-.44v0l0-.12L52,329.52Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 48.9314px 333.827px 0px;"
                            id="elv1105vtrblf" class="animable"></path><path
                            d="M100.86,362.44v7.73a.79.79,0,0,1-.44.64,2.29,2.29,0,0,1-2.13,0,.79.79,0,0,1-.44-.64v-7.73A3,3,0,0,1,100.86,362.44Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 99.355px 366.554px 0px;"
                            id="elakyltnlk8d" class="animable"></path><path
                            d="M159.73,269.19c0-2.44-2-5-6.37-7.95-8-5.41-31.25-18.94-42.43-25.39a.12.12,0,0,0-.09-.1c-8.61-5.44-11.22-28.67-17.18-48.36-2-6.71-4.51-10.51-7.46-12.3-.7-.42-3.28-1.9-3.85-2.26-5.84-3.65-13.51.74-23.07,6.18-8.79,5-15.67,11.45-17.05,28.5-.84,10.38,0,30.22,2,45.25h0c2.92,25.11,6.52,25.16,11.74,29.36,9,7.23,29.21,17.4,37.74,20.9,15.47,6.34,28.1-3.44,37.52-8.29a218.51,218.51,0,0,0,25-15.41c2.35-1.78,3.57-3.59,3.55-5.49C159.72,273.06,159.73,270,159.73,269.19Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 100.843px 238.291px 0px;"
                            id="el5ubg4jnqi5p" class="animable"></path><g
                            id="eljylafagacld"><path
                              d="M159.73,269.19c0-2.44-2-5-6.37-7.95-8-5.41-31.25-18.94-42.43-25.39a.12.12,0,0,0-.09-.1c-8.61-5.44-11.22-28.67-17.18-48.36-2-6.71-4.51-10.51-7.46-12.3-.7-.42-3.28-1.9-3.85-2.26-5.84-3.65-13.51.74-23.07,6.18-8.79,5-15.67,11.45-17.05,28.5-.84,10.38,0,30.22,2,45.25h0c2.92,25.11,6.52,25.16,11.74,29.36,9,7.23,29.21,17.4,37.74,20.9,15.47,6.34,28.1-3.44,37.52-8.29a218.51,218.51,0,0,0,25-15.41c2.35-1.78,3.57-3.59,3.55-5.49C159.72,273.06,159.73,270,159.73,269.19Z"
                              style="opacity: 0.2; transform-origin: 100.843px 238.291px 0px;"
                              class="animable"></path></g><path
                            d="M131.21,290.05a218.51,218.51,0,0,0,25-15.41c5.36-4.06,4.86-8.21-2.82-13.4-10.67-7.22-48.57-28.93-48.57-28.93s-55,33.83-52.63,40.07S83,293.94,93.69,298.33C109.16,304.67,121.79,294.9,131.21,290.05Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 105.943px 266.357px 0px;"
                            id="elwrwpu593n6" class="animable"></path><g
                            id="el1c533ay1rmc"><g
                              style="opacity: 0.05; transform-origin: 105.943px 266.357px 0px;"
                              class="animable"><path
                                d="M131.21,290.05a218.51,218.51,0,0,0,25-15.41c5.36-4.06,4.86-8.21-2.82-13.4-10.67-7.22-48.57-28.93-48.57-28.93s-55,33.83-52.63,40.07S83,293.94,93.69,298.33C109.16,304.67,121.79,294.9,131.21,290.05Z"
                                id="ela2mkzl7p05"
                                style="transform-origin: 105.943px 266.357px 0px;"
                                class="animable"></path></g></g><path
                            d="M85.86,174.89c-5.79-3.17-13.31,1.14-22.62,6.45-6,3.41-11,7.44-14.13,15L45.19,194c3.08-7.52,8.15-11.56,14.09-15,9.56-5.45,17.22-9.82,23.07-6.18C82.86,173.14,84.89,174.32,85.86,174.89Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 65.525px 183.912px 0px;"
                            id="elw0qu7795sdh" class="animable"></path><g
                            id="el8kg11816gq9"><path
                              d="M85.86,174.89c-5.79-3.17-13.31,1.14-22.62,6.45-6,3.41-11,7.44-14.13,15L45.19,194c3.08-7.52,8.15-11.56,14.09-15,9.56-5.45,17.22-9.82,23.07-6.18C82.86,173.14,84.89,174.32,85.86,174.89Z"
                              style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 65.525px 183.912px 0px;"
                              class="animable"></path></g><path
                            d="M63.24,181.34c14.29-8.15,24.38-14,30.42,6,6,19.69,8.57,42.92,17.18,48.36,0,0,2.62.23-18.78,17.08C85.25,258.19,77,262.59,71.56,266c-10.63,6.6-17.08,9.25-18.1,8.37-5.62-4.86-8.66-47.44-7.28-64.49S54.44,186.36,63.24,181.34Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 78.3954px 224.159px 0px;"
                            id="elce05h99b9z" class="animable"></path></g><g
                          id="freepik--character--inject-3"
                          style="transform-origin: 111.596px 249.991px 0px;"
                          class="animable"><path
                            d="M169.81,328.36s2.39,9.48,4.93,14.06a70.7,70.7,0,0,0,9,13.05c.8.89,2.61,2.54,3.27,3.27a1.42,1.42,0,0,1-.11,2.18c-1.58,1.56-8.36,2.05-12.21-.74s-7.69-8.14-10-10.39c-1.15-1.13-2.24-2.21-3-3a3,3,0,0,1-.82-2.91c.07-.3.15-.65.24-1.06.49-2.2-2.57-11.14-2.57-11.14Z"
                            style="fill: rgb(177, 102, 104); transform-origin: 173.004px 345.271px 0px;"
                            id="el8qr83tfzot8" class="animable"></path><path
                            d="M88.12,224.92c-1.42,8-1.86,12.5.95,20.56s9.18,21.38,20.45,27.69c9.32,5.22,22,12,24.66,13.53,3,1.72,4.18,3.31,5.18,7.41,1.25,5.13,2.75,11,8.46,21.85,7,13.34,10,19.86,10,19.86,3.85.25,11.41-2,13.58-3.88,0,0-13.72-52.88-16.18-59.72s-20.29-16.9-27.94-21.31-11.92-7.16-20.65-13.07Z"
                            style="fill: rgb(55, 71, 79); transform-origin: 129.201px 280.38px 0px;"
                            id="eloluidr5uwbp" class="animable"></path><path
                            d="M107.71,247.3a63.28,63.28,0,0,1-5.53,9.45l1.61,1.35S107.71,252.7,107.71,247.3Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 104.945px 252.7px 0px;"
                            id="elcaqp6w4ddvv" class="animable"></path><path
                            d="M143.51,340.87s2.89,13,5.16,16.11c2.93,4,5.32,8.95,9,13,.8.89,2.62,2.55,3.27,3.27a1.41,1.41,0,0,1-.11,2.18c-1.57,1.56-8.35,2-12.21-.73s-7.68-8.15-10-10.4c-1.16-1.13-2.24-2.21-3-3a3.09,3.09,0,0,1-.81-2.92q.1-.44.24-1.05c.48-2.2-2.57-11.15-2.57-11.15Z"
                            style="fill: rgb(177, 102, 104); transform-origin: 146.942px 358.773px 0px;"
                            id="el7wrx9g0oddg" class="animable"></path><path
                            d="M134,364.61c0,1.68.17,2.56.44,2.82a23.26,23.26,0,0,0,4.92,2.31c.85.08,1-.5,1.73.5s2.08,3.42,3.92,5.61a11.66,11.66,0,0,0,6.67,3.76,21.38,21.38,0,0,0,10.72-.52c3.89-1.23,4.71-2.81,4.59-4.27S134,364.61,134,364.61Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 150.5px 372.334px 0px;"
                            id="elpll8k7yaffd" class="animable"></path><path
                            d="M134.29,352.38c-.29.11-.44.4-.48.84s.1,1,.13,1.82a19.19,19.19,0,0,1-.38,4.66,8.7,8.7,0,0,0,.42,4.91c1.45,1.09,3,1.47,4.66,2.3,4.8,2.43,5.12,6.22,8.28,8.78a12.07,12.07,0,0,0,6.87,2.8,28.06,28.06,0,0,0,8-.55c1.76-.45,6.47-2.34,5.35-4.95a3.51,3.51,0,0,0-1.46-1.42A78.69,78.69,0,0,1,159,367a56.77,56.77,0,0,1-7.14-7.07,25.37,25.37,0,0,1-4.38-6.91,1.4,1.4,0,0,0-.39-.61,1.28,1.28,0,0,0-1-.09,33.29,33.29,0,0,0-4.41,1.17,2.77,2.77,0,0,0-1.2.66,2.82,2.82,0,0,0-.45,2.21c0,.43,0,1-.4,1.15s-.78-.2-1-.56c-.37-.68-.46-1.54-1.06-2a4,4,0,0,0-1.42-.71,7.45,7.45,0,0,0-1.47-.31C134.57,353.55,134.31,352.44,134.29,352.38Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 150.347px 365.413px 0px;"
                            id="elgwzkcrh9roe" class="animable"></path><path
                            d="M160.05,350.19c0,1.68.17,2.56.44,2.83a23.77,23.77,0,0,0,4.92,2.31c.85.07,1-.5,1.73.5s2.07,3.41,3.92,5.6a11.67,11.67,0,0,0,6.67,3.77,21.4,21.4,0,0,0,10.72-.53c3.88-1.23,4.71-2.8,4.59-4.27S160.05,350.19,160.05,350.19Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 176.55px 357.917px 0px;"
                            id="elgmgefi0twg" class="animable"></path><path
                            d="M160.41,338a.82.82,0,0,0-.53.77c0,.46.1,1.05.13,1.82a19.19,19.19,0,0,1-.39,4.66,8.62,8.62,0,0,0,.43,4.91c1.44,1.09,3,1.47,4.66,2.3,4.79,2.43,5.12,6.23,8.27,8.78a12.18,12.18,0,0,0,6.88,2.81,28.33,28.33,0,0,0,7.95-.56c1.76-.45,6.48-2.34,5.35-4.94a3.53,3.53,0,0,0-1.46-1.43,76.3,76.3,0,0,1-6.68-4.62,55.46,55.46,0,0,1-7.14-7.07,25.75,25.75,0,0,1-4.39-6.9,1.34,1.34,0,0,0-.39-.62,1.26,1.26,0,0,0-1-.09,33.84,33.84,0,0,0-4.42,1.17,2.83,2.83,0,0,0-1.2.66,2.9,2.9,0,0,0-.45,2.21c0,.44,0,1-.39,1.15s-.78-.2-1-.56c-.36-.68-.46-1.54-1.05-2a4.28,4.28,0,0,0-1.42-.77,4.4,4.4,0,0,0-1.44-.25C160.63,339,160.41,338,160.41,338Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 176.388px 350.939px 0px;"
                            id="el3qebzjkgdfj" class="animable"></path><path
                            d="M58.11,240.32c.33,12.13-.23,20.06,3.82,26,4.77,7.07,9.78,9.88,21,16.19,9.33,5.22,25.67,12.38,28.45,13.55s3.16,4.31,3.81,9a76,76,0,0,0,6.7,23.67c5.56,11.71,9.7,20.34,9.7,20.34a35.81,35.81,0,0,0,13.44-3.5s-10.31-53.22-12.77-60.06-30.12-28.78-30.12-28.78,7.38-7.77,6.39-17.62Z"
                            style="fill: rgb(69, 90, 100); transform-origin: 101.57px 294.09px 0px;"
                            id="elw8rkffud7zr" class="animable"></path><path
                            d="M170.9,166.44a9.63,9.63,0,0,0-7.07-6.69,2,2,0,0,0-1.46.16,2.32,2.32,0,0,0-.72,1.34q-1.1,4-2.55,7.95a39.23,39.23,0,0,1-1.53,3.89c-.16.31-1.34,1.66-1.34,1.8a17.77,17.77,0,0,0-.13-4.21,2.42,2.42,0,0,0-2.63-2.11c-.55.1-.24,1.42-.85,3.59-.79,2.76-1.71,4.55-1.81,7.63a4.89,4.89,0,0,1-1.25,3.14c-3.76,4.11-14.12,12.39-21.37,17.26-4.14-3.8-9-10.88-14.72-18-7.09-8.8-9.68-12.08-21.46-11.56l2.5,17.12c6.54,8.06,12.38,13.44,25.16,26.58,3,3,5.19,4.27,7.18,4.45,2.71.24,5.24-1.94,7.72-4,5.55-4.68,11-9.53,16.22-14.61,7.07-6.93,16.28-15.49,19.38-23.68A15.48,15.48,0,0,0,170.9,166.44Z"
                            style="fill: rgb(177, 102, 104); transform-origin: 131.713px 189.239px 0px;"
                            id="elyh8fo482vqg" class="animable"></path><path
                            d="M92.93,170.37c5.33-.22,9.13-.51,12.92,2.63s22.36,26.6,22.36,26.6l13.9-9.9s2.58,7.33,8.68,10.43c0,0-12.29,12.58-17.94,16.69s-7.76,2.59-11.81-.4-25.69-26-25.69-26Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 121.86px 194.788px 0px;"
                            id="elgpapfg9jd6" class="animable"></path><path
                            d="M128.21,199.6c-3.28,2-5.24,7.68-5.24,7.68a13.36,13.36,0,0,1,4.09-9.13Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 125.59px 202.715px 0px;"
                            id="elu9epnk1h5sa" class="animable"></path><path
                            d="M142.11,189.7l5.32-4.64a16.12,16.12,0,0,0,3.79,6.95,20.66,20.66,0,0,0,4.32,3.46l-4.75,4.66s-2.3-.54-5.56-4.33S142.11,189.7,142.11,189.7Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 148.825px 192.595px 0px;"
                            id="eluicrn1jalf" class="animable"></path><path
                            d="M74.7,171s-10.86,1.09-15,2l-6.9,27.32,4.84,20.88-.4,27c7.4,8,47.08,3.38,51.34-9.1,0,0-1.08-41.46-1.56-49.67-.52-8.83-5.19-18.16-14.08-19.09Z"
                            style="fill: rgb(250, 250, 250); transform-origin: 80.69px 211.255px 0px;"
                            id="elu9fm5b503yc" class="animable"></path><path
                            d="M86,179.93l.72-2.07,3.23.42a4.47,4.47,0,0,1-3.69,4.55c-4,1-5.51-1.94-5.51-1.94l3.35-2.77Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 85.3512px 180.449px 0px;"
                            id="elne4c4wch23h" class="animable"></path><path
                            d="M64.8,134.55a5.18,5.18,0,0,1,2.75-1.48L64,131.14a2.89,2.89,0,0,1,4-1.31,3.12,3.12,0,0,1,1.34,4l1.26,13.93,1.17-.11.49,8.1.15,6.75c-3.26-.09-5.68-3.28-7.54-14.17C63.3,140.06,62.91,136.48,64.8,134.55Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 67.9709px 145.989px 0px;"
                            id="ele9w9lcc9emf" class="animable"></path><path
                            d="M105,129.92c1.31-1.61,2.47.13,2.18,2.14a8.35,8.35,0,0,1-4.73,6.63c-.14-.22-3.19-3.67-3.19-3.67l2.58-3.11A9.25,9.25,0,0,0,105,129.92Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 103.242px 133.989px 0px;"
                            id="eluzkoncw277k" class="animable"></path><path
                            d="M71.46,149.22a6.25,6.25,0,0,0-2.08-3.4c-1.07-1.12-4.62-2-6.36,1.71s.88,8.47,3.48,9.72a4.8,4.8,0,0,0,5.14-.55l-.07,16.05c6.82,6,13.05,4,14.44,7.18.76-3.38,3.23-2.83,2-7.57l0-5.21a39.88,39.88,0,0,0,6.1.65c3.28-.1,5.69-1.11,7.39-7.38,1.5-5.52,2.34-10.95,1.33-23.48-1.05-13.12-17.56-12.59-25.77-7.42S71.46,149.22,71.46,149.22Z"
                            style="fill: rgb(177, 102, 104); transform-origin: 82.8647px 153.025px 0px;"
                            id="elstnk5k7bzf" class="animable"></path><path
                            d="M85.46,187c0,3.25,1.86,24.54,1.09,45.9-.14,3.74,5.09,8.81,6.38,8.66s4.55-6.13,4.93-10.28c-.35-19.5-6.64-39.45-9.22-44.8Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 91.66px 214.022px 0px;"
                            id="el3qt190pleec" class="animable"></path><g
                            id="el979dtw70dm"><path
                              d="M88.89,187c-.09-.2-.17-.38-.25-.54h0l-3.18.52c0,.29,0,.73,0,1.28A5.12,5.12,0,0,0,88.89,187Z"
                              style="opacity: 0.15; transform-origin: 87.175px 187.36px 0px;"
                              class="animable"></path></g><path
                            d="M83.51,180a12.57,12.57,0,0,0,4.79-.63A4.7,4.7,0,0,1,90,182a7.3,7.3,0,0,1-1.31,4.48,3.86,3.86,0,0,1-3.18.52,13.36,13.36,0,0,1-3.31-2.61A19,19,0,0,1,83.51,180Z"
                            style="fill: rgb(186, 104, 200); transform-origin: 86.1031px 183.254px 0px;"
                            id="el5q08mi3n2dm" class="animable"></path><path
                            d="M71.6,165.74c-1,.08-1.65,1-2.5,2.69-1,1.95-1.81,3.72-1.81,3.72a12.05,12.05,0,0,0,3.55,7.55,25,25,0,0,0,11,6.25s.73-3.22,1.23-4.7c1.09-3.24,3-1.32,3-1.32a3.8,3.8,0,0,0-.89-1.92c-.7-.62-5.15-1-8.71-3.24a12.68,12.68,0,0,1-4.83-6.17Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 76.68px 175.845px 0px;"
                            id="elzqw6eh9k39r" class="animable"></path><path
                            d="M86,179.93a3.69,3.69,0,0,1,.94-2.86,7,7,0,0,0,1-4.33c0-1.5,0-4.87,0-4.87a3,3,0,0,1,2.85,2.25c.76,1.88,2.14,5.71,1.51,9.46a17.05,17.05,0,0,1-1.26,4.86,34.8,34.8,0,0,0-1.81-3.87C88.17,178.8,86.82,178.41,86,179.93Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 89.2204px 176.155px 0px;"
                            id="elcc36wlf0gm6" class="animable"></path><path
                            d="M72.09,150.2a4.2,4.2,0,0,1-.63-1c-1-2.06-2.67-4.33-3-6.65a15.59,15.59,0,0,1,0-3.8q.12-1.22.27-2.43a4.3,4.3,0,0,0-.19-2.25c-.74-2.31.25-4.87,1.64-6.73a10.93,10.93,0,0,1,5.25-3.69c3.68-1.23,7.5-.54,11.27-.32a49.65,49.65,0,0,0,7.71-.34,14.56,14.56,0,0,0,6.86-2.44,2.41,2.41,0,0,1,1.81-.62c1,.27,1.28,1.64,1.49,2.5a13.55,13.55,0,0,1,.34,3.36,11.85,11.85,0,0,1-2,6.34,10.55,10.55,0,0,1-6.43,4.31,17.41,17.41,0,0,1-7.46-.37c-1.86-.43-3.69-1-5.54-1.45-.93-.23-2.54-.83-3.49-.36,1.78,3.84-1.32,7-4.21,7.66a25,25,0,0,1-1.14,6.85A3.72,3.72,0,0,1,74.1,150a1.39,1.39,0,0,1-1.19.59A1.32,1.32,0,0,1,72.09,150.2Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 86.6008px 135.257px 0px;"
                            id="elwloktcf67fq" class="animable"></path><path
                            d="M88,167.15s-6.86-1.25-9.58-2.69c-1.82-1-3.56-3.7-4-4.77a10.6,10.6,0,0,0,1.93,4.77c2,2.54,11.65,4.76,11.65,4.76Z"
                            style="fill: rgb(154, 74, 77); transform-origin: 81.21px 164.455px 0px;"
                            id="ela3ny7lnhyaj" class="animable"></path><path
                            d="M87.42,147.08a1.56,1.56,0,1,1-1.56-1.62A1.59,1.59,0,0,1,87.42,147.08Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 85.8607px 147.02px 0px;"
                            id="elekcdoayueut" class="animable"></path><path
                            d="M85.35,141.83,82,143.67a2,2,0,0,1,.77-2.65A1.85,1.85,0,0,1,85.35,141.83Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 83.5625px 142.225px 0px;"
                            id="el9q35ojfnqx" class="animable"></path><path
                            d="M86.68,157.25l4.81,1.8a2.52,2.52,0,0,1-3.27,1.59A2.69,2.69,0,0,1,86.68,157.25Z"
                            style="fill: rgb(154, 74, 77); transform-origin: 89.0086px 159.023px 0px;"
                            id="elr96nb4jswi" class="animable"></path><path
                            d="M100.85,143l-3-2.35a1.85,1.85,0,0,1,2.65-.4A2,2,0,0,1,100.85,143Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 99.5474px 141.431px 0px;"
                            id="el8nmukr5iamp" class="animable"></path><path
                            d="M100.19,146.6A1.56,1.56,0,1,1,98.63,145,1.59,1.59,0,0,1,100.19,146.6Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 98.6303px 146.56px 0px;"
                            id="el23gs34dm4xd" class="animable"></path><polygon
                            points="92.64 146.26 93.16 155.64 98.05 153.97 92.64 146.26"
                            style="fill: rgb(154, 74, 77); transform-origin: 95.345px 150.95px 0px;"
                            id="elkcd9wif3m2h" class="animable"></polygon><path
                            d="M79.34,268.63a24.82,24.82,0,0,1-6.64-4.81,21.53,21.53,0,0,0,4.78.47c2.26-.19,3-1.66,3-2.4,0-.58-1.55-.45-3.84-1.4-2.93-1.21-5.93-3.16-9.38-3.7a5.16,5.16,0,0,1-3.23-1.74c-4.39-5.3-15.63-25.88-16.29-27.59,0,0,8.4-18.62,11.25-25.62,7.09-12.42,5-25.69.65-28.84-9.52.82-13.68,6.23-16.69,15.77-2.63,8.36-9.86,25.53-11.72,35.8-1,5.17-.62,7.48,6.57,17.41,3.84,5.32,8.47,10.58,14.25,18.55A120.8,120.8,0,0,0,59.76,270c7.74,8.5,12.84,9.79,17.82,7.91C85.52,274.89,85,271.52,79.34,268.63Z"
                            style="fill: rgb(177, 102, 104); transform-origin: 57.197px 225.831px 0px;"
                            id="elvt3pgvis66q" class="animable"></path><path
                            d="M61.4,172.68c-3.73-.13-10.93-.25-15.55,7.76s-10.17,26.23-12.68,34.42S27.58,228,32.39,235a206.59,206.59,0,0,0,12.8,16.47,15.46,15.46,0,0,1,10.27-9.93l-7.19-14,14.18-31.15a39.35,39.35,0,0,0,1.9-14.23C63.93,174.14,61.4,172.68,61.4,172.68Z"
                            style="fill: rgb(235, 235, 235); transform-origin: 47.1304px 212.059px 0px;"
                            id="el68elgocejf4" class="animable"></path><path
                            d="M48.27,227.48c-1.22-2-5.75-2.85-7.66-2.56,0,0,3.73-2.35,8.69.3Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 44.955px 225.72px 0px;"
                            id="elzcitsvajhxc" class="animable"></path><path
                            d="M45.19,251.45l4.09,5.27s3.41-7.15,10.25-8.37l-4.07-6.83s-3.29-.29-6.8,3.61S45.19,251.45,45.19,251.45Z"
                            style="fill: rgb(224, 224, 224); transform-origin: 52.36px 249.118px 0px;"
                            id="elkzqd4c51qe" class="animable"></path></g><g
                          id="freepik--Document--inject-3"
                          style="transform-origin: 119.883px 263.391px 0px;"
                          class="animable"><g id="el6smrccuf15w"><path
                              d="M129.58,252.68c-3.7-2.13-6.61-3.88-9.62-5.78L84.41,267.42l0,0h0a.16.16,0,0,0-.09.09h0c-.06.1,0,.22.12.31l29.93,17.28a.77.77,0,0,0,.37.08.67.67,0,0,0,.38-.08l34.37-19.84C143,260.32,134.33,255.41,129.58,252.68Z"
                              style="opacity: 0.2; transform-origin: 116.893px 266.041px 0px;"
                              class="animable"></path></g><g
                            id="freepik--List--inject-3"
                            style="transform-origin: 120.35px 262.53px 0px;"
                            class="animable"><path
                              d="M155.47,258.89v.72a.78.78,0,0,1-.36.61L115,283.37a.8.8,0,0,1-.71,0L85.59,266.79a.78.78,0,0,1-.36-.62v-.72a.79.79,0,0,1,.36-.62l40.09-23.14a.76.76,0,0,1,.72,0l28.71,16.58A.78.78,0,0,1,155.47,258.89Z"
                              style="fill: rgb(186, 104, 200); transform-origin: 120.35px 262.526px 0px;"
                              id="elvaqtxon7n7" class="animable"></path><g
                              id="ele0kcovelh6k"><path
                                d="M155.47,258.89v.72a.78.78,0,0,1-.36.61L115,283.37a.8.8,0,0,1-.71,0L85.59,266.79a.78.78,0,0,1-.36-.62v-.72a.79.79,0,0,1,.36-.62l40.09-23.14a.76.76,0,0,1,.72,0l28.71,16.58A.78.78,0,0,1,155.47,258.89Z"
                                style="opacity: 0.25; transform-origin: 120.35px 262.526px 0px;"
                                class="animable"></path></g><g
                              id="el3h93buyatec"><path
                                d="M85.54,264.87c-.14.11-.13.27,0,.37l28.72,16.59a.83.83,0,0,0,.36.08v1.55a.71.71,0,0,1-.36-.09L85.59,266.79a.74.74,0,0,1-.35-.62v-.72A.79.79,0,0,1,85.54,264.87Z"
                                style="opacity: 0.2; transform-origin: 99.93px 274.165px 0px;"
                                class="animable"></path></g><g
                              id="elxhkv5tuce5"><path
                                d="M155.17,258.31h0l0,0h0l.05.05h0a.82.82,0,0,1,.18.39.28.28,0,0,1,0,.09v.72a.78.78,0,0,1-.36.61L115,283.37a.65.65,0,0,1-.35.09v-1.55a.75.75,0,0,0,.35-.08l40.09-23.15a.31.31,0,0,0,.14-.14.21.21,0,0,0,0-.2Z"
                                style="opacity: 0.15; transform-origin: 135.027px 270.885px 0px;"
                                class="animable"></path></g><path
                              d="M144.62,248.09c0-.27-.17-.53-.6-.78a2.7,2.7,0,0,0-1.27-.35h-.11a22.49,22.49,0,0,0-3.27.67h-.05a7.7,7.7,0,0,1-2.8-.31l-.34,0-.46,0a8.81,8.81,0,0,1-1.81,0c-.48-.05-.84-.07-1.1-.08h-.11a1.46,1.46,0,0,0-.81.16l-1.61.93v.53l12,7,1.61-.93a.47.47,0,0,0,.27-.49v-.52a2.36,2.36,0,0,0-.14-.69q-.06-.22-.09-.39a3.07,3.07,0,0,0,.05-.38v-.55a.57.57,0,0,0,0-.18c-.08-.28-.45-.56-.58-1a1.47,1.47,0,0,1,.06-.14c.24-.58,1.15-1.25,1.14-1.9C144.61,248.54,144.62,248.19,144.62,248.09Zm-2.48,1.54a3.14,3.14,0,0,1-.87.33,2.37,2.37,0,0,1-1.63-.12.78.78,0,0,1-.29-.28,1.52,1.52,0,0,1,.65-.63,3.07,3.07,0,0,1,2.2-.34,2.08,2.08,0,0,1,.3.13.71.71,0,0,1,.29.28A1.52,1.52,0,0,1,142.14,249.63Z"
                              style="fill: rgb(38, 50, 56); transform-origin: 137.45px 251.41px 0px;"
                              id="elly1xbmulgh" class="animable"></path><path
                              d="M131.89,247.36l-1.61.93,12,7,1.61-.93c.2-.12.41-.28.13-1.17s.06-1.1-.07-1.5-.88-.83-.52-1.65,2-1.84.55-2.68a2.7,2.7,0,0,0-1.27-.35h-.11a22.49,22.49,0,0,0-3.27.67h-.05a7.7,7.7,0,0,1-2.8-.31l-.34,0-.46,0a8.81,8.81,0,0,1-1.81,0c-.48-.05-.84-.07-1.1-.08h-.11A1.46,1.46,0,0,0,131.89,247.36Zm9.93,6.23a.75.75,0,0,1,.66-.06c.16.09.11.26-.1.38a.72.72,0,0,1-.66.06C141.56,253.88,141.61,253.71,141.82,253.59Zm-1.82-5.2a3.06,3.06,0,0,1,2.2-.33,1.34,1.34,0,0,1,.3.12c.59.35.43,1-.36,1.45a3.14,3.14,0,0,1-.87.33,2.37,2.37,0,0,1-1.63-.12C139,249.49,139.21,248.85,140,248.39Zm-7.47-.16a.75.75,0,0,1,.66-.06c.16.09.12.26-.09.38a.75.75,0,0,1-.66.06C132.28,248.52,132.32,248.35,132.53,248.23Z"
                              style="fill: rgb(55, 71, 79); transform-origin: 137.424px 251.15px 0px;"
                              id="el9sm6lgvveyt" class="animable"></path><path
                              d="M115.78,279.31l-25-14.43a.48.48,0,0,1-.21-.37v-.28a.46.46,0,0,1,.21-.37l33-19.06a.45.45,0,0,1,.42,0l25,14.42a.51.51,0,0,1,.21.38v.27a.47.47,0,0,1-.21.37l-33,19.07A.47.47,0,0,1,115.78,279.31Z"
                              style="fill: rgb(245, 245, 245); transform-origin: 119.99px 262.054px 0px;"
                              id="elovfot7nonx" class="animable"></path><path
                              d="M90.74,263.9c-.07.07,0,.15.05.21l25,14.42a.39.39,0,0,0,.21.06v.77a.5.5,0,0,1-.21-.05l-25-14.43a.45.45,0,0,1-.21-.37v-.28A.49.49,0,0,1,90.74,263.9Z"
                              style="fill: rgb(250, 250, 250); transform-origin: 103.29px 271.63px 0px;"
                              id="el26wpsyd1uic" class="animable"></path><path
                              d="M149.27,259.26l.06.06,0,0a.24.24,0,0,1,.06.11l0,.08v.33a.47.47,0,0,1-.21.37l-33,19.07a.51.51,0,0,1-.22.05v-.77a.4.4,0,0,0,.22-.06l33-19.06C149.33,259.41,149.34,259.33,149.27,259.26Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 132.675px 269.295px 0px;"
                              id="elyy9kx74kfdp" class="animable"></path><path
                              d="M121.92,249.05l-.29.17a.17.17,0,0,0,0,.33l20.06,11.58a.64.64,0,0,0,.57,0l.3-.17c.15-.09.15-.23,0-.33l-20.07-11.58A.64.64,0,0,0,121.92,249.05Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 132.087px 255.09px 0px;"
                              id="ellxm7hwzo3p" class="animable"></path><path
                              d="M120.17,250.06l-.29.17a.17.17,0,0,0,0,.33l20.06,11.58a.58.58,0,0,0,.57,0l.29-.16a.17.17,0,0,0,0-.33l-20.06-11.59A.64.64,0,0,0,120.17,250.06Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 130.34px 256.104px 0px;"
                              id="elz4oyke20sn" class="animable"></path><path
                              d="M118.43,251.07l-.29.17a.17.17,0,0,0,0,.33l20.06,11.58a.64.64,0,0,0,.57,0l.29-.17a.17.17,0,0,0,0-.33L119,251.07A.64.64,0,0,0,118.43,251.07Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 128.6px 257.11px 0px;"
                              id="eltx4sikwg78m" class="animable"></path><path
                              d="M114.56,253.3l-.29.17a.18.18,0,0,0,0,.33l20.07,11.58a.64.64,0,0,0,.57,0l.29-.17a.18.18,0,0,0,0-.33L115.13,253.3A.64.64,0,0,0,114.56,253.3Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 124.735px 259.34px 0px;"
                              id="el2kndjbpo7wj" class="animable"></path><path
                              d="M112.81,254.31l-.29.17a.17.17,0,0,0,0,.33l20.06,11.58a.64.64,0,0,0,.57,0l.29-.17c.16-.09.16-.23,0-.32l-20.06-11.59A.64.64,0,0,0,112.81,254.31Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 122.975px 260.35px 0px;"
                              id="elj9iieea88i" class="animable"></path><path
                              d="M111.07,255.32l-.29.17c-.16.09-.16.23,0,.33l20.06,11.58a.64.64,0,0,0,.57,0l.29-.17a.17.17,0,0,0,0-.33l-20.06-11.58A.64.64,0,0,0,111.07,255.32Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 121.245px 261.36px 0px;"
                              id="elwvuh0zysge8" class="animable"></path><path
                              d="M107.21,257.55l-.29.17c-.16.09-.16.23,0,.33L127,269.63a.64.64,0,0,0,.57,0l.29-.17a.17.17,0,0,0,0-.33l-20.06-11.58A.64.64,0,0,0,107.21,257.55Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 117.395px 263.587px 0px;"
                              id="elr0pnn2rzl7l" class="animable"></path><path
                              d="M105.45,258.56l-.29.17a.18.18,0,0,0,0,.33l20.06,11.58a.64.64,0,0,0,.57,0l.3-.17a.18.18,0,0,0,0-.33L106,258.56A.64.64,0,0,0,105.45,258.56Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 115.625px 264.602px 0px;"
                              id="elzz5ccvpiims" class="animable"></path><path
                              d="M103.71,259.57l-.29.16c-.16.1-.16.24,0,.33l20.06,11.59a.64.64,0,0,0,.57,0l.29-.17a.17.17,0,0,0,0-.33l-20.06-11.58A.64.64,0,0,0,103.71,259.57Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 113.885px 265.61px 0px;"
                              id="el9f2qn89pq96" class="animable"></path><path
                              d="M99.85,261.8l-.29.16c-.16.1-.16.24,0,.33l20.06,11.59a.64.64,0,0,0,.57,0l.29-.17a.17.17,0,0,0,0-.33L100.42,261.8A.64.64,0,0,0,99.85,261.8Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 110.025px 267.84px 0px;"
                              id="el7pouafaunwp" class="animable"></path><path
                              d="M98.09,262.81l-.29.17c-.15.09-.15.23,0,.33l20.07,11.58a.64.64,0,0,0,.57,0l.29-.17a.17.17,0,0,0,0-.33L98.67,262.81A.66.66,0,0,0,98.09,262.81Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 108.273px 268.85px 0px;"
                              id="elwecssqptq7g" class="animable"></path><path
                              d="M96.35,263.82l-.29.16a.17.17,0,0,0,0,.33l20.06,11.59a.64.64,0,0,0,.57,0l.29-.17a.17.17,0,0,0,0-.33L96.92,263.82A.58.58,0,0,0,96.35,263.82Z"
                              style="fill: rgb(224, 224, 224); transform-origin: 106.52px 269.856px 0px;"
                              id="elujfa782i82c" class="animable"></path><path
                              d="M140.15,254.71l-1.78-1.39a1.07,1.07,0,0,1-.1-.15l0,0,.44-.4,1.38-1.27a.37.37,0,0,0,.14-.27v-.53a.56.56,0,0,0-.16-.36,1.37,1.37,0,0,1-.29-.68,1.05,1.05,0,0,1,.33-.63,2,2,0,0,0-.38-3,3,3,0,0,0-1.36-.33h-.06a3.08,3.08,0,0,0-2,.73,2.73,2.73,0,0,1-1.33.51,3.84,3.84,0,0,1-1.22,0l-.28,0h0a.74.74,0,0,0-.57.18l-1.19,1.11-.44.4,0,0a1.09,1.09,0,0,1-1,.15c-.66-.28-1-.43-2-.92a2.49,2.49,0,0,0-1-.2h0a3.19,3.19,0,0,0-1.43.36v.54L140.47,257a1.19,1.19,0,0,0,.28-.73v-.54A1.45,1.45,0,0,0,140.15,254.71Zm-3-7.43a2,2,0,0,1,1.92-.34l.21.09a1.05,1.05,0,0,1,.52.55.94.94,0,0,1-.29.41,1.68,1.68,0,0,1-.58.34,2,2,0,0,1-1.55-.09,1,1,0,0,1-.52-.55A1.07,1.07,0,0,1,137.11,247.28Z"
                              style="fill: rgb(55, 71, 79); transform-origin: 133.3px 251.35px 0px;"
                              id="elf8omui2jfi" class="animable"></path><path
                              d="M125.75,248l14.72,8.5c.4-.55.45-1.11-.32-1.8l-1.78-1.39s-.39-.43-.06-.73l.44-.41,1.38-1.26s.32-.22,0-.63a1.45,1.45,0,0,1,0-1.85,1.4,1.4,0,0,0-.38-2.42,3,3,0,0,0-1.36-.33h-.06a3.08,3.08,0,0,0-2,.73,2.73,2.73,0,0,1-1.33.51,3.84,3.84,0,0,1-1.22,0l-.28,0h0a.74.74,0,0,0-.57.18l-1.19,1.11-.44.4,0,0a1.09,1.09,0,0,1-1,.15c-.66-.28-1-.43-2-.92a2.49,2.49,0,0,0-1-.2h0A3.19,3.19,0,0,0,125.75,248Zm13.28-1.6.21.09a.86.86,0,0,1,.23,1.49,1.68,1.68,0,0,1-.58.34,2,2,0,0,1-1.55-.09.86.86,0,0,1-.23-1.49A2,2,0,0,1,139,246.41Z"
                              style="fill: rgb(69, 90, 100); transform-origin: 133.252px 251.09px 0px;"
                              id="elrxst1y6ob1"
                              class="animable"></path></g></g></g></g><g
                      id="freepik--Briefcase--inject-3"
                      style="transform-origin: 86.81px 378.958px 0px;"
                      class="animable"><g id="freepik--briefcase--inject-3"
                        style="transform-origin: 86.81px 378.958px 0px;"
                        class="animable"><path
                          d="M119.73,370.4v43.05c0,2.09-1.48,3.29-3.28,4.35l-4.53,2.62a4.34,4.34,0,0,1-3.54.7,9.92,9.92,0,0,1-2.41-1l-.1-.05-.24-.14L59.35,393.22a10.92,10.92,0,0,1-5.46-9.46V344.55a3.11,3.11,0,0,1,1.41-2.43L63,337.66a3.07,3.07,0,0,1,2.8,0L118.32,368a3,3,0,0,1,1.41,2.43Z"
                          style="fill: rgb(55, 71, 79); transform-origin: 86.81px 379.28px 0px;"
                          id="el7a013x6dpz4" class="animable"></path><path
                          d="M119.73,370.4v43.05c0,2.09-1.48,3.29-3.28,4.35l-4.53,2.62a4.34,4.34,0,0,1-3.54.7,9.92,9.92,0,0,1-2.41-1v0c1.8.84,3.22-.1,3.22-2.23V377.32a4.31,4.31,0,0,0-.62-2.1L119.32,369A3,3,0,0,1,119.73,370.4Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 112.85px 395.119px 0px;"
                          id="elnkjrpw1u4dj" class="animable"></path><path
                          d="M109.19,377.32a4.7,4.7,0,0,0-2.12-3.68L57.46,345c-2-1.13-3.57-.2-3.57,2.06v36.7a10.93,10.93,0,0,0,5.46,9.47l46.28,26.72c2,1.13,3.56.2,3.56-2.06Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 81.54px 382.475px 0px;"
                          id="el5e194fdlhwa" class="animable"></path><path
                          d="M60.52,339.11l52.59,30.66a5,5,0,0,1,2.44,4.25v44.31l-.8.46V374a4.15,4.15,0,0,0-2-3.56l-53-30.89Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 87.65px 378.95px 0px;"
                          id="el3bz7vchrm8n" class="animable"></path><g
                          id="elelu2ef7endw"><path
                            d="M114.89,371.57a4.94,4.94,0,0,1,.66,2.45v44.31l-.8.46V374a4.14,4.14,0,0,0-.55-2Z"
                            style="opacity: 0.4; transform-origin: 114.875px 395.18px 0px;"
                            class="animable"></path></g><g
                          id="elruc0rfxbm6"><path
                            d="M114.2,372a4.18,4.18,0,0,0-1.5-1.51l-53-30.89.8-.46,52.59,30.66a5,5,0,0,1,1.78,1.8"
                            style="opacity: 0.3; transform-origin: 87.285px 355.57px 0px;"
                            class="animable"></path></g><path
                          d="M83,342.29V349l-2.61,1.51v-8.85c0-.46.32-.64.71-.42Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 81.695px 345.828px 0px;"
                          id="elxuxhqzamlz" class="animable"></path><g
                          id="el0ps877fdvlvh"><path
                            d="M83,342.29V349l-2.61,1.51v-8.85c0-.46.32-.64.71-.42Z"
                            style="opacity: 0.4; transform-origin: 81.695px 345.828px 0px;"
                            class="animable"></path></g><path
                          d="M101.29,348.87v10.8l-2.49,1.44-1.67-1v-8.86a1.58,1.58,0,0,0-.72-1.23l-12.7-7.33-2.64-1.53c-.39-.22-.71,0-.71.42v8.85l-1.68-1V338.7s0-.09,0-.14a1.61,1.61,0,0,1,.71-1.1l1.06-.61a1.57,1.57,0,0,1,1.43,0l18.69,10.79A1.59,1.59,0,0,1,101.29,348.87Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 89.985px 348.894px 0px;"
                          id="el29z9sy19xq" class="animable"></path><g
                          id="elhqxxs49g27"><path
                            d="M101.29,348.87v10.8l-2.49,1.44-1.67-1v-8.86a1.58,1.58,0,0,0-.72-1.23l-12.7-7.33-2.64-1.53c-.39-.22-.71,0-.71.42v8.85l-1.68-1V338.7s0-.09,0-.14a1.61,1.61,0,0,1,.71-1.1l1.06-.61a1.57,1.57,0,0,1,1.43,0l18.69,10.79A1.59,1.59,0,0,1,101.29,348.87Z"
                            style="opacity: 0.15; transform-origin: 89.985px 348.894px 0px;"
                            class="animable"></path></g><g
                          id="ellatov9fjijr"><path
                            d="M98.8,350.32v10.79l-1.67-1v-8.86a1.58,1.58,0,0,0-.72-1.23l-12.7-7.33-2.64-1.53c-.39-.22-.71,0-.71.42v8.85l-1.68-1V338.7s0-.09,0-.14c.07-.35.36-.47.71-.27l18.69,10.79A1.59,1.59,0,0,1,98.8,350.32Z"
                            style="opacity: 0.15; transform-origin: 88.74px 349.652px 0px;"
                            class="animable"></path></g></g></g><g
                      id="freepik--speech-bubbles--inject-3"
                      style="transform-origin: 243.385px 84.5857px 0px;"
                      class="animable"><g id="freepik--speech-bubbles--inject-3"
                        style="transform-origin: 155.139px 92.4289px 0px;"
                        class="animable"><path
                          d="M139.38,142.51l-3.94-2.27a.35.35,0,0,1-.18-.16l-.72-1.27,2.33-1.34-.07.2Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 136.96px 139.99px 0px;"
                          id="el29llhn21wzw" class="animable"></path><g
                          id="eltl2gxlu1h7"><path
                            d="M139.38,142.51l-3.94-2.27a.35.35,0,0,1-.18-.16l-.72-1.27,2.33-1.34-.07.2Z"
                            style="opacity: 0.2; transform-origin: 136.96px 139.99px 0px;"
                            class="animable"></path></g><path
                          d="M136.52,137.66l2.72,4.71a.4.4,0,0,0,.73-.07l2.88-8.3Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 139.685px 138.288px 0px;"
                          id="elt8w2m4k3f7q" class="animable"></path><path
                          d="M168.8,103a4.22,4.22,0,0,0-1.9-3.3l-1.55-.89a4.19,4.19,0,0,0-3.81,0L125,119.89a4.21,4.21,0,0,0-1.9,3.29v13.87a4.19,4.19,0,0,0,1.9,3.29l1.55.9a4.17,4.17,0,0,0,3.8,0L167.07,120a3,3,0,0,0,1.73-3.16Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 145.965px 120.025px 0px;"
                          id="elf91krcm5" class="animable"></path><g
                          id="elqmdvo35ii08"><path
                            d="M123.08,137.05a4.19,4.19,0,0,0,1.9,3.29l1.55.9a4.26,4.26,0,0,0,3.48.16c-.9.34-1.58-.17-1.58-1.26V126.27a3.85,3.85,0,0,1,.56-1.87l-5.35-3.09a3.85,3.85,0,0,0-.56,1.87Z"
                            style="opacity: 0.2; transform-origin: 126.545px 131.503px 0px;"
                            class="animable"></path></g><g
                          id="el8oo76u7lf2a"><path
                            d="M168.74,102.42c-.23-.81-1-1.07-1.84-.56L130.33,123A3.83,3.83,0,0,0,129,124.4l-5.35-3.09a4,4,0,0,1,1.34-1.42l36.56-21.12a4.26,4.26,0,0,1,3.81,0l1.55.9A4.19,4.19,0,0,1,168.74,102.42Z"
                            style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 146.195px 111.36px 0px;"
                            class="animable"></path></g><path
                          d="M133.52,127c0,.72.55,1,1.21.61l17.69-10.23a2.6,2.6,0,0,0,1.21-2c0-.72-.54-1-1.21-.61L134.73,125A2.57,2.57,0,0,0,133.52,127Z"
                          style="fill: rgb(250, 250, 250); transform-origin: 143.575px 121.19px 0px;"
                          id="el4cvja4jq0ti" class="animable"></path><path
                          d="M133.52,133.83c0,.72.55,1,1.21.61L162,118.64a2.57,2.57,0,0,0,1.21-2c0-.72-.54-1-1.21-.61l-27.27,15.8A2.57,2.57,0,0,0,133.52,133.83Z"
                          style="fill: rgb(250, 250, 250); transform-origin: 148.365px 125.235px 0px;"
                          id="elmsppwfw781k" class="animable"></path><path
                          d="M157.74,86.48l-3.93-2.27a.37.37,0,0,1-.19-.16l-.72-1.27,2.33-1.34-.07.2Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 155.32px 83.96px 0px;"
                          id="el5hthu4n6j09" class="animable"></path><g
                          id="elg9o55kv1z7q"><path
                            d="M157.74,86.48l-3.93-2.27a.37.37,0,0,1-.19-.16l-.72-1.27,2.33-1.34-.07.2Z"
                            style="opacity: 0.2; transform-origin: 155.32px 83.96px 0px;"
                            class="animable"></path></g><path
                          d="M154.88,81.63l2.72,4.71a.41.41,0,0,0,.74-.07l2.87-8.3Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 158.045px 82.2563px 0px;"
                          id="elu7uwfmwevx" class="animable"></path><path
                          d="M187.16,46.93a4.19,4.19,0,0,0-1.9-3.29l-1.55-.9a4.17,4.17,0,0,0-3.8,0L143.34,63.86a4.21,4.21,0,0,0-1.9,3.29V81a4.22,4.22,0,0,0,1.9,3.3l1.55.89a4.19,4.19,0,0,0,3.81,0L185.44,64a2.94,2.94,0,0,0,1.72-3.16Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 164.319px 63.965px 0px;"
                          id="el7kglqruf7h6" class="animable"></path><g
                          id="elwu9hzpgpni"><path
                            d="M141.44,81a4.22,4.22,0,0,0,1.9,3.3l1.55.89a4.26,4.26,0,0,0,3.48.16c-.89.34-1.58-.17-1.58-1.26V70.25a4,4,0,0,1,.56-1.88L142,65.28a3.85,3.85,0,0,0-.56,1.87Z"
                            style="opacity: 0.2; transform-origin: 144.905px 75.4632px 0px;"
                            class="animable"></path></g><g
                          id="el2isv57sxpzd"><path
                            d="M187.1,46.39c-.22-.81-1-1.07-1.84-.56L148.7,67a3.68,3.68,0,0,0-1.34,1.42L142,65.28a4,4,0,0,1,1.34-1.42L179.9,42.74a4.26,4.26,0,0,1,3.81,0l1.55.9A4.19,4.19,0,0,1,187.1,46.39Z"
                            style="fill: rgb(255, 255, 255); opacity: 0.4; transform-origin: 164.55px 55.3552px 0px;"
                            class="animable"></path></g><path
                          d="M151.89,71c0,.72.54,1,1.21.61l17.68-10.23a2.6,2.6,0,0,0,1.21-2c0-.72-.54-1-1.21-.61L153.1,69A2.57,2.57,0,0,0,151.89,71Z"
                          style="fill: rgb(250, 250, 250); transform-origin: 161.94px 65.19px 0px;"
                          id="el26x31o58tci" class="animable"></path><path
                          d="M151.89,77.8c0,.72.54,1,1.21.61l27.26-15.8a2.57,2.57,0,0,0,1.21-2c0-.72-.54-1-1.21-.61L153.1,75.79A2.57,2.57,0,0,0,151.89,77.8Z"
                          style="fill: rgb(250, 250, 250); transform-origin: 166.73px 69.205px 0px;"
                          id="el0rqtxeksqtic" class="animable"></path></g><g
                        id="freepik--speech-bubbles--inject-3"
                        style="transform-origin: 331.468px 77.3566px 0px;"
                        class="animable"><path
                          d="M328.93,72l4-2.33a.37.37,0,0,0,.18-.17l.73-1.3-2.35-1.39.07.21Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 331.385px 69.405px 0px;"
                          id="elnggisptst0p" class="animable"></path><path
                          d="M328.93,72l4-2.33a.37.37,0,0,0,.18-.17l.73-1.3-2.35-1.39.07.21Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 331.385px 69.405px 0px;"
                          id="elib0r5yci1gr" class="animable"></path><path
                          d="M331.81,67l-2.74,4.85a.41.41,0,0,1-.74-.07l-2.89-8.55Z"
                          style="fill: rgb(55, 71, 79); transform-origin: 328.625px 67.6413px 0px;"
                          id="elokwh7p1anf" class="animable"></path><path
                          d="M299.34,31.37A4.32,4.32,0,0,1,301.25,28l1.56-.92a4.16,4.16,0,0,1,3.82,0l36.78,21.73a4.34,4.34,0,0,1,1.92,3.39V66.35a4.34,4.34,0,0,1-1.92,3.39l-1.56.92a4.1,4.1,0,0,1-3.82,0l-37-21.86a3,3,0,0,1-1.74-3.25Z"
                          style="fill: rgb(55, 71, 79); transform-origin: 322.288px 48.8738px 0px;"
                          id="eldxf8zq7t9n" class="animable"></path><path
                          d="M345.33,66.35a4.34,4.34,0,0,1-1.92,3.39l-1.56.92a4.19,4.19,0,0,1-3.5.17c.91.35,1.59-.18,1.59-1.3V55.35a4,4,0,0,0-.56-1.92l5.39-3.18a4.11,4.11,0,0,1,.56,1.93Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 341.84px 60.6917px 0px;"
                          id="el35q1hbavmtr" class="animable"></path><path
                          d="M299.4,30.81c.22-.83,1-1.09,1.85-.57L338,52a3.83,3.83,0,0,1,1.35,1.46l5.38-3.18a3.91,3.91,0,0,0-1.35-1.46L306.64,27.06a4.18,4.18,0,0,0-3.83,0l-1.56.92A4.31,4.31,0,0,0,299.4,30.81Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 322.065px 40.0278px 0px;"
                          id="elecnsqdbm99p" class="animable"></path><path
                          d="M327.21,51.08c0,.64-.47.88-1,.54l-20.63-12.2a2.31,2.31,0,0,1-1-1.78c0-.64.47-.89,1-.54l20.63,12.2A2.31,2.31,0,0,1,327.21,51.08Z"
                          style="fill: rgb(240, 240, 240); transform-origin: 315.895px 44.3578px 0px;"
                          id="elibw06i3q3hk" class="animable"></path><path
                          d="M335.5,63.23c0,.64-.47.88-1,.54L305.53,46.64a2.31,2.31,0,0,1-1-1.78c0-.64.47-.88,1-.54l28.93,17.13A2.32,2.32,0,0,1,335.5,63.23Z"
                          style="fill: rgb(240, 240, 240); transform-origin: 320.015px 54.045px 0px;"
                          id="elo1u8e8pxd69" class="animable"></path><path
                          d="M347.29,128.05l4-2.34a.44.44,0,0,0,.19-.17l.72-1.3-2.35-1.38.08.21Z"
                          style="fill: rgb(186, 104, 200); transform-origin: 349.745px 125.455px 0px;"
                          id="el3nszexpembn" class="animable"></path><path
                          d="M347.29,128.05l4-2.34a.44.44,0,0,0,.19-.17l.72-1.3-2.35-1.38.08.21Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 349.745px 125.455px 0px;"
                          id="elb82hq4lk19" class="animable"></path><path
                          d="M350.17,123.05l-2.74,4.85a.4.4,0,0,1-.74-.07l-2.89-8.54Z"
                          style="fill: rgb(55, 71, 79); transform-origin: 346.985px 123.704px 0px;"
                          id="elg29vm88dcwq" class="animable"></path><path
                          d="M317.7,87.44a4.36,4.36,0,0,1,1.91-3.39l1.56-.91a4.12,4.12,0,0,1,3.83,0l36.78,21.72a4.35,4.35,0,0,1,1.91,3.39v14.18a4.37,4.37,0,0,1-1.91,3.39l-1.56.92a4.18,4.18,0,0,1-3.83,0l-37-21.86a3,3,0,0,1-1.73-3.26Z"
                          style="fill: rgb(55, 71, 79); transform-origin: 340.652px 104.936px 0px;"
                          id="elkd7hpckni3" class="animable"></path><path
                          d="M363.69,122.43a4.37,4.37,0,0,1-1.91,3.39l-1.56.92a4.19,4.19,0,0,1-3.5.16c.9.35,1.58-.18,1.58-1.29V111.43a4,4,0,0,0-.56-1.93l5.39-3.18a4.15,4.15,0,0,1,.56,1.93Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 360.205px 116.764px 0px;"
                          id="elaywqk5i9lck" class="animable"></path><path
                          d="M317.76,86.89c.22-.83,1-1.1,1.85-.58L356.39,108a3.83,3.83,0,0,1,1.35,1.46l5.38-3.17a3.91,3.91,0,0,0-1.35-1.46L325,83.14a4.18,4.18,0,0,0-3.83,0l-1.56.92A4.32,4.32,0,0,0,317.76,86.89Z"
                          style="fill: rgb(69, 90, 100); transform-origin: 340.44px 96.0678px 0px;"
                          id="elhgxydalcdsf" class="animable"></path><path
                          d="M345.57,107.15c0,.64-.47.88-1.05.54l-20.63-12.2a2.31,2.31,0,0,1-1.05-1.78c0-.64.47-.88,1.05-.54l20.63,12.2A2.31,2.31,0,0,1,345.57,107.15Z"
                          style="fill: rgb(240, 240, 240); transform-origin: 334.205px 100.43px 0px;"
                          id="elnm441rstfz" class="animable"></path><path
                          d="M353.87,119.3c0,.64-.47.89-1.05.55l-28.93-17.13a2.32,2.32,0,0,1-1.05-1.78c0-.64.47-.89,1.05-.54l28.93,17.12A2.32,2.32,0,0,1,353.87,119.3Z"
                          style="fill: rgb(240, 240, 240); transform-origin: 338.355px 110.122px 0px;"
                          id="elaccge7japz"
                          class="animable"></path></g></g><defs> <filter
                        id="active" height="200%"> <femorphology
                          in="SourceAlpha" result="DILATED" operator="dilate"
                          radius="2"></femorphology> <feflood
                          flood-color="#32DFEC" flood-opacity="1"
                          result="PINK"></feflood> <fecomposite in="PINK"
                          in2="DILATED" operator="in"
                          result="OUTLINE"></fecomposite> <femerge> <femergenode
                            in="OUTLINE"></femergenode> <femergenode
                            in="SourceGraphic"></femergenode> </femerge>
                      </filter> <filter id="hover" height="200%"> <femorphology
                          in="SourceAlpha" result="DILATED" operator="dilate"
                          radius="2"></femorphology> <feflood
                          flood-color="#ff0000" flood-opacity="0.5"
                          result="PINK"></feflood> <fecomposite in="PINK"
                          in2="DILATED" operator="in"
                          result="OUTLINE"></fecomposite> <femerge> <femergenode
                            in="OUTLINE"></femergenode> <femergenode
                            in="SourceGraphic"></femergenode> </femerge>
                        <fecolormatrix type="matrix"
                          values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 "></fecolormatrix>
                      </filter></defs></svg>
                  <div class="card-body p-4">
                    <h4 class="fw-bold mb-4"> Quis autem vel eum voluptate</h4>
                    <p class="text-muted mb-4"><i class="far fa-clock"
                        aria-hidden="true"></i> 2014</p>
                    <p class="mb-0">At vero eos et accusamus et iusto odio
                      dignissimos ducimus qui blanditiis
                      praesentium voluptatum deleniti atque corrupti quos
                      dolores et quas molestias excepturi sint
                      occaecati cupiditate non provident, similique sunt in
                      culpa qui officia deserunt mollitia animi,
                      id est laborum et dolorum fuga. Et harum quidem rerum
                      facilis est et expedita distinctio.</p>
                  </div>
                </div>
              </div>
              <div class="timeline-2 left-2">
                <div class="card">
                  <svg class="animated" id="freepik_stories-signing-a-contract"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500"
                    version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    xmlns:svgjs="http://svgjs.com/svgjs"><style>svg#freepik_stories-signing-a-contract:not(.animated) .animable {opacity: 0;}svg#freepik_stories-signing-a-contract.animated #freepik--Character--inject-39 {animation: 1.5s Infinite  linear shake;animation-delay: 0s;}            @keyframes shake {                10%, 90% {                    transform: translate3d(-1px, 0, 0);                  }                  20%, 80% {                    transform: translate3d(2px, 0, 0);                  }                  30%, 50%, 70% {                    transform: translate3d(-4px, 0, 0);                  }                  40%, 60% {                    transform: translate3d(4px, 0, 0);                  }            }        </style><g
                      id="freepik--background-complete--inject-39"
                      style="transform-origin: 250px 228.23px 0px;"
                      class="animable"><rect y="382.4" width="500" height="0.25"
                        style="fill: rgb(235, 235, 235); transform-origin: 250px 382.525px 0px;"
                        id="elkwaogd52xe" class="animable"></rect><rect
                        x="416.78" y="398.49" width="33.12" height="0.25"
                        style="fill: rgb(235, 235, 235); transform-origin: 433.34px 398.615px 0px;"
                        id="elcowomi2bvzv" class="animable"></rect><rect
                        x="322.53" y="401.21" width="8.69" height="0.25"
                        style="fill: rgb(235, 235, 235); transform-origin: 326.875px 401.335px 0px;"
                        id="elrx8660s5o2q" class="animable"></rect><rect
                        x="396.59" y="389.21" width="19.19" height="0.25"
                        style="fill: rgb(235, 235, 235); transform-origin: 406.185px 389.335px 0px;"
                        id="el5zded170y12" class="animable"></rect><rect
                        x="52.46" y="390.89" width="43.19" height="0.25"
                        style="fill: rgb(235, 235, 235); transform-origin: 74.055px 391.015px 0px;"
                        id="eldve48hkdcvf" class="animable"></rect><rect
                        x="104.56" y="390.89" width="6.33" height="0.25"
                        style="fill: rgb(235, 235, 235); transform-origin: 107.725px 391.015px 0px;"
                        id="elgkxx7z822w7" class="animable"></rect><rect
                        x="131.47" y="395.11" width="93.68" height="0.25"
                        style="fill: rgb(235, 235, 235); transform-origin: 178.31px 395.235px 0px;"
                        id="elqrocnpld9y9" class="animable"></rect><path
                        d="M237,337.8H43.91a5.71,5.71,0,0,1-5.7-5.71V60.66A5.71,5.71,0,0,1,43.91,55H237a5.71,5.71,0,0,1,5.71,5.71V332.09A5.71,5.71,0,0,1,237,337.8ZM43.91,55.2a5.46,5.46,0,0,0-5.45,5.46V332.09a5.46,5.46,0,0,0,5.45,5.46H237a5.47,5.47,0,0,0,5.46-5.46V60.66A5.47,5.47,0,0,0,237,55.2Z"
                        style="fill: rgb(235, 235, 235); transform-origin: 140.46px 196.4px 0px;"
                        id="elhgdj38bnwbf" class="animable"></path><path
                        d="M453.31,337.8H260.21a5.72,5.72,0,0,1-5.71-5.71V60.66A5.72,5.72,0,0,1,260.21,55h193.1A5.71,5.71,0,0,1,459,60.66V332.09A5.71,5.71,0,0,1,453.31,337.8ZM260.21,55.2a5.47,5.47,0,0,0-5.46,5.46V332.09a5.47,5.47,0,0,0,5.46,5.46h193.1a5.47,5.47,0,0,0,5.46-5.46V60.66a5.47,5.47,0,0,0-5.46-5.46Z"
                        style="fill: rgb(235, 235, 235); transform-origin: 356.75px 196.4px 0px;"
                        id="elme004upkwkn" class="animable"></path><rect
                        x="120.76" y="106.14" width="256.03" height="211.4"
                        style="fill: rgb(245, 245, 245); transform-origin: 248.775px 211.84px 0px;"
                        id="el0is8mz70m1cn" class="animable"></rect><rect
                        x="120.76" y="110.62" width="251.92" height="202.62"
                        style="fill: rgb(250, 250, 250); transform-origin: 246.72px 211.93px 0px;"
                        id="elh6jnjs8cngu" class="animable"></rect><polygon
                        points="370.81 255.59 370.81 184.01 363.38 184.01 363.38 174.55 346.64 166.72 346.64 157.04 343.85 157.04 343.85 184.01 341.06 184.01 341.06 255.59 337.35 255.59 337.35 218.41 328.98 218.41 328.98 198.88 326.19 198.88 326.19 255.59 319.68 255.59 319.68 234.21 315.03 234.21 315.03 228.63 304.81 228.63 304.81 209.11 299.23 209.11 299.23 196.09 292.72 196.09 292.72 176.57 289.93 176.57 289.93 196.09 283.42 196.09 283.42 209.11 277.85 209.11 277.85 228.63 267.62 228.63 267.62 234.21 262.97 234.21 262.97 255.59 257.39 255.59 257.39 228.63 247.16 228.63 247.16 169.13 244.38 169.13 244.38 162.62 222.06 162.62 222.06 169.13 217.41 169.13 217.41 211.9 198.82 211.9 198.82 216.55 192.31 216.55 192.31 219.34 198.82 219.34 198.82 236.07 179.3 236.07 179.3 180.29 175.58 180.29 175.58 169.13 166.28 169.13 166.28 126.36 163.49 126.36 163.49 169.13 156.98 169.13 156.98 180.29 120.76 180.29 120.76 313.24 372.67 313.24 372.67 255.59 370.81 255.59"
                        style="fill: rgb(240, 240, 240); transform-origin: 246.715px 219.8px 0px;"
                        id="elmicwvtz1jo" class="animable"></polygon><rect
                        x="140.11" y="183.2" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 141.425px 184.515px 0px;"
                        id="el4qoshdh9rpt" class="animable"></rect><rect
                        x="140.11" y="187.62" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 141.425px 188.935px 0px;"
                        id="el7hzq1ldry97" class="animable"></rect><rect
                        x="140.11" y="205.28" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 141.425px 206.595px 0px;"
                        id="elsraor520eop" class="animable"></rect><rect
                        x="140.11" y="209.7" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 141.425px 211.015px 0px;"
                        id="el58pnq41d0en" class="animable"></rect><rect
                        x="140.11" y="214.11" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 141.425px 215.425px 0px;"
                        id="elii9v0o4vpig" class="animable"></rect><rect
                        x="140.11" y="227.36" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 141.425px 228.675px 0px;"
                        id="elzxzkmiy8wll" class="animable"></rect><rect
                        x="140.11" y="231.78" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 141.425px 233.095px 0px;"
                        id="elybcnx7kv6vh" class="animable"></rect><rect
                        x="144.3" y="200.87" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 145.615px 202.185px 0px;"
                        id="el3v07368snz2" class="animable"></rect><rect
                        x="144.3" y="205.28" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 145.615px 206.595px 0px;"
                        id="el151894fpz5t" class="animable"></rect><rect
                        x="144.3" y="209.7" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 145.615px 211.015px 0px;"
                        id="elfim1qmo3t3e" class="animable"></rect><rect
                        x="144.3" y="214.11" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 145.615px 215.425px 0px;"
                        id="el9ulxd8o6hdh" class="animable"></rect><rect
                        x="144.3" y="218.53" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 145.615px 219.845px 0px;"
                        id="elty7a4j5dpf" class="animable"></rect><rect
                        x="144.3" y="227.36" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 145.615px 228.675px 0px;"
                        id="elod6bmztj1td" class="animable"></rect><rect
                        x="144.3" y="231.78" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 145.615px 233.095px 0px;"
                        id="elj542sdvd7f" class="animable"></rect><rect
                        x="148.48" y="183.2" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 149.795px 184.515px 0px;"
                        id="elk2gsp1c81mf" class="animable"></rect><rect
                        x="148.48" y="187.62" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 149.795px 188.935px 0px;"
                        id="elk0eoqexbg5" class="animable"></rect><rect
                        x="148.48" y="192.03" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 149.795px 193.345px 0px;"
                        id="elqom0oex7rzn" class="animable"></rect><rect
                        x="148.48" y="196.45" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 149.795px 197.765px 0px;"
                        id="elq11yr3d3jgp" class="animable"></rect><rect
                        x="148.48" y="200.87" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 149.795px 202.185px 0px;"
                        id="elurthnh17hc" class="animable"></rect><rect
                        x="148.48" y="205.28" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 149.795px 206.595px 0px;"
                        id="el6k8heslx4wa" class="animable"></rect><rect
                        x="148.48" y="209.7" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 149.795px 211.015px 0px;"
                        id="el7pehlaw8o8r" class="animable"></rect><rect
                        x="148.48" y="214.11" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 149.795px 215.425px 0px;"
                        id="eljayikvqyosq" class="animable"></rect><rect
                        x="148.48" y="218.53" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 149.795px 219.845px 0px;"
                        id="elu5aj7yr63q" class="animable"></rect><rect
                        x="148.48" y="222.95" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 149.795px 224.265px 0px;"
                        id="elza837z72f5" class="animable"></rect><rect
                        x="148.48" y="231.78" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 149.795px 233.095px 0px;"
                        id="el1ooga54za6y" class="animable"></rect><rect
                        x="152.66" y="183.2" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 153.975px 184.515px 0px;"
                        id="elkjtruv1blwc" class="animable"></rect><rect
                        x="152.66" y="187.62" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 153.975px 188.935px 0px;"
                        id="elckxdk0mdydg" class="animable"></rect><rect
                        x="152.66" y="192.03" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 153.975px 193.345px 0px;"
                        id="elfwj4d644g8c" class="animable"></rect><rect
                        x="152.66" y="196.45" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 153.975px 197.765px 0px;"
                        id="ellscfjdvqk8" class="animable"></rect><rect
                        x="152.66" y="200.87" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 153.975px 202.185px 0px;"
                        id="eltqrq5zplfzq" class="animable"></rect><rect
                        x="152.66" y="205.28" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 153.975px 206.595px 0px;"
                        id="eliugt5xaato" class="animable"></rect><rect
                        x="152.66" y="209.7" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 153.975px 211.015px 0px;"
                        id="elpue34zfhins" class="animable"></rect><rect
                        x="152.66" y="249.44" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 153.975px 250.755px 0px;"
                        id="el4grhnjx9sf7" class="animable"></rect><rect
                        x="156.85" y="183.2" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 158.165px 184.515px 0px;"
                        id="el46nakmd04j4" class="animable"></rect><rect
                        x="156.85" y="187.62" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 158.165px 188.935px 0px;"
                        id="el6f5iovv2x1i" class="animable"></rect><rect
                        x="156.85" y="192.03" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 158.165px 193.345px 0px;"
                        id="elnsve1nwi" class="animable"></rect><rect x="156.85"
                        y="196.45" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 158.165px 197.765px 0px;"
                        id="elbf8nmdlka7h" class="animable"></rect><rect
                        x="156.85" y="200.87" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 158.165px 202.185px 0px;"
                        id="el8rv69intyrt" class="animable"></rect><rect
                        x="156.85" y="205.28" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 158.165px 206.595px 0px;"
                        id="elfkuhybmo81h" class="animable"></rect><rect
                        x="156.85" y="209.7" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 158.165px 211.015px 0px;"
                        id="el1gsy2bubx9z" class="animable"></rect><rect
                        x="156.85" y="214.11" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 158.165px 215.425px 0px;"
                        id="elt7dsct38yi" class="animable"></rect><rect
                        x="156.85" y="240.61" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 158.165px 241.925px 0px;"
                        id="elnsrpgo8rl9" class="animable"></rect><rect
                        x="156.85" y="245.03" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 158.165px 246.345px 0px;"
                        id="el7242ty0a25r" class="animable"></rect><rect
                        x="156.85" y="249.44" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 158.165px 250.755px 0px;"
                        id="el12rno0rsuauh" class="animable"></rect><rect
                        x="156.85" y="253.86" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 158.165px 255.175px 0px;"
                        id="elwolezmbjzs" class="animable"></rect><rect
                        x="156.85" y="271.52" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 158.165px 272.835px 0px;"
                        id="elw0t93a74xwg" class="animable"></rect><rect
                        x="161.03" y="183.2" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 184.515px 0px;"
                        id="eltf2hq7jmokg" class="animable"></rect><rect
                        x="161.03" y="187.62" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 188.935px 0px;"
                        id="elymy9pld1pi8" class="animable"></rect><rect
                        x="161.03" y="192.03" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 193.345px 0px;"
                        id="elxgekbcvdblf" class="animable"></rect><rect
                        x="161.03" y="196.45" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 197.765px 0px;"
                        id="el23stcini8ku" class="animable"></rect><rect
                        x="161.03" y="200.87" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 202.185px 0px;"
                        id="el44e9fcd8pil" class="animable"></rect><rect
                        x="161.03" y="205.28" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 206.595px 0px;"
                        id="elbwehcqoh92" class="animable"></rect><rect
                        x="161.03" y="209.7" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 211.015px 0px;"
                        id="elrdddm22r64p" class="animable"></rect><rect
                        x="161.03" y="214.11" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 215.425px 0px;"
                        id="el7hn0wqcbuwo" class="animable"></rect><rect
                        x="161.03" y="218.53" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 219.845px 0px;"
                        id="elpqkb92j43fr" class="animable"></rect><rect
                        x="161.03" y="222.95" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 224.265px 0px;"
                        id="el88vk36xlu1" class="animable"></rect><rect
                        x="161.03" y="236.2" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 237.515px 0px;"
                        id="elpq9li80lvh" class="animable"></rect><rect
                        x="161.03" y="240.61" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 241.925px 0px;"
                        id="elvamoidxck9k" class="animable"></rect><rect
                        x="161.03" y="245.03" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 246.345px 0px;"
                        id="eldig2el7y7p" class="animable"></rect><rect
                        x="161.03" y="249.44" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 250.755px 0px;"
                        id="eltlk8p9th2oh" class="animable"></rect><rect
                        x="161.03" y="253.86" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 255.175px 0px;"
                        id="elnmbywlubuks" class="animable"></rect><rect
                        x="161.03" y="271.52" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 162.345px 272.835px 0px;"
                        id="elkriwvcefg88" class="animable"></rect><rect
                        x="165.22" y="183.2" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 184.515px 0px;"
                        id="el56rfpqx7ty" class="animable"></rect><rect
                        x="165.22" y="187.62" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 188.935px 0px;"
                        id="elv2dzfqoilaa" class="animable"></rect><rect
                        x="165.22" y="192.03" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 193.345px 0px;"
                        id="el7p0npa6das2" class="animable"></rect><rect
                        x="165.22" y="196.45" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 197.765px 0px;"
                        id="elkqs0m528p8q" class="animable"></rect><rect
                        x="165.22" y="200.87" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 202.185px 0px;"
                        id="el9f16jl6o419" class="animable"></rect><rect
                        x="165.22" y="205.28" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 206.595px 0px;"
                        id="elko2q0gmk9ak" class="animable"></rect><rect
                        x="165.22" y="209.7" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 211.015px 0px;"
                        id="elbx0mm76ua6a" class="animable"></rect><rect
                        x="165.22" y="214.11" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 215.425px 0px;"
                        id="el52og1wc52p9" class="animable"></rect><rect
                        x="165.22" y="218.53" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 219.845px 0px;"
                        id="elclzni30a1dc" class="animable"></rect><rect
                        x="165.22" y="222.95" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 224.265px 0px;"
                        id="elby052nx6vfh" class="animable"></rect><rect
                        x="165.22" y="227.36" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 228.675px 0px;"
                        id="eldufrnyxpmy7" class="animable"></rect><rect
                        x="165.22" y="231.78" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 233.095px 0px;"
                        id="eloe5obux8ujc" class="animable"></rect><rect
                        x="165.22" y="236.2" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 237.515px 0px;"
                        id="eliz89jczpva" class="animable"></rect><rect
                        x="165.22" y="240.61" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 241.925px 0px;"
                        id="elckv57cxccmp" class="animable"></rect><rect
                        x="165.22" y="245.03" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 246.345px 0px;"
                        id="el0wo0e1jr4i8p" class="animable"></rect><rect
                        x="165.22" y="249.44" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 250.755px 0px;"
                        id="elhinvelag3bj" class="animable"></rect><rect
                        x="165.22" y="253.86" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 255.175px 0px;"
                        id="elahowgvrijfr" class="animable"></rect><rect
                        x="165.22" y="258.28" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 166.535px 259.595px 0px;"
                        id="eli8z57w009ki" class="animable"></rect><rect
                        x="169.4" y="183.2" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 184.515px 0px;"
                        id="elata3hpqcjz9" class="animable"></rect><rect
                        x="169.4" y="187.62" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 188.935px 0px;"
                        id="el7w7b5tw462i" class="animable"></rect><rect
                        x="169.4" y="192.03" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 193.345px 0px;"
                        id="el4vbx60q70ud" class="animable"></rect><rect
                        x="169.4" y="196.45" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 197.765px 0px;"
                        id="elgzzucdxq4vl" class="animable"></rect><rect
                        x="169.4" y="200.87" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 202.185px 0px;"
                        id="elzqo97idazd" class="animable"></rect><rect
                        x="169.4" y="205.28" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 206.595px 0px;"
                        id="elorbo0bk6dek" class="animable"></rect><rect
                        x="169.4" y="209.7" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 211.015px 0px;"
                        id="elv5o4igboge" class="animable"></rect><rect
                        x="169.4" y="214.11" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 215.425px 0px;"
                        id="elhuhitlhlyw" class="animable"></rect><rect
                        x="169.4" y="218.53" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 219.845px 0px;"
                        id="elxmti5bvxn9p" class="animable"></rect><rect
                        x="169.4" y="222.95" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 224.265px 0px;"
                        id="elrt73zqo9pai" class="animable"></rect><rect
                        x="169.4" y="236.2" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 237.515px 0px;"
                        id="el61j8c7uc7cl" class="animable"></rect><rect
                        x="169.4" y="240.61" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 241.925px 0px;"
                        id="elyofp7r7c6h" class="animable"></rect><rect
                        x="169.4" y="245.03" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 246.345px 0px;"
                        id="elwf6ta42zkpp" class="animable"></rect><rect
                        x="169.4" y="249.44" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.715px 250.755px 0px;"
                        id="el5clml3l40a3" class="animable"></rect><rect
                        x="173.58" y="183.2" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.895px 184.515px 0px;"
                        id="elc8viwwkfwyr" class="animable"></rect><rect
                        x="173.58" y="187.62" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.895px 188.935px 0px;"
                        id="elcdxqfmx4dak" class="animable"></rect><rect
                        x="173.58" y="192.03" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.895px 193.345px 0px;"
                        id="elbqy5extr2zk" class="animable"></rect><rect
                        x="173.58" y="196.45" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.895px 197.765px 0px;"
                        id="elykr5p9z811" class="animable"></rect><rect
                        x="173.58" y="200.87" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.895px 202.185px 0px;"
                        id="eln8ibj7wtmqn" class="animable"></rect><rect
                        x="173.58" y="205.28" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.895px 206.595px 0px;"
                        id="elq86peqyjsf8" class="animable"></rect><rect
                        x="173.58" y="209.7" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.895px 211.015px 0px;"
                        id="eln4edza6n6w" class="animable"></rect><rect
                        x="173.58" y="214.11" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.895px 215.425px 0px;"
                        id="el8p7183134w" class="animable"></rect><rect
                        x="173.58" y="218.53" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.895px 219.845px 0px;"
                        id="elv7n3rcxh0ih" class="animable"></rect><rect
                        x="173.58" y="222.95" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.895px 224.265px 0px;"
                        id="elshu77wldb3" class="animable"></rect><rect
                        x="173.58" y="236.2" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.895px 237.515px 0px;"
                        id="elfgqd2826pxr" class="animable"></rect><rect
                        x="173.58" y="240.61" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.895px 241.925px 0px;"
                        id="el99vvc75wy1o" class="animable"></rect><rect
                        x="173.58" y="245.03" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.895px 246.345px 0px;"
                        id="elz65wlxwao5h" class="animable"></rect><rect
                        x="220.69" y="171.74" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 222.005px 173.055px 0px;"
                        id="elc32oc7ryzls" class="animable"></rect><rect
                        x="220.69" y="176.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 222.005px 177.465px 0px;"
                        id="elgvfin30wd7" class="animable"></rect><rect
                        x="220.69" y="180.57" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 222.005px 181.885px 0px;"
                        id="el1zms4fddkg4" class="animable"></rect><rect
                        x="220.69" y="184.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 222.005px 186.295px 0px;"
                        id="elvraq7t7irqs" class="animable"></rect><rect
                        x="220.69" y="189.4" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 222.005px 190.715px 0px;"
                        id="elyy7jwy0jae" class="animable"></rect><rect
                        x="220.69" y="193.82" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 222.005px 195.135px 0px;"
                        id="el9duzlotya5f" class="animable"></rect><rect
                        x="220.69" y="198.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 222.005px 199.545px 0px;"
                        id="eli00e8aw0v2" class="animable"></rect><rect
                        x="220.69" y="202.65" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 222.005px 203.965px 0px;"
                        id="elir1u8g703y" class="animable"></rect><rect
                        x="220.69" y="215.9" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 222.005px 217.215px 0px;"
                        id="elvug7jv9zxq8" class="animable"></rect><rect
                        x="220.69" y="220.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 222.005px 221.625px 0px;"
                        id="elw0pj1w5ljp" class="animable"></rect><rect
                        x="224.87" y="171.74" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 226.185px 173.055px 0px;"
                        id="el9k9b4dcfozk" class="animable"></rect><rect
                        x="224.87" y="176.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 226.185px 177.465px 0px;"
                        id="elw3a5scchw7q" class="animable"></rect><rect
                        x="224.87" y="180.57" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 226.185px 181.885px 0px;"
                        id="el38oxnrql0h" class="animable"></rect><rect
                        x="224.87" y="184.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 226.185px 186.295px 0px;"
                        id="el4fqepzuuu4u" class="animable"></rect><rect
                        x="224.87" y="189.4" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 226.185px 190.715px 0px;"
                        id="elu5yp2rkib2h" class="animable"></rect><rect
                        x="224.87" y="193.82" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 226.185px 195.135px 0px;"
                        id="elury74rmrkol" class="animable"></rect><rect
                        x="224.87" y="198.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 226.185px 199.545px 0px;"
                        id="eljhr9eg7w9r" class="animable"></rect><rect
                        x="224.87" y="202.65" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 226.185px 203.965px 0px;"
                        id="elhkur4zevohd" class="animable"></rect><rect
                        x="224.87" y="220.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 226.185px 221.625px 0px;"
                        id="eltqzoidf0o8f" class="animable"></rect><rect
                        x="229.06" y="171.74" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 230.375px 173.055px 0px;"
                        id="elnj2fke2yo9" class="animable"></rect><rect
                        x="229.06" y="176.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 230.375px 177.465px 0px;"
                        id="el4xe772x7mk6" class="animable"></rect><rect
                        x="229.06" y="180.57" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 230.375px 181.885px 0px;"
                        id="eleil19ysugd" class="animable"></rect><rect
                        x="229.06" y="184.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 230.375px 186.295px 0px;"
                        id="elqe02sy34ujk" class="animable"></rect><rect
                        x="229.06" y="189.4" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 230.375px 190.715px 0px;"
                        id="elc09d9xrqude" class="animable"></rect><rect
                        x="229.06" y="193.82" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 230.375px 195.135px 0px;"
                        id="elc4z2yhvn77" class="animable"></rect><rect
                        x="229.06" y="198.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 230.375px 199.545px 0px;"
                        id="elecazlca2226" class="animable"></rect><rect
                        x="229.06" y="202.65" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 230.375px 203.965px 0px;"
                        id="el7xfvztux82e" class="animable"></rect><rect
                        x="233.24" y="171.74" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 173.055px 0px;"
                        id="elao1ux8t8kra" class="animable"></rect><rect
                        x="233.24" y="176.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 177.465px 0px;"
                        id="eley6ip0u0fng" class="animable"></rect><rect
                        x="233.24" y="180.57" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 181.885px 0px;"
                        id="elejaur0wyunm" class="animable"></rect><rect
                        x="233.24" y="184.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 186.295px 0px;"
                        id="el2if3b5u45sf" class="animable"></rect><rect
                        x="233.24" y="189.4" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 190.715px 0px;"
                        id="elij483v6fyck" class="animable"></rect><rect
                        x="233.24" y="193.82" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 195.135px 0px;"
                        id="elx8ufw41jr5i" class="animable"></rect><rect
                        x="233.24" y="202.65" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 203.965px 0px;"
                        id="el6bhgtcaw5gg" class="animable"></rect><rect
                        x="233.24" y="207.06" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 208.375px 0px;"
                        id="elc47buzgjhgq" class="animable"></rect><rect
                        x="233.24" y="220.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 221.625px 0px;"
                        id="elrbza7rl48fk" class="animable"></rect><rect
                        x="233.24" y="224.73" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 226.045px 0px;"
                        id="elnyvv6414md" class="animable"></rect><rect
                        x="233.24" y="229.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 230.465px 0px;"
                        id="elaumfvwhorb5" class="animable"></rect><rect
                        x="233.24" y="233.56" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 234.875px 0px;"
                        id="el26tstpwlt7g" class="animable"></rect><rect
                        x="233.24" y="237.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 239.295px 0px;"
                        id="el9726hafa3a" class="animable"></rect><rect
                        x="233.24" y="242.39" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 243.705px 0px;"
                        id="el6o4r541mz32" class="animable"></rect><rect
                        x="233.24" y="246.81" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 234.555px 248.125px 0px;"
                        id="elrc36ghdy50b" class="animable"></rect><rect
                        x="237.42" y="171.74" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 173.055px 0px;"
                        id="eld73kjxposw" class="animable"></rect><rect
                        x="237.42" y="176.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 177.465px 0px;"
                        id="elo915afrraqs" class="animable"></rect><rect
                        x="237.42" y="180.57" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 181.885px 0px;"
                        id="elqj5jraf5d9s" class="animable"></rect><rect
                        x="237.42" y="184.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 186.295px 0px;"
                        id="elrovs29jdccf" class="animable"></rect><rect
                        x="237.42" y="189.4" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 190.715px 0px;"
                        id="el2ptax1cv3un" class="animable"></rect><rect
                        x="237.42" y="193.82" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 195.135px 0px;"
                        id="elpzmozzwihh" class="animable"></rect><rect
                        x="237.42" y="207.06" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 208.375px 0px;"
                        id="elgb1082afutb" class="animable"></rect><rect
                        x="237.42" y="211.48" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 212.795px 0px;"
                        id="elx3lnq0ladzh" class="animable"></rect><rect
                        x="237.42" y="215.9" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 217.215px 0px;"
                        id="el7b08sk7pdc4" class="animable"></rect><rect
                        x="237.42" y="220.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 221.625px 0px;"
                        id="elwt37yg3uev" class="animable"></rect><rect
                        x="237.42" y="224.73" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 226.045px 0px;"
                        id="elg6gez5zgtr5" class="animable"></rect><rect
                        x="237.42" y="229.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 230.465px 0px;"
                        id="elx8v75l82oun" class="animable"></rect><rect
                        x="237.42" y="233.56" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 234.875px 0px;"
                        id="eln0n7gngcxtp" class="animable"></rect><rect
                        x="237.42" y="237.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 239.295px 0px;"
                        id="ele582q2vpy7j" class="animable"></rect><rect
                        x="237.42" y="242.39" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 243.705px 0px;"
                        id="elpruv97vu1nc" class="animable"></rect><rect
                        x="237.42" y="246.81" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 248.125px 0px;"
                        id="elg4ab0cvk0b" class="animable"></rect><rect
                        x="237.42" y="251.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 252.545px 0px;"
                        id="elp2xba2art0f" class="animable"></rect><rect
                        x="237.42" y="260.06" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 238.735px 261.375px 0px;"
                        id="elax835druhrm" class="animable"></rect><rect
                        x="241.61" y="171.74" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 173.055px 0px;"
                        id="eluboj3ld0ndg" class="animable"></rect><rect
                        x="241.61" y="176.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 177.465px 0px;"
                        id="el4hd25ad7z8k" class="animable"></rect><rect
                        x="241.61" y="180.57" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 181.885px 0px;"
                        id="el8xwme56lm99" class="animable"></rect><rect
                        x="241.61" y="184.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 186.295px 0px;"
                        id="el8gimi8tfkz9" class="animable"></rect><rect
                        x="241.61" y="189.4" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 190.715px 0px;"
                        id="el913a3gk072n" class="animable"></rect><rect
                        x="241.61" y="193.82" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 195.135px 0px;"
                        id="el2x16b9x9em1" class="animable"></rect><rect
                        x="241.61" y="207.06" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 208.375px 0px;"
                        id="elc5ymsg9a55i" class="animable"></rect><rect
                        x="241.61" y="211.48" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 212.795px 0px;"
                        id="elg94rd3sru44" class="animable"></rect><rect
                        x="241.61" y="215.9" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 217.215px 0px;"
                        id="el5d0kfjq60b" class="animable"></rect><rect
                        x="241.61" y="220.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 221.625px 0px;"
                        id="elixwaj9rw14" class="animable"></rect><rect
                        x="241.61" y="233.56" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 234.875px 0px;"
                        id="elw9z6ywfkrzq" class="animable"></rect><rect
                        x="241.61" y="237.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 239.295px 0px;"
                        id="elfkytjmo3k3l" class="animable"></rect><rect
                        x="241.61" y="242.39" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 243.705px 0px;"
                        id="elwe5o1a6h3jh" class="animable"></rect><rect
                        x="241.61" y="246.81" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 248.125px 0px;"
                        id="elns7gjuw9nxl" class="animable"></rect><rect
                        x="241.61" y="251.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 252.545px 0px;"
                        id="eloa34z9no0ba" class="animable"></rect><rect
                        x="241.61" y="260.06" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 261.375px 0px;"
                        id="elzwowyh1qy4c" class="animable"></rect><rect
                        x="241.61" y="264.47" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 242.925px 265.785px 0px;"
                        id="elth5lb5sue8k" class="animable"></rect><rect
                        x="279.57" y="212.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 280.885px 214.115px 0px;"
                        id="elu70n2khp9ca" class="animable"></rect><rect
                        x="279.57" y="217.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 280.885px 218.525px 0px;"
                        id="el7cp9tsqvt79" class="animable"></rect><rect
                        x="279.57" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 280.885px 222.945px 0px;"
                        id="ellef7k91y0us" class="animable"></rect><rect
                        x="279.57" y="226.05" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 280.885px 227.365px 0px;"
                        id="elx14ca3gddd" class="animable"></rect><rect
                        x="279.57" y="230.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 280.885px 231.775px 0px;"
                        id="elj3lt8hbdnf" class="animable"></rect><rect
                        x="279.57" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 280.885px 236.195px 0px;"
                        id="el27u9rl63r5e" class="animable"></rect><rect
                        x="279.57" y="239.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 280.885px 240.605px 0px;"
                        id="elttavzdje1e" class="animable"></rect><rect
                        x="279.57" y="252.54" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 280.885px 253.855px 0px;"
                        id="el2le6k86vbnp" class="animable"></rect><rect
                        x="279.57" y="256.96" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 280.885px 258.275px 0px;"
                        id="elpkfv5dj0a1a" class="animable"></rect><rect
                        x="279.57" y="261.37" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 280.885px 262.685px 0px;"
                        id="el0445fq8xui2c" class="animable"></rect><rect
                        x="283.75" y="212.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 285.065px 214.115px 0px;"
                        id="elpsbttf34v6g" class="animable"></rect><rect
                        x="283.75" y="217.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 285.065px 218.525px 0px;"
                        id="elsgcs9adjyn" class="animable"></rect><rect
                        x="283.75" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 285.065px 222.945px 0px;"
                        id="elc44oxefw9mm" class="animable"></rect><rect
                        x="283.75" y="226.05" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 285.065px 227.365px 0px;"
                        id="el5kybby3r17q" class="animable"></rect><rect
                        x="283.75" y="230.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 285.065px 231.775px 0px;"
                        id="el5fucz767hyk" class="animable"></rect><rect
                        x="283.75" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 285.065px 236.195px 0px;"
                        id="ely5z509i937" class="animable"></rect><rect
                        x="283.75" y="239.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 285.065px 240.605px 0px;"
                        id="el9xffoindfih" class="animable"></rect><rect
                        x="287.94" y="212.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 289.255px 214.115px 0px;"
                        id="elpuu4miu6w17" class="animable"></rect><rect
                        x="287.94" y="217.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 289.255px 218.525px 0px;"
                        id="elf0k00y131jd" class="animable"></rect><rect
                        x="287.94" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 289.255px 222.945px 0px;"
                        id="elv9qnpj6wex9" class="animable"></rect><rect
                        x="287.94" y="226.05" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 289.255px 227.365px 0px;"
                        id="elsngs4uz9td" class="animable"></rect><rect
                        x="287.94" y="230.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 289.255px 231.775px 0px;"
                        id="el36ksw8qo5u8" class="animable"></rect><rect
                        x="287.94" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 289.255px 236.195px 0px;"
                        id="el9ilr91518u6" class="animable"></rect><rect
                        x="287.94" y="239.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 289.255px 240.605px 0px;"
                        id="el4f3sjmn0apj" class="animable"></rect><rect
                        x="292.12" y="212.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 293.435px 214.115px 0px;"
                        id="elbydncfnk2m7" class="animable"></rect><rect
                        x="292.12" y="217.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 293.435px 218.525px 0px;"
                        id="eltmrymmu8ib" class="animable"></rect><rect
                        x="292.12" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 293.435px 222.945px 0px;"
                        id="elq7al0epcmz" class="animable"></rect><rect
                        x="292.12" y="226.05" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 293.435px 227.365px 0px;"
                        id="elfb4nnaqscdr" class="animable"></rect><rect
                        x="292.12" y="230.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 293.435px 231.775px 0px;"
                        id="elsr03vkuqcd" class="animable"></rect><rect
                        x="292.12" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 293.435px 236.195px 0px;"
                        id="el40563m3ald6" class="animable"></rect><rect
                        x="292.12" y="239.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 293.435px 240.605px 0px;"
                        id="el41ufvewid4s" class="animable"></rect><rect
                        x="292.12" y="243.71" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 293.435px 245.025px 0px;"
                        id="elydqqvo0qr" class="animable"></rect><rect
                        x="292.12" y="248.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 293.435px 249.445px 0px;"
                        id="elf022sa3pfzv" class="animable"></rect><rect
                        x="292.12" y="252.54" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 293.435px 253.855px 0px;"
                        id="ellt2kzpjffc" class="animable"></rect><rect
                        x="292.12" y="256.96" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 293.435px 258.275px 0px;"
                        id="elmcy7emvvt4" class="animable"></rect><rect
                        x="296.3" y="212.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 214.115px 0px;"
                        id="el5olvaq6yp4" class="animable"></rect><rect
                        x="296.3" y="217.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 218.525px 0px;"
                        id="elurwm1y368rb" class="animable"></rect><rect
                        x="296.3" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 222.945px 0px;"
                        id="elszzdgpns26k" class="animable"></rect><rect
                        x="296.3" y="226.05" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 227.365px 0px;"
                        id="el1s30hrlbb8h" class="animable"></rect><rect
                        x="296.3" y="230.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 231.775px 0px;"
                        id="el3fbn5uhii4" class="animable"></rect><rect
                        x="296.3" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 236.195px 0px;"
                        id="el5af7l5cnluw" class="animable"></rect><rect
                        x="296.3" y="239.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 240.605px 0px;"
                        id="elwvqoinnms0d" class="animable"></rect><rect
                        x="296.3" y="243.71" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 245.025px 0px;"
                        id="eltieqku4xtoe" class="animable"></rect><rect
                        x="296.3" y="248.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 249.445px 0px;"
                        id="elznjon84f36" class="animable"></rect><rect
                        x="296.3" y="252.54" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 253.855px 0px;"
                        id="el1t514jmy808" class="animable"></rect><rect
                        x="296.3" y="256.96" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 258.275px 0px;"
                        id="elskmcqjqsrhp" class="animable"></rect><rect
                        x="296.3" y="261.37" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 262.685px 0px;"
                        id="elao8qf72zfg" class="animable"></rect><rect
                        x="296.3" y="274.62" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 275.935px 0px;"
                        id="elmm1c3dvfdx" class="animable"></rect><rect
                        x="296.3" y="279.04" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 297.615px 280.355px 0px;"
                        id="el99682blhame" class="animable"></rect><rect
                        x="300.49" y="212.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 301.805px 214.115px 0px;"
                        id="elnzyktab5jq8" class="animable"></rect><rect
                        x="300.49" y="217.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 301.805px 218.525px 0px;"
                        id="eloq3tb76b06" class="animable"></rect><rect
                        x="300.49" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 301.805px 222.945px 0px;"
                        id="elpioer4cjyqh" class="animable"></rect><rect
                        x="300.49" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 301.805px 236.195px 0px;"
                        id="el47rvi1z171q" class="animable"></rect><rect
                        x="300.49" y="239.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 301.805px 240.605px 0px;"
                        id="elwqootzje3bn" class="animable"></rect><rect
                        x="300.49" y="243.71" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 301.805px 245.025px 0px;"
                        id="eljcvmc6e8gm" class="animable"></rect><rect
                        x="300.49" y="248.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 301.805px 249.445px 0px;"
                        id="eln72onksksip" class="animable"></rect><rect
                        x="300.49" y="252.54" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 301.805px 253.855px 0px;"
                        id="eljzni5ymgcuj" class="animable"></rect><rect
                        x="300.49" y="256.96" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 301.805px 258.275px 0px;"
                        id="eluxjsedc5dhs" class="animable"></rect><rect
                        x="300.49" y="261.37" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 301.805px 262.685px 0px;"
                        id="elwde629t4rd7" class="animable"></rect><rect
                        x="300.49" y="274.62" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 301.805px 275.935px 0px;"
                        id="elig3fu6m31mi" class="animable"></rect><rect
                        x="300.49" y="279.04" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 301.805px 280.355px 0px;"
                        id="elqp8joou92na" class="animable"></rect><rect
                        x="300.49" y="283.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 301.805px 284.775px 0px;"
                        id="els901x5mikan" class="animable"></rect><rect
                        x="344.34" y="186.3" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 187.615px 0px;"
                        id="el0hoxpeisoor" class="animable"></rect><rect
                        x="344.34" y="190.72" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 192.035px 0px;"
                        id="elk5vxrj2gmo" class="animable"></rect><rect
                        x="344.34" y="195.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 196.445px 0px;"
                        id="eltwdr8mqr21" class="animable"></rect><rect
                        x="344.34" y="199.55" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 200.865px 0px;"
                        id="elevfymfppxzv" class="animable"></rect><rect
                        x="344.34" y="203.97" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 205.285px 0px;"
                        id="el9v16o8yklo" class="animable"></rect><rect
                        x="344.34" y="208.38" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 209.695px 0px;"
                        id="elm4ngucnye6" class="animable"></rect><rect
                        x="344.34" y="212.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 214.115px 0px;"
                        id="eliger8olfwun" class="animable"></rect><rect
                        x="344.34" y="217.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 218.525px 0px;"
                        id="el6010zlxttyo" class="animable"></rect><rect
                        x="344.34" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 222.945px 0px;"
                        id="eluno9jbhwx6i" class="animable"></rect><rect
                        x="344.34" y="226.05" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 227.365px 0px;"
                        id="eldjjp6rqs51" class="animable"></rect><rect
                        x="344.34" y="230.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 231.775px 0px;"
                        id="elxpj1izc782" class="animable"></rect><rect
                        x="344.34" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 236.195px 0px;"
                        id="elo615ooajgw" class="animable"></rect><rect
                        x="344.34" y="239.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 240.605px 0px;"
                        id="el4i47cfg0j1f" class="animable"></rect><rect
                        x="344.34" y="243.71" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 245.025px 0px;"
                        id="el0xdeiapyu7wj" class="animable"></rect><rect
                        x="344.34" y="248.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 249.445px 0px;"
                        id="els1h8bibqtme" class="animable"></rect><rect
                        x="344.34" y="252.54" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 253.855px 0px;"
                        id="elx44ewisjrsc" class="animable"></rect><rect
                        x="344.34" y="256.96" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 258.275px 0px;"
                        id="elbq799ob0d95" class="animable"></rect><rect
                        x="344.34" y="261.37" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 262.685px 0px;"
                        id="el21mcbwkyggm" class="animable"></rect><rect
                        x="344.34" y="265.79" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 267.105px 0px;"
                        id="eld2cco7fatsd" class="animable"></rect><rect
                        x="344.34" y="270.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 271.525px 0px;"
                        id="elyoboe8k9l8" class="animable"></rect><rect
                        x="344.34" y="274.62" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 275.935px 0px;"
                        id="elefns7jsth56" class="animable"></rect><rect
                        x="344.34" y="279.04" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 280.355px 0px;"
                        id="elzmg6b5t1da" class="animable"></rect><rect
                        x="344.34" y="283.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 345.655px 284.775px 0px;"
                        id="elk47ysybwsgl" class="animable"></rect><rect
                        x="348.52" y="186.3" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 187.615px 0px;"
                        id="elzmjfet36kys" class="animable"></rect><rect
                        x="348.52" y="190.72" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 192.035px 0px;"
                        id="eldolh3cllmch" class="animable"></rect><rect
                        x="348.52" y="195.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 196.445px 0px;"
                        id="ely79ki0hiug9" class="animable"></rect><rect
                        x="348.52" y="199.55" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 200.865px 0px;"
                        id="elcaa5hbpscxo" class="animable"></rect><rect
                        x="348.52" y="203.97" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 205.285px 0px;"
                        id="el0ihwhjadcoel" class="animable"></rect><rect
                        x="348.52" y="208.38" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 209.695px 0px;"
                        id="elpzle7xou6yq" class="animable"></rect><rect
                        x="348.52" y="212.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 214.115px 0px;"
                        id="elgdjy5rr6xvg" class="animable"></rect><rect
                        x="348.52" y="217.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 218.525px 0px;"
                        id="elxc78ly8sdr" class="animable"></rect><rect
                        x="348.52" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 222.945px 0px;"
                        id="elhyf4xzj6oi" class="animable"></rect><rect
                        x="348.52" y="226.05" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 227.365px 0px;"
                        id="elcjs54c89h3j" class="animable"></rect><rect
                        x="348.52" y="230.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 231.775px 0px;"
                        id="elm6p1vjo879a" class="animable"></rect><rect
                        x="348.52" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 236.195px 0px;"
                        id="elth1aqpj1skf" class="animable"></rect><rect
                        x="348.52" y="239.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 240.605px 0px;"
                        id="el799hlbk7axp" class="animable"></rect><rect
                        x="348.52" y="243.71" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 245.025px 0px;"
                        id="eld7x244m6w8t" class="animable"></rect><rect
                        x="348.52" y="248.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 249.445px 0px;"
                        id="eln2eae0w0vy" class="animable"></rect><rect
                        x="348.52" y="252.54" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 253.855px 0px;"
                        id="el0zwns9rcqgsn" class="animable"></rect><rect
                        x="348.52" y="256.96" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 258.275px 0px;"
                        id="eliq6ynr1ftf" class="animable"></rect><rect
                        x="348.52" y="261.37" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 262.685px 0px;"
                        id="elzo9u5ip5mt9" class="animable"></rect><rect
                        x="348.52" y="265.79" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 349.835px 267.105px 0px;"
                        id="elpimv47s4yb" class="animable"></rect><rect
                        x="352.71" y="186.3" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 187.615px 0px;"
                        id="eldlcsymbxpk" class="animable"></rect><rect
                        x="352.71" y="190.72" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 192.035px 0px;"
                        id="elb4wkoxbvu07" class="animable"></rect><rect
                        x="352.71" y="195.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 196.445px 0px;"
                        id="elitujo1nrrld" class="animable"></rect><rect
                        x="352.71" y="199.55" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 200.865px 0px;"
                        id="eltr36ao4xupi" class="animable"></rect><rect
                        x="352.71" y="203.97" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 205.285px 0px;"
                        id="elhqfnm8ysv2" class="animable"></rect><rect
                        x="352.71" y="208.38" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 209.695px 0px;"
                        id="eldri2kdsufxf" class="animable"></rect><rect
                        x="352.71" y="212.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 214.115px 0px;"
                        id="elw11nrm2n1ha" class="animable"></rect><rect
                        x="352.71" y="217.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 218.525px 0px;"
                        id="eluek2zm6k1pd" class="animable"></rect><rect
                        x="352.71" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 222.945px 0px;"
                        id="el4mgfsfbfkx" class="animable"></rect><rect
                        x="352.71" y="226.05" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 227.365px 0px;"
                        id="elkguqu99tcwe" class="animable"></rect><rect
                        x="352.71" y="230.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 231.775px 0px;"
                        id="el2gxpmp51qvw" class="animable"></rect><rect
                        x="352.71" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 236.195px 0px;"
                        id="eltyqszsbqp2k" class="animable"></rect><rect
                        x="352.71" y="239.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 240.605px 0px;"
                        id="el3dps71b6qy" class="animable"></rect><rect
                        x="352.71" y="243.71" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 245.025px 0px;"
                        id="el7f6458mrjq6" class="animable"></rect><rect
                        x="352.71" y="248.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 249.445px 0px;"
                        id="elnitk2gtrxm" class="animable"></rect><rect
                        x="352.71" y="252.54" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 253.855px 0px;"
                        id="eliuvxayiqma" class="animable"></rect><rect
                        x="352.71" y="256.96" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 258.275px 0px;"
                        id="elm0gttt5loqh" class="animable"></rect><rect
                        x="352.71" y="261.37" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 262.685px 0px;"
                        id="elay3sf22jcc" class="animable"></rect><rect
                        x="352.71" y="265.79" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 354.025px 267.105px 0px;"
                        id="elxl1c71r1tf" class="animable"></rect><rect
                        x="356.89" y="186.3" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 187.615px 0px;"
                        id="elsofgbpjhf0i" class="animable"></rect><rect
                        x="356.89" y="190.72" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 192.035px 0px;"
                        id="elcbvpxrtozck" class="animable"></rect><rect
                        x="356.89" y="195.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 196.445px 0px;"
                        id="elea12nwxm9um" class="animable"></rect><rect
                        x="356.89" y="199.55" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 200.865px 0px;"
                        id="elinn8uir923" class="animable"></rect><rect
                        x="356.89" y="203.97" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 205.285px 0px;"
                        id="elnnnep2utoi" class="animable"></rect><rect
                        x="356.89" y="208.38" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 209.695px 0px;"
                        id="ella1nfr84kt" class="animable"></rect><rect
                        x="356.89" y="212.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 214.115px 0px;"
                        id="el1ldfydx74gm" class="animable"></rect><rect
                        x="356.89" y="217.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 218.525px 0px;"
                        id="eldvkaq1wirv" class="animable"></rect><rect
                        x="356.89" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 222.945px 0px;"
                        id="elnrfti1imt5" class="animable"></rect><rect
                        x="356.89" y="226.05" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 227.365px 0px;"
                        id="elrgq329rc6gd" class="animable"></rect><rect
                        x="356.89" y="230.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 231.775px 0px;"
                        id="elot38ojmnjc" class="animable"></rect><rect
                        x="356.89" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 236.195px 0px;"
                        id="el3ab7yhiczm9" class="animable"></rect><rect
                        x="356.89" y="239.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 240.605px 0px;"
                        id="el9s3oo0psadg" class="animable"></rect><rect
                        x="356.89" y="243.71" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 245.025px 0px;"
                        id="el5gk8voi1rfg" class="animable"></rect><rect
                        x="356.89" y="248.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 358.205px 249.445px 0px;"
                        id="elzsr6b58t1da" class="animable"></rect><rect
                        x="361.07" y="186.3" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 362.385px 187.615px 0px;"
                        id="elmtt5ecy3evf" class="animable"></rect><rect
                        x="361.07" y="190.72" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 362.385px 192.035px 0px;"
                        id="el52k3wv3twjr" class="animable"></rect><rect
                        x="361.07" y="195.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 362.385px 196.445px 0px;"
                        id="elyhfnqs4j8gg" class="animable"></rect><rect
                        x="361.07" y="199.55" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 362.385px 200.865px 0px;"
                        id="eli1qgqzhx0z8" class="animable"></rect><rect
                        x="361.07" y="203.97" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 362.385px 205.285px 0px;"
                        id="el14tpuwqx0dt" class="animable"></rect><rect
                        x="361.07" y="208.38" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 362.385px 209.695px 0px;"
                        id="elgobgajpn3l" class="animable"></rect><rect
                        x="361.07" y="212.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 362.385px 214.115px 0px;"
                        id="elukccl323m4" class="animable"></rect><rect
                        x="361.07" y="217.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 362.385px 218.525px 0px;"
                        id="el20gi4r7cvjs" class="animable"></rect><rect
                        x="361.07" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 362.385px 222.945px 0px;"
                        id="elfqxrnp3ud0q" class="animable"></rect><rect
                        x="361.07" y="226.05" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 362.385px 227.365px 0px;"
                        id="elk4a71h9smj" class="animable"></rect><rect
                        x="361.07" y="230.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 362.385px 231.775px 0px;"
                        id="elcucqyjfvszg" class="animable"></rect><rect
                        x="361.07" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 362.385px 236.195px 0px;"
                        id="eli9ayoia40i8" class="animable"></rect><rect
                        x="361.07" y="239.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 362.385px 240.605px 0px;"
                        id="eljhb0i8zhlie" class="animable"></rect><rect
                        x="365.26" y="186.3" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 366.575px 187.615px 0px;"
                        id="elos9k2po60rm" class="animable"></rect><rect
                        x="365.26" y="190.72" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 366.575px 192.035px 0px;"
                        id="el30qx8aww0l9" class="animable"></rect><rect
                        x="365.26" y="195.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 366.575px 196.445px 0px;"
                        id="el9rja0q59mr8" class="animable"></rect><rect
                        x="365.26" y="199.55" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 366.575px 200.865px 0px;"
                        id="elstujvq2f8uf" class="animable"></rect><rect
                        x="365.26" y="203.97" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 366.575px 205.285px 0px;"
                        id="ele447hc0z8qs" class="animable"></rect><rect
                        x="365.26" y="208.38" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 366.575px 209.695px 0px;"
                        id="elhhwd0aojw7s" class="animable"></rect><rect
                        x="365.26" y="212.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 366.575px 214.115px 0px;"
                        id="elacbhcoauskl" class="animable"></rect><rect
                        x="365.26" y="217.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 366.575px 218.525px 0px;"
                        id="elu9hd5tjzh1" class="animable"></rect><rect
                        x="365.26" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 366.575px 222.945px 0px;"
                        id="el6hdxxhbns89" class="animable"></rect><rect
                        x="365.26" y="226.05" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 366.575px 227.365px 0px;"
                        id="el9b7ikehm1n" class="animable"></rect><rect
                        x="365.26" y="230.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 366.575px 231.775px 0px;"
                        id="eloat69j6w65" class="animable"></rect><rect
                        x="365.26" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 366.575px 236.195px 0px;"
                        id="ela8x10zwteus" class="animable"></rect><rect
                        x="121.06" y="184.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 186.295px 0px;"
                        id="el0hho8jiqvz5a" class="animable"></rect><rect
                        x="121.06" y="189.4" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 190.715px 0px;"
                        id="elu9mllwkc28e" class="animable"></rect><rect
                        x="121.06" y="193.82" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 195.135px 0px;"
                        id="elptbm7fgl4np" class="animable"></rect><rect
                        x="121.06" y="198.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 199.545px 0px;"
                        id="elyezkbrep9g" class="animable"></rect><rect
                        x="121.06" y="202.65" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 203.965px 0px;"
                        id="el6mw4upzx0m8" class="animable"></rect><rect
                        x="121.06" y="207.06" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 208.375px 0px;"
                        id="elsb0dsz9tuv" class="animable"></rect><rect
                        x="121.06" y="211.48" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 212.795px 0px;"
                        id="elvipm8fb3u0h" class="animable"></rect><rect
                        x="121.06" y="215.9" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 217.215px 0px;"
                        id="elesujkfkb0d7" class="animable"></rect><rect
                        x="121.06" y="220.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 221.625px 0px;"
                        id="eli90xr8sk39" class="animable"></rect><rect
                        x="121.06" y="224.73" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 226.045px 0px;"
                        id="elnnhyq5cxuah" class="animable"></rect><rect
                        x="121.06" y="229.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 230.465px 0px;"
                        id="elz15g5zbzyzk" class="animable"></rect><rect
                        x="121.06" y="233.56" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 234.875px 0px;"
                        id="elxfstxqcqrfm" class="animable"></rect><rect
                        x="121.06" y="237.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 239.295px 0px;"
                        id="elhnb6dnt6f3" class="animable"></rect><rect
                        x="121.06" y="242.39" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 243.705px 0px;"
                        id="elyzk41wm6eye" class="animable"></rect><rect
                        x="121.06" y="246.81" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 248.125px 0px;"
                        id="els1ftgryxoge" class="animable"></rect><rect
                        x="121.06" y="251.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 252.545px 0px;"
                        id="elggnsx7jvjs6" class="animable"></rect><rect
                        x="121.06" y="255.64" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 256.955px 0px;"
                        id="elto15gc76w3n" class="animable"></rect><rect
                        x="121.06" y="264.47" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 265.785px 0px;"
                        id="elfkkvazcyqfb" class="animable"></rect><rect
                        x="121.06" y="268.89" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 270.205px 0px;"
                        id="el2v6fe9zbsar" class="animable"></rect><rect
                        x="121.06" y="273.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 274.625px 0px;"
                        id="el3nodb5ehj4i" class="animable"></rect><rect
                        x="121.06" y="277.72" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 279.035px 0px;"
                        id="elumr0s9xaizp" class="animable"></rect><rect
                        x="121.06" y="282.14" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 122.375px 283.455px 0px;"
                        id="elag5csysalcv" class="animable"></rect><rect
                        x="125.24" y="184.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 186.295px 0px;"
                        id="el91lnpe6lb7g" class="animable"></rect><rect
                        x="125.24" y="189.4" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 190.715px 0px;"
                        id="ell7ojcds4gri" class="animable"></rect><rect
                        x="125.24" y="193.82" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 195.135px 0px;"
                        id="elecz5rypmh8" class="animable"></rect><rect
                        x="125.24" y="198.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 199.545px 0px;"
                        id="ells2hbjmiua" class="animable"></rect><rect
                        x="125.24" y="202.65" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 203.965px 0px;"
                        id="elp5f5jesernm" class="animable"></rect><rect
                        x="125.24" y="207.06" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 208.375px 0px;"
                        id="elystmfrriy39" class="animable"></rect><rect
                        x="125.24" y="211.48" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 212.795px 0px;"
                        id="elywcoa15fcc" class="animable"></rect><rect
                        x="125.24" y="215.9" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 217.215px 0px;"
                        id="el6itttzk6kbf" class="animable"></rect><rect
                        x="125.24" y="220.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 221.625px 0px;"
                        id="el4vxli16pnv5" class="animable"></rect><rect
                        x="125.24" y="224.73" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 226.045px 0px;"
                        id="elthw4dlz63d" class="animable"></rect><rect
                        x="125.24" y="229.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 230.465px 0px;"
                        id="eleao0nc0bxr9" class="animable"></rect><rect
                        x="125.24" y="233.56" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 234.875px 0px;"
                        id="elnwc2t2rsmii" class="animable"></rect><rect
                        x="125.24" y="237.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 239.295px 0px;"
                        id="elhchfc8xwjp9" class="animable"></rect><rect
                        x="125.24" y="242.39" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 243.705px 0px;"
                        id="elnqap74w9c1f" class="animable"></rect><rect
                        x="125.24" y="246.81" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 248.125px 0px;"
                        id="el2mx32icawao" class="animable"></rect><rect
                        x="125.24" y="251.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 252.545px 0px;"
                        id="el5gsvig6tcgx" class="animable"></rect><rect
                        x="125.24" y="277.72" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 279.035px 0px;"
                        id="elox4xq716seh" class="animable"></rect><rect
                        x="125.24" y="282.14" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 126.555px 283.455px 0px;"
                        id="elb2kwk2j92x5" class="animable"></rect><rect
                        x="129.42" y="184.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 186.295px 0px;"
                        id="elg5eu09od15" class="animable"></rect><rect
                        x="129.42" y="189.4" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 190.715px 0px;"
                        id="eluers3gyiuoe" class="animable"></rect><rect
                        x="129.42" y="193.82" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 195.135px 0px;"
                        id="eltm2r1op0sff" class="animable"></rect><rect
                        x="129.42" y="198.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 199.545px 0px;"
                        id="elwleotzwk239" class="animable"></rect><rect
                        x="129.42" y="202.65" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 203.965px 0px;"
                        id="elquzo8l4ls6" class="animable"></rect><rect
                        x="129.42" y="207.06" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 208.375px 0px;"
                        id="elp87zc0d7rs" class="animable"></rect><rect
                        x="129.42" y="211.48" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 212.795px 0px;"
                        id="elqtp9yjaumq7" class="animable"></rect><rect
                        x="129.42" y="215.9" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 217.215px 0px;"
                        id="elqye0yqx0x8" class="animable"></rect><rect
                        x="129.42" y="220.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 221.625px 0px;"
                        id="elnw3qojc5ju" class="animable"></rect><rect
                        x="129.42" y="224.73" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 226.045px 0px;"
                        id="elfvd53ry30ds" class="animable"></rect><rect
                        x="129.42" y="229.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 230.465px 0px;"
                        id="elmjsvrp663y" class="animable"></rect><rect
                        x="129.42" y="233.56" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 234.875px 0px;"
                        id="elswuofogyr2" class="animable"></rect><rect
                        x="129.42" y="237.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 239.295px 0px;"
                        id="elz5mwb5iv9o7" class="animable"></rect><rect
                        x="129.42" y="242.39" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 243.705px 0px;"
                        id="el5hygvsev89t" class="animable"></rect><rect
                        x="129.42" y="246.81" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 248.125px 0px;"
                        id="elrs9g83h82yi" class="animable"></rect><rect
                        x="129.42" y="251.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 252.545px 0px;"
                        id="elho85qn7gjp4" class="animable"></rect><rect
                        x="129.42" y="260.06" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 261.375px 0px;"
                        id="el5ktiwrf37jo" class="animable"></rect><rect
                        x="129.42" y="264.47" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 265.785px 0px;"
                        id="elettj381kn39" class="animable"></rect><rect
                        x="129.42" y="268.89" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 270.205px 0px;"
                        id="elch7qkj6mclm" class="animable"></rect><rect
                        x="129.42" y="273.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 274.625px 0px;"
                        id="elqgrijp44evm" class="animable"></rect><rect
                        x="129.42" y="282.14" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 130.735px 283.455px 0px;"
                        id="el7k2nrd899eu" class="animable"></rect><rect
                        x="202.4" y="215.9" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 217.215px 0px;"
                        id="elrwqzbax6f" class="animable"></rect><rect x="202.4"
                        y="220.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 221.625px 0px;"
                        id="elr4tw0rlgd2f" class="animable"></rect><rect
                        x="202.4" y="224.73" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 226.045px 0px;"
                        id="el98zeh52vuw7" class="animable"></rect><rect
                        x="202.4" y="229.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 230.465px 0px;"
                        id="el756wqwinj6e" class="animable"></rect><rect
                        x="202.4" y="233.56" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 234.875px 0px;"
                        id="elo4pnfvugvqf" class="animable"></rect><rect
                        x="202.4" y="237.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 239.295px 0px;"
                        id="eljjp3r1l7wyi" class="animable"></rect><rect
                        x="202.4" y="242.39" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 243.705px 0px;"
                        id="elruiy1ab9cy" class="animable"></rect><rect
                        x="202.4" y="246.81" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 248.125px 0px;"
                        id="el00t575ibq20qf" class="animable"></rect><rect
                        x="202.4" y="251.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 252.545px 0px;"
                        id="el5jnvd7mncs3" class="animable"></rect><rect
                        x="202.4" y="255.64" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 256.955px 0px;"
                        id="elrpqpaeqnaui" class="animable"></rect><rect
                        x="202.4" y="260.06" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 261.375px 0px;"
                        id="eli7l01gn2na9" class="animable"></rect><rect
                        x="202.4" y="264.47" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 265.785px 0px;"
                        id="eleycln94b8t" class="animable"></rect><rect
                        x="202.4" y="268.89" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 270.205px 0px;"
                        id="elrgxy4o38gb8" class="animable"></rect><rect
                        x="202.4" y="277.72" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 279.035px 0px;"
                        id="el877c683lkwd" class="animable"></rect><rect
                        x="202.4" y="282.14" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 283.455px 0px;"
                        id="el9jl32rloclc" class="animable"></rect><rect
                        x="202.4" y="286.55" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 287.865px 0px;"
                        id="el81phq7o9ddk" class="animable"></rect><rect
                        x="202.4" y="290.97" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 292.285px 0px;"
                        id="elbm2vztnnsvg" class="animable"></rect><rect
                        x="202.4" y="299.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 301.115px 0px;"
                        id="eld26b8a8ry3e" class="animable"></rect><rect
                        x="202.4" y="304.22" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 305.535px 0px;"
                        id="eleteqncffvm6" class="animable"></rect><rect
                        x="202.4" y="308.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 203.715px 309.945px 0px;"
                        id="elqoof78gwny" class="animable"></rect><rect
                        x="206.59" y="215.9" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 217.215px 0px;"
                        id="el3beghevb4cf" class="animable"></rect><rect
                        x="206.59" y="220.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 221.625px 0px;"
                        id="el3jkds40yftl" class="animable"></rect><rect
                        x="206.59" y="224.73" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 226.045px 0px;"
                        id="elrfg5z1xtd8" class="animable"></rect><rect
                        x="206.59" y="229.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 230.465px 0px;"
                        id="el44yui2cnu5j" class="animable"></rect><rect
                        x="206.59" y="233.56" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 234.875px 0px;"
                        id="elaw5qa5ebr9" class="animable"></rect><rect
                        x="206.59" y="237.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 239.295px 0px;"
                        id="elxiwa8lh4cko" class="animable"></rect><rect
                        x="206.59" y="242.39" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 243.705px 0px;"
                        id="eldr0k1euk5c4" class="animable"></rect><rect
                        x="206.59" y="246.81" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 248.125px 0px;"
                        id="el4e3yfxdzrpw" class="animable"></rect><rect
                        x="206.59" y="251.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 252.545px 0px;"
                        id="elf9ld1puu6to" class="animable"></rect><rect
                        x="206.59" y="255.64" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 256.955px 0px;"
                        id="elt82dp77b3s" class="animable"></rect><rect
                        x="206.59" y="260.06" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 261.375px 0px;"
                        id="elxly5qqw9vl" class="animable"></rect><rect
                        x="206.59" y="264.47" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 265.785px 0px;"
                        id="elspagznmudnj" class="animable"></rect><rect
                        x="206.59" y="268.89" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 270.205px 0px;"
                        id="elmcb04ogrukl" class="animable"></rect><rect
                        x="206.59" y="282.14" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 283.455px 0px;"
                        id="eltturwlx0wom" class="animable"></rect><rect
                        x="206.59" y="286.55" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 287.865px 0px;"
                        id="elgyokykub474" class="animable"></rect><rect
                        x="206.59" y="295.39" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 296.705px 0px;"
                        id="elgqu5x2xm9hq" class="animable"></rect><rect
                        x="206.59" y="299.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 301.115px 0px;"
                        id="eldu38nyr3f9" class="animable"></rect><rect
                        x="206.59" y="304.22" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 305.535px 0px;"
                        id="ell4aeqktyn0n" class="animable"></rect><rect
                        x="206.59" y="308.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 207.905px 309.945px 0px;"
                        id="el65wz1778ckj" class="animable"></rect><rect
                        x="210.77" y="215.9" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 217.215px 0px;"
                        id="elladz725u72" class="animable"></rect><rect
                        x="210.77" y="220.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 221.625px 0px;"
                        id="ell28f5kg0gh" class="animable"></rect><rect
                        x="210.77" y="224.73" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 226.045px 0px;"
                        id="elplpg7zjqbin" class="animable"></rect><rect
                        x="210.77" y="229.15" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 230.465px 0px;"
                        id="elydsoihwap5" class="animable"></rect><rect
                        x="210.77" y="233.56" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 234.875px 0px;"
                        id="eljoder6052f" class="animable"></rect><rect
                        x="210.77" y="237.98" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 239.295px 0px;"
                        id="elhg24kvoscmh" class="animable"></rect><rect
                        x="210.77" y="242.39" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 243.705px 0px;"
                        id="elehxjavytsi4" class="animable"></rect><rect
                        x="210.77" y="246.81" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 248.125px 0px;"
                        id="elj01qcy5rn8s" class="animable"></rect><rect
                        x="210.77" y="251.23" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 252.545px 0px;"
                        id="elad2jemmz3vc" class="animable"></rect><rect
                        x="210.77" y="255.64" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 256.955px 0px;"
                        id="elcb1x0trfb0o" class="animable"></rect><rect
                        x="210.77" y="260.06" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 261.375px 0px;"
                        id="elf41lve69zg" class="animable"></rect><rect
                        x="210.77" y="264.47" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 265.785px 0px;"
                        id="el34vcjjfc4ro" class="animable"></rect><rect
                        x="210.77" y="268.89" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 270.205px 0px;"
                        id="elsxe45793rva" class="animable"></rect><rect
                        x="210.77" y="273.31" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 274.625px 0px;"
                        id="elkfi4611ykkk" class="animable"></rect><rect
                        x="210.77" y="282.14" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 283.455px 0px;"
                        id="elc4btktss16e" class="animable"></rect><rect
                        x="210.77" y="290.97" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 292.285px 0px;"
                        id="el2qiuv7e1jis" class="animable"></rect><rect
                        x="210.77" y="295.39" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 296.705px 0px;"
                        id="elqaif8oki5w" class="animable"></rect><rect
                        x="210.77" y="299.8" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 301.115px 0px;"
                        id="elwoutlz562v" class="animable"></rect><rect
                        x="210.77" y="304.22" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 305.535px 0px;"
                        id="elon3zxqwf97r" class="animable"></rect><rect
                        x="210.77" y="308.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 212.085px 309.945px 0px;"
                        id="el744hzqk4lt" class="animable"></rect><rect
                        x="185.36" y="241.08" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.675px 242.395px 0px;"
                        id="elm80sjetrzu" class="animable"></rect><rect
                        x="185.36" y="245.49" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.675px 246.805px 0px;"
                        id="elmg4hmt7tu9" class="animable"></rect><rect
                        x="185.36" y="249.91" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.675px 251.225px 0px;"
                        id="elmuh9z51vlst" class="animable"></rect><rect
                        x="185.36" y="254.32" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.675px 255.635px 0px;"
                        id="ele0vbs2an4wb" class="animable"></rect><rect
                        x="185.36" y="258.74" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.675px 260.055px 0px;"
                        id="ellbd2zj6c89j" class="animable"></rect><rect
                        x="185.36" y="263.16" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.675px 264.475px 0px;"
                        id="el75w0xgmxjk" class="animable"></rect><rect
                        x="185.36" y="276.4" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.675px 277.715px 0px;"
                        id="el70ba4nnr0fq" class="animable"></rect><rect
                        x="185.36" y="280.82" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.675px 282.135px 0px;"
                        id="eltenw33e2t79" class="animable"></rect><rect
                        x="185.36" y="285.24" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.675px 286.555px 0px;"
                        id="el62rnf6znrg9" class="animable"></rect><rect
                        x="185.36" y="289.65" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.675px 290.965px 0px;"
                        id="elc1rapil0ydl" class="animable"></rect><rect
                        x="185.36" y="294.07" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.675px 295.385px 0px;"
                        id="elibz71l5bf9b" class="animable"></rect><rect
                        x="185.36" y="298.49" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.675px 299.805px 0px;"
                        id="elrtfsnhpf2jp" class="animable"></rect><rect
                        x="185.36" y="302.9" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.675px 304.215px 0px;"
                        id="el3172ok2igjw" class="animable"></rect><rect
                        x="189.54" y="241.08" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.855px 242.395px 0px;"
                        id="elea7tcaj28ca" class="animable"></rect><rect
                        x="189.54" y="245.49" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.855px 246.805px 0px;"
                        id="elh3so8xb67rt" class="animable"></rect><rect
                        x="189.54" y="249.91" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.855px 251.225px 0px;"
                        id="elmipthw87qb" class="animable"></rect><rect
                        x="189.54" y="254.32" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.855px 255.635px 0px;"
                        id="else11cs9dgs" class="animable"></rect><rect
                        x="189.54" y="258.74" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.855px 260.055px 0px;"
                        id="eley9s029njg9" class="animable"></rect><rect
                        x="189.54" y="263.16" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.855px 264.475px 0px;"
                        id="elsxoqpqayic" class="animable"></rect><rect
                        x="189.54" y="276.4" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.855px 277.715px 0px;"
                        id="elhbgd3e28r4n" class="animable"></rect><rect
                        x="189.54" y="280.82" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.855px 282.135px 0px;"
                        id="elfgw3glxn8g" class="animable"></rect><rect
                        x="189.54" y="285.24" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.855px 286.555px 0px;"
                        id="el3io76xszk7n" class="animable"></rect><rect
                        x="189.54" y="289.65" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.855px 290.965px 0px;"
                        id="elqncfxbodd2" class="animable"></rect><rect
                        x="189.54" y="294.07" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.855px 295.385px 0px;"
                        id="eley2lo0wscz" class="animable"></rect><rect
                        x="189.54" y="298.49" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.855px 299.805px 0px;"
                        id="eljlqpsjx9ndl" class="animable"></rect><rect
                        x="189.54" y="307.32" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.855px 308.635px 0px;"
                        id="elvo4sg0qwo2" class="animable"></rect><rect
                        x="328.53" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 222.945px 0px;"
                        id="el4tc4t6wk2nl" class="animable"></rect><rect
                        x="328.53" y="226.05" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 227.365px 0px;"
                        id="ellsgcplux39" class="animable"></rect><rect
                        x="328.53" y="230.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 231.775px 0px;"
                        id="els26yeyj8ioe" class="animable"></rect><rect
                        x="328.53" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 236.195px 0px;"
                        id="elffbst5ezi4d" class="animable"></rect><rect
                        x="328.53" y="239.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 240.605px 0px;"
                        id="ellfwhv8dk70o" class="animable"></rect><rect
                        x="328.53" y="243.71" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 245.025px 0px;"
                        id="elsltmob1prp" class="animable"></rect><rect
                        x="328.53" y="248.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 249.445px 0px;"
                        id="elyxravh5zqyo" class="animable"></rect><rect
                        x="328.53" y="252.54" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 253.855px 0px;"
                        id="elgr7aekcv3h" class="animable"></rect><rect
                        x="328.53" y="256.96" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 258.275px 0px;"
                        id="ellw6jld24jvd" class="animable"></rect><rect
                        x="328.53" y="261.37" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 262.685px 0px;"
                        id="elg5ypq48d115" class="animable"></rect><rect
                        x="328.53" y="265.79" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 267.105px 0px;"
                        id="elewe7cy988q8" class="animable"></rect><rect
                        x="328.53" y="274.62" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 275.935px 0px;"
                        id="elp6uk87mi4h" class="animable"></rect><rect
                        x="328.53" y="279.04" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 280.355px 0px;"
                        id="elof4yspy2pmi" class="animable"></rect><rect
                        x="328.53" y="283.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 284.775px 0px;"
                        id="eljoeztnz1x3e" class="animable"></rect><rect
                        x="328.53" y="287.87" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 289.185px 0px;"
                        id="el21k3mutdduz" class="animable"></rect><rect
                        x="328.53" y="292.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 293.605px 0px;"
                        id="elyfpzrd4i5je" class="animable"></rect><rect
                        x="328.53" y="296.7" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 298.015px 0px;"
                        id="elc4sjg6e4bt8" class="animable"></rect><rect
                        x="328.53" y="301.12" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 302.435px 0px;"
                        id="elhxoum074c3h" class="animable"></rect><rect
                        x="328.53" y="305.54" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 329.845px 306.855px 0px;"
                        id="el9mytslazx" class="animable"></rect><rect
                        x="332.72" y="221.63" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 222.945px 0px;"
                        id="elbwmn955ov1q" class="animable"></rect><rect
                        x="332.72" y="226.05" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 227.365px 0px;"
                        id="el63iu9ba4hy8" class="animable"></rect><rect
                        x="332.72" y="230.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 231.775px 0px;"
                        id="el89c5texztjl" class="animable"></rect><rect
                        x="332.72" y="234.88" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 236.195px 0px;"
                        id="elopxaciwnve9" class="animable"></rect><rect
                        x="332.72" y="239.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 240.605px 0px;"
                        id="eldhbcj32jt1l" class="animable"></rect><rect
                        x="332.72" y="243.71" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 245.025px 0px;"
                        id="elttoq8llhru" class="animable"></rect><rect
                        x="332.72" y="248.13" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 249.445px 0px;"
                        id="elm0fw7cx3w1" class="animable"></rect><rect
                        x="332.72" y="252.54" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 253.855px 0px;"
                        id="elsb8zz4or3hi" class="animable"></rect><rect
                        x="332.72" y="256.96" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 258.275px 0px;"
                        id="el9ilwaf5n9" class="animable"></rect><rect
                        x="332.72" y="261.37" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 262.685px 0px;"
                        id="elx8z08j70eb" class="animable"></rect><rect
                        x="332.72" y="265.79" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 267.105px 0px;"
                        id="elcxegvru52uv" class="animable"></rect><rect
                        x="332.72" y="270.21" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 271.525px 0px;"
                        id="el9dwecks868t" class="animable"></rect><rect
                        x="332.72" y="274.62" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 275.935px 0px;"
                        id="elxuv7i97pz0i" class="animable"></rect><rect
                        x="332.72" y="279.04" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 280.355px 0px;"
                        id="elnhzkuu9ggv" class="animable"></rect><rect
                        x="332.72" y="283.46" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 284.775px 0px;"
                        id="eldh33pvst2pn" class="animable"></rect><rect
                        x="332.72" y="287.87" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 289.185px 0px;"
                        id="ely5dfht7auch" class="animable"></rect><rect
                        x="332.72" y="292.29" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 293.605px 0px;"
                        id="elcwa06v1wmco" class="animable"></rect><rect
                        x="332.72" y="296.7" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 298.015px 0px;"
                        id="el7vjua3x0zz3" class="animable"></rect><rect
                        x="332.72" y="301.12" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 302.435px 0px;"
                        id="elky72u9164vg" class="animable"></rect><rect
                        x="332.72" y="305.54" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 334.035px 306.855px 0px;"
                        id="elyeotni2ljzg" class="animable"></rect><rect
                        x="307.92" y="238.83" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 309.235px 240.145px 0px;"
                        id="el82xbwcrow6x" class="animable"></rect><rect
                        x="307.92" y="243.25" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 309.235px 244.565px 0px;"
                        id="elnm7lovlxtpe" class="animable"></rect><rect
                        x="307.92" y="247.66" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 309.235px 248.975px 0px;"
                        id="el10mey4gd9j3" class="animable"></rect><rect
                        x="307.92" y="252.08" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 309.235px 253.395px 0px;"
                        id="elsw0jk3qemf" class="animable"></rect><rect
                        x="307.92" y="256.49" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 309.235px 257.805px 0px;"
                        id="elwyyla3nuces" class="animable"></rect><rect
                        x="307.92" y="260.91" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 309.235px 262.225px 0px;"
                        id="ele0z9nf235j" class="animable"></rect><rect
                        x="307.92" y="265.33" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 309.235px 266.645px 0px;"
                        id="elt4u1jugd6n" class="animable"></rect><rect
                        x="307.92" y="269.74" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 309.235px 271.055px 0px;"
                        id="el8x7uugnhwpn" class="animable"></rect><rect
                        x="307.92" y="274.16" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 309.235px 275.475px 0px;"
                        id="elqm6ynrow5vt" class="animable"></rect><rect
                        x="307.92" y="278.57" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 309.235px 279.885px 0px;"
                        id="elwxj2wany7v" class="animable"></rect><rect
                        x="312.11" y="238.83" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 313.425px 240.145px 0px;"
                        id="elyuwssmjaukh" class="animable"></rect><rect
                        x="312.11" y="243.25" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 313.425px 244.565px 0px;"
                        id="elx6y7idx7uxj" class="animable"></rect><rect
                        x="312.11" y="247.66" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 313.425px 248.975px 0px;"
                        id="elq6o2977h1bs" class="animable"></rect><rect
                        x="312.11" y="252.08" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 313.425px 253.395px 0px;"
                        id="elweiy6dioh1" class="animable"></rect><rect
                        x="312.11" y="256.49" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 313.425px 257.805px 0px;"
                        id="eltm7fx49rko8" class="animable"></rect><rect
                        x="312.11" y="260.91" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 313.425px 262.225px 0px;"
                        id="elcetxwehiqu4" class="animable"></rect><rect
                        x="312.11" y="265.33" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 313.425px 266.645px 0px;"
                        id="elk5cm4xihbjh" class="animable"></rect><rect
                        x="312.11" y="269.74" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 313.425px 271.055px 0px;"
                        id="elgcrtnlefg2r" class="animable"></rect><rect
                        x="312.11" y="274.16" width="2.63" height="2.63"
                        style="fill: rgb(245, 245, 245); transform-origin: 313.425px 275.475px 0px;"
                        id="elmfgdjgmbqiq" class="animable"></rect><rect
                        x="287.22" y="106.63" width="4.42" height="210.91"
                        style="fill: rgb(245, 245, 245); transform-origin: 289.43px 212.085px 0px;"
                        id="elrpg5sm97rlf" class="animable"></rect><rect
                        x="204.05" y="106.63" width="4.42" height="210.91"
                        style="fill: rgb(245, 245, 245); transform-origin: 206.26px 212.085px 0px;"
                        id="elakirtynffnf" class="animable"></rect><rect
                        x="120.88" y="106.63" width="4.42" height="210.91"
                        style="fill: rgb(245, 245, 245); transform-origin: 123.09px 212.085px 0px;"
                        id="elkkimbxsou3r" class="animable"></rect><path
                        d="M237.6,290.56H224.11v-.9c0-1.76,2-3.16,4.33-3.07l5.28.22c2.17.08,3.88,1.43,3.88,3.06Z"
                        style="fill: rgb(240, 240, 240); transform-origin: 230.855px 288.573px 0px;"
                        id="elbeltzzepi2g" class="animable"></path><path
                        d="M205.66,266.11a1.74,1.74,0,0,0-1.74-1.67H192a1.74,1.74,0,0,0-1.74,1.67L193.05,291H210.9Z"
                        style="fill: rgb(230, 230, 230); transform-origin: 200.58px 277.72px 0px;"
                        id="el54eofypb20g" class="animable"></path><path
                        d="M238.13,227.81h-4.46l-5,47h4.45a1.52,1.52,0,0,0,1.48-1.33l4.72-44.38A1.17,1.17,0,0,0,238.13,227.81Z"
                        style="fill: rgb(230, 230, 230); transform-origin: 233.998px 251.31px 0px;"
                        id="elusuzw3tt9zc" class="animable"></path><path
                        d="M231.24,274.85H164.48a1.17,1.17,0,0,1-1.19-1.33L168,229.14a1.52,1.52,0,0,1,1.48-1.33h66.75a1.18,1.18,0,0,1,1.2,1.33l-4.72,44.38A1.52,1.52,0,0,1,231.24,274.85Z"
                        style="fill: rgb(235, 235, 235); transform-origin: 200.359px 251.33px 0px;"
                        id="el0lx6kovwc3l" class="animable"></path><path
                        d="M230,270.51H167a1,1,0,0,1-1-1.17l4.12-38.71a1.32,1.32,0,0,1,1.29-1.17h63a1,1,0,0,1,1,1.17l-4.12,38.71A1.32,1.32,0,0,1,230,270.51Z"
                        style="fill: rgb(250, 250, 250); transform-origin: 200.705px 249.985px 0px;"
                        id="elz0i5r0ujqzp" class="animable"></path><rect
                        x="188.65" y="289.08" width="23.88" height="1.93"
                        rx="0.96"
                        style="fill: rgb(230, 230, 230); transform-origin: 200.59px 290.045px 0px;"
                        id="eldewxea8p2z" class="animable"></rect><rect
                        x="211.27" y="290.46" width="54.35" height="8.2"
                        style="fill: rgb(230, 230, 230); transform-origin: 238.445px 294.56px 0px;"
                        id="elgy8qzdbei3b" class="animable"></rect><path
                        d="M114.18,382h-1.36a.3.3,0,0,1-.31-.3l-2.14-83.06h6.26l-2.14,83.06A.3.3,0,0,1,114.18,382Z"
                        style="fill: rgb(230, 230, 230); transform-origin: 113.5px 340.32px 0px;"
                        id="elmodhfrfmea" class="animable"></path><polygon
                        points="65.81 382.02 62.67 382.02 71.52 298.66 77.79 298.66 65.81 382.02"
                        style="fill: rgb(240, 240, 240); transform-origin: 70.23px 340.34px 0px;"
                        id="el1r339k9yoak" class="animable"></polygon><polygon
                        points="267.73 382.02 267.73 382.02 255.72 298.66 261.99 298.66 270.83 382.02 267.73 382.02"
                        style="fill: rgb(230, 230, 230); transform-origin: 263.275px 340.34px 0px;"
                        id="elp1fjf3z24r" class="animable"></polygon><rect
                        x="67.9" y="290.46" width="158.87" height="8.2"
                        style="fill: rgb(245, 245, 245); transform-origin: 147.335px 294.56px 0px;"
                        id="elwbvztu45t7l" class="animable"></rect><polygon
                        points="221.81 382.02 218.21 382.02 218.21 382.02 216.88 298.66 223.14 298.66 221.81 382.02"
                        style="fill: rgb(240, 240, 240); transform-origin: 220.01px 340.34px 0px;"
                        id="elahx29kkv7e5" class="animable"></polygon><path
                        d="M171.06,289h-1.67a.31.31,0,0,1-.31-.31v-1.76a.31.31,0,0,1,.31-.32h1.2a.32.32,0,0,1,.31.23l.47,1.76A.32.32,0,0,1,171.06,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 170.23px 287.805px 0px;"
                        id="el2vgprzgjr86" class="animable"></path><path
                        d="M173.36,289h-1.67a.31.31,0,0,1-.31-.31v-1.76a.31.31,0,0,1,.31-.32h1.2a.32.32,0,0,1,.31.23l.47,1.76A.32.32,0,0,1,173.36,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 172.53px 287.805px 0px;"
                        id="eljcba37ubjib" class="animable"></path><path
                        d="M175.66,289H174a.31.31,0,0,1-.32-.31v-1.76a.32.32,0,0,1,.32-.32h1.19a.32.32,0,0,1,.31.23l.47,1.76A.32.32,0,0,1,175.66,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 174.83px 287.805px 0px;"
                        id="elop0bee6l9yd" class="animable"></path><path
                        d="M178,289H176.3a.31.31,0,0,1-.32-.31v-1.76a.32.32,0,0,1,.32-.32h1.19a.31.31,0,0,1,.31.23l.47,1.76A.32.32,0,0,1,178,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 177.13px 287.805px 0px;"
                        id="elk54ommd4qy" class="animable"></path><path
                        d="M180.26,289H178.6a.31.31,0,0,1-.32-.31v-1.76a.32.32,0,0,1,.32-.32h1.19a.31.31,0,0,1,.31.23l.47,1.76A.32.32,0,0,1,180.26,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 179.43px 287.805px 0px;"
                        id="elgi46sbrdcu5" class="animable"></path><path
                        d="M182.56,289H180.9a.31.31,0,0,1-.32-.31v-1.76a.32.32,0,0,1,.32-.32h1.19a.31.31,0,0,1,.31.23l.47,1.76A.32.32,0,0,1,182.56,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 181.73px 287.805px 0px;"
                        id="elbgyjnb4vhx" class="animable"></path><path
                        d="M184.86,289H183.2a.31.31,0,0,1-.32-.31v-1.76a.32.32,0,0,1,.32-.32h1.19a.31.31,0,0,1,.31.23l.47,1.76A.32.32,0,0,1,184.86,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 184.03px 287.805px 0px;"
                        id="elm2a62144k6p" class="animable"></path><path
                        d="M187.16,289H185.5a.31.31,0,0,1-.32-.31v-1.76a.32.32,0,0,1,.32-.32h1.19a.31.31,0,0,1,.31.23l.47,1.76A.32.32,0,0,1,187.16,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 186.33px 287.805px 0px;"
                        id="elhjqa8olwe0d" class="animable"></path><path
                        d="M189.46,289H187.8a.31.31,0,0,1-.32-.31v-1.76a.32.32,0,0,1,.32-.32H189a.31.31,0,0,1,.31.23l.47,1.76A.32.32,0,0,1,189.46,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 188.635px 287.805px 0px;"
                        id="elnix13o44dp" class="animable"></path><path
                        d="M191.76,289H190.1a.31.31,0,0,1-.32-.31v-1.76a.32.32,0,0,1,.32-.32h1.2a.3.3,0,0,1,.3.23l.47,1.76A.31.31,0,0,1,191.76,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 190.932px 287.805px 0px;"
                        id="elsie4l576ts" class="animable"></path><path
                        d="M194.07,289H192.4a.31.31,0,0,1-.32-.31v-1.76a.32.32,0,0,1,.32-.32h1.2a.3.3,0,0,1,.3.23l.47,1.76A.31.31,0,0,1,194.07,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 193.232px 287.805px 0px;"
                        id="el3b2tfyba20b" class="animable"></path><path
                        d="M196.37,289H194.7a.32.32,0,0,1-.32-.31v-1.76a.32.32,0,0,1,.32-.32h1.2a.3.3,0,0,1,.3.23l.47,1.76A.31.31,0,0,1,196.37,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 195.532px 287.805px 0px;"
                        id="ely40pxp2wgl" class="animable"></path><path
                        d="M198.67,289H197a.32.32,0,0,1-.32-.31v-1.76a.32.32,0,0,1,.32-.32h1.2a.3.3,0,0,1,.3.23l.47,1.76A.31.31,0,0,1,198.67,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 197.832px 287.805px 0px;"
                        id="elrvzmxxt6zn" class="animable"></path><path
                        d="M201,289H199.3a.32.32,0,0,1-.32-.31v-1.76a.32.32,0,0,1,.32-.32h1.2a.3.3,0,0,1,.3.23l.47,1.76A.31.31,0,0,1,201,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 200.132px 287.805px 0px;"
                        id="eld0yks3fmtr" class="animable"></path><path
                        d="M203.27,289H201.6a.32.32,0,0,1-.32-.31v-1.76a.32.32,0,0,1,.32-.32h1.2a.32.32,0,0,1,.31.23l.46,1.76A.31.31,0,0,1,203.27,289Z"
                        style="fill: rgb(245, 245, 245); transform-origin: 202.432px 287.805px 0px;"
                        id="elxbz5cnbgaq" class="animable"></path><rect
                        x="167.72" y="287.79" width="37.22" height="2.77"
                        style="fill: rgb(235, 235, 235); transform-origin: 186.33px 289.175px 0px;"
                        id="el96sv6tler09" class="animable"></rect><path
                        d="M81.63,306.15h57.56a5,5,0,0,1,5,5v3.78a0,0,0,0,1,0,0H76.63a0,0,0,0,1,0,0v-3.78A5,5,0,0,1,81.63,306.15Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 110.41px 310.54px 0px;"
                        id="elrjdtzzww2a" class="animable"></path><path
                        d="M78.83,364.94l21.65-2.13V332.39h8.58V362.8l21.74,2.14a4.21,4.21,0,0,1,3.8,4.19v3.25H75v-3.25A4.21,4.21,0,0,1,78.83,364.94Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 104.8px 352.385px 0px;"
                        id="elqtnyh47q7me" class="animable"></path><path
                        d="M126.7,376.41a5.61,5.61,0,1,0,5.61-5.61A5.61,5.61,0,0,0,126.7,376.41Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 132.31px 376.41px 0px;"
                        id="el5jkrx27g7da" class="animable"></path><path
                        d="M82.93,376.41a5.61,5.61,0,1,1-5.61-5.61A5.61,5.61,0,0,1,82.93,376.41Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 77.3199px 376.41px 0px;"
                        id="elzi76ebmwyz" class="animable"></path><g
                        id="el1e4w229q0jp"><path
                          d="M103.14,311.83h3.27a4.13,4.13,0,0,1,4.13,4.13v23a0,0,0,0,1,0,0H99a0,0,0,0,1,0,0V316A4.13,4.13,0,0,1,103.14,311.83Z"
                          style="fill: rgb(230, 230, 230); transform-origin: 104.77px 325.395px 0px; transform: rotate(180deg);"
                          class="animable" id="eltpeserpnzbp"></path></g><path
                        d="M116.17,306.72c-3-11.32-9.73-40.61-11.15-79.3a11.14,11.14,0,0,0-11.14-10.7h-20a11.13,11.13,0,0,0-11.14,11.09C62.69,246,64,283.19,74.22,313.42l38-1.4A4.21,4.21,0,0,0,116.17,306.72Z"
                        style="fill: rgb(235, 235, 235); transform-origin: 89.5263px 265.07px 0px;"
                        id="el0krhwlerdxnl" class="animable"></path><path
                        d="M110.8,311.4a392.32,392.32,0,0,1-12-82.68,10.28,10.28,0,0,0-10.27-9.87H70.15a10.28,10.28,0,0,0-10.28,10.22c-.07,16.78,1.1,54.44,10.57,82.33Z"
                        style="fill: rgb(230, 230, 230); transform-origin: 85.3336px 265.125px 0px;"
                        id="el3uqsau5tgor" class="animable"></path><path
                        d="M102.89,284.88s21.9-4.43,43-2.29S136,312.35,136,312.35h-4.37s16.47-17.51,15.55-21.87-42.39,1.39-42.39,1.39Z"
                        style="fill: rgb(230, 230, 230); transform-origin: 128.069px 297.178px 0px;"
                        id="el23ax4aj4v6xi" class="animable"></path><path
                        d="M70.44,311.4h35.85a392.46,392.46,0,0,1-12-82.68,10.28,10.28,0,0,0-10.28-9.87H70.16a10.28,10.28,0,0,0-10.29,10.22C59.8,245.85,61,283.51,70.44,311.4Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 83.0786px 265.125px 0px;"
                        id="elh2mdbj9nt5" class="animable"></path><rect
                        x="69.72" y="310.54" width="76.89" height="4.39"
                        rx="2.01"
                        style="fill: rgb(224, 224, 224); transform-origin: 108.165px 312.735px 0px;"
                        id="el43277hyf0br" class="animable"></rect><path
                        d="M416.51,345.41c0-.4,1.34-39.68,7.73-45.89,6.21-6,13.34-.22,13.64,0l.65-.77c-.09-.07-8.13-6.64-15,0-6.68,6.5-8,44.94-8,46.58Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 427.03px 320.597px 0px;"
                        id="eldgmzjec4epm" class="animable"></path><path
                        d="M416,353.13c0-.47,4.36-47.16-12.69-66.72l-.75.65C419.29,306.3,415,352.57,415,353Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 409.53px 319.77px 0px;"
                        id="el21fcfe8j6xi" class="animable"></path><path
                        d="M416.59,348.19l1-.07c0-.53-3.34-53.07,9.16-64.57l-.67-.74C413.22,294.63,416.44,346,416.59,348.19Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 421.437px 315.5px 0px;"
                        id="ely8766g0bqlt" class="animable"></path><path
                        d="M415,348.16h1c0-1.44-.41-35.49-10.08-41a6.82,6.82,0,0,0-6.26-.61c-5.85,2.42-8.75,12.82-8.87,13.27l1,.26c0-.1,2.89-10.38,8.28-12.61a5.91,5.91,0,0,1,5.38.56C414.56,313.24,415,347.81,415,348.16Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 403.395px 327.109px 0px;"
                        id="eleubdvnbzqs" class="animable"></path><path
                        d="M418.73,348.19l1-.06c0-.27-1.46-26.91,5.73-36.29,1.74-2.27,3.64-3.36,5.63-3.22,4.71.33,8.66,7.22,8.7,7.29l.87-.49c-.17-.3-4.25-7.43-9.5-7.8-2.34-.16-4.53,1.05-6.49,3.61C417.25,320.91,418.66,347.08,418.73,348.19Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 429.62px 327.898px 0px;"
                        id="el5jobwg8ksng" class="animable"></path><path
                        d="M417.15,351.81c.2-2.59,4.7-63.4-3.23-74.12l-.8.59c7.71,10.42,3.08,72.82,3,73.45Z"
                        style="fill: rgb(224, 224, 224); transform-origin: 415.861px 314.75px 0px;"
                        id="elzfr6wt7fsua" class="animable"></path><path
                        d="M397.46,312.67s4.76,1.75,3.34,5.89-16.44,10.95-16.44,10.95-6.3-5.77-.51-15.16S397.34,309.71,397.46,312.67Z"
                        style="fill: rgb(235, 235, 235); transform-origin: 391.234px 319.16px 0px;"
                        id="elq30yjmny8ea" class="animable"></path><path
                        d="M418.13,304.8s-5.06-.22-5.35,4.15,11,16.43,11,16.43,8-2.91,6.31-13.79S419.39,302.11,418.13,304.8Z"
                        style="fill: rgb(235, 235, 235); transform-origin: 421.55px 314.137px 0px;"
                        id="el7uwuzvgn8bp" class="animable"></path><path
                        d="M422.41,283.91s-3.37-.36-3.1-2.41,13.12-7.35,20.7,1.2c0,0-4.85,8.34-11.87,8.45S422.41,283.91,422.41,283.91Z"
                        style="fill: rgb(235, 235, 235); transform-origin: 429.652px 284.57px 0px;"
                        id="el7tl0xk7klwj" class="animable"></path><path
                        d="M416.13,278.92s3.05,1.48,3.91-.41-7.25-13.17-18.21-9.92c0,0-.29,9.64,5.61,13.44S416.13,278.92,416.13,278.92Z"
                        style="fill: rgb(235, 235, 235); transform-origin: 410.965px 275.588px 0px;"
                        id="elrywmtmb0xah" class="animable"></path><path
                        d="M432.1,311s-2.33-1.88.19-2.8,14.85-.66,15,11.56c0,0-14.36,2.39-16.14-2.27S432.1,311,432.1,311Z"
                        style="fill: rgb(235, 235, 235); transform-origin: 438.919px 314.124px 0px;"
                        id="elgc9ub7tc877" class="animable"></path><path
                        d="M402.81,283.61s2.33-1.88-.18-2.8-14.85-.66-15,11.56c0,0,14.37,2.39,16.14-2.27S402.81,283.61,402.81,283.61Z"
                        style="fill: rgb(235, 235, 235); transform-origin: 395.998px 286.734px 0px;"
                        id="eloaf5fy8a6w" class="animable"></path><path
                        d="M410.41,293.45s.2-2.29-1.64-1.39-8.28,7.83-1.62,14.41c0,0,9-6.64,7.36-10.1S410.41,293.45,410.41,293.45Z"
                        style="fill: rgb(235, 235, 235); transform-origin: 409.455px 299.16px 0px;"
                        id="el3jxg78ujozr" class="animable"></path><path
                        d="M434.19,296.71s-1.4-1.83.64-2S446,296.87,443.88,306c0,0-11.13-.84-11.61-4.63S434.19,296.71,434.19,296.71Z"
                        style="fill: rgb(235, 235, 235); transform-origin: 438.202px 300.351px 0px;"
                        id="elrgvdm0jqbl" class="animable"></path><polygon
                        points="396.57 382.02 434.77 382.02 438.89 340.2 392.45 340.2 396.57 382.02"
                        style="fill: rgb(240, 240, 240); transform-origin: 415.67px 361.11px 0px;"
                        id="elk9iaatbx1gn" class="animable"></polygon><g
                        id="el1jj61h7kdfx"><rect x="390.41" y="335.59"
                          width="50.52" height="9.23"
                          style="fill: rgb(230, 230, 230); transform-origin: 415.67px 340.205px 0px; transform: rotate(180deg);"
                          class="animable" id="el2ib01s877vz"></rect></g></g><g
                      id="freepik--Shadow--inject-39"
                      style="transform-origin: 250px 416.24px 0px;"
                      class="animable"><ellipse id="freepik--path--inject-39"
                        cx="250" cy="416.24" rx="193.89" ry="11.32"
                        style="fill: rgb(245, 245, 245); transform-origin: 250px 416.24px 0px;"
                        class="animable"></ellipse></g><g
                      id="freepik--Contract--inject-39"
                      style="transform-origin: 313.005px 265px 0px;"
                      class="animable"><path
                        d="M403.29,418.43H235.05a5.13,5.13,0,0,1-5.2-5.78l28.87-286.42a6.54,6.54,0,0,1,6.36-5.78H433.32a5.14,5.14,0,0,1,5.2,5.78L409.65,412.65A6.54,6.54,0,0,1,403.29,418.43Z"
                        style="fill: #4081FF; transform-origin: 334.184px 269.44px 0px;"
                        id="elrh8gkmkroxn" class="animable"></path><path
                        d="M378.1,142.15H315.93a4.12,4.12,0,0,1-4.17-4.64l1.73-17.23a1,1,0,0,1,.92-.83H384.2a.73.73,0,0,1,.74.83l-1.73,17.23A5.26,5.26,0,0,1,378.1,142.15Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 348.337px 130.8px 0px;"
                        id="elwzk2e2dnsi" class="animable"></path><path
                        d="M350.1,111.57a5.26,5.26,0,0,0-5.12,4.65l-.73,7.22h9.3l.72-7.22A4.12,4.12,0,0,0,350.1,111.57Zm-.7,6.92a1.66,1.66,0,0,1-1.69-1.88,2.12,2.12,0,0,1,2.07-1.87,1.67,1.67,0,0,1,1.69,1.87A2.13,2.13,0,0,1,349.4,118.49Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 349.277px 117.505px 0px;"
                        id="eljllk0eem1hl" class="animable"></path><path
                        d="M377.35,137.9H352.18a1,1,0,0,1-.72-.31,1,1,0,0,1-.28-.73,3.27,3.27,0,0,0-.87-2.38,3.2,3.2,0,0,0-2.32-.95,4.26,4.26,0,0,0-4.1,3.53,1,1,0,0,1-1,.84H317.74a1,1,0,0,1-.75-.33,1,1,0,0,1-.25-.77L318,124.33a1,1,0,0,1,1-.9H378.6a1,1,0,0,1,1,1.1L378.34,137A1,1,0,0,1,377.35,137.9Zm-24.23-2h23.32l1.06-10.47H319.9l-1.06,10.47h23.28a6.31,6.31,0,0,1,5.87-4.37,5.11,5.11,0,0,1,5.13,4.37Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 348.17px 130.665px 0px;"
                        id="el4wyvdrz2r94" class="animable"></path><path
                        d="M373.9,124.5a1.6,1.6,0,0,1,.79-1.36h-52a1.6,1.6,0,0,0-.79,1.36c-.11,1.08.51,1.36.51,1.36h52S373.79,125.58,373.9,124.5Z"
                        style="fill: #4081FF; transform-origin: 348.288px 124.5px 0px;"
                        id="eljosh7rqdb68" class="animable"></path><polygon
                        points="403.85 409.68 237.08 409.68 265.35 129.19 432.12 129.19 403.85 409.68"
                        style="fill: rgb(255, 255, 255); transform-origin: 334.6px 269.435px 0px;"
                        id="elxddu248ftx" class="animable"></polygon><path
                        d="M418.88,158.79H272.72a.5.5,0,0,1,0-1H418.88a.5.5,0,0,1,0,1Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 345.8px 158.29px 0px;"
                        id="elehthd57cgmf" class="animable"></path><path
                        d="M291.76,145.52a9,9,0,0,1-8.73,7.93,7,7,0,0,1-7.13-7.93,9,9,0,0,1,8.73-7.93A7,7,0,0,1,291.76,145.52Z"
                        style="fill: #4081FF; transform-origin: 283.83px 145.52px 0px;"
                        id="elkeknhr9nc3r" class="animable"></path><path
                        d="M279.32,144.33s-4.26,5.62-3,7.33,13.09-7.91,15.93-11.21-.49-2-.49-2,1.25.07.58,1.08c-1.37,2.08-12.6,9.5-13.74,9.1S279.32,144.33,279.32,144.33Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 284.742px 145.03px 0px;"
                        id="el4y9ek4lrxux" class="animable"></path><path
                        d="M418.64,142.86h-15a1,1,0,0,1,0-2h15a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 411.14px 141.86px 0px;"
                        id="el30yyfkojmc3" class="animable"></path><path
                        d="M418.17,147.52h-9.69a1,1,0,0,1,0-2h9.69a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 413.325px 146.52px 0px;"
                        id="eladhiqhuebah" class="animable"></path><path
                        d="M417.7,152.18H392.38a1,1,0,0,1,0-2H417.7a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 405.04px 151.18px 0px;"
                        id="elx4fu0wci9g" class="animable"></path><path
                        d="M310.53,170.79a4.83,4.83,0,0,1,4.93-4.32,3.83,3.83,0,0,1,3.18,1.4l-1.1.95a2.66,2.66,0,0,0-2.15-1,3.22,3.22,0,0,0-3.29,2.95,2.55,2.55,0,0,0,2.7,3,3.25,3.25,0,0,0,2.34-1l.91,1a4.71,4.71,0,0,1-3.47,1.41A3.8,3.8,0,0,1,310.53,170.79Z"
                        id="elmhx6yt99yw"
                        style="transform-origin: 314.561px 170.828px 0px;"
                        class="animable"></path><path
                        d="M319.07,170.79a4.86,4.86,0,0,1,5-4.32,3.81,3.81,0,0,1,4.08,4.32,4.85,4.85,0,0,1-4.95,4.32A3.83,3.83,0,0,1,319.07,170.79Zm7.47,0a2.54,2.54,0,0,0-2.65-2.95,3.23,3.23,0,0,0-3.25,2.95,2.55,2.55,0,0,0,2.65,3A3.23,3.23,0,0,0,326.54,170.79Z"
                        id="elps2g6l3nfmr"
                        style="transform-origin: 323.611px 170.791px 0px;"
                        class="animable"></path><path
                        d="M337.66,166.59l-.85,8.4h-1.28l-4.06-5.69L330.9,175h-1.55l.85-8.4h1.28l4.06,5.69.57-5.69Z"
                        id="elgp9p6zkux4d"
                        style="transform-origin: 333.505px 170.795px 0px;"
                        class="animable"></path><path
                        d="M341.49,167.91H338.7l.14-1.32H346l-.13,1.32h-2.78l-.72,7.08h-1.56Z"
                        id="elqbd8qes7ryn"
                        style="transform-origin: 342.35px 170.79px 0px;"
                        class="animable"></path><path
                        d="M351.79,175l-1.47-2.46H348.1l-.25,2.45h-1.56l.85-8.4h3.46c2.2,0,3.46,1.13,3.27,3a3.05,3.05,0,0,1-2.06,2.65l1.66,2.76Zm-1.4-7.08h-1.82l-.34,3.35h1.82c1.37,0,2.14-.63,2.25-1.68S351.76,167.91,350.39,167.91Z"
                        id="elrkzvvussgu"
                        style="transform-origin: 350.089px 170.795px 0px;"
                        class="animable"></path><path
                        d="M360.71,173h-4.2l-1,2h-1.61l4.62-8.4H360L363,175h-1.63Zm-.39-1.22-1.22-3.67-1.94,3.67Z"
                        id="eluiduzt1nj7"
                        style="transform-origin: 358.45px 170.8px 0px;"
                        class="animable"></path><path
                        d="M363.76,170.79a4.83,4.83,0,0,1,4.93-4.32,3.83,3.83,0,0,1,3.18,1.4l-1.1.95a2.66,2.66,0,0,0-2.15-1,3.23,3.23,0,0,0-3.29,2.95,2.55,2.55,0,0,0,2.7,3,3.24,3.24,0,0,0,2.34-1l.91,1a4.71,4.71,0,0,1-3.47,1.41A3.81,3.81,0,0,1,363.76,170.79Z"
                        id="el67o8t60hmer"
                        style="transform-origin: 367.792px 170.827px 0px;"
                        class="animable"></path><path
                        d="M375,167.91H372.2l.13-1.32h7.12l-.13,1.32h-2.78l-.72,7.08h-1.55Z"
                        id="el2vzqj81b4eb"
                        style="transform-origin: 375.825px 170.79px 0px;"
                        class="animable"></path><path
                        d="M305.67,186.79h-34a1,1,0,0,1,0-2h34a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 288.67px 185.79px 0px;"
                        id="elmxmvdc3bn4s" class="animable"></path><path
                        d="M288.14,192.19h-17a1,1,0,0,1,0-2h17a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 279.64px 191.19px 0px;"
                        id="el6z9wmxr62ee" class="animable"></path><path
                        d="M409.91,220.42H268.32a1,1,0,0,1,0-2H409.91a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 339.115px 219.42px 0px;"
                        id="elyk6oa6lhs1d" class="animable"></path><path
                        d="M409.29,226.59H267.69a1,1,0,0,1,0-2h141.6a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 338.49px 225.59px 0px;"
                        id="elzbbk3vcp3wa" class="animable"></path><path
                        d="M408.67,232.75H267.07a1,1,0,0,1,0-2h141.6a1,1,0,1,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 337.87px 231.75px 0px;"
                        id="elvv4vrjt0ot" class="animable"></path><path
                        d="M408.05,238.91H266.45a1,1,0,0,1,0-2h141.6a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 337.25px 237.91px 0px;"
                        id="elti4axb0oirl" class="animable"></path><path
                        d="M407.42,245.07H265.83a1,1,0,0,1,0-2H407.42a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 336.625px 244.07px 0px;"
                        id="elpvbo6neryz" class="animable"></path><path
                        d="M406.8,251.24H265.21a1,1,0,0,1,0-2H406.8a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 336.005px 250.24px 0px;"
                        id="elvchpx9sudoe" class="animable"></path><path
                        d="M406.18,257.4H264.59a1,1,0,0,1,0-2H406.18a1,1,0,1,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 335.385px 256.4px 0px;"
                        id="elyoh1osis9el" class="animable"></path><path
                        d="M405.56,263.56H264a1,1,0,0,1,0-2H405.56a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 334.78px 262.56px 0px;"
                        id="el7afdkrlw8sf" class="animable"></path><path
                        d="M334.94,269.72H263.35a1,1,0,0,1,0-2h71.59a1,1,0,1,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 299.145px 268.72px 0px;"
                        id="elzed3advaptm" class="animable"></path><path
                        d="M414.35,186.79H389.93a1,1,0,0,1,0-2h24.42a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 402.14px 185.79px 0px;"
                        id="elxue2qklfwj" class="animable"></path><path
                        d="M404.16,278.08H277.64a1,1,0,0,1,0-2H404.16a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 340.9px 277.08px 0px;"
                        id="eli07tw1nbroc" class="animable"></path><path
                        d="M403.48,284.24H261.88a1,1,0,0,1,0-2h141.6a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 332.68px 283.24px 0px;"
                        id="elnxn0vi37p9h" class="animable"></path><path
                        d="M402.86,290.41H261.26a1,1,0,0,1,0-2h141.6a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 332.06px 289.41px 0px;"
                        id="elzdbzxqx1sc8" class="animable"></path><path
                        d="M402.23,296.57H260.64a1,1,0,0,1,0-2H402.23a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 331.435px 295.57px 0px;"
                        id="eled53ao0om44" class="animable"></path><path
                        d="M401.61,302.73H260a1,1,0,0,1,0-2H401.61a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 330.805px 301.73px 0px;"
                        id="el9rmenfzrau9" class="animable"></path><path
                        d="M311,308.9H259.4a1,1,0,0,1,0-2H311a1,1,0,0,1,0,2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 285.2px 307.9px 0px;"
                        id="elhv6limnkoq" class="animable"></path><g
                        id="elugzcxq1gpf"><g
                          style="opacity: 0.2; isolation: isolate; transform-origin: 334.6px 269.435px 0px;"
                          class="animable" id="elcqxwey2t4uq"><polygon
                            points="403.85 409.68 237.08 409.68 265.35 129.19 432.12 129.19 403.85 409.68"
                            id="elsvp4ld4d0yg"
                            style="transform-origin: 334.6px 269.435px 0px;"
                            class="animable"></polygon></g></g><path
                        d="M376.86,401.21H210.09c30.62-90.22,49.12-181.8,53.26-272H430.12C426,219.41,407.48,311,376.86,401.21Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 320.105px 265.21px 0px;"
                        id="el8erwhn1pkhg" class="animable"></path><path
                        d="M417.11,157.8H270.94a.52.52,0,0,1-.51-.49.47.47,0,0,1,.49-.48H417.08a.51.51,0,0,1,.52.48A.48.48,0,0,1,417.11,157.8Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 344.015px 157.315px 0px;"
                        id="el46t1ueqqkp2" class="animable"></path><path
                        d="M289.54,145a8.45,8.45,0,0,1-8.44,7.67,7.21,7.21,0,0,1-7.41-7.67,8.39,8.39,0,0,1,8.38-7.66A7.26,7.26,0,0,1,289.54,145Z"
                        style="fill: #4081FF; transform-origin: 281.613px 145.005px 0px;"
                        id="elg3sdcx5mu0t" class="animable"></path><path
                        d="M277.06,143.81s-4,5.43-2.71,7.09,12.82-7.65,15.49-10.83-.59-1.91-.58-1.91,1.25.06.63,1.05c-1.26,2-12.2,9.17-13.37,8.79S277.06,143.81,277.06,143.81Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 282.492px 144.503px 0px;"
                        id="elfkdcc5m7tzn" class="animable"></path><path
                        d="M416.32,142.39h-15a1,1,0,0,1-1.05-1,.94.94,0,0,1,1-1h15a1,1,0,0,1,1,1A.94.94,0,0,1,416.32,142.39Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 408.77px 141.39px 0px;"
                        id="eleoxzs2h60eg" class="animable"></path><path
                        d="M416,146.9h-9.69a1,1,0,0,1-1-1,.94.94,0,0,1,1-1H416a1,1,0,0,1,1,1A1,1,0,0,1,416,146.9Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 411.154px 145.899px 0px;"
                        id="elrlelsncq1yl" class="animable"></path><path
                        d="M415.73,151.4H390.41a1,1,0,0,1-1-1,.93.93,0,0,1,1-1h25.31a1,1,0,0,1,1,1A.94.94,0,0,1,415.73,151.4Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 403.065px 150.399px 0px;"
                        id="elaaypg0lx6kn" class="animable"></path><path
                        d="M309,169.41a4.68,4.68,0,0,1,4.86-4.18,4,4,0,0,1,3.2,1.36l-1.08.92a2.75,2.75,0,0,0-2.16-1,3.14,3.14,0,0,0-3.25,2.86,2.55,2.55,0,0,0,2.74,2.86,3.22,3.22,0,0,0,2.33-1l.92.93a4.71,4.71,0,0,1-3.46,1.36C310.53,173.59,308.78,171.84,309,169.41Z"
                        id="el1ynkoxxlfg7"
                        style="transform-origin: 313.021px 169.374px 0px;"
                        class="animable"></path><path
                        d="M317.54,169.41a4.71,4.71,0,0,1,4.89-4.18c2.6,0,4.37,1.76,4.15,4.18a4.71,4.71,0,0,1-4.9,4.18C319.08,173.59,317.33,171.82,317.54,169.41Zm7.47,0a2.55,2.55,0,0,0-2.7-2.86,3.14,3.14,0,0,0-3.2,2.86,2.54,2.54,0,0,0,2.69,2.86A3.15,3.15,0,0,0,325,169.41Z"
                        id="elx0ij2rcjwd8"
                        style="transform-origin: 322.061px 169.41px 0px;"
                        class="animable"></path><path
                        d="M336.06,165.35q-.35,4.07-.73,8.13h-1.28c-1.37-1.84-2.75-3.67-4.13-5.51-.16,1.84-.33,3.67-.5,5.51h-1.55q.39-4.06.73-8.13h1.28c1.39,1.83,2.77,3.67,4.15,5.5.16-1.83.33-3.67.48-5.5Z"
                        id="elxd6o5w7dct"
                        style="transform-origin: 331.965px 169.415px 0px;"
                        class="animable"></path><path
                        d="M339.91,166.62h-2.78c0-.42.07-.85.11-1.27h7.12c0,.42-.07.85-.11,1.27h-2.78c-.2,2.29-.4,4.57-.62,6.86h-1.56C339.51,171.19,339.71,168.91,339.91,166.62Z"
                        id="elxmtx9tcg4h"
                        style="transform-origin: 340.745px 169.415px 0px;"
                        class="animable"></path><path
                        d="M350.31,173.48l-1.5-2.38h-2.22c-.07.79-.14,1.58-.22,2.37h-1.55q.38-4.06.72-8.13H349c2.2,0,3.48,1.09,3.32,2.89a2.92,2.92,0,0,1-2,2.57c.57.89,1.13,1.78,1.69,2.67Zm-1.5-6.86H347c-.09,1.08-.19,2.16-.28,3.24h1.82c1.37,0,2.13-.6,2.22-1.62S350.18,166.62,348.81,166.62Z"
                        id="elpam1er7y09r"
                        style="transform-origin: 348.577px 169.41px 0px;"
                        class="animable"></path><path
                        d="M359.21,171.6H355l-1,1.88H352.4q2.27-4.06,4.5-8.13h1.54q1.55,4.07,3.06,8.13h-1.63Zm-.41-1.19c-.42-1.18-.84-2.37-1.27-3.55-.63,1.18-1.25,2.37-1.89,3.55Z"
                        id="elzbxc7jfchjs"
                        style="transform-origin: 356.95px 169.415px 0px;"
                        class="animable"></path><path
                        d="M362.23,169.41a4.68,4.68,0,0,1,4.86-4.18,4,4,0,0,1,3.21,1.36c-.37.3-.73.61-1.09.92a2.75,2.75,0,0,0-2.16-1,3.14,3.14,0,0,0-3.25,2.86,2.55,2.55,0,0,0,2.74,2.86,3.22,3.22,0,0,0,2.33-1l.92.93a4.71,4.71,0,0,1-3.46,1.36C363.76,173.59,362,171.84,362.23,169.41Z"
                        id="elkap8txy4gi"
                        style="transform-origin: 366.255px 169.374px 0px;"
                        class="animable"></path><path
                        d="M373.4,166.62h-2.78c0-.42.07-.85.11-1.27h7.12c0,.42-.07.85-.11,1.27H375c-.19,2.29-.4,4.57-.62,6.86h-1.55C373,171.19,373.21,168.91,373.4,166.62Z"
                        id="elkvqichvdz5k"
                        style="transform-origin: 374.235px 169.415px 0px;"
                        class="animable"></path><path
                        d="M304.24,184.92h-34a1,1,0,1,1,0-1.94h34a1,1,0,1,1,0,1.94Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 287.24px 183.95px 0px;"
                        id="el94q6hyhwnz6" class="animable"></path><path
                        d="M286.68,190.16h-17a1,1,0,0,1-1-1,1,1,0,0,1,1-1h17a1,1,0,0,1,1,1A1,1,0,0,1,286.68,190.16Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 278.18px 189.16px 0px;"
                        id="el3w9g1yh6smx" class="animable"></path><path
                        d="M407.83,217.56H266.24a1,1,0,0,1-1-1,1,1,0,0,1,1-1H407.9a1,1,0,0,1,1,1A1,1,0,0,1,407.83,217.56Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 337.07px 216.561px 0px;"
                        id="elwqknluq6wl8" class="animable"></path><path
                        d="M407,223.55H265.38a.93.93,0,0,1-1-1,1,1,0,0,1,1-1H407.05a.94.94,0,0,1,1,1A1,1,0,0,1,407,223.55Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 336.215px 222.55px 0px;"
                        id="eldu0skzuwb3k" class="animable"></path><path
                        d="M406.07,229.54H264.47a.94.94,0,0,1-1-1,1.05,1.05,0,0,1,1.05-1H406.16a1,1,0,0,1,1,1A1.06,1.06,0,0,1,406.07,229.54Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 335.314px 228.541px 0px;"
                        id="el7ruxte9s3jf" class="animable"></path><path
                        d="M405.13,235.53H263.53a.92.92,0,0,1-.94-1,1.06,1.06,0,0,1,1.05-1H405.23a.92.92,0,0,1,.95,1A1.06,1.06,0,0,1,405.13,235.53Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 334.385px 234.53px 0px;"
                        id="elq1lx7v6k6i" class="animable"></path><path
                        d="M404.15,241.52H262.56a.92.92,0,0,1-.94-1,1.06,1.06,0,0,1,1.06-1H404.27a.92.92,0,0,1,.94,1A1.07,1.07,0,0,1,404.15,241.52Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 333.415px 240.52px 0px;"
                        id="elbhxikk30w1j" class="animable"></path><path
                        d="M403.13,247.51H261.54a.91.91,0,0,1-.93-1,1.07,1.07,0,0,1,1.06-1H403.26a.92.92,0,0,1,.94,1A1.08,1.08,0,0,1,403.13,247.51Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 332.405px 246.51px 0px;"
                        id="el0vjn368jnwle" class="animable"></path><path
                        d="M402.08,253.5H260.48a.9.9,0,0,1-.92-1,1.08,1.08,0,0,1,1.07-1H402.22a.91.91,0,0,1,.93,1A1.08,1.08,0,0,1,402.08,253.5Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 331.354px 252.5px 0px;"
                        id="el4qzki0pa69k" class="animable"></path><path
                        d="M401,259.49H259.39a.89.89,0,0,1-.92-1,1.09,1.09,0,0,1,1.08-1H401.14a.89.89,0,0,1,.92,1A1.08,1.08,0,0,1,401,259.49Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 330.265px 258.49px 0px;"
                        id="elz3j716z7vya" class="animable"></path><path
                        d="M329.85,265.48H258.26a.89.89,0,0,1-.92-1,1.09,1.09,0,0,1,1.09-1H330a.89.89,0,0,1,.92,1A1.1,1.1,0,0,1,329.85,265.48Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 294.13px 264.48px 0px;"
                        id="el143mqex44ere" class="animable"></path><path
                        d="M412.92,184.92H388.5a1,1,0,1,1,0-1.94h24.42a1,1,0,1,1,0,1.94Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 400.71px 183.95px 0px;"
                        id="elis4tg6cgqe9" class="animable"></path><path
                        d="M398.32,273.61H271.8a.89.89,0,0,1-.91-1,1.11,1.11,0,0,1,1.1-1H398.5a.88.88,0,0,1,.91,1A1.11,1.11,0,0,1,398.32,273.61Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 335.151px 272.61px 0px;"
                        id="elw9h232yanvk" class="animable"></path><path
                        d="M397,279.6H255.44a.87.87,0,0,1-.9-1,1.11,1.11,0,0,1,1.1-1H397.23a.87.87,0,0,1,.9,1A1.12,1.12,0,0,1,397,279.6Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 326.335px 278.6px 0px;"
                        id="el06cq2fxb8w1w" class="animable"></path><path
                        d="M395.77,285.59H254.18a.87.87,0,0,1-.9-1,1.14,1.14,0,0,1,1.11-1H396a.88.88,0,0,1,.9,1A1.14,1.14,0,0,1,395.77,285.59Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 325.089px 284.59px 0px;"
                        id="elhgejftxm0rw" class="animable"></path><path
                        d="M394.47,291.58H252.88a.86.86,0,0,1-.89-1,1.14,1.14,0,0,1,1.11-1H394.7a.86.86,0,0,1,.88,1A1.14,1.14,0,0,1,394.47,291.58Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 323.785px 290.58px 0px;"
                        id="elkw9gahvoke" class="animable"></path><path
                        d="M393.13,297.57H251.54a.85.85,0,0,1-.88-1,1.15,1.15,0,0,1,1.12-1H393.37a.86.86,0,0,1,.88,1A1.14,1.14,0,0,1,393.13,297.57Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 322.454px 296.57px 0px;"
                        id="eln7nr016ytt" class="animable"></path><path
                        d="M301.76,303.56h-51.6a.85.85,0,0,1-.87-1,1.16,1.16,0,0,1,1.12-1H302a.85.85,0,0,1,.87,1A1.16,1.16,0,0,1,301.76,303.56Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 276.08px 302.56px 0px;"
                        id="elhxyrpmhqu26" class="animable"></path><g
                        id="eldqm9zi8jiir"><g
                          style="opacity: 0.1; transform-origin: 320.105px 265.21px 0px;"
                          class="animable" id="el0lczren3uva"><path
                            d="M376.86,401.21H210.09c30.62-90.22,49.12-181.8,53.26-272H430.12C426,219.41,407.48,311,376.86,401.21Z"
                            id="elfm2m17fgchd"
                            style="transform-origin: 320.105px 265.21px 0px;"
                            class="animable"></path></g></g><path
                        d="M354.22,383.55H187.45c38.46-84.36,63.92-170,75.9-254.36H430.12C418.14,213.55,392.68,299.19,354.22,383.55Z"
                        style="fill: rgb(255, 255, 255); transform-origin: 308.785px 256.37px 0px;"
                        id="elzhz7qmj3oc" class="animable"></path><path
                        d="M415.62,155.94H269.46a.44.44,0,0,1-.47-.45.51.51,0,0,1,.52-.46H415.68a.44.44,0,0,1,.47.46A.51.51,0,0,1,415.62,155.94Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 342.57px 155.485px 0px;"
                        id="eld05d79dhkdq" class="animable"></path><path
                        d="M289.17,143.94c-.63,3.95-4.73,7.16-9.11,7.16s-7.38-3.21-6.74-7.16,4.66-7.16,9-7.16S289.81,140,289.17,143.94Z"
                        style="fill: #4081FF; transform-origin: 281.243px 143.94px 0px;"
                        id="elx2wlomf66yi" class="animable"></path><path
                        d="M276.78,142.86s-4.5,5.08-3.32,6.63,13.49-7.15,16.43-10.13-.41-1.79-.41-1.79,1.25.07.54,1c-1.43,1.87-13,8.57-14.13,8.22S276.79,142.86,276.78,142.86Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 282.18px 143.504px 0px;"
                        id="el1q42ztbl163" class="animable"></path><path
                        d="M416.17,141.54h-15a.91.91,0,0,1-1-.91,1,1,0,0,1,1-.9h15a.89.89,0,0,1,1,.9A1,1,0,0,1,416.17,141.54Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 408.67px 140.634px 0px;"
                        id="elplwu9sguakb" class="animable"></path><path
                        d="M415.5,145.75h-9.69a.91.91,0,0,1-1-.91,1,1,0,0,1,1-.9h9.69a.89.89,0,0,1,1,.9A1,1,0,0,1,415.5,145.75Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 410.655px 144.844px 0px;"
                        id="elnk7wot7x3bn" class="animable"></path><path
                        d="M414.8,150H389.48a.9.9,0,0,1-1-.91,1,1,0,0,1,1.05-.9H414.9a.89.89,0,0,1,1,.9A1,1,0,0,1,414.8,150Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 402.19px 149.094px 0px;"
                        id="eliembclhnz4" class="animable"></path><path
                        d="M256.88,369.43H205.7a.67.67,0,0,1-.7-.91,1.44,1.44,0,0,1,1.29-.9h51.18a.66.66,0,0,1,.7.9A1.43,1.43,0,0,1,256.88,369.43Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 231.586px 368.524px 0px;"
                        id="elqmtqyzk1fa8" class="animable"></path><path
                        d="M348.78,369.43h-59a.67.67,0,0,1-.7-.91,1.44,1.44,0,0,1,1.29-.9h59.05a.67.67,0,0,1,.71.9A1.46,1.46,0,0,1,348.78,369.43Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 319.603px 368.525px 0px;"
                        id="eldf6d6ogkrh4" class="animable"></path><path
                        d="M266.08,317.06H238.94a.71.71,0,0,1-.76-.9,1.32,1.32,0,0,1,1.24-.91h27.13a.71.71,0,0,1,.76.91A1.31,1.31,0,0,1,266.08,317.06Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 252.747px 316.155px 0px;"
                        id="elqpc4ermxbut" class="animable"></path><path
                        d="M360.24,317.06H320.71a.71.71,0,0,1-.76-.9,1.32,1.32,0,0,1,1.24-.91h39.52a.71.71,0,0,1,.76.91A1.3,1.3,0,0,1,360.24,317.06Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 340.712px 316.155px 0px;"
                        id="eltcvhl5pg97" class="animable"></path><path
                        d="M317.11,358.83a4.94,4.94,0,0,1-2.42-.51c-1.27-.74-1.58-2-.89-3.62a7.41,7.41,0,0,1,.34-.7,44.65,44.65,0,0,1-12,2.94c-2.46.15-3.06-.81-3.12-1.65-.12-1.49,1.34-3.86,3.67-6.61-5.4,2.42-9.36,3.89-9.44,3.92-.29.11-.55,0-.6-.22a.59.59,0,0,1,.43-.6c.09,0,4.8-1.79,10.94-4.61,6.24-6.79,16.62-15.15,22-18,3.87-2,6.12-2.61,6.7-1.66.9,1.5-3.52,6-10.81,10.88a125.8,125.8,0,0,1-17.32,9.44c-2.81,3.09-4.66,5.74-4.55,7.18,0,.3.1,1.19,2.3,1a45.45,45.45,0,0,0,12.6-3.21c3.12-4.22,10.37-9.2,13.69-10,1.28-.32,1.79,0,2,.34s.27.88-.43,1.78c-1.77,2.29-7.91,5.9-14.67,8.57a8.13,8.13,0,0,0-.74,1.32c-.53,1.26-.32,2.15.66,2.72,2.24,1.29,8-.55,13.72-3.19a3.55,3.55,0,0,1,.28-.9c1.6-3.64,9.42-9.28,13.58-9,.83,0,1,.41,1,.71.09,1.32-3.43,3.77-6.4,5.6a83.19,83.19,0,0,1-7.45,4c.14.49.63.8,1.47.94,6.19,1,20.66-8.05,20.79-8.14a.51.51,0,0,1,.69,0,.5.5,0,0,1-.24.64c-.6.38-15.06,9.44-21.68,8.34a2.25,2.25,0,0,1-2-1.37C324.78,357.23,320.19,358.83,317.11,358.83Zm25.35-13.54c-3.66,0-10.72,5.15-12.08,8.25,0,.09-.08.17-.11.26,2.49-1.21,4.9-2.53,6.94-3.79,4.28-2.63,5.83-4.23,5.8-4.61,0,0-.09-.08-.34-.1Zm-13.2-1.73a2.44,2.44,0,0,0-.62.1c-2.86.71-8.92,4.83-12.11,8.51,6-2.5,11.3-5.63,12.83-7.62.3-.39.4-.67.29-.85A.44.44,0,0,0,329.26,343.56ZM331.39,328c-.61,0-2.05.37-5,1.95-5.16,2.74-14.19,10.07-20.25,16.29a120.84,120.84,0,0,0,15.29-8.48c7.68-5.18,10.76-9,10.36-9.65C331.73,328,331.61,328,331.39,328Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 322.909px 342.953px 0px;"
                        id="el2x8wjo1pyhn" class="animable"></path><path
                        d="M306.5,166.8a5.15,5.15,0,0,1,5.23-3.91,3.73,3.73,0,0,1,3.08,1.27l-1.16.86a2.56,2.56,0,0,0-2.08-.89,3.45,3.45,0,0,0-3.5,2.67c-.29,1.56.75,2.67,2.49,2.67a3.68,3.68,0,0,0,2.42-.9l.84.87a5.35,5.35,0,0,1-3.58,1.27C307.67,170.71,306.07,169.07,306.5,166.8Z"
                        id="elv6czcfkg0t"
                        style="transform-origin: 310.62px 166.796px 0px;"
                        class="animable"></path><path
                        d="M315.05,166.8a5.16,5.16,0,0,1,5.24-3.91c2.61,0,4.22,1.65,3.8,3.91a5.19,5.19,0,0,1-5.27,3.91C316.22,170.71,314.62,169.05,315.05,166.8Zm7.47,0a2.21,2.21,0,0,0-2.45-2.67,3.43,3.43,0,0,0-3.45,2.67c-.3,1.55.75,2.67,2.44,2.67A3.45,3.45,0,0,0,322.52,166.8Z"
                        id="el9n7gaa6ppl"
                        style="transform-origin: 319.568px 166.8px 0px;"
                        class="animable"></path><path
                        d="M333.92,163c-.47,2.53-.95,5.07-1.44,7.6H331.2l-3.65-5.15q-.48,2.58-1,5.15H325c.49-2.53,1-5.07,1.44-7.6h1.28q1.85,2.56,3.67,5.15l1-5.15Z"
                        id="el5ok55mpjs5p"
                        style="transform-origin: 329.46px 166.8px 0px;"
                        class="animable"></path><path
                        d="M337.66,164.19h-2.78c.07-.4.14-.79.22-1.19h7.12c-.07.4-.15.79-.22,1.19h-2.78c-.4,2.14-.8,4.28-1.22,6.41h-1.55Q337.07,167.41,337.66,164.19Z"
                        id="el76qv9o2cw7b"
                        style="transform-origin: 338.55px 166.8px 0px;"
                        class="animable"></path><path
                        d="M347.46,170.6l-1.29-2.23a1.77,1.77,0,0,1-.32,0H344l-.42,2.21H342c.49-2.53,1-5.07,1.43-7.6h3.45c2.21,0,3.39,1,3.08,2.7a3.14,3.14,0,0,1-2.24,2.4c.48.84,1,1.67,1.45,2.5Zm-.9-6.41h-1.82l-.57,3H346c1.37,0,2.19-.56,2.37-1.52S347.93,164.19,346.56,164.19Z"
                        id="el9pcmlltvidu"
                        style="transform-origin: 346.004px 166.79px 0px;"
                        class="animable"></path><path
                        d="M356.52,168.84h-4.2c-.38.59-.77,1.18-1.16,1.76h-1.61q2.63-3.79,5.21-7.6h1.54c.79,2.53,1.58,5.07,2.35,7.6H357C356.86,170,356.69,169.43,356.52,168.84Zm-.3-1.11-1-3.32c-.73,1.11-1.46,2.22-2.2,3.32Z"
                        id="elbvnpejjt8ct"
                        style="transform-origin: 354.1px 166.8px 0px;"
                        class="animable"></path><path
                        d="M359.73,166.8a5.15,5.15,0,0,1,5.23-3.91,3.75,3.75,0,0,1,3.09,1.27l-1.17.86a2.56,2.56,0,0,0-2.08-.89,3.45,3.45,0,0,0-3.5,2.67c-.29,1.56.75,2.67,2.49,2.67a3.68,3.68,0,0,0,2.42-.9l.84.87a5.35,5.35,0,0,1-3.58,1.27C360.9,170.71,359.31,169.07,359.73,166.8Z"
                        id="elry7ilvgd9p9"
                        style="transform-origin: 363.857px 166.796px 0px;"
                        class="animable"></path><path
                        d="M371.15,164.19h-2.78c.07-.4.14-.79.22-1.19h7.12c-.07.4-.14.79-.22,1.19h-2.78q-.6,3.21-1.21,6.41h-1.56C370.35,168.47,370.76,166.33,371.15,164.19Z"
                        id="ellog7jq223q"
                        style="transform-origin: 372.04px 166.8px 0px;"
                        class="animable"></path><path
                        d="M300.39,181.3h-34a.86.86,0,0,1-.92-.91,1.08,1.08,0,0,1,1.09-.9h34a.85.85,0,0,1,.92.9A1.07,1.07,0,0,1,300.39,181.3Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 283.475px 180.395px 0px;"
                        id="elujwhrny1lw" class="animable"></path><path
                        d="M282.39,186.2h-17a.85.85,0,0,1-.91-.91,1.09,1.09,0,0,1,1.1-.9h17a.85.85,0,0,1,.91.9A1.09,1.09,0,0,1,282.39,186.2Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 273.985px 185.295px 0px;"
                        id="el7acoz75rf1" class="animable"></path><path
                        d="M401.15,211.82H259.56a.81.81,0,0,1-.88-.9,1.13,1.13,0,0,1,1.12-.91H401.39a.82.82,0,0,1,.88.91A1.12,1.12,0,0,1,401.15,211.82Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 330.475px 210.915px 0px;"
                        id="elf3iyb0ov54j" class="animable"></path><path
                        d="M399.77,217.42H258.18a.81.81,0,0,1-.88-.91,1.13,1.13,0,0,1,1.13-.9H400a.82.82,0,0,1,.88.9A1.14,1.14,0,0,1,399.77,217.42Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 329.089px 216.516px 0px;"
                        id="elqr9jg3yrixd" class="animable"></path><path
                        d="M398.35,223H256.75a.8.8,0,0,1-.86-.91,1.15,1.15,0,0,1,1.13-.91H398.61a.82.82,0,0,1,.87.91A1.14,1.14,0,0,1,398.35,223Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 327.684px 222.091px 0px;"
                        id="elpznh1kv7kn" class="animable"></path><path
                        d="M396.89,228.62H255.29a.8.8,0,0,1-.86-.91,1.16,1.16,0,0,1,1.14-.9H397.16a.79.79,0,0,1,.86.9A1.14,1.14,0,0,1,396.89,228.62Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 326.225px 227.715px 0px;"
                        id="el15sxmik99erj" class="animable"></path><path
                        d="M395.39,234.22H253.79a.79.79,0,0,1-.85-.91,1.16,1.16,0,0,1,1.14-.9h141.6a.79.79,0,0,1,.85.9A1.15,1.15,0,0,1,395.39,234.22Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 324.734px 233.315px 0px;"
                        id="elg2gg92wm3ot" class="animable"></path><path
                        d="M393.85,239.83H252.26a.79.79,0,0,1-.85-.91,1.16,1.16,0,0,1,1.15-.91H394.15a.79.79,0,0,1,.85.91A1.18,1.18,0,0,1,393.85,239.83Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 323.205px 238.92px 0px;"
                        id="el1pyet6uef7z" class="animable"></path><path
                        d="M392.27,245.43H250.68a.78.78,0,0,1-.84-.91,1.18,1.18,0,0,1,1.15-.91h141.6a.78.78,0,0,1,.84.91A1.2,1.2,0,0,1,392.27,245.43Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 321.635px 244.52px 0px;"
                        id="el4wvem527sd7" class="animable"></path><path
                        d="M390.66,251H249.06a.78.78,0,0,1-.83-.91,1.2,1.2,0,0,1,1.16-.91H391a.78.78,0,0,1,.84.91A1.2,1.2,0,0,1,390.66,251Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 320.035px 250.09px 0px;"
                        id="elw5i3pnhhd" class="animable"></path><path
                        d="M319,256.63h-71.6a.77.77,0,0,1-.83-.91,1.22,1.22,0,0,1,1.17-.91h71.59a.78.78,0,0,1,.84.91A1.21,1.21,0,0,1,319,256.63Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 283.369px 255.72px 0px;"
                        id="el4bfm1boocjj" class="animable"></path><path
                        d="M409.07,181.3H384.66a.86.86,0,0,1-.92-.91,1.08,1.08,0,0,1,1.09-.9h24.42a.85.85,0,0,1,.91.9A1.07,1.07,0,0,1,409.07,181.3Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 396.95px 180.395px 0px;"
                        id="elf8bl36kshh9" class="animable"></path><path
                        d="M386.77,264.23H260.25a.76.76,0,0,1-.82-.91,1.21,1.21,0,0,1,1.17-.91H387.12a.76.76,0,0,1,.82.91A1.21,1.21,0,0,1,386.77,264.23Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 323.685px 263.32px 0px;"
                        id="el933imbyu88g" class="animable"></path><path
                        d="M385,269.83H243.37a.76.76,0,0,1-.82-.91,1.23,1.23,0,0,1,1.18-.91h141.6a.75.75,0,0,1,.81.91A1.23,1.23,0,0,1,385,269.83Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 314.346px 268.92px 0px;"
                        id="elufagczmrlno" class="animable"></path><path
                        d="M383.18,275.43H241.58a.75.75,0,0,1-.81-.91,1.24,1.24,0,0,1,1.19-.9h141.6a.75.75,0,0,1,.81.9A1.24,1.24,0,0,1,383.18,275.43Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 312.569px 274.525px 0px;"
                        id="el227msgq99p5" class="animable"></path><path
                        d="M381.36,281H239.76a.75.75,0,0,1-.8-.91,1.25,1.25,0,0,1,1.2-.91H381.75a.74.74,0,0,1,.8.91A1.26,1.26,0,0,1,381.36,281Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 310.756px 280.089px 0px;"
                        id="elhjne669734" class="animable"></path><path
                        d="M379.5,286.64H237.91a.75.75,0,0,1-.8-.91,1.25,1.25,0,0,1,1.2-.91h141.6a.73.73,0,0,1,.79.91A1.26,1.26,0,0,1,379.5,286.64Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 308.908px 285.729px 0px;"
                        id="elvjxgb5pyn9h" class="animable"></path><path
                        d="M287.6,292.24H236a.74.74,0,0,1-.79-.91,1.27,1.27,0,0,1,1.21-.91H288a.73.73,0,0,1,.79.91A1.27,1.27,0,0,1,287.6,292.24Z"
                        style="fill: rgb(38, 50, 56); transform-origin: 262.002px 291.329px 0px;"
                        id="el9xi8fqcnmwm" class="animable"></path><g
                        id="eltre2gkduxf"><g
                          style="opacity: 0.2; transform-origin: 302.372px 341.988px 0px;"
                          class="animable" id="elqcofxejp3x"><path
                            d="M282.23,337.13c.51-.45,1.79-1.44,2.55-2,.34-.26.77-.29,1-.06.43.52.86,1,1.28,1.57,0,0-1.42,1.59-1.88,2.13-4.6,5.45-7.35,10.69-7,11.69,4.7-.48,35.41-15.51,49.16-24.34-3.05-6.38-10.31-10.36-20.2-9.91-14.08.64-29.2,10.47-35.69,22.95a25.71,25.71,0,0,0-3.2,12.47A123,123,0,0,1,282.23,337.13Z"
                            id="elyyx7yieiycq"
                            style="transform-origin: 297.795px 333.903px 0px;"
                            class="animable"></path><path
                            d="M273.1,362.8c3.37,3.13,8.38,5,14.68,5,15.73,0,33.57-11.53,39.32-25.79a21.93,21.93,0,0,0,1.66-10.9C314.67,341.15,287.31,357.6,273.1,362.8Z"
                            id="el8sxduj2xaif"
                            style="transform-origin: 300.988px 349.455px 0px;"
                            class="animable"></path><path
                            d="M283.51,338.12c.05,0-20.68,18.28-17.92,23.85,2.93,5.58,55.09-25.72,68-36.49,13.09-10.74,0-6.45,0-6.44s4.44.22,1.15,3.54c-6.59,6.78-54.07,30.93-57.88,29.64S283.54,338.13,283.51,338.12Z"
                            id="elzqcwisg3jt"
                            style="transform-origin: 302.372px 340.408px 0px;"
                            class="animable"></path></g></g><path
                        d="M220.07,360.7c-7.35,0-8.82-2.85-8.75-5.31.25-7.28,14.45-19.73,29.25-25.62,8.13-3.23,14.61-3.44,16.52-.52,1.56,2.41-.36,6.39-5.32,10.93-9.8,9-17.9,11-21.48,9.06a3.31,3.31,0,0,1-1.24-1.12c-.9.42-1.89.86-3,1.31a.43.43,0,0,1-.62-.19.58.58,0,0,1,.4-.61c1.05-.45,2-.87,2.85-1.27a3.7,3.7,0,0,1,.68-2.89A7,7,0,0,1,235,341.4c.94.05,1.49.47,1.46,1.13-.06,1.3-2.3,3.07-6.39,5.1a2.6,2.6,0,0,0,.92.8c2.43,1.32,9.47,1,20.13-8.78,4.56-4.18,6.38-7.76,5-9.81-1.66-2.55-7.84-2.25-15.37.74-14.39,5.72-28.19,17.68-28.43,24.59-.1,3.21,3,4.81,8.94,4.61,7.62-.24,15.67-3.35,22.44-7,2.14-4.1,8.37-9.42,15-12.61,1.32-.64,2.08-.78,2.43-.46s.22.67-.16,1.25c-1.38,2.12-7.93,7.6-16.44,12.24-.11.24-.21.48-.29.7a2.43,2.43,0,0,0,.5,2.9c2.82,2.34,13.07-4.63,16.74-7.52a.55.55,0,0,1,.72,0c.16.16.09.45-.15.64-.55.45-14.15,11-18.13,7.65-1-.82-1.21-2.08-.67-3.64-6.87,3.61-14.84,6.56-22.21,6.79Zm40.17-20.24a5.93,5.93,0,0,0-1.23.48c-5.71,2.76-11.28,7.31-13.73,11a77.32,77.32,0,0,0,12-8.34A13.33,13.33,0,0,0,260.24,340.46Zm-25.68,1.84a5.66,5.66,0,0,0-4.28,2.45,2.86,2.86,0,0,0-.54,2.12c4.34-2.15,5.66-3.57,5.68-4.14,0-.35-.51-.41-.74-.42Z"
                        style="fill: #4081FF; transform-origin: 236.802px 343.958px 0px;"
                        id="elt6hc6vht84g" class="animable"></path></g><g
                      id="freepik--Character--inject-39"
                      style="transform-origin: 161.688px 271.204px 0px;"
                      class="animable"><g id="freepik--group--inject-39"
                        style="transform-origin: 161.688px 271.204px 0px;"
                        class="animable"><path
                          d="M184.58,177.11S166.15,158.88,144,157.75c0,0-13.18,31.92-19.57,63.58l43.89,7.82S174.39,196.3,184.58,177.11Z"
                          style="fill: #4081FF; transform-origin: 154.505px 193.45px 0px;"
                          id="el42nqsja9ees" class="animable"></path><g
                          id="elpzmnmemllje"><path
                            d="M184.58,177.11c-10.19,19.19-16.22,52-16.22,52l-43.89-7.82a328.51,328.51,0,0,1,8.83-33.49c2.4-7.61,4.76-14.32,6.65-19.47,2.43-6.6,4.09-10.62,4.09-10.62C166.15,158.88,184.58,177.11,184.58,177.11Z"
                            style="fill: rgb(255, 255, 255); opacity: 0.6; isolation: isolate; transform-origin: 154.525px 193.41px 0px;"
                            class="animable" id="elj28v9vzw41p"></path></g><path
                          d="M175.08,158.89c-.45.43-.9.88-1.31,1.35l-.22.26a10.1,10.1,0,0,0-2,3.39,5.9,5.9,0,0,0-.28,1.67,7.23,7.23,0,0,0,2.49,5.18c-.08,2.2-5.76.06-5.76.06s-8.35-4.46-9.41-9.53c3.21-.66,6.12-4.23,8.41-8.18.58-1,1.12-2,1.62-3.05.86-1.76,1.58-3.48,2.13-4.91Z"
                          style="fill: rgb(228, 137, 123); transform-origin: 166.835px 158.432px 0px;"
                          id="el186o6lhrboq" class="animable"></path><g
                          id="el7i5zvewoil5"><path
                            d="M173.77,160.24l-.22.26a10.1,10.1,0,0,0-2,3.39,5.9,5.9,0,0,0-.28,1.67c-2.45-2.33-5.57-6.73-4.27-12.47a14.5,14.5,0,0,1,1.34-3.6l.28.55Z"
                            style="opacity: 0.2; isolation: isolate; transform-origin: 170.232px 157.525px 0px;"
                            class="animable" id="elna6msahdnqn"></path></g><path
                          d="M196.1,140.11s-2.39,11-9.46,12.95.33-17.53.33-17.53Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 189.841px 144.364px 0px;"
                          id="el5el5azl8tx2" class="animable"></path><path
                          d="M167.39,155.23a10.12,10.12,0,0,0,9.48,7.82,11.58,11.58,0,0,0,8.78-3.42c5.15-5.34,10.27-16.17,5.12-22.93a11,11,0,0,0-18.64,1.77C168.46,145.61,166,149.64,167.39,155.23Z"
                          style="fill: rgb(228, 137, 123); transform-origin: 179.953px 147.699px 0px;"
                          id="elr3ona8jrtk" class="animable"></path><path
                          d="M181.49,146.59a1,1,0,0,0,.06,1.42c.38.22.94-.07,1.27-.63s.3-1.2-.06-1.41S181.83,146,181.49,146.59Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 182.136px 146.989px 0px;"
                          id="elr5jm78ueshs" class="animable"></path><path
                          d="M187.85,150.35a1,1,0,0,0,.07,1.41c.37.22.94-.07,1.27-.63s.3-1.19-.07-1.41S188.17,149.82,187.85,150.35Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 188.506px 150.742px 0px;"
                          id="elirq1blsy5li" class="animable"></path><path
                          d="M185.67,149.43a23.34,23.34,0,0,0-.16,6.41,3.77,3.77,0,0,1-3-1.09Z"
                          style="fill: rgb(222, 87, 83); transform-origin: 184.09px 152.642px 0px;"
                          id="el8lkmkudjfxq" class="animable"></path><path
                          d="M191.82,149a.39.39,0,0,1-.34-.21,3.1,3.1,0,0,0-2.21-1.67.39.39,0,0,1-.35-.42.38.38,0,0,1,.42-.34h0a3.78,3.78,0,0,1,2.81,2.08.38.38,0,0,1-.14.52h0A.58.58,0,0,1,191.82,149Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 190.56px 147.679px 0px;"
                          id="elpp8ohayw5s7" class="animable"></path><path
                          d="M181.73,143.3a.35.35,0,0,1-.15-.17.39.39,0,0,1,.31-.45h0a3.81,3.81,0,0,1,3.36,1,.37.37,0,0,1,0,.54h0a.39.39,0,0,1-.54,0h0a3.11,3.11,0,0,0-2.68-.73A.38.38,0,0,1,181.73,143.3Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 183.471px 143.47px 0px;"
                          id="elszujqaoe6y" class="animable"></path><path
                          d="M182.3,132.83,181,136.16a2.65,2.65,0,0,0-2.73,2.32c-.38,3.17-4,6.47-6.9,7,0,0,.53-1.17-.57-1.41s-4,5.84-3.59,9.67c0,0-1.49-4.06.2-11.15,1.56-6.55,3.91-11.45,6.27-13.06Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 174.452px 141.635px 0px;"
                          id="el1wi4wqouhxj" class="animable"></path><path
                          d="M165.76,142.35a7.66,7.66,0,0,0,1.81,5.56c1.75,2,4.11.81,4.86-1.62.65-2.16.56-5.88-1.81-7S166,139.88,165.76,142.35Z"
                          style="fill: rgb(228, 137, 123); transform-origin: 169.257px 143.93px 0px;"
                          id="elu7yb8wz9w5c" class="animable"></path><path
                          d="M181,156.28a21.35,21.35,0,0,0-2.34,1.95l-.43-.32c-1.93-1.48-2.34-2.81-2.21-3.83a3.07,3.07,0,0,1,.56-1.37,2.91,2.91,0,0,1,.57-.63,11.55,11.55,0,0,0,3.2,3.68C180.76,156.09,181,156.28,181,156.28Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 178.499px 155.155px 0px;"
                          id="elx5iyxvc888" class="animable"></path><path
                          d="M180.37,155.76l-.7.56c-1.82-1.4-2.92-2.62-3.07-3.61a2.91,2.91,0,0,1,.57-.63A11.55,11.55,0,0,0,180.37,155.76Z"
                          style="fill: rgb(255, 255, 255); transform-origin: 178.485px 154.2px 0px;"
                          id="elvghgwrr4zjk" class="animable"></path><path
                          d="M178.25,157.91c-1.93-1.48-2.34-2.81-2.21-3.83a7.83,7.83,0,0,1,1.82,2.07A2.86,2.86,0,0,1,178.25,157.91Z"
                          style="fill: rgb(222, 87, 83); transform-origin: 177.142px 155.995px 0px;"
                          id="elktzw2puycp" class="animable"></path><path
                          d="M181,136.16s14.41,12,16.79.12c0,0-6.92-8.71-15.29-10.24s-10.87,6.8-10.87,6.8Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 184.71px 133.691px 0px;"
                          id="elcbvazhafvga" class="animable"></path><path
                          d="M129.07,410.19H118.94a.75.75,0,0,0-.72.58l-1.64,7.43a1.24,1.24,0,0,0,1,1.46l.27,0c3.28-.05,5.67-.25,9.78-.25,2.54,0,10.19.26,13.7.26s3.95-3.46,2.52-3.78c-6.43-1.4-11.27-3.34-13.33-5.19A2,2,0,0,0,129.07,410.19Z"
                          id="ellmvbpvyw8sk"
                          style="transform-origin: 130.585px 414.928px 0px;"
                          class="animable"></path><path
                          d="M172.05,409.93H161.92a.73.73,0,0,0-.71.57l-1.65,7.43a1.25,1.25,0,0,0,1.22,1.49c3.28-.06,5.67-.26,9.79-.26,2.53,0,10.19.27,13.69.27s4-3.46,2.52-3.78c-6.43-1.4-11.27-3.34-13.33-5.19A2,2,0,0,0,172.05,409.93Z"
                          id="ell84xm7scupm"
                          style="transform-origin: 173.55px 414.68px 0px;"
                          class="animable"></path><path
                          d="M124.47,217.73l44.93,6.72c.52,2.81-.72,8.6-.72,8.6,5.21,34.09,15.53,114.48,7.23,178.11h-15s1.39-110.1-11.85-145.67c-1.52,19-17,145.59-17,145.59H116.81s2.28-47.6,4.57-92.57c1.2-23.75-1.26-72.6,1-90Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 147.919px 314.445px 0px;"
                          id="el2ijorpxjgme" class="animable"></path><g
                          id="el4y6w7asjme8"><path
                            d="M149.08,265.49A118.93,118.93,0,0,1,154,284.65c1.24-16.95-3.71-34.92-3.71-34.92Z"
                            style="opacity: 0.2; isolation: isolate; transform-origin: 151.64px 267.19px 0px;"
                            class="animable"
                            id="el0kvru0r0b6cj"></path></g><polygon
                          points="136.76 226.11 162.15 229.93 162.79 224.89 137.5 221.12 136.76 226.11"
                          id="ele43f70qiw"
                          style="transform-origin: 149.775px 225.525px 0px;"
                          class="animable"></polygon><polygon
                          points="135.35 220.79 123.8 219.07 122.85 224.02 134.67 225.79 135.35 220.79"
                          id="elezgkyu7uyj6"
                          style="transform-origin: 129.1px 222.43px 0px;"
                          class="animable"></polygon><polygon
                          points="164.78 225.19 163.85 230.18 168.78 230.92 169.4 225.88 164.78 225.19"
                          id="elibko0v1fon"
                          style="transform-origin: 166.625px 228.055px 0px;"
                          class="animable"></polygon><path
                          d="M155.34,223.8a2.35,2.35,0,0,0-1.45-.93l-4-.7a1.69,1.69,0,0,0-2,1.54l-.29,2.6a2.46,2.46,0,0,0,1.76,2.55l.17,0,4,.69a1.69,1.69,0,0,0,2-1.54l.29-2.59A2.37,2.37,0,0,0,155.34,223.8Zm-1.81,4.73-4-.7a1,1,0,0,1-.7-.44,1.16,1.16,0,0,1-.24-.81l.29-2.6a.82.82,0,0,1,1-.74l4,.7H154a1.21,1.21,0,0,1,.62.43,1.15,1.15,0,0,1,.23.81l-.05.39a.67.67,0,0,0-.15-.06l-1.12-.21a.6.6,0,0,0-.71.58.84.84,0,0,0,.66.83l1.12.21h.06l-.1.85A.83.83,0,0,1,153.53,228.53Z"
                          style="fill: rgb(255, 255, 255); transform-origin: 151.71px 225.86px 0px;"
                          id="ely65eni43deq" class="animable"></path><path
                          d="M161.26,168.37l1.53,7.42s-3.44,18.71,1.06,36l4.34,2.54,2.37-3.44s-6.72-16.91-5.15-33.73l4-5.46Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 165.91px 191.35px 0px;"
                          id="elynau7n4rn8h" class="animable"></path><path
                          d="M162,159.49l4.26,10,5.31-5.61,3.73,5.85a10.53,10.53,0,0,1-3.71,7.5l-5.5-5.53-8.38,1s-2.61-8.66-2-10.89S162,159.49,162,159.49Z"
                          style="fill: #4081FF; transform-origin: 165.459px 168.36px 0px;"
                          id="elj42zpiet35q" class="animable"></path><g
                          id="elnd7he2u9l0d"><path
                            d="M133.3,187.84c2.4-7.61,4.76-14.32,6.65-19.47l2.78-1.24S146.11,177.93,133.3,187.84Z"
                            style="opacity: 0.2; isolation: isolate; transform-origin: 138.217px 177.485px 0px;"
                            class="animable" id="elfcnnttv91rk"></path></g><g
                          id="eltaibppdpj4f"><path
                            d="M162,159.49l4.26,10,5.31-5.61,3.73,5.85a10.53,10.53,0,0,1-3.71,7.5l-5.5-5.53-8.38,1s-2.61-8.66-2-10.89S162,159.49,162,159.49Z"
                            style="fill: rgb(255, 255, 255); opacity: 0.4; isolation: isolate; transform-origin: 165.459px 168.36px 0px;"
                            class="animable"
                            id="el000lvrghrjitvr"></path></g><path
                          d="M144,157.75c-5.92-.29-17.89,13.82-20.92,16.33s-11.35,2.13-16.25-2.35c0,0-3.76-.75-5.38,1.82,0,0,8,11.4,19.24,10.16s18.58-12,18.58-12a24.64,24.64,0,0,0,4.73-7.28C145.64,160.36,144,157.75,144,157.75Z"
                          style="fill: #4081FF; transform-origin: 123.089px 170.775px 0px;"
                          id="elt2uqlf15b2j" class="animable"></path><g
                          id="ellfd9if6oma"><path
                            d="M144,157.75c-5.92-.29-17.89,13.82-20.92,16.33s-11.35,2.13-16.25-2.35c0,0-3.76-.75-5.38,1.82,0,0,8,11.4,19.24,10.16s18.58-12,18.58-12a24.64,24.64,0,0,0,4.73-7.28C145.64,160.36,144,157.75,144,157.75Z"
                            style="fill: rgb(255, 255, 255); opacity: 0.6; isolation: isolate; transform-origin: 123.089px 170.775px 0px;"
                            class="animable"
                            id="elltbtit5bf2a"></path></g><polygon
                          points="246.87 298.5 247.7 300.48 245.76 299.57 238.5 292.06 239.61 290.99 246.87 298.5"
                          style="fill: rgb(38, 50, 56); transform-origin: 243.1px 295.735px 0px;"
                          id="ely5lhs7sdoy" class="animable"></polygon><g
                          id="elbizvcplbxkk"><path
                            d="M83.25,121.65h4.87A1.38,1.38,0,0,1,89.5,123v21.13a0,0,0,0,1,0,0H81.87a0,0,0,0,1,0,0V123a1.38,1.38,0,0,1,1.38-1.38Z"
                            style="fill: rgb(38, 50, 56); transform-origin: 85.685px 132.875px 0px; transform: rotate(-44.1931deg);"
                            class="animable" id="eldidljty86rg"></path></g><g
                          id="elnsnedvpfyza"><path
                            d="M83.25,121.65h4.87A1.38,1.38,0,0,1,89.5,123v21.13a0,0,0,0,1,0,0H81.87a0,0,0,0,1,0,0V123a1.38,1.38,0,0,1,1.38-1.38Z"
                            style="fill: rgb(255, 255, 255); opacity: 0.1; isolation: isolate; transform-origin: 85.685px 132.875px 0px; transform: rotate(-44.1931deg);"
                            class="animable" id="ellycsiyt5e0f"></path></g><path
                          d="M93.68,133.7l-7.47,7.22a3.59,3.59,0,0,0-.17,5q66.15,73.47,137.51,142h0s10.39,8.42,20.48,10.57l1.85-1.78c-1.82-10.16-9.88-20.82-9.88-20.82h0Q169.94,202.36,98.66,133.69A3.59,3.59,0,0,0,93.68,133.7Z"
                          style="fill: #4081FF; transform-origin: 165.494px 215.591px 0px;"
                          id="el66wpid2cbl" class="animable"></path><path
                          d="M97.05,126.7l-12.6,12.18a1.06,1.06,0,0,0,0,1.51l1.22,1.27,12.81-12.39c19.35,18.21,33.93,34.87,33.93,34.87l-.5,1.36,4.56,2.77c-3.81-8.58-32.41-36.45-37.71-41.57A1.2,1.2,0,0,0,97.05,126.7Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 110.302px 147.306px 0px;"
                          id="elm69wq0b59zj" class="animable"></path><g
                          id="el2tdo5d34kjh"><rect x="147.01" y="205.26"
                            width="21.2" height="4.07"
                            style="fill: #4081FF; transform-origin: 157.61px 207.295px 0px; transform: rotate(-44.03deg);"
                            class="animable" id="el8qs2nq9nndt"></rect></g><path
                          d="M174.4,240.87q20.7,20.89,41.76,41.3a1.64,1.64,0,0,0,2.29,0l12-11.55a1.64,1.64,0,0,0,.07-2.29q-19.64-21.72-39.87-43.12a1.65,1.65,0,0,0-2.35-.05l-13.82,13.36A1.66,1.66,0,0,0,174.4,240.87Z"
                          style="fill: rgb(38, 50, 56); transform-origin: 202.452px 253.664px 0px;"
                          id="elbkjy5xgqn4c" class="animable"></path><g
                          id="el3dl9k6shjua"><rect x="147.01" y="205.26"
                            width="21.2" height="4.07"
                            style="opacity: 0.2; isolation: isolate; transform-origin: 157.61px 207.295px 0px; transform: rotate(-44.03deg);"
                            class="animable" id="elu9wb02fhur"></rect></g><g
                          id="elef7v8s7z5g6"><path
                            d="M97.05,126.7l-12.6,12.18a1.06,1.06,0,0,0,0,1.51l1.22,1.27,12.81-12.39c19.35,18.21,33.93,34.87,33.93,34.87l-.5,1.36,4.56,2.77c-3.81-8.58-32.41-36.45-37.71-41.57A1.2,1.2,0,0,0,97.05,126.7Z"
                            style="fill: rgb(255, 255, 255); opacity: 0.6; isolation: isolate; transform-origin: 110.302px 147.306px 0px;"
                            class="animable" id="elsixjv3py85"></path></g><g
                          id="elh1ym9kxor5i"><path
                            d="M174.4,240.87q20.7,20.89,41.76,41.3a1.64,1.64,0,0,0,2.29,0l12-11.55a1.64,1.64,0,0,0,.07-2.29q-19.64-21.72-39.87-43.12a1.65,1.65,0,0,0-2.35-.05l-13.82,13.36A1.66,1.66,0,0,0,174.4,240.87Z"
                            style="fill: rgb(255, 255, 255); opacity: 0.1; isolation: isolate; transform-origin: 202.452px 253.664px 0px;"
                            class="animable" id="eld8d7id3gi6"></path></g><path
                          d="M195.43,222.58l-1.17,1.57a4.54,4.54,0,0,0-3.61.64s.1,4,.27,4.5c.36,1.16,5.57,4.62,6.92,4.8.42.06,1.22-2.72,1.09-3.67a16.57,16.57,0,0,0-1.78-3.61l1-1.4Z"
                          style="fill: rgb(228, 137, 123); transform-origin: 194.797px 228.335px 0px;"
                          id="elqvis30fi51" class="animable"></path><path
                          d="M106.93,173.75l.16-1.26s.85.21,1.21-1.25,1.09-5.06.58-5.94a45.38,45.38,0,0,0-4.48-5c-.74-.64-2.47,2.4-2.86,3.81s1.57,6.88,1.57,6.88l-.08,2.37A4.45,4.45,0,0,0,106.93,173.75Z"
                          style="fill: rgb(228, 137, 123); transform-origin: 105.272px 167.121px 0px;"
                          id="el5vm3pdudnk7" class="animable"></path><path
                          d="M184.58,177.11c2.87,3.28,11.89,16.59,14.37,23.08,3.46,9.1,0,27.4,0,27.4l-6-4s1.13-13.93-.42-18.88-13.71-14.24-13.71-14.24A24,24,0,0,1,180.6,184,27.44,27.44,0,0,1,184.58,177.11Z"
                          style="fill: #4081FF; transform-origin: 189.654px 202.35px 0px;"
                          id="eln7j9far1asl" class="animable"></path><g
                          id="elike76tkawmm"><path
                            d="M199,227.59l-6-4s1.13-13.93-.42-18.88c-.88-2.8-5.17-7-8.72-10.11-2.71-2.38-5-4.13-5-4.13a23.59,23.59,0,0,1,1.63-6l.19-.45a27.44,27.44,0,0,1,4-6.84c2.87,3.28,11.89,16.59,14.37,23.08C202.41,209.29,199,227.59,199,227.59Z"
                            style="fill: rgb(255, 255, 255); opacity: 0.6; isolation: isolate; transform-origin: 189.695px 202.385px 0px;"
                            class="animable" id="elgwi4bphdt1d"></path></g><g
                          id="eldijbg001374"><path
                            d="M183.77,194.56c-2.71-2.38-5-4.13-5-4.13a23.59,23.59,0,0,1,1.63-6A19.73,19.73,0,0,1,183.77,194.56Z"
                            style="opacity: 0.2; isolation: isolate; transform-origin: 181.27px 189.495px 0px;"
                            class="animable"
                            id="el0vdwr2lnuvvs"></path></g></g></g><defs>
                      <filter id="active" height="200%"> <femorphology
                          in="SourceAlpha" result="DILATED" operator="dilate"
                          radius="2"></femorphology> <feflood
                          flood-color="#32DFEC" flood-opacity="1"
                          result="PINK"></feflood> <fecomposite in="PINK"
                          in2="DILATED" operator="in"
                          result="OUTLINE"></fecomposite> <femerge> <femergenode
                            in="OUTLINE"></femergenode> <femergenode
                            in="SourceGraphic"></femergenode> </femerge>
                      </filter> <filter id="hover" height="200%"> <femorphology
                          in="SourceAlpha" result="DILATED" operator="dilate"
                          radius="2"></femorphology> <feflood
                          flood-color="#ff0000" flood-opacity="0.5"
                          result="PINK"></feflood> <fecomposite in="PINK"
                          in2="DILATED" operator="in"
                          result="OUTLINE"></fecomposite> <femerge> <femergenode
                            in="OUTLINE"></femergenode> <femergenode
                            in="SourceGraphic"></femergenode> </femerge>
                        <fecolormatrix type="matrix"
                          values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 "></fecolormatrix>
                      </filter></defs></svg>
                  <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Mussum ipsum cacilds</h4>
                    <p class="text-muted mb-4"><i class="far fa-clock"
                        aria-hidden="true"></i> 2013</p>
                    <p class="mb-0">Temporibus autem quibusdam et aut officiis
                      debitis aut rerum necessitatibus
                      saepe eveniet ut et voluptates repudiandae sint et
                      molestiae non recusandae. Itaque earum rerum
                      hic tenetur a sapiente delectus, ut aut reiciendis
                      voluptatibus maiores alias consequatur aut
                      perferendis doloribus asperiores repellat.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </main>
        <footer class="bg-light text-center text-white">
          <!-- Grid container -->
          <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4">
              <!-- Facebook -->
              <a
                class="btn text-white btn-floating m-1"
                style="background-color: #3b5998;"
                href="#!"
                role="button"><i class="fab fa-facebook-f"></i></a>

              <!-- Twitter -->
              <a
                class="btn text-white btn-floating m-1"
                style="background-color: #55acee;"
                href="#!"
                role="button"><i class="fab fa-twitter"></i></a>

              <!-- Google -->
              <a
                class="btn text-white btn-floating m-1"
                style="background-color: #dd4b39;"
                href="#!"
                role="button"><i class="fab fa-google"></i></a>

              <!-- Instagram -->
              <a
                class="btn text-white btn-floating m-1"
                style="background-color: #ac2bac;"
                href="#!"
                role="button"><i class="fab fa-instagram"></i></a>

              <!-- Linkedin -->
              <a
                class="btn text-white btn-floating m-1"
                style="background-color: #0082ca;"
                href="#!"
                role="button"><i class="fab fa-linkedin-in"></i></a>
              <!-- Github -->
              <a
                class="btn text-white btn-floating m-1"
                style="background-color: #333333;"
                href="#!"
                role="button"><i class="fab fa-github"></i></a>
            </section>
            <!-- Section: Social media -->
          </div>
          <!-- Grid container -->

          <!-- Copyright -->
          <div class="text-center p-3"
            style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-white"
              href="https://mdbootstrap.com/">MDBootstrap.com</a>
          </div>
          <!-- Copyright -->
        </footer>
        <!-- MDB -->
        <script
          type="text/javascript"
          src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
      </body>

    </html>
