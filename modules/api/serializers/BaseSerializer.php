<?php

namespace app\modules\api\serializers;

use Exception;
use yii\base\Model;
use yii\data\BaseDataProvider;
use yii\db\ActiveRecord;

/**
 * Class BaseSerializer
 * @property string $model
 * @property Model | BaseDataProvider $data
 * @package api\serializers
 */
abstract class BaseSerializer
{
    public $model;
    public $attributes = null;
    public $is_many = false;

    protected $data;
    protected $serialized_data;
    protected $_meta = null;

    public function __construct($data, $is_many = false)
    {
        $this->data = $data;
        $this->is_many = $is_many;

        if ($this->is_many) {
            if (!($this->data instanceof BaseDataProvider))
                throw new Exception('Instance data must be an `DataProvider` type');
            else
                $this->setMeta();
        } else {
            if (!($this->data instanceof $this->model))
                throw new Exception('Instance model invalid');
        }

        $this->checkAttributes();
        $this->serialize();
    }

    public function getData()
    {
        return [
            'data' => $this->serialized_data,
            '_meta' => $this->_meta,
        ];
    }

    protected function serialize()
    {
        $this->serialized_data = [];
        if ($this->is_many) {
            $i = 0;
            foreach ($this->data->getModels() as $model) {
                foreach ($this->attributes as $attribute)
                    $this->serialized_data[$i][$attribute] = $this->getDataValue($model, $attribute);
                $i++;
            }
        } else {
            foreach ($this->attributes as $attribute)
                $this->serialized_data[$attribute] = $this->getDataValue($this->data, $attribute);
        }
    }

    protected function setMeta()
    {
        $this->_meta = $this->data->pagination;
    }

    private function checkAttributes()
    {
        /** @var ActiveRecord $model */
        $model = new $this->model;
        if ($this->attributes === null)
            $this->attributes = array_keys($model->attributeLabels());
        else
            foreach ($this->attributes as $attribute)
                if (!$model->hasProperty($attribute) && !$this->hasMethod($attribute))
                    throw new Exception("Model `{$this->model}` class has no attribute `{$attribute}`");
    }

    private function hasMethod($attribute)
    {
        $methodName = $this->getMethodName($attribute);
        return method_exists($this, $methodName);
    }

    private function getDataValue($model, $attribute)
    {
        if ($this->hasMethod($attribute))
            return $this->getDataValueFromMethod($model, $attribute);
        return $model->{$attribute};
    }

    private function getDataValueFromMethod($model, $attribute)
    {
        $methodName = $this->getMethodName($attribute);
        return $this->{$methodName}($model);
    }

    private function getMethodName($attribute)
    {
        return 'get' . ucfirst($attribute);
    }
}