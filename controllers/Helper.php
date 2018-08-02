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
		* Classe genérica para helpers
	*/
	class Helper {


		function __construct() {

		}

		public static function enviaEmail ($destinatario,$assunto,$mensagem){
			global $config;


			$mail = new PHPMailer;

			$mail->isSMTP();
			$mail->CharSet 		= 'utf-8';
			$mail->Host 		= $config['Mail_Host'];
			$mail->SMTPAuth 	= true;
			$mail->Username 	= $config['Mail_User'];
			$mail->Password 	= $config['Mail_Password'];
			$mail->SMTPSecure 	= 'tls';
			$mail->Port 		= $config['Mail_Port'];

			$mail->From 		= $config['Mail_User'];
			$mail->FromName 	= $config['Mail_Name'];
			$mail->addAddress($destinatario);
			$mail->isHTML(true);
			$mail->Subject 		= $assunto;

			$assinaturaemail = '<br><br>PREFEITURA MUNICIPAL DE SETE LAGOAS
								<br>CECON - Central do Contribuinte
								<br>Av. Coronel Altino França, 312 - Centro
								<br>(31) 8979-4748';
			$mail->Body    		= $mensagem.$assinaturaemail;

			if(!$mail->send()) {
				//echo 'Erro ao enviar email:';
				//echo $mail->ErrorInfo;
				return false;
				} else {
				return true;
			}

		}

		public static function validarCpf($cpf){
			if(empty($cpf)) {
				return false;
			}

			$cpf = preg_replace('/[^0-9]/', '', $cpf);
			$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

			if (strlen($cpf) != 11) {
				return false;
			}elseif($cpf == '00000000000' ||
			$cpf == '01234567890' ||
			$cpf == '11111111111' ||
			$cpf == '22222222222' ||
			$cpf == '33333333333' ||
			$cpf == '44444444444' ||
			$cpf == '55555555555' ||
			$cpf == '66666666666' ||
			$cpf == '77777777777' ||
			$cpf == '88888888888' ||
			$cpf == '99999999999') {
                return false;
				} else {

				for ($t = 9; $t < 11; $t++) {

					for ($d = 0, $c = 0; $c < $t; $c++) {
						$d += $cpf{$c} * (($t + 1) - $c);
					}
					$d = ((10 * $d) % 11) % 10;
					if ($cpf{$c} != $d) {
						return false;
					}
				}

				return true;
			}
		}

		public static function validarCnpj($cnpj){
			$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
			if (strlen($cnpj) != 14)
			return false;

			for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++){
				$soma += $cnpj{$i} * $j;
				$j = ($j == 2) ? 9 : $j - 1;
			}
			$resto = $soma % 11;
			if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
			return false;

			for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++){
				$soma += $cnpj{$i} * $j;
				$j = ($j == 2) ? 9 : $j - 1;
			}
			$resto = $soma % 11;
			return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
		}

		public function exportCSV($header, $dados) {
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=relatorio.csv');

			// create a file pointer connected to the output stream
			$output = fopen('php://output', 'w');
			fputcsv($output, $header,';',' ');

			foreach ($dados as $fields) {
				fputcsv($output, $fields);
			}

		}

		public function uploadImagen($post, $nomeCampo, $renomeia = false) {

			// Pasta onde o arquivo vai ser salvo
			$_UP['pasta'] = 'imagens_upload/';

			// Tamanho maximo do arquivo (em Bytes)
			$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
			// Array com as extensoes permitidas
			$_UP['extensoes'] = array('jpeg', 'jpg', 'png', 'gif');

			// Renomeia o arquivo? (Se true, o arquivo sera salvo como .jpg e um nome �nico)
			if($renomeia == true){
				$_UP['renomeia'] = true;
			}else{
				$_UP['renomeia'] = false;
			}

			// Array com os tipos de erros de upload do PHP
			$_UP['erros'][0] = 'N�o houve erro';
			$_UP['erros'][1] = 'O arquivo no upload � maior do que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'N�o foi feito o upload do arquivo';

			// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
			if ($_FILES["$nomeCampo"]['error'] != 0) {
				die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES["$nomeCampo"]['error']]);
				exit; // Para a execucao do script
			}

			// Caso script chegue a esse ponto, nao houve erro com o upload e o PHP pode continuar
			// Faz a verificacao da extensao do arquivo
			$value = explode('.', $_FILES["$nomeCampo"]['name']);
			$extensao = strtolower(end($value));
			if (array_search($extensao, $_UP['extensoes']) === false) {
				die("Por favor, envie arquivos com as seguintes extens�es: jpg, png ou gif");
				exit;
			}

			// Faz a verificacao do tamanho do arquivo
			else if ($_UP['tamanho'] < $_FILES["$nomeCampo"]['size']) {
				die("O arquivo enviado é muito grande, envie arquivos de até 2Mb.");
				exit;
			}

			// O arquivo passou em todas as verificacoes, hora de tentar move-lo para a pasta
			else {
				// Primeiro verifica se deve trocar o nome do arquivo
				if ($_UP['renomeia'] == true) {
					// Cria um nome baseado no UNIX TIMESTAMP atual e com extens�o .jpg
					$nome_final = $_SESSION['nfe']['emissor']['im'] . '.jpg';
					} else {
					// Mantem o nome original do arquivo
					$nome_final = $_FILES["$nomeCampo"]['name'];
					$nome_final = str_replace(" ", "_", $nome_final); //substituir o espa�o por underline
					$nome_final = str_replace("á", "a", $nome_final);
					$nome_final = str_replace("à", "a", $nome_final);
					$nome_final = str_replace("ã", "a", $nome_final);
					$nome_final = str_replace("â", "a", $nome_final);
					$nome_final = str_replace("é", "e", $nome_final);
					$nome_final = str_replace("è", "e", $nome_final);
					$nome_final = str_replace("ê", "e", $nome_final);
					$nome_final = str_replace("í", "i", $nome_final);
					$nome_final = str_replace("ì", "i", $nome_final);
					$nome_final = str_replace("ó", "o", $nome_final);
					$nome_final = str_replace("ò", "o", $nome_final);
					$nome_final = str_replace("õ", "o", $nome_final);
					$nome_final = str_replace("ô", "o", $nome_final);
					$nome_final = str_replace("ç", "c", $nome_final);

					if (file_exists("{$_UP['pasta']}$nome_final")) {
						$a = 1;
						while (file_exists("{$_UP['pasta']}[$a]$nome_final")) {
							$a++;
						}

						$nome_final = "[" . $a . "]" . $nome_final;
					}

					$nome_final = strtolower($nome_final);
				}

				// Depois verifica se é possível mover o arquivo para a pasta escolhida
				if (move_uploaded_file($_FILES["$nomeCampo"]['tmp_name'], $_UP['pasta'] . $nome_final)) {
					// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
					return ("$nome_final");
					} else {
					// Não foi possível fazer o upload, provavelmente a pasta est� incorreta
					echo "Não foi possível enviar o arquivo, tente novamente";
				}
			}
		}

		public function uploadArquivo($post, $nomeCampo) {

			// Pasta onde o arquivo vai ser salvo
			$_UP['pasta'] = 'arquivos_upload/';

			// Tamanho maximo do arquivo (em Bytes)
			$_UP['tamanho'] = 1024 * 1024 * 8; // 8Mb
			// Array com as extensoes permitidas
			$_UP['extensoes'] = array('mp3', 'wma');

			// Renomeia o arquivo? (Se true, o arquivo sera salvo como .jpg e um nome unico)
			$_UP['renomeia'] = false;

			// Array com os tipos de erros de upload do PHP
			$_UP['erros'][0] = 'Nao houve erro';
			$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'Nao foi feito o upload do arquivo';

			// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
			if ($_FILES["$nomeCampo"]['error'] != 0) {
				die("Nao foi possivel fazer o upload, erro:<br />" . $_UP['erros'][$_FILES["$nomeCampo"]['error']]);
				exit; // Para a execucao do script
			}

			// Caso script chegue a esse ponto, nao houve erro com o upload e o PHP pode continuar
			// Faz a verificacao da extensao do arquivo
			$value = explode('.', $_FILES["$nomeCampo"]['name']);
			$extensao = strtolower(end($value));

			if (array_search($extensao, $_UP['extensoes']) === false) {
				die("Por favor, envie arquivos com as seguintes extensoes: mp3");
				exit;
			}

			// Faz a verificacao do tamanho do arquivo
			else if ($_UP['tamanho'] < $_FILES["$nomeCampo"]['size']) {
				die("O arquivo enviado é muito grande, envie arquivos de ate 8Mb.");
				exit;
			}

			// O arquivo passou em todas as verificacoes, hora de tentar move-lo para a pasta
			else {
				// Primeiro verifica se deve trocar o nome do arquivo
				if ($_UP['renomeia'] == true) {
					// Cria um nome baseado no UNIX TIMESTAMP atual e com extensao .jpg
					$nome_final = time() . '.mp3';
					} else {
					// Mantem o nome original do arquivo
					$nome_final = $_FILES["$nomeCampo"]['name'];
					$nome_final = str_replace(" ", "_", $nome_final); //substituir o espaco por underline
					$nome_final = str_replace("á", "a", $nome_final);
					$nome_final = str_replace("à", "a", $nome_final);
					$nome_final = str_replace("ã", "a", $nome_final);
					$nome_final = str_replace("â", "a", $nome_final);
					$nome_final = str_replace("é", "e", $nome_final);
					$nome_final = str_replace("è", "e", $nome_final);
					$nome_final = str_replace("ê", "e", $nome_final);
					$nome_final = str_replace("í", "i", $nome_final);
					$nome_final = str_replace("ì", "i", $nome_final);
					$nome_final = str_replace("ó", "o", $nome_final);
					$nome_final = str_replace("ò", "o", $nome_final);
					$nome_final = str_replace("õ", "o", $nome_final);
					$nome_final = str_replace("ô", "o", $nome_final);
					$nome_final = str_replace("ç", "c", $nome_final);

					if (file_exists("{$_UP['pasta']}$nome_final")) {
						$a = 1;
						while (file_exists("{$_UP['pasta']}[$a]$nome_final")) {
							$a++;
						}

						$nome_final = "[" . $a . "]" . $nome_final;
					}

					$nome_final = strtolower($nome_final);
				}

				// Depois verifica se é possível mover o arquivo para a pasta escolhida
				if (move_uploaded_file($_FILES["$nomeCampo"]['tmp_name'], $_UP['pasta'] . $nome_final)) {
					// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
					return($nome_final);
					} else {
					// Não foi possível fazer o upload, provavelmente a pasta est� incorreta
					echo "Nao foi possivel enviar o arquivo, tente novamente";
				}
			}
		}

		//Entra no formato DD/MM/AAAA e sai AAAA-MM-DD
		public static function DataMysql($data) {
			return implode('-', array_reverse(explode('/', $data)));
		}

		//Entra no formato AAAA-MM-DD  e sai DD/MM/AAAA
		public static function DataPt($data) {
			return implode('/', array_reverse(explode('-', $data)));
		}

		public static function DecToMoeda($valor) {
			return number_format($valor, 2, '.', '');
		}

		public static function moedaPt($valor) {
			return number_format($valor, 2, ',', '.');
		}

		public static function diasDecorridos($dt1, $dt2) {
			// Define os valores a serem usados

			// Usa a função strtotime() e pega o timestamp das duas datas:
			$time_inicial = strtotime($dt1);
			$time_final = strtotime($dt2);

			// Calcula a diferença de segundos entre as duas datas:
			$diferenca = $time_final - $time_inicial; // 19522800 segundos
			// Calcula a diferença de dias
			$dias = (int) floor($diferenca / (60 * 60 * 24)); // 225 dias
			return $dias;
		}

		public static function mesesDecorridos($dt1, $dt2) {
			$DataInicial = getdate(strtotime($dt1));
			$DataFinal = getdate(strtotime($dt2));
			$Dif = ($DataFinal[0] - $DataInicial[0]) / 86400;
			$meses = round($Dif / 30);
			return $meses;
		}

		public static function validaEmail($email) {
			$conta = "/^[a-zA-Z0-9\._-]+@";
			$domino = "[a-zA-Z0-9\._-]+.";
			$extensao = "([a-zA-Z]{2,4})$/";

			$pattern = $conta.$domino.$extensao;

			if (preg_match($pattern, $email)){
				return true;
			}else{
				return false;
			}
		}

		public static function getUrl(){
			$url 	=	explode('?','http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
			return $url[0];
		}

		public static function nomeCidade($codigo){
			$cidade = Doctrine_Query::create()->from("Ufcidades n")->where("n.ibge = ?", $codigo)->execute()->toArray();
			return strtoupper($cidade[0]['cidade']);
		}

		public static function atualizaBancoCidade(){

			// Este método atualiza a tabela de de Cidades de acordo com o IBGE
			$path = "MunIBGE/";
			$diretorio = dir($path);

			while($arquivoTXT = $diretorio -> read()){

				//caminho do arquivo no servidor
				$arquivo = 'MunIBGE/'.$arquivoTXT;

				$arquivoArr = array();

				$arq = fopen($arquivo, 'r');

				$total_linhas_importadas = 0;

				while(!feof($arq)){
						$conteudo = fgets($arq);
						$linha = explode(';', $conteudo);
						$arquivoArr[$total_linhas_importadas] = $linha;
						$total_linhas_importadas++;
				}

				$cont = 0;

				foreach($arquivoArr as $linha){
					foreach($linha as $campo){

						$idcidade = intval($campo);
						$descricaocidade = str_replace($idcidade," ",$campo);
						$idestado=substr($idcidade,'0','2');

						if($idestado == '11'){$descricaoestado = 'RO';}
						elseif($idestado == '12'){$descricaoestado = 'AC';}
						elseif($idestado == '13'){$descricaoestado = 'AM';}
						elseif($idestado == '14'){$descricaoestado = 'RR';}
						elseif($idestado == '15'){$descricaoestado = 'PA';}
						elseif($idestado == '16'){$descricaoestado = 'AP';}
						elseif($idestado == '17'){$descricaoestado = 'TO';}
						elseif($idestado == '21'){$descricaoestado = 'MA';}
						elseif($idestado == '22'){$descricaoestado = 'PI';}
						elseif($idestado == '23'){$descricaoestado = 'CE';}
						elseif($idestado == '24'){$descricaoestado = 'RN';}
						elseif($idestado == '25'){$descricaoestado = 'PB';}
						elseif($idestado == '26'){$descricaoestado = 'PE';}
						elseif($idestado == '27'){$descricaoestado = 'AL';}
						elseif($idestado == '28'){$descricaoestado = 'SE';}
						elseif($idestado == '29'){$descricaoestado = 'BA';}
						elseif($idestado == '31'){$descricaoestado = 'MG';}
						elseif($idestado == '32'){$descricaoestado = 'ES';}
						elseif($idestado == '33'){$descricaoestado = 'RJ';}
						elseif($idestado == '35'){$descricaoestado = 'SP';}
						elseif($idestado == '41'){$descricaoestado = 'PR';}
						elseif($idestado == '42'){$descricaoestado = 'SC';}
						elseif($idestado == '43'){$descricaoestado = 'RS';}
						elseif($idestado == '50'){$descricaoestado = 'MS';}
						elseif($idestado == '51'){$descricaoestado = 'MT';}
						elseif($idestado == '52'){$descricaoestado = 'GO';}
						elseif($idestado == '53'){$descricaoestado = 'DF';}

						// ATEÇÃO: Somente Descomente este bloco se for necessário atualizar as tabelas.
						/*
						if($idcidade > 1){
							$cont++;
							$this->cidade    =   new Ufcidades;
							$this->cidade->uf                   = $descricaoestado;
							$this->cidade->cidade     =   $descricaocidade;
							$this->cidade->id           =   $cont;
							$this->cidade->ibge           =   $idcidade;
							$this->cidade->save();
						}
						*/
					}
				}

				$totalll_linhas_importadas += $total_linhas_importadas;
			}

			echo "<br/> Quantidade Total de linhas importadas = ".$totalll_linhas_importadas;
			$diretorio -> close();
			die();

		}

		public static function NomeMes($mes){
			$mes = intval($mes);
			$mons = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
			return $mons[$mes];
		}

		public static function NomeTipoDoc($codigo){
			switch ($codigo) {
				case '1':
					return 'CPF';
					break;
				case '2':
					return 'RG';
					break;
				case '3':
					return 'PASSAPORTE';
					break;

				default:
					return $codigo;
					break;
			}
		}


		public function AjaxValidaCpfCNPJ(){

			$doc 	=	preg_replace('/[^0-9]/', '', (string) $_POST['doc']);

			ob_clean();
			if(strlen($doc)>11){
				echo json_encode(self::validarCnpj($doc));
			}else{
				echo json_encode(self::validarCpf($doc));
			}
			exit();
		}

		function RemoveAcentos($string, $slug = false) {

			$string = strtolower($string);


			// Código ASCII das vogais
			$ascii['a'] = range(224, 230);
			$ascii['e'] = range(232, 235);
			$ascii['i'] = range(236, 239);
			$ascii['o'] = array_merge(range(242, 246), array(240, 248));
			$ascii['u'] = range(249, 252);


			// Código ASCII dos outros caracteres
			$ascii['b'] = array(223);
			$ascii['c'] = array(231);
			$ascii['d'] = array(208);
			$ascii['n'] = array(241);
			$ascii['y'] = array(253, 255);


			foreach ($ascii as $key=>$item) {

				$acentos = '';
				foreach ($item AS $codigo) $acentos .= chr($codigo);
				$troca[$key] = '/['.$acentos.']/i';

			}


			$string = preg_replace(array_values($troca), array_keys($troca), $string);


			// Slug?
			if ($slug) {
				// Troca tudo que não for letra ou número por um caractere ($slug)
				$string = preg_replace('/[^a-z0-9]/i', $slug, $string);
				// Tira os caracteres ($slug) repetidos
				$string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);

				$string = trim($string, $slug);

			}


			return $string;

		}


	}


?>