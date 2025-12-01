<?php

namespace console\controllers;

use common\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

class CreateUserController extends Controller
{
    public function actionIndex()
    {
        $user = new User;
        $user->username = 'testuser';
        $user->email = 'mail@mail.com';
        $user->setPassword('password');
        $user->generateAuthKey();
        $user->status = User::STATUS_ACTIVE;

        if ($user->save()) {
            $this->stdout("User has been created.\n");
            return ExitCode::OK;
        }

        $this->stderr("Something went wrong.\n");
        return ExitCode::UNSPECIFIED_ERROR;
    }
}
