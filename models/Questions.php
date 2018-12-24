<?php

namespace kouosl\anket\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property int $s_id
 * @property string $name
 * @property string $type
 * @property string $required
 * @property int $option_number
 *
 * @property Survey $s
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['s_id', 'option_number'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['required'], 'string', 'max' => 10],
            [['type'], 'string', 'max' => 50],
            [['s_id', 'name'], 'unique', 'targetAttribute' => ['s_id', 'name']],
            [['s_id'], 'exist', 'skipOnError' => true, 'targetClass' => Survey::className(), 'targetAttribute' => ['s_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            's_id' => 'Anket ID:',
            'name' => 'Soruyu Giriniz:',
            'type' => 'Tipini Giriniz',
            'required' => 'Required',
            'option_number' => 'Option Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getS()
    {
        return $this->hasOne(Survey::className(), ['id' => 's_id']);
    }
}
