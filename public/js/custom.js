$(document).ready(function() {
  
      

    //Select 2
    $('.select2').select2({
      theme: "default",
    });

    // Replacde slug
    $('#title').on('blur', function(){
      var theTitle  = this.value.toLowerCase().trim(),
          slugInput = $('#slug');
          // theSlug = theTitle.replace(/&/g, '-and-')
          //                     .replace(/[^a-z0-9-]+/g, '-')
          //                     .replace(/\-\-+/g, '-')
          //                     .replace(/^-+|-+$/g, '');
          
          //Đổi ký tự có dấu thành không dấu
          theSlug = theTitle.replace(/&/g, '-va-')
                            // .replace(/[^a-z0-9-]+/g, '-')
                            .replace(/\-\-+/g, '-')
                            .replace(/^-+|-+$/g, '')

                            .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
                            .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
                            .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
                            .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
                            .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
                            .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
                            .replace(/đ/gi, 'd')
                            //Xóa các ký tự đặt biệt
                            .replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '')
                            //Đổi khoảng trắng thành ký tự gạch ngang
                            .replace(/ /gi, "-")
                            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                            .replace(/\-\-\-\-\-/gi, '-')
                            .replace(/\-\-\-\-/gi, '-')
                            .replace(/\-\-\-/gi, '-')
                            .replace(/\-\-/gi, '-');
          //Xóa các ký tự gạch ngang ở đầu và cuối
          theSlug = '@' + theSlug + '@';
          theSlug = theSlug.replace(/\@\-|\-\@|\@/gi, '');
          //In slug ra textbox có id “slug”
          // document.getElementById('slug').value = slug;
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


        // DUNG TOT, CHON DUOC NGAY THANG NAM, GIO PHUT GIAY
        // daterangePicker 3.0.5: khong chon duoc ngay hien tai
        // $('#published_at').daterangepicker({
        //   singleDatePicker: true,
        //   timePicker: true,
        //   locale: {
        //     format: 'YYYY-MM-DD HH:mm:ss',
        //     // format: 'DD/MM/YYYY',
        //     daysOfWeek: [
        //       "CN",
        //       "T2",
        //       "T3",
        //       "T4",
        //       "T5",
        //       "T6",
        //       "T7"
        //     ],
        //     firstDay: 1,
        //     cancelLabel: "Cancel",
        //     // toLabel: "To"
        //     customRangeLabel: "Custom",
            
        //   },
        //   showWeekNumbers: true,
        //   timePicker24Hour: true,
        //   minDate: "01/01/1900",
        //   // maxDate: "01/01/2100",
        //   showDropdowns: true,
        //   autoApply: true,
        // });



        

    });

    

    
    
});