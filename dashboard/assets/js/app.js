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

function searchUser() {
  var p = {};
  var url = new URL(document.location.origin);
  var fields = ['s_keyword', 's_create_permission', 's_read_permission', 's_update_permission', 's_delete_permission', 's_status', 's_level'];
  fields.forEach(k => {
    var value = document.getElementById(k).value;
    if (value.length > 0) {
      const key = k.replace('s_', '');
      p[key] = value;
      url.searchParams.set(key, value);
    }
  });
  if (Object.keys(p).length > 0)
    window.history.pushState("/", "", window.location.pathname.replace(/\/$/, '') + '?' + url.searchParams.toString());
  else
    window.history.pushState("/", "", window.location.pathname.replace(/\/$/, ''));
  axios.get('/internal-users/search', { params: p })
  .then((res) => {
    console.log(res.data);
  })
  .catch((err) => {
    console.log(err);
  });
}
