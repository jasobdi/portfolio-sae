// klick auf info button = overlay öffnet sich
document.querySelector('.fa-circle-info').addEventListener('click', e=> {
    // class .active wird hinzugefügt -> overlay wird angezeigt (display:block)
    document.querySelector('.form-info-overlay').classList.add('active');
});

// klick auf info button = overlay schliesst sich
document.querySelector('.fa-circle-info').addEventListener('click', e=> {
    // class .active wird entfernt -> overlay verschwindet (display:none)
    document.querySelector('.form-info-overlay').classList.remove('active')
});