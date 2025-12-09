// JS/register.js
document.addEventListener('DOMContentLoaded', ()=> {
  const form = document.getElementById('registerForm'); // adjust if different
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const username = document.getElementById('username')?.value.trim();
    const email = document.getElementById('email')?.value.trim();
    const password = document.getElementById('password')?.value;
    const role = document.querySelector('input[name="role"]:checked')?.value || 'student';

    if (!username || !email || !password) {
      alert('Please fill all fields');
      return;
    }

    try {
      const res = await fetch('/php/signup.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({ username, email, password, role })
      });
      const data = await res.json();
      if (data.success) {
        alert('Account created. Redirecting to login.');
        window.location.href = '/HTML/LoginStudent.html';
      } else {
        alert(data.message || 'Signup failed');
      }
    } catch (err) {
      console.error(err);
      alert('Network error');
    }
  });
});
