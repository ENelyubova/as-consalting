<?php

class m181218_121822_add_product_document extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'docs', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'docs');
    }
}