<?php
    /*
        Validação das sessions
    */

     require_once("views/pecas/header.tpl.php");

   
    $oTipoComplemento = New CtrlTipoComplemento;
    $aTipoComplemento = $oTipoComplemento->GetTipoComplemento();
    
?>

<div class="container-menu ">
    <div class="row">
          <?php
             require_once("views/pecas/menu.tpl.php");
          ?>

        <div class="col-md-8">
            <h4>Tipo Complemento</h4>
            <div class="row">
               <div class="col-xs-8">
                  <div class="lead">Visualize e cadastre Tipo Complemento.</div>
               </div>
               <div class="col-xs-4">
                   <a href="?controller=CtrlTipoComplemento&action=Cadastro" class="btn btn-success">Cadastrar</a>
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
              
                foreach ($aTipoComplemento as $key => $value) {
                
                  $numid = $aTipoComplemento[$key]['id'];
                  $class = '';
                  if($aTipoComplemento[$key]['tpcpl_ativo'] == 'NÃO'){
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
                  <td>'.$aTipoComplemento[$key]['tpcpl_id'].'</td>       
                  <td>'.$aTipoComplemento[$key]['tpcpl_descricao'].'</td>       
                  <td>'.$aTipoComplemento[$key]['tpcpl_ativo'].'</td>   
                  <td class="td-last col-xs-4" style="text-align: justify ">
                    <form method="post" action="?controller=CtrlTipoComplemento&action=Delete" style="display:inline-block">
                      <input name="tpcpl_id" value="'.$aTipoComplemento[$key]['tpcpl_id'].'" type="hidden">
                      <input name="acao" value="'.$acao.'" type="hidden">                          
                      <button class="button-small,'.$Class.'" type="submit"><i class="'.$Botao.'"></i></button>
                 
                    </form>
                    <form onsubmit="#" method="post" action="?controller=CtrlTipoComplemento&action=Cadastro" style="display:inline-block">
                      <input name="tpcpl_id" value="'.$aTipoComplemento[$key]['tpcpl_id'].'"  type="hidden">
                      <input name="tpcpl_descricao" value="'.$aTipoComplemento[$key]['tpcpl_descricao'].'"  type="hidden">
                      <input name="tpcpl_ativo" value="'.$aTipoComplemento[$key]['tpcpl_ativo'].'"  type="hidden">
                      <button class="button-small" type="submit"><i class="glyphicon glyphicon-edit"></i></button>
                      

                   
                    </form>
                    
                    </td>
               </tr>';
                }   
              ?>
                
          </tbody>
        </table>      
      </div>
    </div>
 </div>
 
<?php require('views/pecas/footer.tpl.php');?> 



