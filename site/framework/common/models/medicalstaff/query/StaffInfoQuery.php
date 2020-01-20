<?php

namespace common\models\medicalstaff\query;

/**
 * This is the ActiveQuery class for [[StaffInfo]].
 *
 * @see StaffInfo
 */
class StaffInfoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StaffInfo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StaffInfo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
