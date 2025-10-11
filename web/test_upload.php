<?php
// web/test_upload.php

// 1️⃣ Load Composer autoload + Yii2 framework
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// 2️⃣ Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

// 3️⃣ Include your component namespace manually (autoload works after Yii boot)
use app\components\CloudinaryComponent;

echo "Starting Cloudinary upload test...\n";

// 4️⃣ Init Cloudinary
$cloudinary = new CloudinaryComponent();
$cloudinary->init();

// 5️⃣ Choose a file to upload (ensure it exists!)
$file = __DIR__ . '/test.png';
if (!file_exists($file)) {
    die("❌ File not found at $file\n");
}
if (filesize($file) == 0) {
    die("❌ File is empty at $file\n");
}
echo "✅ File found (" . filesize($file) . " bytes)\n";

// 6️⃣ Upload
try {
    $result = $cloudinary->upload($file, 'test');
    echo "✅ Upload successful!\n";
    print_r($result);
} catch (Exception $e) {
    echo "❌ Exception caught:\n" . $e->getMessage() . "\n";
}
