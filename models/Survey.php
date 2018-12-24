<?php

namespace kouosl\anket\models;

use Yii;

/**
 * This is the model class for table "survey".
 *
 * @property int $id
 * @property string $name
 * @property int $q_number
 * @property string $creator_id
 * @property string $created_at
 * @property string $ending_at
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
            [['name', 'q_number', 'creator_id', 'created_at', 'ending_at'], 'required'],
            [['q_number'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['name'], 'unique'],
            [['creator_id'], 'integer'],
            [['created_at', 'ending_at'], 'date','format'=>'yyyy-M-d','message'=>'YYYY-AA-DD Şeklinde Giriniz'],
            ['ending_at','compare','compareAttribute'=>'created_at','operator'=>'>','enableClientValidation'=>false,'message'=>'Oluşturulma Tarihinden ileri bir tarih giriniz'],
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
            'creator_id' =>'Anketi Oluşturan',
            'created_at' => 'Oluşturulma Tarihi',
            'ending_at' => 'Bitiş Tarihi',
        ];
    }
}
