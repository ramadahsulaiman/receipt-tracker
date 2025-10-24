<?php

use yii\db\Migration;

/**
 * Handles adding column `active` to table `{{%category}}`.
 */
class m251021_171302_add_active_column_to_category_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%category}}', 'active', $this->boolean()->notNull()->defaultValue(1)->after('name'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%category}}', 'active');
    }
}
