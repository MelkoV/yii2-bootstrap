<?php

namespace common\components;

class CurrentUser extends \melkov\tools\CurrentUser
{
    /**
     * @return bool
     */
    public static function isAdmin()
    {
        return self::getRole() == App::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public static function isGuest()
    {
        return \Yii::$app->user->isGuest;
    }
}