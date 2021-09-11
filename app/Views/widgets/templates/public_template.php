<!doctype html>
<html lang="en" class="h-100">
  <head>
    <?= view('widgets/commons/header', $this->data); ?>
    <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/4.5.0/firebase-ui-auth.css">
    <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/ui/4.5.0/firebase-ui-auth.js"></script>
    <script>
      const firebaseConfig = {
        apiKey: "AIzaSyDYH1WBQXUgrQL3BaOBOiiFKdxLwR7cg10",
        authDomain: "parry-b18e0.firebaseapp.com",
        projectId: "parry-b18e0",
        storageBucket: "parry-b18e0.appspot.com",
        messagingSenderId: "701446495044",
        appId: "1:701446495044:web:13791c0c19156b19879511",
        measurementId: "G-3K9FD7KMSR"
      };
      // Initialize Firebase
      const app = firebase.initializeApp(firebaseConfig);
      const uiConfig = {
        signInSuccessUrl: '/',
        signInOptions: [
          // Leave the lines as is for the providers you want to offer your users.
          firebase.auth.GoogleAuthProvider.PROVIDER_ID,
          // firebase.auth.FacebookAuthProvider.PROVIDER_ID,
          // firebase.auth.TwitterAuthProvider.PROVIDER_ID,
          // firebase.auth.GithubAuthProvider.PROVIDER_ID,
          firebase.auth.EmailAuthProvider.PROVIDER_ID,
          //firebase.auth.PhoneAuthProvider.PROVIDER_ID,
          // firebaseui.auth.AnonymousAuthProvider.PROVIDER_ID
        ],
        tosUrl: '/tos',
        privacyPolicyUrl: function() {
          window.location.assign('/pnp')
        }
      }
      const ui = new firebaseui.auth.AuthUI(firebase.auth())
    </script>
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?= view('widgets/commons/public_navbar', $this->data); ?>
    <!-- Begin page __content__ -->
    <main class="px-3">
    <?= isset($__content__) ? $__content__ : ''; ?>
    </main>
    <?= view('widgets/commons/footer', $this->data); ?>
    </div>
  </body>
</html>
