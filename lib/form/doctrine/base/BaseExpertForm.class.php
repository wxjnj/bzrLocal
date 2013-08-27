<?php

/**
 * Expert form base class.
 *
 * @method Expert getObject() Returns the current form's model object
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
abstract class BaseExpertForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'token'           => new sfWidgetFormInputText(),
      'name'            => new sfWidgetFormInputText(),
      'job'             => new sfWidgetFormInputText(),
      'sub_description' => new sfWidgetFormTextarea(),
      'direction'       => new sfWidgetFormTextarea(),
      'description'     => new sfWidgetFormTextarea(),
      'picture'         => new sfWidgetFormInputText(),
      'weight'          => new sfWidgetFormInputText(),
      'type'            => new sfWidgetFormChoice(array('choices' => array(1 => 1, 2 => 2))),
      'user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'token'           => new sfValidatorString(array('max_length' => 255)),
      'name'            => new sfValidatorString(array('max_length' => 50)),
      'job'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sub_description' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'direction'       => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'description'     => new sfValidatorString(array('required' => false)),
      'picture'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'weight'          => new sfValidatorInteger(array('required' => false)),
      'type'            => new sfValidatorChoice(array('choices' => array(0 => 1, 1 => 2), 'required' => false)),
      'user_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Expert', 'column' => array('token')))
    );

    $this->widgetSchema->setNameFormat('expert[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Expert';
  }

}
