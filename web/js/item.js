/*
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}*/

$(".star").click(function() {
    var id = parseInt(this.id);
    $("#evaluation_mark").val(id);
    for(var j = 0; j <= id; j++){
        $("#"+j).removeClass("empty-star").addClass("full-star").html("★");
    }
    for(var k = id + 1; k < 6; k++){
        $("#"+k).removeClass("full-star").addClass("empty-star").html("☆");
    }
});

