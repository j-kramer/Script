<script setup>
const props = defineProps(['inventory'])
</script>

<template>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Available</th>
        <th>Minimum</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in inventory" :key="index">
        <td>{{ item.name }}</td>
        <td>{{ item.actualAmount }}</td>
        <td>{{ item.minimumAmount }}</td>
      </tr>
    </tbody>
  </table>
</template>
