<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version30 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('classes', 'user_id', 'integer', '8', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('classes', 'user_id');
    }
}