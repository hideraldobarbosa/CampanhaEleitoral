<?php

/**
 * BaseEndtipoendereco
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $tpend_id
 * @property string $tpend_descricao
 * @property string $tpend_ativo
 * @property Doctrine_Collection $Pessoaendereco
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEndtipoendereco extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('endtipoendereco');
        $this->hasColumn('tpend_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             ));
        $this->hasColumn('tpend_descricao', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('tpend_ativo', 'string', 3, array(
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
        $this->hasMany('Pessoaendereco', array(
             'local' => 'tpend_id',
             'foreign' => 'tpend_id'));
    }
}