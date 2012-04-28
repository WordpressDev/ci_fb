<?php if (!$user) { ?>
       You've to login using FB Login Button to see api calling result.
       <a href="<?=$loginUrl?>">Facebook Login</a>
   <?php } else { ?>
       <a href="<?=$logoutUrl?>">Facebook Logout</a>
   <?php } ?>