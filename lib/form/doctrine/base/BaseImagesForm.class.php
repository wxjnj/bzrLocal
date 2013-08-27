<?php

/**
 * Images form base class.
 *
 * @method Images getObject() Returns the current form's model object
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
abstract class BaseImagesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'title'   => new sfWidgetFormInputText(),
      'picture' => new sfWidgetFormInputText(),
      'url'     => new sfWidgetFormTextarea(),
      'content' => new sfWidgetFormTextarea(),
      'weight'  => new sfWidgetFormInputText(),
      'type'    => new sfWidgetFormChoice(array('choices' => array(1 => 1, 2 => 2))),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'   => new sfValidatorString(array('max_length' => 255)),
      'picture' => new sfValidatorString(array('max_length' => 255)),
      'url'     => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'content' => new sfValidatorString(array('required' => false)),
      'weight'  => new sfValidatorInteger(array('required' => false)),
      'type'    => new sfValidatorChoice(array('choices' => array(0 => 1, 1 => 2), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('images[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Images';
  }

}
