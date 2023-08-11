## Пример создания магазина с использованием фреймворка Yii2

1.  Инициализировал проект на базе фреймворка Yii2-advanced: `composer create-project --prefer-dist yiisoft/yii2-app-advanced:2.0.42`

2.  Добавил в проект компонент корзины: `composer require omnilight/yii2-shopping-cart`

3.  Настроил подключение к БД и ЧПУ

4.  Создал миграцию схемы БД магазина: `php yii migrate/create shop`. Накатил миграции

5.  Сгенерировал модели common\models\Category, common\models\Product и common\models\Image для таблиц category, product и image

6.  Создал контроллер для засева таблиц category и product фэйковыми данными
