<?php

/**
 * Movie form.
 *
 * @package    form
 * @subpackage movie
 * @version    SVN: $Id: MovieForm.class.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
class MovieForm extends BaseMovieForm
{
  public function configure()
  {
    $this->embedI18n(array('en', 'fr'));
  }
}
