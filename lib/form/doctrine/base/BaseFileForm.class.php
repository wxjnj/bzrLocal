<?php

/**
 * File form base class.
 *
 * @method File getObject() Returns the current form's model object
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
abstract class BaseFileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'token'           => new sfWidgetFormInputText(),
      'title'           => new sfWidgetFormInputText(),
      'sub_description' => new sfWidgetFormTextarea(),
      'keywords'        => new sfWidgetFormInputText(),
      'category_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Category'), 'add_empty' => true)),
      'user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'price'           => new sfWidgetFormChoice(array('choices' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6))),
      'is_security'     => new sfWidgetFormInputCheckbox(),
      'attachment'      => new sfWidgetFormInputText(),
      'attachment_name' => new sfWidgetFormInputText(),
      'attachment_size' => new sfWidgetFormInputText(),
      'read_num'        => new sfWidgetFormInputText(),
      'picture'         => new sfWidgetFormInputText(),
      'is_rank'         => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'token'           => new sfValidatorString(array('max_length' => 255)),
      'title'           => new sfValidatorString(array('max_length' => 255)),
      'sub_description' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'keywords'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'category_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Category'), 'required' => false)),
      'user_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'price'           => new sfValidatorChoice(array('choices' => array(0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5, 5 => 6), 'required' => false)),
      'is_security'     => new sfValidatorBoolean(array('required' => false)),
      'attachment'      => new sfValidatorString(array('max_length' => 255)),
      'attachment_name' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'attachment_size' => new sfValidatorInteger(array('required' => false)),
      'read_num'        => new sfValidatorInteger(array('required' => false)),
      'picture'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_rank'         => new sfValidatorBoolean(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'File', 'column' => array('token')))
    );

    $this->widgetSchema->setNameFormat('file[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'File';
  }

}
