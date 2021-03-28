<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%event}}".
 *
 * @property int $id
 * @property string $name
 * @property string $datetime
 * @property string $location
 * @property string $status 1:show,0:hide
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%event}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'datetime', 'location', 'status'], 'required'],
            [['name', 'location', 'status'], 'string'],
            [['datetime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Event Name',
            'datetime' => 'Date and time',
            'location' => 'Location',
            'status' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     * @return EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventQuery(get_called_class());
    }

    public function getGuest() {
        return $this->hasMany(Guest::className(), ['id' => 'guest_id'])->viaTable('eventguest', ['guest_id' => 'id']);
    }
}
