<?php

namespace Scrapbook\Core\Drivers;

use Scrapbook\Core\Database;

class Mysqli implements Database{
    private $connection;

    public function connect(array $params){
        try
        {
            @$this->connection = new \mysqli($params["server"], $params["login"], $params["password"], $params["database"]);
        }
        catch(\Exception $e)
        {
            return null;
        }
    }

    public function query(string $sql): array{
        $items = [];

        try
        {
            $result = $this->connection->query($sql);
            $items = $result->fetch_all(MYSQLI_ASSOC);
        }
        catch(\Throwable $e){}
        finally
        {
            return $items;
        }
    }

    public function prepared(string $sql, array $values): array
    {
        $items = [];

        try
        {
            $stmt = $this->connection->prepare($sql);

            $types = '';

            foreach($values as $value)
            {
                $types .= str_split(gettype($value))[0];
            }

            $stmt->bind_param($types, ...$values);

            $stmt->execute();
            $result = $stmt->get_result();
            
            $items = $result->fetch_all(MYSQLI_ASSOC);
        }
        catch(\Throwable $e){}
        finally
        {
            return $items;
        }
    }

    public function getLastInsertId(){
        return $this->connection->insert_id;
    }
}