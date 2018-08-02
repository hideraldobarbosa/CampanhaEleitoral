<?php

/**
 * BaseUsuariomodulos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $usu_id
 * @property integer $mod_id
 * @property string $modusu_ativo
 * @property Modulos $Modulos
 * @property Usuario $Usuario
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUsuariomodulos extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('usuariomodulos');
        $this->hasColumn('usu_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             ));
        $this->hasColumn('mod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             ));
        $this->hasColumn('modusu_ativo', 'string', 3, array(
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
        $this->hasOne('Modulos', array(
             'local' => 'mod_id',
             'foreign' => 'mod_id'));

        $this->hasOne('Usuario', array(
             'local' => 'usu_id',
             'foreign' => 'usu_id'));
    }
}