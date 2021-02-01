<?php 


class test {
    public function b(){
        $value = 1;
    }
    public function a (){
        $this->b();
        echo($value);
    }
    
}


$class = new test();
$class->a();