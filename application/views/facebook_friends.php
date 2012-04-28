<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Facebook PHP SDK on CI Reactor TEST</title>
</head>
<body>
<div> <img src="https://graph.facebook.com/<?php echo $fb_data['uid']; ?>/picture" alt="" class="pic" />
  <p><?php echo $fb_data['me']['name']; ?>, you are watching a top secret page. Ssshhhh.</p>
  <p><a href="<?php echo site_url('welcome'); ?>">Go to the home page</a> or <a href="<?php echo $fb_data['logoutUrl']; ?>">logout</a></p>
</div>
<?php
    	echo anchor('welcome/logout','CI logout. This logs you out $_SESSION and CI session.');
    ?>
<ul>
<?php foreach ($friends->data as $friend) : ?>
<li><?php echo $friend->name; ?></li>
<?php endforeach; ?>
</ul>
<?php
//echo "fb_data: <br />";
//var_dump($_SESSION);
echo "session: <br /><pre>";
print_r($_SESSION);
echo "</pre><br /><br />CI session<br /><pre>";
print_r($this->session->all_userdata());
echo "</pre><br /><br />fb_data<br /><pre>";
print_r ($this->session->userdata('fb_data'));
echo "</pre><br /><br />Session me<br />";
print_r($_SESSION['fb__state']);
echo "<br /><br />app_id<br />";
print_r($this->app_id);
echo "<br /><br />Session me<br />";
$app_id = "fb_".$this->app_id."_access_token";//fb_131717670157_access_token
print_r($_SESSION[$app_id]);
print_r ($friends);

?>
</body>
</html>