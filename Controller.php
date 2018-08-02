<?php

class Controller {

    public $view;
    public $Home;
    public $Helper;
    public $CtrlLogin;
    public $CtrlSetores;
    public $CtrlTipoInformacao;
    public $CtrlTipoComplemento;
    public $CtrleTipoCoordenada;
    public $CtrlMenubd;
    public $CtrlTipoVia;
    public $CtrlTipoEndereco;
    public $CtrlTipoDetalheCidade;
    public $CtrlCidades;
    public $CtrlEstado;

    function __construct() {
        
//  verificar se é necessário esta declaração
        
        $this->view 		     = new View;
        $this->Home 		     = new Home;
        $this->CtrlLogin             = new CtrlLogin;
        $this->Helper 		     = new Helper;
        $this->CtrlSetores           = new CtrlSetores;
        $this->CtrlTipoInformacao    = new CtrlTipoInformacao;
        $this->CtrlTipoComplemento   = new CtrlTipoComplemento;
        $this->CtrlTipoCoordenada    = new CtrlTipoCoordenada;
        $this->CtrlTipoVia           = new CtrlTipoVia;
        $this->CtrlTipoEndereco      = new CtrlTipoEndereco;
        $this->CtrlMenubd            = new CtrlMenubd;
        $this->CtrlTipoDetalheCidade = new CtrlTipoDetalheCidade;
        $this->CtrlCidades           = new CtrlCidades;
        $this->CtrlEstado            = new CtrlEstado; 
        
        //echo(' classe :'.$_GET['controller'].'   metodo:'.$_GET['action'].'   id:'.$_GET['id']);
        if (isset($_GET['controller']) && isset($_GET['action'])) {

            $module = $_GET['controller'];
            $action = $_GET['action'];
            if (isset($_GET['id'])) {
                $data = $this->$module->$action($_GET['id']);
            } else {
                if (isset($_POST)) {
                    $this->$module->$action($_POST);

                } else {
                    $data = $this->$module->$action();
                }
            }
            $this->view->load("$module/$action", $data);

        } else {
            if (isset($_GET['view'])) {
                $this->view->load("{$_GET['controller']}/{$_GET['view']}");

            }/* else {

                if(!empty($_SESSION['nfe']['tipo'])){
                    $area = 'area'.strtolower($_SESSION['nfe']['tipo']);
                    echo($area);
                    $this->view->load($area);
                }else{
                    $this->view->load("home");
                }
            }*/
        }
        
        
    }

}
