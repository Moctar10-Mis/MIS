// JS/logout.js
document.addEventListener('click', (e) => {
  if (!e.target.matches('.btn-logout')) return;
  e.preventDefault();
  logout();
});

async function logout() {
  try {
    const res = await fetch('/php/logout.php', { method: 'POST' });
    const data = await res.json();
    if (data.logout) {
      alert('Logged out');
      window.location.href = '/HTML/LoginStudent.html';
    } else {
      alert('Logout failed');
    }
  } catch (err) {
    console.error(err);
    alert('Network error');
  }
}
