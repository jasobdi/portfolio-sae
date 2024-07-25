


/* ABOUT - FORM VALIDATION */ 

// EventListener für den Klick auf den submit Button
document.querySelector(".submit").addEventListener("click", validateForm);

// Deklaration validateForm Funktion
function validateForm (event) {
    // verhindern, dass das Formular abgesendet bzw. neu geladen wird bei Klick auf Submit
    event.preventDefault();
    // Variablen für leere Werte von data und validationErrors
    let data = {};
    let validationErrors = {};

    // Selektion Werte aus HTML-Elementen
    data.firstName = document.querySelector("#first-name").value;
    data.lastName = document.querySelector("#last-name").value;
    data.company = document.querySelector("#company").value;
    data.email = document.querySelector("#email").value;
    data.phone = document.querySelector("#phone").value;
    data.message = document.querySelector("#message").value;


    // Error Message soll nach dem Anpassen des Inputs nicht mehr angezeigt werden
    // & bei weiteren submits nicht vermehren
    if (document.querySelector("form span")) {
        document.querySelectorAll("form span").forEach((element) => {
            element.remove();
        });
    }



    // Validation
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

    // COMPANY IST OPTIONAL

    // Error: E-mail leer / E-mail ungültig
    if (!data.email) {
        validationErrors.email = "Bitte E-Mail angeben";
    } else {
            // E-Mail Validierung mit RegEx
            const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;

            if (!emailRegex.test(data.email)) {
                validationErrors.email = "Die E-Mail ist ungültig";
            }
        }

    // Error: Telefonnummer leer / Telefonnummer ungültig
    if (!data.phone) {
        validationErrors.phone = "Bitte Telefonnummer angeben";
    } else {
        // Telefonnummer Validierung mit RegEx (+41)
        const phoneRegex = /(\+[0-9]{2}|0){1}(\(0\))?[0-9]{2}[\s]?[0-9]{3}[\s]?[0-9]{2}[\s]?[0-9]{2}$/gm;

    if (!phoneRegex.test(data.phone)) {
        validationErrors.phone = "Die Telefonnummer ist ungültig";
    }}

    // Error: Message leer 
    if (!data.message) {
        validationErrors.message = "Bitte geben Sie eine Nachricht ein";
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

function displayErrors(errors) {
    // Fehlermeldung firstName
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



  
