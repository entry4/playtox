<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PurchaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Purchases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-index">
    <h1><?= Html::encode($this->title) ?></h1>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => \yii\grid\DataColumn::className(),
                'attribute' => 'username',
                'format' => 'html',
                'value' => function ($model) {return Html::a($model->user->username,Url::toRoute(['/user/admin/index','UserSearch[username]'=>$model->user->username]),['title'=>'User Details']);},
            ],
            [
                'class' => \yii\grid\DataColumn::className(),
                'attribute' => 'productName',
                'format' => 'html',
                'value' => function ($model) {return Html::a($model->product->name,Url::toRoute(['/product/view','id'=>$model->product->id]),['title'=>'Product Details']);},
            ],
            'date:dateTime',
            [
                'class' => \yii\grid\DataColumn::className(),
                'attribute' => 'price',
                'format'=>'currency',
                'contentOptions' => ['style' => 'width:100px;']
            ],
            [
                'class' => \yii\grid\DataColumn::className(),
                'attribute' => 'quantity',
                'contentOptions' => ['style' => 'width:50px;']
            ],
            'revenue:currency',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
<?php Pjax::end(); ?></div>
