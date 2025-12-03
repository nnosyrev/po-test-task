<?php

namespace console\controllers;

use common\models\Apple;
use yii\console\Controller;
use yii\console\ExitCode;

class DeleteRottenApplesController extends Controller
{
    public function actionIndex()
    {
        $oldRottenApples = Apple::findAllOldRotten();

        foreach ($oldRottenApples as $oldRottenApple) {
            $this->stdout("Removing an old rotten apple #" . $oldRottenApple->id . "...\n");
            $oldRottenApple->delete();
        }

        $this->stdout("Old rotten apples are removed.\n");

        return ExitCode::OK;
    }
}
