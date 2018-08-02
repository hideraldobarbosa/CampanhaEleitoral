<?php

/**
 * BaseTipopesquisa
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $tppsq_id
 * @property string $tppsq_descricao
 * @property string $tppsq_ativo
 * @property string $tppsq_usatipoinformacao
 * @property Doctrine_Collection $Pesquisaperguntas
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTipopesquisa extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('tipopesquisa');
        $this->hasColumn('tppsq_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             ));
        $this->hasColumn('tppsq_descricao', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('tppsq_ativo', 'string', 3, array(
             'type' => 'string',
             'length' => 3,
             'fixed' => true,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('tppsq_usatipoinformacao', 'string', 3, array(
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
        $this->hasMany('Pesquisaperguntas', array(
             'local' => 'tppsq_id',
             'foreign' => 'tppsq_id'));
    }
}