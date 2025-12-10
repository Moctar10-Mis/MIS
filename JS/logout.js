document.addEventListener('DOMContentLoaded', () => {
    const logoutBtn = document.querySelector('.btn-logout');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', async function(e) {
            e.preventDefault(); // Prevent default link behavior
            try {
                const response = await fetch('logout.php', { method: 'POST' });
                const data = await response.json();
                if (data.success) {
                    window.location.href = 'WELCOME.php'; // Redirect after logout
                } else {
                    alert('Logout failed. Please try again.');
                }
            } catch (err) {
                console.error(err);
                alert('Network error. Please refresh and try again.');
            }
        });
    }
});
