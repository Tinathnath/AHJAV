<?php

/**
 * BaseSponsor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nom
 * @property string $logo_url
 * @property string $website
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSponsor extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('sponsor');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('nom', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('logo_url', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('website', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}