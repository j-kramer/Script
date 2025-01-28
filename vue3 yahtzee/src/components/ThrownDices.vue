<script setup>
const dice = defineModel();

function gooi() {
    /*
     * dice.value = [];
     * if this is used the template does not seems to pick up on the changes in the for loop
     * idk why
     */
    // TODO: alternatief is om de .length property te setten: dice.value.length 0
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
    <button @click="gooi">Gooien!</button>
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
