/* IMAGE SLIDER - HOME */


// Selektion alle Slides
const allSlides = document.querySelectorAll(".slide");

// zu Beginn ein leeres Array namens 'state'
const state = [];

// forEach loop durch alle Slides und zuweisung von Klassen (html)
// 1. Slide = 'right', 2. slide = 'active', 3. Slide = 'left', alle andern Slides haben keine Klasse 
// push -> adds the specified elements to the end of an array and returns the new length of the array
allSlides.forEach(function (element, index) {
    if (index === 0) {
        state.push( 'right');
    } else if (index === 1) {
        state.push( 'active');
    } else if (index === 2) {
        state.push( 'left');
    } else {
        state.push( '');
    }
});

// Interval von 3 Sekunden
const sliderInterval = 3000;

// true = der Slider läuft / false = der Slider pausiert
let autoSlide = true;

// ID um den Intervall zu stoppen ( mit clearInterval)
let autoSlideTimer = null;

/**
 * weist den Slides anhand vom Array 'state' Klassen zu 
*/
function mapStateToSlides(){
    allSlides.forEach(function(element, index){
        // entfernt alle Klassen vom Slide
        element.classList.remove('left', 'right', 'active');
        // wenn das Element eine Klasse erhalten soll, wird ihm die entsprechende zugewiesen 
        // (braucht es keine Klasse, passiert nichts)
        if (state[index] !== ''){
            element.classList.add(state[index]);
            // wenn das Element die Klasse 'active' bekommt, 
            if (state[index] == 'active'){
                const description = element.querySelector("img").alt;
                // wird im alt-attribut des "img" die description geholt
                // text im p element aktualisieren anhand der variable "description"
                document.querySelector(".description p").innerText = description;
            }
        } 
    })
};

// deklaration moveRight Funktion
function moveRight() {

    // mit pop wird das letzte Element aus dem Array herausgenommen
    const lastSlide = state.pop();
    // und mit unshift am Anfang hinzugefügt
    state.unshift(lastSlide);

    mapStateToSlides();

};

// deklaration moveLeft Funktion
function moveLeft() {

    // mit shift wird das erste Element aus dem Array herausgenommen
    const firstSlide = state.shift();
    // und mit push am Ende hinzugefügt
    state.push(firstSlide);

    mapStateToSlides();
};

function startSlide() {
    mapStateToSlides();
    // setInterval: startet Funktion moveRight mit sliderInterval (3s)
    autoSlideTimer = setInterval(moveRight, sliderInterval);
};

function pauseSlide() {
    clearInterval(autoSlideTimer);
};


document.querySelector(".pause-play").addEventListener("click", () => {
    // autoSlide ist "true" (läuft)
    if (autoSlide === true) {
        // dann interval stoppen und autoSlideTimer bei null (0) starten
        pauseSlide();
        // autoSlide ist jetzt "false" (angehlaten)
        autoSlide = false;
    } else {
        // autoSlide ist "true" (läuft)
        autoSlide = true;
        // startSlide ausführen
        startSlide();
    }
});

// Eventlistener für den klick auf die Pfeile
document.querySelector(".slider-btn-left").addEventListener("click", function () {
    pauseSlide();
    moveLeft();
    startSlide();
});
document.querySelector(".slider-btn-right").addEventListener("click", function () {
    pauseSlide();
    moveRight();
    startSlide();
});

startSlide();
