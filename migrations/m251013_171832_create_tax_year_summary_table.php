<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tax_year_summary}}`.
 */
class m251013_171832_create_tax_year_summary_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tax_year_summary}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'tax_year' => $this->smallInteger(4)->notNull(),
            'total_receipts' => $this->decimal(10, 2)->defaultValue(0),
            'total_claimed' => $this->decimal(10, 2)->defaultValue(0),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Foreign key to user
        $this->addForeignKey(
            'fk-tax_year_summary-user_id',
            '{{%tax_year_summary}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-tax_year_summary-user_id', '{{%tax_year_summary}}');
        $this->dropTable('{{%tax_year_summary}}');
    }
}