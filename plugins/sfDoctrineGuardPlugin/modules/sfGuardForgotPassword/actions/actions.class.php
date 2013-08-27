<?php

require_once dirname(__FILE__).'/../lib/BasesfGuardForgotPasswordActions.class.php';

/**
 * sfGuardForgotPassword actions.
 * 
 * @package    sfGuardForgotPasswordPlugin
 * @subpackage sfGuardForgotPassword
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.4 2012/07/19 09:29:52 gef Exp $
 */
class sfGuardForgotPasswordActions extends BasesfGuardForgotPasswordActions
{
	public function preExecute()
	{
		if ($this->getUser()->isAuthenticated())
		{
			$this->redirect('@homepage');
		}
	}
	
	public function executeIndex($request)
	{
		$this->form = new sfGuardRequestForgotPasswordForm();
	
		if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter($this->form->getName()));
			if ($this->form->isValid())
			{
				$this->user = $this->form->user;
				$this->_deleteOldUserForgotPasswordRecords();
	
				$forgotPassword = new sfGuardForgotPassword();
				$forgotPassword->user_id = $this->form->user->id;
				$forgotPassword->unique_key = md5(rand() + time());
				$forgotPassword->expires_at = new Doctrine_Expression('NOW()');
				$forgotPassword->save();
	
				$message = Swift_Message::newInstance()
				->setFrom(sfConfig::get('app_sf_guard_plugin_default_from_email', 'from@noreply.com'))
				->setTo($this->form->user->email_address)
				->setSubject('忘记密码了吗，'.$this->form->user->username)
				->setBody($this->getPartial('sfGuardForgotPassword/send_request', array('user' => $this->form->user, 'forgot_password' => $forgotPassword)))
				->setContentType('text/html')
				;
	
				$this->getMailer()->send($message);
	
				$this->getUser()->setFlash('notice', '检查您的邮箱，您会收到系统发送的一封关于密码的邮件!');
				$this->redirect('@sf_guard_signin');
			} else {
				$this->getUser()->setFlash('error', '无效的邮件地址!');
				$this->redirect($request->getReferer());
			}
		}
	}
	
	public function executeChange($request)
	{
		$this->forgotPassword = $this->getRoute()->getObject();
		$this->user = $this->forgotPassword->User;
		$this->form = new sfGuardChangeUserPasswordForm($this->user);
	
		if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter($this->form->getName()));
			if ($this->form->isValid())
			{
				$this->form->save();
	
				$this->_deleteOldUserForgotPasswordRecords();
	
				$message = Swift_Message::newInstance()
				->setFrom(sfConfig::get('app_sf_guard_plugin_default_from_email', 'from@noreply.com'))
				->setTo($this->user->email_address)
				->setSubject('用户'.$this->user->username.'新的密码！')
				->setBody($this->getPartial('sfGuardForgotPassword/new_password', array('user' => $this->user, 'password' => $request['sf_guard_user']['password'])))
				;
	
				$this->getMailer()->send($message);
	
				$this->getUser()->setFlash('notice', '密码修改成功了，您可以用新的密码进行登录!');
				$this->redirect('@sf_guard_signin');
			}
		}
	}
	
	private function _deleteOldUserForgotPasswordRecords()
	{
		Doctrine_Core::getTable('sfGuardForgotPassword')
		->createQuery('p')
		->delete()
		->where('p.user_id = ?', $this->user->id)
		->execute();
	}
}
