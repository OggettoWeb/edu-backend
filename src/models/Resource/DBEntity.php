<?php
namespace App\Model\Resource;

class DBEntity
    implements IResourceEntity
{
    private $_connection;
    private $_table;

    public function __construct(\PDO $connection, Table\ITable $table)
    {
        $this->_connection = $connection;
        $this->_table = $table;
    }

    public function find($id)
    {
        $stmt = $this->_connection->prepare(
            "SELECT * FROM {$this->_table->getName()} WHERE {$this->_table->getPrimaryKey()} = :id"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}