<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_profession".
 *
 * @property integer $id
 * @property string $name
 */
class Profession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profession';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => 'Name',
        ];
    }

    public static function allProfessions() {
        $allProf = static::find()->all();
        $arrProf = array();
        foreach ($allProf as $oneProf) {
            $arrProf[$oneProf['id']] = $oneProf['name'];
        }
        return $arrProf;
    }
}
