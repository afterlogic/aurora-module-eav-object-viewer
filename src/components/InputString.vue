<template>
  <div class="input">
    <input ref="inputs" class="ui input" v-model="value" />
    <div @click="onClick" >Click</div>
  </div>
</template>

<script>
import _ from "lodash"
import { EventBus } from '@/Events.js';

export default {
  name: 'InputString',
  props: {
    rowData: {
      type: Object
    },
    rowIndex: {
      type: Number
    },
    rowField: {
      type: String
    }
  },
  data() {
    return {
      value: null
    };
  },
  mounted () {
    if (this.rowData[this.rowField]) {
      this.value = this.rowData[this.rowField];
    }
  },
  methods: {
    onClick() {
      let data = {
        'cellName': this.rowField,
        'rowIndex': this.rowIndex,
        'value': this.value,
      };
      EventBus.$emit('onCellEdit', data);
    }
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
</style>
