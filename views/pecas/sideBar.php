<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Candidato Exemplo</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
              <a href="#" class="fa text-success">Perfil</a>
            </div>
           
          </div>
        
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Menu Principal</li>
            <li class="active">
              <a href="?controller=Home">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
              </a>
              
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Cadastros</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">      
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Tipos <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href='?controller=CtrlSetores&action=GeraLista'><i class="fa fa-circle-o"></i><span>Setores</span></a></li>
                    <li><a href='?controller=CtrlTipoInformacao&action=GeraLista'><i class="fa fa-circle-o"></i><span>Dados Questionário</span></a></li>  
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i>Endereçamento<i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i>Tipos<i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href='?controller=CtrlTipoComplemento&action=GeraLista'><i class="fa fa-circle-o"></i><span>Tipo Complemento</span></a></li>
                        <li><a href='?controller=CtrlTipoCoordenada&action=GeraLista'><i class="fa fa-circle-o"></i><span>Tipo Coordenada</span></a></li>
                        <li><a href='?controller=CtrlTipoVia&action=GeraLista'><i class="fa fa-circle-o"></i><span>Tipo Via</span></a></li>
                        <li><a href='?controller=CtrlTipoEndereco&action=GeraLista'><i class="fa fa-circle-o"></i><span>Tipo Endereco</span></a></li>
                        <li><a href='?controller=CtrlTipoDetalheCidade&action=GeraLista'><i class="fa fa-circle-o"></i><span>Tipo Detalhe Cidade</span></a></li>                     
                      </ul>
                    </li>          
                    <li><a href='?controller=CtrlPaises&action=GeraLista'><i class="fa fa-circle-o"></i><span>Países</span></a></li>
                    <li><a href='?controller=CtrlEstado&action=GeraLista'><i class="fa fa-circle-o"></i><span>Estado</span></a></li>                   
                    <li><a href='?controller=CtrlCidades&action=GeraLista'><i class="fa fa-circle-o"></i><span>Cidades</span></a></li>
                    <li><a href='?controller=CtrlEstado&action=GeraLista'><i class="fa fa-circle-o"></i><span>Região Bairro</span></a></li>                   
                    <li><a href='?controller=CtrlCidades&action=GeraLista'><i class="fa fa-circle-o"></i><span>Bairro</span></a></li>

                  </ul>
                </li>
               </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Movimentações</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>Solicitação</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Ação 1 <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Ação Pertinente </a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Ação 2 <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Correção 1</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Correção 2</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Ações Corretivas </a></li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>