import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import config from '@/config';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    apiUrl: config.ApiUrl,
    objectsList: null,
    currentObjectName: '',
  },
  mutations: {
    setObjectsList(state, v) {
      // eslint-disable-next-line no-param-reassign
      state.objectsList = v;
    },
    setObjectsName(state, v) {
      // eslint-disable-next-line no-param-reassign
      state.currentObjectName = v;
    },
    setAppUrl(state, v) {
      // eslint-disable-next-line no-param-reassign
      state.apiUrl = v;
    },
  },
  actions: {
    setAppUrl({ commit }, data) {
      // eslint-disable-next-line no-param-reassign
      console.log('setAppUrl', data);
      commit('setAppUrl', data);
    },
    getObjectsList({ commit, state }) {
      axios({
        url: `${state.apiUrl}-action`,
        method: 'post',
        // headers: { 'Content-Type': 'text/plain' },
        data: 'action=types',
      })
        .then((response) => {
          if (response && response.data && response.data.result) {
            commit('setObjectsList', response.data.result);
          } else {
            // this._vm.$bus.$emit('loginFailed')
            console.log("can't get data");
          }
        })
        .catch((err) => {
          // this._vm.$bus.$emit('loginFailed')
          // handleErr(err, this._vm);
        });
    },
    setObjectsName({ commit }, data) {
      // eslint-disable-next-line no-param-reassign
      commit('setObjectsName', data);
    },
  },
});
