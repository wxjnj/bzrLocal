<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version1 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('work', 'weight', 'integer', '8', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('work', 'weight');
    }
}