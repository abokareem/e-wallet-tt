<?php

namespace app\modules\api\helpers;

use app\modules\api\models\CurrencyQuote;
use yii\helpers\Json;

class JSONParser
{
    /**
     * @param string $filePath
     * @return CurrencyQuote[]
     */
    public function parseFile($filePath)
    {
        $fileData = file_get_contents($filePath);
        try {
            $data = Json::decode($fileData);

            return array_map(function ($row) {
                return CurrencyQuote::loadModel(strtoupper($row[0]), (float)$row[1]);
            }, $data);
        } catch (\Exception $ex) {
            return null;
        }
    }
}