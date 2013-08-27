<?php

/**
 * Category form.
 *
 * @package    nxetd
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: CategoryForm.class.php,v 1.7 2012/10/09 09:25:52 zhaoy Exp $
 */
class CategoryForm extends BaseCategoryForm {

	
	public function configure() {
		
		$this->useFields ( array (
				'name',
		) );
		
		//gefei 添加数据验证
		$this->validatorSchema['name'] = new sfValidatorString(
				array('required' => true),
				array('required' => '请填写分类名称'
		));
		
		$this->widgetSchema->setLabels ( array (
				'name' => '分类名称'
		));		
	}
	
	
// 	protected function doSave($con = null) {
		
// 		$isNew = $this->getObject ()->isNew ();
		
// 		//$this->savePermissionList($con);
// 		parent::doSave ( $con );
		
// 		$parent_id = $this->getObject ()->getParentId ();
		
// 		if (is_integer ( $parent_id )) {
// 			$node = $this->getObject ()->getNode ();
// 			$parent = $this->getObject ()->getTable ()->find ( $parent_id );
// 			$method = ($node->isValidNode () ? 'move' : 'insert') . 'AsLastChildOf';
// 			$node->$method ( $parent );
// 		} else if ($isNew) {
// 			$this->getObject ()->getTable ()->getTree ()->createRoot ( $this->getObject () );
// 		}
	
// 	}
	
// 	public function updateDefaultsFromObject()
// 	{
// 		parent::updateDefaultsFromObject();
	
// 		if (isset($this->widgetSchema['permission_list']))
// 		{
// 			$this->setDefault('permission_list', $this->object->Permissions->getPrimaryKeys());
// 		}
	
// 	}
// 	public function savePermissionList($con = null)
// 	{
// 		if (!$this->isValid())
// 		{
// 			throw $this->getErrorSchema();
// 		}
	
// 		if (!isset($this->widgetSchema['permission_list']))
// 		{
// 			// somebody has unset this widget
// 			return;
// 		}
	
// 		if (null === $con)
// 		{
// 			$con = $this->getConnection();
// 		}
	
// 		$existing = $this->object->Permissions->getPrimaryKeys();
// 		$values = $this->getValue('permission_list');
// 		if (!is_array($values))
// 		{
// 			$values = array();
// 		}
	
// 		$unlink = array_diff($existing, $values);
// 		if (count($unlink))
// 		{
// 			$this->object->unlink('Permissions', array_values($unlink));
// 		}
	
// 		$link = array_diff($values, $existing);
// 		if (count($link))
// 		{
// 			$this->object->link('Permissions', array_values($link));
// 		}
		
// 	}
}
