<?php
namespace app\api;

use yii\db\BaseActiveRecord;
/**
 * 基础服务类
 * @author Yong
 *
 */
abstract class BaseService
{
    /**
     * @var BaseActiveRecord
     */
    public $model;
    
    static $instance;
    
    public static function getInstance()
    {
        if (self::$instance) {
            return self::$instance;
        } 
        return (new static());
    }
    
}