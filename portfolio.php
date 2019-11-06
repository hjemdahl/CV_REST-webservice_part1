<?php
// Projekt - Webbutveckling III - Moa Hjemdahl 2019

include('includes/config.php');

//Header information and allowance
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT");

// Switch for different request methods
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);
$portfolio = new Portfolio(); // New object

if($request[0] != "api"){ 
	http_response_code(404);
	exit();
}

switch ($method) {
    case "GET":
        $response = $portfolio->getPortfolio();
        if(sizeof($response)>0) { // If response is bigger than 0 = OK
            http_response_code(200);
        } else { // Else error message
            http_response_code(404);
            $response = array("message" => "Ingen portfolio hittad.");
        }
        break;
    case "POST":
        if($portfolio->addPortfolio($input['title'], $input['url'], $input['img'], $input['info'])) {
            http_response_code(201); // If response is bigger than 0 = OK
            $response = array("message" => "Tillagd.");
        } else { // Else error message
            http_response_code(503);
            $response = array("message" => "Kunde inte lägga till.");
        }
        break;
    case "DELETE":
        if($portfolio->deletePortfolio($request[1])) { // If response is bigger than 0 = OK
            http_response_code(200);
            $response = array("message" => "Raderad.");
        } else { // Else error message
            http_response_code(500);
            $response = array("message" => "Kunde inte radera.");
        }
        break;
    case "PUT":
        if($portfolio->updatePortfolio($request[1], $input['title'], $input['url'], $input['img'], $input['info'])) {
            http_response_code(200); // If response is bigger than 0 = OK
            $response = array("message" => "Uppdaterad.");
        } else { // Else error message
            http_response_code(503);
            $response = array("message" => "Kunde inte uppdatera.");
        }
        break;
}

// Write to response in JSON to console
echo json_encode($response);