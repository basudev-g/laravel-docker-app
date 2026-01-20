<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>


<nav>
    <a href="{{ route('dashboard') }}">Dashboard</a> |
    <a href="{{ route('profile') }}">Profile</a> |
    <button id="logout">Logout</button>
</nav>
<hr>


@yield('content')


<script>
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');


    $('#logout').click(function () {
        axios.post('/api/logout').then(() => {
            localStorage.removeItem('token');
            window.location.href = '/login';
        });
    });
</script>


</body>
</html>
