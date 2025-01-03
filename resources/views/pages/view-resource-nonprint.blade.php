@extends('layout.layout')
@section('content')
<div class="container">
    <h1>Resource Details</h1>

    <div class="card">
        <div class="card-header">
            <h4>Resource Information</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>LR ID:</strong> {{ $resource->lr_id }}</li>
                <li class="list-group-item"><strong>Title:</strong> {{ $resource->title }}</li>
                <li class="list-group-item"><strong>Category:</strong> {{ $resource->category }}</li>
                <li class="list-group-item"><strong>Type Name:</strong> {{ $resource->type_name }}</li>
                <li class="list-group-item"><strong>Subject Title:</strong> {{ $resource->subject_title }}</li>
                <li class="list-group-item"><strong>Subject Shortcode:</strong> {{ $resource->subject_shortcode }}</li>
                <li class="list-group-item"><strong>Grade Level:</strong> {{ $resource->grade_level }}</li>
                <li class="list-group-item"><strong>Source Name:</strong> {{ $resource->source_name }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
