<?php

namespace App;

use App\Config\Database;

abstract  class Model
{
    public $id;

    public static function all()
    {
        $db = new Database();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' ORDER BY created_at DESC',
            [],
            static::class
        );
        return $data;
    }

    public static function getLimitedNotes($leftLimit, $rightLimit)
    {
        $db = new Database();
        $data = $db->query(
            "SELECT * FROM " . static::$table . " ORDER BY created_at DESC LIMIT $leftLimit, $rightLimit",
            [],
            static::class
        );
        return $data;
    }

    public function isNew()
    {
        return empty($this->id);
    }

    public static function findById($id)
    {
        $db = new Database();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' WHERE id=:id',
            [':id' => $id],
            static::class
        );
        return $data[0] ?? false;
    }


    protected function insert()
    {
        $columns = [];
        $binds = [];
        $data = [];
        foreach ($this as $column => $value) {
            if ('id' == $column) {
                continue;
            }
            $columns[] = $column;
            $binds[] = ':' . $column;
            $data[':' . $column] = $value;
        }

        $sql = '
            INSERT INTO ' . static::$table . '
            (' . implode(', ', $columns) . ')
            VALUES
            (' . implode(', ', $binds) . ')
        ';
        $db = new Database();
        $db->execute($sql, $data);

        $this->id = $db->lastInsertId();
    }

    protected function update()
    {
        $columns = [];
        $data = [];
        $data[':id'] = $this->id;
        foreach ($this as $column => $value) {
            if ('id' == $column) {
                continue;
            }
            $columns[] = $column . '=:' . $column;
            $data[':' . $column] = $value;
        }

        $sql = '
            UPDATE ' . static::$table . '
            SET ' . implode(', ', $columns) . '
            WHERE id=:id
        ';

        $db = new Database();
        $db->execute($sql, $data);
    }

    public function save()
    {
        if (false === $this->isNew()) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    public function delete($id)
    {
        $data = [':id' => $id];
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';
        $db = new Database();
        $db->execute($sql, $data);
    }
}
