<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\Category;
use app\models\Receipt;
use app\models\TaxYearSummary;


/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string|null $auth_key
 * @property string $full_name
 * @property string|null $ic_number
 * @property string|null $tax_number
 * @property string $email
 * @property string|null $phone_number
 * @property string|null $address
 * @property string|null $marital_status
 * @property int|null $dependents
 * @property string|null $employer_name
 * @property string|null $employer_number
 * @property string|null $bank_name
 * @property string|null $bank_account
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Category[] $categories
 * @property Receipt[] $receipts
 * @property TaxYearSummary[] $taxYearSummaries
 */
class User extends ActiveRecord implements IdentityInterface
{

    /**
     * ENUM field values
     */
    const MARITAL_STATUS_SINGLE = 'single';
    const MARITAL_STATUS_MARRIED = 'married';
    const MARITAL_STATUS_DIVORCED = 'divorced';
    const MARITAL_STATUS_WIDOWED = 'widowed';

    public $password; // For password input (not stored in DB)
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auth_key', 'ic_number', 'tax_number', 'phone_number', 'address', 'employer_name', 'employer_number', 'bank_name', 'bank_account'], 'default', 'value' => null],
            [['marital_status'], 'default', 'value' => 'single'],
            [['dependents'], 'default', 'value' => 0],
            [['address', 'marital_status','password','bank_name'], 'string'],
            [['dependents','ic_number', 'phone_number', 'bank_account'], 'integer', 'message' => 'Hanya nombor sahaja dibenarkan.'],
            [['username', 'password_hash', 'full_name', 'email', 'employer_name'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['tax_number', 'employer_number'], 'string', 'max' => 50],
            ['marital_status', 'in', 'range' => array_keys(self::optsMaritalStatus())],
            [['created_at', 'updated_at'], 'safe'],

            [['username'], 'unique'],
            [['email'], 'unique'],
            [['tax_number'], 'unique'],

            [['username', 'password_hash', 'full_name', 'email'], 'required'],

            //password is required on create only
            [['password'], 'required', 'on' => 'create'],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'full_name' => 'Nama Penuh',
            'ic_number' => 'No IC',
            'tax_number' => 'TIN Number',
            'email' => 'Email',
            'phone_number' => 'No Telefon',
            'address' => 'Alamat rumah',
            'marital_status' => 'Status Perkahwinan',
            'dependents' => 'Tanggungan',
            'employer_name' => 'Nama majikan',
            'employer_number' => 'No Majikan',
            'bank_name' => 'Nama Bank',
            'bank_account' => 'No Akaun Bank',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */

    /* ====================== *
     * IdentityInterface implementation
     * ====================== */

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    /**
     * Finds user by username (for login)
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password (for login)
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Helper to set hashed password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Helper to generate new auth key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function getCategories()
    {
        return $this->hasMany(Category::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Receipts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceipts()
    {
        return $this->hasMany(Receipt::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[TaxYearSummaries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxYearSummaries()
    {
        return $this->hasMany(TaxYearSummary::class, ['user_id' => 'id']);
    }


    /**
     * column marital_status ENUM value labels
     * @return string[]
     */
    public static function optsMaritalStatus()
    {
        return [
            self::MARITAL_STATUS_SINGLE => 'single',
            self::MARITAL_STATUS_MARRIED => 'married',
            self::MARITAL_STATUS_DIVORCED => 'divorced',
            self::MARITAL_STATUS_WIDOWED => 'widowed',
        ];
    }

    /**
     * @return string
     */
    public function displayMaritalStatus()
    {
        return self::optsMaritalStatus()[$this->marital_status];
    }

    /**
     * @return bool
     */
    public function isMaritalStatusSingle()
    {
        return $this->marital_status === self::MARITAL_STATUS_SINGLE;
    }

    public function setMaritalStatusToSingle()
    {
        $this->marital_status = self::MARITAL_STATUS_SINGLE;
    }

    /**
     * @return bool
     */
    public function isMaritalStatusMarried()
    {
        return $this->marital_status === self::MARITAL_STATUS_MARRIED;
    }

    public function setMaritalStatusToMarried()
    {
        $this->marital_status = self::MARITAL_STATUS_MARRIED;
    }

    /**
     * @return bool
     */
    public function isMaritalStatusDivorced()
    {
        return $this->marital_status === self::MARITAL_STATUS_DIVORCED;
    }

    public function setMaritalStatusToDivorced()
    {
        $this->marital_status = self::MARITAL_STATUS_DIVORCED;
    }

    /**
     * @return bool
     */
    public function isMaritalStatusWidowed()
    {
        return $this->marital_status === self::MARITAL_STATUS_WIDOWED;
    }

    public function setMaritalStatusToWidowed()
    {
        $this->marital_status = self::MARITAL_STATUS_WIDOWED;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Auto-generate auth_key bila user baru dicipta
            if ($this->isNewRecord && empty($this->auth_key)) {
                $this->generateAuthKey();
            }
            // Hash password jika ada password baru diberikan
            if (!empty($this->password)) {
                $this->setPassword($this->password);
            }
            return true;
        }
        return false;
    }

    public function beforeValidate()
{
    if ($this->isNewRecord) {
        $this->hidden_field = 'default_value';
    }
    return parent::beforeValidate();
}

}
