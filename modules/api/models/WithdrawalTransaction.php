<?php

namespace app\modules\api\models;

use app\models\db\TransferLog;
use app\models\db\Wallet;
use Exception;
use Yii;
use yii\base\Model;
use yii\helpers\Json;

class WithdrawalTransaction extends Model
{
    use Transaction;

    public $amount;
    public $from;
    public $to;
    public $correctAmount;
    /** @var Wallet */
    public $walletFrom;
    /** @var Wallet */
    public $walletTo;
    /** @var TransferLog */
    public $log;

    public function rules()
    {
        return [
            [['amount', 'from', 'to'], 'required'],
            [['amount'], 'number'],
            [['from'], 'exist', 'targetClass' => Wallet::class, 'targetAttribute' => 'guid'],
            [['to'], 'exist', 'targetClass' => Wallet::class, 'targetAttribute' => 'guid'],
            [['from', 'to'], function () {
                if ($this->from === $this->to)
                    $this->addError('from', 'Incorrect guid');
            }],
        ];
    }

    public function attributeLabels()
    {
        return [
            'amount' => 'Amount',
            'from' => 'Wallet From',
            'to' => 'Wallet To',
        ];
    }

    public function afterValidate()
    {
        parent::afterValidate();

        $this->walletFrom = Wallet::findOne(['guid' => $this->from]);
        $this->walletTo = Wallet::findOne(['guid' => $this->to]);
    }


    public function transact()
    {
        if (!$this->validate())
            return false;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($this->walletFrom->currency_id !== $this->walletTo->currency_id)
                $this->correctAmount = $this->amountByCurrency((float)$this->amount, $this->walletFrom->currency, $this->walletTo->currency);
            else
                $this->correctAmount = (float)$this->amount;

            $this->saveTransactionLog();
            $this->updateWalletToBalance();
            $this->updateWalletFromBalance();

            $transaction->commit();
            return true;
        } catch (Exception $ex) {
            $transaction->rollBack();
        }
        return false;
    }

    private function saveTransactionLog()
    {
        $this->log = new TransferLog();
        $this->log->amount_in_usd = $this->toUSD($this->amount, $this->walletFrom->currency);
        $this->log->amount = $this->correctAmount;
        $this->log->wallet_from = $this->walletFrom->id;
        $this->log->wallet_to = $this->walletTo->id;
        $this->log->info = Json::encode([
            'amount' => (float)$this->amount,
            'amount_in_usd' => $this->log->amount_in_usd,
            'amount_in_end' => $this->correctAmount,
            'currency_from' => $this->walletFrom->currency->name,
        ]);
        $this->log->save();
    }

    private function updateWalletToBalance()
    {
        $this->walletTo->balance += $this->correctAmount;
        $this->walletTo->save();
    }

    private function updateWalletFromBalance()
    {
        $this->walletFrom->balance -= $this->amount;

        if ($this->walletFrom->balance <= 0) {
            $this->addError('from', 'Account has insufficient funds');
            throw new \yii\db\Exception('Account has insufficient funds');
        }
        $this->walletFrom->save();
    }
}