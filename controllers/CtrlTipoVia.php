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
	* Classe que Controla a manutenção cadastro de Tipos de Informações
*/
class CtrlTipoVia {

	public $obj;
	public $view;
	

    function __construct() {
		$this->view = new View;
	}

    public function Index() {
        $this->view->load("tipovia");
    }


	public function Cadastro() {
        $this->view->load("tipovia");
    }

    public function Buscadados() {
        $this->obj = Doctrine_Core::getTable('EndTipoVia');
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
        $this->view->load("/Grid/ListaTipoVia"); 	
    }


    public function Delete($data) {
        if ($data['acao'] === 'Ativa'){
           $ativo = 'SIM';
        }else{
           $ativo = 'NÃO';    
        }
     
        $this->obj = Doctrine_Core::getTable('endtipovia')->find($data['tpvia_id']);     
     	$statement = Doctrine_Manager::getInstance()->connection();
	$statement->beginTransaction();
        
        $this->obj->setor_ativo = $ativo;
        $this->obj->setor_id = $data['tpvia_id'];
        
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
            
            $this->obj = new EndTipoVia;
            $results = $statement->execute("SELECT nextval('seq_tpvia_id') AS seq");
            $oSeq = $results->fetchObject();
            $this->obj->tpvia_id = $oSeq->seq;
            $id = $this->obj->tpvia_id;
            
        }  else {
           $this->obj = Doctrine_Core::getTable('endtipovia')->find($data['codigo']);     
           $id = $data['codigo'];    
           $this->obj->tpvia_id = $id;
        } 
            
	$this->obj->tpvia_descricao = $data['descricao'];
	$this->obj->tpvia_ativo     = $data['ativo'];
        
	try {
	      $this->obj->save();
	      $statement->commit();
              
              exit('Salvo com sucesso');
            
            } catch (Exception $ex) {

		$statement->rollback();
	     	exit('Dados Inconsistentes: não salvou tipo via  Desejada. Tente novamente.');
    	} 
    }


    public function GetTipoViaDesc($id = NULL) {
        $this->obj = Doctrine_Core::getTable('EndTipoVia');
        $aTipoVia = Doctrine_Query::create()
                                 ->from("endTipoVia tv")
                                 ->where("tv.tpvia_descricao = ?", $id)
                                 ->execute()->toArray();
        return($aTipoVia);
    }


    public function GetTipoViaId($id = NULL) {
        $this->obj = Doctrine_Core::getTable('EndTipoVia');
        $aTipoVia = Doctrine_Query::create()
                                 ->from("endtipovia tv")
                                 ->where("tv.tpvia_id = ?", $id)
                                 ->execute()->toArray();
        return($aTipoVia);
    }

    public function GetTipoVia() {

        $this->obj = Doctrine_Core::getTable('endtipovia');
        $aTipoVia = Doctrine_Query::create()
        				                    ->from("endtipovia tv")
        				                    ->orderBy("tv.tpvia_descricao DESC")
        				                    ->limit(2000)
        				                    ->execute()->toArray();

        return($aTipoVia);
    }


}