"use strict";

const boodschappenlijst = document.getElementById("boodschappenlijst");
const productPrices = document.getElementsByClassName("productPrice");
const productQuantities = document.getElementsByClassName("productQuantity");
const productTotalCosts = document.getElementsByClassName("productTotalCost");
const totalPriceElem = document.getElementById("totalCost");

boodschappenlijst.addEventListener("change", recalculateTotalPrice);
recalculateTotalPrice();

function recalculateTotalPrice() {
    let totalPrice = 0;
    for (let i = 0; i < productPrices.length; i++) {
        let subTotal = 0;
        let price = productPrices[i].innerHTML;
        let number = productQuantities[i].value ?? 0;
        // ignore the product on negative quantities
        if (number < 0) {
            continue;
        }
        subTotal = price * number;
        productTotalCosts[i].innerHTML = subTotal.toFixed(2);
        totalPrice += subTotal;
    }
    totalPriceElem.innerHTML = totalPrice.toFixed(2);
}