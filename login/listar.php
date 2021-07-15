<?php
// Cabeçalhos obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

include_once '../conexao.php';
$query = " SELECT * FROM login ";
$rs = $conn->prepare($query);
$rs->execute();

if(($rs) AND ($rs-> rowcount() != 0 )){
    while($row = $rs->fetch(PDO::FETCH_ASSOC)){
        //var_dump($row);
        extract($row);
        $lista["records"][$id] = [
            'id' => $id,
            'login' => $login,
            'senha' => $senha,
            'data_cadastro' => $data_cadastro
        ];
    }
    //Resposta status 200
    http_response_code(200);
    echo json_encode($lista);
}















