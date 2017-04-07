<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use app\models\WorkingSheetSearch;
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
        if (!isset($params['date'])) $params['date'] = date('Y-m-d');
        $searchModel = new WorkingSheetSearch();
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
    public function actionAccess($id)
    {
        $model = User::findOne($id);
        $model->role_id = User::ROLE_ADMIN;
        if ($model->save()) return $this->redirect('edit');
        else throw new HttpException(404);

    }

}
