<?php

namespace backend\controllers;

use Yii;
use common\models\Image;
use common\models\Product;
use backend\models\MultipleUploadForm;
use backend\models\ImageSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Image models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        if (!Product::find()->where(['id' => $id])->exists()) {
            throw new NotFoundHttpException();
        }

        $form = new MultipleUploadForm();
        $searchModel = new ImageSearch();
        $searchModel->product_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->isPost) {
            $form->files = UploadedFile::getInstances($form, 'files');

            if ($form->files && $form->validate()) {
                foreach ($form->files as $file) {
                    $image = new Image();
                    $image->product_id = $id;
                    if ($image->save()) {
                        $file->saveAs($image->getPath());
                    }
                }

            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'uploadForm' => $form,
        ]);
    }

    /**
     * Deletes an existing Image model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $image = $this->findModel($id);
        $productId = $image->product_id;
        $image->delete();

        return $this->redirect(['index', 'id' => $productId]);
    }

    /**
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Image::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
