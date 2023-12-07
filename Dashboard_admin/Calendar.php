<?php
//index.php




?>
<!DOCTYPE html>
<html>
<head>
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
   events: './calendarAdmin/load.php',

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
      mail();
   
    
    
   

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
      mail();
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
            padding-left: 240px;
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
    <!-- Sidebar -->
<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
  <div class="position-sticky">
    <div class="list-group list-group-flush mx-3 mt-4">
      <a
          href="./dashboard.php"
          class="list-group-item list-group-item-action py-2 ripple  "
         
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
          href="./List_rdv.php"
          class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-lock fa-fw me-3"></i><span>Gérer RDV</span></a
        >
      <a
          href="#"
          class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-chart-line fa-fw me-3"></i
        ><span>Analytics</span></a
        >
      <a
          href="#"
          class="list-group-item list-group-item-action py-2 ripple active"
          aria-current="true"
          >
          <i class="fas fa-calendar fa-fw me-3"></i><span>CALENDRIER</span>
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
          href="listeAppels.php"
          class="list-group-item list-group-item-action py-2 ripple ripple s"
          ><i class="fa-sharp fa-solid fa-list me-3"></i>
          <span>Liste d'appels</span></a
        >
      <a
          href="./presence.php"
          class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-calendar fa-fw me-3"></i
        ><span>Présence</span></a
        >
      <a
          href="./add_client_admin.php"
          class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-users fa-fw me-3"></i><span>Ajouter client & administrateur</span></a
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
<!-- Main Navigation -->
  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">
  

      <!--Section: Sales Performance KPIs-->
      <section class="mb-4">
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
      </section>
      <!--Section: Statistics with subtitles-->

    
    </div>
  </main>
 </body>
   <!--Main layout-->
  <!-- MDB -->
<script>
  function mail(){
    var email = ['start-zup@gmail.com'];

var subject = 'Entretien de planification pour le candidat: ';
 var body = 'Salut star_ZUP \n, je vais choisir le candidat avec le code : pour un entretien. Je suis disponible pour les trois plages horaires suivantes  :';
var mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
window.location.href = mailtoLink;
  }

</script>
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
