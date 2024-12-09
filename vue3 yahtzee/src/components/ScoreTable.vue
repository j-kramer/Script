<script setup>
import {computed} from 'vue';
const props = defineProps(['dice']);

const counts = computed(() => {
    let count = {
        1: 0,
        2: 0,
        3: 0,
        4: 0,
        5: 0,
        6: 0,
    };
    props.dice.forEach(element => {
        count[element]++;
    });
    return count;
});

const sumDice = computed(() => {
    return props.dice.reduce((sum, current) => sum + current, 0);
});

const maxConsecutiveDiceCount = computed(() => {
    let count = 0;
    let maxCount = 0;
    let dice = props.dice.toSorted();
    for (let i = 0; i < dice.length - 1; i++) {
        let current = dice[i];
        let next = dice[i + 1];
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
});

function sameDice(number) {
    return Object.values(counts.value).find(item => item == number);
}

const scoreDrieGelijke = computed(() => {
    if (sameDice(3) || sameDice(4) ||sameDice(5)) {
        return sumDice;
    }
    return 0;
});

const scoreVierGelijke = computed(() => {
    if (sameDice(4) || sameDice(5)) {
        return sumDice;
    }
    return 0;
});

const scoreKleineStraat = computed(() => {
    if (maxConsecutiveDiceCount.value == 4) {
        return 30;
    }
    return 0;
});

const scoreGroteStraat = computed(() => {
    if (maxConsecutiveDiceCount.value == 5) {
        return 40;
    }
    return 0;
});

const scoreFullHouse = computed(() => {
    if (sameDice(3) && sameDice(2)) {
        return 25;
    }
    return 0;
});

const scoreKans = computed(() => {
    return sumDice;
});

const scoreYahtzee = computed(() => {
    if (sameDice(5)) {
        return 25;
    }
    return 0;
});
</script>

<template>
    <h1>Yahtzee</h1>
    <table>
        <thead>
            <tr>
                <th colspan="2">Simpele scores</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(count, number) in counts" :key="number">
                <th>{{ number }}</th>
                <td class="singleDiceScore">{{ number * count }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th colspan="2">Combinatie scores</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Drie gelijke</th>
                <td class="comboDiceScore">{{ scoreDrieGelijke }}</td>
            </tr>
            <tr>
                <th>Vier gelijke</th>
                <td class="comboDiceScore">{{ scoreVierGelijke }}</td>
            </tr>
            <tr>
                <th>Kleine straat</th>
                <td class="comboDiceScore">{{ scoreKleineStraat }}</td>
            </tr>
            <tr>
                <th>Grote straat</th>
                <td class="comboDiceScore">{{ scoreGroteStraat }}</td>
            </tr>
            <tr>
                <th>Full house</th>
                <td class="comboDiceScore">{{ scoreFullHouse }}</td>
            </tr>
            <tr>
                <th>Kans</th>
                <td class="comboDiceScore">{{ scoreKans }}</td>
            </tr>
            <tr>
                <th>Yahtzee</th>
                <td class="comboDiceScore">{{ scoreYahtzee }}</td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>
table {
    margin: 0px auto;
    width: 150px;
}

thead {
    background-color: #efefef;
    text-align: center;
}

tr {
    text-align: left;
}

.singleDiceScore,
.comboDiceScore {
    text-align: center;
}
</style>
