function comments(url) {
  var commentTable = $('#commentTable').DataTable({
    "scrollX": true,
    "pagingType": "first_last_numbers",
    "processing": true,
    "serverSide": true,
    "ordering": false,
    "ajax":{
      url:url+"admin/comment/all", // json datasource
      type:"POST"
    },
    "columns": [
      {
        "className": 'details-control',
        "orderable": false,
        "data": null,
        "defaultContent": ''
      },
      {"data":"commentid"},
      {"data":"cmnt_content"},
      {"data":"cmnt_author"},
      {
        "data": function (e) {
          if(e.cmnt_status == 0){
            var btn = '<a href="#" data-id="'+e.commentid+'" data-status="1" class="btn btn-success" id="cmntAccept">'+'<i class="fa fa-check" aria-hidden="true"></i>&nbsp;Accept'+'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
          }
          if (e.cmnt_status == 1) {
            var btn = '<a href="#" data-id="'+e.commentid+'" data-status="0" class="btn btn-dark" id="cmntAccept">'+'<i class="fa fa-times" aria-hidden="true"></i>&nbsp;Unaccept'+'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
          }
          return btn+
                 '<a href="#" data-id="'+e.commentid+'" class="btn btn-danger delete"  data-toggle="modal" data-target="#deleteModal">'+'<i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Delete'+'</a>';
         }
      }
    ]
  });
}

function format (d) {
  // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.cerno+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.cer_shape+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';

}
