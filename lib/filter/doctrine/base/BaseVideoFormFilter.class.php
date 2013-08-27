<?php

/**
 * Video filter form base class.
 *
 * @package    bzr
 * @subpackage filter
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php,v 1.1 2012/05/04 06:47:42 zhaoy Exp $
 */
abstract class BaseVideoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'token'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'experter'        => new sfWidgetFormFilterInput(),
      'sub_description' => new sfWidgetFormFilterInput(),
      'attachment'      => new sfWidgetFormFilterInput(),
      'attachment_name' => new sfWidgetFormFilterInput(),
      'url'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url_name'        => new sfWidgetFormFilterInput(),
      'thumbnailsPath'  => new sfWidgetFormFilterInput(),
      'weight'          => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'token'           => new sfValidatorPass(array('required' => false)),
      'title'           => new sfValidatorPass(array('required' => false)),
      'experter'        => new sfValidatorPass(array('required' => false)),
      'sub_description' => new sfValidatorPass(array('required' => false)),
      'attachment'      => new sfValidatorPass(array('required' => false)),
      'attachment_name' => new sfValidatorPass(array('required' => false)),
      'url'             => new sfValidatorPass(array('required' => false)),
      'url_name'        => new sfValidatorPass(array('required' => false)),
      'thumbnailsPath'  => new sfValidatorPass(array('required' => false)),
      'weight'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('video_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Video';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'token'           => 'Text',
      'title'           => 'Text',
      'experter'        => 'Text',
      'sub_description' => 'Text',
      'attachment'      => 'Text',
      'attachment_name' => 'Text',
      'url'             => 'Text',
      'url_name'        => 'Text',
      'thumbnailsPath'  => 'Text',
      'weight'          => 'Number',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
