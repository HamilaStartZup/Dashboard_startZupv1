<?php
//index.php




?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <base href="/Dashboard_startZupv1/Dashboard_client/">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
 <script>
  
 $(document).ready(function() {

  var calendar = $('#calendar').fullCalendar({
   eventColor: '#A648C2',
   editable:true,
   header:{
    left:'prev,next today',
    center:'title',
    right:'month,agendaWeek,agendaDay'
   },
   dayClick: function(date, jsEvent, view) {

//alert('Clicked on: ' + date.format());

//alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

//alert('Current view: ' + view.name);

// change the day's background color just for fun
//$(this).css('background-color', 'red');

},
   events: './calendarClient/load.php',

   selectable:true,
   selectHelper:true,
   select: function(start, end, allDay)
   {
   
    

   },
   editable:true,
   eventResize:function(event)
   {
    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
    var title = event.title;
    var id = event.id;
    $.ajax({
     url:"./calendarAdmin/update.php",
     type:"POST",
     data:{title:title, start:start, end:end, id:id},
     success:function(){
      calendar.fullCalendar('refetchEvents');
      alert('Event Update');
     }
    })
   },

   eventDrop:function(event)
   {
    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
    var title = event.title;
    var id = event.id;
    $.ajax({
     url:"./calendarAdmin/update.php",
     type:"POST",
     data:{title:title, start:start, end:end, id:id},
     success:function()
     {
      calendar.fullCalendar('refetchEvents');
      alert("Event Updated");
     }
    });
   },

  eventClick:function(event)
   {
    if(confirm("Are you sure you want to remove it?"))
    {
     var id = event.id;
     $.ajax({
      url:"./calendarAdmin/delete.php",
      type:"POST",
      data:{id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Removed");
      }
     })
    }
   },

  });
 });
  
 </script>
  <style>
    body {
        background-color: #fbfbfb;
    }

    @media (min-width: 991.98px) {
      main {
        width: 100%;
      }
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

    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: 0.5rem;
        overflow-x: hidden;
        overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
    }
    .pagination{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 1rem;
    }
    .pagination a{
        margin: 0 0.5rem;
    }
  </style>

 </head>
 <body>
<!-- Main Navigation -->
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
<!-- Main Navigation -->
  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container">
  

      <!--Section: Sales Performance KPIs-->
    
        <div class="card">
          <div class="card-header text-center py-3">
            <h5 class="mb-0 text-center">
              <strong>CALENDRIER  </strong>
            </h5>
          </div>
          <div class="card-body">
          <div id="calendar"></div>
      
          </div>
        </div>
   
      <!--Section: Statistics with subtitles-->

    
    </div>
  </main>
 </body>
   <!--Main layout-->
  <!-- MDB -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"
  ></script>
  <!-- MDB -->
  <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"
  ></script>
</html>
