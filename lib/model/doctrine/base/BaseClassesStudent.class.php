<?php

/**
 * BaseClassesStudent
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $classes_id
 * @property integer $user_id
 * @property sfGuardUser $Student
 * @property Classes $Classes
 * 
 * @method integer        getClassesId()  Returns the current record's "classes_id" value
 * @method integer        getUserId()     Returns the current record's "user_id" value
 * @method sfGuardUser    getStudent()    Returns the current record's "Student" value
 * @method Classes        getClasses()    Returns the current record's "Classes" value
 * @method ClassesStudent setClassesId()  Sets the current record's "classes_id" value
 * @method ClassesStudent setUserId()     Sets the current record's "user_id" value
 * @method ClassesStudent setStudent()    Sets the current record's "Student" value
 * @method ClassesStudent setClasses()    Sets the current record's "Classes" value
 * 
 * @package    bzr
 * @subpackage model
 * @author     gefei
 * @version    SVN: $Id: Builder.php,v 1.1 2012/05/04 06:47:28 zhaoy Exp $
 */
abstract class BaseClassesStudent extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('classes_student');
        $this->hasColumn('classes_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as Student', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Classes', array(
             'local' => 'classes_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}