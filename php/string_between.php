<?php
namespace Sfinktah\String;

function string_between($left, $right, $s, $inclusive=false, $greedy=false, $repl=null, $rightmost=false) {
    if (!is_string($s) or empty($s))
        return '';
    $llen = strlen($left);
    $rlen = strlen($right);
    $l = 0;
    $r = strlen($s);
    if ($left) {
        if ($rightmost)
            $l = strrpos($s, $left);
        else
            $l = strpos($s, $left);
    }
    else if ($l === false) {
        if ($repl) {
            return $s;
        }
        return '';
    }

    if ($right) {
        if ($greedy) {
            $r = strrpos($s, $right);
            if ($rightmost && $r !== false)
                $l = strpos($s, $left);
        }
        else {
            $r = strpos($s, $right, ($l + $llen));
        }
    }
    if ($r === false || ($r < ($l + $llen))) {
        if ($repl) {
            return $s;
        }
        return '';
    }
    if (!($inclusive)) {
        $l += $llen;
    }
    else {
        $r += $rlen;
    }
    if (is_string($repl)) {
        return ((substr($s, 0, $l - 0) + $repl) . substr($s, $r, null));
    }
    else if (is_callable($repl)) {
        return ((substr($s, 0, $l - 0) . $repl(substr($s, $l, $r - $l))) . substr($s, $r, null));
    }
    return substr($s, $l, $r - $l);
}

