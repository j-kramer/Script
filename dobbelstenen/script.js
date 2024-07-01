"use strict";

const button = document.getElementById("gooiButton");
// functions definitions are evaluated before statements in a scope, so the rollDice function is already known
button.addEventListener("click", rollDice);

function rollDice() {
  let randomNumbers = new Array(8);
  let count = {
    1: 0,
    2: 0,
    3: 0,
    4: 0,
    5: 0,
    6: 0
  };
  for (let i = 0; i < randomNumbers.length; i++) {
    let randomNumber = Math.floor(Math.random() * 6) + 1;
    randomNumbers[i] = randomNumber;
    count[randomNumber]++
  }
  // update table
  let tabel = document.getElementsByClassName('aantal');
  for (const number in count) {
    // numbers go from 1 to 6, but array indices from 0 to 5, so subtract 1 from the number
    tabel[number - 1].innerHTML = count[number];
  }
}