(function(t){function e(e){for(var a,r,c=e[0],s=e[1],u=e[2],l=0,f=[];l<c.length;l++)r=c[l],i[r]&&f.push(i[r][0]),i[r]=0;for(a in s)Object.prototype.hasOwnProperty.call(s,a)&&(t[a]=s[a]);d&&d(e);while(f.length)f.shift()();return o.push.apply(o,u||[]),n()}function n(){for(var t,e=0;e<o.length;e++){for(var n=o[e],a=!0,r=1;r<n.length;r++){var s=n[r];0!==i[s]&&(a=!1)}a&&(o.splice(e--,1),t=c(c.s=n[0]))}return t}var a={},i={app:0},o=[];function r(t){return c.p+"js/"+({about:"about"}[t]||t)+"."+{about:"5b20159e"}[t]+".js"}function c(e){if(a[e])return a[e].exports;var n=a[e]={i:e,l:!1,exports:{}};return t[e].call(n.exports,n,n.exports,c),n.l=!0,n.exports}c.e=function(t){var e=[],n=i[t];if(0!==n)if(n)e.push(n[2]);else{var a=new Promise(function(e,a){n=i[t]=[e,a]});e.push(n[2]=a);var o,s=document.createElement("script");s.charset="utf-8",s.timeout=120,c.nc&&s.setAttribute("nonce",c.nc),s.src=r(t),o=function(e){s.onerror=s.onload=null,clearTimeout(u);var n=i[t];if(0!==n){if(n){var a=e&&("load"===e.type?"missing":e.type),o=e&&e.target&&e.target.src,r=new Error("Loading chunk "+t+" failed.\n("+a+": "+o+")");r.type=a,r.request=o,n[1](r)}i[t]=void 0}};var u=setTimeout(function(){o({type:"timeout",target:s})},12e4);s.onerror=s.onload=o,document.head.appendChild(s)}return Promise.all(e)},c.m=t,c.c=a,c.d=function(t,e,n){c.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},c.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},c.t=function(t,e){if(1&e&&(t=c(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(c.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var a in t)c.d(n,a,function(e){return t[e]}.bind(null,a));return n},c.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return c.d(e,"a",e),e},c.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},c.p="/",c.oe=function(t){throw console.error(t),t};var s=window["webpackJsonp"]=window["webpackJsonp"]||[],u=s.push.bind(s);s.push=e,s=s.slice();for(var l=0;l<s.length;l++)e(s[l]);var d=u;o.push([0,"chunk-vendors"]),n()})({0:function(t,e,n){t.exports=n("56d7")},"17e0":function(t,e,n){"use strict";var a=n("6145"),i=n.n(a);i.a},5100:function(t,e,n){},"56d7":function(t,e,n){"use strict";n.r(e);n("cadf"),n("551c"),n("f751"),n("097d");var a=n("2b0e"),i=n("43f9"),o=n.n(i),r=(n("51de"),n("9ebe")),c=n("2e9c"),s=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"app"}},[n("ObjectList"),n("router-view")],1)},u=[],l=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"list"},[n("ul",t._l(t.items,function(e){return n("li",{class:{selected:t.currObject===e.value},on:{click:function(n){return t.openList(e)}}},[t._v(t._s(e.name))])}),0)])},d=[],f=(n("a481"),n("2ef0")),p=n.n(f),h={name:"ObjectList",props:{msg:String},data:function(){return{items:["obj1","obj2"],currObject:null}},methods:{createObjectList:function(t){if(t){var e=[];p.a.each(t,function(t){e.push({name:t.replace("Aurora_Modules","").replace(/_/g," "),value:t})}),this.items=e}},openList:function(t){this.$router.push({name:"ObjectTable",params:{id:t.value}})}},watch:{"$store.state.currentObjectName":function(t){this.currObject=t},"$store.state.objectsList":function(t){this.createObjectList(t)}}},b=h,v=(n("17e0"),n("2877")),g=Object(v["a"])(b,l,d,!1,null,"6f8e5a06",null),m=g.exports,w={name:"home",components:{ObjectList:m},mounted:function(){this.$store.dispatch("getObjectsList")}},j=w,y=(n("5c0b"),Object(v["a"])(j,s,u,!1,null,null,null)),O=y.exports,P=n("8c4f"),$=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"main-panel ui"},[n("h1",[t._v(t._s(t.title))]),t.loading?n("div",[t._v("Loading...")]):t._e(),n("div",{staticClass:"vuetable-pagination ui basic segment grid"},[n("vuetable-pagination-info",{ref:"paginationInfo"}),n("vuetable-pagination",{ref:"pagination",on:{"vuetable-pagination:change-page":t.onChangePage}})],1),n("div",{staticClass:"table-container"},[n("vuetable",{directives:[{name:"show",rawName:"v-show",value:!t.loading,expression:"!loading"}],ref:"vuetable",attrs:{"api-url":t.apiUrl,fields:t.fields,"data-path":"result.Values","pagination-path":"result.pagination","http-method":"post","http-fetch":t.getObjectData,"per-page":t.perPage,"track-by":"EntityId"},on:{"vuetable:pagination-data":t.onPaginationData,"vuetable:checkbox-toggled":t.onCheckboxToggled,"vuetable:checkbox-toggled-all":t.onCheckboxToggled,"vuetable:row-dblclicked":t.onRowClick},scopedSlots:t._u([{key:"actions",fn:function(e){return[n("div",{staticClass:"table-button-container"},[n("button",{staticClass:"ui basic red button",on:{click:function(n){return t.deleteRow(e.rowData)}}},[t._v("Delete")])])]}}])})],1),t.selectedEntityIds.length>0?n("div",{staticClass:"table-button-container"},[t._v("\n    Selected items EntityId: "+t._s(t.selectedEntityIds)+"\n    "),n("button",{staticClass:"ui basic red button",on:{click:t.deleteRows}},[t._v("Delete")])]):t._e(),n("sweet-modal",{ref:"modalEditor",attrs:{width:"600px",blocking:""}},[n("div",[n("h2",[t._v(t._s(t.title))]),n("form",{staticClass:"ui form"},[t._l(t.editedRow,function(e){return n("div",{staticClass:"field"},[n("label",[t._v(t._s(e.name))]),n("input",{directives:[{name:"model",rawName:"v-model",value:e.value,expression:"field.value"}],attrs:{type:"text"},domProps:{value:e.value},on:{input:function(n){n.target.composing||t.$set(e,"value",n.target.value)}}})])}),n("button",{staticClass:"ui primary button",on:{click:t.saveData}},[t._v("Save")]),n("button",{staticClass:"ui button",on:{click:t.onCancelEdit}},[t._v("cancel")])],2)])])],1)},x=[],k=(n("7f7f"),n("c3d0")),C=n("3568"),E=n("127e"),I=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"input"},[n("input",{directives:[{name:"model",rawName:"v-model",value:t.value,expression:"value"}],ref:"inputs",staticClass:"ui input",domProps:{value:t.value},on:{input:function(e){e.target.composing||(t.value=e.target.value)}}}),n("div",{on:{click:t.onClick}},[t._v("Click")])])},T=[],L=(n("c5f6"),new a["default"]),S={name:"InputString",props:{rowData:{type:Object},rowIndex:{type:Number},rowField:{type:String}},data:function(){return{value:null}},mounted:function(){this.rowData[this.rowField]&&(this.value=this.rowData[this.rowField])},methods:{onClick:function(){var t={cellName:this.rowField,rowIndex:this.rowIndex,value:this.value};L.$emit("onCellEdit",t)}}},D=S,N=Object(v["a"])(D,I,T,!1,null,"089b73b6",null),A=N.exports,R={ApiUrl:"?eav-viewer"},U=n("bc3a"),F=n.n(U);a["default"].component("input-string",A);var M={name:"ObjectTable",components:{Vuetable:k["a"],VuetablePagination:C["a"],VuetablePaginationInfo:E["a"],InputString:A},props:{id:String},data:function(){return{fields:[],currPage:1,perPage:10,loading:!1,selectedEntityIds:[],editedRow:[]}},computed:{apiUrl:function(){return"".concat(R.ApiUrl,"-action")},title:function(){return this.id.replace("Aurora_Modules","").replace(/_/g," ")}},mounted:function(t){},beforeDestroy:function(){},watch:{id:function(t){this.$refs.vuetable.reload(),this.$store.dispatch("setObjectsName",t)}},methods:{getObjectData:function(t,e){this.$refs.vuetable.selectedTo=[],this.selectedEntityIds=[],this.loading=!0;var n=(this.currPage-1)*this.perPage,a=this,i=F()({url:"".concat(R.ApiUrl,"-action"),method:"post",data:"action=list&ObjectName=".concat(this.id,"&offset=").concat(n,"&limit=").concat(this.perPage)});return i.then(function(t){a.loading=!1,a.setFields(t.data.result.Fields),a.$nextTick(function(){a.$refs.vuetable.normalizeFields()})}),i},setFields:function(t){var e=["__checkbox"];_.each(t,function(t,n){e.push(n)}),this.fields=e,this.fields.push("__slot:actions")},deleteRow:function(t){var e=this;t.EntityId>0&&confirm("The object with the EntityId: ".concat(t.EntityId," will be deleted"))&&F()({url:"".concat(R.ApiUrl,"-action"),method:"post",data:"action=delete&ids=".concat(t.EntityId)}).then(function(t){e.$nextTick(function(){this.$refs.vuetable.reload()})})},onCheckboxToggled:function(){this.selectedEntityIds=this.$refs.vuetable.selectedTo},onPaginationData:function(t){t["next_page_url"]="".concat(R.ApiUrl,"-action"),t["prev_page_url"]="".concat(R.ApiUrl,"-action"),t["last_page"]=Math.ceil(t["total"]/this.perPage),t["current_page"]=this.currPage,this.$refs.pagination.setPaginationData(t),this.$refs.paginationInfo.setPaginationData(t)},onChangePage:function(t){"next"===t?this.currPage++:"prev"===t?this.currPage--:this.currPage=t,this.$refs.vuetable.changePage(t)},deleteRows:function(){var t=this;this.selectedEntityIds.length>0&&confirm("The objects with the following EntityIds will be deleted: ".concat(this.selectedEntityIds.join()))&&F()({url:"".concat(R.ApiUrl,"-action"),method:"post",data:"action=delete&ids=".concat(this.selectedEntityIds.join(","))}).then(function(e){t.$nextTick(function(){this.$refs.vuetable.reload()})})},saveData:function(){var t=this,e={};_.each(this.editedRow,function(t){e[t.name]=t.value});var n=JSON.stringify(e);F()({url:"".concat(R.ApiUrl,"-action"),method:"post",data:"action=edit&manager=objects&ObjectName=".concat(this.id,"&properties=").concat(n)}).then(function(e){t.$nextTick(function(){this.editedRow=[],this.$refs.vuetable.reload(),this.$refs.modalEditor.close()})})},onRowClick:function(t){var e=[];_.each(t,function(t,n){e.push({name:n,value:t})}),this.editedRow=e,this.$refs.modalEditor.open()},onCancelEdit:function(t){this.editedRow=[],this.$refs.modalEditor.close()}}},V=M,J=(n("f00f"),Object(v["a"])(V,$,x,!1,null,null,null)),q=J.exports;a["default"].use(P["a"]);var z=new P["a"]({routes:[{path:"/list/:id/",name:"ObjectTable",components:{default:q},props:{default:!0}},{path:"/about",name:"about",component:function(){return n.e("about").then(n.bind(null,"f820"))}}]}),B=n("2f62");a["default"].use(B["a"]);var G=new B["a"].Store({state:{objectsList:null,currentObjectName:""},mutations:{setObjectsList:function(t,e){t.objectsList=e},setObjectsName:function(t,e){t.currentObjectName=e}},actions:{getObjectsList:function(t){var e=t.commit;F()({url:"".concat(R.ApiUrl,"-action"),method:"post",data:"action=types"}).then(function(t){t&&t.data&&t.data.result?e("setObjectsList",t.data.result):console.log("can't get data")}).catch(function(t){})},setObjectsName:function(t,e){var n=t.commit;n("setObjectsName",e)}}});a["default"].use(o.a),a["default"].use(r["ServerTable"]),a["default"].use(r["ClientTable"]),a["default"].use(c["a"]),a["default"].config.productionTip=!1,Object.defineProperties(a["default"].prototype,{$bus:{get:function(){return this.$root.bus}}}),new a["default"]({router:z,store:G,render:function(t){return t(O)}}).$mount("#app")},"5c0b":function(t,e,n){"use strict";var a=n("5e27"),i=n.n(a);i.a},"5e27":function(t,e,n){},6145:function(t,e,n){},f00f:function(t,e,n){"use strict";var a=n("5100"),i=n.n(a);i.a}});
//# sourceMappingURL=app.de6f55db.js.map