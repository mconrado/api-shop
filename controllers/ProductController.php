<?php
namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use app\models\Product;
use app\models\Customer;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class ProductController extends Controller
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

        $query = Product::find();

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

        $product = new Product();
        $product->load(Yii::$app->request->getBodyParams(), '');

        if ($product->save()) {
            return ['success' => 'Produto inserido com sucesso'];
        } else {
            $errors = $product->getErrors();
            $errorMessage = 'Erro ao cadastrar o produto';
            if (!empty($errors)) {
                $errorMessage .= ': ' . current(current($errors));
            }
            throw new BadRequestHttpException($errorMessage, 400);
        }
    }

    public function actionCustomerProducts($customerId)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $customer = Customer::findOne($customerId);

        if ($customer === null) {
            throw new NotFoundHttpException('Cliente não encontrado.');
        }

        $products = $customer->getProducts()->all();

        return $products;
    }



}