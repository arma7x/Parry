function loginDashboard() {
  axios.post('/login')
  .then(() => {
    window.location.href = "/";
  });
}

function logoutDashboard() {
  axios.post('/logout')
  .then(() => {
    window.location.href = "/";
  });
}
