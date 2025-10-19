<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%receipt}}`.
 */
class m251018_191328_add_status_and_timestamps_to_receipt_table extends Migration
{
    public function safeUp()
    {
        // Add a status column (for Draft/Saved)
        $this->addColumn('{{%receipt}}', 'status', $this->string(20)->defaultValue('Saved')->after('notes'));

        // Add automatic timestamps if not already present
        if ($this->db->schema->getTableSchema('{{%receipt}}')->getColumn('created_at') === null) {
            $this->addColumn('{{%receipt}}', 'created_at', $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'));
        }

        if ($this->db->schema->getTableSchema('{{%receipt}}')->getColumn('updated_at') === null) {
            $this->addColumn('{{%receipt}}', 'updated_at', $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        }
    }

    public function safeDown()
    {
        $this->dropColumn('{{%receipt}}', 'status');

        // Optional rollback (only if you added them in safeUp)
        if ($this->db->schema->getTableSchema('{{%receipt}}')->getColumn('created_at')) {
            $this->dropColumn('{{%receipt}}', 'created_at');
        }
        if ($this->db->schema->getTableSchema('{{%receipt}}')->getColumn('updated_at')) {
            $this->dropColumn('{{%receipt}}', 'updated_at');
        }
    }
}
