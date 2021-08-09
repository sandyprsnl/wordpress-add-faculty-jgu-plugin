jQuery(document).ready(function ($) {
    $('#load-more').on('click', function () {
        var schoolfilter = $("#select-schoole option:selected").val();
        if (schoolfilter == '*') {
            schoolfilter = '';
        }
        var namefilter = $("#namefilter").val();
        var row = Number($('#row').val());

        var rowperpage = 50;


        $.ajax({
            url: CPT_obj.ajax_url,
            method: "POST",
            data: {
                action: 'shortcodeAjaxLoadfaculty',
                row: row,
                schoolfilter: schoolfilter,
                namefilter: namefilter,
            },
            beforesend: function () {
                $('#load-more').text("Loading...");

            },
            success: function (data) {
                if (data.data.html != '') {
                    $('#all').val(data.data.total);
                    var allcount = Number($('#all').val());
                    if (row <= allcount) {
                        row = row + rowperpage;
                        $("#row").val(row);
                        $('#load-more-container').append(data.data.html);
                    }
                } else {
                    $('#load-more').text('No more faculties');
                    $('#load-more').fadeOut();
                }



                // console.log(data);
            },
            error: function (data) {

            }
        });

    });
    $('#load-more').trigger('click');

    //load schooles
    function loadschooles() {
        $.ajax({
            url: CPT_obj.ajax_url,
            method: "GET",
            data: {
                action: 'loadSchooles',
            },
            success: function (data) {
                $('#select-schoole').append(data.data);
                console.log(data);
            },
            error: function (result) {

            }
        });
    }
    loadschooles();

    //filters
    $('.search-faculty-btn').click(function () {

    });

    $('.search-faculty-btn').on('click', function () {
        $('#row').val(0);
        var schoolfilter = $("#select-schoole option:selected").val();
        if (schoolfilter == '*') {
            schoolfilter = '';
        }
        var namefilter = $("#namefilter").val();
        var row = Number($('#row').val());

        var rowperpage = 50;


        $.ajax({
            url: CPT_obj.ajax_url,
            method: "POST",
            data: {
                action: 'shortcodeAjaxLoadfaculty',
                row: row,
                schoolfilter: schoolfilter,
                namefilter: namefilter,
            },
            beforesend: function () {
                $('#load-more').text("Loading...");

            },
            success: function (data) {
                if (data.data.html != '') {
                    $('#all').val(data.data.total);
                    var allcount = Number($('#all').val());
                    if (row <= allcount) {
                        row = row + rowperpage;
                        $("#row").val(row);
                        $('#load-more-container').html('');
                        $('#load-more-container').append(data.data.html);
                    }
                } else {
                    $('#load-more').text('No more faculties');
                    $('#load-more').fadeOut();
                }



                // console.log(data);
            },
            error: function (data) {

            }
        });

    });

    //   function 
})(jQuery);