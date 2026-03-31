<?php
class RankingRepository
{

    private $db;

    public function __construct($conexao)
    {

        $this->db = $conexao;
    }

    //passar o id movimento como parametro para cumprimento de requisito da task 
    public function obterRankingPorMovimento($idMovimento) {

        $query = "SELECT *
                   FROM personal_record
                   WHERE movement_id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $idMovimento);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
