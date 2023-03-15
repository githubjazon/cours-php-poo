<?php

namespace Models;

require_once('libraries/database.php');

abstract class Model 
{

    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = getpdo();
    }

    public function find(int $id) {
    
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        $item = $query->fetch();
        return $item;
    }

    public function delete(int $id): void {
      
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    public function findAll(?string $order = ""): array
    {
       $sql = "SELECT * FROM {$this->table}";

       if($order) {
            $sql .= " ORDER BY " . $order;
       }

       $resultats = $this->pdo->query($sql);
       $articles = $resultats->fetchAll();
   
       return $articles;
   
   }

 
}