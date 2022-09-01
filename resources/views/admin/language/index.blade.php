@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Language Setting</h1>

    <form action="{{ url('admin/language/update') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 mt-2 font-weight-bold text-primary">Setup your key values</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Key</th>
                                    <th>Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($language_data as $row)
                                    <input type="hidden" name="lang_id[]" value="{{ $row->id }}">
                                    <input type="hidden" name="lang_key[]" value="{{ $row->lang_key }}">
                                    <tr>
                                        <td>
                                            <textarea name="lang_key[]" class="form-control h_55" cols="30" rows="10" disabled>{{ $row->lang_key }}</textarea>
                                        </td>
                                        <td>
                                            <textarea name="lang_value[]" class="form-control h_55" cols="30" rows="10">{{ $row->lang_value }}</textarea>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
        
@endsection