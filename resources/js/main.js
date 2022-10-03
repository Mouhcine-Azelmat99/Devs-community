$("#show").click(function(){
	$("#hide").fadeIn("slow");
	$(this).hide();
  });
$("#hide").click(function(){
	$("#show").fadeIn("slow");
	$(this).hide();
  });

// $("#mode").click(function(){
// 	$("#main").toggleClass("main-dark");
// 	$("body").toggleClass("dark");
// 	$("footer").toggleClass("dark");
// 	$("#nav-up").toggleClass("dark");
// 	$("#ressources").toggleClass("dark");
// 	$("#comment").toggleClass("dark");
// 	$("#saved").toggleClass("dark");
// 	$("#related_post").toggleClass("dark");
//     $(this).toggleClass("rotate");
// });
// $("#dark_mode").click(function(){
// 	$("#main").toggleClass("main-dark");
// 	$("body").toggleClass("dark");
// 	$("footer").toggleClass("dark");
// 	$("#nav-up").toggleClass("dark");
// 	$("#ressources").toggleClass("dark");
//     $(this).toggleClass("rotate");
// });
$("#login_show").click(function(){
	$("#login_form").show();
	$("#register_form").hide();
	$("#list_login").addClass("active");
	$("#list_register").removeClass("active");
});
$("#register_show").click(function(){
	$("#login_form").hide();
	$("#register_form").show();
	$("#list_login").removeClass("active");
	$("#list_register").addClass("active");
});


// When the user clicks on the button, scroll to the top of the document

var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("header").style.top = "0";
    } else {
        if (window.matchMedia('screen and (max-width: 768px)').matches) {
            document.getElementById("header").style.top = "-225px";
        }else{
            document.getElementById("header").style.top = "-165px";
        }
    }
    prevScrollpos = currentScrollPos;
}
