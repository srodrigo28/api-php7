<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-control-Allow-Headers: *");

include_once '../conexao.php';

$response_json = file_get_contents("php://input");
$dados = json_decode($response_json, true);

if($dados){
    $query_produto = " INSERT INTO produtos(titulo, descricao, quantidade, preco) VALUES(:titulo, :descricao, :quantidade, :preco) ";
    $cad_produto = $conn->prepare($query_produto);
    $cad_produto->bindParam(':titulo',      $dados['produto']['titulo'], PDO::PARAM_STR);
    $cad_produto->bindParam(':descricao',   $dados['produto']['descricao']);
    $cad_produto->bindParam(':quantidade',  $dados['produto']['quantidade']);
    $cad_produto->bindParam(':preco',       $dados['produto']['preco']);
    $cad_produto->execute();

    if($cad_produto->rowCount()){
        $response = [ 
            "erro" => false,
            "messagem" => "Produto cadastrado com Sucesso!",
            "erro" => erro
        ];
    }else{
        $response = [
            "erro" => true,
            "messagem" => "Erro ao tentar cadastrar o Produto",
            "erro: " => erro
        ];
    }
}
http_response_code(200);
echo json_encode($response);
//echo json_encode($dados['titulo']);