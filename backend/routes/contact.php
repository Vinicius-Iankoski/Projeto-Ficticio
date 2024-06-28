<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST"); // deixa apenas o método POST
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");

include_once '../config/database.php';
include_once '../models/ContactMessage.php';

$database = new Database();
$db = $database->getConnection();

$contactMessage = new ContactMessage($db);

$data = json_decode(file_get_contents("php://input"));
/*
    php://input >> em requisiçoes POST, é utilizado para acessar os dados do
    corpo da requisição HTTP. Ele permite ler, ao usar "file_get_contents" os
    dados EXATAMENTE como foram enviados pelo cliente, sem pré-processamento do
    PHP.
    json_decode >> transforma o JSON em objeto PHP.
*/
if (
    !empty($data->name) &&
    !empty($data->email) &&
    !empty($data->message)
) {
    $contactMessage->name = $data->name;
    $contactMessage->email = $data->email;
    $contactMessage->message = $data->message;

    if ($contactMessage->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Message was sent."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to send message."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to send message. Data is incomplete."));
}
?>
