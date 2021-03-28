<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Guest]].
 *
 * @see \common\models\Guest
 */
class ManageGuestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Guest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Guest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
