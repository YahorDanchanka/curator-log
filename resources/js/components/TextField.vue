<template>
  <div class="text-field">
    <div class="text-field__label">{{ label }}</div>
    <div class="text-field__value" v-html="value"></div>
  </div>
</template>

<script lang="ts" setup>
defineProps<{ label: string; value?: string | null }>()
</script>

<style lang="sass" scoped>
.text-field
  display: flex
  align-items: center
  flex-wrap: wrap

.text-field__value
  flex-grow: 1
  text-align: center
  border-bottom: 1px solid
  min-height: 24px
</style>
