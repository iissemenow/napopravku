<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_doctor".
 *
 * @property integer $id
 * @property string $name
 * @property integer $profession_id
 */
class Doctor extends \yii\db\ActiveRecord
{

    //public $name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_doctor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'profession_id'], 'required'],
            [['profession_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Врач',
            'profession_id' => 'Profession ID',
        ];
    }
}
