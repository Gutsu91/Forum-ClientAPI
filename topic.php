<?php
require_once 'config.php';

/* Gestion du GET */
if($_SERVER['REQUEST_METHOD'] = 'GET') :
  if(isset($_GET['id_topic'])):
    //$req_topic = sprintf("SELECT * FROM topic LEFT JOIN message ON topic.id_topic = message.id_topic WHERE topic.id_topic=%d",
    $req_topic = sprintf(
      "SELECT 
	      id_message, date_message, message, m.id_user, m.id_topic, t.topic_name, u.user_name
      FROM message m
      LEFT JOIN topic t
        ON m.id_topic = t.id_topic 
      LEFT JOIN user u
        ON m.id_user = u.id_user
      WHERE m.id_topic = 1",
    $_GET['id_topic']);
    $topic['response']['message'] = "One specific topic";
  else:
    $req_topic = ("SELECT * FROM topic");
    $topic['response']['message'] = "All topics";
  endif;
  $result = $connect->query($req_topic);
  echo $connect->error;
  $topic['response']['code'] = 200;
  $topic['response']['time'] = date('Y-m-d,H:i:s');
  $topic['response']['nbhits'] = $result->num_rows;
  while($row = $result->fetch_assoc()):
    $topic['data'][] = $row;
  endwhile;
endif;


echo json_encode($topic);
?>