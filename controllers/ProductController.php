<?php
namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use app\models\Product;
use yii\web\BadRequestHttpException;

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


}