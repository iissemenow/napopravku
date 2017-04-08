<?php
 
namespace app\models;
 
use Yii;
use app\models\WorkingSheet;
use app\models\Receptions;
use app\models\Doctor;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\QueryInterface;
 
class ReceptionsSearch extends Receptions
{
    /**
     * @inheritdoc
     */

    /* Вычисляемые аттрибуты */
    public $date;
    public $time;
    public $doctorName;
    public $profession_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'doctorName', 'time', 'profession_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function search($params)
    {
        $dn = date('w', strtotime($params['date']));
        $noOldDate = ((strtotime('now') - strtotime($params['date'])) <= 86400);
        $nowMonth = date('m');
        $dateMonth = date('m', strtotime($params['date']));
        $okMonth = ($dateMonth + (($dateMonth < $nowMonth)?(12):(0)) - $nowMonth < 2);
        
        if ($dn != 6 && $dn != 0 && $noOldDate && $okMonth &&
            Receptions::find()
            ->andWhere('date = "'.$params['date'].'"')
            ->count() == 0) {
            Receptions::addDay($params['date']);
        }
        $query = Receptions::find()
            ->andWhere('date = "'.$params['date'].'"')
            ->andWhere('"'.$params['date'].'" >= CURDATE()')
            ->andWhere('(user_id = 0 OR user_id = '.Yii::$app->user->identity->id.')')
            ->joinWith('doctor');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);

        $query->andWhere('tbl_doctor.name LIKE "%'.$params['ReceptionsSearch']['doctorName'].'%"');
        if ($params['profession_id'] != 0)
            $query->andWhere('tbl_doctor.profession_id = "'.$params['profession_id'].'"');
        $query->andWhere('time LIKE "%'.$params['ReceptionsSearch']['time'].'%"');
        return $dataProvider;
    }
 
 
}