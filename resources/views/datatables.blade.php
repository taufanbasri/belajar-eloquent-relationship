@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Datatables Example</h3>
          </div>
          <div class="panel-body">
              {!! $html->table(['class' => 'table table-hover']) !!}
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">SweetAlert2 Example</h3>
          </div>
          <div class="panel-body">
              <div class="wrap">
                  <button class="btn btn-primary" onclick="sweet()">Click Me!</button>
              </div>
          </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! $html->scripts() !!}

    <script>
        function sweet() {
            swal('Hello world!')
        }
    </script>
@endsection
