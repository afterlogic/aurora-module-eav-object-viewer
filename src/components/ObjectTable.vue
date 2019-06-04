<template>
  <div class="main-panel ui">
    <h1>{{title}}</h1>
    <div v-if="loading">Loading...</div>
    <div class="vuetable-pagination ui basic segment grid">
      <vuetable-pagination-info ref="paginationInfo"
      ></vuetable-pagination-info>
      <vuetable-pagination ref="pagination"
        @vuetable-pagination:change-page="onChangePage"
      ></vuetable-pagination>
    </div>
    <div class="table-container">
      <vuetable ref="vuetable" v-show="!loading"
        :api-url="apiUrl"
        :fields="fields"
        data-path="result.Values"
        pagination-path="result.pagination"
        http-method="post"
        :http-fetch="getObjectData"
        :per-page="perPage"
        track-by="EntityId"
        @vuetable:pagination-data="onPaginationData"
        @vuetable:checkbox-toggled="onCheckboxToggled"
        @vuetable:checkbox-toggled-all="onCheckboxToggled"
        @vuetable:row-dblclicked="onRowClick"
      >
        <template slot="actions" scope="props">
          <div class="table-button-container">
            <!-- <button class="ui button" @click="editRow(props.rowData, props)">Edit</button> -->
            <button class="ui basic red button" @click="deleteRow(props.rowData)">Delete</button>
          </div>
        </template>
      </vuetable>
    </div>
    <div class="table-button-container" v-if="selectedEntityIds.length > 0">
      Selected items EntityId: {{selectedEntityIds}}
      <button class="ui basic red button" @click="deleteRows">Delete</button>
    </div>
    <sweet-modal ref="modalEditor" width="800px" blocking overlay-theme="dark">
      <div>
        <h2>{{title}}</h2>
        <form class="ui form">
          <div class="buttons">
            <button class="ui primary button" @click="saveData">Save</button>
            <button class="ui button" @click="onCancelEdit">cancel</button>
          </div>
          <div class="grid stackable two column ui">
              <div class="column field" v-for="(field, index) in editedRow">
                <label>{{field.name}}</label>
                <input type="text" v-model="field.value" />
              </div>
          </div>
          <div class="buttons">
            <button class="ui primary button" @click="saveData">Save</button>
            <button class="ui button" @click="onCancelEdit">cancel</button>
          </div>
        </form>
      </div>
    </sweet-modal>
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
    InputString,
  },
  props: {
    'id': String,
  },
  data() {
    return {
      'fields': [],
      'currPage': 1,
      'perPage': 10,
      'loading': false,
      'selectedEntityIds': [],
      editedRow: [],
    };
  },
  computed: {
    // get only
    apiUrl: function () {
      return `${config.ApiUrl}-action`
    },
    title: function () {
      return this.id.replace('Aurora_Modules', '').replace(/_/g, ' ');
    },
  },
  mounted: function (params) {
    // this.$refs.vuetable.setData([{'name': 1, 'test': 'aa'},{'name': 2, 'test': 'bb'}]);
    
    // EventBus.$on('onCellEdit', data => {
      // console.log('onCellEdit', data);
      // this.value = data;
    // });
  },
  beforeDestroy () {
    // EventBus.$off('onCellEdit');
  },
  watch: {
    id: function(v) {
      // this.getObjectData(v);
      this.$refs.vuetable.reload();
      this.$store.dispatch('setObjectsName', v);
    },
  },
  methods: {
    getObjectData (apiUrl, httpOptions) {
      this.$refs.vuetable.selectedTo = [];
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
        
        self.$nextTick(function() {
            // this is required because vuetable uses tableFields internally, not fields
            self.$refs.vuetable.normalizeFields()
            // self.$refs.vuetable.reload()
        })
      })
      return aObj;
    },
    setFields(data){
      let fields = ['__checkbox'];

      _.each(data, function (value, key) {
        // if (value === 'string') {
        //   fields.push({
        //     name: '__component:input-string',
        //     // name: key,
        //     sortField: key,
        //     title: key,
        //     // callback: 'inputRender'
        //     // titleClass: 'center aligned',
        //     // dataClass: 'center aligned'
        //   });
        // } else {
          fields.push(key);
        // }
      });
      this.fields = fields;
      this.fields.push('__slot:actions');
      console.log('fields', fields);
    },
    // inputRender(value) {
    //   return '<input v-model="'+value+'" />';
    // },
//     editRow(rowData, t){
      
//       console.log('editRow', this.$refs.vuetable);
//       console.log('editRow', rowData, t);
// //      alert("You clicked edit on"+ JSON.stringify(rowData))
//     },
    deleteRow(rowData){
      if (rowData.EntityId > 0 && confirm(`The object with the EntityId: ${rowData.EntityId} will be deleted`)) {
        axios({
          url: `${config.ApiUrl}-action`,
          method: 'post',
          // headers: { 'Content-Type': 'text/plain' },
          data: `action=delete&ids=${rowData.EntityId}`,
        })
        .then((response) => {
          this.$nextTick(function() {
            this.$refs.vuetable.reload()
          })
        })
      };
    },
    onCheckboxToggled(){
      this.selectedEntityIds = this.$refs.vuetable.selectedTo;
    },
    onPaginationData (paginationData) {
      paginationData['next_page_url'] = `${config.ApiUrl}-action`;
      paginationData['prev_page_url'] = `${config.ApiUrl}-action`;
      paginationData['last_page'] = Math.ceil(paginationData['total'] / this.perPage);
      paginationData['current_page'] = this.currPage;

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
      let dataForSave = {};
      _.each(this.editedRow, (field) => {
        dataForSave[field.name] = field.value;
      });

      let properties = JSON.stringify(dataForSave);

      axios({
        url: `${config.ApiUrl}-action`,
        method: 'post',
        // headers: { 'Content-Type': 'text/plain' },
        // data: `action=edit&manager=objects&ObjectName=${this.id}&${dataForSave.join('&')}`,
        data: `action=edit&manager=objects&ObjectName=${this.id}&properties=${properties}`,
      })
      .then((response) => {
        this.$nextTick(function() {
          this.editedRow = [];
          this.$refs.vuetable.reload();
          this.$refs.modalEditor.close();
        })
      })
    },
    onRowClick(row) {
      let rowData = []
      _.each(row, (value, key) => {
        rowData.push({
          'name': key,
          'value': value
        })
      });

      this.editedRow = rowData;
      this.$refs.modalEditor.open();
    },
    onCancelEdit(row) {
      this.editedRow = [];
      this.$refs.modalEditor.close();
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss">
.ui {
  &.form {
    text-align: left;
  }
}
.main-panel {
  padding: 20px 40px;
  overflow: auto;
}
.table-container {
  overflow: auto;
  padding: 1px;
}
.ui.attached.table {
}
.sweet-content-content .buttons {
  text-align: right;
  margin: 0px 0px 10px;
}
</style>
