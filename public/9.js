(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{206:function(t,e,n){"use strict";var a=n(49);n.n(a).a},207:function(t,e,n){(t.exports=n(5)(!1)).push([t.i,".children[data-v-476bc4da]{margin-left:100px}",""])},208:function(t,e,n){"use strict";var a=n(50);n.n(a).a},209:function(t,e,n){(t.exports=n(5)(!1)).push([t.i,".row[data-v-58782cdc]{margin-left:200px}.children[data-v-58782cdc]{margin-left:40px}",""])},255:function(t,e,n){"use strict";n.r(e);var a={name:"item-tree",props:{nodes:{},indent:{type:Number,default:0}}},r=(n(206),n(0)),i={name:"Tree",components:{ItemTree:Object(r.a)(a,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",t._l(t.nodes,(function(e){return n("div",{staticClass:"item-tree"},[n("h4",[t._v(t._s(e.name))]),t._v(" "),n("div",{staticClass:"children"},[n("item-tree",{attrs:{nodes:e.children}})],1)])})),0)}),[],!1,null,"476bc4da",null).exports},data:function(){return{treeData2:[]}},methods:{loadTreeData:function(){var t=this;axios({method:"get",url:"/api/tree"}).then((function(e){t.treeData2=e.data.tree})).catch((function(t){console.log(t)}))}},mounted:function(){this.loadTreeData()}},s=(n(208),Object(r.a)(i,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"tree"},[e("div",{staticClass:"container"},[e("div",{staticClass:"row"},[e("item-tree",{attrs:{nodes:this.treeData2}})],1)])])}),[],!1,null,"58782cdc",null));e.default=s.exports},49:function(t,e,n){var a=n(207);"string"==typeof a&&(a=[[t.i,a,""]]);var r={hmr:!0,transform:void 0,insertInto:void 0};n(6)(a,r);a.locals&&(t.exports=a.locals)},50:function(t,e,n){var a=n(209);"string"==typeof a&&(a=[[t.i,a,""]]);var r={hmr:!0,transform:void 0,insertInto:void 0};n(6)(a,r);a.locals&&(t.exports=a.locals)}}]);