<div class="container">
  <header>
    <figure class="bg"><img src="<?php echo base_url('asset/img/maple.jpg'); ?>"></figure>
    <div class="title"><h1><?php echo $title; ?></h1></div>
  </header>
  <div class="block">
    <form class="submit" method="POST" action="<?php echo base_url('register/process'); ?>">
      <span class="error <?php echo $flash['type'];?>"><?php echo $flash['msg'];?></span>
      <input type="text" name="account" value="<?php echo isset($flash['param']) ? $flash['param']['account'] : ''; ?>" placeholder="Enter account" required />
      <input type="password" name="password" value="<?php echo isset($flash['param']) ? $flash['param']['password'] : ''; ?>" placeholder="Enter password" required />
      <input type="password" name="chkpassword" value="<?php echo isset($flash['param']) ? $flash['param']['chkpassword'] : ''; ?>" placeholder="Enter check password" required />
      <input type="text" name="name" value="<?php echo isset($flash['param']) ? $flash['param']['name'] : ''; ?>" placeholder="Enter name" required />
      <button type="submit">Sign In</button>
    </form>
  </form>
</div>

