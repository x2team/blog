$(document).ready(function() {
    //dataTables
      $("#example1").DataTable({
        "lengthMenu": [3, 25, 50, "All"],
        "order": [[4, "asc"]],
        "language": {
          "paginate": {
            "previous": "<",
            "next": ">",
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
      // var theTitle  = this.value.toLowerCase().trim(),
          slugInput = $('#slug');
          // theSlug = theTitle.replace(/&/g, '-and-')
          //                     .replace(/[^a-z0-9-]+/g, '-')
          //                     .replace(/\-\-+/g, '-')
          //                     .replace(/^-+|-+$/g, '');
      


      
          var title, slug;
      
          //Lấy text từ thẻ input title 
          //title = document.getElementById("title").value;
          title  = this.value.toLowerCase(),
      
          //Đổi chữ hoa thành chữ thường
          slug = title.toLowerCase();
      
          //Đổi ký tự có dấu thành không dấu
          slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
          slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
          slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
          slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
          slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
          slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
          slug = slug.replace(/đ/gi, 'd');
          //Xóa các ký tự đặt biệt
          slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
          //Đổi khoảng trắng thành ký tự gạch ngang
          slug = slug.replace(/ /gi, " - ");
          //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
          //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
          slug = slug.replace(/\-\-\-\-\-/gi, '-');
          slug = slug.replace(/\-\-\-\-/gi, '-');
          slug = slug.replace(/\-\-\-/gi, '-');
          slug = slug.replace(/\-\-/gi, '-');
          //Xóa các ký tự gạch ngang ở đầu và cuối
          slug = '@' + slug + '@';
          slug = slug.replace(/\@\-|\-\@|\@/gi, '');
          //In slug ra textbox có id “slug”
          document.getElementById('slug').value = slug;
      
          // slugInput.val(slug);

    });

    ////Bootstrap datepicker 1.9.0 : Khong chon duoc time
    $(function () {
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
          timePicker: false,
          locale: {
            // format: 'DD/MM/YYYY HH:mm A',
            format: 'DD/MM/YYYY',
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
    
});