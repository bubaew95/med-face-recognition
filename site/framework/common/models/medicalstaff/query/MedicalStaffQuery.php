<?php

namespace common\models\medicalstaff\query;

/**
 * This is the ActiveQuery class for [[MedicalStaff]].
 *
 * @see MedicalStaff
 */
class MedicalStaffQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MedicalStaff[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MedicalStaff|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
