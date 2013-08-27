<?php

/**
 * SuccessCase form base class.
 *
 * @method SuccessCase getObject() Returns the current form's model object
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
abstract class BaseSuccessCaseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'token'      => new sfWidgetFormInputText(),
      'title'      => new sfWidgetFormInputText(),
      'url'        => new sfWidgetFormTextarea(),
      'content'    => new sfWidgetFormTextarea(),
      'weight'     => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'token'      => new sfValidatorString(array('max_length' => 255)),
      'title'      => new sfValidatorString(array('max_length' => 255)),
      'url'        => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'content'    => new sfValidatorString(array('required' => false)),
      'weight'     => new sfValidatorInteger(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'SuccessCase', 'column' => array('token')))
    );

    $this->widgetSchema->setNameFormat('success_case[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SuccessCase';
  }

}
