<?php 
require_once 'config.php';

/* Gestion du GET */
if($_SERVER['REQUEST_METHOD'] == 'GET') :
  if(isset($_GET['id_category'])):
    $req_cat = sprintf(
      "SELECT 
        c.id_category, 
        c.name_category, 
        t.id_topic, 
        t.topic_name,
        m.id_message, 
        m.id_user, 
        m.date_message,
        u.user_name,
        COUNT(m.id_message) AS nb_message,
        MAX(date_message) AS latest
      FROM category c
      LEFT JOIN topic t
        ON c.id_category = t.id_category 
      LEFT JOIN message m
        ON t.id_topic = m.id_topic
      LEFT JOIN user u
        ON m.id_user = u.id_user
      WHERE c.id_category = %d
      GROUP BY t.id_topic
      ORDER BY t.id_topic",
    $_GET['id_category']);
    $categorie['response']['message'] = "One specific category";
  else :
    $req_cat = 
    "SELECT
      c.name_category, 
      t.topic_name, 
      c.id_category,
      MAX(m.date_message) AS max_message,
      SUM(CASE WHEN m.id_message = m.id_message THEN 1 ELSE 0 END) AS nb_message,
      sum(CASE WHEN m.is_topic_starter = true THEN 1 ELSE 0 END) AS nb_topic,
      u.user_name,
      m.id_topic,
      m.id_message
  FROM message m
  INNER JOIN topic t on m.id_topic = t.id_topic
  INNER JOIN category c ON t.id_category = c.id_category
  INNER JOIN user u ON m.id_user = u.id_user
  GROUP BY c.name_category
  ORDER BY c.id_category
    ";
    $category['response']['message'] = "All categories";
  endif;
  $result = $connect->query($req_cat);
  echo $connect->error;
  $category['response']['code'] = 200;
  $category['response']['time'] = date('Y-m-d,H:i:s');
  $category['response']['nbhits']= $result->num_rows;
  while($row = $result->fetch_assoc()):
    $category['data'][] = $row;
  endwhile;
endif;

if($_SERVER['REQUEST_METHOD'] != 'GET') : 
  $category['response']['response'] = "vous nêtes pas autorisés à modifier les catégories";
  $category['response']['code'] = 400;
endif;

//myPrint_r($category);
echo json_encode($category);


?>