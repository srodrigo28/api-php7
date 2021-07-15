<?php

// Cabeçalhos obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

include_once '../conexao.php';

$query_produtos = " SELECT * FROM produtos ORDER BY id ASC ";
$result_produtos = $conn->prepare($query_produtos);
$result_produtos->execute();

if(($result_produtos) AND ($result_produtos->rowcount() != 0 )){
    while($row_produto = $result_produtos->fetch(PDO::FETCH_ASSOC)){
        //var_dump($row_produto);
        extract($row_produto);
        $lista_produtos["records"][$id] = [
            'id' => $id,
            'titulo' => $titulo,
            'descricao' => $descricao,
            'quantidade' => $quantidade,
            'preco' => $preco,
            'data_cad' => $data_cad
        ];
    }
    //Resposta status 200
    http_response_code(200);
    echo json_encode($lista_produtos);
}















