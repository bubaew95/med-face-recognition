<?php

namespace common\models\medicalstaff;

use common\models\medicalstaff\query\MedicalStaffQuery;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "{{%medical_staff}}".
 *
 * @property int $id
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property StaffInfo[] $staffInfos
 */
class MedicalStaff extends ActiveRecord implements IdentityInterface
{
    public $password;
    public $repassword;
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%medical_staff}}';
    }

    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_UPDATE = 'update';

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['email', 'password', 'repassword'],
            self::SCENARIO_UPDATE => ['email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'repassword'], 'required', 'on' => self::SCENARIO_DEFAULT],
            [['email'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['email', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['password', 'repassword'], 'string', 'min' => 3, 'max' => 32],
            [['password_reset_token'], 'unique'],
            ['repassword', 'validatePasswordAndRepassword'],
        ];
    }

    public function validatePasswordAndRepassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->password != $this->repassword) {
                $this->addError($attribute, 'Пароли не совпадают');
            }
        }
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'E-mail',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Пароль',
            'password_reset_token' => 'Токен восстановления пароля',
            'status' => 'Статус',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата изменения',
            'password' => 'Пароль',
            'repassword' => 'Подтвердить пароль',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffInfo()
    {
        return $this->hasOne(StaffInfo::className(), ['id_staff' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return MedicalStaffQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MedicalStaffQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    //Поиск по Email
    public function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getUserinfo()
    {
        return $this->hasOne(Userinfo::className(), ['id' => 'id_user']);
    }

    public function resetPassword($email)
    {
        $user = static::find()->select(['password_reset_token'])->where(['email' => $email, 'status' => self::STATUS_ACTIVE])->one();
        return $user->password_reset_token;
    }
}
