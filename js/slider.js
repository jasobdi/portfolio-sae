/* IMAGE SLIDER - HOME */ 


// Selektion Slider
const slider = document.querySelector(".slider");

// Selektion alle Slides
function getAllSlides() {
    return document.querySelectorAll(".slide");
}

// Eventlistener für den klick auf die Pfeile
document.querySelector(".left").addEventListener("click", moveLeft);
document.querySelector(".right").addEventListener("click", moveRight);

// current slide iteration auf 1
let currentSlide = 1;

// deklaration moveRight Funktion
function moveRight () {
    const allSlides = getAllSlides();
    // durch append wird das ausgewählte element am ende des arrays (.slider) hinzugefügt
    slider.append(allSlides[0]);
    changeCurrentSlide("right");
    updateDescription();
}

// deklaration moveLeft Funktion
function moveLeft () {
    const allSlides = getAllSlides();
    // durch prepend wird das ausgewählte element am anfang des arrays (.slider) hinzugefügt
    slider.prepend(allSlides[allSlides.length - 1]);
    changeCurrentSlide("left");
    updateDescription();
}

// deklaration changeCurrentSlide Funktion
function changeCurrentSlide (direction) {
    const allSlides = getAllSlides();
    // bei direction "right":
    if (direction === "right") {
        // ist currentSlide 5, dann wechseln zu Slide 1, sonst auf den nächst höheren Slide
        currentSlide === allSlides.length ? (currentSlide = 1) : currentSlide++;
    } else {
        // bei direction "left": 
        // ist currentSlide 1, dann auf Slide 5 wechseln, sonst auf den nächst kleineren Slide
        currentSlide === 1 ? (currentSlide = allSlides.length) : currentSlide--;
    }
}

// deklaration updateDescription Funktion
function updateDescription () {
    const allSlides = getAllSlides();
    // mit variable alle Slides selektieren / erstes element im array (mit iteration 0) / img elemen & alt text
    const description = allSlides[0].querySelector("img").alt;
    // text im p element aktualisieren anhand der variable "description"
    document.querySelector(".description p").innerText = description;
}

// auf das HTML-Element mit der Klasse .pause-play einen Click-Eventlistener ansetzen
document.querySelector(".pause-play").addEventListener("click", ()=> {
    // autoSlide ist "true" (läuft)
    if(autoSlide === true) {
        // dann interval stoppen und autoSlideTimer bei null (0) starten
        clearInterval(autoSlideTimer)
        // autoSlide ist jetzt "false" (angehlaten)
        autoSlide = false; 
    } else {
        // autoSlide ist "true" (läuft)
        autoSlide = true;
        // navigationSlider ausführen
        navigateSlider()
    }
});

// deklaration navigateSlider Funktion
function navigateSlider () {
    // autoSlide ist "true" (läuft)
    if(autoSlide === true) {
        // variabel autoSlideTimer startet bei 0 und führt den Interval anhand der moveRight Funktion 
        // und der festgelegten Zeit für den Interval aus
        // -> die Slides bewegen sich alle 3 Sekunden nach rechts
        autoSlideTimer = setInterval (
            function () {
            moveRight();}, 
        sliderInterval);
    }
}

// Auto Slider intervall 3 Sekunden
let autoSlide = true;
const sliderInterval = 3000;
let autoSlideTimer = null;

if(autoSlide === true) {
    navigateSlider()
}

updateDescription();

