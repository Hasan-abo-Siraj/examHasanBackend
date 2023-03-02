@extends('cms.parent')

@section('title' , 'Admin')

@section('main-title' , 'show Hasan Admin')

@section('sub-title' , 'show Hasan Admin')

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
              <h3 class="card-title">show Data of Admin</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>

              <div class="card-body">
              <div class="row">

                <div class="form-group col-md-6">
                  <label  for="first_name">First Name of Admin</label>
                  <input disabled type="text" class="form-control" id="first_name" name="first_name"
                  value="{{ $admins->user->first_name }}" placeholder="Enter First Name of Admin">
                </div>

                <div class="form-group col-md-6">
                  <label for="last_name">Last Name of Admin</label>
                  <input disabled type="text" class="form-control" id="last_name" name="last_name"
                  value="{{ $admins->user->last_name }}" placeholder="Enter Last Name of Admin">
                </div>
              </div>

                 <div class="row">

                <div class="form-group col-md-6">
                  <label for="email">Email of Admin</label>
                  <input disabled type="email" class="form-control" id="email" name="email"
                  value="{{ $admins->email}}" placeholder="Enter Email of Admin">
                </div>


            <div class="row">

                <div class="form-group col-md-6">
                  <label for="mobile">Mobile of Admin</label>
                  <input disabled type="text" class="form-control" id="mobile" name="mobile"
                  value="{{ $admins->user->mobile }}" placeholder="Mobile of Admin">
                </div>

                <div class="form-group col-md-6">
                  <label for="address">address of Admin</label>
                  <input disabled type="text" class="form-control" id="address" name="address"
                  value="{{ $admins->user->address }}" placeholder="Enter address of Admin">
                </div>
              </div>
            <div class="row">

              <div class="form-group col-md-6">
                     <label for="status"> Status</label>
                     <select class="form-select form-select-sm" name="status" style="width: 100%;" disabled
                           id="status" aria-label=".form-select-sm example">
                           <option selected> {{ $admins->user->status }} </option>
                            <option value="active">Active </option>
                          <option value="inactive">InActive </option>
                       </select>
              </div>

          <div class="form-group col-md-6">
                     <label for="gender">Gender</label>
                     <select class="form-select form-select-sm" name="gender" style="width: 100%;" disabled
                           id="gender" aria-label=".form-select-sm example">
                           <option selected> {{ $admins->user->gender }} </option>
                           <option value="male">Male </option>
                          <option value="female">female </option>
                       </select>
              </div>
          </div>
              <div class="row">
                    <div class="form-group col-md-6">
                      <label>son</label>
                      <select class="form-control select2" id="son_id" name="son_id" style="width: 100%;" disabled >
                        {{-- <option selected> {{ $admins->user->son->name }} </option> --}}
                      @foreach($sons as $son)
                        <option value="{{ $son->id }}">{{ $son->name }}</option>
                      @endforeach
                      </select>
                    </div>

                  <div class="form-group col-md-6">
                  <label for="date">Date of Birth </label>
                  <input disabled type="date" class="form-control" id="date" name="date"
                  value="{{ $admins->user->date }}" placeholder="Enter Date of Admin">
                </div>

              </div>

                 <div class="row">
                  <div class="form-group col-md-12">
                  <label for="image">Image of Admin</label>
                  <input disabled type="file" class="form-control" id="image" name="image" placeholder="Enter Date of Admin">
                </div>
                 </div>

                 <div class="card-footer">
                    <a href="{{ route('admins.index') }}" type="button" class="btn btn-success">Return Back In Index Admin</a>

                  </div>
            </form>
          </div>
          <!-- /.card -->


        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>

@endsection



