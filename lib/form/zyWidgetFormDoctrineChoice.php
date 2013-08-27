<?php
class zyWidgetFormDoctrineChoice extends sfWidgetFormDoctrineChoice {
	
	/*
	 * (non-PHPdoc) @see sfWidgetFormChoice::getRenderer()
	 */
	public function getRenderer() {
		if ($this->getOption ( 'renderer' )) {
			return $this->getOption ( 'renderer' );
		}
		
		if (! $class = $this->getOption ( 'renderer_class' )) {
			$type = ! $this->getOption ( 'expanded' ) ? '' : ($this->getOption ( 'multiple' ) ? 'checkbox' : 'radio');
			$class = sprintf ( 'sfWidgetFormSelect%s', ucfirst ( $type ) );
		}
		$options = $this->options ['renderer_options'];
		$options ['choices'] = new sfCallable ( array (
				$this,
				'getChoices' 
		) );
		if($class == 'sfWidgetFormSelectRadio')
			$renderer = new zyWidgetFormSelectRadio ( $options, $this->getAttributes () );
		else
			$renderer = new $class ( $options, $this->getAttributes () );
		
		// choices returned by the callback will already be translated (so we
		// need to avoid double-translation)
		if ($renderer->hasOption ( 'translate_choices' )) {
			$renderer->setOption ( 'translate_choices', false );
		}
		
		$renderer->setParent ( $this->getParent () );
		
		return $renderer;
	}

}