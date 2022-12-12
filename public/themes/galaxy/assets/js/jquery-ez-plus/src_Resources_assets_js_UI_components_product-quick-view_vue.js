"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["src_Resources_assets_js_UI_components_product-quick-view_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-quick-view.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-quick-view.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      currentlyActiveImage: 0,
      showProductDetails: true,
      product: this.$root.productDetails
    };
  },
  mounted: function mounted() {
    var _this = this;
    $('.cd-quick-view').fadeIn(500);
    $('.compare-icon').click(this.closeQuickView);
    $('.wishlist-icon').click(this.closeQuickView);
    $('.add-to-cart-btn').click(function () {
      return setTimeout(_this.closeQuickView, 0);
    });
  },
  methods: {
    closeQuickView: function closeQuickView() {
      this.$root.quickView = false;
      this.$root.productDetails = [];
      $('body').toggleClass('overflow-hidden');
    },
    changeImage: function changeImage(imageIndex) {
      this.currentlyActiveImage = imageIndex;
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-quick-view.vue?vue&type=template&id=1a5513c4&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-quick-view.vue?vue&type=template&id=1a5513c4& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "modal-parent scrollable"
  }, [_c("div", {
    staticClass: "cd-quick-view"
  }, [_vm.showProductDetails || true ? [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-lg-6"
  }, [_c("ul", {
    staticClass: "cd-slider",
    attrs: {
      type: "none"
    }
  }, [_c("carousel-component", {
    attrs: {
      "slides-per-page": "1",
      "navigation-enabled": "hide",
      "slides-count": _vm.product.galleryImages.length
    }
  }, _vm._l(_vm.product.galleryImages, function (image, index) {
    return _c("slide", {
      key: index,
      attrs: {
        slot: "slide-".concat(index),
        title: " "
      },
      slot: "slide-".concat(index)
    }, [_c("li", {
      staticClass: "selected",
      on: {
        click: function click($event) {
          _vm.showProductDetails = false;
        }
      }
    }, [_c("img", {
      attrs: {
        src: image.medium_image_url,
        alt: _vm.product.name
      }
    })])]);
  }), 1)], 1)]), _vm._v(" "), _c("div", {
    staticClass: "col-lg-6 fs16"
  }, [_c("h2", {
    staticClass: "fw6 quick-view-name"
  }, [_vm._v(_vm._s(_vm.product.name))]), _vm._v(" "), _c("div", {
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
  }), _vm._v(" "), _c("a", {
    staticClass: "pl10 unset active-hover",
    attrs: {
      href: "".concat(_vm.$root.baseUrl, "/reviews/").concat(_vm.product.slug)
    }
  }, [_vm._v("\n                            " + _vm._s(_vm.__("products.reviews-count", {
    totalReviews: _vm.product.totalReviews
  })) + "\n                        ")])], 1) : _c("div", {
    staticClass: "product-rating"
  }, [_c("span", {
    staticClass: "fs14",
    domProps: {
      textContent: _vm._s(_vm.product.firstReviewText)
    }
  })]), _vm._v(" "), _c("p", {
    staticClass: "pt14 fs14 description-text",
    domProps: {
      innerHTML: _vm._s(_vm.product.shortDescription)
    }
  }), _vm._v(" "), _c("div", {
    staticClass: "product-actions"
  }, [_c("vnode-injector", {
    attrs: {
      nodes: _vm.getDynamicHTML(_vm.product.addToCartHtml)
    }
  })], 1)])]), _vm._v(" "), _c("div", {
    staticClass: "close-btn rango-close fs18 cursor-pointer",
    on: {
      click: _vm.closeQuickView
    }
  })] : 0], 2)]);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./src/Resources/assets/js/UI/components/product-quick-view.vue":
/*!**********************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/product-quick-view.vue ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _product_quick_view_vue_vue_type_template_id_1a5513c4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./product-quick-view.vue?vue&type=template&id=1a5513c4& */ "./src/Resources/assets/js/UI/components/product-quick-view.vue?vue&type=template&id=1a5513c4&");
/* harmony import */ var _product_quick_view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./product-quick-view.vue?vue&type=script&lang=js& */ "./src/Resources/assets/js/UI/components/product-quick-view.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _product_quick_view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _product_quick_view_vue_vue_type_template_id_1a5513c4___WEBPACK_IMPORTED_MODULE_0__.render,
  _product_quick_view_vue_vue_type_template_id_1a5513c4___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/Resources/assets/js/UI/components/product-quick-view.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/product-quick-view.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/product-quick-view.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_product_quick_view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./product-quick-view.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-quick-view.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_product_quick_view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/product-quick-view.vue?vue&type=template&id=1a5513c4&":
/*!*****************************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/product-quick-view.vue?vue&type=template&id=1a5513c4& ***!
  \*****************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_product_quick_view_vue_vue_type_template_id_1a5513c4___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_product_quick_view_vue_vue_type_template_id_1a5513c4___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_product_quick_view_vue_vue_type_template_id_1a5513c4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./product-quick-view.vue?vue&type=template&id=1a5513c4& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-quick-view.vue?vue&type=template&id=1a5513c4&");


/***/ })

}]);