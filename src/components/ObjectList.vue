<template>
  <div class="list">
    <ul>
      <li v-for="item in items" @click="openList(item)" :class="{'selected': currObject === item.value}">{{ item.name }}</li>
    </ul>
  </div>
</template>

<script>
import _ from "lodash"

export default {
  name: 'ObjectList',
  props: {
    msg: String
  },
  data() {
    return {
      items: [
        'obj1',
        'obj2',
      ],
      currObject: null,
    };
  },
  methods: {
    createObjectList (v) {
      if (v) {
        let list = [];

        _.each(v, (item) => {
          list.push({
            'name': item.replace('Aurora_Modules', '').replace(/_/g, ' '),
            'value': item
          });
        })

        this.items = list
      }
    },
    openList (item) {
      this.$router.push({ name: 'ObjectTable', params: { id: item.value}})
    },
  },
  watch: {
    '$store.state.currentObjectName' (v) {
      this.currObject = v;
    },
    '$store.state.objectsList' (v) {
      this.createObjectList(v);
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
.list {
  padding: 80px 0px 20px;
  background: #eee;
  min-width: 200px;
  overflow-y: auto;
  flex-shrink: 0;

  ul {
    list-style-type: none;
    margin: 0px;
    padding: 0px;

    li {
      cursor: pointer;
      margin: 0px;
      padding: 4px 16px;
      white-space: nowrap;

      &:hover {
        background: #ddd;
      }

      &.selected {
        background: #ccc;
      }
    }
  }
}
</style>
