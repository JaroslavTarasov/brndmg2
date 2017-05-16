<?php

use yii\db\Migration;
use yii\db\Schema;

class m170430_085550_login extends Migration
{
    public function up()
    {
        $this->createTable('login', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128),
            'surname' => $this->string(128),
            'password' => $this->string(16),
            'passwordenc' => $this->string(128),
            'username' => $this->string(128),
            'mail' => $this->string(128),
        ]);
    }

    public function down()
    {
        $this->dropTable('login');
    }

}
