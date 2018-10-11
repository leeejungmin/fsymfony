<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers:Origin, Content-Type, Authorization, X-Auth-Token');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS');
include 'dbh.php';



// $user = json_decode(file_get_contents('php://input'));
$output = array();
  // connect to the database
  $sql =  "SELECT * FROM user";
  $result = mysqli_query($conn, $sql);




while($row = mysqli_fetch_array($result)){

  $output[] = $row;
      // $response[] = $row;

}
echo json_encode($output);
// echo 'heeeeeeello jungmin';

Rout::post('save', 'CustomerController@customerCreate');




  ?>
