@extends('template')


@section('content')

    @parent
    <table class=" table table-bordered" id="roles-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>    

    <button class="btn btn-sm btn-info" onclick="Addoles()">Add roles</button>


<!--FORM HIDDEN ADDroles -->



 <script>
$(function() {
    $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!!url("usermanagement/roles/listRoles")!!}',
        columns: [
            { data: 'ROLES_NAME', name: 'ROLES_NAME' },
            { data: 'action', name: 'action',orderable: false, searchable: false}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
        }   
    });
    
});


</script>


    @stop