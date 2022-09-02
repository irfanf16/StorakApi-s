@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Upload detailed products in bulk </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ URL::to('/bulk-upload/products/detailed') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="uploaded_file" class="col-sm-2 col-form-label">Upload CSV File</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="uploaded_file" name="uploaded_file"
                                        placeholder="Upload CSV File">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
