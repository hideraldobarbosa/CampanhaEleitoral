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
                  <!--h3 class="box-title">Manutenção de Setor</h3-->             
                 
                  
                 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Ação</a></li>
                        <li><a href="#">Outra Ação</a></li>
                        <li><a href="#">Outra coisa aqui</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Conexão Separação</a></li>
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
                        
          <form  action="?controller=CtrlSetores&action=Save" method="post" id="formSetor" class="form-horizontal"> 
            <div class="panel  panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Manutenção de Setor</h3>
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Código</label>
                        <div class="col-sm-2">
                            <input type="text" readonly="readonly" class="form-control" name="codigo" 
                                value="<?php echo $data['setor_id'] ? $data['setor_id'] : $_POST['setor_id']; ?>" 
                                placeholder="Id Sequencial.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Descrição*</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control"  id="descricao" name="descricao" 
                                value="<?php echo $data['setor_descricao'] ? $data['setor_descricao'] : $_POST['setor_descricao']; ?>"
                                 required >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Ativo*</label>
                        <div class="col-sm-2">
                            <div  class="input-group col-sm-12">
                                    <label class="radio-inline">
                                      <input type="radio" id = "ativosim" name="ativo" value="SIM" <?php if($_POST['setor_ativo'] == 'SIM') { echo('CHECKED');} ?> >Sim
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" id = "ativonao" name="ativo" value="NAO" <?php if($_POST['setor_ativo'] == 'NAO') { echo('CHECKED');} ?>>Não
                                    </label>
                               
                            </div>
                        </div>
                    </div>
                    <div class ="row-fluid">
                          <div class="col-sm-2 col-sm-offset-3">
                            <button class="btn btn-success" title="Salva Registro" type="submit">Salvar Registro</button>
                          </div>
                          <div class="col-sm-0">
                            <a type="Button" class="btn btn-danger"  href="?controller=CtrlSetores&action=GeraLista">Cancelar Operação</a>
                          </div>
                  
                    </div>     
                </div>
            </div>
        </form>
                        
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

<script type="text/javascript">

    $(function() {
        $('#formSetor').validate();
    });
</script>

