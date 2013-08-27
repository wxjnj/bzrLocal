<?php

/**
 * BaseDownloadRecords
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $file_id
 * @property integer $user_id
 * @property integer $price
 * @property sfGuardUser $User
 * @property File $File
 * 
 * @method integer         getFileId()  Returns the current record's "file_id" value
 * @method integer         getUserId()  Returns the current record's "user_id" value
 * @method integer         getPrice()   Returns the current record's "price" value
 * @method sfGuardUser     getUser()    Returns the current record's "User" value
 * @method File            getFile()    Returns the current record's "File" value
 * @method DownloadRecords setFileId()  Sets the current record's "file_id" value
 * @method DownloadRecords setUserId()  Sets the current record's "user_id" value
 * @method DownloadRecords setPrice()   Sets the current record's "price" value
 * @method DownloadRecords setUser()    Sets the current record's "User" value
 * @method DownloadRecords setFile()    Sets the current record's "File" value
 * 
 * @package    bzr
 * @subpackage model
 * @author     gefei
 * @version    SVN: $Id: Builder.php,v 1.1 2012/05/04 06:47:28 zhaoy Exp $
 */
abstract class BaseDownloadRecords extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('download_records');
        $this->hasColumn('file_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('price', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $this->hasOne('File', array(
             'local' => 'file_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}