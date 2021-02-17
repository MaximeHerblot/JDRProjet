<?php

function get_link(){
    $listNumber = range('0','9');
    $listLetter = range('a','z');
    for ($i=0;$i<count($listLetter);$i++){
        if ($i==0){
            $list = $listNumber;
        } 
        array_push($list,$listLetter[$i]);
    }    
    
    $url ="";
    for($i=0;$i<12;$i++){
        $url.=$list[rand(0,count($list))];
    }
    return $url;
}

var_dump(get_link());