"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[53],{1053:(t,s,a)=>{a.r(s),a.d(s,{default:()=>o});const e={props:["slug"],data:function(){return{hotCategoryDetails:null}},mounted:function(){this.getHotCategories()},methods:{getHotCategories:function(){var t=this;this.$http.get("".concat(this.baseUrl,"/fancy-category-details/").concat(this.slug)).then((function(s){s.data.status&&(t.hotCategoryDetails=s.data.categoryDetails)})).catch((function(t){console.log("something went wrong")}))}}};const o=(0,a(1900).Z)(e,(function(){var t=this,s=t._self._c;return t.hotCategoryDetails?s("div",{staticClass:"col-lg-3 col-md-12 hot-category-wrapper"},[s("div",{staticClass:"card"},[s("div",{staticClass:"row velocity-divide-page"},[s("div",{staticClass:"left"},[s("img",{attrs:{src:t.hotCategoryDetails.category_icon_url,alt:""}})]),t._v(" "),s("div",{staticClass:"right"},[s("h3",{staticClass:"fs20 clr-light text-uppercase"},[s("a",{staticClass:"unset",attrs:{href:"${slug}"}},[t._v("\n                        "+t._s(t.hotCategoryDetails.name)+"\n                    ")])]),t._v(" "),s("ul",{attrs:{type:"none"}},t._l(t.hotCategoryDetails.children,(function(a,e){return s("li",{key:e},[s("a",{staticClass:"remove-decoration normal-text",attrs:{href:"".concat(t.slug,"/").concat(a.slug)}},[t._v("\n                            "+t._s(a.name)+"\n                        ")])])})),0)])])])]):t._e()}),[],!1,null,null,null).exports}}]);