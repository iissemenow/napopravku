<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_last_update".
 *
 * @property string $date
 * @property string $time
 */
class LastUpdate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_last_update';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['date', 'time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Date',
            'time' => 'Time',
        ];
    }
}
