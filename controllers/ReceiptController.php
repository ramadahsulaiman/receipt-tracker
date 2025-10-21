<?php

namespace app\controllers;

use Yii;
use app\models\Receipt;
use app\models\ReceiptSearch;
use app\models\ReceiptItem;
use app\models\ReceiptItemSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Category;

class ReceiptController extends Controller
{
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

    public function actionIndex()
    {
        $this->layout = 'blank-content';

        $searchModel = new ReceiptSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Create new receipt with items and upload.
     */
    public function actionCreate()
    {
        $this->layout = 'blank-content';
        $model = new Receipt();
        $model->user_id = Yii::$app->user->id ?? 1; // fallback if not logged in

        $category = \yii\helpers\ArrayHelper::map(
            \app\models\Category::find()->orderBy(['name' => SORT_ASC])->all(),
            'id',
            'name'
        );

        $removeFile = Yii::$app->request->post('removeFile', 0);

        if ($removeFile && !$model->receiptFile) {
            if ($model->cloud_public_id) {
                try {
                    \Cloudinary\Api\Upload\UploadApi::destroy($model->cloud_public_id);
                } catch (\Exception $e) {
                    Yii::warning('Gagal padam dari Cloudinary: ' . $e->getMessage());
                }
            }
            $model->cloud_url = null;
            $model->cloud_public_id = null;
        }


        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->receiptFile = UploadedFile::getInstanceByName('receiptFile');

            //capture the button submit save or as draft
            $action = Yii::$app->request->post('action');

            if ($model->status !== 'Draft') {
                $model->status = 'Saved';
            }

            // Upload to Cloudinary
            if ($model->receiptFile) {
                $model->uploadToCloudinary();
            }

            // Calculate total amount based on items
            $items = Yii::$app->request->post('items', []);
            $totalAmount = 0;
            if (!empty($items['amount'])) {
                foreach ($items['amount'] as $amt) {
                    $totalAmount += floatval($amt);
                }
            }
            $model->amount = $totalAmount;

            if ($model->save()) {
                // Save items
                if (!empty($items['name'])) {
                    foreach ($items['name'] as $i => $name) {
                        if (trim($name) === '') continue;
                        $item = new ReceiptItem([
                            'receipt_id' => $model->id,
                            'name' => $name,
                            'amount' => floatval($items['amount'][$i] ?? 0),
                        ]);
                        $item->save(false);
                    }
                }

                Yii::$app->session->setFlash(
                    'success', 
                    $action === 'draft' 
                    ? 'Resit disimpan untuk kemudian.' 
                    : 'Resit berjaya disimpan.'
                );
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Ralat semasa menyimpan resit.');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'category' => $category,
        ]);
    }

    /**
     * Display a single receipt with items and uploaded file.
     */
    public function actionView($id)
    {
        $this->layout = 'blank-content';
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $this->layout = 'blank-content';
        $model = $this->findModel($id);

        // Ambil kategori dari table Category
        $category = \yii\helpers\ArrayHelper::map(
            \app\models\Category::find()->orderBy(['name' => SORT_ASC])->all(),
            'id',
            'name'
        );

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->receiptFile = UploadedFile::getInstanceByName('receiptFile');

            if ($model->status !== 'Draft') {
                $model->status = 'Saved';
            }

            if ($model->receiptFile) {
                $model->uploadToCloudinary();
            }

            // Kira jumlah semula
            $items = Yii::$app->request->post('items', []);
            $totalAmount = 0;
            if (!empty($items['amount'])) {
                foreach ($items['amount'] as $amt) {
                    $totalAmount += floatval($amt);
                }
            }
            $model->amount = $totalAmount;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Resit berjaya dikemaskini.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Ralat semasa mengemaskini resit.');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'category' => $category,
        ]);
    }


    /**
     * Deletes an existing receipt and its items.
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        Yii::$app->session->setFlash('success', 'Resit telah dipadam.');
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Receipt::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Resit tidak dijumpai.');
    }
}
