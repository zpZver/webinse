<?php
require "db.php";
if (isset($_POST['delid']))
{
  $delid=$_POST['id'];
   $delete = R::findOne('users', 'id=?', [$delid]);
	R::trash($delete);
}