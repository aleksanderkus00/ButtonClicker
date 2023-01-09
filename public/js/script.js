let userClicks = document.querySelector("#userClicks");
let nickname = document.querySelector("#nickname");
let email = document.querySelector("#email");
let imgClick = document.querySelector("#imgClick");
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

function down() {
  imgClick.style.transform = "scale(1.1)";
}

function up() {
  imgClick.style.transform = "scale(1)";
}

function buttonClick() {
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
