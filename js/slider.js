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
        state.push('right');
    } else if (index === 1) {
        state.push('active');
    } else if (index === 2) {
        state.push('left');
    } else {
        state.push('');
    }
});

// Interval von 6 Sekunden
const sliderInterval = 6000;

// true = der Slider läuft / false = der Slider pausiert
let autoSlide = true;

// ID um den Intervall zu stoppen ( mit clearInterval)
let autoSlideTimer = null;

/**
 * weist den Slides anhand vom Array 'state' Klassen zu 
*/
function mapStateToSlides() {
    allSlides.forEach(function (element, index) {
        // entfernt alle Klassen vom Slide
        element.classList.remove('left', 'right', 'active');
        // wenn das Element eine Klasse erhalten soll, wird ihm die entsprechende zugewiesen 
        // (braucht es keine Klasse, passiert nichts)
        if (state[index] !== '') {
            element.classList.add(state[index]);
            // wenn das Element die Klasse 'active' bekommt, 
            if (state[index] == 'active') {
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

// click-event für alle Elemente mit der class "pause-play"
document.querySelectorAll(".pause-play").forEach(element => {
    element.addEventListener("click", (e) => {
        console.log(element.classList);


        // Play-Button mit der class "start" -> slides starten
        if (element.classList.contains("start")) {
            startSlide();
            // und Play-Button wird ausgeblendet
            element.classList.add("hidden");
            // Pause-Button wird eingeblendet
            document.querySelector(".pause-play.stop").classList.remove("hidden");

        // Pause-Button mit der class "stop" -> slides stoppen 
        } else if(element.classList.contains("stop")){
            pauseSlide();
            // und Pause-Button wird ausgeblendet
            element.classList.add("hidden");
            // Play-Button wird eingeblendet
            document.querySelector(".pause-play.start").classList.remove("hidden");
        }
    })
})

// const pausePlayButton = document.querySelector(".pause-play i");
// const colorChange = document.querySelector(".pause-button");

// // autoSlide ist "true" (läuft)
// if (autoSlide === true) {
//     // dann interval stoppen und autoSlideTimer bei null (0) starten
//     pauseSlide();
//     // autoSlide ist jetzt "false" (angehlaten)
//     autoSlide = false;

//     // Ändern des Icons zu "fa-play"
//     pausePlayButton.classList.remove("fa-pause");
//     pausePlayButton.classList.add("fa-play");

//     // Play-Button wird rosa
//     colorChange.classList.add("paused");
//     colorChange.classList.remove("playing");

// } else {
//     // autoSlide ist "true" (läuft)
//     autoSlide = true;
//     // startSlide ausführen
//     startSlide();

//     // Ändern des Icons zu "fa-pause"
//     pausePlayButton.classList.remove("fa-play");
//     pausePlayButton.classList.add("fa-pause");
// }

//     // Pause-Button wird dunkelblau
//     colorChange.classList.remove("playing");
//     colorChange.classList.add("paused");
// });

// Eventlistener für den klick auf die Pfeile
// document.querySelector(".slider-btn left").addEventListener("click", function () {
//     pauseSlide();
//     moveLeft();
//     startSlide();
// });
// document.querySelector(".slider-btn right").addEventListener("click", function () {
//     pauseSlide();
//     moveRight();
//     startSlide();
// });


// Click-Event für alle Elemente mit der class "slider-btn"
document.querySelectorAll('.slider-btn').forEach(element=>{
    element.addEventListener('click', ()=>{
        pauseSlide();
        if (element.classList.contains('left')){
            moveLeft();
        } else if (element.classList.contains('right')){
            moveRight();
        }
        startSlide();
    });
})


startSlide();
