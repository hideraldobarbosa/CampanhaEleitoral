<?php

/**
 * BaseUsuario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $usu_id
 * @property integer $pes_id
 * @property integer $usu_matricula
 * @property string $usu_login
 * @property string $usu_senha
 * @property Pessoa $Pessoa
 * @property Doctrine_Collection $Usuariomodulos
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUsuario extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('usuario');
        $this->hasColumn('usu_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             ));
        $this->hasColumn('pes_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('usu_matricula', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('usu_login', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('usu_senha', 'string', 10, array(
             'type' => 'string',
             'length' => 10,
             'fixed' => true,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Pessoa', array(
             'local' => 'pes_id',
             'foreign' => 'pes_id'));

        $this->hasMany('Usuariomodulos', array(
             'local' => 'usu_id',
             'foreign' => 'usu_id'));
    }
}