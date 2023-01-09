const profile = document.getElementById("profile");
const ranking = document.getElementById("rankingTable");
const settings = document.getElementById("settings");
const profileButton = document.getElementById("profileButton");
const rankingButton = document.getElementById("rankingButton");
const settingsButton = document.getElementById("settingButton");

function showTab(tab) {
  if (tab === "profile") {
    displayProfile();
  } else if (tab === "rankingTable") {
    displayRanking();
  } else if (tab === "settings") {
    displaySettings();
  }
}

function displayProfile() {
  makeVisible(profile);
  makeInvisible(ranking);
  makeInvisible(settings);
}

function displayRanking() {
  makeInvisible(profile);
  makeVisible(ranking);
  makeInvisible(settings);
}

function displaySettings() {
  makeInvisible(profile);
  makeInvisible(ranking);
  makeVisible(settings);
  disableButtonBorderBottom(settingsButton);
}

function makeInvisible(tab) {
  tab.style.display = "none";
}

function makeVisible(tab) {
  tab.style.display = "block";
}

function disableButtonBorderBottom(button) {
  button.style.borderBottom = "0px";
}
function AbleButtonBorderBottom(button) {
  button.style.borderBottom = "1px solid #000000";
}

/*
    tab.style.borderBottom = '0px';
    tab.style.borderBottom = '1px solid #000000';
*/
