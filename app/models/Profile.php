<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property integer $type
 * @property integer $provider_type
 * @property integer $buyer_type
 * @property string $number
 * @property string $name
 * @property string $phone
 * @property integer $status
 * @property string $public_email
 *
 * @property User $user
 */
class Profile extends \dektrium\user\models\Profile
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'provider_type', 'buyer_type', 'number', 'phone', 'status'], 'required'],
            [['user_id', 'type', 'provider_type', 'buyer_type', 'status'], 'integer'],
            [['number'], 'string', 'max' => 45],
            [['name', 'public_email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'           => \Yii::t('user', 'Name'),
            'type' => 'Type',
            'provider_type' => 'Provider Type',
            'buyer_type' => 'Buyer Type',
            'number'         => Yii::t('user', 'Number'),
            'phone'          => Yii::t('user', 'Phone'),
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
