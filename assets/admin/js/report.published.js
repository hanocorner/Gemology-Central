$(function(){var e=$("#rowCount").find(":selected").text(),n='<i class="fa fa-spinner fa-pulse fa-lg fa-fw d-block mx-auto text-white"></i><span class="sr-only">Loading...</span>',o=($("#option1, #option2, #option3"),new hullabaloo,$("#formAdvanceSearch")),i=function(a,t){$.ajax({url:baseurl+"admin/report/handler/populate-published/"+a+"/",type:"GET",dataType:"html",data:{page:a,rows:t},beforeSend:function(){$("#publishedData").html(n)},success:function(a){$("#publishedData").html(""),$("#publishedData").html(a)},fail:function(a,t,e){console.log(e)}})};i(1,e),$("#rowCount").on("change",function(){i(1,this.value)});var l={pagination:function(a){a.preventDefault();var t=$(this).data("ci-pagination-page");i(t,e)},reload:function(a){a.preventDefault(),$("#rowCount").prop("selectedIndex",0),$("#searchId").val(""),i(1,e)},advanceSearch:function(a){var e,t;a.preventDefault(),e=new FormData,t=o.serializeArray(),$.each(t,function(a,t){e.append(t.name,t.value)}),e.append("search",!0),$.ajax({url:o.attr("action"),type:"POST",dataType:"html",data:e,processData:!1,contentType:!1,beforeSend:function(){$("#publishedData").html(n)},success:function(a){$("#publishedData").html(""),$("#publishedData").html(a)},fail:function(a,t,e){console.log(e)}})},resetAdSearch:function(a){a.preventDefault(),o.trigger("reset"),i(1,e)}};$(document).on("click","a[data-action]",function(a){var t=$(this).data("action");"function"==typeof l[t]&&l[t].call(this,a)})});
//# sourceMappingURL=maps/report.published.js.map
