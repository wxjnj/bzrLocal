<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version11 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('share', 'share_user_id_sf_guard_user_id', array(
             'name' => 'share_user_id_sf_guard_user_id',
             'local' => 'user_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             ));
        $this->addIndex('share', 'share_user_id', array(
             'fields' => 
             array(
              0 => 'user_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('share', 'share_user_id_sf_guard_user_id');
        $this->removeIndex('share', 'share_user_id', array(
             'fields' => 
             array(
              0 => 'user_id',
             ),
             ));
    }
}