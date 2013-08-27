<?php

/**
 * BasesfGuardPermission
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $description
 * @property Doctrine_Collection $Groups
 * @property Doctrine_Collection $sfGuardGroupPermission
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $sfGuardUserPermission
 * 
 * @method string              getName()                   Returns the current record's "name" value
 * @method string              getDescription()            Returns the current record's "description" value
 * @method Doctrine_Collection getGroups()                 Returns the current record's "Groups" collection
 * @method Doctrine_Collection getSfGuardGroupPermission() Returns the current record's "sfGuardGroupPermission" collection
 * @method Doctrine_Collection getUsers()                  Returns the current record's "Users" collection
 * @method Doctrine_Collection getSfGuardUserPermission()  Returns the current record's "sfGuardUserPermission" collection
 * @method sfGuardPermission   setName()                   Sets the current record's "name" value
 * @method sfGuardPermission   setDescription()            Sets the current record's "description" value
 * @method sfGuardPermission   setGroups()                 Sets the current record's "Groups" collection
 * @method sfGuardPermission   setSfGuardGroupPermission() Sets the current record's "sfGuardGroupPermission" collection
 * @method sfGuardPermission   setUsers()                  Sets the current record's "Users" collection
 * @method sfGuardPermission   setSfGuardUserPermission()  Sets the current record's "sfGuardUserPermission" collection
 * 
 * @package    bzr
 * @subpackage model
 * @author     gefei
 * @version    SVN: $Id: Builder.php,v 1.1 2012/05/04 06:47:28 zhaoy Exp $
 */
abstract class BasesfGuardPermission extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_permission');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('sfGuardGroup as Groups', array(
             'refClass' => 'sfGuardGroupPermission',
             'local' => 'permission_id',
             'foreign' => 'group_id'));

        $this->hasMany('sfGuardGroupPermission', array(
             'local' => 'id',
             'foreign' => 'permission_id'));

        $this->hasMany('sfGuardUser as Users', array(
             'refClass' => 'sfGuardUserPermission',
             'local' => 'permission_id',
             'foreign' => 'user_id'));

        $this->hasMany('sfGuardUserPermission', array(
             'local' => 'id',
             'foreign' => 'permission_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}