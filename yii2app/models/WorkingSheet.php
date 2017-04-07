<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_working_sheet".
 *
 * @property integer $id
 * @property string $date
 * @property string $doctor_ids
 */
class WorkingSheet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_working_sheet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'doctor_ids'], 'required'],
            [['date'], 'safe'],
            [['doctor_ids'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'doctor_ids' => 'Doctor Ids',
        ];
    }
}
