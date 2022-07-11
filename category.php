<?php 
require_once 'config.php';

/* Gestion du GET */
if($_SERVER['REQUEST_METHOD'] == 'GET') :
  if(isset($_GET['id_category'])):
    $req_cat = sprintf("SELECT * FROM category LEFT JOIN topic ON category.id_category = topic.id_category LEFT JOIN message ON topic.id_topic = message.id_topic WHERE category.id_category = %d",
    $_GET['id_category']);
    $categorie['response'] = "One specific category";
  else :
    $req_cat = "SELECT * FROM category ORDER BY id_category ASC";
    $category['response'] = "All categories";
  endif;
  $result = $connect->query($req_cat);
  echo $connect->error;
  $category['code'] = 200;
  $category['time'] = date('Y-m-d,H:i:s');
  $category['nbhits']= $result->num_rows;
  while($row = $result->fetch_assoc()):
    $category['data'][] = $row;
  endwhile;
endif;

if($_SERVER['REQUEST_METHOD'] != 'GET') : 
  $category['response'] = "vous nêtes pas autorisés à modifier les catégories";
  $category['code'] = 400;
endif;

//myPrint_r($category);
echo json_encode($category);


?>