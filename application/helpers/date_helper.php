<?php
  function date_indo($date){
    $Day    = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $Month  = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    $year   = substr($date,0,4);
    $month  = substr($date,5,2);
    $Date   = substr($date,8,2);
    $time   = date('H.i', strtotime(substr($date,11,5)));
    $day    = date("w",strtotime($date));
    $result = $Date." ".$Month[(int)$month-1]." ".$year;

    return $result;
  }

  function time_indo($date){
    $Day    = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $Month  = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    $year   = substr($date,0,4);
    $month  = substr($date,5,2);
    $Date   = substr($date,8,2);
    $time   = date('H.i', strtotime(substr($date,11,5)));
    $day    = date("w",strtotime($date));
    $result = $Date." ".$Month[(int)$month-1]." ".$year." ".$time;

    return $result;
  }
