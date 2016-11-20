<?php

use yii\db\Migration;

class m161120_161258_init extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%person}}', [
            'id' => $this->primaryKey(),
            'identity' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'gender' => $this->smallInteger()->notNull(),
            'birthdate' => $this->date()->notNull(),
            'phone' => $this->string(),
            'address' => $this->string(),
            'picture' => $this->string()
        ], $tableOptions);

        $this->createTable('{{%requirement}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'type' => $this->smallInteger()->notNull()
        ]);

        $this->createTable('{{%school}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string(),
            'address' => $this->string(),
        ]);

        $this->createTable('{{%subject}}', [
            'id' => $this->primaryKey(),
            'code'=> $this->string()->notNull(),
            'name'=> $this->string()->notNull(),
        ]);

        $this->createTable('{{%course}}', [
            'id' => $this->primaryKey(),
            'level' => $this->smallInteger()->notNull(),
            'grade'=> $this->smallInteger()->notNull(),
        ]);

        $this->createTable('{{%indicator}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->createTable('{{%period}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'star' => $this->date()->notNull(),
            'end' => $this->date()->notNull(),
        ]);

        $this->createTable('{{%teaching}}', [
            'id' => $this->primaryKey(),
            'person_id' => $this->integer()->notNull(),
            'period_id' => $this->integer()->notNull(),
            'school_id' => $this->integer()->notNull(),
            'course_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'postulation' => $this->date()->notNull(),
        ]);
        $this->createIndex('idx_teaching_person_id','{{%teaching}}','person_id');
        $this->createIndex('idx_teaching_period_id','{{%teaching}}','period_id');
        $this->createIndex('idx_teaching_school_id','{{%teaching}}','school_id');
        $this->createIndex('idx_teaching_course_id','{{%teaching}}','course_id');
        $this->createIndex('idx_teaching_subject_id','{{%teaching}}','subject_id');
        $this->addForeignKey('fk_teaching_person_id','{{%teaching}}','person_id','{{%person}}','id');
        $this->addForeignKey('fk_teaching_period_id','{{%teaching}}','period_id','{{%period}}','id');
        $this->addForeignKey('fk_teaching_school_id','{{%teaching}}','school_id','{{%school}}','id');
        $this->addForeignKey('fk_teaching_course_id','{{%teaching}}','course_id','{{%course}}','id');
        $this->addForeignKey('fk_teaching_subject_id','{{%teaching}}','subject_id','{{%subject}}','id');

        $this->createTable('{{%documentation}}', [
            'id' => $this->primaryKey(),
            'teaching_id' => $this->integer()->notNull(),
            'requirement_id' => $this->integer()->notNull(),
            'value' => $this->boolean()->notNull()
        ]);
        $this->createIndex('idx_documentation_teaching_id', '{{%documentation}}','teaching_id');
        $this->createIndex('idx_documentation_requirement_id', '{{%documentation}}','requirement_id');
        $this->addForeignKey('fk_documentation_teaching_id','{{%documentation}}','teaching_id','{{%teaching}}','id');
        $this->addForeignKey('fk_documentation_requirement_id','{{%documentation}}','requirement_id','{{%requirement}}','id');

        $this->createTable('{{%tracing}}', [
            'id' => $this->primaryKey(),
            'teaching_id' => $this->integer()->notNull(),
            'date' => $this->date()->notNull(),
            'observation' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx_tracing_teaching_id', '{{%tracing}}','teaching_id');
        $this->addForeignKey('fk_tracing_teaching_id','{{%tracing}}','teaching_id','{{%teaching}}','id');

        $this->createTable('{{%evaluation}}', [
            'id' => $this->primaryKey(),
            'tracing_id' => $this->integer()->notNull(),
            'indicator_id' => $this->integer()->notNull(),
            'value' => $this->boolean()->notNull()
        ]);
        $this->createIndex('idx_evaluation_tracing_id', '{{%evaluation}}','tracing_id');
        $this->createIndex('idx_evaluation_indicator_id', '{{%evaluation}}','indicator_id');
        $this->addForeignKey('fk_evaluation_tracing_id','{{%evaluation}}','tracing_id','{{%tracing}}','id');
        $this->addForeignKey('fk_evaluation_indicator_id','{{%evaluation}}','indicator_id','{{%indicator}}','id');
    }


    public function safeDown()
    {

    }

}
