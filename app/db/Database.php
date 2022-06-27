<?php 
// Conexao com banco de dados usando coceito query builder

namespace App\Db;
use \PDO;


class Database{
    /**
     * Host de conexao com banco
     * @var string
     */
    const HOST = 'localhost';
    /**
     * Nome do banco
     * @var string
     */
    const NAME = 'wdev_vagas';
    /**
     * Usuario do banco
     * @var string
     */
    const USER = 'root';
    /**
     * Senha de acesso ao Banco
     * @var string
     */
    const PASS = ''; 

    /**
     * Nome da Tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instancia conexao Db
     * @var PDO
     */
    private $connection;

    /**
     * Define a tabela e instancia a conexao
     * @param string $table
     */
    public function __construct($table = null) {
        $this->table = $table;
        $this->setConnection();
    }
    /**
     * metodo responsavel para criar uma conexao com banco de dados
     * @var string
     */
    private function setConnection(){
        $this->connection;
    }
}