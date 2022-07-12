<?php
require_once 'config.php';

/* Gestion du GET */
if($_SERVER['REQUEST_METHOD'] == 'GET') :
  if(isset($_GET['id_user'])):
    $req_user = sprintf(
      "SELECT 
         u.id_user,
        u.user_name,
        u.email,
        u.registration_date,
        SUM(CASE WHEN u.id_user = m.id_user THEN 1 ELSE 0 END) AS nb_message,
        SUM(CASE WHEN m.is_topic_starter = true THEN 1 ELSE 0 END) AS nb_topic
      FROM user u 
      INNER JOIN message m ON u.id_user = m.id_user
      INNER JOIN topic t ON m.id_topic = t.id_topic
      WHERE u.id_user = %d",
    $_GET['id_user']);
    $user['response']['message'] = "A specific user";
    $req_user_mess = sprintf(
      "SELECT 
          u.id_user,
          m.id_topic,
          t.topic_name,
          m.date_message,
          m.message
      FROM user u 
      INNER JOIN message m ON u.id_user = m.id_user
      INNER JOIN topic t ON m.id_topic = t.id_topic
      WHERE u.id_user = %d
    ",
    $_GET['id_user']);
  else:
    $req_user = "SELECT * FROM user";
    $user['response']['message'] = "All users";
  endif;
  $result = $connect->query($req_user);
  echo $connect->error;
  $user['response']['code'] = 200;
  $user['response']['time'] = date('Y-m-d,H:i:s');
  $user['response']['nbhits'] = $result->num_rows;
  while($row = $result->fetch_assoc()):
    $user['data'][] = $row;
  endwhile;
  $result2 = $connect->query($req_user_mess);
  echo $connect->error;
  while($row = $result2->fetch_assoc()):
    $user['messages'][] = $row;
  endwhile;
endif;

echo json_encode($user);
?>