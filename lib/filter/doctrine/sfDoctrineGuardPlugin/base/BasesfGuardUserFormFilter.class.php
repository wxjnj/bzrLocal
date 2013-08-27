<?php

/**
 * sfGuardUser filter form base class.
 *
 * @package    bzr
 * @subpackage filter
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php,v 1.1 2012/05/04 06:47:42 zhaoy Exp $
 */
abstract class BasesfGuardUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'first_name'          => new sfWidgetFormFilterInput(),
      'last_name'           => new sfWidgetFormFilterInput(),
      'real_name'           => new sfWidgetFormFilterInput(),
      'nick_name'           => new sfWidgetFormFilterInput(),
      'email_address'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'username'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'algorithm'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'salt'                => new sfWidgetFormFilterInput(),
      'password'            => new sfWidgetFormFilterInput(),
      'is_active'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_super_admin'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'last_login'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'last_ip'             => new sfWidgetFormFilterInput(),
      'customstatus'        => new sfWidgetFormFilterInput(),
      'idiograph'           => new sfWidgetFormFilterInput(),
      'introduce'           => new sfWidgetFormFilterInput(),
      'sex'                 => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => 0, 1 => 1))),
      'birthday'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'phone'               => new sfWidgetFormFilterInput(),
      'adress'              => new sfWidgetFormFilterInput(),
      'qq'                  => new sfWidgetFormFilterInput(),
      'card'                => new sfWidgetFormFilterInput(),
      'role_manager_bbs_id' => new sfWidgetFormFilterInput(),
      'rank'                => new sfWidgetFormFilterInput(),
      'experience'          => new sfWidgetFormFilterInput(),
      'display_type'        => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => 0, 1 => 1, 2 => 2))),
      'head_portrait'       => new sfWidgetFormFilterInput(),
      'questions'           => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7))),
      'answer'              => new sfWidgetFormFilterInput(),
      'token'               => new sfWidgetFormFilterInput(),
      'classes_id'          => new sfWidgetFormFilterInput(),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'groups_list'         => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup')),
      'permissions_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission')),
      'classes_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Classes')),
    ));

    $this->setValidators(array(
      'first_name'          => new sfValidatorPass(array('required' => false)),
      'last_name'           => new sfValidatorPass(array('required' => false)),
      'real_name'           => new sfValidatorPass(array('required' => false)),
      'nick_name'           => new sfValidatorPass(array('required' => false)),
      'email_address'       => new sfValidatorPass(array('required' => false)),
      'username'            => new sfValidatorPass(array('required' => false)),
      'algorithm'           => new sfValidatorPass(array('required' => false)),
      'salt'                => new sfValidatorPass(array('required' => false)),
      'password'            => new sfValidatorPass(array('required' => false)),
      'is_active'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_super_admin'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'last_login'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'last_ip'             => new sfValidatorPass(array('required' => false)),
      'customstatus'        => new sfValidatorPass(array('required' => false)),
      'idiograph'           => new sfValidatorPass(array('required' => false)),
      'introduce'           => new sfValidatorPass(array('required' => false)),
      'sex'                 => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => 0, 1 => 1))),
      'birthday'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'phone'               => new sfValidatorPass(array('required' => false)),
      'adress'              => new sfValidatorPass(array('required' => false)),
      'qq'                  => new sfValidatorPass(array('required' => false)),
      'card'                => new sfValidatorPass(array('required' => false)),
      'role_manager_bbs_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rank'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'experience'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'display_type'        => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => 0, 1 => 1, 2 => 2))),
      'head_portrait'       => new sfValidatorPass(array('required' => false)),
      'questions'           => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7))),
      'answer'              => new sfValidatorPass(array('required' => false)),
      'token'               => new sfValidatorPass(array('required' => false)),
      'classes_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'groups_list'         => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup', 'required' => false)),
      'permissions_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'required' => false)),
      'classes_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Classes', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addGroupsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.sfGuardUserGroup sfGuardUserGroup')
      ->andWhereIn('sfGuardUserGroup.group_id', $values)
    ;
  }

  public function addPermissionsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.sfGuardUserPermission sfGuardUserPermission')
      ->andWhereIn('sfGuardUserPermission.permission_id', $values)
    ;
  }

  public function addClassesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ClassesStudent ClassesStudent')
      ->andWhereIn('ClassesStudent.classes_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'sfGuardUser';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'first_name'          => 'Text',
      'last_name'           => 'Text',
      'real_name'           => 'Text',
      'nick_name'           => 'Text',
      'email_address'       => 'Text',
      'username'            => 'Text',
      'algorithm'           => 'Text',
      'salt'                => 'Text',
      'password'            => 'Text',
      'is_active'           => 'Boolean',
      'is_super_admin'      => 'Boolean',
      'last_login'          => 'Date',
      'last_ip'             => 'Text',
      'customstatus'        => 'Text',
      'idiograph'           => 'Text',
      'introduce'           => 'Text',
      'sex'                 => 'Enum',
      'birthday'            => 'Date',
      'phone'               => 'Text',
      'adress'              => 'Text',
      'qq'                  => 'Text',
      'card'                => 'Text',
      'role_manager_bbs_id' => 'Number',
      'rank'                => 'Number',
      'experience'          => 'Number',
      'display_type'        => 'Enum',
      'head_portrait'       => 'Text',
      'questions'           => 'Enum',
      'answer'              => 'Text',
      'token'               => 'Text',
      'classes_id'          => 'Number',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'groups_list'         => 'ManyKey',
      'permissions_list'    => 'ManyKey',
      'classes_list'        => 'ManyKey',
    );
  }
}
