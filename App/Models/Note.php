<?php

namespace App\Models;

use App\config\Database;
 
class Note extends Database
{
    private $table;
    private $pdo;

    public function __construct($table)
    {
        $this->pdo = $this->connect();
        $this->table = $table;
    }
    public function all()
    { 
        $data = [];
        $select = "SELECT * FROM {$this->table} ORDER BY created_at DESC";

        $stm = $this->pdo->prepare($select);
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($result as $key => $value) {
            $data[$key] = [
                'id' => $value['id'],
                'title' => $value['title'],
                'content' => $value['content'],
                'created_at' =>$value['created_at']
            ];
        }
        return $data;
    }

    public function add($title, $content, $created_at)
    {
        
        $query = "INSERT INTO $this->table (title, content, created_at) VALUES (:title, :content, :created_at)";

        try {
            $pdo = $this->pdo;
            $stm = $pdo->prepare($query);
            $stm->execute(['title' => $title, 'content' => $content, 'created_at' => $created_at]);
            return $pdo->lastInsertId();
        } catch (PDOException $e) {

            $this->jsonEncod(false, $e->getMessage());
        }
    }

    public function show($id)
    {
        $select = "SELECT * FROM $this->table WHERE id= :id";

        $stm = $this->pdo->prepare($select);
        $stm->execute(['id' => $id]);
        return $stm->fetch(\PDO::FETCH_ASSOC);
    }

    public function update($title, $content, $id)
    {
        $query = "UPDATE {$this->table} 
                SET title =:title, 
                content =:content
                WHERE id = :id";

        try {
            $stm = $this->pdo->prepare($query);
            $stm->execute(['title' => $title, 'content' => $content, 'id' => $id]);
            return true;
        } catch (PDOException $e) {

            $this->jsonEncod(false, $e->getMessage());
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id=:id";

        try {
            $stm = $this->pdo->prepare($query);
            $stm->execute(['id' => $id]);
            return true;
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }
}
