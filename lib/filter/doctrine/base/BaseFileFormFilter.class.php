<?php

/**
 * File filter form base class.
 *
 * @package    bzr
 * @subpackage filter
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php,v 1.1 2012/05/04 06:47:42 zhaoy Exp $
 */
abstract class BaseFileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'token'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sub_description' => new sfWidgetFormFilterInput(),
      'keywords'        => new sfWidgetFormFilterInput(),
      'category_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Category'), 'add_empty' => true)),
      'user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'price'           => new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6))),
      'is_security'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'attachment'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'attachment_name' => new sfWidgetFormFilterInput(),
      'attachment_size' => new sfWidgetFormFilterInput(),
      'read_num'        => new sfWidgetFormFilterInput(),
      'picture'         => new sfWidgetFormFilterInput(),
      'is_rank'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'token'           => new sfValidatorPass(array('required' => false)),
      'title'           => new sfValidatorPass(array('required' => false)),
      'sub_description' => new sfValidatorPass(array('required' => false)),
      'keywords'        => new sfValidatorPass(array('required' => false)),
      'category_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Category'), 'column' => 'id')),
      'user_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'price'           => new sfValidatorChoice(array('required' => false, 'choices' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6))),
      'is_security'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'attachment'      => new sfValidatorPass(array('required' => false)),
      'attachment_name' => new sfValidatorPass(array('required' => false)),
      'attachment_size' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'read_num'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'picture'         => new sfValidatorPass(array('required' => false)),
      'is_rank'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('file_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'File';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'token'           => 'Text',
      'title'           => 'Text',
      'sub_description' => 'Text',
      'keywords'        => 'Text',
      'category_id'     => 'ForeignKey',
      'user_id'         => 'ForeignKey',
      'price'           => 'Enum',
      'is_security'     => 'Boolean',
      'attachment'      => 'Text',
      'attachment_name' => 'Text',
      'attachment_size' => 'Number',
      'read_num'        => 'Number',
      'picture'         => 'Text',
      'is_rank'         => 'Boolean',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
