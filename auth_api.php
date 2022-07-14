<?php
require_once 'config.php';
session_start();

$response['script'] = 'auth_api.php';


if ( isset($_GET['delog']) ) :
    unset($_SESSION['id_user']);
    unset($_SESSION['token']);
    unset($_SESSION['expiration']);
    $response['response'] = "déconnection";
    $response['time'] = date('Y-m-d,H:i:s');
    $response['code'] = 200;
    echo json_encode($response);
    exit;
endif;

//connexion
$json = file_get_contents('php://input');
$arrayPOST = json_decode($json, true);

if ( !isset($arrayPOST['user_name']) OR !isset($arrayPOST['password'])) :
    $response['message'] = "Il manque login et/ou password";
    $response['code'] = 500;   
else:
    $sql = sprintf("SELECT * FROM user WHERE user_name = '%s' AND password = '%s'",
        $arrayPOST['user_name'],
        $arrayPOST['password']    
    );
    $result = $connect->query($sql);
    echo $connect->error;
    $nb_rows =  $result->num_rows;
    if($nb_rows == 0) :
        $response['message'] = 'error de log/pass';
        $response['code'] = 403;
    else :
        //$row = $result->fetch_all(MYSQLI_ASSOC);
        $row = $result->fetch_assoc();
        //$row = $row[0];
        //print_r($row);
        $_SESSION['id_user'] = (int)$row['id_user'];
        $_SESSION['token'] = md5($row['user_name'].time());
        $_SESSION['expiration'] = time() + 1 * 600;
        $response['response'] = "OK connecté";
        $response['token'] = $_SESSION['token'];
        $response['id_user'] = $_SESSION['id_user'];

    endif;
endif;

$response['code'] = ( isset($response['code']) ) ? $response['code'] : 200;

echo json_encode($response);
exit;