<?php

// Cabeçalhos obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

include_once '../conexao.php';

//$id = 32;    http://localhost/www/celke/produtos/detalhes.php?id=5
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$response = "";

$query = " SELECT * FROM produtos WHERE id=:id LIMIT 1 ";
$rs = $conn->prepare($query);
$rs->bindParam(':id', $id, PDO::PARAM_INT);
$rs->execute();

if(($rs) AND ($rs->rowcount() != 0 )){
    $row = $rs->fetch(PDO::FETCH_ASSOC);
    extract($row);
    //records
    $produto = [
        'id' => $id,
        'titulo' => $titulo,
        'descricao' => $descricao,
        'quantidade' => $quantidade,
        'preco' => $preco,
        'data_cad' => $data_cad
    ];
    $response = [
        "erro" => false,
        "produto" => $produto
    ];
}else{
    $response = [
        "erro" => true,
        "messagem" => "Registro não encontrato"
    ];
}
http_response_code(200);
echo json_encode($response);











