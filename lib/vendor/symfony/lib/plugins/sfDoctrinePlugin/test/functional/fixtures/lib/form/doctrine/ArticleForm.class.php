<?php

/**
 * Article form.
 *
 * @package    form
 * @subpackage Article
 * @version    SVN: $Id: ArticleForm.class.php,v 1.1 2012/05/04 06:47:27 zhaoy Exp $
 */
class ArticleForm extends BaseArticleForm
{
  public function configure()
  {
    $this->embedI18n(array('en', 'fr'));
  }
}