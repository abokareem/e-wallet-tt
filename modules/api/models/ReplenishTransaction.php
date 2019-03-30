<?php

namespace app\modules\api\models;

use app\models\db\Currency as DBCurrency;
use app\models\db\TransferLog;
use app\models\db\Wallet;
use Exception;
use Yii;
use yii\base\Model;
use yii\helpers\Json;

class ReplenishTransaction extends Model
{
    use Transaction;

    public $amount;
    public $correctAmount;
    public $currency;
    /** @var DBCurrency */
    public $currencyFrom;
    /** @var Wallet */
    public $wallet;
    /** @var TransferLog */
    public $log;

    public function rules()
    {
        return [
            [['amount', 'currency'], 'required'],
            [['amount'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'amount' => 'Amount',
            'currency' => 'Currency',
            'wallet' => 'Wallet',
        ];
    }

    public function transact()
    {
        if (!$this->validate())
            return false;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->currencyFrom = DBCurrency::getCurrencyByName($this->currency);
            if (strtoupper($this->currency) !== $this->wallet->currency->name)
                $this->correctAmount = $this->amountByCurrency((float)$this->amount, $this->currencyFrom, $this->wallet->currency);
            else
                $this->correctAmount = (float)$this->amount;

            $this->saveTransactionLog();
            $this->updateWalletBalance();

            $transaction->commit();
            return true;
        } catch (Exception $ex) {
            $this->addError('currency', $ex->getMessage());
            $transaction->rollBack();
        }
        return false;
    }

    private function saveTransactionLog()
    {
        $this->log = new TransferLog();
        $this->log->amount_in_usd = $this->toUSD($this->amount, $this->currencyFrom);
        $this->log->amount = $this->correctAmount;
        $this->log->wallet_from = -1;
        $this->log->wallet_to = $this->wallet->id;
        $this->log->info = Json::encode([
            'amount' => (float)$this->amount,
            'amount_in_usd' => $this->log->amount_in_usd,
            'amount_in_end' => $this->correctAmount,
            'currency_from' => $this->currencyFrom->name,
        ]);
        $this->log->save();
    }

    private function updateWalletBalance()
    {
        $this->wallet->balance += $this->correctAmount;
        $this->wallet->save();
    }
}