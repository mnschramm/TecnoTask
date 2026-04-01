<?php
class RankingRepository
{

  private $db;

  public function __construct($conexao)
  {

    $this->db = $conexao;
  }

  //passar o id movimento como parametro para cumprimento de requisito da task 
  public function obterRankingPorMovimento($idMovimento)
  {

    $query = "WITH RecordesNumerados AS (
            SELECT 
                user_id, movement_id, value, date,
                ROW_NUMBER() OVER(PARTITION BY user_id ORDER BY value DESC, date DESC) AS numero_linha
            FROM personal_record
            WHERE movement_id = :idMovimento
        )
        SELECT 
            mov.name AS movimento,
            us.name AS nome_usuario,
            rn.value AS peso,
            rn.date AS data_pr
        FROM RecordesNumerados rn
        INNER JOIN user us ON rn.user_id = us.id
        INNER JOIN movement mov ON rn.movement_id = mov.id
        WHERE rn.numero_linha = 1
        ORDER BY peso DESC";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':idMovimento', $idMovimento);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
