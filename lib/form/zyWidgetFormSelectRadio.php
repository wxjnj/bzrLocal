<?php

class zyWidgetFormSelectRadio extends sfWidgetFormSelectRadio
{

  public function formatter($widget, $inputs)
  {
    $rows = array();
    foreach ($inputs as $input)
    {
      $sub = isset($input['sub'])?$input['sub']:'';
      $rows[] = $this->renderContentTag('li', $input['input'].$this->getOption('label_separator').$input['label'].$sub);
    }

    return !$rows ? '' : $this->renderContentTag('ul', implode($this->getOption('separator'), $rows), array('class' => $this->getOption('class')));
  }
  
  protected function formatChoices($name, $value, $choices, $attributes)
  {
  	$inputs = array();
  	foreach ($choices as $key => $option)
  	{
  		
  		$baseAttributes = array(
  				'name'  => substr($name, 0, -2),
  				'type'  => 'radio',
  				'value' => self::escapeOnce($key),
  				'id'    => $id = $this->generateId($name, self::escapeOnce($key)),
  		);
  		unset($baseAttributes['checked']);
  		if (strval($key) == strval($value === false ? 0 : $value))
  		{
  			$baseAttributes['checked'] = 'checked';
  		}
  
  		$inputs[$id] = array(
  				'input' => $this->renderTag('input', array_merge($baseAttributes, $attributes)),
  				'label' => $this->renderContentTag('label', self::escapeOnce($option), array('for' => $id)),
  		);
  		
  		$object = Doctrine::getTable('Category')->findOneById($key);
  		if($object!=null && $object->getNode()->hasChildren())
  		{
  			unset($baseAttributes['checked']);
  			$inputs[$id]['sub'] = '<ul>';
  			foreach($object->getNode()->getChildren() as $children)
  			{
  				$child_attributes = array(
  						'name'  => substr($name, 0, -2),
		  				'type'  => 'radio',
		  				'value' => $children->getId(),
		  				'id'    => $children_id = $this->generateId($name, $children->getId()),
  				);
  				
  				if (strval($children->getId()) == strval($value === false ? 0 : $value))
  				{
  					$baseAttributes['checked'] = 'checked';
  				}
  				
  				$inputs[$id]['sub'] .= '<li>';
  				$inputs[$id]['sub'] .= $this->renderTag('input', array_merge($baseAttributes, $child_attributes));
  				$inputs[$id]['sub'] .= $this->renderContentTag('label', $children->getName());
  				if($children->getNode()->hasChildren())
  				{
  					unset($baseAttributes['checked']);
  					$inputs[$id]['sub'] .= '<ul>';
  					foreach($children->getNode()->getChildren() as $child2)
  					{
  						$child_attributes2 = array(
  								'name'  => substr($name, 0, -2),
  								'type'  => 'radio',
  								'value' => $child2->getId(),
  								'id'    => $children_id = $this->generateId($name, $child2->getId()),
  						);
  						$inputs[$id]['sub'] .= '<li>';
  						//$inputs[$id]['sub'] .= $this->renderTag('input', array_merge($baseAttributes, $child_attributes2));
  						$inputs[$id]['sub'] .= $this->renderContentTag('label', $child2->getName());
  						$inputs[$id]['sub'] .= '</li>';
  					}
  					$inputs[$id]['sub'] .= '</ul>';
  				  }
  				$inputs[$id]['sub'] .= '</li>';
  			}
  			$inputs[$id]['sub'] .= '</ul>';
  		}
  		
  	}
  	return call_user_func($this->getOption('formatter'), $this, $inputs);
  }
}
