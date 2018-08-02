<?php
    /*
        Validação das sessions
    */

     require_once("views/pecas/header.tpl.php");

   
    $oTipoCoordenada = New CtrlTipoCoordenada;
    $aTipoCoordenada = $oTipoCoordenada->GetTipoCoordenada();
    
?>

<div class="container-menu ">
    <div class="row">
          <?php
             require_once("views/pecas/menu.tpl.php");
          ?>

        <div class="col-md-8">
            <h4>Tipo Coordenada</h4>
            <div class="row">
               <div class="col-xs-8">
                  <div class="lead">Visualize e cadastre Tipo Coordenada.</div>
               </div>
               <div class="col-xs-4">
                   <a href="?controller=CtrlTipoCoordenada&action=Cadastro" class="btn btn-success">Cadastrar</a>
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
              
                foreach ($aTipoCoordenada as $key => $value) {
                
                  $numid = $aTipoCoordenada[$key]['id'];
                  $class = '';
                  if($aTipoCoordenada[$key]['tpcrd_ativo'] == 'NÃO'){
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
                  <td>'.$aTipoCoordenada[$key]['tpcrd_id'].'</td>       
                  <td>'.$aTipoCoordenada[$key]['tpcrd_descricao'].'</td>       
                  <td>'.$aTipoCoordenada[$key]['tpcrd_ativo'].'</td>   
                  <td class="td-last col-xs-4" style="text-align: justify ">
                    <form method="post" action="?controller=CtrlTipoCoordenada&action=Delete" style="display:inline-block">
                      <input name="tpcrd_id" value="'.$aTipoCoordenada[$key]['tpcrd_id'].'" type="hidden">
                      <input name="acao" value="'.$acao.'" type="hidden">                          
                      <button class="button-small,'.$Class.'" type="submit"><i class="'.$Botao.'"></i></button>
                 
                    </form>
                    <form onsubmit="#" method="post" action="?controller=CtrlTipoCoordenada&action=Cadastro" style="display:inline-block">
                      <input name="tpcrd_id" value="'.$aTipoCoordenada[$key]['tpcrd_id'].'"  type="hidden">
                      <input name="tpcrd_descricao" value="'.$aTipoCoordenada[$key]['tpcrd_descricao'].'"  type="hidden">
                      <input name="tpcrd_ativo" value="'.$aTipoCoordenada[$key]['tpcrd_ativo'].'"  type="hidden">
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
 
<?php require('views/pecas/footer.tpl.php');?> 



