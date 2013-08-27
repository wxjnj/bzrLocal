<?php

/**
 * user actions.
 *
 * @package    nxetd
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.9 2012/10/22 03:46:30 zhaoy Exp $
 */
class userActions extends sfActions
{
  public function executePasswordModify(sfWebRequest $request){
  	
  	if($request->isMethod('post')){
  		$oldPassword = $request->getParameter('oldPassword');
  		$password = $request->getParameter('newPassword');
  		$user = $this->getUser()->getGuardUser();
  		if($user->checkPassword($oldPassword)){
  			$user->setPassword($password);
  			$user->save();
  			$this->getUser()->setFlash('notice', '修改成功！');
  		}else{
  			$this->getUser()->setFlash('notice', '原始密码错误！');
  		}
  	}
  }
	
  public function executeAjaxGetRoles(sfWebRequest $request){
  	
  	$code = $request->getParameter('code');
  	$role_list = Doctrine::getTable('Role')->getRoleList($code);
  	
  	if(!$role_list)
  		return;
  	
  	$html = '';
  	foreach($role_list as $role){
  		$html.='<li><input name="sf_guard_user[roles_list][]" type="checkbox" value="'.$role->getId()
  			 .'" id="sf_guard_user_roles_list_'.$role->getId().'" />'
			 .'&nbsp;<label for="sf_guard_user_roles_list_'.$role->getId().'">'.$role->getName().'</label></li>';
  	}
  	echo $html;
  	exit;
  	
  }
  public function executeActive(sfWebRequest $request)
  {
  	$user = Doctrine::getTable('sfGuardUser')->find($request->getParameter('id'));
  	$this->forward404Unless($user);
  	
  	$active = !$user->getIsActive();
  	$user->setIsActive($active);
  	$user->save();
  	
  	$this->getUser()->setFlash('notice', $user->getActiveState().'成功。');
  	$this->redirect($request->getReferer());
  }
  public function executeIndex(sfWebRequest $request)
  {
    $search_params = array();
    $page = 1;
    $this->searchRoute = '';
    if($request->hasParameter('type'))
    {
    	$this->type = $request->getParameter('type');
    	//$this->searchRoute = 'type='.$request->getParameter('type');
    }
    else{
    	$this->forward404();
    }
    if($request->hasParameter('search_username'))
    {
    	$search_params['username'] = $request->getParameter('search_username');
    	$this->searchRoute .= 'search_username='.$search_params['username'];
    }
    if($request->hasParameter('page'))
    {
    	$page = $request->getParameter('page');
    }
    if($this->type == 'student'){
    	$this->pager = Doctrine::getTable('sfGuardUser')->getStudentListPager($search_params,$page);
    }
    else{
    	$this->pager = Doctrine::getTable('sfGuardUser')->getTeacherListPager($search_params,$page);
    }
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new sfGuardUserForm();

  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new sfGuardUserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserForm($sf_guard_user);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserForm($sf_guard_user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {

    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $sf_guard_user->delete();

    $this->getUser()->setFlash('notice', '删除成功。');
    $this->redirect('@user?type=backend');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sf_guard_user = $form->save();
      if($form->isNew()){
      	$sf_guard_user->experience = 100;
      	$sf_guard_user->save();
      	$this->getUser()->setFlash('notice', '添加成功。');
      }else{
      	$this->getUser()->setFlash('notice', '编辑成功。');
      }
      
      
      if($request->hasParameter('save_and_add')){
      	$this->getUser()->setFlash('notice', '添加成功，并继续添加。');
      	$this->redirect('user/new');
      }
      else{
      	$this->redirect('user/edit?id='.$sf_guard_user->getId());
      }
    }
  }
}
