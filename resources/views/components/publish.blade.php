<div class="modal fade" id="publishModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $post->title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ $post->published?"Unpublish":"Publish"; }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{ route('posts.publish', ['post'=>$post->id]) }}" method="POST">
          @method('PUT')
          @csrf
          <button type="submit" class="btn btn-primary">Update</button>
        </form>

      </div>
    </div>
  </div>
</div>