<?php
 
namespace app\models;
 
use Yii;
use app\models\WorkingSheet;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\QueryInterface;
 
class WorkingSheetSearch extends WorkingSheet
{
    /**
     * @inheritdoc
     */

    /* Вычисляемые аттрибуты */
    public $date;
    //public $roleName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'/*, 'phone', 'email', 'status', 'roleName'*/], 'safe'],
        ];
    }

 
    /**
     * @inheritdoc
     */
    public function search($params)
    {
        $query = WorkingSheet::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        /*if (!($this->load($params) && $this->validate())) {
            //$query->joinWith(['role']);
            return $dataProvider;
        }*/
        if (!$this->load($params, '')) {
            return $dataProvider;
        }
     
        /*$query->joinWith('role');
        $query->andWhere('name LIKE "%'.$this->name.'%"');
        $query->andWhere('phone LIKE "%'.$this->phone.'%"');
        $query->andWhere('email LIKE "%'.$this->email.'%"');
        print_r($this->roleName);
        $query->andWhere('tbl_role.title LIKE "%'.$this->roleName.'%"');
        if ($this->status !== '') $query->andWhere('status = "'.$this->status.'"');*/
        $query->andWhere('date = "'.$this->date.'"');
        return $dataProvider;
    }
 
 
}