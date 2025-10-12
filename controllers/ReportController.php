<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
// use yii\filters\AccessControl;
use app\models\Receipt;
use app\models\Category;

class ReportController extends Controller
{
    public function behaviors()
    {
        return [
        //   'access' => [
        //     'class' => AccessControl::class,
        //     'only' => ['index'],
        //     'rules' => [
        //       ['allow'=>true,'roles'=>['@']],
        //     ],
        //   ],
        ];
    }

    public function actionIndex($from=null, $to=null)
    {
        $uid = Yii::$app->user->id;
        $from = $from ?: date('Y-m-01');
        $to   = $to   ?: date('Y-m-t');

        $rows = (new \yii\db\Query())
            ->from('receipt')
            ->where(['user_id'=>$uid])
            ->andWhere(['between','spent_at',$from,$to])
            ->all();

        $byDay = [];
        $taxSum = 0;
        foreach($rows as $r){
            $byDay[$r['spent_at']] = ($byDay[$r['spent_at']] ?? 0) + (float)$r['amount'];
            if ($r['category_id']) {
                $isTax = (new \yii\db\Query())
                    ->from('category')
                    ->where(['id'=>$r['category_id']])
                    ->select('is_tax_claimable')
                    ->scalar();
                if ($isTax) $taxSum += (float)$r['amount'];
            }
        }

        ksort($byDay);

        return $this->render('index', [
            'from'=>$from,'to'=>$to,
            'byDay'=>$byDay,
            'taxSum'=>$taxSum,
        ]);
    }
}
