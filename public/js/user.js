class User {
  constructor(email, password, nickname, clicks) {
    this.email = email;
    this.password = password;
    this.nickname = nickname;
    this.clicks = clicks;
  }
}
const rankingContainer = document.querySelector("#ranking");

function setUser(user) {
  localStorage.setItem("user", user);
}

function getUser() {
  return localStorage.getItem("user");
}

function deleteUser() {
  localStorage.removeItem("user");
}

function login() {
  console.log("loging...");
}

function getTop100() {
  fetch("/getTop100", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((x) => x.json())
    .then((x) => {
      rankingContainer.innerHTML = "";
      loadPlayerStats(x);
    });
}
function loadPlayerStats(arrayOfStats) {
  arrayOfStats.forEach((element) => {
    playerStat(element);
  });
}

function playerStat(stats) {
  const template = document.querySelector("#ranking-template");
  const clone = template.content.cloneNode(true);
  const nickname = clone.querySelector(".nickname");
  const clicks = clone.querySelector(".clicks");
  nickname.innerHTML = stats.nickname;
  clicks.innerHTML = stats.clicks;
  rankingContainer.appendChild(clone);
}
