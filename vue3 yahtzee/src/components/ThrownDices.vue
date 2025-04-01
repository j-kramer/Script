<script setup>
const dice = defineModel();

function throwDice() {
    // TODO: alternatief is om de .length property te setten: dice.value.length 0
    /* antwoord: klopt, het punt is om de array te muteren zodat het leeg is. het
     * alternatief is om de hele array in 1 keer te vervangen
     */
    dice.value.splice(0);

    for (let index = 0; index < 5; index++) {
        dice.value.push(Math.floor(Math.random() * 6) + 1);
    }
}
</script>

<template>
    <h2>Dobbelstenen:</h2>
    <table class="center">
        <tbody>
            <tr>
                <td v-for="d in dice" class="dobbelsteen">{{ d }}</td>
            </tr>
        </tbody>
    </table>
    <button @click="throwDice">Gooien!</button>
</template>

<style scoped>
button {
    margin-top: 1rem;
}

.center {
    margin: 0px auto;
}

tr {
    text-align: left;
}

.dobbelsteen {
    border: 2px solid;
    border-radius: 20%;
    width: 30px;
    height: 30px;
    text-align: center;
}
</style>
