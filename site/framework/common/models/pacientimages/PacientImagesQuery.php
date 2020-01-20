<?php

namespace common\models\pacientimages;

/**
 * This is the ActiveQuery class for [[PacientImages]].
 *
 * @see PacientImages
 */
class PacientImagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PacientImages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PacientImages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
