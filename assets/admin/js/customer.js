$(function(){var t=null,n=$("#formAddCustomer"),o=$("#formEditCustomer"),s=new hullabaloo,l='<i class="fa fa-spinner fa-spin fa-lg fa-fw d-block mx-auto text-primary mt-3"></i><span class="sr-only">Loading...</span>',i=$("#rowCount").find(":selected").text(),d=$("#allCustomerData"),u=function(e,a){$.ajax({url:baseurl+"admin/customers/customer/populate",type:"GET",dataType:"html",data:{page:e,rows:a},beforeSend:function(){d.html(l)},success:function(e){d.html(""),d.html(e)},fail:function(e,a,t){console.log(t)}})};if("customer"==window.location.pathname.split("/")[2]){u(1,i),$("#rowCount").on("change",function(){u(1,this.value)}),$("#searchCst").keyup(function(){var e,a=$(this).val();1<=a.length?(e=a,$.ajax({url:baseurl+"admin/customers/customer/populate",type:"GET",dataType:"html",data:{search:!0,query:e},beforeSend:function(){d.html(l)},success:function(e){d.html(""),d.html(e)},fail:function(e,a,t){console.log(t)}})):0==a.length&&u(1,10)});var c={add:function(e){e.preventDefault(),$("#addModal").modal("toggle")},adCustomer:function(e){e.preventDefault(),function(){t=new FormData;var a=$("#ajaxLoader"),e=n.serializeArray();$.each(e,function(e,a){t.append(a.name,a.value)}),$.ajax({url:n.attr("action"),type:n.attr("method"),dataType:"JSON",data:t,processData:!1,contentType:!1,beforeSend:function(){n.hide(),a.html(l)},success:function(e){if(a.html(""),n.show(),e.auth)return $("#addModal").modal("hide"),s.send(e.message,"success"),u(1,i),t=null,n.trigger("reset"),!0;s.send(e.message,"danger")},fail:function(e,a,t){console.log(t)}})}()},deleteModal:function(e){e.preventDefault(),$("#delModal").modal("toggle"),$("#cstid").val($(this).data("id"))},deleteCustomer:function(e){var a,t;e.preventDefault(),a=$("#cstid").val(),t=$(this).data("csrf"),$.ajax({url:baseurl+"admin/customers/customer/delete",type:"POST",dataType:"JSON",data:{cid:a,csrf_test_name:t},success:function(e){e.auth?($("#delModal").modal("hide"),s.send(e.message,"success"),u(1,i)):s.send(e.message,"danger"),a=null},fail:function(e,a,t){console.log(t)}})},editCustomer:function(e){e.preventDefault(),function(){t=new FormData;var a=$("#eLoader"),e=o.serializeArray();$.each(e,function(e,a){t.append(a.name,a.value)}),$.ajax({url:o.attr("action"),type:o.attr("method"),dataType:"JSON",data:t,processData:!1,contentType:!1,beforeSend:function(){a.html(l),o.hide()},success:function(e){if(a.html(""),o.show(),e.auth)return $("#editModal").modal("hide"),s.send(e.message,"success"),u(1,i),t=null,o.trigger("reset"),!0;s.send(e.message,"danger")},fail:function(e,a,t){console.log(t)}})}($(this).data("id"))},editModal:function(e){var a,t,n;e.preventDefault(),$("#editModal").modal("toggle"),a=$(this).data("id"),t=$(this).data("csrf"),n=$("#eLoader"),$.ajax({url:baseurl+"admin/customers/customer/populate-edit",type:"POST",dataType:"JSON",data:{cid:a,csrf_test_name:t},beforeSend:function(){n.html(l),o.hide()},success:function(e){if(n.html(""),o.show(),$.isEmptyObject(e)||null==e)return $("#editModal").modal("hide"),s.send("Unable to fetch data","danger"),console.log("empty"),!1;$("#eFname").val(e.firstname),$("#eLname").val(e.lastname),$("#eNumber").val(e.number),$("#eEmail").val(e.email),$("#customerEditId").val(e.custid)},fail:function(e,a,t){console.log(t)}})},reloadCustomer:function(e){e.preventDefault(),$("#rowCount").prop("selectedIndex",0),u(1,i)},pagination:function(e){e.preventDefault();var a=$(this).data("ci-pagination-page");u(a,i)}};$(document).on("click","a[data-action]",function(e){var a=$(this).data("action");"function"==typeof c[a]&&c[a].call(this,e)})}});
//# sourceMappingURL=maps/customer.js.map
