<?php  

   // Database Connection
   include '../config.php';
   $queryEtudiants = "SELECT * FROM student";
   $stmtEtudiants = $conn->prepare($queryEtudiants);
   $stmtEtudiants ->execute();
   $etudiants = $stmtEtudiants ->fetchAll(PDO::FETCH_ASSOC);
 

?>  
<!DOCTYPE html>  
<html>  
     <head>  
          <title>Webslesson Tutorial | Datatables Jquery Plugin with Php MySql and Bootstrap</title>  
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
          <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
          <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
          <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
     </head>  
     <body>  

          <div class="container">  
               <h3 align="center">Datatables Jquery Plugin with Php MySql and Bootstrap</h3>  
               <br />  
               <div class="table-responsive">  
                    <table id="employee_data" class="table table-striped table-bordered">  
                         <thead>  
                              <tr>  
                                   <td>code profile</td>  
                                   <td>Designation</td>  
                                   <td>disponibility</td>
                                   <td>competences</td>  
                                   <td>more details</td>  

                                 

                              </tr>  
                         </thead>  
                         <?php  
                     foreach ($etudiants as $row) 
                         {  
                              echo '  
                              <tr>  
                                   <td>'.$row["code_profile"].'</td>  
                                   <td>'.$row["designation"].'</td>  
                                   
                                   <td>'.$row["disponibility"].'</td>
                                   <td>competence</td>
                                   <td><form action="./profile.html">
                                   <button type="submit"  class="btn btn-link btn-sm btn-rounded">
                                     Edit
                                   </button></td>  
                              </tr>  
                              ';  
                         }  
                         ?>  
                    </table>  
               </div>  
          </div>  
     </body>  
</html>  
<script>  
$(document).ready(function(){  
     $('#employee_data').DataTable();  
});  
</script>