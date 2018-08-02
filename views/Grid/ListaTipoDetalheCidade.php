<?php
    /*
        Validação das sessions
    */

    require_once("views/pecas/header.tpl.php");

   
    $oTipoDetalheCidade = New CtrlTipoDetalheCidade;
    $aTipoDetalheCidade = $oTipoDetalheCidade->GetTipoDetalheCidade();
    
?>
 <div class="container-menu ">
    <div class="row">
          <?php
             require_once("views/pecas/menu.tpl.php");
          ?>

        <div class="col-md-8">
            <h4>Tipo Detalhe Cidade</h4>
            <div class="row">
               <div class="col-xs-8">
                  <div class="lead">Visualize e cadastre Tipo Detalhe Cidade.</div>
               </div>
               <div class="col-xs-4">
                   <a href="?controller=CtrlTipoDetalheCidade&action=Cadastro" class="btn btn-success">Cadastrar</a>
               </div>
            </div>
            <table width="80%" class="table table-striped table-bordered table-condensed tablegrid" > 
            <thead> 
              <tr>
                <th>Código</th> 
                <th>Descrição</th>          
                <th>Ativo</th>
                <th>Operações</th>
              </tr> 
            </thead> 
            <tbody>             
              <?php 
              
                foreach ($aTipoDetalheCidade as $key => $value) {
                
                  $numid = $aTipoDetalheCidade[$key]['id'];
                  $class = '';
                  if($aTipoDetalheCidade[$key]['dtcid_ativo'] == 'NÃO'){
                    $ativo = 'NAO';
                    $acao =  'Ativa';
                    $Botao = 'glyphicon glyphicon-ok';
                    $class = 'class="danger"';
                  }else{
                    $ativo = 'SIM';
                    $acao  = 'Inativa';
                    $Botao = "glyphicon glyphicon-remove";
          
                    
                  }
                  echo"<tr $class>". 
                        //<td><input type="checkbox" class="form-control" id="marcadas" name="marcadas" style="width: 20px; float: left"></td> 
                  '
                  <td>'.$aTipoDetalheCidade[$key]['dtcid_id'].'</td>       
                  <td>'.$aTipoDetalheCidade[$key]['dtcid_descricao'].'</td>       
                  <td>'.$aTipoDetalheCidade[$key]['dtcid_ativo'].'</td>   
                  <td class="td-last col-xs-4" style="text-align: justify ">
                    <form method="post" action="?controller=CtrlTipoDetalheCidade&action=Delete" style="display:inline-block">
                      <input name="dtcid_id" value="'.$aTipoDetalheCidade[$key]['dtcid_id'].'" type="hidden">
                      <input name="acao" value="'.$acao.'" type="hidden">                          
                      <button class="button-small,'.$Class.'" type="submit" title="'.$acao.' o registro"><i class="'.$Botao.'"></i></button>
                 
                    </form>
                    <form onsubmit="#" method="post" action="?controller=CtrlTipoDetalheCidade&action=Cadastro" style="display:inline-block">
                      <input name="dtcid_id" value="'.$aTipoDetalheCidade[$key]['dtcid_id'].'"  type="hidden">
                      <input name="dtcid_descricao" value="'.$aTipoDetalheCidade[$key]['dtcid_descricao'].'"  type="hidden">
                      <input name="dtcid_ativo" value="'.$aTipoDetalheCidade[$key]['dtcid_ativo'].'"  type="hidden">
                      <button class="button-small" type="submit"><i class="glyphicon glyphicon-edit"></i></button>
                      

                   
                    </form>
                    
                    </td>
               </tr>';
                }   
              ?>
                
          </tbody>
        </table>      
          <?php
             if (isset($_GET['msg'])){
              echo('<div id="msg"><h4>Operação realizada com sucesso.</h4> 
                     <div id="fechar"><a href="#" title="Fechar" class="fechar"><i class="glyphicon glyphicon-edit"></i></a></div></div>');
              
                 
             }
          
          ?>
            
      </div>
    </div>
 </div>

          
<?php require('views/pecas/footer.tpl.php');?> 



