<?php

/**
 * Images filter form base class.
 *
 * @package    bzr
 * @subpackage filter
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php,v 1.1 2012/05/04 06:47:42 zhaoy Exp $
 */
abstract class BaseImagesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'picture' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'     => new sfWidgetFormFilterInput(),
      'content' => new sfWidgetFormFilterInput(),
      'weight'  => new sfWidgetFormFilterInput(),
      'type'    => new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 1, 2 => 2))),
    ));

    $this->setValidators(array(
      'title'   => new sfValidatorPass(array('required' => false)),
      'picture' => new sfValidatorPass(array('required' => false)),
      'url'     => new sfValidatorPass(array('required' => false)),
      'content' => new sfValidatorPass(array('required' => false)),
      'weight'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type'    => new sfValidatorChoice(array('required' => false, 'choices' => array(1 => 1, 2 => 2))),
    ));

    $this->widgetSchema->setNameFormat('images_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Images';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'title'   => 'Text',
      'picture' => 'Text',
      'url'     => 'Text',
      'content' => 'Text',
      'weight'  => 'Number',
      'type'    => 'Enum',
    );
  }
}
