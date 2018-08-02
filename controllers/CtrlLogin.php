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
	* Classe que Controla o acesso dos diversos perfis de usuários
*/
class CtrlLogin {

	public $obj;
	public $view;
	public $chave = 'G2h30PSFI9WQx4nt09ocK1doDAzD7Cr0';


    function __construct() {
		$this->view = new View;
	}


	public function Index() {

		if(empty($_SESSION['usr']['id'])){
       		$this->view->load("login");
		}else{
			$this->view->Redirecionar("Home","Index");
		}
	}


	public function LoginUsuario($data) {
	

		$data['cpfCnpj']    =   preg_replace('/\D/', '', $data['cpfCnpj']);
		//$this->obj->tituloLogin = 'Prestador';

		if(empty($_SESSION['usr']['id'])){

			if(strlen($data['cpfCnpj'])< 10 || strlen($data['senha'])<1){
				$this->obj->erro  =   'Os campos CPF/CNPJ e senha são obrigatórios.';
				$this->view->load("login",$this->obj);
			}else{
				//Verificação de cpnj/cpf e senha
				//  retornar encriptografia 
				//$senha      =   self::encrypt($data['senha']);
				$senha = $data['senha'];


				$usuario  =   Doctrine_Query::create()->from("Usuario u")
								->where("u.usu_login = ?", $data['cpfCnpj'])
								->andwhere('u.usu_senha = ?',$senha)
								->execute()
								->toArray();
                                
                                //Página inicial do sistema
                                $this->view->load("home");
				if(count($usuario)>0){

				    /**
					 * Verifica e busca os modulos do usuário 
					 */
					if(count($usuario)>0){

						/*$logoprefeitura = ParametroPrefeitura::GetPrefeitura('1');
						$codmunicipio   = $logoprefeitura[0]['codmunicipio'];

						$_SESSION['nfe']['prefeitura']['codmunicipio']	=   $codmunicipio;

						$_SESSION['nfe']['id']         		=   $prestador[0]['id'];
						$_SESSION['nfe']['cpfcnpj']    		=   $prestador[0]['login'];
						$_SESSION['nfe']['im']         		=   $prestador[0]['im'];
						$_SESSION['nfe']['tipo']       		=   'Prestador';
						$_SESSION['nfe']['cgm']        		=   $prestador[0]['cgm'];
 						$_SESSION['nfe']['emissor']['id']	=   $prestador[0]['id'];
						$_SESSION['nfe']['emissor']['im']   =   $prestador[0]['im'];
						$_SESSION['nfe']['emissor']['cgm']  =   $prestador[0]['cgm'];
						$_SESSION['nfe']['nome_usuario']    =   $prestador[0]['nome'];

						//Registrar LOG de Acessos
						$log['cpfcnpj']   = $prestador[0]['login'];
						$log['idarea'] 	  = '2';
						$log['ipmaquina'] = $_SERVER["REMOTE_ADDR"];
						$log['status'] 	  = 'S';

						self::RegistrarLogAcesso($log);
*/
						//$this->view->redirecionar("Home","index");
                                                
                                                
                                                //Página inicial do sistema
						//$this->view->load("pecas/menu.tpl");
                                                //Alterado para:                                                
                                                $this->view->load("home");
					}else{
						$this->obj->erro  =   'Seu cadastro não esta ativo. Entre em contato com administrador do sistema.';
						$this->view->load("login",$this->obj);
					}
				}else{
				//	$this->obj->erro  =   'Dados inválidos.';

					//Registrar LOG de Acessos
					$log['cpfcnpj']   = $data['cpfCnpj'];
					$log['idarea'] 	  = '2';
					$log['ipmaquina'] = $_SERVER["REMOTE_ADDR"];
					$log['status'] 	  = 'F';

					//self::RegistrarLogAcesso($log);

					//$this->view->load("login",$this->obj);
				}
			}
		}else{
			$this->view->redirecionar("Home","index");
		}
	}

	public function sair(){
		session_start();
		session_destroy();
		session_unset();
		$this->obj->alerta  =   'Você acaba de sair do sistema.';
		$this->view->redirecionar('Home','Index');
	}

	public function encrypt($text){
		return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->chave, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
	}

	public function decrypt($text){
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->chave, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
	}


	public function MeuPerfil(){
		$this->view->load("meuperfil",$this->obj);
	}

	public function AlterarPerfil(){
		try {

			//Verificação de senha
			if($_POST['senha']!=$_POST['confirmsenha']){
				throw new Exception("Nova senha não corresponde com verificação.");
			}

			//Verificação senha forte
			if (!preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST['senha'])) {
				throw new Exception('Tente novamente, a senha é Fraca. Mínimo 8 caracteres, contendo letras, números, maiúsculas e minúsculas.');
			}

			//Verificação senha atual
			$this->user = Doctrine_Core::getTable('Usuario');
			$this->user = Doctrine_Query::create()
							->from('Usuario u')
							->where('u.id = ?', $_SESSION['nfe']['id'])
							->andwhere('u.senha = ?', self::encrypt($_POST['senhaAtual']))
							->fetchOne();
			if($this->user){

				$this->user->senha = self::encrypt($_POST['senha']);

			}else{
				throw new Exception('Senha atual inválida.');
			}

		} catch (Exception $e) {
			$data['msgretorno'] 	=	'<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>Atenção:</b>'.$e->getMessage().'</div>';
		}

		$this->view->load("meuperfil",$data);
	}

	public function BuscarDados($tabela, $id){

		$DadosLog = Doctrine_Core::getTable($tabela);
        $DadosLog = $DadosLog->find($id)->toArray();

		return $DadosLog;
	}

	public function GeraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){

		$lmin 		= 'abcdefghijklmnopqrstuvwxyz';
		$lmai 		= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num 		= '1234567890';
		$simb 		= '!@#$%*-';
		$retorno 	= '';
		$caracteres = '';

		$caracteres .= $lmin;
		if ($maiusculas) $caracteres .= $lmai;
		if ($numeros) $caracteres .= $num;
		if ($simbolos) $caracteres .= $simb;

		$len = strlen($caracteres);
		for ($n = 1; $n <= $tamanho; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
	}

	public function RecuperarSenha(){

			$cpfcnpj = preg_replace('/\D/', '', $_POST['doc']);
			$tipo = $_POST['tipo'];

			if(empty($cpfcnpj)){
				echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>Atenção:</b> CPF/CNPJ Inválido.</div>';
				exit;
			}else{

				//Verificar se existe este Usuario/Tipo
				$aUsuario 	  = New Usuario;
				$dadosusuario = $aUsuario->BuscarDadosUsuario($cpfcnpj, $tipo);

				if(count($dadosusuario)>0){

					$id = $dadosusuario['id'];
					$novasenha = self::GeraSenha();

					//Cadastra nova senha
					$this->user  = new Usuarios;
					$this->user = Doctrine_Query::create()
									->from('Usuario u')
									->where('u.id = ?', $id)
									->fetchOne();
					if($this->user->id > 0){

						$this->user->id    = $id;
						$this->user->senha = self::encrypt($novasenha);

						// Não Registrar LOG função publica
						$this->user->save();

						//Notificação Usuario
						$assunto 	=	"NFSE - Recuperar Acesso";
						$texto 		=	'Prezado(a),';
						$texto      .=   "<br/><br/>Segue abaixo novos dados de acesso ao NFSe.";
						$texto      .=   "<br/>Sua nova senha é ".$novasenha.".";
						$texto      .=   "<br/><br/>Após logar no sistema, para sua segurança favor alterar esta senha.";
						Helper::enviaEmail($dadosusuario['email'], $assunto, $texto);
						echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>Atenção:</b> Nova Senha foi enviada no e-mail do seu cadastro.</div>';//return true;
						exit;
					}else{
						echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>Atenção:</b> Usuário não cadastrado.</div>';//return true;
						exit;
					}

				}else{
					echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>Atenção:</b> Usuário não cadastrado.</div>';
					exit;
				}
			}

		exit;
	}


}