<?php
require_once 'Config/Database.php';
require_once 'Repositories/RankingRepository.php';
require_once 'Service/RankingService.php';

header('Content-Type: application/json');

$idMovimento = $_GET['movimento'];

if (!isset($idMovimento)) {

    http_response_code(400);
    echo json_encode(array("erro" => "O parâmetro movimento deve ser informado na URL"));
    exit;
}

if (!is_numeric($idMovimento)) {

    http_response_code(400);
    echo json_encode(array("erro" => "O parâmetro movimento deve ser um número inteiro válido"));
    exit;
}

try { 

$bancoDeDados = new Database();
$getConexao = $bancoDeDados->getConnection();

if($getConexao === null) {

    throw new Exception("A conexão com o banco de dados falhou");

}


$repositorio = new RankingRepository($getConexao);
$dados = new RankingService($repositorio);

$rankingDoMovimento = $dados->ordenarRankingPorMovimento($idMovimento);

    echo json_encode($rankingDoMovimento);

    } catch (Exception $excecao) {

    error_log("Erro na API: " . $excecao->getMessage());

    http_response_code(500);
    echo json_encode(array("erro" => "Ocorreu um erro no servidor"));

    }