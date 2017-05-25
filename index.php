<?php

include_once('class/db.class.php');
include_once('class/user.class.php');

$user = new User();

$user->initUser();

print_r($_POST);

if(isset($_POST['changeurl'])) {
	$user->changeUrl($_POST['refer_url']);
}

if($user->userdata['user_group'] == 1 && !$_POST['adminpanel']) {
?>
<form method="POST">
	<input type="submit" name="adminpanel" value="Админпанель">
</form>

<?php } if(!isset($_POST['adminpanel'])) {?>

Привет <?php echo $user->userdata['name']; ?> ! <br>
<?php if(!$user->userdata['refer']) { ?>
	Вы пришли сюда по своей воле, Вас никто не звал
<?php } else { ?>
	Ваш реферал: <a href="/user/<?php echo $user->userdata['refer']['name'] . '">' . $user->userdata['refer']['name']; ?> </a>
<?php } ?>
<br><br>
Реферальная ссылка: <?php echo 'http://test.stairdeck.ru/landing.php?ref=' . $user->userdata['name']; ?> 
<br>
Сторонняя ссылка: <?php echo $config['url_ref']; ?>
<form method="POST">
	<input required type="text" name="refer_url" value="<?php echo $user->userdata['refer_url']; ?>">
	<input type="submit" name="changeurl" value="Изменить">
</form>
Сторонняя ссылка партнера: <?php echo $config['url_ref'] . $user->userdata['refer']['refer_url']; ?>





<br><br>
<h1>Мои инвалиды: </h1>
<?php 

echo $user->echoRefers();
} else if(isset($_POST['adminpanel'])) {
	include_once('adm.php');
}
?>
