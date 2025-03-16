<?php

use Dba\Connection;

require_once 'config/Connection.php.php';

class BaseModel
{
    protected $db;
    protected $connection;

    public function __construct()
    {
        $this->db = new ConnectionDatabase();
        $this->connection = $this->db->getConnection();
    }
}
?>
