<?php
namespace app\api;


use yii\base\Model;
use app\lib\helpers\ApiException;
use common\lib\helpers\Error;
use common\lib\helpers\Common;

/**
 * 基础验证服务类
 * @author Yong
 *
 */
abstract class BaseValidator
{
    /**
     * @var BaseService 服务对象
     */
    public $service;
    /**
     * @var array 请求参数
     */
    public $data;
    
    /**
     * @param Model $model
     */
    public function validate($model)
    {
        $model->load($this->data, '');
        if (!$model->validate()) {
            throw new ApiException(Error::PARAMS_ERROR, Common::getModelFirstError($model));
        }
    }
}