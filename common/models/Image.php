<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property int|null $product_id
 *
 * @property Product $product
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * @return string image hash
     */
    protected function getHash()
    {
        return md5($this->product_id . '-' . $this->id);
    }

    /**
     * @return string path to image file
     */
    public function getPath()
    {
        return Yii::getAlias('@frontend/web/images/' . $this->getHash() . '.jpg');
    }

    /**
     * @return string URL of the image
     */
    public function getUrl()
    {
        return Yii::getAlias('@frontendWebroot/images/' . $this->getHash() . '.jpg');
    }
}
