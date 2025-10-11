<?php
// Show all PHP errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

// --- Direct Cloudinary SDK test ---
// ⚠️ Replace these with your real Cloudinary credentials
Configuration::instance([
    'cloud' => [
        'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'] ?? 'demo',
        'api_key'    => $_ENV['CLOUDINARY_API_KEY'] ?? '123456',
        'api_secret' => $_ENV['CLOUDINARY_API_SECRET'] ?? 'abcdef',
    ],
    'url' => ['secure' => true],
]);

$file = __DIR__ . '/test.jpg';
if (!file_exists($file)) {
    die("❌ File test.jpg not found in web folder.\n");
}

try {
    $result = (new UploadApi())->upload($file, ['folder' => 'test']);
    echo "✅ Upload success!\n";
    print_r($result);
} catch (Exception $e) {
    echo "❌ Upload failed: " . $e->getMessage() . "\n";
}
