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
class CtrlSetores {

	public $obj;
	public $view;
	

    function __construct() {
		$this->view = new View;
	}

    public function Index() {
        $this->view->load("setor");
    }


    public function Cadastro() {
        $this->view->load("setor");
    }

    public function Buscadados() {
        $this->obj = Doctrine_Core::getTable('Setor');
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
        $this->view->load("/Grid/ListaSetor"); 	
    }


    public function Delete($data) {
           
       	$statement = Doctrine_Manager::getInstance()->connection();
      	$statement->beginTransaction();
        
        try {
                echo($data['setor_id']);
                $q = Doctrine_Query::create()
                ->delete('Setor set')
                ->where('set.setor_id = ?', $data['setor_id'])
                ->execute();
                            
             // echo("<script type='text/javascript'>alert('Salvo com sucesso.');</script>");
              
              header('location:?controller=CtrlSetores&action=GeraLista&msg=sucesso');
              
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
 
            $this->obj = new Setor;
            $results = $statement->execute("SELECT nextval('seq_setor_id') AS seq");
            $oSeq = $results->fetchObject();
            $this->obj->setor_id = $oSeq->seq;
            $id = $this->obj->setor_id;
            
        }  else {
           $this->obj = Doctrine_Core::getTable('setor')->find($data['codigo']);     
           $id = $data['codigo'];    
           $this->obj->setor_id = $id;
        } 
            
	$this->obj->setor_descricao = $data['descricao'];
	$this->obj->setor_ativo     = $data['ativo'];
        
        echo($id);
        print_r($data);
	try {
	      $this->obj->save();
	      $statement->commit();
              header('location:?controller=CtrlSetores&action=GeraLista');
              
            
            } catch (Exception $ex) {

		$statement->rollback();
	     	exit('Dados Inconsistentes: não salvou setor Desejado. Tente novamente.');
    	}
    }


    public function GetSetorDescricao($descricao = NULL) {
        $this->obj = Doctrine_Core::getTable('Setor');
       
        $setor = Doctrine_Query::create()
                                 ->from("Setor set")
                                 ->where("set.setor_descricao = ?", $descricao)
                                 ->where("setor_ativo <> ?",'ERA')
                                 ->execute()->toArray();
        return($setor);
    }


    public function GetSetorId($id = NULL) {
         $this->obj = Doctrine_Core::getTable('setor');
       
        $setor = Doctrine_Query::create()
                                 ->from("setor set")
                                 ->where("set.setor_id = ?", $id)
                                ->whereand("setor_ativo <> ?",'ERA')
                                 ->execute()->toArray();
        return($setor);
    }    
    
    /***
     * Função que realiza o count na tabela de setores
     * Retorna int com a quantidade de registros encontrados
     */
    public function GetSetorCount(){
        $this->obj = Doctrine_Core::getTable('setor');
        
        $setorCount = Doctrine_Query::create()
                ->select("count(*) as total")
                ->from("Setor")
                ->where("setor_ativo <> ?",'ERA')
                ->execute()->toArray();

        return $setorCount[0]["total"];
    }

    public function GetSetor($pagina = null, $qtdeRegistros = null) {
        $this->obj = Doctrine_Core::getTable('setor');
        
        if($pagina == null){
             $aSetores = Doctrine_Query::create()->from("Setor")
                                                 ->where("setor_ativo <> ?",'ERA')
        				         ->orderBy("setor_descricao ")                                                            
        				         ->limit(2000)
        				         ->execute()->toArray();
        }else{
            
            $offset = $pagina * $qtdeRegistros - $qtdeRegistros;
            $aSetores = Doctrine_Query::create()->from("Setor")
                                                ->where("setor_ativo <> ?",'ERA')
        				        ->orderBy("setor_descricao ")
                                                ->offset($offset)
        				        ->limit($qtdeRegistros)
        				        ->execute()->toArray();
        }
       
        return($aSetores);
    }


}