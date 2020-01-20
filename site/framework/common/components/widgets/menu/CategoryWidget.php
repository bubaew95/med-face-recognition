<?php
/**
 * Created by PhpStorm.
 * User: Borz
 * Date: 19.04.2019
 * Time: 21:44
 */

namespace common\components\widgets\menu;

use Yii;
use common\models\category\Category;
use yii\base\Widget;

class CategoryWidget extends Widget
{
    public $model;
    public $limit;
    public $template;
    public $sort;

    public function init()
    {
        parent::init();
        $template = $this->template;
        $settings = Yii::$app->settings;
        if($template === null) {
            $template = trim(strip_tags($settings->get('site.menu')));
        }
        $this->template = "_category_{$template}.php";
    }

    public function run()
    {
        $data = Category::allCategories($this->limit);
        return $this->getCategory($data, $this->limit);
    }

    protected function getCategory($categories, $limit)
    {
        ob_start();
        include __DIR__ . "/template/{$this->template}";
        return ob_get_clean();
    }


}