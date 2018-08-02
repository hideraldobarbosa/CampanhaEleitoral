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
class CtrlTipoDetalheCidade {

	public $obj;
	public $view;
	

    function __construct() {
		$this->view = new View;
	}

    public function Index() {
        $this->view->load("tipodetalhecidade");
    }


    public function Cadastro() {
        $this->view->load("tipodetalhecidade");
    }

    public function Buscadados() {
        $this->obj = Doctrine_Core::getTable('enddetalhescidade');
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
        $this->view->load("/Grid/ListaTipoDetalheCidade"); 	
    }


    public function Delete($data) {
  
        if ($data['acao'] === 'Ativa'){
           $ativo = 'SIM';
        }else{
           $ativo = 'NÃO';    
        }
     
        $this->obj = Doctrine_Core::getTable('enddetalhescidade')->find($data['dtcid_id']);     
     	$statement = Doctrine_Manager::getInstance()->connection();
	$statement->beginTransaction();
        
        $this->obj->dtcid_ativo = $ativo;
        $this->obj->dtcid_id = $data['dtcid_id'];
        
        try {
                
              $this->obj->save();
	      $statement->commit();
              
             // echo("<script type='text/javascript'>alert('Salvo com sucesso.');</script>");
              
              header('location:?controller=CtrlTipoDetalheCidade&action=GeraLista&msg=sucesso');
              
             // exit('Salvo com sucesso');
              
             
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        exit;
    }

    public function Save($data){

     	$statement = Doctrine_Manager::getInstance()->connection();
	$statement->beginTransaction();
        
        if (empty($data['codigo'])) {
            
            $this->obj = new Enddetalhescidade;
            $results = $statement->execute("SELECT nextval('seq_tpdetcidade_id') AS seq");
            $oSeq = $results->fetchObject();
            $this->obj->dtcid_id = $oSeq->seq;
            $id = $this->obj->dtcid_id;
            
        }  else {
           $this->obj = Doctrine_Core::getTable('enddetalhescidade')->find($data['codigo']);     
           $id = $data['codigo'];    
           $this->obj->dtcid_id = $id;
        } 
            
	$this->obj->dtcid_descricao = $data['descricao'];
	$this->obj->dtcid_ativo     = $data['ativo'];
        
	try {
	      $this->obj->save();
	      $statement->commit();
              header('location:?controller=CtrlTipoDetalheCidade&action=GeraLista');
              
              exit('Salvo com sucesso');
            
            } catch (Exception $ex) {

		$statement->rollback();
	     	exit('Dados Inconsistentes: não salvou tipo detalhe cidade desejado. Tente novamente.');
    	}
    }


    public function GetGetTipoDetalheCidadeDescricao($descricao = NULL) {
        $this->obj = Doctrine_Core::getTable('enddetalhescidade');
       
        $aTipoDetalheCidade = Doctrine_Query::create()
                                 ->from("enddetalhescidade edc")
                                 ->where("edc.dtcid_descricao = ?", $descricao)
                                 ->execute()->toArray();
        return($aTipoDetalheCidade);
    }


    public function GetGetTipoDetalheCidadeId($id = NULL) {
         $this->obj = Doctrine_Core::getTable('enddetalhescidade');
       
        $aTipoDetalheCidade = Doctrine_Query::create()
                                 ->from("setor set")
                                 ->where("set.dtcid_id = ?", $id)
                                 ->execute()->toArray();
        return($aTipoDetalheCidade);
    }

    public function GetTipoDetalheCidade() {
        $this->obj = Doctrine_Core::getTable('enddetalhescidade');
       
        $aTipoDetalheCidade = Doctrine_Query::create()
        				                    ->from("enddetalhescidade")
        				                    ->orderBy("dtcid_descricao ")
        				                    ->limit(2000)
        				                    ->execute()->toArray();
        return($aTipoDetalheCidade);
    }


}