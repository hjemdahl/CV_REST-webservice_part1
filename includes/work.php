<?php
// Projekt - Webbutveckling III - Moa Hjemdahl 2019

// New object
$work = new Work(); 

// Switch for different methods
switch ($method) {
    case "GET":
        $response = $work->getWork();
        if(sizeof($response)>0) { // If response is bigger than 0 = OK
            http_response_code(200);
        } else { // Else error message
            http_response_code(404);
            $response = array("message" => "Inga jobb hittade.");
        }
        break;
    case "POST":
        if($work->addWork($input['role'], $input['employee'], $input['startDate'], $input['endDate'])) {
            http_response_code(201); // If response is bigger than 0 = OK
            $response = array("message" => "Tillagd.");
        } else { // Else error message
            http_response_code(503);
            $response = array("message" => "Kunde inte lägga till.");
        }
        break;
    case "DELETE":
        if($work->deleteWork($request[2])) { // If response is bigger than 0 = OK
            http_response_code(200);
            $response = array("message" => "Raderad.");
        } else { // Else error message
            http_response_code(500);
            $response = array("message" => "Kunde inte radera.");
        }
        break;
    case "PUT":
        if($work->updateWork($request[2], $input['role'], $input['employee'], $input['startDate'], $input['endDate'])) {
            http_response_code(200); // If response is bigger than 0 = OK
            $response = array("message" => "Uppdaterad.");
        } else { // Else error message
            http_response_code(503);
            $response = array("message" => "Kunde inte uppdatera.");
        }
        break;
}