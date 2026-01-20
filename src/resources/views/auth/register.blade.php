<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>


<h2>Register</h2>


<form id="registerForm">
<input type="text" name="name" placeholder="Name" required><br><br>
<input type="email" name="email" placeholder="Email" required><br><br>
<input type="password" name="password" placeholder="Password" required><br><br>
<button type="submit">Register</button>
</form>


<p id="error" style="color:red"></p>


<script>
$('#registerForm').submit(function(e){
e.preventDefault();


axios.post('/api/register', {
name: $('input[name=name]').val(),
email: $('input[name=email]').val(),
password: $('input[name=password]').val()
}).then(res => {
localStorage.setItem('token', res.data.token);
window.location.href = '/dashboard';
}).catch(err => {
$('#error').text('Registration failed');
});
});
</script>


</body>
</html>
