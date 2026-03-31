<?php
require_once 'Config/Database.php';
require_once 'Repositories/RankingRepository.php';

$databaseFunc = new Database();
$db = $databaseFunc->getConnection();

// 3. Você cria o REPOSITÓRIO e "ENTREGA" a chave para ele
// O Repository não sabe criar a chave, ele só sabe USAR a chave que você deu.
$repo = new RankingRepository($db); 

// 4. Agora o $repo está pronto para trabalhar
$dados = $repo->buscarRanking(1);