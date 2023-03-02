@extends('cms.parent')

@section('title' , 'company')

@section('main-title' , 'show Hasan company')

@section('sub-title' , 'show Hasan company')

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
              <h3 class="card-title">show Data of company</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>

              <div class="card-body">
              <div class="row">

                <div class="form-group col-md-6">
                  <label  for="name">First Name of company</label>
                  <input disabled type="text" class="form-control" id="name" name="name"
                  value="{{ $companies->name }}" placeholder="Enter First Name of company">
                </div>
              </div>

                 <div class="row">

                <div class="form-group col-md-6">
                  <label for="email">Email of company</label>
                  <input disabled type="email" class="form-control" id="email" name="email"
                  value="{{ $companies->email}}" placeholder="Enter Email of company">
                </div>

            <div class="row">



                <div class="form-group col-md-6">
                    <label for="password">password of company</label>
                    <input disabled type="text" class="form-control" id="password" name="password"
                    value="{{ $companies->password }}" placeholder="Enter password of company">
                  </div>
                </div>
            <div class="row">

              <div class="form-group col-md-6">
                     <label for="status"> Status</label>
                     <select class="form-select form-select-sm" name="status" style="width: 100%;" disabled
                           id="status" aria-label=".form-select-sm example">
                           <option selected> {{ $companies->status }} </option>
                            <option value="active">Active </option>
                          <option value="inactive">InActive </option>
                       </select>
              </div>
              <div class="form-group col-md-6">
                <label for="desc">desc of company</label>
                <input disabled type="text" class="form-control" id="desc" name="desc"
                value="{{ $companies->desc }}" placeholder="Enter desc of company">
              </div>

          </div>



                 </div>

                 <div class="card-footer">
                    <a href="{{ route('companies.index') }}" type="button" class="btn btn-success">Return Back In Index company</a>

                  </div>
            </form>
          </div>
          <!-- /.card -->


        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>

@endsection



