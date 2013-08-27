<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @package    symfony
 * @subpackage i18n
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfI18nExtractorInterface.class.php,v 1.1 2012/05/04 06:47:28 zhaoy Exp $
 */
interface sfI18nExtractorInterface
{
  /**
   * Extract i18n strings for the given content.
   *
   * @param  string $content The content
   *
   * @return array An array of i18n strings
   */
  public function extract($content);
}