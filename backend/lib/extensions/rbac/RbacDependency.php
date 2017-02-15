<?php
namespace backend\lib\extensions\rbac;

use Yii;
use yii\caching\Dependency;
/**
 * rbac缓存依赖类 。
 * 当rbac权限发生变化的时候，会向redis缓存一个rbac修改时间，如果在
 * rbac权限模块用到缓存，可以实例化此类，然后传入set方法作为依赖参数，
 * 那么当rbac权限模块权限修改，你所写方法用的缓存也会重新加载
 * @author Yong
 */
class RbacDependency extends Dependency
{
    public $cachekey;

    public function init()
    {
        parent::init();
        $this->cachekey = Yii::$app->params['cache_prefix']['rbac'][2];
    }

    protected function generateDependencyData($cache)
    {
        return $cache->get($this->cachekey);
    }

    /**
     * 重新缓存rbac模块缓存
     */
    public static function reloadRbacCache()
    {
        $auth = Yii::$app->getAuthManager();
        $auth->invalidateCache();
        $auth->loadFromCache();
        $cache = Yii::$app->getCache();
        $cachekey = Yii::$app->params['cache_prefix']['rbac'][2];
        $letter = range('1', '9');
        shuffle($letter);
        $value = time() . implode('', $letter);
        $cache->set($cachekey, $value);
    }
}