  <!-- Modal -->
  <div class="modal fade modal-slacker modal-module" id="modal_{{$position->id}}" tabindex="-1" role="dialog"
       aria-labelledby="modal_{{$position->id}}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close">
              <i class="fa fa-times-circle" aria-hidden="true"></i>
            </button>
          </div>

       @include('ibanners::frontend.pop-up.banner')

      </div>
    </div>
  </div>
  <!-- /Modal -->

@section('scripts')

  <script type="text/javascript">
      $(document).ready(function () {
          setTimeout(function () {
              $('#modal_{{$position->id}}').modal('show');
          }, 1500);
          setTimeout(function () {
              $('#modal_{{$position->id}}').modal('hide');
          }, 12000);
      });
  </script>

  @parent
@stop

