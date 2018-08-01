<?php
/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 * You must Mark as Plain Text vendor/yiisoft/yii2/Yii.php
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication|WebApplication|ConsoleApplication the application instance
     */
    public static $app;
}

/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 *
 * @property \yii\rbac\DbManager $authManager
 * @property User $user
 */
abstract class BaseApplication extends yii\base\Application
{
}

/**
 * Class WebApplication
 * Include only Web application related components here
 */
class WebApplication extends yii\web\Application
{
}

/**
 * Class ConsoleApplication
 * Include only Console application related components here
 */
class ConsoleApplication extends yii\console\Application
{
}

/**
 * Class User
 *
 * @property \common\models\User $identity
 */
class User extends yii\web\User
{
}
