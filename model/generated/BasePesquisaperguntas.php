<?php

/**
 * BasePesquisaperguntas
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $pgpsq_id
 * @property integer $tppsq_id
 * @property string $pgpsq_ativo
 * @property string $pgpsq_titulo
 * @property date $pgpsq_dataelaboracao
 * @property date $pgpsq_datapesquisa
 * @property Tipopesquisa $Tipopesquisa
 * @property Doctrine_Collection $Itempesquisapergunta
 * @property Doctrine_Collection $Pesquisaresposta
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePesquisaperguntas extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('pesquisaperguntas');
        $this->hasColumn('pgpsq_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             ));
        $this->hasColumn('tppsq_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             ));
        $this->hasColumn('pgpsq_ativo', 'string', 3, array(
             'type' => 'string',
             'length' => 3,
             'fixed' => true,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('pgpsq_titulo', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('pgpsq_dataelaboracao', 'date', null, array(
             'type' => 'date',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('pgpsq_datapesquisa', 'date', null, array(
             'type' => 'date',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Tipopesquisa', array(
             'local' => 'tppsq_id',
             'foreign' => 'tppsq_id'));

        $this->hasMany('Itempesquisapergunta', array(
             'local' => 'pgpsq_id',
             'foreign' => 'pgpsq_id'));

        $this->hasMany('Pesquisaresposta', array(
             'local' => 'pgpsq_id',
             'foreign' => 'pgpsq_id'));
    }
}