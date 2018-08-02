<?php

/**
 * BaseSexo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $sexo_id
 * @property string $sexo_descricao
 * @property string $seox_ativo
 * @property Doctrine_Collection $Pessoa
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSexo extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('sexo');
        $this->hasColumn('sexo_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             ));
        $this->hasColumn('sexo_descricao', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('seox_ativo', 'string', 3, array(
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
        $this->hasMany('Pessoa', array(
             'local' => 'sexo_id',
             'foreign' => 'sexo_id'));
    }
}