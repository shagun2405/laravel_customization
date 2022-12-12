"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["src_Resources_assets_js_UI_components_header-searchbar_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/header-searchbar.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/header-searchbar.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      inputVal: '',
      searchedQuery: []
    };
  },
  created: function created() {
    var searchedItem = window.location.search.replace('?', '');
    searchedItem = searchedItem.split('&');
    var updatedSearchedCollection = {};
    searchedItem.forEach(function (item) {
      var splitedItem = item.split('=');
      updatedSearchedCollection[splitedItem[0]] = decodeURI(splitedItem[1]);
    });
    if (updatedSearchedCollection['image-search'] == 1) {
      updatedSearchedCollection.term = '';
    }
    this.searchedQuery = updatedSearchedCollection;
    if (this.searchedQuery.term) {
      this.inputVal = decodeURIComponent(this.searchedQuery.term.split('+').join(' '));
    }
  },
  methods: {
    focusInput: function focusInput(event) {
      $(event.target.parentElement.parentElement).find('input').focus();
    },
    submitForm: function submitForm() {
      if (this.inputVal !== '') {
        $('input[name=term]').val(this.inputVal);
        $('#search-form').submit();
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/header-searchbar.vue?vue&type=template&id=7cde36e6&":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/header-searchbar.vue?vue&type=template&id=7cde36e6& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "btn-group full-width force-center"
  }, [_c("div", {
    staticClass: "selectdiv"
  }, [_c("select", {
    staticClass: "form-control fs13 styled-select",
    attrs: {
      name: "category",
      "aria-label": "Category"
    },
    on: {
      change: function change($event) {
        return _vm.focusInput($event);
      }
    }
  }, [_c("option", {
    attrs: {
      value: ""
    },
    domProps: {
      textContent: _vm._s(_vm.__("header.all-categories"))
    }
  }), _vm._v(" "), _vm._l(_vm.$root.sharedRootCategories, function (category, index) {
    return [category.id == _vm.searchedQuery.category ? _c("option", {
      key: index,
      attrs: {
        selected: "selected"
      },
      domProps: {
        value: category.id,
        textContent: _vm._s(category.name)
      }
    }) : _c("option", {
      key: index,
      domProps: {
        value: category.id,
        textContent: _vm._s(category.name)
      }
    })];
  })], 2), _vm._v(" "), _vm._m(0)]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model:value",
      value: _vm.inputVal,
      expression: "inputVal",
      arg: "value"
    }],
    staticClass: "form-control",
    attrs: {
      required: "",
      name: "term",
      type: "search",
      placeholder: _vm.__("header.search-text"),
      "aria-label": "Search"
    },
    domProps: {
      value: _vm.inputVal
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.inputVal = $event.target.value;
      }
    }
  }), _vm._v(" "), _vm._t("image-search"), _vm._v(" "), _c("button", {
    staticClass: "btn",
    attrs: {
      type: "button",
      id: "header-search-icon",
      "aria-label": "Search"
    },
    on: {
      click: _vm.submitForm
    }
  }, [_c("i", {
    staticClass: "fs16 fw6 rango-search"
  })])], 2);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "select-icon-container d-inline-block float-right"
  }, [_c("span", {
    staticClass: "select-icon rango-arrow-down"
  })]);
}];
render._withStripped = true;


/***/ }),

/***/ "./src/Resources/assets/js/UI/components/header-searchbar.vue":
/*!********************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/header-searchbar.vue ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _header_searchbar_vue_vue_type_template_id_7cde36e6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./header-searchbar.vue?vue&type=template&id=7cde36e6& */ "./src/Resources/assets/js/UI/components/header-searchbar.vue?vue&type=template&id=7cde36e6&");
/* harmony import */ var _header_searchbar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./header-searchbar.vue?vue&type=script&lang=js& */ "./src/Resources/assets/js/UI/components/header-searchbar.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _header_searchbar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _header_searchbar_vue_vue_type_template_id_7cde36e6___WEBPACK_IMPORTED_MODULE_0__.render,
  _header_searchbar_vue_vue_type_template_id_7cde36e6___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/Resources/assets/js/UI/components/header-searchbar.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/header-searchbar.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/header-searchbar.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_header_searchbar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./header-searchbar.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/header-searchbar.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_header_searchbar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/header-searchbar.vue?vue&type=template&id=7cde36e6&":
/*!***************************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/header-searchbar.vue?vue&type=template&id=7cde36e6& ***!
  \***************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_header_searchbar_vue_vue_type_template_id_7cde36e6___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_header_searchbar_vue_vue_type_template_id_7cde36e6___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_header_searchbar_vue_vue_type_template_id_7cde36e6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./header-searchbar.vue?vue&type=template&id=7cde36e6& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/header-searchbar.vue?vue&type=template&id=7cde36e6&");


/***/ })

}]);