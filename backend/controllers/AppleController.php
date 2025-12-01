<?php

namespace backend\controllers;

use common\models\Apple;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Apple controller
 */
class AppleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['list', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays apples.
     *
     * @return string
     */
    public function actionList()
    {
        $apples = Apple::find()
            ->where(['status' => 'hanging'])
            ->all();

        return $this->render('list', [
            'apples' => $apples,
            'dataProvider' => new ArrayDataProvider(['allModels' => $apples])
        ]);
    }

    /**
     * Create apples.
     *
     * @return string
     */
    public function actionCreate()
    {
        $count = mt_rand(5, 10);

        for ($i = 0; $i < $count; $i++) {
            $apple = new Apple();
            $apple->color = 'red';
            $apple->size = 5;
            $apple->percent = 25;
            $apple->status = 'hanging';

            $apple->save();
        }

        echo 'create...'; exit;
        return $this->render('list');
    }
}
