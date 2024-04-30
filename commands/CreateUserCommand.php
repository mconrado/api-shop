<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;

class CreateUserCommand extends Controller
{
    public function actionIndex($username, $name, $password)
    {
        $user = new User();
        $user->username = $username;
        $user->name = $name;
        $user->password_hash = Yii::$app->security->generatePasswordHash($password);

        if ($user->save()) {
            echo "Usuário criado com sucesso.\n";
        } else {
            echo "Erro ao criar usuário: " . json_encode($user->errors) . "\n";
        }
    }
}
