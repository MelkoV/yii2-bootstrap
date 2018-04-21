<?php

namespace common\components;

class App extends \melkov\tools\App
{

    public static function date($date)
    {
        return date("d.m.Y", strtotime($date));
    }

    public static function fromDate($date)
    {
        return date("Y-m-d", strtotime($date));
    }

    public static function dateTime($date)
    {
        return date("d.m.Y H:i:s", strtotime($date));
    }

    public static function number($number)
    {
        return number_format($number, 2, '.', ' ');
    }

    public static function setFlashSaved()
    {
        CurrentUser::setFlashSuccess(\Yii::t("message", "Successfully saved"));
    }

}