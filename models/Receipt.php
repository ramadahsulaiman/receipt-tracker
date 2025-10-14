<?php

namespace app\models;

use Yii;

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
 */
class Receipt extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt';
    }

    /**
     * {@inheritdoc}
     */
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
            [['currency'], 'string', 'max' => 3],
            [['vendor', 'cloud_public_id', 'cloud_url'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'amount' => 'Amount',
            'currency' => 'Currency',
            'spent_at' => 'Spent At',
            'vendor' => 'Vendor',
            'notes' => 'Notes',
            'cloud_public_id' => 'Cloud Public ID',
            'cloud_url' => 'Cloud Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
