<?php 
date_default_timezone_set('America/Sao_Paulo');
require_once('database.php');
session_start();
bootstrap();



function bootstrap()
{
    switch($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
            if(!isset($_GET['csrf']) | $_GET['csrf']=='')
            {
                echo  json_encode(
                    ['status' => 403,
                    'message' => "CSRF token not present."]
                );
                echo http_response_code(403); exit;
            }
            if(strlen($_GET['csrf'])<32)
            {
               echo http_response_code(400); exit;
            }
        break;
        case 'POST':
            if(!isset($_POST['csrf']) | $_POST['csrf']=='')
            {
                echo  json_encode(
                    ['status' => 403,
                    'message' => "CSRF token not present."]
                );
                echo http_response_code(403); exit;
            }
            if(strlen($_POST['csfr'])<32)
            {
                echo http_response_code(400); exit;
            }
        break;
        default: echo http_response_code(405); exit;
    }
}


if(empty($_REQUEST))
{
    echo json_encode(
        ['status' => 200,
        'message' => "Data not present."]);
    exit;
}

$macNuc  = $_REQUEST["macNuc"];
$ipModen = $_REQUEST["publicIP"];
$localIP = $_REQUEST["localIP"];
$rmcIP   = $_REQUEST["rmcIP"];
$data    = $_REQUEST['rmc_data'];

$uid = uniqid('2ysa');

$datetime =  date("Y/m/d H:i:s");    

$conn = connect();

$SQL="INSERT INTO public.predatasets (uid, raw_data, raw_bytes, datetime, rmc_ip, processed, ip_modem, nuc_ip) VALUES( ?, ?, ? , ? , ? , ? , ?, ?  )";
$stmt= $pdo->prepare($SQL);
$stmt->execute([$uid, $data, $data ,$datetime, $rmcIP, '0', $ipModen , $localIP]);

var_dump($data);

echo json_encode(
    ['status' => 200,
    'message' => "Data Saved"]);
exit

?>
