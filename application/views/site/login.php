<!DOCTYPE html>
<html lang="tw">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" />

    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/auth.css'); ?>">
    
  </head>
  <body lang="zh-tw">
    <div class="container">
      <header>
        <figure class="bg"><img src="<?php echo base_url('asset/img/maple.jpg'); ?>"></figure>
        <div class="title"><h1>SIGN IN</h1></div>
      </header>
      <div class="block">
        <form class="submit">
          <span class="error active">查無使用者名稱！</span>
          <input type="text" name="name" placeholder="Enter username" required />
          <input type="password" name="pass" placeholder="Enter password" required />
          <input type="password" name="chk_pass" placeholder="Check password" required />
          <button type="submit">Sign In</button>
        </form>
      </form>
    </div>
  </body>
</html>
