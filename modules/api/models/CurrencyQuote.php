<?php

namespace app\modules\api\models;

use app\models\db\Currency as DBCurrency;
use app\models\db\CurrencyQuote as DBCurrencyQuote;
use yii\base\InvalidArgumentException;
use yii\base\Model;

class CurrencyQuote extends Model
{
    public $currency;
    public $currency_id;
    public $quote;

    public static function loadModel($currency, $quote)
    {
        $model = new self;
        $model->currency = $currency;
        $model->quote = $quote;

        if (($dbCurrency = DBCurrency::getCurrencyByName($currency)) !== null)
            $model->currency_id = $dbCurrency->id;
        else
            throw new InvalidArgumentException();

        if (!$model->validate())
            throw new InvalidArgumentException();

        return $model;
    }

    public function rules()
    {
        return [
            [['currency', 'currency_id', 'quote'], 'required'],
            [['quote'], 'number'],
            [['currency_id'], 'integer'],
            [['currency'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'currency' => 'Currency',
            'quote' => 'Quote',
        ];
    }

    public function save($date)
    {
        $model = new DBCurrencyQuote();
        $model->currency_id = $this->currency_id;
        $model->quote = $this->quote;
        $model->date = $date;

        $model->save(false);
    }

}