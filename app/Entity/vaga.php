<?php

namespace App\Entity;

use App\Db\Database;

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

}

