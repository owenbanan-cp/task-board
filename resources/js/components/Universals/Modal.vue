<template>
    <div class="absolute top-0 right-0 w-full h-full bg-[#09090945] md:px-0">
        <div class="px-[20px] absolute w-full md:w-fit top-1/2 -translate-y-1/2 md:right-1/2 md:translate-x-1/2">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "Modal"
}
</script>
