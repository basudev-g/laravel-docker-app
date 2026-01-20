<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>


<h2>Forgot Password</h2>


<form id="forgotForm">
<input type="email" name="email" placeholder="Email" required><br><br>
<button type="submit">Send Reset Link</button>
</form>


<p id="msg"></p>


<script>
$('#forgotForm').submit(function(e){
e.preventDefault();


axios.post('/api/forgot-password', {
email: $('input[name=email]').val()
}).then(res => {
$('#msg').css('color','green').text(res.data.message);
}).catch(err => {
$('#msg').css('color','red').text('Failed to send reset link');
});
});
</script>


</body>
</html>
