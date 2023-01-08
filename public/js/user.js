const rankingContainer = document.querySelector("#ranking");

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
