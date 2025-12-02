<?php

namespace backend\controllers;

use common\enums\AppleColor;
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
        $apples = Apple::find()
            //->where(['status' => 'hanging'])
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
            $apple->color = AppleColor::random();
            $apple->size = '1.00';
            $apple->status = Apple::STATUS_HANGING;

            $apple->save();
        }

        echo 'create...'; exit;
        return $this->render('list');
    }

    /**
     * Drope an apple
     *
     * @return string
     */
    public function actionDrop()
    {
        $id = Yii::$app->request->post('Apple')['id'];

        $apple = Apple::findOneOrFail($id);
        $apple->status = Apple::STATUS_DROPPED;
        $apple->fall_at = time();

        if ($apple->save()) {
            return $this->redirect(['apple/list']);
        }

        throw new \Exception('Something went wrong.');
    }

    /**
     * Eat an apple.
     *
     * @return string
     */
    public function actionEat(int $id)
    {
        $apple = Apple::findOneOrFail($id);

        $percent = Yii::$app->request->post('percent');

        $apple->size = $apple->size - (float) $percent;

        if ($apple->save()) {
            return $this->redirect(['apple/list']);
        }

        throw new \Exception('Something went wrong.');
    }
}
