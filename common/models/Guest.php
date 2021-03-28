<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%Guest}}".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $address
 * @property int|null $phone
 * @property string|null $events
 * @property string $gender
 * @property int $status 0:deleted,1:active
 */
class Guest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Guest}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'address', 'gender'], 'required'],
            [['first_name', 'last_name', 'email', 'address', 'events', 'gender'], 'string'],
            [['phone', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'address' => 'Address',
            'phone' => 'Phone',
            'events' => 'Events',
            'gender' => 'Gender',
            'status' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ManageGuestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ManageGuestQuery(get_called_class());
    }
}
