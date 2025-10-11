<?php
namespace app\models;

use yii\db\ActiveRecord;

class Receipt extends ActiveRecord
{
    public static function tableName(){ return '{{%receipt}}'; }

    public function rules(){
        return [
            [['user_id','amount','spent_at'],'required'],
            [['amount'],'number'],
            [['notes'],'string'],
            [['spent_at'],'date','format'=>'php:Y-m-d'],
            [['category_id'],'integer'],
            [['vendor','cloud_public_id','cloud_url','currency'],'string','max'=>255],
        ];
    }

    public function getUser(){ return $this->hasOne(User::class, ['id'=>'user_id']); }
    public function getCategory(){ return $this->hasOne(Category::class, ['id'=>'category_id']); }
}
