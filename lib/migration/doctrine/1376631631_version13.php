<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version13 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('work', 'video_url', 'string', '500', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('work', 'video_url');
    }
}