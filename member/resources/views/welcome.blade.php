
@extends('layouts.app')
  <!-- Content Wrapper. Contains page content -->


@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<div class="content-wrapper">
<div class="container-fluid">


    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h5 class="card-title">All Member</h5>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control ss"   name="schoolname" id="schoolname" style="width: 300px;" >
                            <option value="0" label="Choose School"></option>
                            @foreach($schools as $item)
                                <option value="{{ $item->id }}" >{{ $item->school_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <a class="btn btn-primary waves-effect" href="{{route('school.create')}}">
                            <span> Add New Member </span>
                        </a>
                    </div>
                </div>



            </div>
          <!-- /.card-header -->
            <div class="card-body">




                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p">ID</th>
                                <th class="wd-15p">Member name</th>
                                <th class="wd-15p">Email</th>
                                <th class="wd-15p">Address</th>
                                <th class="wd-15p">School</th>
                     

                            </tr>
                        </thead>
                        <tbody id="member">
                            @foreach($members as $key=>$row)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->school_name}}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->address }}</td>


                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- /.row -->
                </div>
            <!-- ./card-body -->

            </div>

        <!-- /.card -->
        </div>
      <!-- /.col -->
        </div>

    </div>
    <!-- /.row -->

  </div><!--/. container-fluid -->

</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script >
      $(document).ready(function(){
     $('#schoolname').change(function(){
        var schoolname = $(this).val();
          if (schoolname) {

            $.ajax({
                url: "{{ url('/get/school/') }}/"+schoolname,
              type:"GET",
              dataType:"json",
              success:function(data) {
                var d =$('#member').empty();
              $.each(data, function(key, value){
                  var id=key+1;
              $('#member').append( '<tr ><td><p>'+id+'</p></td><td><p>'+value.name+'</p></td>'+
                '<td><p >'+value.email+'</p></td><td><p>'+value.address+'</p></td><td><p>'+value.school_name+'</p></td> </tr>');
              });
              },
            });

          }else{
            alert('danger');
          }

            });
      });

 </script>

@endsection


