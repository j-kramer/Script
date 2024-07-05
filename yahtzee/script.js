"use strict";

const button = document.getElementById("gooiButton");
const dobbelsteenTable = document.getElementsByClassName('dobbelsteen');
const singleScoresTable = document.getElementsByClassName('singleDiceScore');
const comboScoresTable = document.getElementsByClassName('comboDiceScore');


button.addEventListener("click", yahtzee);

function yahtzee() {
    let diceList = rollDice();
    showDice(diceList);
    let counts = countDice(diceList);
    showScores(singleScoresTable, scoreSingles(counts));
    let comboScores = scoreCombos(diceList, counts);
    showScores(comboScoresTable, comboScores);
}

function rollDice() {
  let diceList = new Array(5);
  for (let i = 0; i < diceList.length; i++) {
    let randomNumber = Math.floor(Math.random() * 6) + 1;
    diceList[i] = randomNumber;
  }
  return diceList;
}

function countDice(diceList) {
    let counts = {
      1: 0,
      2: 0,
      3: 0,
      4: 0,
      5: 0,
      6: 0
    };
    for(const dice of diceList) {
        counts[dice]++;
    }
    return counts;
}

function showDice(diceList) {
  for (let i = 0; i < dobbelsteenTable.length; i++) {
    dobbelsteenTable[i].innerHTML = diceList[i];
  }
}

function showScores(table, scores) {
  for (let i = 0; i < table.length; i++) {
    table[i].innerHTML = scores[i];
  }
}

function scoreSingles(counts) {
    // to get the single scores we can multiply each key with its value from counts
    return Object.entries(counts).map(entry => entry[0] * entry[1]);
}

function scoreCombos(diceList, counts) {
    let maxConsecutiveDice = countMaxConsecutiveDice(diceList.sort());
    return [
        scoreDrieGelijke(diceList, counts),
        scoreVierGelijke(diceList, counts),
        scoreKleineStraat(maxConsecutiveDice),
        scoreGroteStraat(maxConsecutiveDice),
        scoreFullHouse(counts),
        scoreKans(diceList),
        scoreYahtzee(counts)
    ];
}

function scoreDrieGelijke(diceList, counts) {
    if (hasGelijke(3, counts)) {
        return sumArray(diceList);
    }
    return 0;
}

function scoreVierGelijke(diceList, counts) {
    if (hasGelijke(4, counts)) {
        return sumArray(diceList);
    }
    return 0;
}

function scoreKleineStraat(consecutiveDiceCount) {
    if (consecutiveDiceCount == 4) {
        return 30;
    }
    return 0;
}

function scoreGroteStraat(consecutiveDiceCount) {
    if (consecutiveDiceCount == 5) {
        return 40;
    }
    return 0;
}

function scoreFullHouse(counts) {
    if (hasGelijke(3, counts) && hasGelijke(2, counts)) {
        return 25;
    }
    return 0;
}

function scoreKans(diceList) {
    return sumArray(diceList);
}

function scoreYahtzee(counts) {
    if (hasGelijke(5, counts)) {
        return 25;
    }
    return 0;
}

// this function assumes the diceList is sorted
function countMaxConsecutiveDice(diceList) {
    let count = 0;
    let maxCount = 0;
    for (let i = 0; i < diceList.length - 1; i++) {
        let current = diceList[i];
        let next = diceList[i + 1];
        if (current == next) {
            continue;
        }
        if (current + 1 == next) {
            count++;
            if (count > maxCount) {
                maxCount++;
            }
        } else {
            count = 0;
        }
    }
    // adjust for number of dice vs number of successions
    if (maxCount > 0) {
        return maxCount + 1;
    } else {
        return 0;
    }
}

function hasGelijke(amount, counts) {
    return Object.values(counts).find(item => item == amount);
}

function sumArray(array) {
    return array.reduce((sum, current) => sum + current, 0);
}