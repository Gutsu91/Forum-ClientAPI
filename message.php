<?php
require_once 'config.php';
require_once "verif_auth.php";

/* Gestion du GET */
if($_SERVER['REQUEST_METHOD'] == 'GET') :
// il faudra complexifier la requête pour check si l'id message est dedans, on en aura besoin pour l'edit des message
  if(isset($_GET['id_topic'])):
    $req_message = sprintf("SELECT * FROM message WHERE id_topic=%d",
    $_GET['id_topic']);
    $result = $connect->query($req_message);
    $message['response']['code'] = 200;
    $message['response']['time'] = date('Y-m-d,H:i:s');
    $message['response']['nbhits'] = $result->num_rows;
    $message['response']['message'] = "All message from one specific topic";
    while($row = $result->fetch_assoc()):
      $message['data'][] = $row;
    endwhile;
  endif;
endif;


/* Gestion du POST */
if($_SERVER['REQUEST_METHOD'] == 'POST') :
  $json = file_get_contents('php://input');
  $arrayPOST = json_decode($json, true);
  if(isset($arrayPOST['id_topic']) AND isset($arrayPOST['message']) AND isset($_SESSION['id_user'])) :
      $req_message = sprintf(
        "INSERT INTO message SET id_topic=%d, message='%s', id_user=%d, is_topic_starter='false'",
        $arrayPOST['id_topic'],
        addslashes(strip_tags($arrayPOST['message'])),
        $_SESSION['user']
      );
      $connect->query($req_message);
      echo $connect->error;
      $message['response']['sql'] = $req_message;
      $message['response']['code'] = 200;
      $message['response']['time'] = date('Y-m-d,H:i:s');
      $message['response']['message'] = "Ajout du message '" . $arrayPOST['message'] ."' sur le topic";
      $message['response']['sql'] = $req_message;
    else:
      if(isset($_GET['id_topic']) AND isset($arrayPOST['message']) AND isset($_SESSION['id_user'])):
        $req_message = sprintf(
          "INSERT INTO message SET id_topic=%d, message='%s', id_user=%d, is_topic_starter='false'",
        $_GET['id_topic'],
        addslashes(strip_tags($arrayPOST['message'])),
        $_SESSION['id_user']
      );
      $connect->query($req_message);
      echo $connect->error;
      $message['response']['sql'] = $req_message;
      $message['response']['code'] = 200;
      $message['response']['time'] = date('Y-m-d,H:i:s');
      $message['response']['message'] = "Ajout du message '" . $arrayPOST['message'] ."' sur le topic";
      $message['response']['sql'] = $req_message;
    else:
      $message['response']['code'] = 400;
      $message['response']['time'] = date('Y-m-d,H:i:s');
      $message['response']['message'] = "Il vous manque au moins l'un des éléments suivant: id_topic, message, id_user";
    endif;
  endif;
endif;

echo json_encode($message);
 ?>