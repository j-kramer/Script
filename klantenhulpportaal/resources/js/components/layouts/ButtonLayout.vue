<template>
    <div class="my-5">
        <slot />
    </div>

    <div class="flex flex-row justify-evenly">
        <slot name="buttons" />
    </div>
</template>
