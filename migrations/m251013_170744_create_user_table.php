<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m251013_170744_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'password_hash' => $this->string(255)->notNull(),
            'auth_key' => $this->string(32),
            
            // Profil cukai
            'full_name' => $this->string(255)->notNull(),
            'ic_number' => $this->string(20),
            'tax_number' => $this->string(50)->unique(),
            'email' => $this->string(255)->notNull()->unique(),
            'phone_number' => $this->string(20),
            'address' => $this->text(),
            'marital_status' => "ENUM('single','married','divorced','widowed') DEFAULT 'single'",
            'dependents' => $this->integer()->defaultValue(0),
            'employer_name' => $this->string(255),
            'employer_number' => $this->string(50),
            'bank_name' => $this->string(100),
            'bank_account' => $this->string(50),

            // Audit fields
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Index untuk carian cepat
        $this->createIndex('idx-user-tax_number', '{{%user}}', 'tax_number');
        $this->createIndex('idx-user-email', '{{%user}}', 'email');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}