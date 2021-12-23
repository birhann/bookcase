<?php

$session_date = date("Y-m-d");
if (sameDay()) {
    $SQL = mysqli_query($GLOBALS['DBC'], "SELECT session_count FROM daily_session ORDER BY session_date DESC LIMIT 1");
    $session_count = mysqli_fetch_assoc($SQL)['session_count'] + 1;
    mysqli_query($GLOBALS['DBC'], "UPDATE daily_session SET session_count = '{$session_count}' WHERE session_date = '{$session_date}' ");
    csvYaz(true, $session_count);
} else {
    $session_count = 1;
    mysqli_query($GLOBALS['DBC'], "INSERT INTO daily_session (session_date, session_count) VALUES('{$session_date}','{$session_count}')");
    csvYaz(false, $session_count);
}


function csvYaz($same_day, $session_count)
{

    $UyeSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM kullanicilar");
    $file = fopen('analytics.csv', 'r');
    while (($line = fgetcsv($file)) !== FALSE) {
        $array[] = $line;
    }
    fclose($file);


    if ($same_day) {
        $array[array_key_last($array)][0] = date("d-m-y");
        $array[array_key_last($array)][1] = number_format(mysqli_num_rows($UyeSQL)); //user count
        $array[array_key_last($array)][2] = $session_count; //session count
        $file = fopen('analytics.csv', 'w');
        foreach ($array as $line) {
            fputcsv($file, $line);
        }
        fclose($file);
    } else {
        array_push($array, [
            date("d-m-y"),
            number_format(mysqli_num_rows($UyeSQL)),
            $session_count
        ]);
        $file = fopen('analytics.csv', 'w');
        foreach ($array as $line) {
            fputcsv($file, $line);
        }
        fclose($file);
    }
}

function sameDay()
{
    $SQL = mysqli_query($GLOBALS['DBC'], "SELECT session_date FROM daily_session ORDER BY session_date DESC LIMIT 1");
    $dayInDB = mysqli_fetch_assoc($SQL);
    $DBlastYMD = explode("-", $dayInDB['session_date']);
    if (date("d") == $DBlastYMD[2]) {
        return true;
    } else {
        return false;
    }
}
