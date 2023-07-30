/**
 * varibales
 */
let lastOpenPopup = null;

/**
 * hide a specific popup
 *
 * @param {string} id
 */
function hidePopup(id) {
    document.getElementById(id).classList.add('hidden');
    lastOpenPopup = null;
}

/**
 * hide popup background
 */
function hideBackground() {
    document.querySelector('.popup-background').classList.add('hidden');
}

function showBackground() {
    document.querySelector('.popup-background').classList.remove('hidden');
}

/**
 * change the backgrond color popup
 *
 * @param {string} color
 */
function addBackgroundColor(color) {
    background = document.querySelector('.popup-background').classList;

    list_colors = ['bg-trans-blue', 'bg-trans-red', 'bg-trans-green', 'bg-trans-black'];

    // remove any color on background
    list_colors.forEach(iColor => {
        has_color = background.contains(iColor);
        if (has_color) {
            background.remove(iColor);
        }
    });

    // add new color
    background.add(color);

    showBackground();
}

/**
 * open popup code
 * @param {string} id
 * @param {string} color
 */
function openPopup(id, color) {
    popup = document.querySelector('#' + id).classList.remove('hidden');
    addBackgroundColor(color);
    lastOpenPopup = id;
}

/**
 * open popup when user click on device card
 */
document.querySelectorAll('.content-container .device').forEach(device => {
    device.addEventListener("click", event => {
        openPopup('popup-' + device.id, device.getAttribute('color'));
    });
});

/**
 * close the popup and the background when click out or click exit button
 */
document.querySelector('.popup-background').addEventListener('click', (event) => {
    const popup = document.querySelector('#' + lastOpenPopup);
    if (event.target !== popup && !popup.contains(event.target)) {
        hidePopup(lastOpenPopup);
        hideBackground();
        window.top.location = window.top.location; // reload page
    }
});
document.querySelectorAll('.popup .exit').forEach(btnExit => {
    btnExit.addEventListener('click', () => {
        hidePopup(lastOpenPopup);
        hideBackground();
    });
});

/**
 * Convert time to minutes HH:MM
 * @param {string} time
 * @returns {int}
 */
function convertTimeToMinutes(time) {
    const [hours, minutes] = time.split(':').map(Number);
    return hours * 60 + minutes;
}

/**
 * Convert minutes to time HH:MM
 * @param {int} minutes
 * @returns {int}
 */
function convertMinutesToTime(minutes) {
    const hours = Math.floor(minutes / 60);
    minutes = minutes % 60;

    return `${padZero(hours)}:${padZero(minutes)}`;
}

/**
 * Add 00 to number
 * @param {int} number
 * @returns {string}
 */
function padZero(number) {
    return number.toString().padStart(2, '0');
}

/**
 * change device card color
 * @param {string} id
 */
function changeDeviceCardColor(id) {
    let device = document.querySelector('#' + id + ' span');
    device.className = 'bg-orange';
}

/**
 * change sidebar time and colors
 */
function changeSidebarTime() {
    let devices = document.querySelectorAll('.sidebar .device h3[status=specific-time]');
    devices.forEach(device => {
        // remove one minute from time and change color
        let time = convertTimeToMinutes(device.textContent) - 1;
        let span = device.parentNode.querySelector('.title span');

        if (time >= 0) {
            device.textContent = convertMinutesToTime(time);
            if (time <= 10) {
                span.className = 'bg-orange';
                changeDeviceCardColor('device-' + span.textContent);
            }
        }
        if (!time) { // time ended
            span.className = 'bg-red';
            if (lastOpenPopup === null) {
                window.top.location = window.top.location;
            }
        }
    });
}

/**
 * update time and color every minute
 */
setInterval(function() {
    changeSidebarTime();
}, 60 * 1000);

/**
 * hide session when click on exit button
 */
document.querySelectorAll('.session .exit').forEach(session => {
    session.addEventListener('click', () => {
        session.parentElement.className = 'hidden';
    });
});

/**
 * opens the popup when the user clicks on the device in the sidebar
 */
document.querySelectorAll('.sidebar .device').forEach(device => {
    device.addEventListener("click", event => {
        openPopup('popup-' + device.id, device.getAttribute('color'));
    });
});
