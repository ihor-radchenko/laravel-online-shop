
@isset($comment)
    <div class="comment">
        <div class="btns">
            @can('update', $comment)
                <button class="btn-link" data-toggle="modal" data-target="#modal-{{ $comment->id }}">
                    <i class="fa fa-edit"></i>
                </button>
            @endcan
            @can('delete', $comment)
                <button class="btn-link confirm-delete-comment"><i class="fa fa-times"></i></button>
            @endcan
        </div>
        <div class="info">
            <span class="author">{{ $comment->user->name or $comment->name }}</span> @lang('page.write') {{ $comment->created_at->format('M j, Y H:i:s') }}
        </div>
        <div class="content" id="text-{{ $comment->id }}">
            {{ $comment->text }}
        </div>
        <div class="shade">
            <div class="inner">
                <h3 class="text-center">@lang('page.confirm_delete_comment')</h3>
                <div class="text-center">
                    <button class="my-btn btn-danger btn-delete-comment" data-route="{{ route('comment.delete', ['comment' => $comment->id]) }}">
                        @lang('button.y')
                    </button>
                    <button class="my-btn btn-success btn-no-delete-comment">@lang('button.n')</button>
                </div>
            </div>
        </div>
    </div>

    @can('update', $comment)
        <div class="modal fade" id="modal-{{ $comment->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="color-black">
                            <label for="update-text-{{ $comment->id }}" class="control-label">@lang('page.update_comment')</label>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea id="update-text-{{ $comment->id }}" cols="30" rows="5" class="form-control" required>{{ $comment->text }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('button.close')</button>
                        <button type="button" class="btn btn-primary btn-update-comment" data-route="{{ route('comment.update', ['comment' => $comment->id]) }}" data-id="{{ $comment->id }}">
                            @lang('button.edit')
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endcan

    <hr>
@endisset