<template>
<div>
  <a class='delete' @click='erase'></a>
  <input />
</div>
</template>

<script>
// import _ from "lodash"
// import { EventBus } from '@/Events.js';

export default {
  props: ['data', 'index', 'column'],
  methods: {
    erase() {
      let id = this.data.id; // delete the item
      console.log('delete', this.data, this.column);
    }
  },

  // data() {
  //   return {
  //     value: null
  //   };
  // },
  mounted () {
    console.log('mounted', this.column);
    
  },
  // methods: {
  //   onClick() {
  //     let data = {
  //       'cellName': this.rowField,
  //       'rowIndex': this.rowIndex,
  //       'value': this.value,
  //     };
  //     EventBus.$emit('onCellEdit', data);
  //   }
  // },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss">
</style>
