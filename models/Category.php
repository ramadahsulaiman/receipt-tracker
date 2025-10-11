<?php
namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName(){ return '{{%category}}'; }

    public function rules(){
        return [
            [['user_id','name'],'required'],
            ['is_tax_claimable','boolean'],
            ['tax_code','string'],
        ];
    }

    public function getUser(){ return $this->hasOne(User::class, ['id'=>'user_id']); }
    public function getReceipts(){ return $this->hasMany(Receipt::class, ['category_id'=>'id']); }
}
