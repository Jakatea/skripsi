<?php
class tblogin{
    public $tabel='tblogin';
    public $alias='login';
    public $kolom=array(
        'ktp_id'=>'INT',
        'grup_id'=>'INT',
        'kel_id'=>'INT',
        'nama'=>'VARCHAR(60)',
        'pwd'=>'VARCHAR(128)',
        'email'=>'VARCHAR(256)'
    );
}