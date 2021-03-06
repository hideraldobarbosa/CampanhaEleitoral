<?php
	/*
		*     NFSE Software Publico para Gestao Municipal
		*  Copyright (C) 2015        MI6 Tecnologia LTDA
		*                          www.mi6tecnologia.com.br
		*                         contato@mi6tecnologia.com.br
		*
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
		* Classe que
	*/
class Home {

    public $obj;
    public $view;

    function __construct() {
        $this->view = new View;
    }

    public function Index() {


     	$this->view->load("home");

    }

	public function ContatoManutencao($data){
		$oHelper = new Helper;
		//$destinatario = "desenvolvimento.ti@setelagoas.mg.gov.br";
		$destinatario = "contato@innovative.com.br";
		$assunto = "Contato Manutenção";
		$msg = "Contato realizado durante o período de manutenção. <br>";
		$msg .= "Remetente: ".$data['email'];
		$msg .= "<br>".$data['mensagem'];
		$res = $oHelper->enviaEmail($destinatario,$assunto,$msg);
		//echo $res;
		exit;
	}

}

?>