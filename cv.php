<?php
// Projekt - Webbutveckling III - Moa Hjemdahl 2019

include('includes/config.php');

//Header information and allowance
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT");

// Conditions for methods
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

// URL conditions
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

if($request[0] != "api"){ 
	http_response_code(404);
	exit();
}

// Methods called depending on url request
if($request[1] == "work") {
    include('includes/work.php');    
} elseif($request[1] == "studies") {
    include('includes/studies.php');
} elseif($request[1] == "portfolio") {
    include('includes/portfolio.php');
} else {
    http_response_code(404);
	exit();
}

// Write to response in JSON to console
echo json_encode($response);