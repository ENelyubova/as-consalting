<?php

class m181218_121823_add_product_text_bold extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'text_bold', 'text');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'text_bold');
    }
}