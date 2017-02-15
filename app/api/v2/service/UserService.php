<?php
namespace app\api\v2\service;

use app\api\BaseService;
use app\lib\helpers\ApiException;
use common\lib\helpers\Error;
use common\lib\helpers\Common;
use common\redis\Member;
/**
 * 
 * @author Yong
 *
 */
class UserService extends BaseService
{
    /**
     * 信息修改出来接口
     * @throws ApiException
     * @return boolean
     */
    public function update()
    {
        if (!$this->model->save(false)) {
            throw new ApiException(Error::SERVER_ERROR, Common::getModelFirstError($this->model));
        } else {
            if (!Member::updateUser($this->model)) {
                throw new ApiException(Error::SERVER_ERROR, '服务器异常');
            }
        }
        return true;
    }
}