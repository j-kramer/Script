<template>
    <label for="status" class="mr-1">Status:</label>
    <select id="status" v-model="selection" required class="border">
        <option v-for="(option, index) in Status" :key="index" :value="option">
            {{ fmtStatus(option) }}
        </option>
    </select>
</template>

<script setup lang="ts">
import {fmtStatus} from '..';
import {Status} from '../types';

const selection = defineModel<Status>();
</script>
