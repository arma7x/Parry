function displayLoading(show = true) {
  if (show) {
    const el = document.getElementById('loadingModal');
    if (el !== null && !el.classList.contains('show')) {
      el.classList.add('show');
      el.style.display = 'block';
    }
  } else {
    const el = document.getElementById('loadingModal');
    if (el !== null && el.classList.contains('show')) {
      el.classList.remove('show');
      el.style.display = 'none';
    }
  }
}

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
    firebase.auth.FacebookAuthProvider.PROVIDER_ID,
    // firebase.auth.TwitterAuthProvider.PROVIDER_ID,
    // firebase.auth.GithubAuthProvider.PROVIDER_ID,
    firebase.auth.EmailAuthProvider.PROVIDER_ID,
    // firebase.auth.PhoneAuthProvider.PROVIDER_ID,
    // firebaseui.auth.AnonymousAuthProvider.PROVIDER_ID
  ],
  tosUrl: function() {
    window.location.assign('/tos')
  },
  privacyPolicyUrl: function() {
    window.location.assign('/pnp')
  }
}
const ui = new firebaseui.auth.AuthUI(firebase.auth());

firebase.auth().onAuthStateChanged((user) => {
  const firebaseUserName = document.getElementById('firebaseUserName');
  const firebaseLoginBtn = document.getElementById('firebaseLoginBtn');
  const firebaseLogoutBtn = document.getElementById('firebaseLogoutBtn');
  if (user) {
    firebaseUserName.innerText = `Hi ${user.displayName || user.email.split('@')[0]}`;
    firebaseUserName.classList.remove('d-none');
    firebaseLoginBtn.classList.add('d-none');
    firebaseLogoutBtn.classList.remove('d-none');
  } else {
    firebaseUserName.innerText = "";
    firebaseUserName.classList.add('d-none');
    firebaseLoginBtn.classList.remove('d-none');
    firebaseLogoutBtn.classList.add('d-none');
    let timer = setInterval(() => {
      const open = document.getElementsByClassName('firebaseui-callback-indicator-container').length > 0 || document.getElementsByClassName('firebaseui-info-bar').length > 0;
      if (open) {
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
        clearInterval(timer);
        timer = null;
      }
    }, 100);
    setTimeout(() => {
      if (timer) {
        clearInterval(timer);
        timer = null;
      }
    }, 5000);
  }
}, (error) => {
  console.log(error)
});

function logoutFirebase() {
  firebase.auth().signOut()
  .finally(() => {
    window.location.href = "/";
  });
}

function getUserToken() {
  const user = firebase.auth().currentUser;
  if (user == null)
    return Promise.reject("User is null");
  return user.getIdToken();
}

function verifyToken() {
  getUserToken()
  .then((token) => {
    return axios.post('/auth/verify-token', {token: token});
  })
  .then((response) => {
    console.log(response.data.message);
  })
  .catch((err) => {
    if (typeof err === 'string') {
      console.log(err);
    } else {
      console.log(err.response.data.message);
    }
  });
}
