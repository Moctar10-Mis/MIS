// JS/login.js
document.addEventListener('DOMContentLoaded', ()=> {
  const form = document.getElementById('loginForm'); // adjust if different
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const identifier = document.getElementById('identifier')?.value.trim();
    const password = document.getElementById('password')?.value;

    if (!identifier || !password) {
      alert('Missing credentials');
      return;
    }

    try {
      const res = await fetch('/php/login.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({ identifier, password })
      });
      const data = await res.json();
      if (data.success) {
        // redirect based on role
        if (data.role === 'faculty') window.location.href = '../FiDashboard.php';
        else window.location.href = '../StudentDashboard.php';
      } else {
        alert('Invalid credentials');
      }
    } catch (err) {
      console.error(err);
      alert('Network error');
    }
  });
});
