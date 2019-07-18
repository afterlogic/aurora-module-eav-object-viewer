(function (t) { function e(e) { for (var a, s, r = e[0], c = e[1], l = e[2], u = 0, p = []; u < r.length; u++)s = r[u], i[s] && p.push(i[s][0]), i[s] = 0; for (a in c)Object.prototype.hasOwnProperty.call(c, a) && (t[a] = c[a]); d && d(e); while (p.length)p.shift()(); return o.push.apply(o, l || []), n(); } function n() { for (var t, e = 0; e < o.length; e++) { for (var n = o[e], a = !0, s = 1; s < n.length; s++) { const c = n[s]; i[c] !== 0 && (a = !1); }a && (o.splice(e--, 1), t = r(r.s = n[0])); } return t; } const a = {}; var i = { app: 0 }; var o = []; function s(t) { return `${r.p}js/${{ about: 'about' }[t] || t}.${{ about: 'd3df8bf0' }[t]}.js`; } function r(e) { if (a[e]) return a[e].exports; const n = a[e] = { i: e, l: !1, exports: {} }; return t[e].call(n.exports, n, n.exports, r), n.l = !0, n.exports; }r.e = function (t) { const e = []; let n = i[t]; if (n !== 0) if (n)e.push(n[2]); else { const a = new Promise(((e, a) => { n = i[t] = [e, a]; })); e.push(n[2] = a); let o; const c = document.createElement('script'); c.charset = 'utf-8', c.timeout = 120, r.nc && c.setAttribute('nonce', r.nc), c.src = s(t), o = function (e) { c.onerror = c.onload = null, clearTimeout(l); const n = i[t]; if (n !== 0) { if (n) { const a = e && (e.type === 'load' ? 'missing' : e.type); const o = e && e.target && e.target.src; const s = new Error(`Loading chunk ${t} failed.\n(${a}: ${o})`); s.type = a, s.request = o, n[1](s); }i[t] = void 0; } }; var l = setTimeout(() => { o({ type: 'timeout', target: c }); }, 12e4); c.onerror = c.onload = o, document.head.appendChild(c); } return Promise.all(e); }, r.m = t, r.c = a, r.d = function (t, e, n) { r.o(t, e) || Object.defineProperty(t, e, { enumerable: !0, get: n }); }, r.r = function (t) { typeof Symbol !== 'undefined' && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, { value: 'Module' }), Object.defineProperty(t, '__esModule', { value: !0 }); }, r.t = function (t, e) { if (1 & e && (t = r(t)), 8 & e) return t; if (4 & e && typeof t === 'object' && t && t.__esModule) return t; const n = Object.create(null); if (r.r(n), Object.defineProperty(n, 'default', { enumerable: !0, value: t }), 2 & e && typeof t !== 'string') for (const a in t)r.d(n, a, (e => t[e]).bind(null, a)); return n; }, r.n = function (t) { const e = t && t.__esModule ? function () { return t.default; } : function () { return t; }; return r.d(e, 'a', e), e; }, r.o = function (t, e) { return Object.prototype.hasOwnProperty.call(t, e); }, r.p = '/', r.oe = function (t) { throw console.error(t), t; }; let c = window.webpackJsonp = window.webpackJsonp || []; const l = c.push.bind(c); c.push = e, c = c.slice(); for (let u = 0; u < c.length; u++)e(c[u]); var d = l; o.push([0, 'chunk-vendors']), n(); }({
  0(t, e, n) { t.exports = n('56d7'); },
  5100(t, e, n) {},
  '56d7': function (t, e, n) {
    n.r(e); n('cadf'), n('551c'), n('f751'), n('097d'); const a = n('2b0e'); const i = n('43f9'); const o = n.n(i); const s = (n('51de'), n('9ebe')); const r = n('2e9c'); const c = function () { const t = this; const e = t.$createElement; const n = t._self._c || e; return n('div', { attrs: { id: 'app' } }, [n('ObjectList'), n('router-view')], 1); }; const l = []; const u = function () {
      const t = this; const e = t.$createElement; const n = t._self._c || e; return n('div', { staticClass: 'list' }, [n('div', { staticClass: 'ui input fluid' }, [n('input', {
        directives: [{
          name: 'model', rawName: 'v-model', value: t.apiUrlInput, expression: 'apiUrlInput',
        }],
        attrs: { type: 'text' },
        domProps: { value: t.apiUrlInput },
        on: { keypress(e) { return e.type.indexOf('key') || e.keyCode === 13 ? t.onApiUrlEnter(e) : null; }, input(e) { e.target.composing || (t.apiUrlInput = e.target.value); } },
      })]), n('ul', t._l(t.items, e => n('li', { class: { selected: t.currObject === e.value }, on: { click(n) { return t.openList(e); } } }, [t._v(t._s(e.name))])), 0)]);
    }; const d = []; const p = (n('a481'), n('2ef0')); const f = n.n(p); const h = {
      name: 'ObjectList', props: { msg: String }, data() { return { apiUrlInput: '', items: ['obj1', 'obj2'], currObject: null }; }, watch: { '$store.state.currentObjectName': function (t) { this.currObject = t; }, '$store.state.objectsList': function (t) { this.createObjectList(t); }, '$store.state.apiUrl': function (t) { this.apiUrlInput = t, this.$store.dispatch('getObjectsList'); } }, mounted(t) { this.apiUrlInput = this.$store.state.apiUrl, console.log(); }, methods: { createObjectList(t) { if (t) { const e = []; f.a.each(t, (t) => { e.push({ name: t.replace('Aurora_Modules', '').replace(/_/g, ' '), value: t }); }), this.items = e; } }, openList(t) { this.$router.push({ name: 'ObjectTable', params: { id: t.value } }); }, onApiUrlEnter() { this.$store.dispatch('setAppUrl', this.apiUrlInput); } },
    }; const v = h; const b = (n('d276'), n('2877')); const g = Object(b.a)(v, u, d, !1, null, '7d2b1ba6', null); const m = g.exports; const y = { name: 'home', components: { ObjectList: m }, mounted() { this.$store.dispatch('getObjectsList'); } }; const _ = y; const w = (n('5c0b'), Object(b.a)(_, c, l, !1, null, null, null)); const j = w.exports; const x = n('8c4f'); const P = function () {
      const t = this; const e = t.$createElement; const n = t._self._c || e; return n('div', { staticClass: 'main-panel ui' }, [n('h1', [t._v(t._s(t.title))]), n('div', { staticClass: 'vuetable-pagination ui basic segment grid' }, [n('select', {
        directives: [{
          name: 'model', rawName: 'v-model', value: t.searchField, expression: 'searchField',
        }],
        staticClass: 'ui dropdown',
        staticStyle: { width: '250px', 'min-height': '46px' },
        on: { change(e) { const n = Array.prototype.filter.call(e.target.options, t => t.selected).map((t) => { const e = '_value' in t ? t._value : t.value; return e; }); t.searchField = e.target.multiple ? n : n[0]; } },
      }, [n('option', { attrs: { value: '' } }, [t._v('None')]), t._l(t.fields, (e, a) => n('option', { key: a, domProps: { value: e } }, [t._v(t._s(e))]))], 2), n('div', { staticClass: 'ui icon input' }, [n('input', {
        directives: [{
          name: 'model', rawName: 'v-model', value: t.searchText, expression: 'searchText',
        }],
        attrs: { type: 'text', placeholder: 'Search' },
        domProps: { value: t.searchText },
        on: { keypress(e) { return e.type.indexOf('key') || e.keyCode === 13 ? t.onEnter(e) : null; }, input(e) { e.target.composing || (t.searchText = e.target.value); } },
      })])]), t.loading ? t._e() : n('div', { staticClass: 'vuetable-pagination ui basic segment grid' }, [n('vuetable-pagination-info', { ref: 'paginationInfo' }), n('div', { staticClass: 'ui icon input' }, [n('input', {
        directives: [{
          name: 'model', rawName: 'v-model', value: t.perPageInput, expression: 'perPageInput',
        }],
        attrs: { type: 'text', placeholder: 'Per page' },
        domProps: { value: t.perPageInput },
        on: { keypress(e) { return e.type.indexOf('key') || e.keyCode === 13 ? t.onEnter(e) : null; }, input(e) { e.target.composing || (t.perPageInput = e.target.value); } },
      })]), n('vuetable-pagination', { ref: 'pagination', on: { 'vuetable-pagination:change-page': t.onChangePage } })], 1), t.loading ? n('div', [t._v('Loading...')]) : t._e(), n('div', { staticClass: 'table-container' }, [n('vuetable', {
        directives: [{
          name: 'show', rawName: 'v-show', value: !t.loading, expression: '!loading',
        }],
        ref: 'vuetable',
        attrs: {
          'api-url': t.apiUrl, fields: t.tableHeaders, 'data-path': 'result.Values', 'pagination-path': 'result.pagination', 'http-method': 'post', 'http-fetch': t.getObjectData, 'per-page': 1 * t.perPage, 'track-by': 'EntityId',
        },
        on: {
          'vuetable:pagination-data': t.onPaginationData, 'vuetable:checkbox-toggled': t.onCheckboxToggled, 'vuetable:checkbox-toggled-all': t.onCheckboxToggled, 'vuetable:row-dblclicked': t.onRowClick,
        },
        scopedSlots: t._u([{ key: 'actions', fn(e) { return [n('div', { staticClass: 'table-button-container' }, [n('button', { staticClass: 'ui basic red button', on: { click(n) { return t.deleteRow(e.rowData); } } }, [t._v('Delete')])])]; } }]),
      })], 1), t.selectedEntityIds.length > 0 ? n('div', { staticClass: 'table-button-container' }, [t._v(`\n    Selected items EntityId: ${t._s(t.selectedEntityIds)}\n    `), n('button', { staticClass: 'ui basic red button', on: { click: t.deleteRows } }, [t._v('Delete')])]) : t._e(), n('sweet-modal', { ref: 'modalEditor', attrs: { width: '800px', blocking: '', 'overlay-theme': 'dark' } }, [n('div', [n('h2', [t._v(t._s(t.title))]), n('div', { staticClass: 'ui form' }, [n('div', { staticClass: 'buttons' }, [n('button', { staticClass: 'ui primary button', on: { click: t.saveData } }, [t._v('Save')]), n('button', { staticClass: 'ui button', on: { click: t.onCancelEdit } }, [t._v('Cancel')])]), n('div', { staticClass: 'grid stackable two column ui' }, t._l(t.editedRow, (e, a) => n('div', { key: a, staticClass: 'column field' }, [n('label', [t._v(t._s(e.name))]), n('input', {
        directives: [{
          name: 'model', rawName: 'v-model', value: e.value, expression: 'field.value',
        }],
        attrs: { type: 'text' },
        domProps: { value: e.value },
        on: { input(n) { n.target.composing || t.$set(e, 'value', n.target.value); } },
      })])), 0), n('div', { staticClass: 'buttons' }, [n('button', { staticClass: 'ui primary button', on: { click: t.saveData } }, [t._v('Save')]), n('button', { staticClass: 'ui button', on: { click: t.onCancelEdit } }, [t._v('Cancel')])])])])])], 1);
    }; const O = []; const k = (n('7f7f'), n('ac6a'), n('c5f6'), n('c3d0')); const C = n('3568'); const I = n('127e'); const E = n('bc3a'); const $ = n.n(E); const U = {
      name: 'ObjectTable',
      components: { Vuetable: k.a, VuetablePagination: C.a, VuetablePaginationInfo: I.a },
      props: { id: String },
      data() {
        return {
          fields: [], tableHeaders: [], currPage: 1, perPageInput: '10', loading: !1, selectedEntityIds: [], searchField: '', searchText: '', editedRow: [],
        };
      },
      computed: { apiUrl() { return ''.concat(this.$store.state.apiUrl, '-action'); }, title() { return this.id.replace('Aurora_Modules', '').replace(/_/g, ' '); }, perPage() { let t = 10; const e = parseInt(Number(this.perPageInput), 10); return !isNaN(e) && e > 0 && (t = e), t; } },
      watch: { id(t) { this.$refs.vuetable.reload(), this.$store.dispatch('setObjectsName', t); } },
      methods: {
        getObjectData() {
          this.$refs.vuetable.selectedTo = [], this.selectedEntityIds = [], this.loading = !0; const t = (this.currPage - 1) * parseInt(this.perPage, 10); const e = this; const n = $()({
            url: ''.concat(this.apiUrl),
            method: 'post',
            data: 'action=list&ObjectName='.concat(this.id, '&offset=').concat(t, '&limit=').concat(this.perPage, '&searchField=').concat(this.searchField, '&searchText=')
              .concat(this.searchText),
          }); return n.then((t) => { e.loading = !1, e.setFields(t.data.result.Fields), e.$nextTick(() => { e.$refs.vuetable.normalizeFields(); }); }), n;
        },
        setFields(t) { const e = f.a.keys(t); this.fields = e, this.tableHeaders = f.a.concat('__checkbox', '__slot:actions', 'EntityId', e); },
        deleteRow(t) { const e = this; t.EntityId > 0 && confirm('The object with the EntityId: '.concat(t.EntityId, ' will be deleted')) && $()({ url: ''.concat(this.apiUrl), method: 'post', data: 'action=delete&ids='.concat(t.EntityId) }).then(() => { e.$nextTick(function () { this.$refs.vuetable.reload(); }); }); },
        onCheckboxToggled() { this.selectedEntityIds = this.$refs.vuetable.selectedTo; },
        onPaginationData(t) { t.next_page_url = ''.concat(this.apiUrl), t.prev_page_url = ''.concat(this.apiUrl), t.last_page = Math.ceil(t.total / parseInt(this.perPage, 10)), t.current_page = this.currPage, this.$refs.pagination.setPaginationData(t), this.$refs.paginationInfo.setPaginationData(t); },
        onChangePage(t) { t === 'next' ? this.currPage += 1 : t === 'prev' ? this.currPage -= 1 : this.currPage = t, this.$refs.vuetable.changePage(t); },
        deleteRows() { const t = this; this.selectedEntityIds.length > 0 && confirm('The objects with the following EntityIds will be deleted: '.concat(this.selectedEntityIds.join())) && $()({ url: ''.concat(this.apiUrl), method: 'post', data: 'action=delete&ids='.concat(this.selectedEntityIds.join(',')) }).then((e) => { t.$nextTick(function () { this.$refs.vuetable.reload(); }); }); },
        saveData() { const t = this; const e = {}; f.a.each(this.editedRow, (t) => { e[t.name] = t.value; }); const n = JSON.stringify(e); console.log(), $()({ url: ''.concat(this.apiUrl), method: 'post', data: 'action=edit&manager=objects&ObjectName='.concat(this.id, '&properties=').concat(n) }).then(() => { t.$nextTick(function () { this.editedRow = [], this.$refs.vuetable.reload(), this.$refs.modalEditor.close(); }); }); },
        onRowClick(t) { const e = []; f.a.each(t, (t, n) => { e.push({ name: n, value: t }); }), this.editedRow = e, this.$refs.modalEditor.open(); },
        onCancelEdit() { this.editedRow = [], this.$refs.modalEditor.close(); },
        onEnter() { parseInt(Number(this.perPageInput), 10) !== this.perPage && (this.perPageInput = this.perPage), this.$refs.vuetable.reload(); },
      },
    }; const T = U; const N = (n('f00f'), Object(b.a)(T, P, O, !1, null, null, null)); const L = N.exports; a.default.use(x.a); const S = new x.a({
      routes: [{
        path: '/list/:id/', name: 'ObjectTable', components: { default: L }, props: { default: !0 },
      }, { path: '/about', name: 'about', component() { return n.e('about').then(n.bind(null, 'f820')); } }],
    }); const A = n('2f62'); const D = { ApiUrl: '?eav-viewer' }; a.default.use(A.a); const R = new A.a.Store({ state: { apiUrl: D.ApiUrl, objectsList: null, currentObjectName: '' }, mutations: { setObjectsList(t, e) { t.objectsList = e; }, setObjectsName(t, e) { t.currentObjectName = e; }, setAppUrl(t, e) { t.apiUrl = e; } }, actions: { setAppUrl(t, e) { const n = t.commit; console.log('setAppUrl', e), n('setAppUrl', e); }, getObjectsList(t) { const e = t.commit; const n = t.state; $()({ url: ''.concat(n.apiUrl, '-action'), method: 'post', data: 'action=types' }).then((t) => { t && t.data && t.data.result ? e('setObjectsList', t.data.result) : console.log("can't get data"); }).catch((t) => {}); }, setObjectsName(t, e) { const n = t.commit; n('setObjectsName', e); } } }); a.default.use(o.a), a.default.use(s.ServerTable), a.default.use(s.ClientTable), a.default.use(r.a), a.default.config.productionTip = !1, new a.default({ router: S, store: R, render(t) { return t(j); } }).$mount('#app');
  },
  '5c0b': function (t, e, n) {
    const a = n('5e27'); const i = n.n(a); i.a;
  },
  '5e27': function (t, e, n) {},
  d276(t, e, n) {
    const a = n('e090'); const i = n.n(a); i.a;
  },
  e090(t, e, n) {},
  f00f(t, e, n) {
    const a = n('5100'); const i = n.n(a); i.a;
  },
}));
// # sourceMappingURL=app.adf7deef.js.map
