<?php

namespace common\components;

class CurrentUser extends \melkov\tools\CurrentUser
{

    public static function isAdmin()
    {
        return self::getRole() == App::ROLE_ADMIN;
    }
}