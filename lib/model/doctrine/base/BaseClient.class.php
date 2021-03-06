<?php

/**
 * BaseClient
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $subdomain
 * @property Doctrine_Collection $Pages
 * 
 * @method string              getName()      Returns the current record's "name" value
 * @method string              getSubdomain() Returns the current record's "subdomain" value
 * @method Doctrine_Collection getPages()     Returns the current record's "Pages" collection
 * @method Client              setName()      Sets the current record's "name" value
 * @method Client              setSubdomain() Sets the current record's "subdomain" value
 * @method Client              setPages()     Sets the current record's "Pages" collection
 * 
 * @package    symfonyStudy
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseClient extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('client');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('subdomain', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));


        $this->index('subdomain_index', array(
             'fields' => 
             array(
              0 => 'subdomain',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Page as Pages', array(
             'local' => 'id',
             'foreign' => 'client_id'));
    }
}