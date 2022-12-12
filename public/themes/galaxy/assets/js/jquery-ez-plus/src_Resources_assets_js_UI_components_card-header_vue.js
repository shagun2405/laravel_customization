"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["src_Resources_assets_js_UI_components_card-header_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/card-header.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/card-header.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: ['showTabs', 'rowClass', 'heading', 'viewAll', 'scrollable'],
  data: function data() {
    var tabs = null;
    if (this.showTabs) {
      tabs = ['Fashion', 'Accessories', 'Electronis', 'Electronis1', 'Electronis2'];
    }
    return {
      tabs: tabs,
      headerHeading: this.heading ? this.heading : this.__('products.text')
    };
  },
  methods: {
    'switchTab': function switchTab(_ref) {
      var target = _ref.target;
      var clickedTab = target.closest('h2.tab');
      if (clickedTab) {
        var tabsCollection = this.$el.querySelectorAll('.tab');
        Array.from(tabsCollection).forEach(function (tab) {
          tab.classList.remove('active');
        });
        clickedTab.classList.add('active');
      }
    },
    navigation: function navigation(navigateTo) {
      var navigation = $("#".concat(this.scrollable, " .VueCarousel-navigation .VueCarousel-navigation-").concat(navigateTo));
      if (navigation && (navigation = navigation[0])) {
        navigation.click();
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/card-header.vue?vue&type=template&id=6a4f6fff&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/card-header.vue?vue&type=template&id=6a4f6fff& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************/
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
    "class": "row mb15 col-12 carousel-products-header ".concat(_vm.rowClass)
  }, [_vm.tabs || _vm.viewAll || _vm.scrollable ? _c("div", {
    staticClass: "col-4 no-padding"
  }, [_c("h2", {
    staticClass: "fs20 fw6"
  }, [_vm._v(_vm._s(_vm.headerHeading))])]) : _c("div", {
    staticClass: "col-12 no-padding"
  }, [_c("h2", {
    staticClass: "fs20 fw6"
  }, [_vm._v(_vm._s(_vm.headerHeading))])]), _vm._v(" "), _c("div", {
    staticClass: "col-8 no-padding"
  }, [_c("div", {
    staticClass: "row justify-content-end text-right"
  }, [_vm.tabs ? _vm._l(_vm.tabs.slice(0, 3), function (tab, index) {
    return _c("div", {
      key: index,
      staticClass: "col-lg-2 no-padding",
      attrs: {
        title: tab
      },
      on: {
        click: _vm.switchTab
      }
    }, [_c("h2", {
      staticClass: "fs16 fw6 cursor-pointer tab",
      "class": index == 0 ? "active" : ""
    }, [_vm._v(_vm._s(tab))])]);
  }) : _vm._e(), _vm._v(" "), _vm.scrollable && !(_vm.scrollable == "") ? [_c("div", {
    staticClass: "col-lg-2 no-padding switch-buttons"
  }, [_c("div", {
    staticClass: "row justify-content-center"
  }, [_c("h2", {
    staticClass: "col-lg-1 no-padding v-mr-20 fw6 cursor-pointer",
    attrs: {
      title: "previous"
    },
    domProps: {
      innerHTML: _vm._s("<")
    },
    on: {
      click: function click($event) {
        return _vm.navigation("prev");
      }
    }
  }), _vm._v(" "), _c("h2", {
    staticClass: "col-lg-1 no-padding fw6 cursor-pointer",
    attrs: {
      title: "next"
    },
    on: {
      click: function click($event) {
        return _vm.navigation("next");
      }
    }
  }, [_vm._v(">")])])])] : _vm._e(), _vm._v(" "), !(_vm.viewAll == "false" || _vm.viewAll == "") && _vm.viewAll ? [_c("div", [_c("a", {
    staticClass: "remove-decoration link-color",
    attrs: {
      href: _vm.viewAll,
      title: "View all ".concat(_vm.headerHeading, " products")
    }
  }, [_c("h2", {
    staticClass: "fs16 fw6 cursor-pointer tab"
  }, [_vm._v(_vm._s(_vm.__("home.view-all")))])])])] : _vm._e()], 2)])]);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./src/Resources/assets/js/UI/components/card-header.vue":
/*!***************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/card-header.vue ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _card_header_vue_vue_type_template_id_6a4f6fff___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./card-header.vue?vue&type=template&id=6a4f6fff& */ "./src/Resources/assets/js/UI/components/card-header.vue?vue&type=template&id=6a4f6fff&");
/* harmony import */ var _card_header_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./card-header.vue?vue&type=script&lang=js& */ "./src/Resources/assets/js/UI/components/card-header.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _card_header_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _card_header_vue_vue_type_template_id_6a4f6fff___WEBPACK_IMPORTED_MODULE_0__.render,
  _card_header_vue_vue_type_template_id_6a4f6fff___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/Resources/assets/js/UI/components/card-header.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/card-header.vue?vue&type=script&lang=js&":
/*!****************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/card-header.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_card_header_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./card-header.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/card-header.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_card_header_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/card-header.vue?vue&type=template&id=6a4f6fff&":
/*!**********************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/card-header.vue?vue&type=template&id=6a4f6fff& ***!
  \**********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_card_header_vue_vue_type_template_id_6a4f6fff___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_card_header_vue_vue_type_template_id_6a4f6fff___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_card_header_vue_vue_type_template_id_6a4f6fff___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./card-header.vue?vue&type=template&id=6a4f6fff& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/card-header.vue?vue&type=template&id=6a4f6fff&");


/***/ })

}]);