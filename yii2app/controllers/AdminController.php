<?php

namespace app\controllers;

use Yii;
use app\models\ReceptionsSearch;
use app\models\Receptions;
use app\models\LastUpdate;
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
        if ($model->user_id > 0) return false;
        $model->user_id = Yii::$app->user->identity->id;
        $this->actionLastUpdateWrite($model->date);
        $model->save();
        return true;

    }

    public function actionLastUpdateWrite($date)
    {
        Yii::$app->db->createCommand()->delete(
            'tbl_last_update',
            ['date' => $date])->execute();
        Yii::$app->db->createCommand()->insert(
            'tbl_last_update',
            ['date' => $date])->execute();
    }

    public function actionCheck($date)
    {
        $time = date("Y-m-d H:i:s", time() - 90);
        $res = false;
        $lastUpdate = LastUpdate::find()
            ->andWhere('date = "'.$date.'"')
            ->andWhere('time > "'.$time.'"')
            ->one();
        if ($lastUpdate) $res = true;
        print_r(json_encode(array('res' => $res)));
    }

}
