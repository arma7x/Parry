function loginDashboard() {
  var uname = document.getElementById('lg_username').value;
  var upass = document.getElementById('lg_password').value;
  if (uname.length > 0 && upass.length > 0) {
    axios.post('/auth/login', {username: uname, password: upass})
    .then(() => {
      window.location.href = "/";
    })
    .catch((err) => {
      if (err.response.data.message) {
        alert(err.response.data.message);
      } else {
        alert('Error');
      }
    });
  }
}

function updatePassword() {
  var newpass = document.getElementById('new_password').value;
  var confpass = document.getElementById('confirm_password').value;
  var oldpass = document.getElementById('old_password').value;
  if (newpass.length > 0 && confpass.length > 0 && confpass.length > 0) {
    if (confpass !== newpass) {
      alert('Password not match');
      return;
    }
    axios.post('/auth/update_password', {new_password: newpass, old_password: oldpass})
    .then((response) => {
      if (response.data.message) {
        alert(response.data.message);
        window.location.reload();
      }
    })
    .catch((err) => {
      if (err.response.data.message) {
        alert(err.response.data.message);
      } else {
        alert('Error');
      }
    });
  }
}

function logoutDashboard() {
  axios.post('/auth/logout')
  .then(() => {
    window.location.href = "/";
  });
}
