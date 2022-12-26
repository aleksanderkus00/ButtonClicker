const PROFILEID = 'profile';
const RANKINGID = 'ranking';
const SETTINGSID = 'settings';
const PROFILEBUTTONID = 'profileButton';
const RANKINGBUTTONID = 'rankingButton';
const SETTINGSBUTTONID = 'settingsButton';

function showTab(descId, sorceId) {
    let profile = document.getElementById(PROFILEID);
    let ranking = document.getElementById(RANKINGID);
    let settings = document.getElementById(SETTINGSID);
    let profileButton = document.getElementById(PROFILEBUTTONID);
    let rankingButton = document.getElementById(RANKINGBUTTONID);
    let settingsButton = document.getElementById(SETTINGSBUTTONID);

    // TODO: add disable button border bottom if clicked
    if (descId === PROFILEID) {
        displayProfile(profile, ranking, settings, profileButton);
    }
    else if (descId === RANKINGID) {
        displayRanking(profile, ranking, settings, rankingButton);
    }
    else if (descId === SETTINGSID) {
        displaySettings(profile, ranking, settings, settingsButton);
    }
}

function displayProfile(profile, ranking, settings){
    makeVisible(profile);
    makeInvisible(ranking);
    makeInvisible(settings);
}

function displayRanking(profile, ranking, settings){
    makeInvisible(profile);
    makeVisible(ranking);
    makeInvisible(settings);
}

function displaySettings(profile, ranking, settings){
    makeInvisible(profile);
    makeInvisible(ranking);
    makeVisible(settings);
}

function makeInvisible(tab) {
    tab.style.display = 'none';
}

function makeVisible(tab) {
    tab.style.display = 'block';
}

function disableButtonBorderBottom(button){
    button.style.borderBottom = '0px';
}
function AbleButtonBorderBottom(button){
    button.style.borderBottom = '1px solid #000000';
}

/*
    tab.style.borderBottom = '0px';
    tab.style.borderBottom = '1px solid #000000';
*/