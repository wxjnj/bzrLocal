<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version16 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('job', 'user_id', 'integer', '8', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('job', 'user_id');
    }
}