"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[361],{3361:(t,e,s)=>{s.r(e),s.d(e,{default:()=>a});const o={props:["isCustomer","isText","src"],data:function(){return{compareCount:0}},watch:{"$root.headerItemsCount":function(){this.updateHeaderItemsCount()}},created:function(){this.updateHeaderItemsCount()},methods:{updateHeaderItemsCount:function(){var t=this;if("true"!==this.isCustomer){var e=this.getStorageValue("compared_product");e&&(this.compareCount=e.length)}else this.$http.get("".concat(this.$root.baseUrl,"/items-count")).then((function(e){t.compareCount=e.data.compareProductsCount})).catch((function(e){console.log(t.__("error.something_went_wrong"))}))}}};const a=(0,s(1900).Z)(o,(function(){var t=this,e=t._self._c;return e("a",{staticClass:"compare-btn unset",attrs:{href:t.src}},[e("i",{staticClass:"material-icons"},[t._v("compare_arrows")]),t._v(" "),t.compareCount>0?e("div",{staticClass:"badge-container"},[e("span",{staticClass:"badge",domProps:{textContent:t._s(t.compareCount)}})]):t._e(),t._v(" "),"true"==t.isText?e("span",{domProps:{textContent:t._s(t.__("customer.compare.text"))}}):t._e()])}),[],!1,null,null,null).exports}}]);