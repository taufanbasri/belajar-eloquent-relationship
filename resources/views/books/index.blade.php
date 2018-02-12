@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Book
              <a onclick="addForm()" class="btn btn-sm btn-primary pull-right" style="margin-top: -8px;">Add Book</a>
          </h4>
        </div>
        <div class="panel-body">
            {!! $html->table(['class' => 'table-strip']) !!}
        </div>
      </div>
    </div>

    @include('books._form')
@endsection

@section('scripts')
    {!! $html->scripts() !!}
    <script>
        function addForm() {
            save_method = 'add';
            $('input[name=_method]').val('POST');
            $('#modal-form').modal();
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add Book');
        }

        function showData(id) {
            $('#modal-form form')[0].reset();
            $.ajax({
                url : "{{ url('books') }}" + '/' + id,
                type : 'GET',
                dataType : 'JSON',
                success : function (data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Details ' + data.title);

                    $('#title').val(data.title).prop('readonly', true);
                    $('#author').val(data.author).prop('readonly', true);
                    $('#submit').hide();
                },
                error : function () {
                    alert('Data not found!')
                }
            });
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url : "{{ url('books') }}" + '/' + id + '/edit',
                type : 'GET',
                dataType : 'JSON',
                success : function (data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit ' + data.title);

                    $('#id').val(data.id);
                    $('#title').val(data.title).prop('readonly', false);
                    $('#author').val(data.author).prop('readonly', false);
                    $('#submit').show();
                },
                error : function () {
                    alert('Data not found!')
                }
            })
        }

        function deleteData(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url : "{{ url('books') }}" + '/' + id,
                type : 'POST',
                data : {
                    '_method' : 'DELETE',
                    '_token' : csrf_token
                },
                success : function () {
                    $('#dataTableBuilder').DataTable().ajax.reload();
                    alert('Berhasil dihapus!!')
                },
                error : function () {
                    alert('Something wrong')
                }
            })
        }

        $(function () {
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('books') }}";
                    else url = "{{ url('books') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : 'POST',
                        data : new FormData($('#modal-form form')[0]),
                        contentType : false,
                        processData : false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            $('#dataTableBuilder').DataTable().ajax.reload();
                        },
                        error : function() {
                            alert('something wrong');
                        }
                    });

                    return false;
                }
            });
        });
    </script>
@endsection
