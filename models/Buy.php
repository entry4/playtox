<?php
/**
 * Created by PhpStorm.
 * User: entry4
 * Date: 30.11.16
 * Time: 14:04
 *
 */
namespace app\models;
use app\models\db\Product;
use app\models\db\Purchase;

class Buy{

    private $post;
    /**
     * @var $product Product
     */
    private $product;

    public function __construct(){
        if(\Yii::$app->request->isPost){
            $this->post=\Yii::$app->request->post();
            if($this->validate()){
                if($this->buy()){
                    \Yii::$app->session->setFlash('info','You successfully bought '.$this->post['quantity'].' '.($this->post['quantity']>1?'items':'item').' of '.$this->product->name);
                    return true;
                }
            }
        }
        \Yii::$app->session->setFlash('danger','Error!');
        return false;
    }

    private function validate(){
        if(isset($this->post['quantity'],$this->post['productId']) && $this->post['quantity']>0){
            $this->product=Product::find()->where(['id'=>$this->post['productId']])->one();
            if(isset($this->product->id)){if($this->product->amount>=$this->post['quantity']){return true;}}
        }
        return false;
    }

    private function buy(){
        $purchase=new Purchase();
        $purchase->userId=\Yii::$app->user->getId();
        $purchase->productId=$this->product->id;
        $purchase->date=(new \DateTime())->format('Y-m-d H:i:s');
        $purchase->price=$this->product->price;
        $purchase->quantity=$this->post['quantity'];
        $purchase->revenue=$this->post['quantity']*$this->product->price;
        $purchase->save();
        if(!$purchase->getErrors()){
            $this->product->amount-=$this->post['quantity'];
            $this->product->save();
            if(!$this->product->getErrors()) return true;
        }
        return false;
    }
}