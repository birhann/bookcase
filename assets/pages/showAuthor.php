<!DOCTYPE html>
<html lang="en">

<head>

    <!-- DataTables CSS library -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- DataTables JS library -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

</head>

<body>
    <div class="bs-example">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="float-left">Authors List</h2>
                        <a href="javascript:void(0)" class="btn btn-primary float-right add-model"> Add Author </a>
                    </div>

                    <table id="usersListTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Birthday</th>
                                <th>Place</th>
                                <th>About</th>
                                <th>Photo</th>
                                <th style="width: 111px !important">Created</th>
                                <th style=" width: 111px !important;">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Birthday</th>
                                <th>Place</th>
                                <th>About</th>
                                <th>Photo</th>
                                <th>Created</th>
                                <th>Action</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<div class="modal fade" id="edit-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form id="update-form" name="update-form" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" class="form-control" id="mode" name="mode" value="update">

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Surname</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter Surname" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Birthday</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="birthday" name="birthday" placeholder="Enter Birthday" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Birthday</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="place" name="place" placeholder="Enter Birthplace" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">About</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="about" name="about" placeholder="Enter About" value="" maxlength="500" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Photo</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="photo" name="photo" placeholder="Enter photo" value="" maxlength="50" required="" disabled>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form id="add-form" name="add-form" class="form-horizontal">
                    <input type="hidden" class="form-control" id="mode" name="mode" value="add">

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Surname</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter Surname" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Birthday</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="birthday" name="birthday" placeholder="Enter Birthday" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Place</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="place" name="place" placeholder="Enter Place of birth" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">About</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="about" name="about" placeholder="Enter About Author" value="" maxlength="500" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Photo</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="photo" name="photo" placeholder="Enter photo" value="" maxlength="50" required="" disabled>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#usersListTable').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": "assets/php/ajax/datatable/fetch.php"
        });
    });


    /*  add user model */
    $('.add-model').click(function() {
        $('#add-modal').modal('show');
    });

    // add form submit
    $('#add-form').submit(function(e) {

        e.preventDefault();

        // ajax
        $.ajax({
            url: "assets/php/ajax/datatable/add-edit-delete.php",
            type: "POST",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function() {
                var oTable = $('#usersListTable').dataTable();
                oTable.fnDraw(false);
                $('#add-modal').modal('hide');
                $('#add-form').trigger("reset");
            }
        });
    });

    /* edit user function */
    $('body').on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "assets/php/ajax/datatable/add-edit-delete.php",
            type: "POST",
            data: {
                id: id,
                mode: 'edit'
            },
            dataType: 'json',
            success: function(result) {
                $('#id').val(result.yaz_ID);
                $('#name').val(result.yaz_Ad);
                $('#surname').val(result.yaz_Soyad);
                $('#birthday').val(result.yaz_DTarih);
                $('#place').val(result.yaz_DYeri);
                $('#about').val(result.yaz_Hakkinda);
                $('#photo').val(result.yaz_Foto);
                $('#edit-modal').modal('show');
            }
        });
    });

    // add form submit
    $('#update-form').submit(function(e) {

        e.preventDefault();

        // ajax
        $.ajax({
            url: "assets/php/ajax/datatable/add-edit-delete.php",
            type: "POST",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function() {
                var oTable = $('#usersListTable').dataTable();
                oTable.fnDraw(false);
                $('#edit-modal').modal('hide');
                $('#update-form').trigger("reset");
            }
        });
    });

    /* DELETE FUNCTION */
    $('body').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        if (confirm("Are You sure want to delete !")) {
            $.ajax({
                url: "assets/php/ajax/datatable/add-edit-delete.php",
                type: "POST",
                data: {
                    id: id,
                    mode: 'delete'
                },
                dataType: 'json',
                success: function(result) {
                    var oTable = $('#usersListTable').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
        return false;
    });
</script>

</html>