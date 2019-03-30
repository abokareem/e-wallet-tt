<?php

namespace app\modules\api\models;

use app\models\db\Currency as DBCurrency;


trait Transaction
{
    public function amountByCurrency(float $amount, DBCurrency $currencyFrom, DBCurrency $currencyTo)
    {
        $amount = $this->toUSD($amount, $currencyFrom);
        $amount = $this->fromUSD($amount, $currencyTo);

        return $amount;
    }

    public function toUSD($amount, DBCurrency $currencyFrom)
    {
        return $amount * $currencyFrom->latterQuote->quote;
    }

    public function fromUSD($amount, DBCurrency $currencyTo)
    {
        return $amount / $currencyTo->latterQuote->quote;
    }

}