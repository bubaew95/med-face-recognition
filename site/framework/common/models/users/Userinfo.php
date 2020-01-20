<?php

namespace common\models\users;

use Yii;

/**
 * This is the model class for table "dj_user".
 *
 * @property int $id
 * @property string $date
 * @property string $last_sur_name
 * @property string $email
 * @property string $password
 * @property string $ip
 * @property string $user_agent
 * @property string $pasport_s_n
 * @property string $issued_by
 * @property string $when_issued
 * @property string $home_address
 * @property string $work_or_school
 * @property string $phone
 * @property int $isAdmin
 * @property string $actived
 * @property string $new
 * @property string $where_came
 * @property string $unsubscribe
 *
 * @property Users[] $users
 */
class Userinfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_sur_name', 'home_address', 'work_or_school', 'phone'], 'required'],
            [['date'], 'safe'],
            [['isAdmin'], 'integer'],
            [['actived', 'new', 'unsubscribe'], 'string'],
            [['last_sur_name', 'email', 'password', 'user_agent', 'issued_by', 'home_address', 'work_or_school', 'where_came'], 'string', 'max' => 255],
            [['ip', 'when_issued', 'phone'], 'string', 'max' => 15],
            [['pasport_s_n'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'last_sur_name' => 'Last Sur Name',
            'email' => 'Email',
            'password' => 'Password',
            'ip' => 'Ip',
            'user_agent' => 'User Agent',
            'pasport_s_n' => 'Pasport S N',
            'issued_by' => 'Issued By',
            'when_issued' => 'When Issued',
            'home_address' => 'Home Address',
            'work_or_school' => 'Work Or School',
            'phone' => 'Phone',
            'isAdmin' => 'Is Admin',
            'actived' => 'Actived',
            'new' => 'New',
            'where_came' => 'Where Came',
            'unsubscribe' => 'Unsubscribe',
        ];
    }

    public function __toString()
    {
        try {
            return (string) $this->last_sur_name;
        } catch (\Exception $exception) {
            return '';
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id_user' => 'id']);
    }
}
