    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <meta name="description" content="<?= isset($description) ? $description : ''; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#7952b3">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" type="text/javascript"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .btn-secondary,
      .btn-secondary:hover,
      .btn-secondary:focus {
        color: #333;
        text-shadow: none; /* Prevent inheritance from `body` */
      }
      body {
        text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
        box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
      }
      .cover-container {
        max-width: 42em;
      }
      .nav-masthead .nav-link {
        padding: .25rem 0;
        font-weight: 700;
        color: rgba(255, 255, 255, .5);
        background-color: transparent;
        border-bottom: .25rem solid transparent;
      }
      .nav-masthead .nav-link:hover,
      .nav-masthead .nav-link:focus {
        border-bottom-color: rgba(255, 255, 255, .25);
      }
      .nav-masthead .nav-link + .nav-link {
        margin-left: 1rem;
      }
      .nav-masthead .active {
        color: #fff;
        border-bottom-color: #fff;
      }
    </style>
