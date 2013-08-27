<?php

/**
 * sfGuardUser form base class.
 *
 * @method sfGuardUser getObject() Returns the current form's model object
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
abstract class BasesfGuardUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'first_name'          => new sfWidgetFormInputText(),
      'last_name'           => new sfWidgetFormInputText(),
      'real_name'           => new sfWidgetFormInputText(),
      'nick_name'           => new sfWidgetFormInputText(),
      'email_address'       => new sfWidgetFormInputText(),
      'username'            => new sfWidgetFormInputText(),
      'algorithm'           => new sfWidgetFormInputText(),
      'salt'                => new sfWidgetFormInputText(),
      'password'            => new sfWidgetFormInputText(),
      'is_active'           => new sfWidgetFormInputCheckbox(),
      'is_super_admin'      => new sfWidgetFormInputCheckbox(),
      'last_login'          => new sfWidgetFormDateTime(),
      'last_ip'             => new sfWidgetFormInputText(),
      'customstatus'        => new sfWidgetFormInputText(),
      'idiograph'           => new sfWidgetFormInputText(),
      'introduce'           => new sfWidgetFormInputText(),
      'sex'                 => new sfWidgetFormChoice(array('choices' => array(0 => 0, 1 => 1))),
      'birthday'            => new sfWidgetFormDateTime(),
      'phone'               => new sfWidgetFormInputText(),
      'adress'              => new sfWidgetFormInputText(),
      'qq'                  => new sfWidgetFormInputText(),
      'card'                => new sfWidgetFormInputText(),
      'role_manager_bbs_id' => new sfWidgetFormInputText(),
      'rank'                => new sfWidgetFormInputText(),
      'experience'          => new sfWidgetFormInputText(),
      'display_type'        => new sfWidgetFormChoice(array('choices' => array(0 => 0, 1 => 1, 2 => 2))),
      'head_portrait'       => new sfWidgetFormInputText(),
      'questions'           => new sfWidgetFormChoice(array('choices' => array(0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7))),
      'answer'              => new sfWidgetFormInputText(),
      'token'               => new sfWidgetFormInputText(),
      'classes_id'          => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'groups_list'         => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup')),
      'permissions_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission')),
      'classes_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Classes')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'first_name'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'last_name'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'real_name'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nick_name'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email_address'       => new sfValidatorString(array('max_length' => 255)),
      'username'            => new sfValidatorString(array('max_length' => 128)),
      'algorithm'           => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'salt'                => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'password'            => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active'           => new sfValidatorBoolean(array('required' => false)),
      'is_super_admin'      => new sfValidatorBoolean(array('required' => false)),
      'last_login'          => new sfValidatorDateTime(array('required' => false)),
      'last_ip'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'customstatus'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'idiograph'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'introduce'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sex'                 => new sfValidatorChoice(array('choices' => array(0 => 0, 1 => 1), 'required' => false)),
      'birthday'            => new sfValidatorDateTime(array('required' => false)),
      'phone'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'adress'              => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'qq'                  => new sfValidatorString(array('max_length' => 125, 'required' => false)),
      'card'                => new sfValidatorString(array('max_length' => 125, 'required' => false)),
      'role_manager_bbs_id' => new sfValidatorInteger(array('required' => false)),
      'rank'                => new sfValidatorInteger(array('required' => false)),
      'experience'          => new sfValidatorInteger(array('required' => false)),
      'display_type'        => new sfValidatorChoice(array('choices' => array(0 => 0, 1 => 1, 2 => 2), 'required' => false)),
      'head_portrait'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'questions'           => new sfValidatorChoice(array('choices' => array(0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7), 'required' => false)),
      'answer'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'token'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'classes_id'          => new sfValidatorInteger(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'groups_list'         => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup', 'required' => false)),
      'permissions_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'required' => false)),
      'classes_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Classes', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('email_address'))),
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username'))),
      ))
    );

    $this->widgetSchema->setNameFormat('sf_guard_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUser';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['groups_list']))
    {
      $this->setDefault('groups_list', $this->object->Groups->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['permissions_list']))
    {
      $this->setDefault('permissions_list', $this->object->Permissions->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['classes_list']))
    {
      $this->setDefault('classes_list', $this->object->Classes->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveGroupsList($con);
    $this->savePermissionsList($con);
    $this->saveClassesList($con);

    parent::doSave($con);
  }

  public function saveGroupsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['groups_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Groups->getPrimaryKeys();
    $values = $this->getValue('groups_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Groups', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Groups', array_values($link));
    }
  }

  public function savePermissionsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['permissions_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Permissions->getPrimaryKeys();
    $values = $this->getValue('permissions_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Permissions', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Permissions', array_values($link));
    }
  }

  public function saveClassesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['classes_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Classes->getPrimaryKeys();
    $values = $this->getValue('classes_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Classes', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Classes', array_values($link));
    }
  }

}
