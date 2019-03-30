<?php

namespace app\models\db;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string $name
 * @property CurrencyQuote $latterQuote
 */
class Currency extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @param string $name
     * @return Currency|null
     */
    public static function getCurrencyByName($name)
    {
        return self::findOne(['name' => strtoupper($name)]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'unique'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getLatterQuote()
    {
        return $this->hasOne(CurrencyQuote::class, ['currency_id' => 'id'])
            ->andWhere(['<=', 'date', date('Y-m-d')])
            ->orderBy(['id' => SORT_DESC]);
    }
}
