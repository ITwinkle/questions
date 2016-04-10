<?php if(!$auth->isLoggedIn()): ?>
    <a href="<?php echo $auth->getAuthUrl();?>">Signin with google</a>
<?php else: ?>
    You are sign in! <a href="<?php echo $route('logout')?>">Logout</a>
<?php endif; ?>

