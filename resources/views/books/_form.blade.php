<div class="modal fade" id="modal-form" tabindex="1" role="dialog" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog dialog-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id=""></h4>
      </div>
      <form class="form-horizontal" method="post">
          {{ csrf_field() }}
          {{ method_field('POST') }}
          <div class="modal-body">
              <input type="hidden" id="id" name="id" value="id">
              <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title" class="col-md-3 control-label">Title</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Book Title" autofocus required>
                    <span class="help-block with-errors"></span>
                    @if ($errors->has('title'))
                        <label class="error">
                            {{ $errors->first('title') }}
                        </label>
                    @endif
                </div>
              </div>
              <div class="form-group {{ $errors->has('author') ? 'has-error' : '' }}">
                <label for="author" class="col-md-3 control-label">Author</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="author" name="author" placeholder="Book Author" required>
                    <span class="help-block with-errors"></span>
                    @if ($errors->has('author'))
                        <label class="error">
                            {{ $errors->first('author') }}
                        </label>
                    @endif
                </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="submit">Submit</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
      </form>
    </div>
  </div>
</div>
