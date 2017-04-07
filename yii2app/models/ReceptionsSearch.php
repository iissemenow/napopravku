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
            [['date', 'doctorName', 'time', 'profession_id'/*, 'phone', 'email', 'status', 'roleName'*/], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function search($params)
    {
        //$query = WorkingSheet::find();
        //print_r(WorkingSheet::find()->andWhere('date = "'.$params['date'].'"')->count());
        //print_r(date('w', strtotime($params['date']))); exit();
        $dn = date('w', strtotime($params['date']));
        
        if ($dn != 6 && $dn != 0 &&
            Receptions::find()
            ->andWhere('date = "'.$params['date'].'"')
            ->count() == 0) {
            Receptions::addDay($params['date']);
        }
        $query = Receptions::find()
            ->andWhere('date = "'.$params['date'].'"')
            ->andWhere('"'.$params['date'].'" >= CURDATE()')
            ->joinWith('doctor');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
        /*if (!($this->load($params) && $this->validate())) {
            //$query->joinWith(['role']);
            return $dataProvider;
        }
        if (!$this->load($params, '')) {
            return $dataProvider;
        }*/

        $query->andWhere('tbl_doctor.name LIKE "%'.$params['ReceptionsSearch']['doctorName'].'%"');
        if ($params['ReceptionsSearch']['profession_id'] !== '')
            $query->andWhere('tbl_doctor.profession_id = "'.$params['ReceptionsSearch']['profession_id'].'"');
        $query->andWhere('time LIKE "%'.$params['ReceptionsSearch']['time'].'%"');
        //$query = $query->join('CROSS JOIN', 'tbl_receptions', 'tbl_receptions.date = "'.$this->date.'"');
     
        /*$query->joinWith('role');
        $query->andWhere('name LIKE "%'.$this->name.'%"');
        $query->andWhere('phone LIKE "%'.$this->phone.'%"');
        $query->andWhere('email LIKE "%'.$this->email.'%"');
        print_r($this->roleName);
        $query->andWhere('tbl_role.title LIKE "%'.$this->roleName.'%"');
        if ($this->status !== '') $query->andWhere('status = "'.$this->status.'"');*/
        //$query->andWhere('tbl_working_sheet.date = "'.$this->date.'"');
        //$query->andWhere('"'.$params['date'].'" >= CURDATE()');
        return $dataProvider;
    }
 
 
}