@extends('layouts.app')


@section('content')
<h2>Dashboard</h2>


<div id="role"></div>


<table id="usersTable" class="display" style="width:100%">
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Joined</th>
</tr>
</thead>
</table>


<script>
axios.get('/api/user/profile').then(res => {
    $('#role').html('<b>Role:</b> ' + res.data.roles[0].name);


    if (res.data.roles[0].name !== 'admin') {
        $('#usersTable').hide();
    }
});


$('#usersTable').DataTable({
    ajax: {
        url: '/api/admin/users',
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem('token')
        },
        dataSrc: ''
    },
    columns: [
        { data: 'name' },
        { data: 'email' },
        { data: 'created_at' }
    ]
});
</script>
@endsection
