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
class CtrlTipoComplemento {

	public $obj;
	public $view;
	

    function __construct() {
		$this->view = new View;
	}

    public function Index() {
        $this->view->load("TipoComplemento");
    }


    public function Cadastro() {
        $this->view->load("TipoComplemento");
    }

    public function Buscadados() {
        $this->obj = Doctrine_Core::getTable('EndTipoComplemento');
        $this->obj = $this->obj->find($id);
        try {
            // Gravar ativo = 'NAO'
            //$this->obj->delete();
  
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        exit;
    }

    public function GeraLista(){
        $this->view->load("/Grid/ListaTipoComplemento"); 	
    }

    public function Delete($data) {
  
        if ($data['acao'] === 'Ativa'){
           $ativo = 'SIM';
        }else{
           $ativo = 'NÃO';    
        }
     
        $this->obj = Doctrine_Core::getTable('endtipocomplemento')->find($data['tpcpl_id']);     
     	$statement = Doctrine_Manager::getInstance()->connection();
	$statement->beginTransaction();
        
        $this->obj->tpcpl_ativo = $ativo;
        $this->obj->tpcpl_id = $data['tpcpl_id'];
        
        try {
                
              $this->obj->save();
	      $statement->commit();
              
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        exit;
    }


    public function Save($data){

       	$this->obj = new Endtipocomplemento;
     
		$statement = Doctrine_Manager::getInstance()->connection();
        				
		$statement->beginTransaction();

		$results = $statement->execute("SELECT nextval('seq_tpcomplemento_id') AS seq");
		$oSeq = $results->fetchObject();
		$this->obj->tpcpl_id = $oSeq->seq;
		$id = $this->obj->tpcpl_id;

		$this->obj->tpcpl_descricao = $data['descricao'];
		$this->obj->tpcpl_ativo     = $data['ativo'];


		try {
					
		        $this->obj->save();
			$statement->commit();



			} catch (Exception $ex) {

				$statement->rollback();
	     		}
    }


    public function GetTipoComplementoDesc($descricao = NULL) {
        $this->obj = Doctrine_Core::getTable('EndTipoComplemento');
       
        $setor = Doctrine_Query::create()
                                 ->from("EndTipoComplemento tc")
                                 ->where("tc.tpcpl_descricao = ?", $descricao)
                                 ->execute()->toArray();
        return($setor);
    }


    public function GetTipoComplementoId($id = NULL) {
         $this->obj = Doctrine_Core::getTable('EndTipoComplemento');
       
        $setor = Doctrine_Query::create()
                                 ->from("EndTipoComplemento tc")
                                 ->where("tc.tpcpl_id = ?", $id)
                                 ->execute()->toArray();
        return($setor);
    }

    public function GetTipoComplemento() {
        $this->obj = Doctrine_Core::getTable('EndTipoComplemento');
       
        $aTipoComplemento = Doctrine_Query::create()
        				                    ->from("EndTipoComplemento")
        				                    ->orderBy("tpcpl_descricao ")
        				                    ->limit(2000)
        				                    ->execute()->toArray();
        return($aTipoComplemento);
    }


}