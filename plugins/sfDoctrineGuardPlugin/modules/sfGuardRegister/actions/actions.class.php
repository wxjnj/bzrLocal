<?php

require_once dirname(__FILE__).'/../lib/BasesfGuardRegisterActions.class.php';

/**
 * sfGuardRegister actions.
 *
 * @package    guard
 * @subpackage sfGuardRegister
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.15 2013/01/23 07:08:34 gef Exp $
 */
class sfGuardRegisterActions extends BasesfGuardRegisterActions
{
	public function executeIndex(sfWebRequest $request)
	{
		if ($this->getUser()->isAuthenticated())
		{
			$this->getUser()->setFlash('notice', '您已经注册并已经登录了!');
			$this->redirect('@homepage');
		}
	
		$this->form = new sfGuardRegisterForm();
	
		if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter($this->form->getName()));
			if ($this->form->isValid())
			{
				$user = $this->form->save();
				
				//判断是否开启用户审核功能，如果开启，用户注册完将角色设置为等待验证会员并跳转到提示页面，如果没有则登录后跳转到首页
			  	$config = Doctrine::getTable('Config')->find(1);
			  	if($config->getUserAudit() != 0)
			  	{
			  		$token = md5(rand(1,9999999).time());
			  		if($config->getUserAudit() != 0)
			  		{
			  			//发邮件验证 地址加上token
			  			$message = Swift_Message::newInstance()
			  			->setFrom(sfConfig::get('app_sf_guard_plugin_default_from_email', 'from@noreply.com'))
			  			->setTo($user->getEmailAddress())
			  			->setSubject('这是一份江苏女性E天地论坛帐号激活邮件')
			  			->setBody($this->getPartial('sfGuardRegister/email', array('user' => $user, 'token' => $token)))
			  			->setContentType('text/html')
			  			;
			  			
			  			$this->getMailer()->send($message);
			  		}
			  		$user->role_manager_bbs_id = 5;
			  		$user->token = $token;
			  		$user->rank = $user->getRank() + $config->getRegister();
			  		$user->save();
			  		$this->getUser()->signIn($user);
			  		$this->redirect('@error?type=wait_yzhy');
			  	}
			  	else 
			  	{
			  		//增加用户积分
			  		$user->rank = $user->rank+$config->getRegister();
			  		$user->save();
			  		//加入前台用户组
			  		$ugroup = new sfGuardUserGroup();
			  		$ugroup->user_id = $user->getId();
			  		$ugroup->group_id = 2;
			  		$ugroup->save();
			  		
			  		$this->getUser()->signIn($user);
			  		if($this->getUser ()->hasAttribute ( 'refererUrlBackend' )){
			  			$url = $this->getUser ()->getAttribute ( 'refererUrlBackend');
			  			$this->getUser ()->getAttributeHolder()->remove('refererUrlBackend');
			  			$this->redirect($url);
			  		}else{
			  			$this->redirect('@homepage');
			  		}
			  	}
			}
		}
	}
	public function executeEmailCheck(sfWebRequest $request)
	{
		$token = $request->getParameter('token');
		$user = Doctrine::getTable('sfGuardUser')->findOneByToken($token);
		if($user->getRoleManagerBbsId()!=5)
		{
			$this->forward404();
		}
		else
		{
			$user->setRoleManagerBbsId(6);
			$user->save();
		}
	}
	//检查用户名
	public function executeCheckUsername(sfWebRequest $request)
	{
		$username = $request->getParameter('username');
		if($username == '')
		{
			echo '用户名不能为空';exit;
		}
		else
		{
			if(!preg_match('/^[_a-zA-Z0-9\x{4e00}-\x{9fa5}]{3,10}$/u', $username))
			{
				echo '无效的用户名（只能用 中文、英文、数字、下划线、3-10个字符）';exit;
			}
			else 
			{
				$user = Doctrine::getTable('sfGuardUser')->findOneByUsername($username);
				if($user)
				{
					echo '您输入的用户名已存在！';exit;
				}
				else
				{
					$keywords = Doctrine::getTable('Config')->find(1);
					$wordsarr = explode(",", $keywords->getKeywordsFilter());
					if($keywords->getKeywordsFilter())
					{
						foreach($wordsarr as $value)
						{
							$c = strpos($username,$value);
						
							if($c === false)
							{
									
							}
							else
							{
								echo '用户名包含敏感字符'.$value.',请重新输入！';exit;
							}
						}
						echo '此用户名可以使用！';exit;
					}
					else 
					{
						echo '此用户名可以使用！';exit;
					}
				}
			}
		}
	}
	//检查邮箱
	public function executeCheckEmail(sfWebRequest $request)
	{
		$email = $request->getParameter('email');
		if($email == '')
		{
			echo '邮箱不能为空';exit;
		}
		else
		{
			if(!preg_match('/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/', $email))
			{
				echo '无效的邮箱';exit;
			}
			else
			{
				$email = Doctrine::getTable('sfGuardUser')->findOneByEmailAddress($email);
				if($email)
				{
					echo '您输入的邮箱已存在！';exit;
				}
				else
				{
					echo '此邮箱可以使用！';exit;
				}
			}
		}
	}
	//检查密码
	public function executeCheckPassword(sfWebRequest $request)
	{
		$password = $request->getParameter('password');
		if($password == '')
		{
			echo '密码不能为空';exit;
		}
		else
		{
			if(!preg_match('/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,22}$/', $password))
			{
				echo '无效的密码，密码格式必须为数字、字母或特殊符号组成的6-22个字符';exit;
			}
			else
			{
				echo '密码可以使用！';exit;
			}
		}
	}
	//检查确认密码
	public function executeCheckPasswordAgain(sfWebRequest $request)
	{
		$password = $request->getParameter('password');
		$password_again = $request->getParameter('password_again');
		if($password_again != $password)
		{
			echo '两次密码必须输入相同';exit;
		}
		else
		{
			echo '输入正确！';exit;
		}
	}
	//检查手机
	public function executeCheckPhone(sfWebRequest $request)
	{
		$phone = $request->getParameter('phone');
		if($phone == '')
		{
			echo '手机不能为空';exit;
		}
		else
		{
			if(!preg_match('/^((\+86)?|\(\+86\))0?1[358]\d{9}$/', $phone))
			{
				echo '无效的手机';exit;
			}
			else
			{
				$phone = Doctrine::getTable('sfGuardUser')->findOneByPhone($phone);
				if($phone)
				{
					echo '您输入的手机已存在！';exit;
				}
				else
				{
					echo '此手机可以使用！';exit;
				}
			}
		}
	}
	//核对验证码
	public function executeCheckCaptcha(sfWebRequest $request)
	{
		$captcha = $request->getParameter('captcha');
		if($captcha == '')
		{
			echo '请输入正确的验证码';exit;
		}
		else
		{
			$clean = trim($captcha);
			if (!$this->check($clean))
		    {
		      echo '验证码输入错误';exit;
		    }
		    else
		    {
		      echo '输入正确';exit;
		    }
		}
	}
	protected function check($posted_captcha)
	{
		if(!$this->config['case_sensitive'])
		{
			$posted_captcha = strtoupper($posted_captcha);
		}
		
		//hash the input
		if(empty($this->config['hash_algo']))
		{
			$input_hash = hash('sha1',$posted_captcha);
		}
		else
		{
			$input_hash = hash($this->config['hash_algo'],$posted_captcha);
		}
		
		$saved_captcha = $this->getUser()->getAttribute('captcha_code', null, 'captcha');
		
		if($input_hash == $saved_captcha)
		{
			return true;
		}
		else
		{
			//no good! return bad!
			return false;
		}
		
// 		$captcha = new sfCryptoCaptcha(false);
// 		//The "false" option here is very important (or the captcha will display the flood error [Error - you're refreshing too fast])
//  		return $captcha->testCaptcha($posted_captcha);
	}
	//检查整个表单
	public function executeCheckForm(sfWebRequest $request)
	{
		$phone = $request->getParameter('phone');
		if($phone == '')
		{
			echo '手机不能为空';exit;
		}
		else
		{
			if(!preg_match('/^((\+86)?|\(\+86\))0?1[358]\d{9}$/', $phone))
			{
				echo '无效的手机';exit;
			}
			else
			{
				$phone = Doctrine::getTable('sfGuardUser')->findOneByPhone($phone);
				if($phone)
				{
					echo '您输入的手机已存在！';exit;
				}
				else
				{
					echo '此手机可以使用！';exit;
				}
			}
		}
	}
}