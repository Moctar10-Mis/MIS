<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Attendance</title>
  <link rel="stylesheet" href="../CSS/styleStudentLogin.css">
  <link rel="stylesheet" href="../CSS/style.css">
</head>

<body>
  <div class="head"> 
    <h1>Ashesi University</h1>
   
  </div>

  <div class="First">
    <h1>Student Login</h1>
  </div>

  <div class="container">  
    <div class="First_Name">
      <form>
        <label for="First Name"><strong>First Name:</strong> </label>
        <input type="text" id="text" placeholder="User First Name">

        <label for="Last Name"><strong>Last Name:</strong> </label>
        <input type="text" id="text" placeholder="User Last Name">

        <label for="email"><strong>Email:</strong> </label>
        <input type="email" id="email" placeholder="Enter your email">

        <label for="password"><strong>Password:</strong></label>
        <input type="password" id="password" placeholder="Enter your password">
      </form>
    </div>

    
    <div class="right-side">
      <div class="Button1">
        <a href="../HTML/StudentDashboard.php"><button type="submit">Login</button></a>
      </div>

      <p>Don't have an account? <a href="../HTML/RegisterStudent.php">Register here</a></p>

      <div class="Button2">
        <a href="../HTML/RegisterStudent.php"><button>Sign Up</button></a>
      </div>
    </div>
  </div>
</body>



