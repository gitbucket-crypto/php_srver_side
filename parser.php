<?php 
require_once('functions.php');
require_once('types.php');
require_once('database.php');

global $conn;

$conn = connect();

$SQL ="SELECT p.uid, p.raw_data, p.datetime, p.rmc_ip,p.rmc_mac,p.processed  FROM predatasets p  WHERE p.processed='0' LIMIT 1";
$stmt = $conn->query($SQL);
$data =  $stmt->fetchAll(\PDO::FETCH_ASSOC) or die('sem dados a serem processados');

?>