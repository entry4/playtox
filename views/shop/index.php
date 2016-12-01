<?php
use yii\helpers\Html;
use \yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ShopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shop';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
<?php Pjax::begin(); ?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'description:ntext',
            'price:currency',
            'amount',
            [
                'class' => \yii\grid\DataColumn::className(),
                'attribute' => '',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width:200px;'],
                'value' => function ($model) {
                    return Html::beginForm(Url::to(['/shop/buy']),'post')
                    .Html::hiddenInput('productId',$model->id)
                    .'<div class="input-group">'
                    .\kartik\touchspin\TouchSpin::widget([
                        'name' => 'quantity',
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'step' => 1,
                            'initval'=>1,
                            'min'=>1,
                            'max'=>$model->amount]
                    ])
                    .'<div class="input-group-btn">'
                    .Html::submitButton('Buy',['class'=>'btn btn-success'])
                    .'</div></div>'
                    .Html::endForm();
                },
            ]
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
