<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function printDie($var, $printr = true)
{
    print '<hr><br><pre>';
    if ($printr) {
        print_r($var);
    } else {
        print $var;
    }
    print '</pre><br><hr>';
    die('');
}

function redirectDie($to)
{
    redirect($to);
    die();
}