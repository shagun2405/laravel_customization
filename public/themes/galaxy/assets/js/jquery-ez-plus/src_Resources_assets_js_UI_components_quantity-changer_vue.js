"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["src_Resources_assets_js_UI_components_quantity-changer_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/quantity-changer.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/quantity-changer.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  template: '#quantity-changer-template',
  inject: ['$validator'],
  props: {
    controlName: {
      type: String,
      "default": 'quantity'
    },
    quantity: {
      type: [Number, String],
      "default": 1
    },
    quantityText: {
      type: String,
      "default": 'Quantity'
    },
    minQuantity: {
      type: [Number, String],
      "default": 1
    },
    validations: {
      type: String,
      "default": 'required|numeric|min_value:1'
    }
  },
  data: function data() {
    return {
      qty: this.quantity
    };
  },
  mounted: function mounted() {
    this.$refs.quantityChanger.value = this.qty > this.minQuantity ? this.qty : this.minQuantity;
  },
  watch: {
    qty: function qty(val) {
      this.$refs.quantityChanger.value = !isNaN(parseFloat(val)) ? val : 0;
      this.qty = !isNaN(parseFloat(val)) ? this.qty : 0;
      this.$emit('onQtyUpdated', this.qty);
      this.$validator.validate();
    }
  },
  methods: {
    setQty: function setQty(_ref) {
      var target = _ref.target;
      this.qty = parseInt(target.value);
    },
    decreaseQty: function decreaseQty() {
      if (this.qty > this.minQuantity) this.qty = parseInt(this.qty) - 1;
    },
    increaseQty: function increaseQty() {
      this.qty = parseInt(this.qty) + 1;
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/quantity-changer.vue?vue&type=template&id=336165bb&":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/quantity-changer.vue?vue&type=template&id=336165bb& ***!
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
    "class": "quantity control-group ".concat(_vm.errors.has(_vm.controlName) ? "has-error" : "")
  }, [_c("label", {
    staticClass: "required",
    attrs: {
      "for": "quantity-changer"
    },
    domProps: {
      textContent: _vm._s(_vm.quantityText)
    }
  }), _vm._v(" "), _c("div", {
    staticClass: "input-btn-group"
  }, [_c("button", {
    staticClass: "decrease",
    attrs: {
      type: "button"
    },
    on: {
      click: function click($event) {
        return _vm.decreaseQty();
      }
    }
  }, [_c("i", {
    staticClass: "rango-minus"
  })]), _vm._v(" "), _c("input", {
    directives: [{
      name: "validate",
      rawName: "v-validate",
      value: _vm.validations,
      expression: "validations"
    }],
    ref: "quantityChanger",
    staticClass: "control",
    attrs: {
      name: _vm.controlName,
      model: _vm.qty,
      id: "quantity-changer",
      "data-vv-as": "\"".concat(_vm.quantityText, "\"")
    },
    on: {
      keyup: function keyup($event) {
        return _vm.setQty($event);
      }
    }
  }), _vm._v(" "), _c("button", {
    staticClass: "increase",
    attrs: {
      type: "button"
    },
    on: {
      click: function click($event) {
        return _vm.increaseQty();
      }
    }
  }, [_c("i", {
    staticClass: "rango-plus"
  })])]), _vm._v(" "), _vm.errors.has(_vm.controlName) ? _c("span", {
    staticClass: "control-error"
  }, [_vm._v(_vm._s(_vm.errors.first(_vm.controlName)))]) : _vm._e()]);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./src/Resources/assets/js/UI/components/quantity-changer.vue":
/*!********************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/quantity-changer.vue ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _quantity_changer_vue_vue_type_template_id_336165bb___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./quantity-changer.vue?vue&type=template&id=336165bb& */ "./src/Resources/assets/js/UI/components/quantity-changer.vue?vue&type=template&id=336165bb&");
/* harmony import */ var _quantity_changer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./quantity-changer.vue?vue&type=script&lang=js& */ "./src/Resources/assets/js/UI/components/quantity-changer.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _quantity_changer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _quantity_changer_vue_vue_type_template_id_336165bb___WEBPACK_IMPORTED_MODULE_0__.render,
  _quantity_changer_vue_vue_type_template_id_336165bb___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/Resources/assets/js/UI/components/quantity-changer.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/quantity-changer.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/quantity-changer.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_quantity_changer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./quantity-changer.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/quantity-changer.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_quantity_changer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/quantity-changer.vue?vue&type=template&id=336165bb&":
/*!***************************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/quantity-changer.vue?vue&type=template&id=336165bb& ***!
  \***************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_quantity_changer_vue_vue_type_template_id_336165bb___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_quantity_changer_vue_vue_type_template_id_336165bb___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_quantity_changer_vue_vue_type_template_id_336165bb___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./quantity-changer.vue?vue&type=template&id=336165bb& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/quantity-changer.vue?vue&type=template&id=336165bb&");


/***/ })

}]);