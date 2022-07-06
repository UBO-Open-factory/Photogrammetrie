<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Rpi]].
 *
 * @see Rpi
 */
class RpiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Rpi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Rpi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
