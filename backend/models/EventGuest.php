<?php

namespace backend\models;
// use backend\models\EventGuest;

use Yii;

/**
 * This is the model class for table "{{%eventguest}}".
 *
 * @property int $id
 * @property int $event_id
 * @property int $guest_id
 */
class EventGuest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public static function tableName()
    {
        return '{{%eventguest}}';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['event_id', 'guest_id'], 'required'],
            [['event_id', 'guest_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'guest_id' => 'Guest ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return EventGuestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventGuestQuery(get_called_class());
    }

    public function getGuest(){
        return $this->hasOne(Guest::className(), ['id' => 'guest_id']);
    }

}
