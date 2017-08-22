<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\Database\DefaultConnection;

class DatabaseTest extends TestCase
{
    protected function setUp()
    {
        $this->db = new PDO('sqlite::memory:');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->exec('CREATE TABLE test (field1 VARCHAR(100))');
    }

    /**
     * @test
     */
    public function empty_table_has_zero_row()
    {
        $conn = new DefaultConnection($this->db);
        $this->assertEquals(0, $conn->getRowCount('test'));
    }
}
