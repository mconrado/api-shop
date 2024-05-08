<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use app\models\Customer;
use yii\web\BadRequestHttpException;

class CustomerController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\HttpBearerAuth::className(),
        ];
        return $behaviors;
    }

    public function actionIndex($page = 1)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $query = Customer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
                'page' => $page - 1,
            ],
        ]);

        return $dataProvider;
    }

    public function actionSave()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $customer = new Customer();
        $customer->load(Yii::$app->request->getBodyParams(), '');

        if ($customer->save()) {
            return ['success' => 'Cliente cadastrado!'];
        } else {
            $errors = $customer->getErrors();
            $errorMessage = 'Erro ao inserir cliente.';
            if (!empty($errors)) {
                $errorMessage .= ': ' . current(current($errors));
            }
            throw new BadRequestHttpException($errorMessage, 400);
        }
    }
}