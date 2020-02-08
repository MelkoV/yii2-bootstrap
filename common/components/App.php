<?php

namespace common\components;

use melkov\tools\helpers\DateHelper;
use melkov\tools\helpers\StringHelper;

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

    public static function dateTimeShort($date)
    {
        if (!$date) {
            return null;
        }
        return date("d.m.Y H:i", strtotime($date));
    }

    public static function fromDateTime($date)
    {
        if (!$date) {
            return null;
        }
        return date("Y-m-d H:i:s", strtotime($date));
    }

    public static function ruDate($date, $type = 1, $ucfirst = false)
    {
        if (!$date) {
            return null;
        }
        $time = strtotime($date);
        return date('d', $time) . ' ' . DateHelper::ruMonth(date('m', $time), $type, $ucfirst) . ' ' . date('Y в H:i', $time);
    }

    /**
     * @param $dateStart
     * @param $dateEnd
     * @return string
     */
    public static function dateDiff($dateStart, $dateEnd)
    {
        $time = strtotime($dateEnd) - strtotime($dateStart);
        $hours = floor($time / 60 / 60);
        $time -= $hours * 3600;
        $minutes = floor($time / 60);
        if (!$minutes) {
            return 'менее минуты';
        }
        $str = $hours ? $hours . ' ' . StringHelper::end($hours, ['часов', 'час', 'часа']) . ' ' : '';
        $str .= $minutes . ' ' . StringHelper::end($minutes, ['минут', 'минута', 'минуты']);
        return $str;
    }

    public static function number($number)
    {
        return number_format($number, 2, '.', ' ');
    }

    public static function setFlashSaved()
    {
        CurrentUser::setFlashSuccess(\Yii::t('message', 'Successfully saved'));
    }

}