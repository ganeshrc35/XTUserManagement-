@include('layouts.partials.title')
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
 
<body>
    <div id="app">
        @include('layouts.partials.head')
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">{{ __('Users') }}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="/createUser" class="btn btn-primary">Create new user </a>
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-x-12">
                                        <table class="table table-bordered table-hover table-striped"  id="users-data" >
                                            <thead id="users-thead-data">
                                                <tr><th>Name</th><th>User Name</th><th>Email</th><th>DOB</th><th>Phone Number</th><th>Created Date</th><th class="no-sort">View</th><th class="no-sort">Edit</th><th class="no-sort">Delete</th></tr>
                                            </thead>
                                            <tbody id="users-tbody-data">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="/js/jquer-ui.js"></script>
    <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $.noConflict();
            getUsers();
        });
        function getUsers(){
            var url = "/getUsers";
            if ( $.fn.dataTable.isDataTable( '#users-data' ) ) {
                $('#users-data').dataTable().fnDestroy();
            }
            $("#users-data").DataTable({
                // bLengthChange: false,
                bFilter: true,
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [
                    {data: 'name', name: 'name',orderable: false},
                    {data: 'username', name: 'username',orderable: false},
                    {data: 'email', name: 'email',orderable: false},
                    {data: 'dob', name: 'dob',orderable: false},
                    {data: 'mobile_number', name: 'mobile_number',orderable: false},
                    {data: 'created_at', name: 'created_at',orderable: false},
                    {data: 'view', name: 'view', orderable: false},
                    {data: 'edit', name: 'edit', orderable: false},
                    {data: 'delete', name: 'delete', orderable: false},
                ],
                search: {
                    "regex": true
                },
                language: {
                    paginate: {
                        next: '&#62;', // or '>'
                        previous: '&#60;' // or '<' 
                    }
                }
            });
        }
        //Delete User
        $(document).on('click','.delete_user',function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            var cnf = confirm('Do you really want to delete the user?');
            if(cnf){
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data){
                        alert(data.message);
                        getUsers();
                    }
                });
            }else{
                return false;
            }
        });
    </script>
</body>
</html>