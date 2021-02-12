@extends('layout')
@section('title','Due Accounts')
@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}"> --}}
@endsection
@section('content')
<input type="hidden" id="today">
<h3>
    Due List
</h3>
   <div id="duelist">

   </div>
@endsection
@section('js')
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
{{-- <script src="{{asset('js/nepali.datepicker.v3.2.min.js')}}"></script> --}}
<script>


    $(function () {
        $('#DueList').DataTable();
    });

    var month = ('0'+NepaliFunctions.GetCurrentBsDate().month).slice(-2);
    var day = ('0'+NepaliFunctions.GetCurrentBsDate().day).slice(-2);
    $('#today').val(NepaliFunctions.GetCurrentBsYear()+'-'+month+'-'+day);

function getDue(){
    var date = $('#today').val();
    axios({
    method: 'post',
    url: '/Account/dueload',
    data:{'date':date}
    })
  .then(function (response) {
     $('#duelist').html(response.data);
  }).catch(function (error) {
        // handle error
        console.log(error);
    });
}

    window.onload = function() {
        var mainInput = document.getElementById("today");
        mainInput.nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
        });
        getDue();
    }


</script>
@endsection
