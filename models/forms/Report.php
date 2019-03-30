<?php

namespace app\models\forms;

use app\models\db\Client;
use app\models\db\TransferLog;
use app\models\db\Wallet;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class Report extends Model
{
    public $clientId;
    public $walletId;
    public $timeFrom;
    public $timeTo;

    public function rules()
    {
        return [
            [['clientId'], 'required'],
            [['clientId', 'walletId', 'timeFrom', 'timeTo'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'clientId' => 'Client',
            'walletId' => 'Client Wallet',
            'timeFrom' => 'From',
            'timeTo' => 'To',
        ];
    }

    public function search(array $params)
    {
        $query = TransferLog::find()
            ->from(TransferLog::tableName() . ' tl')
            ->innerJoin(Wallet::tableName() . ' w', 'w.id = tl.wallet_from OR w.id = tl.wallet_to')
            ->innerJoin(Client::tableName() . ' c', 'c.id = w.client_id')
            ->andWhere(['w.client_id' => $this->clientId]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['>=', 'tl.time', $this->timeFrom])
            ->andFilterWhere(['<=', 'tl.time', $this->timeTo])
            ->andFilterWhere(['w.id' => $this->walletId]);

        return $dataProvider;
    }

    public function getClientList()
    {
        return ArrayHelper::map(Client::find()->all(), 'id', function ($model) {
            return "{$model->name} ({$model->country}, {$model->city})";
        });
    }

    public function getClientWalletList()
    {
        return ArrayHelper::map(Wallet::findAll(['client_id' => $this->clientId]), 'id', function ($model) {
            return "{$model->guid} ({$model->currency->name})";
        });
    }
}