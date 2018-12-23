<?php

namespace kouosl\anket\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property int $s_id
 * @property int $q_id
 * @property string $name
 *
 * @property Questions $q
 * @property Survey $s
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['s_id', 'q_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['s_id', 'q_id', 'name'], 'unique', 'targetAttribute' => ['s_id', 'q_id', 'name']],
            [['q_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['q_id' => 'id']],
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
            'q_id' => 'Soru ID:',
            'name' => 'Seçeneği Giriniz:',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQ()
    {
        return $this->hasOne(Questions::className(), ['id' => 'q_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getS()
    {
        return $this->hasOne(Survey::className(), ['id' => 's_id']);
    }
}
