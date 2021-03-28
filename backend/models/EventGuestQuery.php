<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[EventGuest]].
 *
 * @see EventGuest
 */
class EventGuestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EventGuest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EventGuest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
