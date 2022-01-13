<?php

/**
 * php install.php                          // for prod env
 * php install.php --env=dev                // for dev env
 * php install.php --composer=composer      // set composer path. default is composer.phar. If isset "composer" arg,
 *                                          // installer does not check that composer isset
 * php install.php --env=dev --nocomposer=1 // for local dev in immo network. Don't install composer requires
 */

$options = [
    'e:' => 'env:',
    'c:' => 'composer:',
    'n:' => 'nocomposer:',
    'a:' => 'composerauth:'
];

$args = getopt(implode('', array_keys($options)), $options);

$env = $args['env'] ?? 'prod';
if (isset($args['composer'])) {
    $composer = $args['composer'];
} else {
    $composer = 'php composer.phar';
}
$noComposer = (isset($args['nocomposer']) && $args['nocomposer'] == 1);

function curlGet($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

if (!$noComposer && !isset($args['composer']) && !file_exists('composer.phar')) {
    // try install local composer
    echo 'Installing composer' . PHP_EOL;
    $sig = curlGet('https://composer.github.io/installer.sig');
    if (!$sig) {
        echo 'Cat\'t connect to https://composer.github.io/installer.sig' . PHP_EOL;
        exit(1);
    }
    file_put_contents('composer-setup.php', curlGet('https://getcomposer.org/installer'));
    if (hash_file('SHA384', 'composer-setup.php') === trim($sig)) {
        exec('php composer-setup.php');
        unlink('composer-setup.php');
    } else {
        echo 'Composer SIG invalid' . PHP_EOL;
        exit(1);
    }
}

$noDev = $env == 'prod' ? ' --no-dev' : '';

if (!$noComposer) {
    echo 'Run ' . $composer . PHP_EOL;
	// if ($env == 'local') {
 //        echo 'Install composer plugin prestissimo' . PHP_EOL;
 //        exec($composer . ' global require hirak/prestissimo');
 //    }

    exec($composer . ' install' . $noDev);
    if ($env == 'prod') {
        echo 'Run composer dump autoload' . PHP_EOL;
        exec($composer . ' dumpautoload -o');
    }
}

if ($env != 'local') {
    echo 'ENV is not local. Skip.' . PHP_EOL . 'Not run yii init' . PHP_EOL . 'Not run migrations' . PHP_EOL;
    exit(0);
}

echo 'Run init yii' . PHP_EOL;
exec('php init --env=Local --overwrite=Yes');
echo 'Run migrations' . PHP_EOL;
exec('php yii migrate --interactive=0');
echo 'Set dir permissions' . PHP_EOL;
chmod('frontend/runtime', 0777);
chmod('backend/runtime', 0777);
chmod('frontend/web/assets', 0777);
chmod('backend/web/assets', 0777);
//exec('chmod +x tests/bin/yii');
echo 'OK' . PHP_EOL;
exit(0);