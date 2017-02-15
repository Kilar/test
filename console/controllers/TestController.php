<?php
namespace console\controllers;

use yii\console\Controller;
use yii;

class TestController extends Controller 
{
    public function actionIndex() 
    {
//         $arr = [
//             'pf' => '1',
//             'ver' => '1.0.0.0',
//             'time' => '1487001826',
//             'key' => 'KbOlJHdNq6UF07mP',
//             'username' => 'username2',
//             'password' => 'password2',
//         ];
        
//         $arr = [
//             'pf' => '1',
//             'ver' => '1.0.0.0',
//             'time' => '1487001826',
//             'token' => '1JyZYaWpt0YoN3Y9W98dVfRxnwZXoowC',
//             'key' => 'ZqNrJZ8C2cjQCR2sdrxO-QZ71fRl25-d3I0EGVne9qo1q27-ZifYUjQlyuwF2fXn',
//         ];
        
          $arr = [
            'pf' => '1',
            'ver' => '1.0.0.1',
            'time' => '1487001826',
            'real_name' => '1231dsf3许昌',
            'mobile' => '1133333',
            'email' => '33334444@111.com',
            'token' => '1JyZYaWpt0YoN3Y9W98dVfRxnwZXoowC',
            'key' => 'ZqNrJZ8C2cjQCR2sdrxO-QZ71fRl25-d3I0EGVne9qo1q27-ZifYUjQlyuwF2fXn',
        ];
        
        ksort($arr);
        print_r(md5(urldecode(http_build_query($arr))));
        die("\n");
    }
    
    function my_sort($a,$b)
    {
        echo 'dddd';
        if ($a==$b) return 0;
        return ($a<$b)?-1:1;
    }
}