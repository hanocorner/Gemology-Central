$(function(){var e=$("#option1, #option2, #option3"),o='<i class="fa fa-spinner fa-pulse fa-lg fa-fw d-block mx-auto text-white"></i><span class="sr-only">Loading...</span>',r=new hullabaloo,a=function(e){$.ajax({url:baseurl+"admin/report/handler/id",type:"GET",dataType:"html",data:{repotype:e},success:function(e){$("#repid").val(e)},fail:function(){console.log("Error")}})},t=JSON.parse('{"csrf_test_name": "'+$("input[name=csrf_test_name]").val()+'" } ');$(".target").upload({action:baseurl+"admin/report/image/index",dataType:"JSON",maxConcurrent:0,maxSize:2097152,multiple:!1,postData:t}).on("filecomplete.upload",function(e,a,t){if(t.status){var n=baseurl+"images/gem/"+t.image_path+t.image_name;$("#imagegem").attr("src",n),$("#imgPath").val(t.image_path),$("#imgName").val(t.image_name)}else r.send(t.message,"danger")}).on("fileerror.upload",function(e,a,t){r.send(t,"danger")}).on("start.upload",function(e,a){console.log("File Start")}),$("#newGem").autocomplete({source:function(e,t){$.ajax({url:baseurl+"admin/report/gemstone/populate",dataType:"json",data:{q:e.term}}).success(function(e){var a=$.map(e,function(e,a){return{label:e.name,value:e.name,id:e.gemid}});t(a)})},minLength:1,select:function(e,a){$("#gemid").val(a.item.id),$("input[name=variety]").val(a.item.value)}}),$("#customer").autocomplete({source:function(e,t){$.ajax({url:baseurl+"admin/customers/customer/append-customer",dataType:"json",data:{q:e.term}}).success(function(e){var a=$.map(e,function(e,a){return{label:e.firstname+" "+e.lastname,value:e.firstname+" "+e.lastname,id:e.custid}});t(a)})},minLength:1,select:function(e,a){$("#customerid").val(a.item.id)}}),$("#sgField").autocomplete({source:function(e,t){$.ajax({url:baseurl+"admin/report/handler/populate-spgroup",dataType:"json",data:{q:e.term}}).success(function(e){var a=$.map(e,function(e,a){return{label:e.spgroup,value:e.spgroup}});t(a)})},minLength:2}),$("#shapecutField").autocomplete({source:function(e,t){$.ajax({url:baseurl+"admin/report/handler/populate-shapecut",dataType:"json",data:{q:e.term}}).success(function(e){var a=$.map(e,function(e,a){return{label:e.shapecut,value:e.shapecut}});t(a)})},minLength:2}),$("#colorField").autocomplete({source:function(e,t){$.ajax({url:baseurl+"admin/report/handler/populate-color",dataType:"json",data:{q:e.term}}).success(function(e){var a=$.map(e,function(e,a){return{label:e.color,value:e.color}});t(a)})},minLength:2}),e.click(function(){"option1"==this.id?($("#repotype").val($(this).data("value")),a($(this).data("value"))):"option2"==this.id?($("#repotype").val($(this).data("value")),a($(this).data("value"))):"option3"==this.id&&($("#repotype").val($(this).data("value")),a($(this).data("value")))}),$("input[name=radio-1]").checkboxradio({icon:!1});var n={update:function(e){e.preventDefault(),function(){var e=$("#updateReportForm"),t=new FormData(e),a=e.serializeArray();$.each(a,function(e,a){t.append(a.name,a.value)});var n=CKEDITOR.instances.editor1.getData();t.append("comment",n),$.ajax({url:e.attr("action"),type:e.attr("method"),dataType:"JSON",data:t,processData:!1,contentType:!1,beforeSend:function(){$("#updateReport").html(o)},success:function(e){if($("#updateReport").html("Update Report"),e.auth)return r.send(e.message,"success"),t=null,location.href=e.url,!0;r.send(e.message,"danger")},error:function(e,a,t){r.send(t,"danger")}})}()},addReport:function(e){e.preventDefault(),function(){var a=$("#formAddReport"),t=new FormData(a),e=a.serializeArray();$.each(e,function(e,a){t.append(a.name,a.value)});var n=CKEDITOR.instances.editor1.getData();t.append("comment",n),$.ajax({url:a.attr("action"),type:a.attr("method"),dataType:"JSON",data:t,processData:!1,contentType:!1,beforeSend:function(){$(".add-report").html(o)},success:function(e){if($(".add-report").html("Add Report"),e.auth)return $("#successModal").modal({backdrop:"static",keyboard:!1}),$("#qrCodeBtn").attr("href",e.url),t=null,a.trigger("reset"),!0;r.send(e.message,"danger")},error:function(e,a,t){r.send(t,"danger")}})}()},saveGemstone:function(e){var a,t,n;a=$("#formVariety"),t=new FormData(a),n=a.serializeArray(),$.each(n,function(e,a){t.append(a.name,a.value)}),$.ajax({url:a.attr("action"),type:a.attr("method"),dataType:"JSON",data:t,processData:!1,contentType:!1,beforeSend:function(){$("#saveGem").html(o)},success:function(e){if($("#saveGem").html("Save Vareity"),e.auth)return r.send(e.message,"success"),t=null,a.trigger("reset"),$("#gemModal").modal("hide"),!0;r.send(e.message,"danger")},fail:function(e){r.send(e,"success")}})}};$(document).on("click","a[data-action]",function(e){var a=$(this).data("action");"function"==typeof n[a]&&n[a].call(this,e)})});
//# sourceMappingURL=maps/report.js.map
