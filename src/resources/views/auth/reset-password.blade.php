<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>


<h2>Reset Password</h2>


<form id="resetForm">
<input type="hidden" id="token" value="{{ request('token') }}">
<input type="email" id="email" value="{{ request('email') }}" placeholder="Email" required><br><br>
<input type="password" id="password" placeholder="New Password" required><br><br>
<input type="password" id="password_confirmation" placeholder="Confirm Password" required><br><br>
<button type="submit">Reset Password</button>
</form>


<p id="msg"></p>


<script>
$('#resetForm').submit(function(e){
e.preventDefault();


axios.post('/api/reset-password', {
token: $('#token').val(),
email: $('#email').val(),
password: $('#password').val(),
password_confirmation: $('#password_confirmation').val()
}).then(res => {
$('#msg').css('color','green').text(res.data.message);
}).catch(err => {
$('#msg').css('color','red').text('Password reset failed');
});
});
</html>
