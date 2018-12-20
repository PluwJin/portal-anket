<?php

namespace kouosl\anket\models;

use Yii;

/**
 * This is the model class for table "survey".
 *
 * @property int $id
 * @property string $name
 * @property int $q_number
 */
class Survey extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'survey';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'q_number'], 'required'],
            [['q_number'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['name'], 'unique'],
            [['creator_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Anket Adı',
            'q_number' => 'Soru Sayısı',
            'creator_id' =>'Anketi Oluşturan'
        ];
    }
}
