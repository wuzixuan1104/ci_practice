<div class="container">
  <header>
    <figure class="bg"><img src="<?php echo base_url('asset/img/maple.jpg'); ?>"></figure>
    <div class="title"><h1><?php echo $title; ?></h1></div>
  </header>
  <div class="block">
    <form class="submit">
      <span class="error">查無使用者名稱！</span>
      <input type="text" name="name" placeholder="Enter username" required />
      <input type="password" name="pass" placeholder="Enter password" required />
      <input type="password" name="chk_pass" placeholder="Check password" required />
      <button type="submit">Sign In</button>
    </form>
  </form>
</div>

