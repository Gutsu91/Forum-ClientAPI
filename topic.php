<?php
require_once 'config.php';

/* Gestion du GET */
if($_SERVER['REQUEST_METHOD'] == 'GET') :
  if(isset($_GET['id_topic'])):
    //$req_topic = sprintf("SELECT * FROM topic LEFT JOIN message ON topic.id_topic = message.id_topic WHERE topic.id_topic=%d",
    $req_topic = sprintf(
      "SELECT 
	      id_message, date_message, message, m.id_user, m.id_topic, t.topic_name, u.user_name, t.id_category, c.name_category
      FROM message m
      LEFT JOIN topic t ON m.id_topic = t.id_topic 
      LEFT JOIN user u ON m.id_user = u.id_user
      LEFT JOIN category c ON t.id_category = c.id_category
      WHERE m.id_topic = %d",
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
  // ci-dessous, req pour passer les user dans un nouvel objet pour pouvoir afficher le nombre de message / user. Ne marche pas donc je désactive
  /*$req_user = "SELECT
      SUM(CASE WHEN m.id_user = m.id_user THEN 1 ELSE 0 END) AS nb_message,
      m.id_user,
      u.user_name,
      u.registration_date
    FROM message m
    INNER JOIN user u ON m.id_user = u.id_user
    GROUP BY m.id_user";
    $result2 = $connect->query($req_user);
    echo $connect->error;
    while($row = $result2->fetch_assoc()):
      $topic['user'][] = $row;
    endwhile;*/
endif;

/* Gestion du POST */
if($_SERVER['REQUEST_METHOD'] == 'POST'):
  $json = file_get_contents('php://input');
  $arrayPOST = json_decode($json, true);
  if(isset($arrayPOST['id_category']) AND isset($arrayPOST['topic_name']) AND (isset($arrayPOST['message']))) :
    $req_topic = sprintf("INSERT INTO topic SET id_category=%d, topic_name='%s'",
                addslashes(strip_tags($arrayPOST['id_category'])), 
                addslashes(strip_tags($arrayPOST['topic_name']))
              );
    $connect->query($req_topic);
    echo $connect->error;
    $topic_id = $connect->insert_id;
    $req_message = sprintf("INSERT INTO message SET message='%s', id_user=%d, id_topic=%d, is_topic_starter = true",
                addslashes(strip_tags($arrayPOST['message'])),
                $arrayPOST['id_user'],
                $topic_id);
    $connect->query($req_message);
    echo $connect->error;
    $topic['response']['code'] = 200;
    $topic['response']['time'] = date('Y-m-d,H:i:s');
    $topic['response']['message'] = "Ajout du topic '" . $arrayPOST['topic_name'] . "' avec l'id " . $topic_id ;
    $topic['data']['id_topic'] = $topic_id;
    $topic['data']['topic_name'] = $arrayPOST['topic_name'];
    $topic['data']['id_category'] = $arrayPOST['id_category'];
    $topic['data']['message'] = $arrayPOST['message'];
  else:
    $topic['response']['code'] = 400;
    $topic['response']['time'] = date('Y-m-d,H:i:s');
    $topic['response']['message'] = "Il manque l'id de la catégorie et le nom du topic";
  endif; 
  
endif;


echo json_encode($topic);
?>