$(document).ready(function () {
  var frame;
  $('#upload-img').on('click', function (e) {
    e.preventDefault();
    load_wp_media('#img-preview', '#faculty-img');

  });

  /// load wp media

  function load_wp_media(imaToPrev, inputField) {


    // If the media frame already exists, reopen it.
    if (frame) {
      frame.open();
      return;
    }

    // Create a new media frame
    frame = wp.media({
      title: 'Choose Faculty Image',
      button: {
        text: 'Use Image'
      },
      multiple: false, // Set to true to allow multiple files to be selected
      allowLocalEdits: true,
      displaySettings: true,
      displayUserSettings: true,
    });

    // When an image is selected in the media frame...
    frame.on('select', function () {

      // Get media attachment details from the frame state
      var attachment = frame.state().get('selection').first().toJSON();

      // Send the attachment URL to our custom image input field.
      $(imaToPrev).attr("src", attachment.url);

      $(imaToPrev).addClass("img-preview");
      // Send the attachment id to our hidden input
      // imgIdInput.val( attachment.id );
      $(inputField).val(attachment.url);
      $(inputField).attr('img-id', attachment.id);
      // Hide the add image link
      // addImgLink.addClass( 'hidden' );

      // Unhide the remove image link
      // delImgLink.removeClass( 'hidden' );
    });

    // Finally, open the modal on click
    frame.open();

  }
  $('#faculty-table').DataTable();
  // load faculty
  function loadfaculty() {
    $.ajax({
      url: faculty_admin_obj.ajax_url,
      method: "GET",
      data: {
        action: "loadFaculty",
      },
      beforeSend: function () {
        $('.fullbodyoverlay').css('display', 'block');
      },
      success: function (data) {
        $('.fullbodyoverlay').css('display', 'none');
        console.log(data);
        data1 = [];
        console.log(($(data.data).length));
        for (var i = 1; i <= $(data.data).length - 1; i++) {
          console.log([data.data[i]])

          array = $.map(data.data[i], function (value, index) {
            // console.log( [value]);
            return [value];
          });
          data1.push(array);

        };
        console.log(data1);
        $('#example').DataTable({
          data: data1,
          columns: [
            { title: "sr" },
            { title: "Name" },
            { title: "Schoole Name" },
            { title: "Images" },
            // { title: "Action." },
            { title: "id." },
          ]
        });

      },
      error: function (data) {

      }
    });

  }
  // loadfaculty();

  ///add faculty 
  $('#addFaculty').submit(function (e) {
    e.preventDefault();
    var action = $('#addFaculty').attr('action');
    var fname = $('#faculty-name').val();
    var schoolename = $('#school-name').val();
    var schoolid = $('#faculty-school-id').val();
    var fid = $('#faculty-id').val();
    var facultynonce = $('input[name=faculty-nonce]').val();
    var imgurl = $('#faculty-img').val();
    if (fname == '' || fname == null) {
      alert('Faculty name is required');
      return;
    } else if (schoolename == '' || schoolename == null) {
      alert('School name is required');
      return;
    } else if (schoolid == '' || schoolid == null || isNaN(Number(schoolid))) {
      alert('School ID is required and it must be number');
      return;
    }
    else if (fid == '' || fid == null ||isNaN(Number(fid))) {
      alert('Faculty ID is required and it must be number');
      return;
    } else if (imgurl == '' || imgurl == null) {
      alert('Image  is required');
      return;
    } else {
      data = {
        action: action,
        fname: fname,
        schoolename: schoolename,
        schoolid:schoolid,
        fid:fid,
        facultynonce: facultynonce,
        imgurl: imgurl
      }
      $.ajax({
        url: faculty_admin_obj.ajax_url,
        method: 'POST',
        data: data,
        beforeSend: function () {
          $('.fullbodyoverlay').css('display', 'block');
        },
        success: function (data) {
          $('.fullbodyoverlay').css('display', 'none');
          if (data.success) {
            alert(data.data);
            location.reload();
          }
        },
        error: function (data) {
          // console.log('e');
          console.log(data);

        }

      });

    }


  });

  ///delete faculty
  $('#faculty-table').on('click', "img.delete-faculty", function () {
    delte_data_id = $(this).attr('delete-faculty');
    $.ajax({
      url: faculty_admin_obj.ajax_url,
      method: 'POST',
      data: {
        action: 'deleteFaculty',
        delte_data_id: delte_data_id,
      },
      beforeSend: function () {
        $('.fullbodyoverlay').css('display', 'block');
      },
      success: function (data) {
        $('.fullbodyoverlay').css('display', 'none');
        console.log(data);
        alert(data.data)
        location.reload();
      },
      error: function (data) {

      }
    });
  })

  // edit faculty 

  $('#faculty-table').on('click',"img.edit-faculty", function (e) {
    e.preventDefault();
    editid = $(this).attr('edit-faculty');
    $.ajax({
      url: faculty_admin_obj.ajax_url,
      method: 'POST',
      data: {
        action: 'editFaculty',
        editid: editid,
      },
      beforeSend: function () {
        $('.fullbodyoverlay').css('display', 'block');
      },
      success: function (data) {
        $('.fullbodyoverlay').css('display', 'none');
        $('#UpdateFaculty').attr('updateFacultyId', data.data[0]['id']);
        $('#facultyUpdateModal').modal('show');
        $('#update-img-preview').attr("src", data.data[0]['image_url']);
        $('#update-faculty-name').val(data.data[0]['name']);
        $('#update-faculty-school').val(data.data[0]['school_name']);
        $('#update-faculty-school-id').val(data.data[0]['school_order']);
        $('#update-faculty-id').val(data.data[0]['faculty_order']);
        $('#update-faculty-img').val(data.data[0]['image_url']);


        $('#update-img-preview').addClass("img-preview");
      },
      error: function (data) {

      }
    });

  });

  //update faculty
  $('#update-img').on('click', function (e) {
    e.preventDefault();
    load_wp_media('#update-img-preview', '#update-faculty-img');

  });
  $('#UpdateFaculty').submit(function (e) {
    e.preventDefault();
    var action = $('#UpdateFaculty').attr('action');
    var id = $('#UpdateFaculty').attr('updateFacultyId');
    var fname = $('#update-faculty-name').val();
    var schoolename = $('#update-faculty-school').val();    
    var schoolid = $('#update-faculty-school-id').val();
    var fid = $('#update-faculty-id').val();
    var facultynonce = $('input[name=update_faculty-nonce]').val();
    var imgurl = $('#update-faculty-img').val();
    if (fname == '' || fname == null) {
      alert('Faculty name is required');
      return;
    } else if (schoolename == '' || schoolename == null) {
      alert('School name is required');
      return;
    } else if (schoolid == '' || schoolid == null || isNaN(Number(schoolid))) {
      alert('School ID is required and it must be number');
      return;
    }
    else if (fid == '' || fid == null  || isNaN(Number(fid))) {
      alert('Faculty ID is required and it must be number');
      return;
    } else if (imgurl == '' || imgurl == null) {
      alert('Image  is required');
      return;
    } else {
      data = {
        action: action,
        fname: fname,
        schoolename: schoolename,
        facultynonce: facultynonce,
        imgurl: imgurl,
        id: id,
        fid:fid,
        schoolid:schoolid,
      }
      $.ajax({
        url: faculty_admin_obj.ajax_url,
        method: 'Post',
        data: data,
        success: function (data) {
          console.log('s');
          if (data.success) {
            alert(data.data);
            location.reload();
          }
        },
        error: function (data) {
          // console.log('e');
          console.log(data.data);

        }

      });

    }


  });



});