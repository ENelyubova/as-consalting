<?php

class m181218_121820_add_docs extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_category}}', 'price', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_category}}', 'price');
    }
}