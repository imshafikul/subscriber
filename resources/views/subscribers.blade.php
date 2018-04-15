@extends('layouts.app')

@section('title')
Dashboard
@endsection


@section('content')
    <div class="container">

        @if( session('success') )
            <div class="alert alert-success">
            Campaign Sent
            </div>
        @endif

          <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
          </ul>

        <h1>Subscribers List <a href="{{ config('app.url') . '/export' }}" class="btn btn-info">Export</a> </h1>
        <div>
          <table class="table">
            <thead>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Subscribed On</th>
            </thead>
            <tbody>
              @foreach ($subscribers as $subscriber)
                <tr>
                  <td>{{ $subscriber->firstname }}</td>
                  <td>{{ $subscriber->lastname }}</td>
                  <td>{{ $subscriber->email }}</td>
                  <td>{{ $subscriber->created_at }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

    </div>    
@endsection