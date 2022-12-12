"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["src_Resources_assets_js_UI_components_sidebar_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/sidebar.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/sidebar.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: ['id', 'addClass', 'parentSlug', 'mainSidebar', 'categoryCount'],
  data: function data() {
    return {
      slicedCategories: [],
      sidebarLevel: Math.floor(Math.random() * 1000)
    };
  },
  watch: {
    '$root.sharedRootCategories': function $rootSharedRootCategories(categories) {
      this.formatCategories(categories);
    }
  },
  methods: {
    remainBar: function remainBar(id) {
      var sidebar = $("#".concat(id));
      if (sidebar && sidebar.length > 0) {
        sidebar.show();
        var actualId = id.replace('sidebar-level-', '');
        var sidebarContainer = sidebar.closest(".sub-category-".concat(actualId));
        if (sidebarContainer && sidebarContainer.length > 0) {
          sidebarContainer.show();
        }
      }
    },
    formatCategories: function formatCategories(categories) {
      var slicedCategories = categories;
      var categoryCount = this.categoryCount ? this.categoryCount : 9;
      if (slicedCategories && slicedCategories.length > categoryCount) {
        slicedCategories = categories.slice(0, categoryCount);
      }
      if (this.parentSlug) {
        slicedCategories['parentSlug'] = this.parentSlug;
      }
      this.slicedCategories = slicedCategories;
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/sidebar.vue?vue&type=template&id=5097f8f1&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/sidebar.vue?vue&type=template&id=5097f8f1& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _vm.slicedCategories && _vm.slicedCategories.length > 0 ? _c("nav", {
    "class": "sidebar ".concat(_vm.addClass ? _vm.addClass : ""),
    attrs: {
      id: _vm.id
    },
    on: {
      mouseover: function mouseover($event) {
        return _vm.remainBar(_vm.id);
      }
    }
  }, [_c("ul", {
    staticStyle: {
      "margin-bottom": "0"
    },
    attrs: {
      type: "none"
    }
  }, _vm._l(_vm.slicedCategories, function (category, categoryIndex) {
    return _c("li", {
      key: categoryIndex,
      staticClass: "category-content cursor-pointer",
      attrs: {
        id: "category-".concat(category.id)
      },
      on: {
        mouseout: function mouseout($event) {
          return _vm.toggleSidebar(_vm.id, $event, "mouseout");
        },
        mouseover: function mouseover($event) {
          return _vm.toggleSidebar(_vm.id, $event, "mouseover");
        }
      }
    }, [_c("a", {
      "class": "category unset ".concat(category.children.length > 0 ? "fw6" : ""),
      attrs: {
        href: "".concat(_vm.$root.baseUrl, "/").concat(category.slug)
      }
    }, [_c("div", {
      staticClass: "category-icon",
      on: {
        mouseout: function mouseout($event) {
          return _vm.toggleSidebar(_vm.id, $event, "mouseout");
        },
        mouseover: function mouseover($event) {
          return _vm.toggleSidebar(_vm.id, $event, "mouseover");
        }
      }
    }, [category.category_icon_url ? _c("img", {
      attrs: {
        src: category.category_icon_url,
        width: "20",
        height: "20"
      }
    }) : _vm._e()]), _vm._v(" "), _c("span", {
      staticClass: "category-title"
    }, [_vm._v(_vm._s(category["name"]))]), _vm._v(" "), category.children.length && category.children.length > 0 ? _c("i", {
      staticClass: "rango-arrow-right pr15 float-right",
      on: {
        mouseout: function mouseout($event) {
          return _vm.toggleSidebar(_vm.id, $event, "mouseout");
        },
        mouseover: function mouseover($event) {
          return _vm.toggleSidebar(_vm.id, $event, "mouseover");
        }
      }
    }) : _vm._e()]), _vm._v(" "), category.children.length && category.children.length > 0 ? _c("div", {
      staticClass: "sub-category-container"
    }, [_c("div", {
      "class": "sub-categories sub-category-".concat(_vm.sidebarLevel + categoryIndex, " cursor-default"),
      on: {
        mouseout: function mouseout($event) {
          return _vm.toggleSidebar(_vm.id, $event, "mouseout");
        },
        mouseover: function mouseover($event) {
          return _vm.remainBar("sidebar-level-".concat(_vm.sidebarLevel + categoryIndex));
        }
      }
    }, [_c("nav", {
      staticClass: "sidebar",
      attrs: {
        id: "sidebar-level-".concat(_vm.sidebarLevel + categoryIndex)
      },
      on: {
        mouseover: function mouseover($event) {
          return _vm.remainBar("sidebar-level-".concat(_vm.sidebarLevel + categoryIndex));
        }
      }
    }, [_c("ul", {
      attrs: {
        type: "none"
      }
    }, _vm._l(category.children, function (subCategory, subCategoryIndex) {
      return _c("li", {
        key: "".concat(subCategoryIndex, "-").concat(categoryIndex)
      }, [_c("a", {
        "class": "category sub-category unset ".concat(subCategory.children.length > 0 ? "fw6" : ""),
        attrs: {
          id: "sidebar-level-link-2-".concat(subCategoryIndex),
          href: "".concat(_vm.$root.baseUrl, "/").concat(category.slug, "/").concat(subCategory.slug)
        },
        on: {
          mouseout: function mouseout($event) {
            return _vm.toggleSidebar(_vm.id, $event, "mouseout");
          }
        }
      }, [_c("div", {
        staticClass: "category-icon",
        on: {
          mouseout: function mouseout($event) {
            return _vm.toggleSidebar(_vm.id, $event, "mouseout");
          },
          mouseover: function mouseover($event) {
            return _vm.toggleSidebar(_vm.id, $event, "mouseover");
          }
        }
      }, [subCategory.category_icon_url ? _c("img", {
        attrs: {
          src: subCategory.category_icon_url
        }
      }) : _vm._e()]), _vm._v(" "), _c("span", {
        staticClass: "category-title"
      }, [_vm._v(_vm._s(subCategory["name"]))]), _vm._v(" "), subCategory.children.length > 0 ? _c("i", {
        staticClass: "rango-arrow-down pr15 float-right",
        on: {
          mouseout: function mouseout($event) {
            return _vm.toggleSidebar(_vm.id, $event, "mouseout");
          },
          mouseover: function mouseover($event) {
            return _vm.toggleSidebar(_vm.id, $event, "mouseover");
          }
        }
      }) : _vm._e()]), _vm._v(" "), _c("ul", {
        staticClass: "nested",
        attrs: {
          type: "none"
        }
      }, _vm._l(subCategory.children, function (childSubCategory, childSubCategoryIndex) {
        return _c("li", {
          key: "".concat(childSubCategoryIndex, "-").concat(subCategoryIndex, "-").concat(categoryIndex)
        }, [_c("a", {
          "class": "category unset ".concat(subCategory.children.length > 0 ? "fw6" : ""),
          attrs: {
            id: "sidebar-level-link-3-".concat(childSubCategoryIndex),
            href: "".concat(_vm.$root.baseUrl, "/").concat(category.slug, "/").concat(subCategory.slug, "/").concat(childSubCategory.slug)
          }
        }, [_c("span", {
          staticClass: "category-title"
        }, [_vm._v(_vm._s(childSubCategory.name))])])]);
      }), 0)]);
    }), 0)])])]) : _vm._e()]);
  }), 0)]) : _vm._e();
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./src/Resources/assets/js/UI/components/sidebar.vue":
/*!***********************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/sidebar.vue ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _sidebar_vue_vue_type_template_id_5097f8f1___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./sidebar.vue?vue&type=template&id=5097f8f1& */ "./src/Resources/assets/js/UI/components/sidebar.vue?vue&type=template&id=5097f8f1&");
/* harmony import */ var _sidebar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./sidebar.vue?vue&type=script&lang=js& */ "./src/Resources/assets/js/UI/components/sidebar.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _sidebar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _sidebar_vue_vue_type_template_id_5097f8f1___WEBPACK_IMPORTED_MODULE_0__.render,
  _sidebar_vue_vue_type_template_id_5097f8f1___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/Resources/assets/js/UI/components/sidebar.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/sidebar.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/sidebar.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_sidebar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./sidebar.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/sidebar.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_sidebar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/sidebar.vue?vue&type=template&id=5097f8f1&":
/*!******************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/sidebar.vue?vue&type=template&id=5097f8f1& ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_sidebar_vue_vue_type_template_id_5097f8f1___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_sidebar_vue_vue_type_template_id_5097f8f1___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_sidebar_vue_vue_type_template_id_5097f8f1___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./sidebar.vue?vue&type=template&id=5097f8f1& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/sidebar.vue?vue&type=template&id=5097f8f1&");


/***/ })

}]);