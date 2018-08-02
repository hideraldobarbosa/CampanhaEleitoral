<?php

/**
 * BaseTipocontato
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $tpcont_id
 * @property string $tpcont_descricao
 * @property string $tpcont_ativo
 * @property Doctrine_Collection $Pessoacontato
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTipocontato extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('tipocontato');
        $this->hasColumn('tpcont_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             ));
        $this->hasColumn('tpcont_descricao', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('tpcont_ativo', 'string', 3, array(
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
        $this->hasMany('Pessoacontato', array(
             'local' => 'tpcont_id',
             'foreign' => 'tpcont_id'));
    }
}