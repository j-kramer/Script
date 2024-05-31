const heading = document.getElementById("heading");
const myName = "j-kramer";
const colors = ['red', 'green', 'blue', 'yellow', 'magenta'];

function changeHeading() {
    /* set text in the heading */
    heading.innerHTML = "Hi " + myName + "!";
    /* toggle visibility of the heading
     *
     * use style.visibility instead of style.display, since
     * we do not need to remove the element from the dom
     */
    if (heading.style.visibility == 'hidden') {
        heading.style.visibility = 'visible';
    } else {
        heading.style.visibility = 'hidden';
    }
    /* select a random color from the array
     *
     * Note that the random function returns a
     * right-open interval [0,1).
     */
    let index = Math.floor(Math.random() * colors.length);
    heading.style.color = colors[index];
}