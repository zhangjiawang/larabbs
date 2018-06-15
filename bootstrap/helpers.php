<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $length);
}
function matching($str, $a, $b)
{
    $pattern = '/(@).*?( )/is'; //正则规则匹配支付串中任何一个位置字符串
    preg_match_all($pattern, $str, $m);   //返回一个匹配结果
    return $m[0];  //到时候在这里书写返回值就好了 .
}
function get_between($input, $start, $end) {
    $substr = substr($input, strlen($start)+strpos($input, $start),(strlen($input) - strpos($input, $end))*(-1));
    return $substr;
}