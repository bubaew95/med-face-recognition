<?php

namespace common\models\pacients\query;

/**
 * This is the ActiveQuery class for [[RecordsMedical]].
 *
 * @see RecordsMedical
 */
class RecordsMedicalQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RecordsMedical[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RecordsMedical|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
