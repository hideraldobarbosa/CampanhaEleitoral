<?php
    /*
        Validação das sessions
    */

    require_once("views/pecas/header.tpl.php");

   
    $ocidades = New CtrlCidades;
    $acidades = $ocidades->GetCidades();

?>
 <div class="container-menu ">
    <div class="row">
          <?php
             require_once("views/pecas/menu.tpl.php");
          ?>

        <div class="col-md-8">
            <h4>Cidades</h4>
            <div class="row">
               <div class="col-xs-8">
                  <div class="lead">Visualize e cadastre Cidades.</div>
               </div>
               <div class="col-xs-">
                   <a href="?controller=CtrlCidades&action=Cadastro" title="Cadastrar novo Registro." class="btn btn-large btn-primary">Cadastrar novo registro</a>
               </div>
            </div>
            <table width="80%" class="table table-striped table-bordered table-condensed tablegrid" > 
            <thead> 
              <tr>
                <th>Código</th> 
                <th>Nome</th>        
                <th>DDD</th>
                <th>Estado</th>
                <th>País</th>
                <th>Ativo</th>
                <th>Operações</th>
              </tr> 
            </thead> 
            <tbody>             
              <?php 
              
                foreach ($acidades as $key => $value) {
                
                  $numid = $acidades[$key]['id'];
                  $class = '';
                  if($acidades[$key]['cid_ativo'] == 'NÃO'){
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
                  <td>'.$acidades[$key]['cid_id'].'</td>       
                  <td>'.$acidades[$key]['cid_nome'].'</td>   
                  <td>'.$acidades[$key]['cid_ddd'].'</td>   
                  <td>'.$acidades[$key]['est_nome'].'</td>   
                  <td>'.$acidades[$key]['pais_nome'].'</td-->   
                  <td>'.$acidades[$key]['cid_ativo'].'</td>   
                  <td class="td-last col-xs-4" style="text-align: justify ">
                    <form method="post" action="?controller=CtrlCidades&action=Delete" style="display:inline-block">
                      <input name="cid_id" value="'.$acidades[$key]['cid_id'].'" type="hidden">
                      <input name="acao" value="'.$acao.'" type="hidden">                          
                      <button class="button-small,'.$Class.'" type="submit" title="'.$acao.' o registro"><i class="'.$Botao.'"></i></button>
                 
                    </form>
                    <form onsubmit="#" method="post" action="?controller=CtrlCidades&action=Cadastro" style="display:inline-block">
                      <input name="cid_id" value="'.$acidades[$key]['cid_id'].'"  type="hidden">
                      <input name="cid_nome" value="'.$acidades[$key]['cid_nome'].'"  type="hidden">
                      <input name="cid_ddd" value="'.$acidades[$key]['cid_ddd'].'"  type="hidden">
                      <input name="cid_estado" value="'.$acidades[$key]['est_nome'].'"  type="hidden">
                      <input name="cid_pais" value="'.$acidades[$key]['pais_nome'].'"  type="hidden">
                      <input name="cid_ativo" value="'.$acidades[$key]['cid_ativo'].'"  type="hidden">
                      <button class="button-small" type="submit" Title="Editar Registro."><i class="glyphicon glyphicon-edit"></i></button>
                      

                   
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




