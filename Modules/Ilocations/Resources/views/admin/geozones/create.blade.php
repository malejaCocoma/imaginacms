@extends('layouts.master')

@section('content-header')
<h1>
  {{ trans('ilocations::geozones.title.create geozones') }}
</h1>
<ol class="breadcrumb">
  <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
  <li><a href="{{ route('admin.ilocations.geozones.index') }}">{{ trans('ilocations::geozones.title.geozones') }}</a></li>
  <li class="active">{{ trans('ilocations::geozones.title.create geozones') }}</li>
</ol>
@stop

@section('content')
<!-- {!! Form::open(['route' => ['admin.ilocations.geozones.store'], 'method' => 'post']) !!} -->
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <div class="tab-content">
        @include('ilocations::admin.geozones.partials.create-fields')
        <div class="box-footer">
          <button type="button" onclick="storeGeozone2()" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
          <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.ilocations.geozones.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
        </div>
      </div>
    </div> {{-- end nav-tabs-custom --}}
  </div>
</div>
<!-- {!! Form::close() !!} -->
@stop

@section('footer')
<a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
<dl class="dl-horizontal">
  <dt><code>b</code></dt>
  <dd>{{ trans('core::core.back to index') }}</dd>
</dl>
@stop

@push('js-stack')

<script type="text/javascript">
var countTr=0;
var geozones=[];//[[0]=>id_country,[1]=>id_zone,[2]=>countTr]
function removeRow(num){
  $('#tr'+num).remove();
  for(var i=0;i<geozones.length;i++){
    if(geozones[i]['countTr']==num){
      geozones.splice(i,1);
      break;
    }
  }
}//removeRow

function loadZones(){
  $('#zone').empty().append($('<option>', {
    value: 0,
    text: 'All zones'
  }));
  $.ajax({
    url:"{{url('/api/ilocations/allprovincesbycountry/iso2/')}}"+'/'+$('#country').val(),
    type:'GET',
    dataType:"json",
    data:{},
    success:function(data){
      var html="";
      $('#zone').empty().append($('<option>', {
        value: 0,
        text: 'All zones'
      }));
      for(var i=0;i<data.length;i++){
        $('#zone').append($('<option>', {
          value: data[i]['iso_2'],
          text: data[i]['name']
        }));
      }//for
    },
    error:function(error){
      // console.log(error);
    }
  });
}//loadZones
function storeGeozone2(){
  var name=$('#name').val();
  var description=$('#description').val();
  if(name==""){
    alertify.error('You must enter a name');
  }else if(description==""){
    alertify.error('You must enter a description');
  }else if(geozones.length==0){
    alertify.error('You must build at least one geozone');
  }else{
    var token="{{csrf_token()}}";
    $.ajax({
      url:"{{url('/backend/ilocations/geozones')}}",
      type:'POST',
      headers:{'X-CSRF-TOKEN': token},
      dataType:"json",
      data:{name:$('#name').val(),description:$('#description').val(),'geozones':geozones},
      success:function(data){
        if(data.success==1){
          $('#name').val("");
          $('#description').val("");
          geozones=[];
          $("#table_geozones tbody").empty();
          alertify
          .alert(""+data.message, function(){
            window.location.replace("{{url('/backend/ilocations/geozones')}}");
            // alertify.message('OK');
          });
          // alert('Geozone successfully saved');
        }
      },
      statusCode: {
        422: function(dataError){
          // console.log(dataError);
          var error=JSON.parse(dataError.responseText);
          // console.log(error);//parse string to json responseText
          $.each( error.errors, function( key, value ) {
            // alert( key + ": " + value );
            // alert(value);
            alertify.error(""+value);
          });
        }
      },
      error:function(jqXHR, textStatus, errorThrown){
        // alert(jqXHR.status);
        // alert(textStatus);
        // alert(errorThrown);
      }
    });
  }
}
$('.add_geozone').on("click", function() {
  var countryValue=$('#country').val();
  if(countryValue==0)
    alertify.error('Select a country');
  else{
    var countryText=$('#country option:selected').text();
    var zoneValue=$('#zone').val();
    var zoneText=$('#zone option:selected').text();
    var data = {countryValue, zoneValue,countTr}
    geozones.push(data);
    var cols = "<tr id='tr"+countTr+"'>";
    cols += '<td><input type="text" class="form-control" value="'+countryText+'" readonly></td>';
    cols += '<td><input type="text" class="form-control" value="'+zoneText+'" readonly></td>';
    cols += '<td><button type="button" class="btn btn-danger" onclick="removeRow('+countTr+')" name="button"><i class="fa fa-minus-circle"></i></button></td>';
    cols += "</tr>";
    countTr++;
    $("#table_geozones tbody").append(cols);
    // console.log(geozones);
  }
});//addRow
</script>
<script type="text/javascript">
$( document ).ready(function() {
  $.ajax({
    url:"{{url('/api/ilocations/allmincountries')}}",
    type:'GET',
    dataType:"json",
    data:{},
    success:function(data){
      var html="";
      $('#country').empty().append($('<option>', {
        value: 0,
        text: 'Select a country'
      }));
      for(var i=0;i<data.length;i++){
        $('#country').append($('<option>', {
          value: data[i]['iso_2'],
          text: data[i]['name']
        }));
      }//for
    },
    error:function(error){
      // console.log(error);
    }
  });
  $(document).keypressAction({
    actions: [
      { key: 'b', route: "<?= route('admin.ilocations.geozones.index') ?>" }
    ]
  });
});
</script>
<script>
$( document ).ready(function() {
  $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat-blue'
  });
});
</script>
@endpush
