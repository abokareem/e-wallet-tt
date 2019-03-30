<?php

namespace app\models\db;

/**
 * This is the model class for table "currency_quote".
 *
 * @property int $id
 * @property string $date
 * @property int $currency_id
 * @property double $quote
 * @property Currency $currency
 */
class CurrencyQuote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency_quote';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['currency_id', 'quote'], 'required'],
            [['currency_id'], 'integer'],
            [['quote'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'currency_id' => 'Currency ID',
            'quote' => 'Quote',
        ];
    }

    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }
}
