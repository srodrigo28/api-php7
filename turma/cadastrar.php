<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-control-Allow-Headers: *");

include_once '../conexao.php';
$response_json = file_get_contents("php://input");
$dados = json_decode($response_json, true);

if($dados){
    $query = " INSERT INTO tb_turma(turma) VALUES(:turma) ";
    $sql = $conn->prepare($query);
    $sql->bindParam(':turma',  $dados['turma'] ['turma'], PDO::PARAM_STR);
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