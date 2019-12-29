<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR',dirname( dirname(__FILE__)));

include 'auto.php';
// $db=array(
//     'user'=>'user_kel',
//     'password'=>'12345',
//     'name'=>'kelurahan',
//     'host'=>'localhost',

// );

// $handle=new mysqli($db['host'], $db['user'], $db['password'], $db['name']);

function select($class,$join=''){
    if(!empty($_POST['join'])) $join=$_POST['join'];
    
    if(!class_exists($class)) return 0;


    $master=new $class;

    $array=explode(',',$join);

    $detail=array();
    foreach($array as $value){
        if(!class_exists($value)) return 0;
        $detail[]=new $value;

    }   
    $kolom=array( $master->tabel.'.id AS id');
    $ak=array_keys($master->kolom);
    foreach($ak as $value)
        $kolom[]=$master->tabel.'.'.$value.' AS '.$value;
        
    foreach($detail AS $value){
        $namatabel=$value->tabel;

        $ak=array_keys($value->kolom);
        foreach($ak AS $val)
            array_push($kolom,$namatabel.'.'.$val.' AS '.$value->alias.'_'.$val);
    }

    $join=array();
    foreach ($detail as $value){
        $join[]=' JOIN '.$value->tabel.' ON '.
        $master->tabel.'.'.$value->alias.' _id='.
        $value->tabel.'.id';

    }

    $group=empty($_POST['group']) ? ' ':' GROUP BY '.$_POST['group'];
    $order=empty($_POST['order']) ? ' ':' ORDER BY '.$_POST['order']; 
    $limit=empty($_POST['limit']) ? ' ':' LIMIT '.$_POST['limit'];
    $where=' 1=1';
    if(!empty($_POST['and'])) {
        $and=array();
        $s=json_decode($_POST['and'],true);
        foreach($s as $value) $and[]=$value['key']." ".$value['opr']." '".$value['value']."'";
        $where=implode(' AND ',$and);
    }

    $query='SELECT '.implode(', ',$kolom).' FROM '.$master->tabel.
        ' '.implode(' ',$join).' WHERE '.$where.' '.$order.
        $group.$limit;

    echo $query;

    }

