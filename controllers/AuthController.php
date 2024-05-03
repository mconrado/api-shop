<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\User;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        $user = User::findByUsername($username);

        if ($user && $user->validatePassword($password))
        {

            $token = Yii::$app->security->generateRandomString();
            Yii::$app->response->headers->set('Authorization', 'Bearer ' . $token);
            Yii::$app->cache->set('user_' . $token, $user, 120);
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return ['success' => 'Usuário autenticado com sucesso!'];
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['error' => 'Usuário ou senha inválidos'];
        }
    }
}
