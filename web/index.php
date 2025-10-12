<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';

//load .env variables
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';


// ------------------------------------------------------
// AUTO LOGIN ADMIN (for local testing - skip login page)
// ------------------------------------------------------
use app\models\User;
use yii\web\Application;

$app = new Application($config);

// Automatically login admin user if not logged in
$app->on(Application::EVENT_BEFORE_REQUEST, function () {
    if (\Yii::$app->user->isGuest) {
        $admin = User::find()->where(['username' => 'admin'])->one();
        if ($admin) {
            \Yii::$app->user->login($admin);
        }
    }
});

// Run the app
$app->run();
(new yii\web\Application($config))->run();
