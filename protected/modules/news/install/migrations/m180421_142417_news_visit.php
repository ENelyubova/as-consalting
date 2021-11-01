<?php

class m180421_142417_news_visit extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{news_news}}', 'visit', 'integer default "0"');
    }
    public function safeDown()
    {
        $this->dropColumn('{{news_news}}', 'visit');
    }
}