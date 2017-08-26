<?php
namespace App;

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\Database\DefaultConnection;

class FirstDatabaseTest extends TestCase
{
    protected function setUp()
    {
        if(!extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('PDO/SQLite is required to run this test.');
        }
        $this->db = new \PDO('sqlite::memory:');
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
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
