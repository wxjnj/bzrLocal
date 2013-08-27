<?php

/**
 * Work form base class.
 *
 * @method Work getObject() Returns the current form's model object
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
abstract class BaseWorkForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'token'           => new sfWidgetFormInputText(),
      'title'           => new sfWidgetFormInputText(),
      'picture'         => new sfWidgetFormInputText(),
      'sub_description' => new sfWidgetFormTextarea(),
      'end_time'        => new sfWidgetFormDateTime(),
      'video'           => new sfWidgetFormInputText(),
      'video_name'      => new sfWidgetFormInputText(),
      'video_url'       => new sfWidgetFormTextarea(),
      'weight'          => new sfWidgetFormInputText(),
      'classes_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Classes'), 'add_empty' => true)),
      'user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'token'           => new sfValidatorString(array('max_length' => 255)),
      'title'           => new sfValidatorString(array('max_length' => 255)),
      'picture'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sub_description' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'end_time'        => new sfValidatorDateTime(array('required' => false)),
      'video'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'video_name'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'video_url'       => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'weight'          => new sfValidatorInteger(array('required' => false)),
      'classes_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Classes'), 'required' => false)),
      'user_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Work', 'column' => array('token')))
    );

    $this->widgetSchema->setNameFormat('work[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Work';
  }

}
