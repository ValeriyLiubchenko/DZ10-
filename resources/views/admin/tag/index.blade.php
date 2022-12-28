@extends('layout')

@section('content')
    <a href="{{route('admin.tag.create')}}" class="btn btn-success">CREATE tag </a>
    @if(!empty($tags))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Slug</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr>
                    <th>{{$tag->id}}</th>
                    <td>{{$tag->title}}</td>
                    <td>{{$tag->slug}}</td>
                    <td>{{$tag->created_at}}</td>
                    <td>{{$tag->updated_at}}</td>
                    <td>
                        <a href="/admin/tag/{{$tag->id}}/edit"> Update </a>
                        <a href="/admin/tag/{{$tag->id}}/destroy"> Delete </a>
                        <a href="/admin/tag/{{$tag->id}}/show"> Show </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            @else
                <p> Empty !</p>
            @endif
        </table>
        <ul>
            <li>
                <a href="{{ $tags->nextPageUrl() }}">Next page</a>
            </li>
            <li>
                <a href="{{ $tags->previousPageUrl() }}">Prev page</a>
            </li>
        </ul>
        @endsection
