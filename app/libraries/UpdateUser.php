<?php
namespace App\Libraries;

Class UpdateUser
{
    private $db;
    function __construct($db)
    {
        $this->db = $db;
    }

    function update()
    {
        $sql =  "UPDATE table1"
                . " SET column1='bar' "
                . " WHERE table1_id=1 ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute();
    }
}
