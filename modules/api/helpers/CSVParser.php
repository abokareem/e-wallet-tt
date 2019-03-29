<?php

namespace app\modules\api\helpers;

use app\modules\api\models\CurrencyQuote;

class CSVParser
{
    /**
     * @param string $filePath
     * @return CurrencyQuote[]
     */
    public function parseFile($filePath)
    {
        $file = fopen($filePath, 'r');
        try {
            $models = [];
            while (!!($row = fgetcsv($file, 1000, ';')))
                $models[] = CurrencyQuote::loadModel(strtoupper($row[0]), (float)str_replace(',', '.', $row[1]));

            return $models;
        } catch (\Exception $ex) {
            return null;
        }
    }
}