function loginDashboard() {
  var uname = document.getElementById('lg_username').value;
  var upass = document.getElementById('lg_password').value;
  if ((uname.length > 0 && upass.length > 0)) {
    const json = JSON.stringify({ username: uname, password: upass });
    axios.post('/login', json, {headers: {'Content-Type': 'application/json'}})
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

function logoutDashboard() {
  axios.post('/logout')
  .then(() => {
    window.location.href = "/";
  });
}
