<?php
require "db.php";
$data = $_POST;
if( isset($data['do_signup']) )
{

	
	$errors = array();
	if( $data['name'] == '' )
	{
		$errors[] = 'Введите имя!';
	}
	
	if( $data['surname'] == '' )
	{
		$errors[] = 'Введите фимилию!';
	}
	
	if( $data['email'] == '' )
	{
		$errors[] = 'Введите Email!';
	}
	
	if( R::count('users', 'email = ?', array($data['email'])) >0)
	{
		$errors[] = 'Пользователь с таким Email уже существует!';
	}
	
	if( empty($errors) )
	{
	
		$users = R::dispense('users');
		$users->name = $data['name'];
		$users->surname = $data['surname'];
		$users->email = $data['email'];
		R::store($users);
		echo '<div style="color: green;" id="errors">Данные добавлены.</div><hr>';
	} else
	{
		echo '<div style="color: red;" id="errors">'.array_shift($errors).'</div><hr>';
	}
}
?>
<html>
<head>
<script src="jquery-2.2.4.js"></script>
<script>
$(function(){

$('table').on('click', '.del', function(){
		id = $(this).data('id');
		$.ajax({
			url: 'dell.php',
			type: 'POST',
			data: {delid:'delid',id: id},
			complete: function(res){	
				$('#'+id).remove();
			}
		});
	});
});

</script>
<link href="/css/screen.css" type="text/css" rel="stylesheet"></link>
</head>
<body>


<form action="index.php" method="POST">

	<input id="Name" type="text" name="name" placeholder="Имя" value="">
	<input id="Surname" type="text" name="surname" placeholder="Фамилия" value="">
	<input id="Email" type="email" name="email" placeholder="Email" value="">
	<button class="Signup" type="submit" name="do_signup">Внести данные</button>
	<hr>
	</form>
<table>
<thead class="table_head">
<tr><td><b><ins>Имя</ins></b></td>
<td><b><ins>Фамилия</ins></b></td>
<td><b><ins>Email</ins></b></td></tr>
</thead>
<tbody>
	<?php
$test = R::getAll('SELECT * FROM users ORDER BY id DESC');
foreach($test as $users){
		 
		  

?>
<tr id="<?=$users['id']?>">
<td><div class="edit_name"><?=$users['name']?></div></td>
		<td><div class="edit_surname"><?=$users['surname']?></div></td>
		<td><div class="edit_email"><?=$users['email']?></div></td>
<td><div><button  class="del" data-id="<?=$users['id']?>">Удалить</button></div></td></tr>
<?php
}
?>
</tbody>

</table>


<hr>
</body>
</html>