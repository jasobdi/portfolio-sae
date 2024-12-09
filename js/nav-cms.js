
// klick auf Hamburger Button = overlay öffnet sich
document.querySelector('.hamburger-button').addEventListener('click', e=> {
    // class .active wird hinzugefügt -> overlay wird angezeigt (display:block)
    document.querySelector('.overlay-nav').classList.add('active')
});

// klick auf Close Button = overlay schliesst sich
document.querySelector('.close-button').addEventListener('click', e=> {
    // class .active wird entfernt -> overlay verschwindet (display:none)
    document.querySelector('.overlay-nav').classList.remove('active')
});

