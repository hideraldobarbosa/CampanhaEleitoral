        <?php
          /*
              Validação das sessions
          */

         //require_once("views/pecas/header.tpl.php");


          $oSetores = New CtrlSetores;


          /**
           * Inicio paginação
           */
              if(isset($_GET["pagina"])) { $pagina = $_GET["pagina"];} else{  $pagina = 1;  }
              $maximo=10;
              $inicio = $pagina - 1;
              $inicio = $maximo * $inicio;        
              //realiza o count na tabela de setores
              $total = $oSetores->GetSetorCount();
          /**
           * Fim configuração paginação
           */

          //retorna a lista de setores
          $aSetores = $oSetores->GetSetor($pagina, $maximo);  

      ?>  
    <!-- header -->
      <?php include "views/pecas/header.tpl.php"; ?>

      <!-- Left side column. contains the logo and sidebar -->
      <?php include "views/pecas/sideBar.php"; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            SETOR
              
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Setor</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"></h3>
                    <div class="row">
                       <!--div class="col-xs-2">
                          <div class="lead"><h4>Setor</h4></div>
                       </div-->
                       <div class="col-xs-2">
                            <form onsubmit="#" method="post" action="?controller=CtrlSetores&action=Cadastro" style="display:inline-block">
                              <input name="setor_ativo"   value="SIM"  type="hidden" >

                              <button class="btn btn-large btn-primary" type="submit" Title="Novo Setor">Novo Registro</button>

                            </form>
                       </div>
                    </div>
        
                  <!--a href="?controller=CtrlSetores&action=Cadastro" title="Insere novo registro." class="btn btn-large btn-primary">Novo registro</a-->
                 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Exportar Setores</a></li>
                        <li><a href="#">Importar Setores</a></li>
                        <li><a href="#">Relação em PDF</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Outras Operações</a></li>
                      </ul>
                    </div>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-8">
                    
            <div class="row">
               <div class="col-xs-8">
                 
               </div>
               
            </div>
           <!-- Aqui vem o conteudo -->  
           
            <table width="80%" class="table table-striped table-bordered table-condensed tablegrid" > 
            <thead> 
              <tr>
                <th width="11%">Código</th> 
                <th width="71%">Descrição</th>          
                <th width="8%">Ativo</th>
                <th width="10%">Operações</th>
              </tr>               
            </thead> 
            <tbody>      
            
              <?php 
              
                foreach ($aSetores as $key => $value) {
                
                  $numid = $aSetores[$key]['id'];
                  $class = '';
                  if($aSetores[$key]['setor_ativo'] == 'NAO'){
                    $ativo = 'NAO';
                    $acao =  'Excluir';
                    $Botao = 'glyphicon glyphicon-remove';
                    $class = 'class="danger"';
                    
                  }else{
                    $ativo = 'SIM';
                    $acao  = 'Excluir';
                    $Botao = "glyphicon glyphicon-remove";
          
                    
                  }
                  echo"<tr $class>". 
                        //<td><input type="checkbox" class="form-control" id="marcadas" name="marcadas" style="width: 20px; float: left"></td> 
                  '
                  <td>'.$aSetores[$key]['setor_id'].'</td>       
                  <td>'.$aSetores[$key]['setor_descricao'].'</td>       
                  <td>'.$aSetores[$key]['setor_ativo'].'</td>   
                  <td class="td-last col-xs-4" style="text-align: justify ">
                    <form method="post" action="?controller=CtrlSetores&action=Delete" style="display:inline-block">
                      <input name="setor_id" value="'.$aSetores[$key]['setor_id'].'" type="hidden">
                      <input name="acao" value="'.$acao.'" type="hidden">   
                      <button class="button-small,'.$Class.'" type="submit" title="'.$acao.' o registro"><i class="'.$Botao.'"></i></button>
                    </form>
                    <form onsubmit="#" method="post" action="?controller=CtrlSetores&action=Cadastro" style="display:inline-block">
                      <input name="setor_id" value="'.$aSetores[$key]['setor_id'].'"  type="hidden">
                      <input name="setor_descricao" value="'.$aSetores[$key]['setor_descricao'].'"  type="hidden">
                      <input name="setor_ativo"   value="'.$aSetores[$key]['setor_ativo'].'"  type="hidden" checked>    
                      <button class="button-small" type="submit" Title="Editar Registro."><i class="glyphicon glyphicon-edit"></i></button>
                    </form>
                    
                    </td>
               </tr>';
                }   
              ?>
                
           </tbody>
        </table>
           
                <table width="100%" border="0" align="center">
                  <tr>
                    <td align="center" valign = "middle">
                        <div id="pagination-digg"  >
                            <?php
                                $menos = $pagina - 1;	
                                $mais = $pagina + 1;	
                                $pgs = ceil($total / $maximo);
                                        if($pgs > 1 ) {
                                                if($menos > 0) { echo "<a href=\"?controller=CtrlSetores&action=GeraLista&pagina=$menos\" class='texto_paginacao'><img src='http://" .$_SERVER['SERVER_NAME'] ."/campanha/assets/images/sort_left.png' title='Anterior' border = '0'></a> ";
                                                }			
                                                for($i=1;$i <= $pgs;$i++) {
                                                        if($i != $pagina) {	echo "  <a href=\"?controller=CtrlSetores&action=GeraLista&pagina=".($i)."\" class='texto_paginacao'>$i</a>";
                                                        } else {	echo "  <strong lass='texto_paginacao_pgatual'>".$i."</strong>";
                                                                }
                                                }
                                                        if($mais <= $pgs) {	echo "   <a href=\"?controller=CtrlSetores&action=GeraLista&pagina=$mais\" class='texto_paginacao'><img src='http://" .$_SERVER['SERVER_NAME'] ."/campanha/assets/images/sort_rigth.png' title='Próxima' border = '0'></a>";
                                                        }
                                        }
                           ?> </div></td>
                  </tr>
                </table>
            
            <?php //echo $_SERVER['SERVER_NAME'] . $_SERVER ['PHP_SELF']; 
           
            ?> 
            
          <?php
             if (isset($_GET['msg'])){
              echo('<div id="msg"><h4>Operação realizada com sucesso.</h4> 
                     <div id="fechar"><a href="#" title="Fechar" class="fechar"><i class="glyphicon glyphicon-edit"></i></a></div></div>');
              
                 
             }
          
          ?>
           <!-- Fim do conteudo -->
                    
                    </div><!-- /.col -->
                    
                      
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
                
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Main row -->
          <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


<!-- Footer -->
      <?php include "views/pecas/footer.tpl.php"; ?>