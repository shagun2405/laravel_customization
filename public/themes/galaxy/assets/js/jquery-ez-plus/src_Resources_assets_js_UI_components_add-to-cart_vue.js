"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["src_Resources_assets_js_UI_components_add-to-cart_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/add-to-cart.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/add-to-cart.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: ['form', 'btnText', 'isEnable', 'csrfToken', 'productId', 'reloadPage', 'moveToCart', 'wishlistMoveRoute', 'showCartIcon', 'addClassToBtn', 'productFlatId'],
  data: function data() {
    return {
      'isButtonEnable': this.isEnable,
      'qtyText': this.__('checkout.qty')
    };
  },
  methods: {
    'addToCart': function addToCart() {
      var _this = this;
      this.isButtonEnable = false;
      var url = "".concat(this.$root.baseUrl, "/cart/add");
      this.$http.post(url, {
        'quantity': 1,
        'product_id': this.productId,
        '_token': this.csrfToken.split("&#039;").join("")
      }).then(function (response) {
        _this.isButtonEnable = true;
        if (response.data.status == 'success') {
          _this.$root.miniCartKey++;
          window.showAlert("alert-success", _this.__('shop.general.alert.success'), response.data.message);
          if (_this.reloadPage == "1") {
            window.location.reload();
          }
        } else {
          if (response.data.redirectionRoute) {
            window.location.href = response.data.redirectionRoute;
          }
        }
      })["catch"](function (error) {
        console.log(_this.__('error.something_went_wrong'));
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/add-to-cart.vue?vue&type=template&id=7baf501b&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/add-to-cart.vue?vue&type=template&id=7baf501b& ***!
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
  return _c("form", {
    attrs: {
      method: "POST"
    },
    on: {
      submit: function submit($event) {
        $event.preventDefault();
        return _vm.addToCart.apply(null, arguments);
      }
    }
  }, [_vm.moveToCart ? _c("a", {
    "class": "btn btn-add-to-cart ".concat(_vm.addClassToBtn),
    attrs: {
      href: _vm.wishlistMoveRoute,
      disabled: _vm.isButtonEnable == "false" || _vm.isButtonEnable == false
    }
  }, [_vm.showCartIcon ? _c("i", {
    staticClass: "material-icons text-down-3"
  }, [_vm._v("shopping_cart")]) : _vm._e(), _vm._v(" "), _c("span", {
    staticClass: "fs14 fw6 text-uppercase text-up-4",
    domProps: {
      textContent: _vm._s(_vm.btnText)
    }
  })]) : _c("button", {
    "class": "btn btn-add-to-cart ".concat(_vm.addClassToBtn),
    attrs: {
      type: "submit",
      disabled: _vm.isButtonEnable == "false" || _vm.isButtonEnable == false
    }
  }, [_vm.showCartIcon ? _c("i", {
    staticClass: "material-icons text-down-3"
  }, [_vm._v("shopping_cart")]) : _vm._e(), _vm._v(" "), _c("span", {
    staticClass: "fs14 fw6 text-uppercase text-up-4",
    domProps: {
      textContent: _vm._s(_vm.btnText)
    }
  })])]);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./src/Resources/assets/js/UI/components/add-to-cart.vue":
/*!***************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/add-to-cart.vue ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _add_to_cart_vue_vue_type_template_id_7baf501b___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./add-to-cart.vue?vue&type=template&id=7baf501b& */ "./src/Resources/assets/js/UI/components/add-to-cart.vue?vue&type=template&id=7baf501b&");
/* harmony import */ var _add_to_cart_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./add-to-cart.vue?vue&type=script&lang=js& */ "./src/Resources/assets/js/UI/components/add-to-cart.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _add_to_cart_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _add_to_cart_vue_vue_type_template_id_7baf501b___WEBPACK_IMPORTED_MODULE_0__.render,
  _add_to_cart_vue_vue_type_template_id_7baf501b___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/Resources/assets/js/UI/components/add-to-cart.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/add-to-cart.vue?vue&type=script&lang=js&":
/*!****************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/add-to-cart.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_add_to_cart_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./add-to-cart.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/add-to-cart.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_add_to_cart_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/add-to-cart.vue?vue&type=template&id=7baf501b&":
/*!**********************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/add-to-cart.vue?vue&type=template&id=7baf501b& ***!
  \**********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_add_to_cart_vue_vue_type_template_id_7baf501b___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_add_to_cart_vue_vue_type_template_id_7baf501b___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_add_to_cart_vue_vue_type_template_id_7baf501b___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./add-to-cart.vue?vue&type=template&id=7baf501b& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/add-to-cart.vue?vue&type=template&id=7baf501b&");


/***/ })

}]);