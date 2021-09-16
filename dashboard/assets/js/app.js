function logoutDashboard() {
  axios.post('/logout')
  .finally(() => {
    window.location.href = "/";
  });
}
