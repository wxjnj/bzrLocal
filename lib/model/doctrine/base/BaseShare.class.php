<?php

/**
 * BaseShare
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $token
 * @property string $title
 * @property string $picture
 * @property string $sub_description
 * @property clob $content
 * @property integer $weight
 * @property integer $user_id
 * @property boolean $is_rank
 * @property sfGuardUser $User
 * 
 * @method string      getToken()           Returns the current record's "token" value
 * @method string      getTitle()           Returns the current record's "title" value
 * @method string      getPicture()         Returns the current record's "picture" value
 * @method string      getSubDescription()  Returns the current record's "sub_description" value
 * @method clob        getContent()         Returns the current record's "content" value
 * @method integer     getWeight()          Returns the current record's "weight" value
 * @method integer     getUserId()          Returns the current record's "user_id" value
 * @method boolean     getIsRank()          Returns the current record's "is_rank" value
 * @method sfGuardUser getUser()            Returns the current record's "User" value
 * @method Share       setToken()           Sets the current record's "token" value
 * @method Share       setTitle()           Sets the current record's "title" value
 * @method Share       setPicture()         Sets the current record's "picture" value
 * @method Share       setSubDescription()  Sets the current record's "sub_description" value
 * @method Share       setContent()         Sets the current record's "content" value
 * @method Share       setWeight()          Sets the current record's "weight" value
 * @method Share       setUserId()          Sets the current record's "user_id" value
 * @method Share       setIsRank()          Sets the current record's "is_rank" value
 * @method Share       setUser()            Sets the current record's "User" value
 * 
 * @package    bzr
 * @subpackage model
 * @author     gefei
 * @version    SVN: $Id: Builder.php,v 1.1 2012/05/04 06:47:28 zhaoy Exp $
 */
abstract class BaseShare extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('share');
        $this->hasColumn('token', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('picture', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('sub_description', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('content', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('weight', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('is_rank', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}