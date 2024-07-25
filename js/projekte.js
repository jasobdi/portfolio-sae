

// ausführen der asynchronen Funktion getData
getData();

// asynchrone Funktion holt die Daten aus der JSON.Datei
async function getData() {
    const response = await fetch("api/projekte.json");
    const data = await response.json()

    displayProjects(data);
}

// Funktion zeigt geholten Daten in der Webseite an
function displayProjects (data) {
    data.forEach(post => {

    // erstellt pro "post" ein neues ul-Element
    const ul = document.createElement("ul");
    ul.classList.add("post");

    // so werden die einzelnen posts dargestellt bzw. aufgelistet
    const template = `
    <div class="project"><img src="images/projects${post.image}"></div>
    <li class="project-title"><a href="#">${post.title}</a></li>
    <li class="project-description">${post.content}</li>
    <li class="project-date">Abgabe: ${post.date}</li></div>`;

    // die innerHTML vom ul-Element wird gemäss der Variabe "template" angepasst
    ul.innerHTML = template;

    // im Element mit der class ".projects-wrap" wird jeweils ein ul-Element am ende hinzugefügt mit appendChild
    document.querySelector(".projects-wrap").appendChild(ul);
    });
};