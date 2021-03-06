@extends('template')


@section('content')
    @parent
    <div class="row col-md-12" style="margin-bottom:20px">
    <div class="col-md-6">      
      <a href="<?php echo date('Y-m-d', strtotime(' -1 day',strtotime($tanggal)))?>"><img src="<?php echo url('assets/images/back.png')?>"></a>
    </div>
    <div class="col-md-6" >
    <div style="float:right">
      <a href="<?php echo date('Y-m-d', strtotime(' +1 day',strtotime($tanggal)))?>"><img src="<?php echo url('assets/images/next.png')?>"></a>
      <h4>Next</h4>      
    </div>

    </div>
    </div>

    <table class=" table table-bordered" id="schedule-table">
        <thead>
            <tr>
                <th>Vehicle</th>
                <th>Date</th>
                <th>Price/Day</th>
                <th>Picture</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>    

    <button type="button" class="btn btn-primary schedule">Add Schedule</button>

<!--Add Schedule-->
<div class="modal fade" id="addSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['url'=>'rent','METHOD'=>'POST','class'=>'form-horizontal'])!!} 
            <input type="hidden" name="RENT_SCHEDULE_DATE">
            <div class="form-group">
              <label class="col-lg-3 control-label">Rent Car</label>
              <div class="col-lg-8">
                    <select class="form-control" name="VEHICLE_ID">
                      @foreach($vehicle as $row)
                        <option value="{{$row['VEHICLE_ID']}}">{{$row['VEHICLE_NAME']}}<img src="<?php echo 'public/Assets\vehiclePhoto/'.$row['VEHICLE_PHOTO']?>" style="width:50px; height:50px"> </option>
                        @endforeach
                    </select>
              </div>
            </div>    
            <div class="form-group">
              <label class="col-lg-3 control-label">Depart Time</label>
              <div class="col-lg-8">
                <input type="date" class="form-control" name="date">
              </div>
            </div>
               <div class="form-group">
              <label class="col-lg-3 control-label">Price</label>
              <div class="col-lg-8">
                <input type="text" class="form-control" name="RENT_SCHEDULE_PRICE">
              </div>
            </div>
  
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Schedule</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
<!--Add Schedule-->


<!-- edit schedule -->
<div class="modal fade" id="editSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['url'=>'rent/edit','METHOD'=>'POST','class'=>'form-horizontal'])!!}             
            <input type="hidden" name="RENT_SCHEDULE_ID">
            <div class="form-group">
              <label class="col-lg-3 control-label">Price</label>
              <div class="col-lg-8">
                <input type="text" class="form-control" name="RENT_SCHEDULE_PRICE">
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Edit Schedule</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $("#schedule-table").on("click","button.btn.btn-primary",function(){
      var tr=$(this.closest("tr"));
      var id=$(this)[0].id;

      $("#editSchedule input[name='RENT_SCHEDULE_PRICE']").val(tr[0].cells[2].innerHTML);
      $("#editSchedule input[name='RENT_SCHEDULE_ID']").val(id);
      $("#editSchedule").modal("show");
  });
</script>
<!--Edit Schedule-->


 <script type="text/javascript">
      $("button.btn.schedule").click(function(){
        var depart_date="<?php echo $tanggal?>";
        $("#addSchedule form [name='RENT_SCHEDULE_DATE']").val(depart_date);
        $("#addSchedule form [name='date']").val(depart_date);
        $("#addSchedule form [name='date']").attr('disabled','disabled');
        $("#addSchedule").modal("show");

      });
</script>
<!--Add Schedule-->



<!--Hapus Schedule-->
<div class="modal fade" id="hapusSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Warning</h4>
      </div>
      <div class="modal-body">
        <h2 class="modalbody" style="text-aligment:center"></h2>
      </div>
      <div class="modal-footer">
        {!!Form::open(['route'=>'rent.destroy','method'=>'POST'])!!}
        <input type="hidden" value="" name="RENT_SCHEDULE_ID" >
        <button type="submit" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $("#schedule-table").on("click","button.btn.btn-danger",function(){
        var button=this;
        
        $("#hapusSchedule h2.modalbody").html('Apakah Anda Yakin?');

        var id=$(button).get()[0].id; 
        $("#hapusSchedule form input[name='RENT_SCHEDULE_ID'").val(id);
        $("#hapusSchedule").modal("show");

  });
</script>
<!--Hapus Schedule-->
   </div>

  </div>
</div>
 <script>
$(function() {
    $('#schedule-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo url('rent/getScheduleDay/'.$tanggal)?>",
        columns: [
            { data: 'VEHICLE_NAME', name: 'VEHICLE_NAME' },
            { data: 'RENT_SCHEDULE_DATE', name: 'RENT_SCHEDULE_DATE' },
            { data: 'RENT_SCHEDULE_PRICE', name: 'RENT_SCHEDULE_PRICE' },
            { data: 'picture', name: 'picture',orderable: false, searchable: false },
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