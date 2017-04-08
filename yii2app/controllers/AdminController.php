<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use app\models\ReceptionsSearch;
use app\models\Receptions;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AdminController implements the CRUD actions for User model.
 */
class AdminController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['reception'],
                'rules' => [
                    [
                        'actions' => ['reception'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionReception()
    {

        $params = Yii::$app->request->post();
        //$params = Yii::$app->request->queryParams;
        if (!isset($params['date'])) $params['date'] = date('Y-m-d');
        $searchModel = new ReceptionsSearch();
        $dataProvider = $searchModel->search($params);

        return $this->render('reception', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionWrite($id)
    {
        $model = Receptions::findOne($id);
        $model->user_id = Yii::$app->user->identity->id;
        $model->save();
        return true;

    }

}
