<?php

use common\components\App;
use melkov\tools\console\Migration;

class m130524_201442_init extends Migration
{

    public function depends()
    {
        return ["@yii/rbac/migrations"];
    }

    public function getOperations()
    {
        return [];
//        return ["Controller:Action" => ["role1", "role2"]];
    }

    public function getNewTables()
    {
        return [
            "{{%user}}" => [
                'id' => $this->primaryKey(),
                'username' => $this->string()->notNull()->unique(),
                'name' => $this->string(),
                'auth_key' => $this->string(32)->notNull(),
                'password_hash' => $this->string()->notNull(),
                'password_reset_token' => $this->string()->unique(),
                'email' => $this->string()->notNull()->unique(),

                'status' => $this->smallInteger()->notNull()->defaultValue(10),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
        ];
    }

    public function getNewColumns()
    {
        return [];
    }

    public function safeUp()
    {
        $this->createTables($this->getNewTables());
        $this->addColumns($this->getNewColumns());
        $this->addOperationsAccesses();

        $this->createRole(App::ROLE_USER, new \melkov\tools\rbac\UserRule());
        $this->createRole(App::ROLE_ADMIN);

        $model = new \common\models\User();
        $model->username = "admin";
        $model->name = "Admin";
        $model->email = "admin@local.host";
        $model->setPassword("admin");
        $model->generateAuthKey();
        if ($model->save(false)) {
            $model->assign(App::ROLE_ADMIN);
        } else {
            print_r($model->getErrors());
            return false;
        }
    }

    public function safeDown()
    {
        $this->dropTables($this->getNewTables());
        $this->dropColumns($this->getNewColumns());
        $this->revokeOperationsAccesses();
    }
}
