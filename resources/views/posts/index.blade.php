@extends('layouts.app')

@section('content')
<div class="text-center">
<a href="{{ route('posts.create') }}" class="btn btn-success  mt-5 " >  Create Post</a>
</div>
    <table class="table  mt-5 container">
        <thead>
          <tr>
            <th scope="col">pagintation in lab2</th>
            <th scope="col">title</th>
            <th scope="col">posted by</th>
            <th scope="col">created at</th>
            <th scope="col">slug</th>
            <th scope="col">actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($posts as $post)
          <tr>
            <th scope="row">{{$post['id']}}</th>
            <td>{{$post['title']}}</td>
            <td>{{$post->user ? $post->user->name : 'user not found'}}</td>
            <td>{{$post->created_at_formated}}</td>
            <td>{{$post['slug']}}</td>
            <td class="col">
                <a href="{{ route('posts.show', [ 'post' => $post['id'] ]) }}" class="btn btn-info">View</a>
                <a href="{{ route('posts.edit', [ 'post' => $post['id'] ]) }}" class="btn btn-primary">Edit</a>
                
                <!--<a href="{{ route('posts.destroy', [ 'post' => $post['id'] ]) }}" class="btn btn-danger">Delete</a>-->
                <form method="post"  style="display:inline;" action="{{route('posts.destroy', [ 'post' => $post['id'] ])}}" >
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Are you sure to delete post?')" title="delete" class="btn btn-danger">
                    Delete
                  </button>
                </form>
                
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div>
      {!!$posts->links()!!}
      </div>
@endsection
    