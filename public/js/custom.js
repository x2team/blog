$(document).ready(function() {
    
  // global.$ = global.jQuery = require('jquery');
  // window.$ = window.jQuery = require('jquery'); //v3.4.1
  
  //dataTables
      $("#post").DataTable({
        "lengthMenu": [10, 25, 50, "All"],
        "order": [[ 4, "desc" ]],
        "language": {
          "paginate": {
            // "previous": "<",
            // "next": ">",
          }
        }
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
      });

    //Select 2
    $('.select2').select2({
      theme: "default",
    });

    // Replacde slug
    $('#title').on('blur', function(){
      var theTitle  = this.value.toLowerCase().trim(),
          slugInput = $('#slug');
          theSlug = theTitle.replace(/&/g, '-and-')
                              .replace(/[^a-z0-9-]+/g, '-')
                              .replace(/\-\-+/g, '-')
                              .replace(/^-+|-+$/g, '');
      slugInput.val(theSlug);
    });

    
    $(function () {
        // Bootstrap datepicker 1.9.0 : Khong chon duoc time
        // $('#published_at').datepicker({
        //   todayHighlight: true,
        //   format: "dd/mm/yyyy",
        //   today: "Today",
        //   calendarWeeks: true,
        //   weekStart: 1,
        //   clearBtn: true,
        //   // daysOfWeekHighlighted: '0123456',
        //   // endDate: '0d',
        //   todayBtn: true
        // });

        // daterangePicker 3.0.5: khong chon duoc ngay hien tai
        $('#published_at').daterangepicker({
          singleDatePicker: true,
          timePicker: true,
          locale: {
            format: 'YYYY-MM-DD HH:mm:ss',
            // format: 'DD/MM/YYYY',
            daysOfWeek: [
              "CN",
              "T2",
              "T3",
              "T4",
              "T5",
              "T6",
              "T7"
            ],
            firstDay: 1,
            cancelLabel: "Cancel",
            // toLabel: "To"
            customRangeLabel: "Custom",
            
          },
          showWeekNumbers: true,
          timePicker24Hour: true,
          minDate: "01/01/1900",
          // maxDate: "01/01/2100",
          showDropdowns: true,
          autoApply: true,
        });

    });

    //Summernote
    $('#excerpt').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
            ['fontsize', ['fontsize']],
          ],
       
    });

    $('#draft-btn').click(function (e) {
      e.preventDefault();
      $('#post-form').submit();
    });
    
});