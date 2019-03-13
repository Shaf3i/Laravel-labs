@extends('layout.app')

@section('show')
<div class="panel panel-default">
  <div class="panel-heading">Post Info</div>
  <div class="panel-body">Title: {{$post->title}}</div>
  <div class="panel-body">Description: {{$post->description}}</div>
</div>


<div class="panel panel-default">
  <div class="panel-heading">Post Creator Info</div>
  <div class="panel-body">Name: {{$post->user->name}}</div>
  <div class="panel-body">Email: {{$post->user->email}}</div>
  <div class="panel-body">Created At: {{$post->created_at}}</div>

</div>
@endsection