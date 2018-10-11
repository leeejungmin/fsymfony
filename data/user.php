<?php
include 'dbh.php';


$user = json_decode(file_get_contents('php://input'));
$output = array();
  // connect to the database
$result = mysqli_query($conn, "SELECT * FROM user;");






while($row = mysqli_fetch_array($result)){

  $output[] = $row;
      // $response[] = $row;

}
echo json_encode($output);
// echo $output[1,5];






  ?>
