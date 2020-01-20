<?php

namespace common\models\pacients;

/**
 * This is the ActiveQuery class for [[PacientsCart]].
 *
 * @see PacientsCart
 */
class PacientsCartQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PacientsCart[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PacientsCart|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
