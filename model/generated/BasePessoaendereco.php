<?php

/**
 * BasePessoaendereco
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $pesend_id
 * @property integer $tpvia_id
 * @property integer $bai_id
 * @property integer $tpend_id
 * @property integer $tpcpl_id
 * @property integer $pes_id
 * @property integer $cid_id
 * @property integer $tpcrd_id
 * @property Bairro $Bairro
 * @property Cidades $Cidades
 * @property Endtipoendereco $Endtipoendereco
 * @property Pessoa $Pessoa
 * @property Endtipovia $Endtipovia
 * @property Endtipocomplemento $Endtipocomplemento
 * @property Endtipocoordenada $Endtipocoordenada
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePessoaendereco extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('pessoaendereco');
        $this->hasColumn('pesend_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             ));
        $this->hasColumn('tpvia_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('bai_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('tpend_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('tpcpl_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('pes_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('cid_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
        $this->hasColumn('tpcrd_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Bairro', array(
             'local' => 'bai_id',
             'foreign' => 'bai_id'));

        $this->hasOne('Cidades', array(
             'local' => 'cid_id',
             'foreign' => 'cid_id'));

        $this->hasOne('Endtipoendereco', array(
             'local' => 'tpend_id',
             'foreign' => 'tpend_id'));

        $this->hasOne('Pessoa', array(
             'local' => 'pes_id',
             'foreign' => 'pes_id'));

        $this->hasOne('Endtipovia', array(
             'local' => 'tpvia_id',
             'foreign' => 'tpvia_id'));

        $this->hasOne('Endtipocomplemento', array(
             'local' => 'tpcpl_id',
             'foreign' => 'tpcpl_id'));

        $this->hasOne('Endtipocoordenada', array(
             'local' => 'tpcrd_id',
             'foreign' => 'tpcrd_id'));
    }
}