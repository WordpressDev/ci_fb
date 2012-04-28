<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Facebook PHP SDK on CI Reactor TEST</title>
</head>
<body>
<div>
  <?php if(!$fb_data['me']): ?>
  Please login with your FB account: <a href="<?php echo $fb_data['loginUrl']; ?>">login</a>
  <?php else: ?>
  <img src="https://graph.facebook.com/<?php echo $fb_data['uid']; ?>/picture" alt="" class="pic" />
  <p>Hi <?php echo $fb_data['me']['name']; ?>,<br />
    <a href="<?php echo site_url('welcome/facebook_friends'); ?>">See all your facebook friends</a> or 
    <a href="<?php echo $fb_data['logoutUrl']; ?>">logout. This logouts only CI session, not $_SESSION</a> 
  </p>
    <?php
    	echo anchor('welcome/logout','CI logout. This logs you out $_SESSION and CI session.');
    ?>
  <?php endif; ?>

 <?php
//print_r ($me);
echo "<pre>me: ";
print_r ($fb_data['me']);
echo "</pre>";
echo "<pre>session: ";
print_r($_SESSION);
echo "</pre><br /><br />";
echo "<pre>fb_data: ";
print_r($fb_data);
echo "</pre>";
echo "<br />";
if(isset($fb_data['me']))
{
	echo "fb_data me: ";
	print_r ($fb_data['me']);
}
else
{
	echo "no fb_data";
}
echo "<br />";

echo "<br />";
if(isset($user))
{
	echo "user: ";
	var_dump ($user);
}
else
{
	echo "no user found";
}
  ?>
</div>
</body>
</html>