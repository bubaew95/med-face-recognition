<?php

namespace common\models\pacients\query;

/**
 * This is the ActiveQuery class for [[MedicalSupervision]].
 *
 * @see MedicalSupervision
 */
class MedicalSupervisionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MedicalSupervision[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MedicalSupervision|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
