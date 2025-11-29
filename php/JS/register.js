document.getElementById('registerForm').addEventListener('submit', async function(e){
    e.preventDefault();
    const formData = new FormData(this);

    if(formData.get('password') !== formData.get('confirm_password')){
        Swal.fire('Error','Passwords do not match','error');
        return;
    }

    const response = await fetch('php/signup.php',{ method:'POST', body:formData });
    const result = await response.json();

    if(result.success){
        Swal.fire('Success','Registration successful','success')
        .then(()=> window.location.href = 'LoginStudent.php');
    } else {
        Swal.fire('Error', result.message || 'Registration failed','error');
    }
});
