<template>
  <div class="main-panel ui">
    <h1>{{title}}</h1>
    <div class="vuetable-pagination ui basic segment grid">
      <select class="ui dropdown" v-model="searchField" style="width: 250px; min-height:46px;">
        <option value="">None</option>
        <option v-for="(field, index) in fields" :value="field" :key="index">{{field}}</option>
      </select>
      <div class="ui icon input">
        <input type="text" placeholder="Search" v-model="searchText" @keypress.13="onEnter"/>
      </div>
    </div>
    <div class="vuetable-pagination ui basic segment grid"  v-if="!loading">
      <vuetable-pagination-info ref="paginationInfo"
      ></vuetable-pagination-info>
      <div class="ui icon input">
        <input type="text" placeholder="Per page" v-model="perPageInput" @keypress.13="onEnter"/>
      </div>
      <vuetable-pagination ref="pagination"
        @vuetable-pagination:change-page="onChangePage"
      ></vuetable-pagination>
    </div>
    <div v-if="loading">Loading...</div>
    <div class="table-container" v-if="currentObjectName">
      <vuetable ref="vuetable" v-show="!loading"
        :api-url="apiUrl"
        :fields="tableHeaders"
        data-path="result.Values"
        pagination-path="result.pagination"
        http-method="post"
        :http-fetch="getObjectData"
        :per-page="1*perPage"
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
        <div class="ui form">
          <div class="buttons">
            <button class="ui primary button" @click="saveData">Save</button>
            <button class="ui button" @click="onCancelEdit">Cancel</button>
          </div>
          <div class="grid stackable two column ui">
              <div class="column field" v-for="(field,index) in editedRow" :key="index">
                <label>{{field.name}}</label>
                <input type="text" v-model="field.value" />
              </div>
          </div>
          <div class="buttons">
            <button class="ui primary button" @click="saveData">Save</button>
            <button class="ui button" @click="onCancelEdit">Cancel</button>
          </div>
        </div>
      </div>
    </sweet-modal>
  </div>
</template>

<script>
import Vuetable from 'vuetable-2/src/components/Vuetable.vue';
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination.vue';
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo.vue';
import axios from 'axios';
import _ from 'lodash';

export default {
  name: 'ObjectTable',
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
  },
  props: {
    id: String,
  },
  data() {
    return {
      currentObjectName: '',
      fields: [],
      tableHeaders: [],
      currPage: 1,
      // 'perPage': 10,
      perPageInput: '10',
      loading: false,
      selectedEntityIds: [],
      searchField: '',
      searchText: '',
      editedRow: [],
    };
  },
  computed: {
    // get only
    apiUrl() {
      return `${this.$store.state.apiUrl}-action`;
    },
    title() {
      return this.currentObjectName.replace('Aurora_Modules', '').replace(/_/g, ' ');
    },
    perPage() {
      let
        newValue = 10;
      const currValue = parseInt(Number(this.perPageInput), 10);
      if (!isNaN(currValue) && currValue > 0) {
        newValue = currValue;
      }

      return newValue;
    },
  },
  watch: {
    '$store.state.currentObjectName' (v) {
      this.currentObjectName = v;
      this.$refs.vuetable.reload();
    },
    id(v) {
      this.$store.dispatch('setObjectsName', v);
    },
  },
  mounted: function (params) {
    console.log('mounted this.$store.state.currentObjectName', this.$store.state.currentObjectName);
    this.currentObjectName = this.$store.state.currentObjectName;
  },
  methods: {
    getObjectData() {
      console.log('this.currentObjectName1', this.currentObjectName);
      this.$refs.vuetable.selectedTo = [];
      this.selectedEntityIds = [];

      this.loading = true;
      const iOffset = (this.currPage - 1) * parseInt(this.perPage, 10);
      const self = this;
      const aObj = axios({
        url: `${this.apiUrl}`,
        method: 'post',
        // headers: { 'Content-Type': 'text/plain' },
        data: `action=list&ObjectName=${this.currentObjectName}&offset=${iOffset}&limit=${this.perPage}&searchField=${this.searchField}&searchText=${this.searchText}`,
      });
      aObj.then((response) => {
        self.loading = false;

        if (response.data && response.data.result && response.data.result.Fields) {
          self.setFields(response.data.result.Fields);

          self.$nextTick(() => {
            // this is required because vuetable uses tableFields internally, not fields
            self.$refs.vuetable.normalizeFields();
            // self.$refs.vuetable.reload()
          });
        }
      });
      return aObj;
    },
    setFields(data) {
      const fields = _.keys(data);
      this.fields = fields;
      this.tableHeaders = _.concat('__checkbox', '__slot:actions', 'EntityId', fields);
    },
    deleteRow(rowData) {
      if (rowData.EntityId > 0 && confirm(`The object with the EntityId: ${rowData.EntityId} will be deleted`)) {
        axios({
          url: `${this.apiUrl}`,
          method: 'post',
          // headers: { 'Content-Type': 'text/plain' },
          data: `action=delete&ids=${rowData.EntityId}`,
        })
          .then(() => {
            this.$nextTick(function () {
              this.$refs.vuetable.reload();
            });
          });
      }
    },
    onCheckboxToggled() {
      this.selectedEntityIds = this.$refs.vuetable.selectedTo;
    },
    onPaginationData(paginationData) {
      if (paginationData) {
        paginationData.next_page_url = `${this.apiUrl}`;
        paginationData.prev_page_url = `${this.apiUrl}`;
        paginationData.last_page = Math.ceil(paginationData.total / parseInt(this.perPage, 10));
        paginationData.current_page = this.currPage;
  
        this.$refs.pagination.setPaginationData(paginationData);
        this.$refs.paginationInfo.setPaginationData(paginationData);
      }
    },
    onChangePage(page) {
      if (page === 'next') {
        this.currPage += 1;
      } else if (page === 'prev') {
        this.currPage -= 1;
      } else {
        this.currPage = page;
      }
      this.$refs.vuetable.changePage(page);
    },
    deleteRows() {
      if (this.selectedEntityIds.length > 0 && confirm(`The objects with the following EntityIds will be deleted: ${this.selectedEntityIds.join()}`)) {
        axios({
          url: `${this.apiUrl}`,
          method: 'post',
          // headers: { 'Content-Type': 'text/plain' },
          data: `action=delete&ids=${this.selectedEntityIds.join(',')}`,
        })
          .then((response) => {
            this.$nextTick(function () {
              this.$refs.vuetable.reload();
            });
          });
      }
    },
    saveData() {
      const dataForSave = {};
      _.each(this.editedRow, (field) => {
        dataForSave[field.name] = field.value;
      });

      const properties = JSON.stringify(dataForSave);
      axios({
        url: `${this.apiUrl}`,
        method: 'post',
        // headers: { 'Content-Type': 'text/plain' },
        // data: `action=edit&manager=objects&ObjectName=${this.id}&${dataForSave.join('&')}`,
        data: `action=edit&manager=objects&ObjectName=${this.currentObjectName}&properties=${properties}`,
      })
        .then(() => {
          this.$nextTick(function () {
            this.editedRow = [];
            this.$refs.vuetable.reload();
            this.$refs.modalEditor.close();
          });
        });
    },
    onRowClick(row) {
      const rowData = [];
      _.each(row, (value, key) => {
        rowData.push({
          name: key,
          value,
        });
      });

      this.editedRow = rowData;
      this.$refs.modalEditor.open();
    },
    onCancelEdit() {
      this.editedRow = [];
      this.$refs.modalEditor.close();
    },
    onEnter() {
      if (parseInt(Number(this.perPageInput), 10) !== this.perPage) {
        this.perPageInput = this.perPage;
      }
      this.$refs.vuetable.reload();
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
.sweet-content-content .buttons {
  text-align: right;
  margin: 0px 0px 10px;
}
</style>
