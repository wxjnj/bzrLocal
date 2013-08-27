<?php

/**
 * Ans form base class.
 *
 * @method Ans getObject() Returns the current form's model object
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
abstract class BaseAnsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'token'           => new sfWidgetFormInputText(),
      'content'         => new sfWidgetFormTextarea(),
      'attachment'      => new sfWidgetFormInputText(),
      'attachment_name' => new sfWidgetFormInputText(),
      'attachment_size' => new sfWidgetFormInputText(),
      'need_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Need'), 'add_empty' => true)),
      'user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'is_true'         => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'token'           => new sfValidatorString(array('max_length' => 255)),
      'content'         => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'attachment'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'attachment_name' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'attachment_size' => new sfValidatorInteger(array('required' => false)),
      'need_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Need'), 'required' => false)),
      'user_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'is_true'         => new sfValidatorBoolean(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Ans', 'column' => array('token')))
    );

    $this->widgetSchema->setNameFormat('ans[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ans';
  }

}
