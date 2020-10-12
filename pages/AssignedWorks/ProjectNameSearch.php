<?php

$connect = mysqli_connect("localhost", "root", "", "db_engineering");
$request = mysqli_real_escape_string($connect, $_POST["query"]);
$query = "
 SELECT * FROM apollo_projectlist WHERE capex_number LIKE '%".$request."%'
";

$result = mysqli_query($connect, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $data[] = $row["capex_number"];
 }
 echo json_encode($data);
}
?>