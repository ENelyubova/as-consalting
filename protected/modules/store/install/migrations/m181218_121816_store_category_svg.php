<?php

class m181218_121816_store_category_svg extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_category}}', 'svg', 'text');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_category}}', 'svg');
    }
}