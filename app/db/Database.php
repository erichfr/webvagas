<?php 
// Conexao com banco de dados usando query builder

namespace App\Db;

use \PDO;
use \PDOException;

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
        try{
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }
    /**
     * Metodo para executar queries do banco de dados
     * @param string $query
     * @param array $params
     * @return PDOStatement  
     */
    public function execute($query, $params = []){
        try{
          $statement = $this->connection->prepare($query);
          $statement->execute($params);
          return $statement;  
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }
    /**
     * Metodo para inserir dados no banco de dados
     * @param array $values[ field => value]
     * @return integer ID inserido  
     */
    public function insert($values){
        // Dados da query
        $fields = array_keys($values);
        $binds = array_pad([], count($fields),'?');

        $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
        
        // Executa o Insert
        $this->execute($query, array_values($values));

        // Retorna o ID inserido
        return $this->connection->lastInsertId();
        
    }
    /**
     * Metodo para executar consulta no banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement 
    */

    public function select($where = null, $order = null, $limit = null, $fields = '*'){
        // Dados da Query
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';    
        
        // Monta a query
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;  
        
        return $this->execute($query);
    
    }

}