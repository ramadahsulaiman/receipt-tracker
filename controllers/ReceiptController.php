<?php
namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Receipt;
// use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ReceiptController extends Controller
{
    public function behaviors()
    {
        return [
        //   'access' => [
        //     'class' => AccessControl::class,
        //     'only' => ['index','create','update','delete','view'],
        //     'rules' => [
        //       ['allow'=>true,'roles'=>['@']],
        //     ],
        //   ],
        ];
    }

    public function actionIndex()
    {
        $receipts = Receipt::find()
            ->where(['user_id'=>Yii::$app->user->id])
            ->orderBy(['spent_at'=>SORT_DESC, 'id'=>SORT_DESC])
            ->all();
        return $this->render('index', compact('receipts'));
    }

    public function actionCreate()
    {
        $model = new Receipt();
        $model->user_id = Yii::$app->user->id;
        $categories = Category::find()->where(['user_id'=>Yii::$app->user->id])->all();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            $file = UploadedFile::getInstanceByName('image');
            if ($file) {
                $tmp = Yii::getAlias('@runtime').'/'.$file->baseName.'.'.$file->extension;
                $file->saveAs($tmp);
                $res = Yii::$app->cloudinary->upload($tmp, 'receipts');
                @unlink($tmp);

                $model->cloud_public_id = $res['public_id'] ?? null;
                $model->cloud_url = $res['secure_url'] ?? null;
            }

            if ($model->save()){
                Yii::$app->session->setFlash('success','Receipt saved');
                return $this->redirect(['index']);
            }
        }

        return $this->render('form', compact('model','categories'));
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id !== Yii::$app->user->id) throw new NotFoundHttpException();
        $categories = Category::find()->where(['user_id'=>Yii::$app->user->id])->all();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            $file = UploadedFile::getInstanceByName('image');
            if ($file) {
                $tmp = Yii::getAlias('@runtime').'/'.$file->baseName.'.'.$file->extension;
                $file->saveAs($tmp);
                $res = Yii::$app->cloudinary->upload($tmp, 'receipts');
                @unlink($tmp);

                $model->cloud_public_id = $res['public_id'] ?? $model->cloud_public_id;
                $model->cloud_url = $res['secure_url'] ?? $model->cloud_url;
            }

            if ($model->save()){
                Yii::$app->session->setFlash('success','Receipt updated');
                return $this->redirect(['index']);
            }
        }

        return $this->render('form', compact('model','categories'));
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id !== Yii::$app->user->id) throw new NotFoundHttpException();
        // Optional: delete from Cloudinary too
        if ($model->cloud_public_id) {
            Yii::$app->cloudinary->destroy($model->cloud_public_id);
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    public function actionView($id)
    {
        $m = $this->findModel($id);
        if ($m->user_id !== Yii::$app->user->id) throw new NotFoundHttpException();
        return $this->render('view', ['model'=>$m]);
    }

    protected function findModel($id)
    {
        $m = Receipt::findOne($id);
        if (!$m) throw new NotFoundHttpException();
        return $m;
    }
}
