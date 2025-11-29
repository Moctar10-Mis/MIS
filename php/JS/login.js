document.getElementById('loginForm').addEventListener('submit', async function(e){
    e.preventDefault();
    const formData = new FormData(this);

    const response = await fetch('php/login.php',{ method:'POST', body:formData });
    const result = await response.json();

    if(result.success){
        if(result.role==='student'){
            window.location.href = 'StudentDashboard.php';
        } else if(result.role==='faculty'){
            window.location.href = 'FiDashboard.php';
        }
    } else {
        Swal.fire('Error','Invalid credentials','error');
    }
});
