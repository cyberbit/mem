<div class="modal-body">
    @component('alert', ['context' => $context, 'title' => $title])
        {{ $msg }}
    @endcomponent
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>