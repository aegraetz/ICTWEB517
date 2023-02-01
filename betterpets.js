/* SUBURB API */

(function() {
    var widget, initAddressFinder = function() {
        widget = new AddressFinder.Widget(
            document.getElementById('suburb'),
            'ADDRESSFINDER_DEMO_KEY',
            'AU', {
                "show_addresses": false,
                "show_locations": true,
                "location_params": {
                    "location_types": "locality"
                }
            }
        );
        widget.on('location:select', function(fullLocation, metaData) {
            document.getElementById('suburb').value = metaData.full_location
            document.getElementById('postcode').value = metaData.postcode;
        });
    };
    function downloadAddressFinder() {
        var script = document.createElement('script');
        script.src = 'https://api.addressfinder.io/assets/v3/widget.js';
        script.async = true;
        script.onload = initAddressFinder;
        document.body.appendChild(script);
    };
    document.addEventListener('DOMContentLoaded', downloadAddressFinder);
})(); 

/* IMAGE CHANGE DEPENDING ON USER PREFERENCE */

window.onload = () => {
	const user = localStorage.getItem("usertype");
	var Image_Id = document.getElementById('mainimage');
	if (user === "catperson") {
		Image_Id.src = "images/maincat.jpg";
	}
	else if (user === "dogperson") {
		Image_Id.src = "images/maindog.jpg";
	}
	else{
		Image_Id.src = "images/catdog.jpg";
	}
}

function changeusertype() {
	var Image_Id = document.getElementById('mainimage');
	if (Image_Id.src.match("images/maindog.jpg")) {
		Image_Id.src = "images/maincat.jpg";
		localStorage.setItem("usertype", "catperson");
	}
	else if (Image_Id.src.match("images/maincat.jpg")) {
		Image_Id.src = "images/catdog.jpg";
		localStorage.setItem("usertype", "both");
	}
	else {
		Image_Id.src = "images/maindog.jpg";
		localStorage.setItem("usertype", "dogperson");
	}
}  

document.getElementById("icon").addEventListener("load", iconchange());

function iconchange() {
	var icon = document.getElementById("icon");
	const user = localStorage.getItem("usertype");
	if (user === "dogperson") {
		icon.src = "images/dogw.png";
	}
	else if (user === "catperson") {
		icon.src = "images/catw.png";
	}
	else {
		icon.src = "images/cd.png";
	}
}

/* SERVICES SLIDES */

let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("slides");
  let dots = document.getElementsByClassName("dot");
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
}

/* LOG IN/SIGN UP FORM POP OUT */

function openForm() {
	document.getElementById("myForm").style.display = "block";
  }

  function loginForm() {
	document.getElementById("myLogin").style.display = "block";
	document.getElementById("myForm").style.display = "none";
  }
  
  function closeForm() {
	document.getElementById("myForm").style.display = "none";
  }

  function back(){
	document.getElementById("myForm").style.display = "block";
	document.getElementById("myLogin").style.display = "none";
  }

function passwordpopup() {
	document.getElementById("passmessage").style.display = "block";
  }
 
function passwordhide() {
	document.getElementById("passmessage").style.display = "none";
  }

/* PLAY DATE OPTIONS */

function pullInfo(n) {
  if (n == 1) {
    document.getElementById("breedtable").style.display = "flex";
    document.getElementById("agetable").style.display = "none";
    document.getElementById("gendertable").style.display = "none";
  }
  if (n == 2) {
    document.getElementById("agetable").style.display ="flex";
    document.getElementById("breedtable").style.display = "none";
    document.getElementById("gendertable").style.display = "none";
  }
  if (n == 3) {
    document.getElementById("gendertable").style.display = "flex";
    document.getElementById("breedtable").style.display = "none";
    document.getElementById("agetable").style.display = "none";
  }
}

function selectMatch(n) {
  var id = n;
  alert(id);
	document.getElementById("inviteForm").style.visibility = "visible";
  document.getElementById("inviteeid").setAttribute('value', id);
  }

function closeMatch() {
  document.getElementById("inviteForm").style.visibility = "hidden";
}