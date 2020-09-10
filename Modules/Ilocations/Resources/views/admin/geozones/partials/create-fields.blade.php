<div class="box-body">
        <label>Geo Zone Name: </label>
        <input type="text" class="form-control" name="name" id="name" value="">
        <label>Description: </label>
        <input type="text" class="form-control" name="description" id="description" value="">
        <input type="hidden" name="geozones" id="geozones" value="">
        <br>
<h2>Geo zones</h2>
<hr>
<div class="row">
  <div class="col-md-4">
    <select class="form-control" name="country" id="country" onchange="loadZones()">
      <option value="">Select a country</option>
    </select>
  </div>
  <div class="col-md-4">
    <select class="form-control" name="zone" id="zone" onchange="">
      <option value="null">All zones</option>
    </select>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-primary add_geozone" name="button"><i class="fa fa-plus-circle"></i></button>
  </div>
</div>
<br>
<table class="table table-bordered" id="table_geozones">
  <thead>
    <th>Country</th>
    <th>Zone</th>
    <th></th>
  </thead>
  <tbody>
    <!--
    <tr id="tr0">
      <td>
        <select class="form-control" name="country" onchange="loadZones">
          <option value="2">Vzlax</option>
        </select>
      </td>
      <td>
        <select class="form-control" name="zone">
          <option value="1">Vzla</option>
        </select>
      </td>
      <td><button type="button" class="btn btn-danger" onclick="removeRow(0)" name="button"><i class="fa fa-minus-circle"></i></button></td>
    </tr>
  -->
    </tbody>
</table>
</div>
