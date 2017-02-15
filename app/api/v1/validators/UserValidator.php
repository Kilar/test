<?php
namespace app\api\v1\validators;

use app\api\BaseValidator;
use common\models\Member;
use app\lib\helpers\ApiException;
use common\lib\helpers\Error;
/**
 * 用户操作验证器
 * @author Yong
 *
 */
class UserValidator extends BaseValidator
{
    /**
     * 注册行为验证操作
     */
    public function register()
    {
        $user = new Member();
        $user->addRules([
            [['username', 'password'], 'required'],
        ]);
        $this->validate($user);
        $this->service->model = $user;
    }
    
    /**
     * 注册行为验证操作
     */
    public function login()
    {
        $user = Member::findOne(['username' => trim($this->data['username'] ?? '')]);
        if (!$user) {
            throw new ApiException(Error::INFO_NOTFOUND, '用户不存在');
        } else if (!$user->validatePassword(trim($this->data['password'] ?? ''))) {
            throw new ApiException(Error::LOGIN_FAIL, '账号或者密码不存在');
        }
        $this->service->model = $user;
    }
    
    /**
     * 获取用户信息验证
     */
    public function getInfo()
    {
        $this->service->model = \Yii::$app->getUser()->getIdentity();
    }
    
}