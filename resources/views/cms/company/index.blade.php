@extends('cms.parent')

@section('title' , ' company')

@section('main-title' , 'Index company')

@section('sub-title' , 'index company')

@section('styles')

@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title"> Index Data of company</h3> --}}
                {{-- <a href="{{ route('companies.create') }}" type="button" class="btn btn-info">Add New company</a> --}}
                <form action="" method="get" style="margin-bottom:2%;">
                  <div class="row">
                      <div class="input-icon col-md-2">
                          <input type="text" class="form-control" placeholder="Search By Name"
                             name='name' @if( request()->name) value={{request()->name}} @endif/>
                            <span>
                                <i class="flaticon2-search-1 text-muted"></i>
                            </span>
                          </div>

                          <div class="input-icon col-md-2">
                              <input type="number" class="form-control" placeholder="Search By Code"
                                 name='code' @if( request()->code) value={{request()->code}} @endif/>
                                <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
                              </div>


                  <div class="col-md-6">
                        <button class="btn btn-success btn-md" type="submit"> filter</button>
                        <a href="{{route('companies.index')}}"  class="btn btn-danger"> end filter</a>
                        {{-- @can('Create-City') --}}

                        <a href="{{route('companies.create')}}"><button type="button" class="btn btn-md btn-primary"> Add new company </button></a>
                        {{-- @endcan --}}
                  </div>

                       </div>
              </form>

              <div class="row mt-3">
                <div class=" col-md-12 ">

                  <a href="{{ route('companies.create') }}" type="submit" class="btn btn-info">Add New Company</a>
                  <a  href="{{ route('restoreindexx') }}" type="submit" class="btn btn-secondary ml-3 float-right ">Restore Company <i class="fas  fa-trash-alt"></i></a>
                  <a  href="{{ route('companies.index') }}" type="submit" class="btn btn-success ml-3 float-right">All Company</a>
                </div>
               </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>company Name</th>
                      <th>email</th>
                      <th>status</th>
                      <th>desc</th>
                      <th>Number of Branches</th>
                      <th>Setting</th>
                      <th>Show Function</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($companies as $company )
                    {{-- <td><span class="tag tag-success">Approved</span></td> --}}

                    <tr>
                        <td>{{$company->id}}</td>
                        <td>{{ $company->name ?? ""}}</td>
                        <td>{{ $company->email ?? ""}}</td>
                        <td>{{$company->status ?? ""}}</td>

                        <td>{{$company->desc}}</td>
                        <td><span class="badge bg-info">({{$company->branches_count}}) branches</td>
                            <td >
                                <div class="btn group w-100 ">
                                    <a href="{{ route('companies.edit' , $company->id) }}" type="button"
                                        @if($company->deleted_at !== null)
                                        hidden
                                        @endif
                                        class="btn btn-info mb-md-3   ">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                    <a type="button" onclick="performDestroy({{ $company->id }} , this)" class="btn btn-danger mb-md-3">
                                    <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <a href="{{ route('restoree' , $company->id) }}" type="button"
                                        @if($company->deleted_at == null)
                                        hidden
                                        @endif
                                        class="btn btn-info mb-md-3 ">
                                        &#x21BA;
                                    </a>
                                </div>

                            </td>
                            <td>
                                <div class="btn group">


                                  <a href="{{route('companies.show' , $company->id)}}" type="button" class="btn btn-success">
                                    <i class="fas fa-eye"></i>
                                  </a>
                                </div>
                              </td>

                        <td></td>
                      </tr>
                    @endforeach


                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            {{ $companies->links()}}
          </div>
        </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection


@section('scripts')
  <script>
    function performDestroy(id , referance){
      let url = '/cms/admin/companies/'+id;
      confirmDestroy(url , referance );
    }
</script>
@endsection
