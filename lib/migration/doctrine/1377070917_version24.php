<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version24 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->dropForeignKey('work', 'work_user_id_sf_guard_user_id');
        $this->createForeignKey('expert', 'expert_user_id_sf_guard_user_id', array(
             'name' => 'expert_user_id_sf_guard_user_id',
             'local' => 'user_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             ));
        $this->createForeignKey('work', 'work_classes_id_classes_id', array(
             'name' => 'work_classes_id_classes_id',
             'local' => 'classes_id',
             'foreign' => 'id',
             'foreignTable' => 'classes',
             ));
        $this->addIndex('expert', 'expert_user_id', array(
             'fields' => 
             array(
              0 => 'user_id',
             ),
             ));
        $this->addIndex('work', 'work_classes_id', array(
             'fields' => 
             array(
              0 => 'classes_id',
             ),
             ));
    }

    public function down()
    {
        $this->createForeignKey('work', 'work_user_id_sf_guard_user_id', array(
             'name' => 'work_user_id_sf_guard_user_id',
             'local' => 'user_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             ));
        $this->dropForeignKey('expert', 'expert_user_id_sf_guard_user_id');
        $this->dropForeignKey('work', 'work_classes_id_classes_id');
        $this->removeIndex('expert', 'expert_user_id', array(
             'fields' => 
             array(
              0 => 'user_id',
             ),
             ));
        $this->removeIndex('work', 'work_classes_id', array(
             'fields' => 
             array(
              0 => 'classes_id',
             ),
             ));
    }
}