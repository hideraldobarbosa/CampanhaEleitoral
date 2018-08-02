<?php
/*
*   Sistema Campanha Eleitoral 
*  Copyright (C) 2015      *
*  Este programa e software livre; voce pode redistribui-lo e/ou
*  modifica-lo sob os termos da Licenca Publica Geral GNU, conforme
*  publicada pela Free Software Foundation; tanto a versao 2 da
*  Licenca como (a seu criterio) qualquer versao mais nova.
*
*  Este programa e distribuido na expectativa de ser util, mas SEM
*  QUALQUER GARANTIA; sem mesmo a garantia implicita de
*  COMERCIALIZACAO ou de ADEQUACAO A QUALQUER PROPOSITO EM
*  PARTICULAR. Consulte a Licenca Publica Geral GNU para obter mais
*  detalhes.
*
*  Voce deve ter recebido uma copia da Licenca Publica Geral GNU
*  junto com este programa; se nao, escreva para a Free Software
*  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA
*  02111-1307, USA.
*
*  Copia da licenca no diretorio licenca/licenca_en.txt
*                                licenca/licenca_pt.txt
*/

/**
	* Description of
	* Classe que Controla a manutenção cadastro de Setor
*/
class CtrlTipoCoordenada {

	public $obj;
	public $view;
	

    function __construct() {
	$this->view = new View;
    }

    public function Index() {
        $this->view->load("tipocoordenada");
    }


	public function Cadastro() {
        $this->view->load("tipocoordenada");
    }

    public function Buscadados() {
        $this->obj = Doctrine_Core::getTable('endtipocoordenada');
        $this->obj = $this->obj->find($id);
        try {
            // Gravar ativo = 'NAO'
            //$this->obj->delete();
            echo "Registro Inativado";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        exit;
    }

    public function GeraLista(){
        $this->view->load("/Grid/ListaTipoCoordenada"); 	
    }


    public function Delete($data) {

        if ($data['acao'] === 'Ativa'){
           $ativo = 'SIM';
        }else{
           $ativo = 'NÃO';    
        }
     
        $this->obj = Doctrine_Core::getTable('Endtipocoordenada')->find($data['tpcrd_id']);     
     	$statement = Doctrine_Manager::getInstance()->connection();
	$statement->beginTransaction();
        
        $this->obj->tpcrd_ativo = $ativo;
        $this->obj->tpcrd_id = $data['tpcrd_id'];
        
        try {
                
              $this->obj->save();
	      $statement->commit();
              
              exit('Salvo com sucesso');
              
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        exit;

    }

    public function Save($data){

     	$statement = Doctrine_Manager::getInstance()->connection();
	$statement->beginTransaction();
        
        if (empty($data['codigo'])) {
            
            $this->obj = new Endtipocoordenada;
           $results = $statement->execute("SELECT nextval('seq_tpcoordenada_id') AS seq");
            $oSeq = $results->fetchObject();
            $this->obj->tpcrd_id = $oSeq->seq;
            $id = $this->obj->tpcrd_id;
            
        }  else {
           $this->obj = Doctrine_Core::getTable('Endtipocoordenada')->find($data['codigo']);     
           $id = $data['codigo'];    
           $this->obj->tpcrd_id = $id;
        } 
            
	$this->obj->tpcrd_descricao = $data['descricao'];
	$this->obj->tpcrd_ativo     = $data['ativo'];
        
	try {
	      $this->obj->save();
	      $statement->commit();
              
              exit('Salvo com sucesso');
            
            } catch (Exception $ex) {

		$statement->rollback();
	     	exit('Dados Inconsistentes: não salvou setor Desejado. Tente novamente.');
    	}
    }


    public function GetTipoCoordenadaDescricao($descricao = NULL) {
        $this->obj = Doctrine_Core::getTable('endtipocoordenada');
       
        $atipocoordenada = Doctrine_Query::create()
                                 ->from("EndTipoCoordenada tpcrd")
                                 ->where("tpcrd.tpcrd_descricao = ?", $descricao)
                                 ->execute()->toArray();
        return($atipocoordenada);
    }


    public function GetTipoCoordenadaId($id = NULL) {
         $this->obj = Doctrine_Core::getTable('Endtipocoordenada');
       
        $tipocoordenada = Doctrine_Query::create()
                                 ->from("Endtipocoordenada tpcrd")
                                 ->where("tpcrd.tpcrd_id = ?", $id)
                                 ->execute()->toArray();
        return($tipocoordenada);
    }

    public function GetTipoCoordenada() {
        $this->obj = Doctrine_Core::getTable('EndTipoCoordenada');
       
        $atipocoordenada = Doctrine_Query::create()
        				                    ->from("EndTipoCoordenada tpcrd")
        				                    ->orderBy("tpcrd.tpcrd_descricao ")
        				                    ->limit(2000)
        				                    ->execute()->toArray();
        return($atipocoordenada);
    }


}