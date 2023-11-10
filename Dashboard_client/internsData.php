<?php
   // Database Connection
   include '../config.php';

   // Reading value
   $draw = $_POST['draw'];
   $row = $_POST['start'];
   $rowperpage = $_POST['length']; // Rows display per page
   $columnIndex = $_POST['order'][0]['column']; // Column index
   $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
   $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
   $searchValue = $_POST['search']['value']; // Search value

   $searchArray = array();

   // Search
   $searchQuery = " ";
   if($searchValue != ''){
      $searchQuery = " AND (code_profile LIKE :code_profile OR 
           competence LIKE :competence OR
           designation LIKE :designation OR 
           disponibility LIKE :disponibility ) ";
      $searchArray = array( 
           'code_profile'=>"%$searchValue%",
           'competence'=>"%$searchValue%",
           'designation'=>"%$searchValue%",
           'disponibility'=>"%$searchValue%"
      );
   }

   // Total number of records without filtering
   $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM student ");
   $stmt->execute();
   $records = $stmt->fetch();
   $totalRecords = $records['allcount'];

   // Total number of records with filtering
   $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM student WHERE 1 ".$searchQuery);
   $stmt->execute($searchArray);
   $records = $stmt->fetch();
   $totalRecordwithFilter = $records['allcount'];

   // Fetch records
   $stmt = $conn->prepare("SELECT * FROM student WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

   // Bind values
   foreach ($searchArray as $key=>$search) {
      $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
   }

   $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
   $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
   $stmt->execute();
   $empRecords = $stmt->fetchAll();

   $data = array();
   $Edit ='<form action="./profile.html">
   <button type="submit"  class="btn btn-link btn-sm btn-rounded">
     Edit
   </button>';
   foreach ($empRecords as $row) {
      $data[] = array(
         "code_profile"=> ' <span class="badge badge-primary rounded-pill d-inline"
         >'.$row['code_profile'].'</span>',
         "competence"=>'<span class="badge bg-secondary">'.$row['competence'].'</span>',
         "designation"=>$row['designation'],
         "disponibility"=>$row['disponibility'],
         "edit" =>$Edit
      );
   }

   // Response
   $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $data
   );

   echo json_encode($response);