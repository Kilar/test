<?php
namespace app\api\v2\validators;

use app\api\BaseValidator;
use common\models\Member;
/**
 * 用户操作验证器
 * @author Yong
 *
 */
class UserValidator extends BaseValidator
{
    /**
     * 修改用户信息验证
     */
    public function update()
    {
        $user = Member::findOne(\Yii::$app->getUser()->getId());
        $user->addRules([
            [['real_name', 'mobile', 'email'], 'required'],
        ]);
        $this->validate($user);
        $this->service->model = $user;
    }
}