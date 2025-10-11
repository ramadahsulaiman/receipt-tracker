<?php
namespace app\components;

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use yii\base\Component;

class CloudinaryComponent extends Component
{
    public function init()
    {
        parent::init();
        Configuration::instance([
            'cloud' => [
                'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
                'api_key'    => $_ENV['CLOUDINARY_API_KEY'],
                'api_secret' => $_ENV['CLOUDINARY_API_SECRET'],
            ],
            'url' => ['secure' => true]
        ]);
    }

    public function upload($localFilePath, $folder = 'receipts')
    {
        $result = (new UploadApi())->upload($localFilePath, ['folder' => $folder]);
        return $result; // includes public_id, secure_url, etc.
    }

    public function destroy($publicId)
    {
        return (new UploadApi())->destroy($publicId);
    }
}
