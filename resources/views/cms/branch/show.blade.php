@extends('cms.parent')

@section('title' , 'branch')

@section('main-title' , 'show Hasan branch')

@section('sub-title' , 'show Hasan branch')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">show Data of branch</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>

              <div class="card-body">
              <div class="row">

                <div class="form-group col-md-6">
                  <label  for="name">First Name of branch</label>
                  <input disabled type="text" class="form-control" id="name" name="name"
                  value="{{ $branches->name }}" placeholder="Enter First Name of branch">
                </div>
              </div>

                 <div class="row">

                <div class="form-group col-md-6">
                  <label for="email">Email of branch</label>
                  <input disabled type="email" class="form-control" id="email" name="email"
                  value="{{ $branches->email}}" placeholder="Enter Email of branch">
                </div>

            <div class="row">



                <div class="form-group col-md-6">
                    <label for="password">password of branch</label>
                    <input disabled type="text" class="form-control" id="password" name="password"
                    value="{{ $branches->password }}" placeholder="Enter password of branch">
                  </div>
                </div>
            <div class="row">

              <div class="form-group col-md-6">
                     <label for="status"> Status</label>
                     <select class="form-select form-select-sm" name="status" style="width: 100%;" disabled
                           id="status" aria-label=".form-select-sm example">
                           <option selected> {{ $branches->status }} </option>
                            <option value="active">Active </option>
                          <option value="inactive">InActive </option>
                       </select>
              </div>
              <div class="form-group col-md-6">
                <label for="desc">desc of branch</label>
                <input disabled type="text" class="form-control" id="desc" name="desc"
                value="{{ $branches->desc }}" placeholder="Enter desc of branch">
              </div>

          </div>



                 </div>

                 <div class="card-footer">
                    <a href="{{ route('branches.index') }}" type="button" class="btn btn-success">Return Back In Index branch</a>

                  </div>
            </form>
          </div>
          <!-- /.card -->


        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>

@endsection



