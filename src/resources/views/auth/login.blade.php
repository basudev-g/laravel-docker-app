<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>


<h2>Login</h2>


<form id="loginForm">
<input type="email" name="email" placeholder="Email" required><br><br>
<input type="password" name="password" placeholder="Password" required><br><br>
<button type="submit">Login</button>
</form>


<p id="error" style="color:red"></p>


<script>
$('#loginForm').submit(function(e){
e.preventDefault();


axios.post('/api/login', {
email: $('input[name=email]').val(),
password: $('input[name=password]').val()
}).then(res => {
localStorage.setItem('token', res.data.token);
window.location.href = '/dashboard';
}).catch(err => {
$('#error').text(err.response.data.message ?? 'Login failed');
});
});
</script>


</body>
</html>
