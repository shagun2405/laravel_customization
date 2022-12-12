"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["src_Resources_assets_js_UI_components_product-card_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-card.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-card.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: ['list', 'product'],
  data: function data() {
    return {
      'addToCart': 0,
      'addToCartHtml': ''
    };
  },
  methods: {
    'isMobile': function isMobile() {
      if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        return true;
      } else {
        return false;
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-card.vue?vue&type=template&id=3d78742e&":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-card.vue?vue&type=template&id=3d78742e& ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _vm.list ? _c("div", {
    staticClass: "col-12 lg-card-container list-card product-card row"
  }, [_c("div", {
    staticClass: "product-image"
  }, [_c("a", {
    attrs: {
      title: _vm.product.name,
      href: "".concat(_vm.baseUrl, "/").concat(_vm.product.slug)
    }
  }, [_c("img", {
    attrs: {
      src: _vm.product.image || _vm.product.product_image,
      onerror: "this.src='".concat(this.$root.baseUrl, "/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'")
    }
  }), _vm._v(" "), !_vm.isMobile() ? _c("product-quick-view-btn", {
    attrs: {
      "quick-view-details": _vm.product
    }
  }) : _vm._e()], 1)]), _vm._v(" "), _c("div", {
    staticClass: "product-information"
  }, [_c("div", [_c("div", {
    staticClass: "product-name"
  }, [_c("a", {
    staticClass: "unset",
    attrs: {
      href: "".concat(_vm.baseUrl, "/").concat(_vm.product.slug),
      title: _vm.product.name
    }
  }, [_c("span", {
    staticClass: "fs16"
  }, [_vm._v(_vm._s(_vm.product.name))])])]), _vm._v(" "), _vm.product["new"] ? _c("div", {
    staticClass: "sticker new"
  }, [_vm._v("\n                " + _vm._s(_vm.product["new"]) + "\n            ")]) : _vm._e(), _vm._v(" "), _c("div", {
    staticClass: "product-price",
    domProps: {
      innerHTML: _vm._s(_vm.product.priceHTML)
    }
  }), _vm._v(" "), _vm.product.totalReviews && _vm.product.totalReviews > 0 ? _c("div", {
    staticClass: "product-rating"
  }, [_c("star-ratings", {
    attrs: {
      ratings: _vm.product.avgRating
    }
  }), _vm._v(" "), _c("span", [_vm._v(_vm._s(_vm.__("products.reviews-count", {
    totalReviews: _vm.product.totalReviews
  })))])], 1) : _c("div", {
    staticClass: "product-rating"
  }, [_c("span", {
    staticClass: "fs14",
    domProps: {
      textContent: _vm._s(_vm.product.firstReviewText)
    }
  })]), _vm._v(" "), _c("vnode-injector", {
    attrs: {
      nodes: _vm.getDynamicHTML(_vm.product.addToCartHtml)
    }
  })], 1)])]) : _c("div", {
    staticClass: "card grid-card product-card-new"
  }, [_c("a", {
    staticClass: "product-image-container",
    attrs: {
      href: "".concat(_vm.baseUrl, "/").concat(_vm.product.slug),
      title: _vm.product.name
    }
  }, [_c("img", {
    staticClass: "card-img-top lzy_img",
    attrs: {
      loading: "lazy",
      alt: _vm.product.name,
      src: _vm.product.image || _vm.product.product_image,
      "data-src": _vm.product.image || _vm.product.product_image,
      onerror: "this.src='".concat(this.$root.baseUrl, "/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'")
    }
  }), _vm._v(" "), _c("product-quick-view-btn", {
    attrs: {
      "quick-view-details": _vm.product
    }
  })], 1), _vm._v(" "), _c("div", {
    staticClass: "card-body"
  }, [_c("div", {
    staticClass: "product-name col-12 no-padding"
  }, [_c("a", {
    staticClass: "unset",
    attrs: {
      title: _vm.product.name,
      href: "".concat(_vm.baseUrl, "/").concat(_vm.product.slug)
    }
  }, [_c("span", {
    staticClass: "fs16"
  }, [_vm._v(_vm._s(_vm.product.name))])])]), _vm._v(" "), _vm.product["new"] ? _c("div", {
    staticClass: "sticker new"
  }, [_vm._v("\n            " + _vm._s(_vm.product["new"]) + "\n        ")]) : _vm._e(), _vm._v(" "), _c("div", {
    domProps: {
      innerHTML: _vm._s(_vm.product.priceHTML)
    }
  }), _vm._v(" "), _vm.product.totalReviews && _vm.product.totalReviews > 0 ? _c("div", {
    staticClass: "product-rating col-12 no-padding"
  }, [_c("star-ratings", {
    attrs: {
      ratings: _vm.product.avgRating
    }
  }), _vm._v(" "), _c("a", {
    staticClass: "fs14 align-top unset active-hover",
    attrs: {
      href: "".concat(_vm.$root.baseUrl, "/reviews/").concat(_vm.product.slug)
    }
  }, [_vm._v("\n                " + _vm._s(_vm.__("products.reviews-count", {
    totalReviews: _vm.product.totalReviews
  })) + "\n            ")])], 1) : _c("div", {
    staticClass: "product-rating col-12 no-padding"
  }, [_c("span", {
    staticClass: "fs14",
    domProps: {
      textContent: _vm._s(_vm.product.firstReviewText)
    }
  })]), _vm._v(" "), _c("vnode-injector", {
    attrs: {
      nodes: _vm.getDynamicHTML(_vm.product.addToCartHtml)
    }
  })], 1)]);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./src/Resources/assets/js/UI/components/product-card.vue":
/*!****************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/product-card.vue ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _product_card_vue_vue_type_template_id_3d78742e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./product-card.vue?vue&type=template&id=3d78742e& */ "./src/Resources/assets/js/UI/components/product-card.vue?vue&type=template&id=3d78742e&");
/* harmony import */ var _product_card_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./product-card.vue?vue&type=script&lang=js& */ "./src/Resources/assets/js/UI/components/product-card.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _product_card_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _product_card_vue_vue_type_template_id_3d78742e___WEBPACK_IMPORTED_MODULE_0__.render,
  _product_card_vue_vue_type_template_id_3d78742e___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/Resources/assets/js/UI/components/product-card.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/product-card.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/product-card.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_product_card_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./product-card.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-card.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_product_card_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/product-card.vue?vue&type=template&id=3d78742e&":
/*!***********************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/product-card.vue?vue&type=template&id=3d78742e& ***!
  \***********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_product_card_vue_vue_type_template_id_3d78742e___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_product_card_vue_vue_type_template_id_3d78742e___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_product_card_vue_vue_type_template_id_3d78742e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./product-card.vue?vue&type=template&id=3d78742e& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-card.vue?vue&type=template&id=3d78742e&");


/***/ })

}]);