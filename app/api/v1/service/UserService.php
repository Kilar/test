<?php
namespace app\api\v1\service;

use app\api\BaseService;
use app\lib\helpers\ApiException;
use common\lib\helpers\Error;
use common\lib\helpers\Common;
use common\lib\helpers\Status;
use common\lib\helpers\Des3;
use common\redis\Member;
/**
 * 
 * @author Yong
 *
 */
class UserService extends BaseService
{
    /**
     * 注册操作处理接口
     */
    public function register()
    {
        $this->setTokenKey();
        $this->model->setPassword();
        $this->model->status = Status::ACTIVE;
        if (!$this->model->save(false)) {
            throw new ApiException(Error::SERVER_ERROR, Common::getModelFirstError($this->model));
        } else {
            if (!Member::createUser($this->model)) {
                throw new ApiException(Error::SERVER_ERROR, '服务器异常');
            }
        }
        return $this->getTokenKey();
    }
    
    /**
     * 登录操作处理接口
     */
    public function login()
    {   
        $this->setTokenKey();
        if (!$this->model->save(false)) {
            throw new ApiException(Error::SERVER_ERROR, Common::getModelFirstError($this->model));
        } else {
            if (!Member::updateUser($this->model)) {
                throw new ApiException(Error::SERVER_ERROR, '服务器异常');
            }
        }
        return $this->getTokenKey();
    }
    
    /**
     * 设置用户access_token和auth_key
     */
    public function setTokenKey()
    {
        $this->model->generateAuthKey();
        $this->model->generateAccessToken();
    }
    
    /**
     * 获取用户access_token和auth_key
     */
    public function getTokenKey()
    {
        if (empty($this->model)) {
            $this->model = \Yii::$app->getUser()->getIdentity();
        }
        
        $des3 = new Des3(); //对称加密类
        return [
            'key' => $des3->encrypt($this->model->auth_key),
            'token' => $this->model->access_token,
        ];
    }
   
    
    /**
     * 获取用户信息验证
     */
    public function getInfo()
    {
        if (empty($this->model)) {
            $this->model = \Yii::$app->getUser()->getIdentity();
        }
        
        return $this->model->toArray([
            'id', 'username', 'real_name', 'mobile', 'email',
        ]);
    }
   
}