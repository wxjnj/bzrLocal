<?php

/**
 * Share form base class.
 *
 * @method Share getObject() Returns the current form's model object
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
abstract class BaseShareForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'token'           => new sfWidgetFormInputText(),
      'title'           => new sfWidgetFormInputText(),
      'picture'         => new sfWidgetFormInputText(),
      'sub_description' => new sfWidgetFormTextarea(),
      'content'         => new sfWidgetFormTextarea(),
      'weight'          => new sfWidgetFormInputText(),
      'user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'is_rank'         => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'token'           => new sfValidatorString(array('max_length' => 255)),
      'title'           => new sfValidatorString(array('max_length' => 255)),
      'picture'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sub_description' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'content'         => new sfValidatorString(array('required' => false)),
      'weight'          => new sfValidatorInteger(array('required' => false)),
      'user_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'is_rank'         => new sfValidatorBoolean(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Share', 'column' => array('token')))
    );

    $this->widgetSchema->setNameFormat('share[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Share';
  }

}
