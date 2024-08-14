/* PROJECTS - DATENBANKABFRAGE (projekte.json)*/


// url als Variable
const url = `api/projekte.json`;

// ausführen der asynchronen Funktion getData
getData(url);

// asynchrone Funktion holt die Daten aus der JSON.Datei
async function getData() {
    const response = await fetch(url);
    const data = await response.json()

    displayProjects(data);
};

// Funktion zeigt geholte Daten in der Webseite an
function displayProjects (data) {
    data.forEach(post => {

    // erstellt pro "post" ein neues ul-Element
    const ul = document.createElement("ul");
    ul.classList.add("post");

    // so werden die einzelnen posts aufgelistet
    const template = `
        <li class="project-img"><img src="images/projects/${post.image}"></li>
        <li class="project-title"><a href="#">${post.title}</a></li>
        <li class="project-description">${post.content}</li>
        <li class="project-type">Arbeitsart: ${post.type}</li>`;

    // die innerHTML vom ul-Element wird gemäss der Variabe "template" angepasst
    ul.innerHTML = template;

    // im Element mit der class ".projects-wrap" wird jeweils ein ul-Element am ende hinzugefügt durch appendChild
    document.querySelector(".projects-wrap").appendChild(ul);
    })
};