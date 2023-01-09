const PROFILEID = "profile";
const RANKINGID = "rankingTable";
const SETTINGSID = "settings";
const PROFILEBUTTONID = "profileButton";
const RANKINGBUTTONID = "rankingButton";
const SETTINGSBUTTONID = "settingsButton";

let userClicks = document.querySelector("#userClicks");
let nickname = document.querySelector("#nickname");
let email = document.querySelector("#email");
let clicks = 0;
let counter = 0;

window.addEventListener("load", (event) => {
  let c = Number(getCookie("clicks"));
  if (!isNaN(Number(c))) {
    clicks = c;
    userClicks.innerHTML = clicks;
  }
  nickname.value = getCookie("nickname");
  cookieEmail = getCookie("email");
  email.value = cookieEmail.replace("%", "@");
});

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
  } else if (descId === RANKINGID) {
    displayRanking(profile, ranking, settings, rankingButton);
  } else if (descId === SETTINGSID) {
    displaySettings(profile, ranking, settings, settingsButton);
  }
}

function displayProfile(profile, ranking, settings) {
  makeVisible(profile);
  makeInvisible(ranking);
  makeInvisible(settings);
}

function displayRanking(profile, ranking, settings) {
  makeInvisible(profile);
  makeVisible(ranking);
  makeInvisible(settings);
}

function displaySettings(profile, ranking, settings) {
  makeInvisible(profile);
  makeInvisible(ranking);
  makeVisible(settings);
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

function buttonClick() {
  //let number = Number(getCookie("clicks"));
  clicks += 1;
  counter += 1;
  userClicks.innerHTML = clicks;
  setCookie("clicks", clicks);
  if (counter % 5 == 0) {
    counter = 0;
    updateClicks();
  }
}

function getCookie(name) {
  const cookies = document.cookie.split(";");
  const cookie = cookies.find((x) => x.includes(name));
  const value = cookie.split("=")[1];
  return value;
}

function setCookie(name, value) {
  document.cookie = name + "=" + value;
}

function eraseCookie(name) {
  document.cookie = name + "=; Max-Age=-99999999;";
}

function updateClicks() {
  const userId = Number(getCookie("userId"));
  const data = { clicks: clicks, userId: userId };
  fetch("/updateClicks", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  });
}

function saveChange(prop) {
  const newValueElement = document.querySelector(`#${prop}`);
  const newValue = newValueElement.value;
  let cookieValue = null;
  if (prop !== "password") {
    cookieValue = getCookie(prop);
    if (cookieValue === newValue) {
      return;
    }
  }
  const userId = Number(getCookie("userId"));
  const data = { userId: userId, propertyName: prop, newValue: newValue };
  fetch("/updateProp", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  }).then(() => {
    if (prop !== "password") {
      setCookie(prop, newValue);
    } else {
      newValueElement.value = "";
    }
    let loading = document.querySelector(".loading");
    loading.style.backgroundPosition = "left bottom";
    setTimeout(() => {
      loading.style.background = "#d9d9d9";
    }, 500);
  });
}

function logout() {
  let url = window.location.href;
  url = url.replace("clicker", "login");
  window.location.href = url;
  eraseCookie("userId");
  eraseCookie("nickname");
  eraseCookie("email");
  eraseCookie("clicks");
}
