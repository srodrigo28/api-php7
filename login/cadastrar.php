<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-control-Allow-Headers: *");

include_once '../conexao.php';

$response_json = file_get_contents("php://input");
$dados = json_decode($response_json, true);

if($dados){
    $query = " INSERT INTO login(login, senha) VALUES(:login, :senha) ";
    $login = $conn->prepare($query);
    $login->bindParam(':login', $dados['login']['login'], PDO::PARAM_STR);
    $login->bindParam(':senha', $dados['login']['senha']);
    $login->execute();

    if($login->rowCount()){
        $response = [ 
            "erro" => false,
            "messagem" => "Usuário cadastrado com Sucesso!"
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