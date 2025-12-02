<?php

namespace backend\controllers;

use common\enums\AppleColor;
use common\models\Apple;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

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
                        'actions' => ['list', 'create', 'drop', 'eat'],
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
        $apples = Apple::findAllNotRotten();

        return $this->render('list', [
            'apples' => $apples,
            'dataProvider' => new ArrayDataProvider(['allModels' => $apples])
        ]);
    }

    /**
     * Create apples.
     *
     * @return Response
     */
    public function actionCreate()
    {
        $count = mt_rand(5, 10);

        for ($i = 0; $i < $count; $i++) {
            Apple::create(AppleColor::random());
        }

        return $this->redirect(['apple/list']);
    }

    /**
     * Drope an apple
     *
     * @return Response
     */
    public function actionDrop(int $id)
    {
        $apple = Apple::findOneOrFail($id);

        $apple->drop();

        return $this->redirect(['apple/list']);
    }

    /**
     * Eat an apple.
     *
     * @return Response
     */
    public function actionEat(int $id)
    {
        $apple = Apple::findOneOrFail($id);

        $apple->eat(Yii::$app->request->post('percent'));

        //Yii::$app->session->setFlash('error', "Data2 failed!");

        return $this->redirect(['apple/list']);
    }
}
