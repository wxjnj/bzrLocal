[?php

/**
 * <?php echo $this->table->getOption('name') ?> filter form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php,v 1.1 2012/05/04 06:47:42 zhaoy Exp $
 */
class <?php echo $this->table->getOption('name') ?>FormFilter extends Base<?php echo $this->table->getOption('name') ?>FormFilter
{
<?php if ($parent = $this->getParentModel()): ?>
  /**
   * @see <?php echo $parent ?>FormFilter
   */
  public function configure()
  {
    parent::configure();
  }
<?php else: ?>
  public function configure()
  {
  }
<?php endif; ?>
}