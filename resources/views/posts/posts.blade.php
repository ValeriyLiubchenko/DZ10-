@extends('layout')

@section('content')
    @isset($_SESSION['success'])
        <div class="alert alert-success" role="alert">
            {{ $_SESSION['success'] }}
        </div>
    @endisset
    @php
        unset($_SESSION['success']);
    @endphp
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
            <th scope="col">Category</th>
            <th scope="col">User</th>
            <th scope="col">Tags</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td><a href="/category/{{ $post->category->id }}">{{ $post->category->id }}</a></td>
                <td><a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a></td>
                @php
                    $a=$post->tags()->pluck('tag_id')->join(',');
                    $ids=explode(',',$a);
                @endphp
                <td>
                    @foreach($ids as $id)
                        <a href="/tag/{{$id}}">{{$id}}</a>
                    @endforeach
                </td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->updated_at }}</td>
                <td>

                    <a href="/post/{{ $post->id }}/delete">Delete</a>
                    <a href="/{{ $post->id }}/show">Show</a>
                </td>
            </tr>
        @empty
            <p>Empty</p>
        @endforelse
        </tbody>
    </table>
@endsection()
