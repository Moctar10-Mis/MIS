async function logout() {
    const response = await fetch('php/logout.php');
    const result = await response.json();
    if(result.logout){
        window.location.href = 'LoginStudent.php';
    }
}
