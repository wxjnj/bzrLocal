<?php

/**
 * BasesfGuardRequestForgotPasswordForm for requesting a forgot password email
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: sfGuardRequestForgotPasswordForm.class.php,v 1.2 2012/07/05 01:39:41 gef Exp $
 */
class sfGuardRequestForgotPasswordForm extends BasesfGuardRequestForgotPasswordForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
  	$this->widgetSchema->setLabels ( array (
  			'email_address' => '邮件地址',
  	));
  }
}