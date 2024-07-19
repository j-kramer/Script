"use strict";

const dealerScore = document.getElementById("dealerScore");
const dealerCards = document.getElementById("dealerKaarten");
const playerScore = document.getElementById("spelerScore");
const playerCards = document.getElementById("spelerKaarten");
const dealCardButton = document.getElementById("deelButton");
const passButton = document.getElementById("pasButton");

class Card {
    constructor(suit, rank) {
        this._suit = suit;
        this._rank = rank;
        switch (rank) {
            case "jack":
            case "queen":
            case "king":
                this._value = 10;
                break;
            case "ace":
                this._value = 11;
                break;
            default:
                this._value = rank;
                break;
        }
    }

    get suit() {
        return this._suit;
    }

    get rank() {
        return this._rank;
    }

    get value() {
        return this._value;
    }
}


/******************************************
 * Functions to update the html interface *
 ******************************************/

function showScore(elem, score) {
    elem.innerHTML = "Score: " + score;
}

function addCard(elem, card) {
    let div = document.createElement('div');
    div.className = "card";
    div.innerHTML = (card.suit ?? "") + " " + (card.rank ?? "");
    elem.append(div);
}

function showDealerHand() {
    addCard(dealerCards, {});
    addCard(dealerCards, game.dealerHand[1]);
}

function showHand(elem, hand) {
    addCard(elem, hand[0]);
    addCard(elem, hand[1]);
}

function updateButtons() {
    if (game.started) {
        dealCardButton.innerHTML = "Hit";
        passButton.removeAttribute("disabled");
    } else {
        dealCardButton.innerHTML = "Delen";
        passButton.setAttribute("disabled", "");
    }
}

function showPlayerWins() {
    alert("You win");
}

function showPlayerLoses() {
    alert("You lost");
}

function showPlayerDraw() {
    alert("Stand-off");
}

/*
 * User Callbacks
 */

function dealCardButtonCallback() {
    if (game.started) {
        hit();
    } else {
        delen();
    }
}

function passTurn() {
    if (game.started) {
        pas();
    }
}

/*
 * Game Logic
 */

const game = {
    started: false,
    deck: initDeck(),
    dealerHand: [],
    playerHand: [],
}

function initDeck() {
    let deck = [];
    const suits = ["diamonds", "clubs", "hearts", "spades"];
    const ranks = [2, 3, 4, 5, 6, 7, 8, 9, 10, "jack", "queen", "king", "ace"];
    for (let i = 0; i < suits.length; i++) {
        for (let j = 0; j < ranks.length; j++) {
            deck.push(new Card(suits[i], ranks[j]));
        }
    }
    return deck;
}

function calculateScore(hand) {
    let score = 0;
    let hasAce = false;
    for (let card of hand) {
        if (card.value == 11) {
            hasAce = true;
            continue;
        }
        score += card.value;
    }
    if (hasAce) {
        if (score + 11 > 21) {
            score++;
        } else {
            score += 11;
        }
    }
    return score;
}

function drawCard(hand) {
    let cardNr = Math.random() * game.deck.length;
    let card = game.deck.splice(cardNr, 1)[0];
    hand.push(card);
    return card;
}

function delen() {
    // reset the game
    resetGame();

    drawCard(game.dealerHand);
    drawCard(game.dealerHand);

    drawCard(game.playerHand);
    drawCard(game.playerHand);

    showDealerHand();
    showHand(playerCards, game.playerHand);
    showScore(dealerScore,"");
    showScore(playerScore, calculateScore(game.playerHand));
}

function resetGame() {
    game.started = true;
    game.deck = initDeck();
    game.dealerHand = [];
    game.playerHand = [];

    // Clear existing hands
    dealerCards.innerHTML = '';
    playerCards.innerHTML= '';

    updateButtons();
}

function hit() {
    addCard(playerCards, drawCard(game.playerHand));
    let score = calculateScore(game.playerHand);
    showScore(playerScore, score);
    if (score == 21) {
	    game.started = false;
        showPlayerWins();
    }
    if (score > 21) {
	    game.started = false;
        showPlayerLoses();
    }
    updateButtons();
}

function pas() {
    game.started = false;
    // Start the dealers turn
    dealerCards.innerHTML = '';
    showHand(dealerCards, game.dealerHand);
    let score = calculateScore(game.dealerHand);
    let playerScore = calculateScore(game.playerHand);
    while (score < 17) {
        if (score == 16 && playerScore == 16) {
            break;
        }
        addCard(dealerCards, drawCard(game.dealerHand));
        score = calculateScore(game.dealerHand);
    }
    showScore(dealerScore, score);
    if (score > 21 || score < playerScore) {
        showPlayerWins();
    } else {
        if (score > playerScore) {
            showPlayerLoses();
        }
        if (score == playerScore) {
            showPlayerDraw();
        }
    }
    updateButtons();
}

// add callbacks
dealCardButton.addEventListener("click", dealCardButtonCallback);
passButton.addEventListener("click", passTurn);
