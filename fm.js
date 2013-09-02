(function($) {

    $.fn.fm = function(bd) {

if (bd==undefined || bd=='') {
	bd=".";

}

jQuery.expr[':'].Contains = function(a,i,m){ return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0; };

el=this;

$.post("ajax_fm.php",{bd:bd},function(result){
    el.html(result);
  });
  


  el.on("click",".dir",function(){
  data=$(this).attr("href");
  p=$('.pd').attr("href");
$.post("ajax_fm.php",{bd:bd,d:data},function(result){
      el.html(result);
  });

  return false;
});  

  el.on("keyup","#filter",function(){
filter=$(this).val();
if (filter!='') {
el.find("a:not(:Contains(" + filter + "))").parent("li").hide("fast");
el.find("a:Contains(" + filter + ")").parent("li").show("fast");
} 
else {
el.find("a").parent("li").show("fast");
}

});



    }

}(jQuery));
