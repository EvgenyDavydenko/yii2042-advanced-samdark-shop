<?php

namespace console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;
use common\models\Category;
use common\models\Product;
use Faker\Factory;

class SeedController extends Controller
{
    const CAT_QTY = 6;
    const PROD_IN_CAT = 4;

    public function actionCategory()
    {
        $faker = Factory::create();

        for($i = 0; $i < self::CAT_QTY; $i++)
        {
            $category = new Category();
            $title = $faker->word();
            $category->title = $title;
            $category->slug = $title;
            $category->save(false);
        }

        echo "Data generation is complete!\n";

        return ExitCode::OK;
    }

    public function actionProduct()
    {
        $faker = Factory::create('ru_RU');

        for($i = 0; $i < self::CAT_QTY * self::PROD_IN_CAT; $i++)
        {
            $product = new Product();
            $title = $faker->word();
            $product->title = $title;
            $product->slug = $title;
            $product->description = $faker->realText(rand(100, 200));
            $product->category_id = $faker->numberBetween(1, self::CAT_QTY);
            $product->price = $faker->randomFloat(2, 1500, 6000);

            $product->save(false);
        }

        echo "Data generation is complete!\n";

        return ExitCode::OK;
    }
}