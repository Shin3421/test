   // Date Time Picker

   if ($('.datetimepicker').length > 0) {
       $('.datetimepicker').datetimepicker({
           format: 'DD/MM/YYYY',
           icons: {
               up: "fas fa-chevron-up",
               down: "fas fa-chevron-down",
               next: 'fas fa-chevron-right',
               previous: 'fas fa-chevron-left'
           }
       });
   }

   // Add More Hours

   $(".hours-info").on('click', '.trash', function() {
       $(this).closest('.hours-cont').remove();
       return false;
   });

   $(".add-hours").on('click', function() {

       var hourscontent = '<div class="row form-row hours-cont">' +
           '<div class="col-12 col-md-10">' +
           '<div class="row form-row">' +
           '<div class="col-12 col-md-6">' +
           '<div class="form-group">' +
           '<label>Start Time</label>' +
           '<input class="form-control" type="time" name="start[]"/>' +
           '</div>' +
           '</div>' +
           '<div class="col-12 col-md-6">' +
           '<div class="form-group">' +
           '<label>End Time</label>' +
           '<input class="form-control" type="time" name="end[]"/>' +
           '</div>' +
           '</div>' +
           '</div>' +
           '</div>' +
           '<div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
           '</div>';

       $(".hours-info").append(hourscontent);
       return false;
   });


   // Date Time Picker

   if ($('.datepicker').length > 0) {
       $('.datepicker').datetimepicker({
           viewMode: 'years',
           showTodayButton: true,
           format: 'DD-MM-YYYY',
           // minDate:new Date(),
           widgetPositioning: {
               horizontal: 'auto',
               vertical: 'bottom'
           }
       });
   }