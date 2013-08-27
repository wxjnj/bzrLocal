<?php

/*
 * This file is part of the symfony package. (c) 2004-2006 Fabien Potencier
 * <fabien.potencier@symfony-project.com> (c) 2004-2006 Sean Kerr
 * <sean@code-box.org> For the full copyright and license information, please
 * view the LICENSE file that was distributed with this source code.
 */

/**
 *
 * @package symfony
 * @subpackage filter
 * @author Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author Sean Kerr <sean@code-box.org>
 * @version SVN: $Id: zyExecutionFilter.class.php,v 1.3 2012/06/05 03:42:55
 *          zhaoy Exp $
 */
class backendExecutionFilter extends sfExecutionFilter {
	public function execute($filterChain) {
		parent::execute ( $filterChain );
		$this->getContext()->getUser()->setAttribute('linkActiveState', 'abc');
	}

}
