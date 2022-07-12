<?php
require_once 'config.php';

/* Gestion du GET */
if($_SERVER['REQUEST_METHOD'] == 'GET') :
  if(isset($_GET['id_category'])) :
    $req_cat = sprintf("SELECT * FROM category WHERE id_category=%d",
    $_GET['id_category']);
    $response['response']['message'] = 'One specific category';
    $response['response']['code'] = 200;
  else :
    $req_cat = "SELECT * FROM category ORDER BY id_category ASC";
    $response['response']['message'] = 'All categories';
    $response['response']['code'] = 200;
  endif;
  $result = $connect->query($req_cat);
  echo $connect->error;
  while($row = $result->fetch_assoc()):
    $response['data'][] = $row;
  endwhile;
  $response['response']['nbhits'] = $result->num_rows;
endif;

echo json_encode($response);
?>