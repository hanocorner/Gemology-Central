$(function () {

  /* Varibales */
  $.fn.selectpicker.Constructor.BootstrapVersion = '4';
  var myUpload = new FileUploadWithPreview('myUploader');
  var reptype = $('input[name=repotype]');
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

  // Fetch ID Based on user select
  var getId = function () {
    $.ajax({
      url: baseurl + 'admin/report/handler/id',
      type: 'GET',
      dataType: 'html',
      data: {
        repotype: reptype.filter('input:checked').val()
      },
      success:function(data) {
        $('#id').val(data);
      },
      fail:function(){
        console.log('Error');
      }
    });
  }

  // Populating the gemstone field
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
  var addReport = function (fm) {

    var form = $('#formReport');

    $.ajax({
      url: form.attr("action"),
      type: form.attr("method"),
      dataType: 'JSON',
      data: new FormData(fm),
      processData: false,
      contentType: false,
      beforeSend: function () {
        $('#messageModal').modal('show');
        $('#messageModal .modal-body').html('<div class="alert alert-info-alt">Validating your report...</div>');
      },
      success: function (response) {
        if (response.auth) {
          $('#messageModal .modal-body').html('<div class="alert alert-success-alt">Report Created successfully</div>');
        }
        else {
          $('#messageModal .modal-body').html('<div class="alert alert-danger-alt">'+response.message+'</div>');
        }
        $('input[name=csrf_test_name]', '#formReport').val(response.csrf);
      },
      error: function(errorResponse) {
        console.log(errorResponse);
      }
    });

  };

  /* Binding */

  // Create
  //var formData = new FormData(this);
  $('form').on("submit", function(event) {
    event.preventDefault();
    addReport(this);
  });

  reptype.click(function() {
    if(reptype.is(':checked')) {
      getId();
    }
    else {
      alert('Select report type');
    }

  });

  populateGemstone();

}); // End of document ready
// Fetch ID Based on user select
function ajax(reportType) {


}
