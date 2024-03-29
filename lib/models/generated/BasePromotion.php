<?php

/**
 * BasePromotion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nom
 * @property string $categorie
 * @property string $image
 * @property integer $partenaire_id
 * @property Doctrine_Collection $Partenaire
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePromotion extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('promotion');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('nom', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('categorie', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('image', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('partenaire_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Partenaire', array(
             'local' => 'partenaire_id',
             'foreign' => 'id'));
    }
}