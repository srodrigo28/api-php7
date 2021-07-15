<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-control-Allow-Headers: *");

include_once '../conexao.php';
$response_json = file_get_contents("php://input");
$dados = json_decode($response_json, true);
if($dados){
    $query = " INSERT INTO aluno(nome, sexo, serie, idade) VALUES(:nome, :sexo, :serie, :idade) ";
    $sql = $conn->prepare($query);
    $sql->bindParam(':nome',  $dados['aluno'] ['nome'], PDO::PARAM_STR);
    $sql->bindParam(':sexo',  $dados['aluno'] ['sexo']);
    $sql->bindParam(':serie', $dados['aluno'] ['serie']);
    $sql->bindParam(':idade', $dados['aluno'] ['idade']);
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