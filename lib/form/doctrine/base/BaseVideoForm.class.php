<?php

/**
 * Video form base class.
 *
 * @method Video getObject() Returns the current form's model object
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
abstract class BaseVideoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'token'           => new sfWidgetFormInputText(),
      'title'           => new sfWidgetFormInputText(),
      'experter'        => new sfWidgetFormInputText(),
      'sub_description' => new sfWidgetFormTextarea(),
      'attachment'      => new sfWidgetFormInputText(),
      'attachment_name' => new sfWidgetFormInputText(),
      'url'             => new sfWidgetFormInputText(),
      'url_name'        => new sfWidgetFormInputText(),
      'thumbnailsPath'  => new sfWidgetFormInputText(),
      'weight'          => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'token'           => new sfValidatorString(array('max_length' => 255)),
      'title'           => new sfValidatorString(array('max_length' => 255)),
      'experter'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'sub_description' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'attachment'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'attachment_name' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url'             => new sfValidatorString(array('max_length' => 255)),
      'url_name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'thumbnailsPath'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'weight'          => new sfValidatorInteger(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Video', 'column' => array('token')))
    );

    $this->widgetSchema->setNameFormat('video[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Video';
  }

}
