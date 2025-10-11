<?php
require __DIR__ . '/vendor/autoload.php';

// ✅ Load .env (this part is missing in your script)
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// ✅ Load Yii bootstrap (for DB & models)
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/config/web.php';
$app = new yii\web\Application($config);

use app\models\User;

try {
    $user = new User();
    $user->username = 'admin';
    $user->password_hash = Yii::$app->security->generatePasswordHash('secret123');
    $user->auth_key = Yii::$app->security->generateRandomString();

    if ($user->save()) {
        echo "✅ Admin user created successfully!\n";
    } else {
        print_r($user->errors);
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
