 @extends('admin.master')
 @section('content')
     <div class="content-page">
         <!-- Start content -->
         <div class="content">
             <div class="container">

                 <!-- Page-Title -->
                 <div class="row">
                     <div class="col-sm-12">
                         <h4 class="pull-left page-title">Datatable</h4>
                         <ol class="breadcrumb pull-right">
                             <li><a href="#">Moltran</a></li>
                             <li><a href="#">Tables</a></li>
                             <li class="active">Datatable</li>
                         </ol>
                     </div>
                 </div>


                 <div class="col-md-6"></div>
                 <div class="col-md-6" @style(['text-align: right', 'margin-bottom: 15px'])>
                     <button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                         data-target=".bs-example-modal-lg">Add Category</button>
                 </div>

                 <div class="row">
                     <div class="col-md-12">
                         <div class="panel panel-default">
                             <div class="panel-heading">
                                 <h3 class="panel-title">Datatable</h3>
                             </div>
                             <div class="panel-body">
                                 <div class="row">
                                     <div class="col-md-12 col-sm-12 col-xs-12">
                                         <table id="datatable" class="table table-striped table-bordered">
                                             <thead>
                                                 <tr>
                                                     <th>Name</th>
                                                     <th>Parent</th>
                                                     <th>Status</th>
                                                     <th>Action</th>
                                                 </tr>
                                             </thead>


                                             <tbody>
                                                 @foreach ($categories as $category)
                                                     <tr>
                                                         <td>{{ $category->name }}</td>
                                                         <td>{{ $category->parent }}</td>
                                                        <td>
                                                            @if($category->status == 1)

                                                            @endif
                                                        </td>
                                                        <td class="actions"><a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                                            <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                                            <a href="#" class="on-default text-danger"><i class="fa fa-trash-o"></i></a></td>
                                                     </tr>
                                                 @endforeach
                                             </tbody>
                                         </table>

                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>

                 </div> <!-- End Row -->




                 <div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myLargeModalLabel">Add Unit</h4>
                            </div>
                            <div class="modal-body">
                                <form class="" action="{{ route('admin.category.save') }}" id="add_category_form" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="field-2" class="control-label">Unit Name</label>
                                                <input type="text" class="form-control" name="name" id="field-2" placeholder="Center Name">
                                                <span class="error error_name text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="center_id" class="control-label">Select Center</label>
                                                <select class="form-control" name="center_id">
                                                    <option selected disabled>Choose Center</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error error_center_id text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="field-2" class="control-label">Status</label>
                                                <select class="form-control" name="status">
                                                    <option selected disabled>Choose Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">De-Active</option>
                                                </select>
                                                <span class="error error_status text-danger"></span>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light submit_button">Add Category</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


             </div> <!-- container -->

         </div> <!-- content -->
     </div>
 @endsection

 @push('script')
<script>
      $(document).on('submit', '#add_category_form', function(e) {
                e.preventDefault();
                // $('.loading_button').show();
                var url = $(this).attr('action');

                $('.submit_button').prop('type', 'button');

                $.ajax({
                    url: url,
                    type: 'post',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {

                        $('#add_unit_form')[0].reset();
                        $('#myModal').modal('hide');

                        $('.submit_button').prop('type', 'submit');

                        unit__Table.ajax.reload();
                        toastr.success(data)

                    },
                    error: function(err) {
                        let error = err.responseJSON;

                        $.each(error.errors, function (key, error){

                            $('.submit_button').prop('type', 'submit');
                            $('.error_' + key + '').html(error[0]);
                        });
                    }
                });
            });
</script>
 @endpush
