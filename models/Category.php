<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int|null $is_tax_claimable
 * @property float|null $max_deduction
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Receipt[] $receipts
 * @property User $user
 */
class Category extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'default', 'value' => null],
            [['is_tax_claimable'], 'default', 'value' => 0],
            [['max_deduction'], 'default', 'value' => 0.00],
            [['user_id', 'name'], 'required'],
            [['user_id', 'is_tax_claimable','active'], 'integer'],
            [['max_deduction'], 'number'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Nama Kategori',
            'is_tax_claimable' => 'Boleh claim?',
            'max_deduction' => 'Max. Penolakan',
            'description' => 'Keterangan',
            'created_at' => 'Dicipta pada',
            'updated_at' => 'Kemaskini pada',
        ];
    }

    /**
     * Gets query for [[Receipts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceipts()
    {
        return $this->hasMany(Receipt::class, ['category_id' => 'id']);
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
