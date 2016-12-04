<?php

use yii\db\Migration;

class m161204_172022_docencia extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->dropColumn('{{%teaching}}', 'postulation');

        $this->createTable('{{%postulant}}', [
            'id' => $this->primaryKey(),
            'person_id' => $this->integer()->notNull(),
            'period_id' => $this->integer()->notNull(),
            'approved' => $this->boolean()
        ], $tableOptions);

        $this->dropForeignKey('fk_documentation_teaching_id','{{%documentation}}');
        $this->dropIndex('idx_documentation_teaching_id', '{{%documentation}}');
        $this->dropColumn('{{%documentation}}', 'teaching_id');
        $this->addColumn('{{%documentation}}', 'postulant_id', $this->integer()->notNull());
        $this->createIndex('idx_documentation_postulant_id', '{{%documentation}}','postulant_id');
        $this->addForeignKey('fk_documentation_postulant_id','{{%documentation}}','postulant_id','{{%postulant}}','id');

        $this->dropForeignKey('fk_tracing_teaching_id','{{%tracing}}');
        $this->dropIndex('idx_tracing_teaching_id', '{{%tracing}}');
        $this->dropColumn('{{%tracing}}', 'teaching_id');
        $this->addColumn('{{%tracing}}', 'person_id', $this->integer()->notNull());
        $this->addColumn('{{%tracing}}', 'period_id', $this->integer()->notNull());
        $this->createIndex('idx_tracing_person_id', '{{%tracing}}','person_id');
        $this->createIndex('idx_tracing_period_id', '{{%tracing}}','period_id');
        $this->addForeignKey('fk_tracing_person_id','{{%tracing}}','person_id','{{%person}}','id');
        $this->addForeignKey('fk_tracing_period_id','{{%tracing}}','period_id','{{%period}}','id');
    }

    public function down()
    {
        echo "m161204_172022_docencia cannot be reverted.\n";

        return false;
    }
}
