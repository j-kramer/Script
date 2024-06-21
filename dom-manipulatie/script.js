"use strict";

const heading = document.getElementById("heading");
const MY_NAME = "j-kramer";
const COLORS = ['red', 'green', 'blue', 'yellow', 'magenta'];

function changeHeading() {
    /* set text in the heading */
    heading.innerHTML = "Hi " + MY_NAME + "!";
    // toggle visibility of the heading
    if (heading.style.display == 'none') {
        heading.style.display = 'block';
    } else {
        heading.style.display = 'none';
    }
    /* select a random color from the array
     *
     * Note that the random function returns a
     * right-open interval [0,1).
     */
    let index = Math.floor(Math.random() * COLORS.length);
    heading.style.color = COLORS[index];
}
