@extends('layout.app')
@section('content')
    <header>
        <h1>All Courses</h1>
        <button class="add-course" onclick="window.location.href='{{ route('courses.create') }}'">+ Add
            Course</button>
    </header>

    <div class="cards">
        @forelse ($courses as $course)
            <div class="card">
                @if ($course->thumbnail)
                    <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}" class="thumbnail" />
                @else
                    <div class="thumbnail"
                        style="background-color: #eee; display: flex; align-items: center; justify-content: center; color: #999;">
                        No Image</div>
                @endif

                <h2>{{ $course->title }}</h2>
                <div class="category">{{ $course->category }}</div>
                <p>{{ Str::limit($course->description, 100) }}</p>
                <div class="details">
                    <strong>Price:</strong> {{ $course->price ? 'BDT ' . number_format($course->price, 2) : 'Free' }}
                </div>

                <a href="{{ route('show.course', $course->id) }}" class="view-btn">View</a>
            </div>
        @empty
            <p>No courses found. Click "Add Course" to create one!</p>
        @endforelse
    </div>
@endsection
