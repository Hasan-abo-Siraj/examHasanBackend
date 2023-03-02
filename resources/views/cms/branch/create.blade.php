@extends('cms.parent')

@section('title' , 'branch')

@section('main-title' , 'Create branch')

@section('sub-title' , 'create branch')

@section('styles')
z
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
              <h3 class="card-title">Create Data of branch</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>company</label>
                      <select class="form-control select2" id="company_id" name="company_id" style="width: 100%;">
                        {{-- <option selected="selected">Alabama</option> --}}
                      @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                      @endforeach
                      </select>
                    </div>


                  </div>
                  <!-- /.col -->

                  <!-- /.col -->
                </div>

                <div class="form-group">
                  <label for="name">branch Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name of branch">
                </div>

                <div class="form-group col-md-6">
                    <label for="email">Email of branch</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email of branch">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="password"> password of branch</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password of branch">
                  </div>
            </div>
            <div class="form-group col-md-6">
              <label for="status"> Status</label>
              <select class="form-select form-select-sm" name="status" style="width: 100%;"
                    id="status" aria-label=".form-select-sm example">
                   <option value="active">Active </option>
                   <option value="inactive">inactive </option>
                </select>
       </div>
       <div class="form-group">
          <label for="desc">description</label>
          <input type="text" class="form-control" id="desc" name="desc"  placeholder="Enter description of branch">
        </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
                <a href="{{ route('branches.index') }}" type="button" class="btn btn-info">Return Back</a>

              </div>
            </form>
          </div>
          <!-- /.card -->


        </div>
        <!--/.col (left) -->


        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@endsection


@section('scripts')
  <script>
    function performStore(){

      let formData = new FormData();
      formData.append('name',document.getElementById('name').value);
      formData.append('email',document.getElementById('email').value);
      formData.append('password',document.getElementById('password').value);
      formData.append('status',document.getElementById('status').value);
      formData.append('desc',document.getElementById('desc').value);
      formData.append('company_id',document.getElementById('company_id').value);

      store('/cms/admin/branches' , formData);
    }

  </script>
@endsection
