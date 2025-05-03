@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Volunteer Ratings</h2>
                    <a href="{{ route('relawan-ratings.create') }}" class="btn btn-primary">Add New Rating</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Volunteer</th>
                                    <th>Rated By</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ratings as $rating)
                                    <tr>
                                        <td>{{ $rating->event->title }}</td>
                                        <td>{{ $rating->volunteer->first_name }} {{ $rating->volunteer->last_name }}</td>
                                        <td>{{ $rating->rater->first_name }} {{ $rating->rater->last_name }}</td>
                                        <td>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                            @endfor
                                        </td>
                                        <td>{{ Str::limit($rating->comment, 50) }}</td>
                                        <td>{{ $rating->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('relawan-ratings.show', $rating) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @can('update', $rating)
                                                <a href="{{ route('relawan-ratings.edit', $rating) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('delete', $rating)
                                                <form action="{{ route('relawan-ratings.destroy', $rating) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $ratings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 