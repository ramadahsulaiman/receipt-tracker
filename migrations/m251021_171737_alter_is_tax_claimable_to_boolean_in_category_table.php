<?php

use yii\db\Migration;

/**
 * Handles altering column `is_tax_claimable` in table `{{%category}}` to boolean.
 */
class m251021_171737_alter_is_tax_claimable_to_boolean_in_category_table extends Migration
{
    public function safeUp()
    {
        // Tukar column is_tax_claimable kepada BOOLEAN
        $this->alterColumn('{{%category}}', 'is_tax_claimable', $this->boolean()->notNull()->defaultValue(0));
    }

    public function safeDown()
    {
        // Jika nak rollback balik (contohnya column asal jenis integer)
        $this->alterColumn('{{%category}}', 'is_tax_claimable', $this->integer()->notNull()->defaultValue(0));
    }
}
