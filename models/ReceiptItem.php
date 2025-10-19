<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receipt_item".
 *
 * @property int $id
 * @property int $receipt_id
 * @property string $name
 * @property float|null $amount
 *
 * @property Receipt $receipt
 */
class ReceiptItem extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount'], 'default', 'value' => 0.00],
            [['receipt_id', 'name'], 'required'],
            [['receipt_id'], 'integer'],
            [['amount'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['receipt_id'], 'exist', 'skipOnError' => true, 'targetClass' => Receipt::class, 'targetAttribute' => ['receipt_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'receipt_id' => 'Receipt ID',
            'name' => 'Name',
            'amount' => 'Amount',
        ];
    }

    /**
     * Gets query for [[Receipt]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceipt()
    {
        return $this->hasOne(Receipt::class, ['id' => 'receipt_id']);
    }

}
