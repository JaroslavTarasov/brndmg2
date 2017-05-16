<?php

use yii\db\Migration;
use yii\db\Schema;

class m170510_163224_create_logs_table extends Migration
{
    public function up()
    {
        $this->createTable('logs', [
            'operation' => $this->primaryKey(),
            'who' => $this->string(128),
            'towhom' => $this->string(128),
            'howmuch' => ('NUMERIC(19,4)'),
            'date' => $this->timestamp(),
        ]);
    }

    public function down()
    {
        $this->dropTable('logs');
    }
}
