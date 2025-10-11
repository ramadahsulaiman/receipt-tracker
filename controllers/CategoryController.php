<?php
namespace app\controllers;

use Yii;
use app\models\Category;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CategoryController extends Controller
{
    public function behaviors()
    {
        return [
          'access' => [
            'class' => AccessControl::class,
            'only' => ['index','create','update','delete'],
            'rules' => [
              ['allow'=>true,'roles'=>['@']],
            ],
          ],
        ];
    }

    public function actionIndex()
    {
        $categories = Category::find()->where(['user_id'=>Yii::$app->user->id])->all();
        return $this->render('index', compact('categories'));
    }

    public function actionCreate()
    {
        $model = new Category();
        $model->user_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success','Category created');
            return $this->redirect(['index']);
        }
        return $this->render('form', compact('model'));
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id !== Yii::$app->user->id) throw new NotFoundHttpException();

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success','Category updated');
            return $this->redirect(['index']);
        }
        return $this->render('form', compact('model'));
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id !== Yii::$app->user->id) throw new NotFoundHttpException();
        $model->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        $m = Category::findOne($id);
        if (!$m) throw new NotFoundHttpException();
        return $m;
    }
}
