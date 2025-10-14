<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%receipt}}`.
 */
class m251013_171749_create_receipt_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%receipt}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer(),
            'amount' => $this->decimal(12, 2)->notNull(),
            'currency' => $this->string(3)->defaultValue('MYR'),
            'spent_at' => $this->date()->notNull(),
            'vendor' => $this->string(255),
            'notes' => $this->text(),
            'cloud_public_id' => $this->string(255),
            'cloud_url' => $this->string(255),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Foreign keys
        $this->addForeignKey(
            'fk-receipt-user_id',
            '{{%receipt}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-receipt-category_id',
            '{{%receipt}}',
            'category_id',
            '{{%category}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-receipt-user_id', '{{%receipt}}');
        $this->dropForeignKey('fk-receipt-category_id', '{{%receipt}}');
        $this->dropTable('{{%receipt}}');
    }
}