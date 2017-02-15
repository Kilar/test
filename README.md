# yii2-easyApi
这是一个实现了基本yii RBAC权限控制后台

已经做好了基本的角色分配，菜单权限分配界面，能实现某角色菜单排序、显示、隐藏与菜单操作、ip等权限判断验证


安装条件：

1 必须使用PHP7+(本来php5.6开发的，之后出7，然后很多用了7的一些语法（参数限制，太空符）)、安装redis服务

2 重新配置一下common目录下数据库与redis连接配置

3 导入一下本目录下的yii.sql文件数据

4 配置好网站根目录（配置backend即可，本人使用的是nginx,可以参考一下本目录yii.conf配置）

5 后台超级管理员账号密码为1234567 、测试账号密码为test123

6 本人用到的两个组件连接，请安装后使用
http://www.yiiframework.com/extension/yii2-ajaxcrud/  ajaxcrud
https://github.com/yiisoft/yii2-redis  redis

* 安装好后可能使用pjax导致php报错，配置一下php.ini以下参数即可

  always_populate_raw_post_data = -1
  
  (以下为yii2需求配置)
  
  expose_php = Off
  
  allow_url_include = Off
  
  
* 如果在window上请注释session保存路径，linux上随便配置一个就可以




