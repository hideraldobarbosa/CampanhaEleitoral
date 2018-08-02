<?php

require_once '/controllers/CtrlEstado.php';
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
	* Classe que Controla a manutenção cadastro de Cidades
*/
class CtrlCidades {

	public $obj;
	public $view;
	

    function __construct() {
		$this->view = new View;
	}

    public function Index() {
        $this->view->load("cidades");
    }


    public function Cadastro($data) {
        
    
      
        
        $this->view->load("cidades");
    }

    public function Buscadados() {
        $this->obj = Doctrine_Core::getTable('cidades');
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
        $this->view->load("/Grid/ListaCidades"); 	
    }


    public function Delete($data) {
  
        if ($data['acao'] === 'Ativa'){
           $ativo = 'SIM';
        }else{
           $ativo = 'NÃO';    
        }
     
        $this->obj = Doctrine_Core::getTable('cidades')->find($data['cid_id']);     
     	$statement = Doctrine_Manager::getInstance()->connection();
	$statement->beginTransaction();
        
        $this->obj->cid_ativo = $ativo;
        $this->obj->cid_id = $data['cid_id'];
        
        try {
                
              $this->obj->save();
	      $statement->commit();
              
             // echo("<script type='text/javascript'>alert('Salvo com sucesso.');</script>");
              
              header('location:?controller=CtrlCidades&action=GeraLista&msg=sucesso');
              
             // exit('Salvo com sucesso');
              
             
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        exit;
    }

    public function Save($data){
 
        $statement = Doctrine_Manager::getInstance()->connection();
	$statement->beginTransaction();
        
        if(!empty($data['estado'])){
          $idEstado = GetEstadoId($data['estado']) ; 
        }
                
        if(!empty($data['pais'])){
          $idPais = GetEstadoId($data['pais']) ; 
        }
        if (empty($data['codigo'])) {
 
            $this->obj = new cidades;
            $results = $statement->execute("SELECT nextval('seq_cidade_id') AS seq");
            $oSeq = $results->fetchObject();
            $this->obj->cid_id = $oSeq->seq;
            $id = $this->obj->cid_id;
            
        }  else {
           $this->obj = Doctrine_Core::getTable('cidades')->find($data['codigo']);     
           $id = $data['codigo'];    
           $this->obj->cid_id = $id;
        } 
                
	$this->obj->cid_nome       = $data['descricao'];
	$this->obj->cid_ativo     = $data['ativo'];
        $this->obj->est_id        = $idEstado;
        $this->obj->cid_ddd       = $data['ddd'];
        $this->obj->pais_id       = $idPais;
        
	try {
	      $this->obj->save();
	      $statement->commit();
              header('location:?controller=CtrlCidades&action=GeraLista');
              
              exit('Salvo com sucesso');
            
            } catch (Exception $ex) {

		$statement->rollback();
	     	exit('Dados Inconsistentes: não salvou cidade Desejads. Tente novamente.');
    	}
    }


    public function GetCidadeNome($descricao = NULL) {
        $this->obj = Doctrine_Core::getTable('cidades');
       
        $acidades = Doctrine_Query::create()
                                 ->from("cidades cid")
                                 ->where("cid.cid_nome = ?", $descricao)
                                 ->execute()->toArray();
        return($acidades);
    }


    public function GetCidadeId($id = NULL) {
        $this->obj = Doctrine_Core::getTable('cidades');
       
        $acidades = Doctrine_Query::create()
                                 ->from("cidades cid")
                                 ->where("cid.cid_id = ?", $id)
                                 ->execute()->toArray();
        return($acidades);
    }

    public function GetCidades() {
     
      $sSql = '  select  cid.cid_id, cid.cid_nome, cid.cid_ddd, cid.cid_ativo, pais.pais_nome, est.est_nome '.
              '   from cidades as cid '. 
              ' inner join Paises as pais ON pais.pais_id = cid.pais_id '.
              ' inner join Estado as est  ON est.est_id = cid.est_id '.
              ' order By cid.cid_nome ASC';
    

        
      $squery3= Doctrine_Manager::getInstance()->connection();
      $rsresultados3 = $squery3->execute($sSql);

      $acidades = $rsresultados3->fetchAll();        
  
      return($acidades);
    }
    
    public function GetEstados() {
   
       $sSql = 'select u.est_sigla, u.est_id, u.est_nome from estado u';
        
      $squery3= Doctrine_Manager::getInstance()->connection();
      $rsresultados3 = $squery3->execute($sSql);
        
      $aestcid = $rsresultados3->fetchAll();        
        
      foreach ($aestcid as $est) {
	  $aestados[] = $est['est_nome'];
      }
      

      return($aestados);
      
    }
        
    public function GetPaises() {
   
       $sSql = 'select u.pais_nome from paises u';
        
      $squery3= Doctrine_Manager::getInstance()->connection();
      $rsresultados3 = $squery3->execute($sSql);
        
      $paisCid = $rsresultados3->fetchAll();        
        
      foreach ($paisCid as $est) {
	  $apaises[] = $est['pais_nome'];
      }
      return($apaises);
    }
    
    public function GetEstadoId($descricao = NULL) {
        $this->obj = Doctrine_Core::getTable('estado');
       
        $idEstado = Doctrine_Query::create()
                                 ->from("estado est")
                                 ->where("est.est_nome = ?", $descricao)
                                 ->execute()->toArray();
        return($idEstado);
    }
    
    
    public function GetPaisId($descricao = NULL) {
       $this->obj = Doctrine_Core::getTable('paises');
       
        $idPais = Doctrine_Query::create()
                                 ->from("paises pais")
                                 ->where("pais.pais_nome = ?", $descricao)
                                 ->execute()->toArray();
        return($idPais);
    }


}
