<?php

function strtoupper_tr($data)
{
    $kh = array('ı', 'i', 'ş', 'ö', 'ğ', 'ç', 'ü');
    $bh = array('I', 'İ', 'Ş', 'Ö', 'Ğ', 'Ç', 'Ü');
    $data = str_replace($kh, $bh, $data);
    $data = strtoupper($data);
    return $data;
}

function ucwords_tr($str)
{
    return mb_convert_case(preg_replace("/\bi/", "İ", $str), MB_CASE_TITLE, "utf-8");
}

function timeAgo($date)
{
    $currentDate = new DateTime('@' . $date);
    $nowDate = new DateTime('@' . time());
    $diff = $currentDate
        ->diff($nowDate);
    if ($diff->y)
        return $diff->y . ' years ago.';
    elseif ($diff->m)
        return $diff->m . ' months ago.';
    elseif ($diff->d)
        return $diff->d . ' days ago.';
    elseif ($diff->h)
        return $diff->h . ' hours ago.';
    elseif ($diff->i)
        return $diff->i . ' minutes ago.';
    elseif ($diff->s > 10)
        return $diff->s . ' seconds ago.';
    else
        return 'a few seconds ago.';
}
