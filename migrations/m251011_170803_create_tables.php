<?php

use yii\db\Migration;

class m251011_170803_create_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // user (simple auth for demo)
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(32),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // category
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'is_tax_claimable' => $this->boolean()->defaultValue(false),
            'tax_code' => $this->string()->null(), // e.g. LHDN code or label
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->createIndex('idx-category-user_id', '{{%category}}', 'user_id');
        $this->addForeignKey('fk-category-user_id', '{{%category}}', 'user_id', '{{%user}}', 'id', 'CASCADE');

        // receipt
        $this->createTable('{{%receipt}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->null(),
            'amount' => $this->decimal(12,2)->notNull(),
            'currency' => $this->string(3)->notNull()->defaultValue('MYR'),
            'spent_at' => $this->date()->notNull(),
            'vendor' => $this->string()->null(),
            'notes' => $this->text()->null(),
            'cloud_public_id' => $this->string()->null(),
            'cloud_url' => $this->string()->null(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->createIndex('idx-receipt-user_id', '{{%receipt}}', 'user_id');
        $this->createIndex('idx-receipt-category_id', '{{%receipt}}', 'category_id');
        $this->addForeignKey('fk-receipt-user_id', '{{%receipt}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-receipt-category_id', '{{%receipt}}', 'category_id', '{{%category}}', 'id', 'SET NULL');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-receipt-category_id', '{{%receipt}}');
        $this->dropForeignKey('fk-receipt-user_id', '{{%receipt}}');
        $this->dropTable('{{%receipt}}');

        $this->dropForeignKey('fk-category-user_id', '{{%category}}');
        $this->dropTable('{{%category}}');

        $this->dropTable('{{%user}}');
    }

}
