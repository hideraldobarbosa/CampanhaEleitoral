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
class CtrlMenubd {

	public $obj;
	public $view;
	

    function __construct() {
		$this->view = new View;
	}

    public function Index() {
        $this->view->load("menubd");
    }

    public function Cadastro() {
        $this->view->load("menubd");
    }

    public function Buscadados() {
        $this->obj = Doctrine_Core::getTable('Modulos');
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
        $this->view->load("/Grid/ListaModulos"); 	
    }


    public function Delete($id) {
        $this->obj = Doctrine_Core::getTable('Modulos');
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


    public function Save($data){

       	$this->obj = new Setor;
     
	$statement = Doctrine_Manager::getInstance()->connection();
        				
	$statement->beginTransaction();

	$results = $statement->execute("SELECT nextval('seq_modulo_id') AS seq");
	$oSeq = $results->fetchObject();
	$this->obj->mod_id = $oSeq->seq;
	$id = $this->obj->mod_id;

	$this->obj->mod_descricao    = $data['descricao'];
	$this->obj->mod_ativo        = $data['ativo'];
        $this->obj->mod_menusuperior = $data['idMenuSuperior'];
        $this->obj->mod_topo         = $data['itemtopo'];
        


	try {
					
		$this->obj->save();
		$statement->commit();

		exit( 'Registro salvo com sucesso!!!');

            } catch (Exception $ex) {

		$statement->rollback();
	     	exit('Dados Inconsistentes: não salvou modulo Desejado. Tente novamente.');
	    }
    }


    public function GetModuloDescricao($descricao = NULL) {
        $this->obj = Doctrine_Core::getTable('Modulos');
       
        $modulo = Doctrine_Query::create()
                                 ->from("Modulos mod")
                                 ->where("mod.mod_descricao = ?", $descricao)
                                 ->execute()->toArray();
        return($modulo);
    }


    public function GetModuloId($id = NULL) {
         $this->obj = Doctrine_Core::getTable('modulos');
       
        $modulo = Doctrine_Query::create()
                                 ->from("modulos mod")
                                 ->where("mod.mod_id = ?", $id)
                                 ->execute()->toArray();
        return($modulo);
    }

    public function GetModulo() {
        $this->obj = Doctrine_Core::getTable('modulos');
       
        $aModulos = Doctrine_Query::create()
        			 ->from("Modulos")
        			 ->orderBy("Mod_descricao ")
        			 ->limit(2000)
        		         ->execute()->toArray();
        return($aModulos);
    }


}