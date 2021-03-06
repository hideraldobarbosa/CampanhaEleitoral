<?php

/**
 * BaseQualificacao
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $qlf_id
 * @property string $qlf_descricao
 * @property string $qlf_ativo
 * @property string $qlf_candidato
 * @property string $qlf_caboeleitoral
 * @property string $qlf_eleitor
 * @property Doctrine_Collection $Pessoa
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseQualificacao extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('qualificacao');
        $this->hasColumn('qlf_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             ));
        $this->hasColumn('qlf_descricao', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('qlf_ativo', 'string', 3, array(
             'type' => 'string',
             'length' => 3,
             'fixed' => true,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('qlf_candidato', 'string', 3, array(
             'type' => 'string',
             'length' => 3,
             'fixed' => true,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('qlf_caboeleitoral', 'string', 3, array(
             'type' => 'string',
             'length' => 3,
             'fixed' => true,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('qlf_eleitor', 'string', 3, array(
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
             'local' => 'qlf_id',
             'foreign' => 'qlf_id'));
    }
}