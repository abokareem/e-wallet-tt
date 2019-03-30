<?php

namespace app\modules\api\models;

use app\modules\api\helpers\CSVParser;
use app\modules\api\helpers\JSONParser;
use yii\base\Model;

class Currency extends Model
{
    public $file;
    public $date;

    public function rules()
    {
        return [
            [['date'], 'required'],
            [['date'], 'date', 'format' => 'yyyy-M-d'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => ['csv', 'json'], 'checkExtensionByMimeType' => false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'date' => 'Date',
            'file' => 'File',
        ];
    }

    public function tryLoad()
    {
        if (!$this->validate())
            return false;

        if (!($currencyQuotes = $this->parseFile())) {
            $this->addError('file', 'File parse exception');
            return false;
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            foreach ($currencyQuotes as $model)
                $model->save($this->date);
            $transaction->commit();
            return true;
        } catch (\Exception $ex) {
            $this->addError('file', $ex->getMessage());
            $transaction->rollBack();
        }
        return false;
    }

    private function parseFile()
    {
        if ($this->file->extension === 'csv') {
            $parser = new CSVParser();
        } else {
            $parser = new JSONParser();
        }

        return $parser->parseFile($this->file->tempName);
    }

}