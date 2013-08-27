<?php

/**
 * Apply form base class.
 *
 * @method Apply getObject() Returns the current form's model object
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
abstract class BaseApplyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'company'    => new sfWidgetFormInputText(),
      'contacter'  => new sfWidgetFormInputText(),
      'address'    => new sfWidgetFormInputText(),
      'tel'        => new sfWidgetFormInputText(),
      'content'    => new sfWidgetFormTextarea(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'company'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'contacter'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tel'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'content'    => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('apply[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Apply';
  }

}
