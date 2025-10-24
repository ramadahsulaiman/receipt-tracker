<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\Category;


/**
 * This is the model class for table "receipt".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $category_id
 * @property float $amount
 * @property string|null $currency
 * @property string $spent_at
 * @property string|null $vendor
 * @property string|null $notes
 * @property string|null $cloud_public_id
 * @property string|null $cloud_url
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Category $category
 * @property User $user
 * @property ReceiptItem[] $items
 */
class Receipt extends \yii\db\ActiveRecord
{
    /** @var UploadedFile|null For uploaded PDF/image */
    public $receiptFile;

    public static function tableName()
    {
        return 'receipt';
    }

    public function rules()
    {
        return [
            [['category_id', 'vendor', 'notes', 'cloud_public_id', 'cloud_url'], 'default', 'value' => null],
            [['currency'], 'default', 'value' => 'MYR'],
            [['user_id', 'amount', 'spent_at'], 'required'],
            [['user_id', 'category_id'], 'integer'],
            [['amount'], 'number'],
            [['spent_at', 'created_at', 'updated_at'], 'safe'],
            [['notes'], 'string'],
            [['status'], 'string','max'=>20],
            [['currency'], 'string', 'max' => 3],
            [['vendor', 'cloud_public_id', 'cloud_url'], 'string', 'max' => 255],
            [['receiptFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['jpg', 'jpeg', 'png', 'pdf']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category_id' => 'Kategori',
            'amount' => 'Jumlah (RM)',
            'currency' => 'Mata Wang',
            'spent_at' => 'Tarikh Resit',
            'vendor' => 'Kedai / Servis',
            'notes' => 'Notes',
            'cloud_public_id' => 'Cloudinary Public ID',
            'cloud_url' => 'Cloudinary URL',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'receiptFile' => 'Upload Receipt (Image / PDF)',
            'status' => 'status'
        ];
    }

    /** 🔗 Relation to Category */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /** 🔗 Relation to User */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /** 🔗 Relation to Receipt Items */
    public function getItems()
    {
        return $this->hasMany(ReceiptItem::class, ['receipt_id' => 'id']);
    }

    /** 🧠 Upload Helper (Cloudinary already configured globally) */
    public function uploadToCloudinary()
    {
        if (!$this->receiptFile) return false;

        $upload = Yii::$app->cloudinary->upload($this->receiptFile->tempName, 'receipts');

        $this->cloud_url = $upload['secure_url'];
        $this->cloud_public_id = $upload['public_id'];
        return true;
    }

    public function beforeDelete()
    {
        if (!empty($this->cloud_public_id)) {
            try {
                Yii::$app->cloudinary->destroy($this->cloud_public_id);
            } catch (\Exception $e) {
                Yii::error('Failed to delete Cloudinary file: ' . $e->getMessage());
            }
        }
        return parent::beforeDelete();
    }

}
