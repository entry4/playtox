<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\Purchase;

/**
 * PurchaseSearch represents the model behind the search form about `app\models\db\Purchase`.
 */
class PurchaseSearch extends Purchase{

    public $username;
    public $productName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userId', 'productId', 'quantity'], 'integer'],
            [['date'], 'safe'],
            [['price','revenue'], 'number'],
            [['username','productName'],'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
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
     *
     * @return ActiveDataProvider
     */
    public function search($params){
        $query = Purchase::find()->joinWith(['user','product']);

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $dataProvider->setSort([
            'attributes' => array_merge(
                [
                    'username' =>
                        [
                            'asc' => ['user.username' => SORT_ASC],
                            'desc' => ['user.username' => SORT_DESC],
                            'label' => 'Username'],
                    'productName' =>
                        [
                            'asc' => ['product.name' => SORT_ASC],
                            'desc' => ['product.name' => SORT_DESC],
                            'label' => 'Product Name'],

                ],$dataProvider->getSort()->attributes)
        ]);

        $this->load($params);

        if (!$this->validate()) return $dataProvider;

        $query->andFilterWhere([
            'id' => $this->id,
            'username'=>$this->username,
            'product.name'=>$this->productName,
            'userId' => $this->userId,
            'productId' => $this->productId,
            'date' => $this->date,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'revenue'=>$this->revenue
        ]);

        return $dataProvider;
    }
}
