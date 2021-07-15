<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-control-Allow-Headers: *");

include_once '../conexao.php';

$response_json = file_get_contents("php://input");
$dados = json_decode($response_json, true);

if($dados){
    $query = " INSERT INTO pokemon(nome, tipo, nivel) VALUES(:nome, :tipo, :nivel) ";
    $sql = $conn->prepare($query);
    $sql->bindParam(':nome',  $dados['pokemon'] ['nome'], PDO::PARAM_STR);
    $sql->bindParam(':tipo',  $dados['pokemon'] ['tipo']);
    $sql->bindParam(':nivel', $dados['pokemon'] ['nivel']);
    $sql->execute();

    if($sql->rowCount()){
        $response = [ 
            "erro" => false,
            "messagem" => "Cadastrado com Sucesso!"
        ];
    }else{
        $response = [
            "erro" => true,
            "messagem" => "Erro ao tentar cadastrar",
            "erro: " => erro
        ];
    }
}
http_response_code(200);
echo json_encode($response);
//echo json_encode($dados['titulo']);