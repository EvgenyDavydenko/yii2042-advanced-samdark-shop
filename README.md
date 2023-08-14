## Пример создания магазина с использованием фреймворка Yii2

1.  Инициализировал проект на базе фреймворка Yii2-advanced: `composer create-project --prefer-dist yiisoft/yii2-app-advanced:2.0.42`

2.  Добавил в проект компонент корзины: `composer require omnilight/yii2-shopping-cart` (пока не обязательно, можно позже)

3.  Настроил подключение к БД и ЧПУ(f\b)

4.  Создал миграцию схемы БД магазина: `php yii migrate/create shop`. Накатил миграции

5.  Сгенерировал модели common\models\Category, common\models\Product и common\models\Image для таблиц category, product и image

6.  Создал контроллер для засева таблиц category и product фэйковыми данными

7.  MVC для отображения списка всех продуктов из всех категорий

8.  Backend CRUD MVC для Category

9.  Backend CRUD MVC для Product

[на основе](https://github.com/samdark/yii2-shop)
