{{-- @extends('base')

@section('title', 'Note ' . $note->id . ' - ' . $note->title)

@section('content')
    <p>
        <a href="/notes/{{ $note->id }}/edit?api_token={{ Auth::user()->api_token }}" class="btn btn-primary">Edit</a>
        <a href="/notes/{{ $note->id }}/delete?api_token={{ Auth::user()->api_token }}" class="btn btn-outline-danger">Delete</a>
        <a href="/notes?api_token={{ Auth::user()->api_token }}" class="btn btn-secondary">Cancel</a>
    <h1>Note {{ $note->id }} - {{ $note->title }}</h1>
    
    <p>{{ $note->body }}</p>
@endsection --}}

<div class="modal-header">
    <h5 class="modal-title" id="note-view-title">{{ $note->title }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <p>{{ $note->body }}</p>
    <small class="text-muted">Created by {{ $note->user->name }} on {{ $note->created_at }}, updated on {{ $note->updated_at }}</small>
</div>
<div class="modal-footer">
    <button type="button" class="note-btn-edit btn btn-primary">Edit</button>
    <button type="button" class="note-btn-delete btn btn-outline-danger">Delete</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

<script>
    $(function() {
        var $modal = $("#note-view-modal");
        var note = {!! json_encode($note) !!};
        
        $modal.find(".note-btn-delete").click(function(e) {
            e.preventDefault();
            
            modalFade(false);
            $modal.one("hidden.bs.modal", function() {
                loadModal("#note-delete-modal", "/notes/" + note.id + "/delete?" + $.param(app.forms.api_token));
                modalFade(true);
            }).modal("hide");
        });
        
        $modal.find(".note-btn-edit").click(function(e) {
            e.preventDefault();
            
            modalFade(false);
            $modal.one("hidden.bs.modal", function() {
                loadModal("#note-edit-modal", "/notes/" + note.id + "/edit?" + $.param(app.forms.api_token));
                modalFade(true);
            }).modal("hide");
        });
    });
</script>