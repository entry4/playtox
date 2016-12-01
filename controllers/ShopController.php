<?php

namespace app\controllers;

use app\models\Buy;
use Yii;
use app\models\ShopSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

class ShopController extends Controller{
    public function beforeAction($action){
        if(parent::beforeAction($action)) if(!\Yii::$app->user->isGuest) return true;
        throw (new ForbiddenHttpException('You are not allowed to perform this action'));
    }
    /**
     * @inheritdoc
     */
    public function behaviors(){
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionBuy(){
        new Buy();
        return $this->redirect(['index']);
    }


    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex(){
        $searchModel = new ShopSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
