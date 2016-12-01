<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "purchase".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $productId
 * @property string $date
 * @property double $price
 * @property integer $quantity
 * @property double $revenue
 *
 * @property User $user
 * @property Product $product
 */
class Purchase extends \yii\db\ActiveRecord{
    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'purchase';
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['userId', 'productId', 'date', 'price', 'quantity'], 'required'],
            [['userId', 'productId', 'quantity'], 'integer'],
            [['date'], 'safe'],
            [['price','revenue'], 'number'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'productId' => 'Product ID',
            'date' => 'Date',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'username' => 'Username',
            'productName' => 'Product Name',
            'revenue'=>'Revenue'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getUsername(){
        return $this->user->username;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct(){
        return $this->hasOne(Product::className(), ['id' => 'productId']);
    }

    public function getProductName(){
        return $this->product->name;
    }
}
