@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Call</h1>
    
    <form action="{{ route('calls.update', $call) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="caller_id">Caller ID</label>
            <input type="text" name="caller_id" id="caller_id" class="form-control" value="{{ $call->caller_id }}" required>
        </div>
        <div class="form-group">
            <label for="representative_id">Representative ID</label>
            <input type="text" name="representative_id" id="representative_id" class="form-control" value="{{ $call->representative_id }}" required>
        </div>
        <div class="form-group">
            <label for="call_start_time">Call Start Time</label>
            <input type="datetime-local" name="call_start_time" id="call_start_time" class="form-control" value="{{ $call->call_start_time }}" required>
        </div>
        <div class="form-group">
            <label for="call_end_time">Call End Time</label>
            <input type="datetime-local" name="call_end_time" id="call_end_time" class="form-control" value="{{ $call->call_end_time }}" required>
        </div>
        <div class="form-group">
            <label for="call_duration">Call Duration</label>
            <input type="text" name="call_duration" id="call_duration" class="form-control" value="{{ $call->call_duration }}" required
