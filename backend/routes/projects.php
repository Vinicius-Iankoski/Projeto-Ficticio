<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../models/Project.php';

$database = new Database();
$db = $database->getConnection();

$project = new Project($db);

$stmt = $project->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $projects_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        // Adiciona diretamente ao array principal
        $projects_arr[] = array(
            "id" => $id,
            "title" => $title,
            "description" => html_entity_decode($description),
            "image_url" => $image_url,
            "project_url" => $project_url,
            "created_at" => $created_at
        );
    }

    http_response_code(200);
    echo json_encode($projects_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No projects found."));
}
?>