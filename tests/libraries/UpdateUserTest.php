<?php
namespace App\Libraries;

use PHPUnit\Dbunit\TestCase;
use PHPUnit\DbUnit\DataSet\FlatXmlDataSet;
use PHPUnit\DbUnit\DataBase\DefaultConnection;

class UpdateUserTest extends TestCase
{
    protected static $connection;

    public function setUp()
    {
        if(!extension_loaded('pdo_sqlite')) {
            $this->markTestSkipped('PDO/SQLite is required to run this test.');
        }
        parent::setUp();
    }

    public function getConnection()
    {
        if(null === self::$connection)
        {
            self::$connection = new \PDO('sqlite::memory:');
            self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            self::$connection->exec(
                'CREATE TABLE IF NOT EXISTS table1 (
                    table1_id INTEGER PRIMARY KEY AUTOINCREMENT,
                    column1 VARCHAR(20),
                    column2 INT(10),
                    column3 DECIMAL(6,2),
                    column4 TEXT
                )'
            );  

            self::$connection->exec(
              'CREATE TABLE IF NOT EXISTS table2 (
                table2_id INTEGER PRIMARY KEY AUTOINCREMENT,
                column5 VARCHAR(20),
                column6 INT(10),
                column7 DECIMAL(6,2),
                column8 TEXT
              )'
            );  

            self::$connection->exec(
              'CREATE TABLE IF NOT EXISTS table3 (
                table3_id INTEGER PRIMARY KEY AUTOINCREMENT,
                column9 VARCHAR(20),
                column10 INT(10),
                column11 DECIMAL(6,2),
                column12 TEXT
              )'
            );
            
        }

        return new DefaultConnection(self::$connection, 'sqlite');
    }

    public function getDataSet()
    {
        return new FlatXmlDataSet(dirname(__FILE__).'/_fixtures/Initial.xml');
    }

    /**
     * @test
     */
    public function update()
    {

        $updateUser = new UpdateUser($this->getConnection()->getConnection());

        $updateUser->update();

        $this->assertDataSetsEqual(new FlatXmlDataSet(dirname(__FILE__).'/_fixtures/UpdateResult.xml'), $this->getConnection()->createDataSet());
    }
}
