<!doctype html>
<html lang="en" class="h-100">
  <head>
    <?= view('widgets/commons/header', $this->data); ?>
  </head>
  <body class="d-flex flex-column h-100">
    <?= view('widgets/public/navbar', $this->data); ?>
    <!-- Begin page __content__ -->
    <?= isset($__content__) ? $__content__ : ''; ?>
    <?= view('widgets/commons/footer', $this->data); ?>
  </body>
</html>
