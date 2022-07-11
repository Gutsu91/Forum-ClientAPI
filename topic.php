<?php
require_once 'config.php';

/* Gestion du GET */
if($_SERVER['REQUEST_METHOD'] = 'GET') :
  if(isset($_GET['id_topic'])):
    $req_topic = sprintf("SELECT * FROM topic LEFT JOIN message ON topic.id_topic = message.id_topic WHERE topic.id_topic=%d",
    $_GET['id_topic']);
    $topic['response'] = "One specific topic";
  else:
    $req_topic = ("SELECT * FROM topic");
    $topic['response'] = "All topics";
  endif;
  $result = $connect->query($req_topic);
  echo $connect->error;
  $topic['code'] = 200;
  $topic['time'] = date('Y-m-d,H:i:s');
  $topic['nbhits'] = $result->num_rows;
  while($row = $result->fetch_assoc()):
    $topic['data'][] = $row;
  endwhile;
endif;


echo json_encode($topic);
?>