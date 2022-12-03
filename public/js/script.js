const PROFILEID = 'profile';
const RANKINGID = 'ranking';
const SETTINGSID = 'settings';

function showTab(tabId) {
    let profile = document.getElementById(PROFILEID);
    let ranking = document.getElementById(RANKINGID);
    let settings = document.getElementById(SETTINGSID);

    if (tabId === PROFILEID) displayProfile(profile, ranking, settings);
    else if (tabId === RANKINGID) displayRanking(profile, ranking, settings);
    else if (tabId === SETTINGSID) displaySettings(profile, ranking, settings);
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
    tab.style.borderbottom = '0px';
}

function makeVisible(tab) {
    tab.style.display = 'block';
    tab.style.borderbottom = '1px solid #000000';
}