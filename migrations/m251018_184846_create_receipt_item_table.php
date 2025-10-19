<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%receipt_item}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%receipt}}`
 */
class m251018_184846_create_receipt_item_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%receipt_item}}', [
            'id' => $this->primaryKey(),
            'receipt_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'amount' => $this->decimal(10, 2)->defaultValue(0),
        ]);

        // index for faster lookups
        $this->createIndex(
            '{{%idx-receipt_item-receipt_id}}',
            '{{%receipt_item}}',
            'receipt_id'
        );

        // add foreign key to receipt table
        $this->addForeignKey(
            '{{%fk-receipt_item-receipt_id}}',
            '{{%receipt_item}}',
            'receipt_id',
            '{{%receipt}}',
            'id',
            'CASCADE',   // delete all items when a receipt is deleted
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-receipt_item-receipt_id}}', '{{%receipt_item}}');
        $this->dropIndex('{{%idx-receipt_item-receipt_id}}', '{{%receipt_item}}');
        $this->dropTable('{{%receipt_item}}');
    }
}
