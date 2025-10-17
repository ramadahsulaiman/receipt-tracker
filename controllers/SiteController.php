<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'logout'],
                'rules' => [
                    [
                        // 'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post', 'get'], // allow GET for logout to support navbar link
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    // Custom landing page action
    public function actionLanding()
    {
        $this->layout = 'blank';
        $user = Yii::$app->user->identity;
        return $this->render('landing',[
            'user' => $user,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'blank-content';
        $user = null;

        // Example data (replace with actual queries later)
        $totalReceipt = (new \yii\db\Query())->from('receipt')->count();
        $totalReport = (new \yii\db\Query())->from('report')->count();
        $totalCategory = (new \yii\db\Query())->from('category')->count();

        if (!Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity;
        }

        // Individual core tax reliefs (2024 values from LHDN Malaysia)
        $taxReliefs = [
            'Self & Dependent' => 9000,
            'EPF & Life Insurance' => 7000,
            'Parents (each)' => 1500,
            'Education & Medical Insurance' => 3000,
            'Lifestyle (books, sports, internet)' => 2500,
            'SSPN Net Savings' => 8000,
            'Medical Expenses (self, spouse, child)' => 8000,
            'Child (Below 18)' => 2000,
            'Disabled Individual' => 6000,
        ];

        return $this->render('index', [
            'user' => $user,
            'totalReceipt' => $totalReceipt,
            'totalReport' => $totalReport,
            'totalCategory' => $totalCategory,
            'taxReliefs' => $taxReliefs,
            
        ]);
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
        public function actionLogin()
        {
            $this->layout = 'blank';
            if (!Yii::$app->user->isGuest) {
                return $this->goHome();
            }

            $model = new LoginForm();

            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this-> redirect(['site/index']); // redirect ke halaman asal (atau index)
            }

            $model->password = ''; // kosongkan semula password field
            return $this->render('login', [
                'model' => $model,
            ]);
        }


        public function actionLogout()
        {
            Yii::$app->user->logout();
            return $this->goHome();
        }


    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        // Prevent caching after logout
        Yii::$app->response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        Yii::$app->response->headers->set('Pragma', 'no-cache');
        Yii::$app->response->headers->set('Expires', 'Thu, 01 Jan 1970 00:00:00 GMT');

        return true;
    }

}
