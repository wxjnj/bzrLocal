<?php

/**
 * User form.
 *
 * @package    form
 * @subpackage User
 * @version    SVN: $Id: UserForm.class.php,v 1.1 2012/05/04 06:47:27 zhaoy Exp $
 */
class UserForm extends BaseUserForm
{
  public function configure()
  {
    $profileForm = new ProfileForm($this->object->getProfile());
    unset($profileForm['id'], $profileForm['user_id']);

    $this->embedForm('Profile', $profileForm);
  }
}