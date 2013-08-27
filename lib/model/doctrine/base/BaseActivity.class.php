<?php

/**
 * BaseActivity
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $token
 * @property string $title
 * @property clob $content
 * @property integer $weight
 * 
 * @method string   getToken()   Returns the current record's "token" value
 * @method string   getTitle()   Returns the current record's "title" value
 * @method clob     getContent() Returns the current record's "content" value
 * @method integer  getWeight()  Returns the current record's "weight" value
 * @method Activity setToken()   Sets the current record's "token" value
 * @method Activity setTitle()   Sets the current record's "title" value
 * @method Activity setContent() Sets the current record's "content" value
 * @method Activity setWeight()  Sets the current record's "weight" value
 * 
 * @package    bzr
 * @subpackage model
 * @author     gefei
 * @version    SVN: $Id: Builder.php,v 1.1 2012/05/04 06:47:28 zhaoy Exp $
 */
abstract class BaseActivity extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('activity');
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
        $this->hasColumn('content', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('weight', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}