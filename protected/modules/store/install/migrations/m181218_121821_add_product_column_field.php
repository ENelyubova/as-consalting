<?php

class m181218_121821_add_product_column_field extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'field', 'longtext');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'field');
    }
}