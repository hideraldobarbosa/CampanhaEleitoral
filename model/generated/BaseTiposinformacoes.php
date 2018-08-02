<?php

/**
 * BaseTiposinformacoes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $tpinf_id
 * @property integer $tpinf_codigo
 * @property string $tpinf_descricao
 * @property string $tpinf_ativo
 * @property Doctrine_Collection $Dadostiposinformacoes
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTiposinformacoes extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('tiposinformacoes');
        $this->hasColumn('tpinf_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             ));
        $this->hasColumn('tpinf_codigo', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('tpinf_descricao', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('tpinf_ativo', 'string', 3, array(
             'type' => 'string',
             'length' => 3,
             'fixed' => true,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Dadostiposinformacoes', array(
             'local' => 'tpinf_id',
             'foreign' => 'tpinf_id'));
    }
}