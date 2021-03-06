<?php

/**
 * BaseCidades
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $cid_id
 * @property integer $est_id
 * @property integer $pais_id
 * @property string $cid_nome
 * @property string $cid_ddd
 * @property string $cid_ativo
 * @property Estado $Estado
 * @property Paises $Paises
 * @property Doctrine_Collection $Bairro
 * @property Doctrine_Collection $Regiaobairro
 * @property Doctrine_Collection $Pessoaendereco
 * @property Doctrine_Collection $Cidadedetalhes
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCidades extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('cidades');
        $this->hasColumn('cid_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             ));
        $this->hasColumn('est_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('pais_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('cid_nome', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('cid_ddd', 'string', 4, array(
             'type' => 'string',
             'length' => 4,
             'fixed' => true,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('cid_ativo', 'string', 3, array(
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
        $this->hasOne('Estado', array(
             'local' => 'est_id',
             'foreign' => 'est_id'));

        $this->hasOne('Paises', array(
             'local' => 'pais_id',
             'foreign' => 'pais_id'));

        $this->hasMany('Bairro', array(
             'local' => 'cid_id',
             'foreign' => 'cid_id'));

        $this->hasMany('Regiaobairro', array(
             'local' => 'cid_id',
             'foreign' => 'cid_id'));

        $this->hasMany('Pessoaendereco', array(
             'local' => 'cid_id',
             'foreign' => 'cid_id'));

        $this->hasMany('Cidadedetalhes', array(
             'local' => 'cid_id',
             'foreign' => 'cid_id'));
    }
}