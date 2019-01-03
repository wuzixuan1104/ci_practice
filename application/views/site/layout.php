<!DOCTYPE html>
<html lang="tw">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" />

    <title><?php echo isset($title) ? $title : ''; ?></title>
    <?php echo $asset->render(); ?>
    
  </head>
  <body lang="zh-tw">
    <?php isset($path) ? (isset($params) ? $this->load->view($path, $params) : $this->load->view($path)) : ''; ?>
  </body>
</html>
