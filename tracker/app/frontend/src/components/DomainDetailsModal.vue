<template>
  <b-modal :visible="true" @close="$emit('close')" title="Domain Details">
    <p><strong>Name:</strong> {{ domain.name }}</p>
    <p><strong>Balance:</strong> {{ domain.balance }}</p>
    <p><strong>Categories:</strong> {{ domain.categories.join(', ') }}</p>
  </b-modal>
</template>

<script>
export default {
  props: ['domain']
};
</script>
