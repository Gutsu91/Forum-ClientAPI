<?php
require_once 'config.php';

/* Gestion du GET */
if($_SERVER['REQUEST_METHOD'] == 'GET') :
  if(isset($_GET['id_topic'])) :
    $req_topic = sprintf("SELECT * FROM topic WHERE id_topic=%d",
  $_GET['id_topic']);
  $response['response']['message'] = 'a specific topic';
  $response['response']['code'] = 200;
  else :
    $req_topic = "SELECT * FROM topic ORDER BY id_topic ASC";
    $response['response']['message'] = 'all topics';
    $response['response']['code'] = 200;
  endif;
  $result = $connect->query($req_topic);
  echo $connect->error;
  while($row = $result->fetch_assoc()):
    $response['data'][] = $row;
  endwhile;
  $response['response']['nbhits'] = $result->num_rows;
endif;

echo json_encode($response);
?>