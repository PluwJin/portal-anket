<?php

namespace kouosl\anket\models;

use Yii;
use kouosl\user\models\User;

/**
 * This is the model class for table "answers".
 *
 * @property int $id
 * @property int $user_id
 * @property int $s_id
 * @property int $q_id
 * @property int $o_id
 * @property string $textanswer
 * 
 * 
 *
 * @property Options $o
 * @property Questions $q
 * @property Survey $s
 * @property User $user
 */
class Answers extends \yii\db\ActiveRecord
{
    public $items;
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 's_id', 'q_id'], 'required'],
            [['user_id', 's_id', 'q_id', 'o_id'], 'integer'],
            [['textanswer'], 'string', 'max' => 100],
            [['user_id', 's_id', 'q_id','o_id'], 'unique', 'targetAttribute' => ['user_id', 's_id', 'q_id','o_id']],
            [['o_id'], 'exist', 'skipOnError' => false, 'targetClass' => Options::className(), 'targetAttribute' => ['o_id' => 'id']],
            [['q_id'], 'exist', 'skipOnError' => false, 'targetClass' => Questions::className(), 'targetAttribute' => ['q_id' => 'id']],
            [['s_id'], 'exist', 'skipOnError' => false, 'targetClass' => Survey::className(), 'targetAttribute' => ['s_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => false, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            's_id' => 'S ID',
            'q_id' => 'Q ID',
            'o_id' => 'O ID',
            'textanswer' => 'Textanswer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getO()
    {
        return $this->hasOne(Options::className(), ['id' => 'o_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
