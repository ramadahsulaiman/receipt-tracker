<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Receipt;
use app\models\Category;
/**
 * ReceiptSearch represents the model behind the search form of `app\models\Receipt`.
 */
class ReceiptSearch extends Receipt
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_id'], 'integer'],
            [['amount'], 'number'],
            [['currency', 'spent_at', 'vendor', 'notes', 'cloud_public_id', 'cloud_url', 'status', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */


    public function search($params, $formName = null)
    {
        // only show current user’s receipts
        $query = Receipt::find()
            ->joinWith('category') // join category table
            ->where(['receipt.user_id' => \Yii::$app->user->id])
            ->orderBy(['spent_at' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // if validation fails, show all user records (you can uncomment below to show none)
            // $query->where('0=1');
            return $dataProvider;
        }

        // Filtering
        $query->andFilterWhere([
            // 'id' => $this->id,
            'receipt.category_id' => $this->category_id,
            'amount' => $this->amount,
        ]);

        // Exact date match (optional: could also use a range filter)
        if (!empty($this->spent_at)) {
            $query->andWhere(['DATE(spent_at)' => $this->spent_at]);
        }

        // Text-based search
        $query->andFilterWhere(['like', 'vendor', $this->vendor])
              ->andFilterWhere(['like', 'currency', $this->currency])
              ->andFilterWhere(['like', 'notes', $this->notes])
              ->andFilterWhere(['like', 'status', $this->status]);
              
        return $dataProvider;
    }
}
