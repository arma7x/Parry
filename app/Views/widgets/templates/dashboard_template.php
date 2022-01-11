<!doctype html>
<html lang="en" class="h-100">
  <head>
    <?= view('widgets/commons/header', $this->data); ?>
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?= view('widgets/commons/dashboard_navbar', $this->data); ?>
    <!-- Begin page __content__ -->
    <main class="px-3">
    <?= isset($__content__) ? $__content__ : ''; ?>
    <?php if ($__user__ !== FALSE): ?>
    <?= view('dashboard/main/update_password_modal', $this->data); ?>
    <script type="text/javascript">
      window.addEventListener("load", function() {
        const headers = document.getElementsByTagName('header');
        if (headers.length > 0)
          headers[0].classList.remove('mb-auto');
      });
    </script>
    <?PHP endif ;?>
    </main>
    <?= view('widgets/commons/footer', $this->data); ?>
    </div>
  </body>
</html>
