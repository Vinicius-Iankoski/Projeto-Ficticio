<?php
$request = $_SERVER['REQUEST_URI'];
// Estamos colocando em $request a parte da URL que vem depois do dominio

switch ($request) {
    case '/' :
    case '' :
        require __DIR__ . '/public/index.html';
        break;
// Se vier vazio, retornamos ao html padrão da página

    case '/projects' :
        require __DIR__ . '/routes/projects.php';
        break;
    case '/contact' :
        require __DIR__ . '/routes/contact.php';
        break;
    default:
        http_response_code(404);
        echo json_encode(array("message" => "Page not found."));
        break;
// Default é utilizado como se fosse um else. Literalmente quando nenhum 
// case deu certo, nós utilizamos ele.
}

/*

    Esse é um código de roteamento simples, pois nosso projeto é bem básico
    e não precisa de um sistema de roteamento mais completo, ou de um framework
    completo.

*/
?>


