<?php

namespace Web\AmortizationBundle\Twig;

use \Web\AssetsBundle\Entity\Assets;

class MyTwigExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('ObjToArray', array($this, 'ObjToArray')),
            new \Twig_SimpleFilter('MyToStr', array($this, 'MyToStr')),
            new \Twig_SimpleFilter('Test', array($this, 'Test')),
        );
    }

    public function Test($val) {
        return $val . 'R' . rand(1, 1000000);
    }

    public function ObjToArray($arr, $getdata = true) {

        $methods_arr = array_flip(get_class_methods($arr));

        foreach ($methods_arr as $key => $value) {
            if (mb_substr($key, 0, 3) == "set" || mb_substr($key, 0, 2) == "__") {
                unset($methods_arr[$key]);
            } else {
                if ($getdata) {
                    $methods_arr[$key] = $arr->$key();
                }
            }
        }

        //return $methods_arr;
        return $methods_arr;
    }

    function MyToStr($val, $getdata = true) {

        if (is_object($val)) {
            $class_name = get_class($val);
            if ($class_name == 'DateTime') {
                return $val->format('Y-m-d H:i:s');                
            } else {
                
                $str = $class_name."<hr/>";
                $arr = $this->ObjToArray($val, $getdata);
                
                foreach ($arr as $key => $value) {
                    $str .= $key."<br/>";
                    $str .= $value."<hr/>";
                }
                
            }

            //return $class_name;
            return $str;
        }

        return $val;
    }

    public function getName() {
        return 'app_extension';
    }

}
