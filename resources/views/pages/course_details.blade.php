@extends('layout.app')
@section('content')
    <div class="course-container">
        <header>
            <h1>Course details</h1>
            <button class="add-course" onclick="window.location.href='{{ route('all.courses') }}'">Back to
                courses</button>
        </header>

        <!-- Course Header -->
        @if ($course->thumbnail)
            <img class="course-thumbnail" src="{{ $course->thumbnail }}" alt="{{ $course->title }}">
        @else
            <img class="course-thumbnail" src="{{ asset('./thumbnail.jpg') }}" alt="Default Thumbnail">
        @endif

        <h1>{{ $course->title }}</h1>
        <div class="meta">Instructor: {{ $course->instructor_name }}</div>
        <div class="meta">Category: {{ $course->category }} | Duration: {{ $course->duration }} | Price:
            {{ $course->price }} BDT</div>
        <div class="meta">Status: {{ $course->status }} | Published: {{ $course->published_at }}</div>

        <p>
            <strong>Description:</strong> <br>
            {{ $course->description }}
        </p>

        <!-- modules -->
        <h2 class="section-title">Modules</h2>

        <!-- Module 1 -->
        <div class="course-module">

            @foreach ($course->modules as $module)
                <div class="module-title">{{ $module->title }}</div>
                <p><em>{{ $module->summary }}</em></p>
                <div class="meta">Status: {{ $module->status }}</div>

                @foreach ($module->contents as $content)
                    <div class="content">
                        <span class="badge">Type: {{ $content->type }}</span>
                        <span class="badge">Title: {{ $content->title }}</span>
                        <span class="badge">Duration: {{ $content->duration }}</span>
                    </div>
                @endforeach
            @endforeach

        </div>
    </div>
@endsection
