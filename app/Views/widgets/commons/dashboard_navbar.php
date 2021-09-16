    <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">Parry</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <?php if ($__user__ !== FALSE): ?>
        <a class="nav-link" aria-current="page" href="#">Hi <?= $__user__['username']; ?></a>
        <?PHP endif ;?>
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <?php if ($__user__ !== FALSE): ?>
        <a class="nav-link" aria-current="page" href="#" onclick="logoutDashboard();">Logout</a>
        <?php else: ?>
        <a class="nav-link" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
        <?PHP endif ;?>
      </nav>
    </div>
    </header>
