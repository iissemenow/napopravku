<?php

namespace app\models;

use Yii;
use app\models\WorkingSheet;
use app\models\Doctor;

/**
 * This is the model class for table "tbl_receptions".
 *
 * @property integer $id
 * @property string $date
 * @property string $time
 * @property integer $doctor_id
 * @property integer $user_id
 */
class Receptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_receptions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'time', 'doctor_id', 'user_id'], 'required'],
            [['date'], 'safe'],
            [['doctor_id', 'user_id'], 'integer'],
            [['time'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'time' => 'Время',
            'doctor_id' => 'Врач',
            'doctorName' => 'Врач',
            'user_id' => 'User ID',
        ];
    }

    public function getDoctor() {
        return $this->hasOne(Doctor::className(), ['id' => 'doctor_id']);
    }

    public function getDoctorName() {
        return $this->doctor->name;
    }

    public static function firstZero($num) {
        return (($num < 10)?('0'.$num):($num));
    }

    public static function stringToTimes($start, $end) {
        $times = array();
        for ($i = $start[0] * 1; $i <= $end[0]; $i++) {
            for ($m = 0; $m < 60; $m += 15) {
                if ($i == $end[0] && $m >= $end[1]) break;
                $times[] = static::firstZero($i).'.'.static::firstZero($m);
            }
        }
        return $times;
    }

    public static function wsToArray($ws) {
        $intervals = explode('+', $ws);
        $times = array();
        foreach ($intervals as $val) {
            $time = explode('-', $val);
            $times = array_merge($times, static::stringToTimes(explode('.', $time[0]), explode('.', $time[1])));
        }
        return $times;
    }

    public static function addDay($date) {
        $doctors = WorkingSheet::findOne(['date' => $date])['doctor_ids'];
        $doctors = json_decode($doctors, true);
        $rows = array();
        foreach ($doctors as $doctor_id => $doctor_working_sheet) {
            $times = static::wsToArray($doctor_working_sheet);
            foreach ($times as $time)
                $rows[] = [
                    'date' => $date,
                    'time' => $time,
                    'doctor_id' => $doctor_id
                    ];
        }
        Yii::$app->db->createCommand()->batchInsert(
            'tbl_receptions',
            ['date', 'time', 'doctor_id'],
            $rows)->execute();
    }
}
