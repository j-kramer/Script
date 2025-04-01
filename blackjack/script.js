"use strict";

const playerTemplate = document.getElementById("playerTemplate");
const playersDiv = document.getElementById("blackjackPlayers");

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

  drawCard(elem, visible) {
    const div = document.createElement("div");
    div.className = "card";
    if (visible) {
      div.innerHTML = this._suit + " " + this._rank;
    }
    elem.append(div);
  }
}

class Player {
  constructor(name) {
    this._name = name;
    this._hand = [];

    /*
     * add the Player to the view with a template,
     * hence we don't need to pass the elements for the
     * score to the constructor but can just select them
     * here
     */
    const clone = playerTemplate.content.cloneNode(true);

    const nameElem = clone.querySelector(".playerName");
    nameElem.innerHTML = name + " Kaarten";

    this._scoreElem = clone.querySelector(".playerScore");
    this._scoreElem.innerHTML = "Score:";

    this._handElem = clone.querySelector(".playerHand");

    playersDiv.append(clone);
  }

  addCard(card) {
    this._hand.push(card);
    this._calculateScore();
    this._render();
  }

  get score() {
    return this._score;
  }

  // TODO: vraag: waarom onderstaande logica niet integreren in de bovenstaande
  // score getter? Dat scheelt een function call in de addCard method
  /*
   * antwoord: door de logica in hun eigen functie te stoppen is het duidelijker
   * wat het doet. De extra functie call maakt hier niet uit, omdat je toch meestal
   * op de gebruiker wacht en deze logica maar 1 keer per speler beurt wordt uitgevoerd.
   */
  _calculateScore() {
    let score = 0;
    let nrOfAces = 0;
    for (let card of this._hand) {
      if (card.value == 11) {
        nrOfAces++;
        continue;
      }
      score += card.value;
    }
    switch (nrOfAces) {
      case 2:
        if (score + 12 <= 21) {
          score += 12;
        } else {
          score += 2;
        }
        break;
      case 1:
        if (score + 11 <= 21) {
          score += 11;
        } else {
          score += 1;
        }
        break;
      default:
        score += nrOfAces;
    }
    this._score = score;
  }
}

class HumanPlayer extends Player {
  constructor() {
    super("Speler");
  }

  _render() {
    this._scoreElem.innerHTML = "Score: " + this._score;
    this._handElem.innerHTML = "";
    for (let card of this._hand) {
      card.drawCard(this._handElem, true);
    }
  }
}

class DealerPlayer extends Player {
  constructor() {
    super("Dealer");
    this._handIsVisible = false;
  }

  setHandVisible() {
    this._handIsVisible = true;
    this._render();
  }

  _render() {
    if (this._handIsVisible) {
      this._scoreElem.innerHTML = "Score: " + this._score;
    } else {
      this._scoreElem.innerHTML = "Score: hidden";
    }

    this._handElem.innerHTML = "";

    const nrOfCards = this._hand.length;
    if (nrOfCards > 0) {
      this._hand[0].drawCard(this._handElem, this._handIsVisible);
      for (let i = 1; i < nrOfCards; i++) {
        this._hand[i].drawCard(this._handElem, true);
      }
    }
  }
}

class Blackjack {
  constructor() {
    this._setCanStart(true);
    this._dealer = new DealerPlayer();
    this._player = new HumanPlayer();
  }

  _reset() {
    this._deck = this._initDeck();
    playersDiv.innerHTML = "";
    this._dealer = new DealerPlayer();
    this._player = new HumanPlayer();
  }

  _initDeck() {
    const deck = [];
    const suits = ["diamonds", "clubs", "hearts", "spades"];
    const ranks = [2, 3, 4, 5, 6, 7, 8, 9, 10, "jack", "queen", "king", "ace"];
    for (let i = 0; i < suits.length; i++) {
      for (let j = 0; j < ranks.length; j++) {
        deck.push(new Card(suits[i], ranks[j]));
      }
    }
    return deck;
  }

  _drawCard(player) {
    // let kan voor const vervangen worden, omdat binnen scope waarde niet wijzigt
    // antwoord: klopt, ik ben het hele bestand doorgegaan en heb het gecorrigeerd
    const cardNr = Math.random() * this._deck.length;
    const card = this._deck.splice(cardNr, 1)[0];
    player.addCard(card);
  }

  _setCanStart(canStart) {
    this._canStart = canStart;
    if (canStart) {
      dealCardButton.innerHTML = "Delen";
      passButton.setAttribute("disabled", "");
    } else {
      dealCardButton.innerHTML = "Hit";
      passButton.removeAttribute("disabled");
    }
  }

  canStart() {
    return this._canStart;
  }

  start() {
    this._reset();

    this._drawCard(this._dealer);
    this._drawCard(this._dealer);

    this._drawCard(this._player);
    this._drawCard(this._player);

    this._setCanStart(false);
  }

  hit() {
    this._drawCard(this._player);
    const score = this._player.score;
    if (score == 21) {
      this._endGame("You win");
    }
    if (score > 21) {
      this._endGame("You lose");
    }
  }

  pas() {
    const dealer = this._dealer;

    dealer.setHandVisible();

    let score = dealer.score;
    const playerScore = this._player.score;
    while (score < 17) {
      if (score == 16 && playerScore == 16) {
        break;
      }
      this._drawCard(dealer);
      score = dealer.score;
    }
    if (score > 21 || score < playerScore) {
      this._endGame("You win");
    } else {
      if (score > playerScore) {
        this._endGame("You lose");
      }
      if (score == playerScore) {
        this._endGame("Stand-off");
      }
    }
  }

  _endGame(message) {
    alert(message);
    this._setCanStart(true);
  }
}

const game = new Blackjack();

dealCardButton.addEventListener("click", () => {
  if (game.canStart()) {
    game.start();
  } else {
    game.hit();
  }
});

// the closure is needed to ensure so this refers to the game instead of the button
passButton.addEventListener("click", () => {
  game.pas();
});
