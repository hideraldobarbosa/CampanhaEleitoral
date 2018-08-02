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
class CtrlEstado {

	public $obj;
	public $view;
	

    function __construct() {
		$this->view = new View;
	}

    public function Index() {
        $this->view->load("estado");
    }


    public function Cadastro() {
        $this->view->load("estado");
    }

    public function Buscadados() {
        $this->obj = Doctrine_Core::getTable('Estado');
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
        $this->view->load("/Grid/ListaEstado"); 	
    }


    public function Delete($data) {
  
        if ($data['acao'] === 'Ativa'){
           $ativo = 'SIM';
        }else{
           $ativo = 'NÃO';    
        }
     
        $this->obj = Doctrine_Core::getTable('estado')->find($data['est_id']);     
     	$statement = Doctrine_Manager::getInstance()->connection();
	$statement->beginTransaction();
        
        $this->obj->est_ativo = $ativo;
        $this->obj->est_id = $data['est_id'];
      
        
        try {
                
              $this->obj->save();
	      $statement->commit();
              
             // echo("<script type='text/javascript'>alert('Salvo com sucesso.');</script>");
              
              header('location:?controller=CtrlEstado&action=GeraLista&msg=sucesso');
              
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
 
            $this->obj = new Estado;
            $results = $statement->execute("SELECT nextval('seq_estado_id') AS seq");
            $oSeq = $results->fetchObject();
            $this->obj->est_id = $oSeq->seq;
            $id = $this->obj->est_id;
            
        }  else {
           $this->obj = Doctrine_Core::getTable('Estado')->find($data['codigo']);     
           $id = $data['codigo'];    
           $this->obj->est_id = $id;
        } 
            
	$this->obj->est_nome = $data['nome'];
        $this->obj->est_sigla = $data['sigla'];
	$this->obj->est_ativo     = $data['ativo'];
        $this->obj->pais_id       = $data['codigopais'];
        
	try {
	      $this->obj->save();
	      $statement->commit();
              
              header('location:?controller=CtrlEstado&action=GeraLista');
              
            } catch (Exception $ex) {

		$statement->rollback();
	     	exit('Dados Inconsistentes: não salvou setor Desejado. Tente novamente.');
    	}
    }


    public function GetEstadoNome($nome = NULL) {
        $this->obj = Doctrine_Core::getTable('estado');
       
        $aestado = Doctrine_Query::create()
                                 ->from("estado est")
                                 ->where("est.est_nome = ?", $nome)
                                 ->execute()->toArray();
        return($aestado);
    }


    public function GetEstadoId($id = NULL) {
         $this->obj = Doctrine_Core::getTable('estado');
       
        $aestado = Doctrine_Query::create()
                                 ->from("estado est")
                                 ->where("est.est_id = ?", $id)
                                 ->execute()->toArray();
        return($aestado);
    }

    public function GetEstado() {
        $this->obj = Doctrine_Core::getTable('estado');
       
        $aestado = Doctrine_Query::create()
        			->from("estado")
        			->orderBy("est_nome")
        			->limit(2000)
        			->execute()->toArray();
        return($aestado);
    }
    
    
    public function GetPaises() {
   
       $sSql = 'select u.pais_nome from paises u';
        
      $squery3= Doctrine_Manager::getInstance()->connection();
      $rsresultados3 = $squery3->execute($sSql);
        
      $paisCid = $rsresultados3->fetchAll();        
        
      foreach ($paisCid as $est) {
	  $apaises[] = $est['pais_nome'];
      }
      
      print_r($apaises);
      return($apaises);
    }


}
