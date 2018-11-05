$(function () {

  /* Varibales */
  $.fn.selectpicker.Constructor.BootstrapVersion = '4';
  var myUpload = new FileUploadWithPreview('myUploader');
  var reptype = $('#repType');
  var pstatus = $('#pStatus');
  var amount = $("#amount");

  /* Functions */

  var options = {
    url: baseurl + "assets/countries.json",
    getValue: "name",
    list: {
      match: {
        enabled: true
      },
      maxNumberOfElements: 8
    },
    theme: "plate-dark"
  };

  $("#plate").easyAutocomplete(options);

  var populateGemstone = function () {
    var toAppend;
    var selectpicker = $('.selectpicker');
    $.ajax({
      url: baseurl + 'admin/report/gemstone/gem-list',
      type: 'GET',
      dataType: 'JSON',
      success: function(data) {
        $.each(data, function(key, value) {
          toAppend = "";
          toAppend += '<option value="' + value.gemid + '">' + value.gem_name + '</option>';
          selectpicker.append(toAppend);
        });
      },
      fail: function() {
        console.log("error");
      }
    });
    selectpicker.change(function() {
      if(this.selectedIndex == 0) {
        console.log('Select other than Choose');
      }
      else {
        $('input[name="variety"]').val(this.options[this.selectedIndex].text);
      }
    });
  };

  // Function to Add Report
  var addReport = function () {
    var form = $('#formReport');
    $.ajax({
      url: form.attr("action"),
      data: form.serialize(),
      type: form.attr("method"),
      dataType: 'JSON',
      beforeSend: function () {
        $('#messageModal').modal('show');
        $('#messageModal .modal-body').html('<div class="alert alert-info-alt">Validating your report...</div>');
      },
      success: function (response) {
        if (response.isValid) {
          $('#messageModal .modal-body')
          .html('<div class="alert alert-success-alt">Report Created successfully</div>');

        }
        else {
          alert('not valid');
        }
      }
    });
    //return false;
  };

  /* Binding */

  // Create
  $('#formReport').on("click", ".addReport", function(event) {
    event.preventDefault();
    addReport();
  });

  populateGemstone();

}); // End of document ready
