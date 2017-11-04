<?php

class formBuild {

    public function open($arr) {
        $str = '<form';
        foreach ($arr as $key => $value){
            $str .= ' '.$key.'='.$value;
        }
        $str .= '>';
        return $str;
    }

    public function close() {
        $str = '</form>';
        return $str;
    }

    public function input($arr) {
        $str = '<input';
        foreach ($arr as $key => $value){
            $str .= ' '.$key.'='.$value;
        }
        $str .= '>';
        return $str;
    }

    public function textarea($arr) {
        $str = '<textarea';
        foreach ($arr as $key => $value){
            if($key == 'value'){
                $str .= '>'.$value.'</textarea>';
                return $str;
            }
            $str .= ' '.$key.'='.$value;
        }
        $str .= '></textarea>';
        return $str;
    }

    public function submit($arr) {
        $str = '<input type="submit"';
        foreach ($arr as $key => $value){
            $str .= ' '.$key.'='.$value;
        }
        $str .= '>';
        return $str;
    }
}

?>