<!doctype html>
<html lang="en" class="h-100">
  <head>
    <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/5.0.0/firebase-ui-auth.css">
    <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/ui/5.0.0/firebase-ui-auth.js"></script>
    <?= view('widgets/commons/header', $this->data); ?>
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?= view('widgets/commons/public_navbar', $this->data); ?>
    <!-- Begin page __content__ -->
    <main class="px-3">
    <?= isset($__content__) ? $__content__ : ''; ?>
    </main>
    <?= view('widgets/commons/footer', $this->data); ?>
    </div>
  </body>
</html>
