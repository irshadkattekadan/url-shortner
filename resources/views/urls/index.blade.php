@extends('layouts.app')
@section('urls', 'active')
@section('breadcumb')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Urls</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Urls</li>
      </ol>
    </div><!-- /.col -->
  </div>
@endsection
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add Url</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                    <div class="card-body">
                      <div class="form-group">
                        <label for="title">title</label>
                        <input type="text" class="form-control" id="title" placeholder="Title">
                      </div>

                      <div class="form-group">
                        <label for="url">Url</label>
                        <input type="url" class="form-control" id="url" placeholder="Enter Url">
                      </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary" id="add-btn" style="float: right;" onclick="addUrl()">Add</button>
                    </div>

              </div>
          </div>

              <!-- /.info-box -->
        </div>
        <!-- /.col -->

      </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Urls</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Url</th>
                        <th>Shorten Url</th>
                        <th>Created At</th>
                        <th style="width: 40px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($urls->count())
                    @foreach ($urls as $url)

                        <tr>
                            <td>{{ $url->title }}</td>
                            <td>{{ $url->url }}</td>
                            <td>{{ route('shorten-url',['code' => $url->code]) }}</td>
                            <td>{{ $url->created_at->format('d M, Y') }}</td>
                            <td><button class="" onclick="copy('{{ route('shorten-url',['code' => $url->code]) }}')">
                                    <i class="fa fa-copy"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr id="no-data-tr">
                        <td colspan="5" style="text-align: center">No Data Found</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

            <!-- /.info-box -->
      </div>
      <!-- /.col -->

    </div>

  </div><!--/. container-fluid -->
@endsection

@section('scripts')
    <script>
        function addUrl(){
            let url = jQuery('#url').val();
            let title = jQuery('#title').val();
            let shorten_url = "{{ route('shorten-url', ['code' => 'code']) }}"
            if(url){
                jQuery('#add-btn').attr('disabled', 'disabled');
                jQuery.ajax({

                        url: "{{ route('url.create') }}",
                        type: 'POST',
                        data: {_token: "{{ csrf_token() }}", url: url, title: title},
                        dataType: 'JSON',
                        success: function (data) {
                            jQuery('#add-btn').removeAttr('disabled');
                            if(data.success){
                                jQuery('#no-data-tr').attr('style','display: none')
                                jQuery('tbody').prepend(`<tr>
                                    <td>${data.success.title}</td>
                                    <td>${data.success.url}</td>
                                    <td>${shorten_url.replace('code', data.success.code)}</td>
                                    <td>${data.success.created_at}</td>
                                    <td>
                                        <button onclick="copy('${shorten_url.replace('code', data.success.code)}')"><i class="fa fa-copy"></i></button>
                                    </td>
                                </tr>`)
                                jQuery('#url').val('');
                                jQuery('#title').val('');
                            }
                            else if(data.error){
                                alert(data.error)
                            }
                        }
                    });
            }
        }

        function copy(text){
            const el = document.createElement('textarea');
            el.value = text;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        }
    </script>
@endsection
