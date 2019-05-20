<template>
  <div class="list ui">
     <table>
       <tr>
         <th v-for="column in columns">{{column}}</th>
       </tr>
       <tr v-for="row in rows">
         <td v-for="cell in row">{{cell}}</td>
       </tr>
     </table>

    <div v-if="loading">Loading...</div>

    <button class="ui button" @click="saveData">Save</button>
    <div class="table-button-container" v-if="selectedEntityIds.length > 0">
      Selected items EntityId: {{selectedEntityIds}}
      <button class="ui basic red button" @click="deleteRows">Delete</button>
    </div>
  </div>
</template>

<script>
import Vue from 'vue';
import Vuetable from 'vuetable-2/src/components/Vuetable';
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination';
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo';
import InputString from '@/components/InputString.vue';
import config from '@/config';
import axios from 'axios';
import { EventBus } from '@/Events.js';

Vue.component('input-string', InputString);

export default {
  name: 'ObjectTable',
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
  },
  props: {
    'id': String,
  },
  data() {
    return {
      'fields': [],
      'currPage': 1,
      'perPage': 2,
      'loading': false,
      'selectedEntityIds': [],
      vuetableIsLoading: false,
      columns: ['id', 'EntityId', 'UUID1'],
      rows: [
        [
          1,
          {'value': 2},
          {'value': 3},
        ],
        [
          {'value': 4},
          {'value': 5},
          {'value': 6},
        ],
      ]
    };
  },
  computed: {
    // get only
    apiUrl: function () {
      return `${config.ApiUrl}-action`
    },
  },
  mounted: function (params) {
    // this.$refs.vuetable.setData([{'name': 1, 'test': 'aa'},{'name': 2, 'test': 'bb'}]);
    EventBus.$on('onCellEdit', data => {
      console.log('onCellEdit', data);
      // this.value = data;
    });

    
  },
  beforeDestroy () {
    EventBus.$off('onCellEdit');
  },
  watch: {
    id: function(v) {
      this.getObjectData(v);
      console.log('watch id', v);
      // this.$refs.vuetable.reload();
      // this.$store.dispatch('setObjectsName', v)
    },
  },
  methods: {
    getObjectData (apiUrl, httpOptions) {
      // this.$refs.vuetable.selectedTo = [];
      this.selectedEntityIds = [];

      this.loading = true;
      let iOffset = (this.currPage-1)*this.perPage;
      let self = this;
      let aObj = axios({
        url: `${config.ApiUrl}-action`,
        method: 'post',
        // headers: { 'Content-Type': 'text/plain' },
        data: `action=list&ObjectName=${this.id}&offset=${iOffset}&limit=${this.perPage}`,
      })
      aObj.then(function (response) {
        self.loading = false;
        self.setFields(response.data.result.Fields);
        self.rows = response.data.result.Values;
      })
      return aObj;
    },
    setFields(data){
      let fields = [];

      _.each(data, function (value, key) {
        fields.push(key);
      });
      this.columns = fields;
      // this.fields.push('__slot:actions');
    },
    inputRender(value) {
      console.log(value);
      return '<input v-model="'+value+'" />';
    },
    editRow(rowData, t){
      
      console.log('editRow', this.$refs.vuetable);
      console.log('editRow', rowData, t);
//      alert("You clicked edit on"+ JSON.stringify(rowData))
    },
    deleteRow(rowData){
      alert("You clicked delete on"+ JSON.stringify(rowData))
    },
    onCheckboxToggled(){
      console.log('onCheckboxToggled', arguments);
      this.selectedEntityIds = this.$refs.vuetable.selectedTo;
    },
    onPaginationData (paginationData) {
      paginationData['next_page_url'] = `${config.ApiUrl}-action`;
      paginationData['prev_page_url'] = `${config.ApiUrl}-action`;
      paginationData['last_page'] = Math.ceil(paginationData['total'] / this.perPage);
      paginationData['current_page'] = this.currPage;

      // console.log('onPaginationData', paginationData);
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      if (page === 'next') {
        this.currPage++;
      } else if (page === 'prev') {
        this.currPage--;
      } else {
        this.currPage = page;
      }
      this.$refs.vuetable.changePage(page)
    },
    deleteRows () {
      if (this.selectedEntityIds.length > 0 && confirm(`The objects with the following EntityIds will be deleted: ${this.selectedEntityIds.join()}`)) {
        axios({
          url: `${config.ApiUrl}-action`,
          method: 'post',
          // headers: { 'Content-Type': 'text/plain' },
          data: `action=delete&ids=${this.selectedEntityIds.join(',')}`,
        })
        .then((response) => {
          this.$nextTick(function() {
            this.$refs.vuetable.reload()
          })
        })
      };
    },
    saveData() {
      console.log('this.$refs.vuetable.tableData', this.$refs.vuetable.tableData)
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss">
.table {
  table-layout: fixed;

  th,
  td {
    padding: 10px;
    border-bottom: 2px solid #ddd;
    text-align: left;
  }
  td {
    border-bottom: 1px solid #eee;
  }
}


</style>
