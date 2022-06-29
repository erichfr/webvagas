<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga{
    /**
     * Identificador único da vaga
     * @var integer
     */
    public $id;

    /**
     * Título da vaga
     * @var string
     */
    public $titulo;

    /**
     * Descrição Vaga(pode conter html)
     * @var string;
     */
    public $descricao;

    /**
     * Define se a vaga está ativa
     * @var string(s/n)
     */
    public $ativo;

    /**
     * Data da publicaçao da Vaga
     * @var string
     */
    public $data;

    /**
     * Metodo para cadastrar nova vaga no banco
     * @return boolean
     */

    public function cadastrar(){
        //Definir a data
        $this->data = date('Y-m-d H:i:s');

        //Inserir a vaga no banco
        $objDatabase = new Database('vagas');
        $this->id = $objDatabase->insert([
                                        'titulo' => $this->titulo,
                                        'descricao' => $this->descricao,
                                        'ativo' => $this->ativo,
                                        'data' => $this->data
        ]);
   
        // Retornar sucesso
        return true;
    }

    /**
     * Metodo para obter as vagas no banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array 
    */
    public static function getVagas($where = null, $order = null, $limit = null) {
        return (new Database('vagas'))->select($where,$order,$limit)
                                      ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

   /**
     * Metodo para receber Id
     * @param integer $id
     * @return Vaga
     */

    public static function getVaga($id){
        return (new Database('vagas'))->select('id='.$id)
                                      ->fetchObject(self::class);
    }

}

