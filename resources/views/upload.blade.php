@extends('layouts.app')
@section('title')
Upload CSV
@endsection

@section('content')
    <div class="container">
        @if( session('success') )
            <div class="alert alert-success">
               You have successfulllly signed up! A mail has been sent to this effect.
            </div>
        @endif

        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>

        <h2>Upload User List</h2>
        <form action="{{ route('import.store') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
            <div class="form-group">
                <label>Upload File *</label>
                <input type="file" name="file" class="form-control"  />
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection