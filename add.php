<?php

echo '<table><tr><td>Имя</td><td>Фамилия</td><td>Email</td></tr>';
$test = R::getAll('SELECT * FROM users ORDER BY id DESC');
foreach($test as $users){
	echo '<tr><td>'.$users['name'].'</td>
	<td>'.$users['surname'].'</td>
	<td>'.$users['email'].'</td>
	<td><input class = "delite" type="submit" value="" data-id="'.$users['id'].'"></input></td></tr>';
		 }
		 
		 
echo '</table>';

?>
