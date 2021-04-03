@extends('layouts.app')
@section('create')
<div class="content-wrapper">
    <div class="container-fluid">
<form action="{{route('school.store')}}" method="POST" >
    @csrf
    <div class="card-body">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" roles="alert">
                    {{$error}}
                </div>

            @endforeach
        @endif
        <div class="form-group">
            <label for="exampleInputPassword1">Member Name</label>
            <input type="text" id="name" name="name" class="form-control" id="exampleInputPassword1" placeholder="Member Name">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="text" id="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Address</label>
            <input type="text" id="address" name="address" class="form-control" id="exampleInputPassword1" placeholder="Address">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">School</label>
            <select class="form-control" name="school"   >
                @foreach($schools as $item)
                    <option value="{{ $item->id }}" >{{ $item->school_name}}</option>
                @endforeach

                </select>
        </div>

    </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <a class="btn btn-danger m-t-15 waves-effect" href="{{ url('/') }}">BACK</a>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
    </div>
</div>
@endsection
