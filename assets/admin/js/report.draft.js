$(function(){var r=$("#rowCount").find(":selected").text(),l='<i class="fa fa-spinner fa-pulse fa-lg fa-fw d-block mx-auto text-white"></i><span class="sr-only">Loading...</span>',a=$("#option1, #option2, #option3"),s=new hullabaloo,i=function(a,t){$.ajax({url:baseurl+"admin/report/draft/handler/populate-draft/"+a+"/",type:"GET",dataType:"html",data:{page:a,rows:t},beforeSend:function(){$("#draftTable").html(l)},success:function(a){$("#draftTable").html(""),$("#draftTable").html(a)},fail:function(a,t,e){console.log(e)}})},t=function(a){$.ajax({url:baseurl+"admin/report/handler/id",type:"GET",dataType:"html",data:{repotype:a},success:function(a){$("#repid").val(a)},fail:function(){console.log("Error")}})};$("#customer").autocomplete({source:function(a,e){$.ajax({url:baseurl+"admin/customers/customer/append-customer",dataType:"json",data:{q:a.term}}).success(function(a){var t=$.map(a,function(a,t){return{label:a.firstname+" "+a.lastname,value:a.firstname+" "+a.lastname,id:a.custid}});e(t)})},minLength:1,select:function(a,t){$("#customerID").val(t.item.id)}}),$("#shapecutField").autocomplete({source:function(a,e){$.ajax({url:baseurl+"admin/report/handler/populate-shapecut",dataType:"json",data:{q:a.term}}).success(function(a){var t=$.map(a,function(a,t){return{label:a.shapecut,value:a.shapecut}});e(t)})},minLength:2}),$("#colorField").autocomplete({source:function(a,e){$.ajax({url:baseurl+"admin/report/handler/populate-color",dataType:"json",data:{q:a.term}}).success(function(a){var t=$.map(a,function(a,t){return{label:a.color,value:a.color}});e(t)})},minLength:2}),a.click(function(){"option1"==this.id?($("#repotype").val($(this).data("value")),t($(this).data("value"))):"option2"==this.id?($("#repotype").val($(this).data("value")),t($(this).data("value"))):"option3"==this.id&&($("#repotype").val($(this).data("value")),t($(this).data("value")))}),i(1,r),$("#pStatus").change(function(){"paid-advance"==$(this).val()?$("#adField").show():$("#adField").hide()}),$("#rowCount").on("change",function(){i(1,this.value)}),$("#searchId").keyup(function(){var a,t=$(this).val();2<=t.length&&(a=t,$.ajax({url:baseurl+"admin/report/draft/handler/populate-draft",type:"GET",dataType:"html",data:{search:!0,id:a},beforeSend:function(){$("#draftTable").html(l)},success:function(a){$("#draftTable").html(""),$("#draftTable").html(a)},fail:function(a,t,e){console.log(e)}}))}),$("#paymentModal").on("hidden.bs.modal",function(a){$("#paymentForm").trigger("reset"),$("#adField").hide()});var e={pagination:function(a){a.preventDefault();var t=$(this).data("ci-pagination-page");i(t,r)},reload:function(a){a.preventDefault(),$("#rowCount").prop("selectedIndex",0),$("#searchId").val(""),i(1,r)},saveDraft:function(a){var t,e,n,o;a.preventDefault(),t=$("#addReportDraft"),e=new FormData,n=$("#customerID").val(),o=t.serializeArray(),$.each(o,function(a,t){e.append(t.name,t.value)}),e.append("customer",n),$.ajax({url:t.attr("action"),type:t.attr("method"),dataType:"JSON",data:e,processData:!1,contentType:!1,beforeSend:function(){$(".btn-save").html(l)},success:function(a){if($(".btn-save").html("Save"),a.auth)return s.send(a.message,"success"),i(1,r),$("#downlaodQrBtn").html('<a href="'+a.url+'" class="btn btn-sm btn-danger mt-3"><i class="fa fa-download fa-fw"></i> Download</a>'),e=null,t.trigger("reset"),!0;s.send(a.message,"danger")},error:function(a,t,e){s.send(e,"danger")}})},payment:function(){$("#pRepId").val($(this).data("id")),$("#pRepType").val($(this).data("type"))},saveAmount:function(a){var t,e,n;a.preventDefault(),t=$("#paymentForm"),e=new FormData,n=t.serializeArray(),$.each(n,function(a,t){e.append(t.name,t.value)}),$.ajax({url:t.attr("action"),type:t.attr("method"),dataType:"JSON",data:e,processData:!1,contentType:!1,beforeSend:function(){$("#payBtnSave").html(l)},success:function(a){if($("#payBtnSave").html("Save"),a.auth)return s.send(a.message,"success"),i(1,r),$("#receiptCount").text(a.total),$("#paymentModal").modal("hide"),e=null,t.trigger("reset"),!0;s.send(a.message,"danger")},error:function(a,t,e){s.send(e,"danger")}})}};$(document).on("click","a[data-action]",function(a){var t=$(this).data("action");"function"==typeof e[t]&&e[t].call(this,a)})});
//# sourceMappingURL=maps/report.draft.js.map