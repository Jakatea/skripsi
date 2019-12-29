<?php 

ini_set('display_errors','On');

include 'dbase.php';
echo select('tblogin');
?>

<form action="test.php" method="POST">
    <label>Join</label><br/>
    <input type="text" name="join"/><br/>
    <label>and(json)</label><br/>
    <textarea name="and" rows="5"></textarea>
   <button type="submit" name="submit">Kirim</button>
</form>    
