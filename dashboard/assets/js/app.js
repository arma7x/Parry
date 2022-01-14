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

function searchUser(scope) {
  var p = { page: scope.getAttribute('data-page') || scope.value };
  var url = new URL(document.location.origin);
  url.searchParams.set('page', p['page']);
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
    const tbody = document.getElementById('users_tbody');
    tbody.innerHTML = res.data.tbody;
    const pagination = document.getElementById('users_pagination');
    pagination.innerHTML = res.data.pagination;
  })
  .catch((err) => {
    console.log(err);
  });
}

function createUser() {
  var formData = {}
  const fields = ['c_username', 'c_email', 'c_password', 'c_create_permission', 'c_read_permission', 'c_update_permission', 'c_delete_permission', 'c_status', 'c_level'];
  fields.forEach((k) => {
    const key = k.replace('c_', '');
    formData[key] = document.getElementById(k).value;
  });
  axios.post('/internal-users/create', formData)
  .then((res) => {
    if (res.data.message) {
      alert(res.data.message);
    }
    window.location.reload();
  })
  .catch((err) => {
    const validation = err.response.data.validation;
    if (validation) {
      fields.forEach((k) => {
        const key = k.replace('c_', '');
        const el = document.getElementById(k);
        const txt = document.getElementById(`${k}_invalid`);
        if (validation[key] != null && txt != null) {
          el.classList.add('is-invalid');
          txt.textContent = validation[key];
        } else if (validation[key] == null && txt != null) {
          el.classList.remove('is-invalid');
          txt.textContent = '';
        }
      });
    } else if (err.response.data.message){
      alert(err.response.data.message);
    } else {
      alert('Error');
    }
  });
}
