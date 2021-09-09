@include('layouts.partials.title')
<body>
    <div id="app">
        @include('layouts.partials.head')
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">{{ __('Create User') }}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="/" class="btn btn-primary">Back to Dashboard</a>
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <img src="{{asset('storage/'.$user['profile_image'])}}" class="img img-responsive pull-right" style="width:150px; height:150px;"/><br/>
                                    </div>
                                </div> <br/>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{$user['name']}}</td>
                                    </tr>
                                    <tr>
                                        <th>User Name</th>
                                        <td>{{$user['username']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{$user['email']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{$user['mobile_number']}}</td>
                                    </tr>
                                    <tr>
                                        <th>DOB</th>
                                        <td>{{$user['dob']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{$user['address']}}</td>
                                    </tr>
                                </table>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>