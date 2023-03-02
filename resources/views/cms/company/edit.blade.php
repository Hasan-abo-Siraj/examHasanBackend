@extends('cms.parent')

@section('title' , 'company')

@section('main-title' , 'Edit company')

@section('sub-title' , 'edit company')

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
              <h3 class="card-title">Edit Data of company</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">company Name</label>
                    <input value="{{ $companies->name }}" type="text" class="form-control" id="name" name="name"  placeholder="Enter Name of Contry">
                  </div>

                  <div class="row">

                      <div class="form-group col-md-6">
                        <label for="email">Email of company</label>
                        <input value="{{ $companies->email }}" type="email" class="form-control" id="email" name="email" placeholder="Enter Email of company">
                      </div>

                      <div class="form-group col-md-6">
                        <label for="password"> password of company</label>
                        <input value="{{ $companies->password }}" type="password" class="form-control" id="password" name="password" placeholder="Enter password of company">
                      </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="status"> Status</label>
                  <select class="form-select form-select-sm" name="status" style="width: 100%;" value="{{ $companies->status }}"
                        id="status" aria-label=".form-select-sm example">
                       <option value="active">Active </option>
                       <option value="inactive">inActive </option>
                    </select>
           </div>
           <div class="form-group">
              <label for="desc">description</label>
              <input value="{{ $companies->desc }}" type="text" class="form-control" id="desc" name="desc"  placeholder="Enter description of Contry">
            </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performUpdate({{$companies->id}})" class="btn btn-primary">Update</button>
                <a href="{{route('companies.index')}}" type="button" class="btn btn-secondary">Cancel</a>

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
    function performUpdate(id){

      let formData = new FormData();

      formData.append('name',document.getElementById('name').value);
      formData.append('email',document.getElementById('email').value);
      formData.append('password',document.getElementById('password').value);
      formData.append('status',document.getElementById('status').value);
      formData.append('desc',document.getElementById('desc').value);

      storeRoute('/cms/admin/update-companies/' +id , formData);
    }

</script>
@endsection
