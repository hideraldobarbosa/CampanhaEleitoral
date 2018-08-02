<?php
    /*
        Validação das sessions
    */
    require_once("views/pecas/header.tpl.php");

   
    $oTipoEndereco = New CtrlTipoEndereco;
    $aTipoEndereco = $oTipoEndereco->GetTipoEndereco();
    
?>
 <div class="container-menu ">
    <div class="row">
          <?php
             require_once("views/pecas/menu.tpl.php");
          ?>

        <div class="col-md-8">
            <h4>Tipo Endereco</h4>
            <div class="row">
               <div class="col-xs-8">
                  <div class="lead">Visualize e cadastre Tipo Endereço.</div>
               </div>
               <div class="col-xs-4">
                   <a href="?controller=CtrlTipoEndereco&action=Cadastro" class="btn btn-success">Cadastrar</a>
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
              
                foreach ($aTipoEndereco as $key => $value) {
                
                  $numid = $aTipoEndereco[$key]['id'];
                  $class = '';
                  if($aTipoEndereco[$key]['tpend_ativo'] == 'NÃO'){
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
                  <td>'.$aTipoEndereco[$key]['tpend_id'].'</td>       
                  <td>'.$aTipoEndereco[$key]['tpend_descricao'].'</td>       
                  <td>'.$aTipoEndereco[$key]['tpend_ativo'].'</td>   
                  <td class="td-last col-xs-4" style="text-align: justify ">
                    <form method="post" action="?controller=CtrlTipoEndereco&action=Delete" style="display:inline-block">
                      <input name="tpend_id" value="'.$aTipoEndereco[$key]['tpend_id'].'" type="hidden">
                      <input name="acao" value="'.$acao.'" type="hidden">                          
                      <button class="button-small,'.$Class.'" type="submit" title="'.$acao.' o registro"><i class="'.$Botao.'"></i></button>
                 
                    </form>
                    <form onsubmit="#" method="post" action="?controller=CtrlTipoEndereco&action=Cadastro" style="display:inline-block">
                      <input name="tpend_id" value="'.$aTipoEndereco[$key]['tpend_id'].'"  type="hidden">
                      <input name="tpend_descricao" value="'.$aTipoEndereco[$key]['tpend_descricao'].'"  type="hidden">
                      <input name="tpend_ativo" value="'.$aTipoEndereco[$key]['tpend_ativo'].'"  type="hidden">
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



