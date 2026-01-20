@extends('layouts.app')


@section('content')
<h2>My Profile</h2>


<ul>
    <li><b>Name:</b> <span id="name"></span></li>
    <li><b>Email:</b> <span id="email"></span></li>
</ul>


<script>
axios.get('/api/user/profile').then(res => {
    $('#name').text(res.data.name);
    $('#email').text(res.data.email);
});
</script>
@endsection
