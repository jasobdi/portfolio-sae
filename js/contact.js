
/* ABOUT - FORM VALIDATION */ 


/* EventListener für den Klick auf den submit Button */
document.querySelector(".submit").addEventListener("click", validateForm);

/* EventListener sobald eines der Input-Felder verlassen wird (blur) */
document.querySelector("#name-title").addEventListener("blur", validateNameTitle);
document.querySelector("#first-name").addEventListener("blur", validateFirstName);
document.querySelector("#last-name").addEventListener("blur", validateLastName);
document.querySelector("#street").addEventListener("blur", validateStreet);
document.querySelector("#plz").addEventListener("blur", validatePLZ);
document.querySelector("#city").addEventListener("blur", validateCity);
document.querySelector("#email").addEventListener("blur", validateEmail);
document.querySelector("#phone").addEventListener("blur", validatePhone);
document.querySelector("#message").addEventListener("blur", validateMessage);

/* Variable für leere Werte von validationErrors */
let validationErrors = {};

/* Validierung ganzes Formular auf einmal */

    function validateForm (event) {
        // verhindern, dass das Formular abgesendet bzw. neu geladen wird bei Klick auf Submit
        event.preventDefault();
    // Variablen für leere Werte von data
    let data = {};


    // Selektion Werte aus HTML-Elementen
    data.nameTitle = document.querySelector("#name-title").value;
    data.firstName = document.querySelector("#first-name").value;
    data.lastName = document.querySelector("#last-name").value;
    data.company = document.querySelector("#company").value;
    data.street = document.querySelector("#street").value;
    data.plz = document.querySelector("#plz").value;
    data.city = document.querySelector("#city").value;
    data.email = document.querySelector("#email").value;
    data.phone = document.querySelector("#phone").value;
    data.message = document.querySelector("#message").value;


   /* Error Message soll nach dem Anpassen des Inputs nicht mehr angezeigt werden
     & sich bei weiteren submits nicht vermehren */
    if (document.querySelector("form span")) {
        document.querySelectorAll("form span").forEach((element) => {
            element.remove();
        });
    }


    // Validation

    // Error: "Frau", "Herr", "keine Anrede" ist nicht angewählt
    if ( data.nameTitle === '') {
        validationErrors.nameTitle = "Bitte Anrede auswählen";
    }

    // Error: Voranme leer / Vorname 2 oder weniger Buchstaben
    if(!data.firstName) {
        validationErrors.firstName = "Bitte Vorname ausfüllen";
    } else if (data.firstName.length <= 2) {
        validationErrors.firstName = "Vorname muss mindestens 2 Buchstaben haben";
    }

    // Error: Nachname leer / Nachname 2 oder weniger Buchstaben
    if(!data.lastName) {
        validationErrors.lastName = "Bitte Nachname ausfüllen";
    } else if (data.lastName.length <= 2) {
        validationErrors.lastName = "Nachname muss mindestens 2 Buchstaben haben";
    }

    // Error: Strasse leer
    if(!data.street) {
        validationErrors.street = "Bitte Strasse eingeben";
    } 
    
    // Error: PLZ leer / PLZ mehr als 4 Zahlen
    if(!data.plz) {
        validationErrors.plz = "Bitte Postleitzahl eingeben";
    } else if (data.plz.length != 4) {
        validationErrors.plz = "Postleitzahl ist ungültig";
    } 

    // Error: Ort leer
    if(!data.city) {
        validationErrors.city = "Bitte Ort eingeben";
    } 

    // Error: E-mail leer / E-mail ungültig
    if (!data.email) {
        validationErrors.email = "Bitte E-Mail angeben";
    } else {
            // E-Mail Validierung mit RegEx
            const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/gm;

            if (!emailRegex.test(data.email)) {
                validationErrors.email = "Die E-Mail ist ungültig";
            }
        }

    // Error: Telefonnummer leer / Telefonnummer ungültig
    if (!data.phone) {
        validationErrors.phone = "Bitte Telefonnummer angeben";
    } else {
        // Telefonnummer Validierung mit RegEx (ohne Vorwahl mit oder ohne gängige Abstände)
        const phoneRegex = /(0){1}?[0-9]{2}[\s]?[0-9]{3}[\s]?[0-9]{2}[\s]?[0-9]{2}$/gm;

    if (!phoneRegex.test(data.phone)) {
        validationErrors.phone = "Die Telefonnummer ist ungültig";
    }}

    // Error: Message leer 
    if (!data.message) {
        validationErrors.message = "Bitte eine Nachricht eingeben";
    }


    if (Object.keys(validationErrors).length === 0) {
        console.log(data);
    } else {
        // Anzeige Error Message
        displayErrors(validationErrors);
    }

    console.log(data);
    console.log(validationErrors);

}

/* Hinzufügen Fehlermeldungen für ganzes Formular auf einmal */

function displayErrors(errors) {

//     // Fehlermeldung nameTitle
    if (errors.nameTitle) {
        const errContainer = document.createElement("span");
        errContainer.innerHTML = errors.nameTitle;
        document.querySelector("#name-title").after(errContainer);
    }

//     // Fehlermeldung firstName
    if (errors.firstName) {
        const errContainer = document.createElement("span");
        errContainer.innerHTML = errors.firstName;
        document.querySelector("#first-name").after(errContainer);
    }
    
    if (errors.lastName) {
        // Fehlermeldung lastName
        const errContainer = document.createElement("span");
        errContainer.innerHTML = errors.lastName;
        document.querySelector("#last-name").after(errContainer);
    }

    if (errors.street) {
        // Fehlermeldung street
        const errContainer = document.createElement("span");
        errContainer.innerHTML = errors.street;
        document.querySelector("#street").after(errContainer);
    }
    if (errors.plz) {
        // Fehlermeldung plz
        const errContainer = document.createElement("span");
        errContainer.innerHTML = errors.plz;
        document.querySelector("#plz").after(errContainer);
    }
    if (errors.city) {
        // Fehlermeldung city
        const errContainer = document.createElement("span");
        errContainer.innerHTML = errors.city;
        document.querySelector("#city").after(errContainer);
    }
    if (errors.email) {
        // Fehlermeldung email
        const errContainer = document.createElement("span");
        errContainer.innerHTML = errors.email;
        document.querySelector("#email").after(errContainer);
    }
    if (errors.phone) {
        // Fehlermeldung phone
        const errContainer = document.createElement("span");
        errContainer.innerHTML = errors.phone
        document.querySelector("#phone").after(errContainer);
    }

    if (errors.message) {
        // Fehlermeldung message
        const errContainer = document.createElement("span");
        errContainer.innerHTML = errors.message
        document.querySelector("#message").after(errContainer);
    }
}



/* VALIDIERUNG & Fehlermeldung PRO INPUT-FELD */


function validateNameTitle(event) {
    event.preventDefault();
    const nameTitle = event.target.value;
    // Error: "Frau", "Herr", "keine Anrede" ist nicht angewählt
    if (nameTitle === '') {
        validationErrors.nameTitle = "Bitte Anrede auswählen";
    } else {
        document.querySelector('#name-title + span')?.remove();
        delete validationErrors.nameTitle;
    }

    // Fehlermeldung nameTitle (Anrede)
    if (validationErrors.nameTitle) {
        document.querySelector('#name-title + span')?.remove();
        const errContainer = document.createElement("span");
        errContainer.innerHTML = validationErrors.nameTitle;
        document.querySelector("#name-title").after(errContainer);
    }

};

function validateFirstName(event) {
    event.preventDefault();
    const firstName = event.target.value;
    // Error: Voranme leer / Vorname 2 oder weniger Buchstaben
    if(!firstName) {
        validationErrors.firstName = "Bitte Vorname ausfüllen";
    } else if (firstName.length <= 2) {
        validationErrors.firstName = "Vorname muss mindestens 2 Buchstaben haben";
    } else {
        document.querySelector('#first-name + span')?.remove();
        delete validationErrors.firstName;
    }

    // Fehlermeldung firstName
    if (validationErrors.firstName) {
        document.querySelector('#first-name + span')?.remove();
        const errContainer = document.createElement("span");
        errContainer.innerHTML = validationErrors.firstName;
        document.querySelector("#first-name").after(errContainer);
    }
};

function validateLastName(event) {
    event.preventDefault();
    const lastName = event.target.value;
    // Error: Nachname leer / Nachname 2 oder weniger Buchstaben
    if(!lastName) {
        validationErrors.lastName = "Bitte Nachname ausfüllen";
    } else if (lastName.length <= 2) {
        validationErrors.lastName = "Nachname muss mindestens 2 Buchstaben haben";
    } else {
        document.querySelector('#last-name + span')?.remove();
        delete validationErrors.lastName;
    }

    // Fehlermeldung lastName
    if (validationErrors.lastName) {
        document.querySelector('#last-name + span')?.remove();
        const errContainer = document.createElement("span");
        errContainer.innerHTML = validationErrors.lastName;
        document.querySelector("#last-name").after(errContainer);
    }
};

function validateStreet(event) {
    event.preventDefault();
    const street = event.target.value;
     // Error: Strasse leer
     if(!street) {
        validationErrors.street = "Bitte Strasse eingeben";
    } else {
        document.querySelector('#street + span')?.remove();
        delete validationErrors.street;
    }

    // Fehlermeldung street
    if (validationErrors.street) {
        document.querySelector('#stereet + span')?.remove();
        const errContainer = document.createElement("span");
        errContainer.innerHTML = validationErrors.street;
        document.querySelector("#street").after(errContainer);
    }
};

function validatePLZ(event) {
    event.preventDefault();
    const plz = event.target.value;
    // Error: PLZ leer / PLZ mehr als 4 Zahlen
    if(!plz) {
        validationErrors.plz = "Bitte Postleitzahl eingeben";
    } else if (plz.length != 4) {
        validationErrors.plz = "Postleitzahl ist ungültig";
    } else {
        document.querySelector('#plz + span')?.remove();
        delete validationErrors.plz;
    }

    // Fehlermeldung plz
    if (validationErrors.plz) {
        document.querySelector('#plz + span')?.remove();
        const errContainer = document.createElement("span");
        errContainer.innerHTML = validationErrors.plz;
        document.querySelector("#plz").after(errContainer);
    }
};

function validateCity(event) {
    event.preventDefault();
    const city = event.target.value;
    // Error: Ort leer
    if(!city) {
        validationErrors.city = "Bitte Ort eingeben";
    } else {
        document.querySelector('#city + span')?.remove();
        delete validationErrors.city;
    }

    // Fehlermeldung city
    if (validationErrors.city) {
        document.querySelector('#city + span')?.remove();
        const errContainer = document.createElement("span");
        errContainer.innerHTML = validationErrors.city;
        document.querySelector("#city").after(errContainer);
    }

};

function validateEmail(event) {
    event.preventDefault();
    const email = event.target.value;
    // Error: E-mail leer / E-mail ungültig
    if (!email) {
        validationErrors.email = "Bitte E-Mail angeben";
    } else {
            // E-Mail Validierung mit RegEx
            const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;

            if (!emailRegex.test(email)) {
                validationErrors.email = "Die E-Mail ist ungültig";
            } else {
            document.querySelector('#email + span')?.remove();
            delete validationErrors.email;
            }
    } 

    // Fehlermeldung email
    if (validationErrors.email) {
            document.querySelector('#email + span')?.remove();
            const errContainer = document.createElement("span");
            errContainer.innerHTML = validationErrors.email;
            document.querySelector("#email").after(errContainer);
    }
};

function validatePhone (event) {
    event.preventDefault();
    const phone = event.target.value;
    // Error: Telefonnummer leer / Telefonnummer ungültig
    if (!phone) {
        validationErrors.phone = "Bitte Telefonnummer angeben";
    } else {
        // Telefonnummer Validierung mit RegEx (ohne Vorwahl mit oder ohne gängige Abstände)
        const phoneRegex = /(0){1}?[0-9]{2}[\s]?[0-9]{3}[\s]?[0-9]{2}[\s]?[0-9]{2}$/gm;

    if (!phoneRegex.test(phone)) {
        validationErrors.phone = "Die Telefonnummer ist ungültig";
    } else {
        document.querySelector('#phone + span')?.remove();
        delete validationErrors.phone;
        }
    }

    // Fehlermeldung phone
    if (validationErrors.phone) {
        document.querySelector('#phone + span')?.remove();
        const errContainer = document.createElement("span");
        errContainer.innerHTML = validationErrors.phone
        document.querySelector("#phone").after(errContainer);
    }

};

function validateMessage(event) {
    event.preventDefault();
    const message = event.target.value;
    // Error: Message leer 
    if (!message) {
        validationErrors.message = "Bitte eine Nachricht eingeben";
    } else {
        document.querySelector('#message + span')?.remove();
        delete validationErrors.message;
        }

    // Fehlermeldung message
    if (validationErrors.message) {
        document.querySelector('#message + span')?.remove();
        const errContainer = document.createElement("span");
        errContainer.innerHTML = validationErrors.message
        document.querySelector("#message").after(errContainer);
    }
};



  
