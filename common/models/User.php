<?php
namespace common\models;

use Yii;

class User extends \melkov\tools\models\User
{

    public function rules()
    {
        return array_merge(parent::rules(), [

        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [

        ]);
    }

    public function attributeHints()
    {
        return [

        ];
    }

}
