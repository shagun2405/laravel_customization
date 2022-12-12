"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["src_Resources_assets_js_UI_components_product-collections_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-collections.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-collections.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: {
    count: {
      type: String,
      "default": '10'
    },
    productId: {
      type: String,
      "default": ''
    },
    productTitle: String,
    productRoute: String,
    localeDirection: String,
    showRecentlyViewed: {
      type: String,
      "default": 'false'
    },
    recentlyViewedTitle: String,
    noDataText: String
  },
  data: function data() {
    return {
      list: false,
      isLoading: true,
      isCategory: false,
      productCollections: [],
      slidesPerPage: 6,
      windowWidth: window.innerWidth
    };
  },
  mounted: function mounted() {
    var _this = this;
    this.$nextTick(function () {
      window.addEventListener('resize', _this.onResize);
    });
    this.getProducts();
    this.setWindowWidth();
    this.setSlidesPerPage(this.windowWidth);
  },
  watch: {
    /* checking the window width */windowWidth: function windowWidth(newWidth, oldWidth) {
      this.setSlidesPerPage(newWidth);
    }
  },
  methods: {
    /* fetch product collections */
    getProducts: function getProducts() {
      var _this2 = this;
      this.$http.get(this.productRoute).then(function (response) {
        var count = _this2.count;
        if (response.data.status && count != 0) {
          if (response.data.categoryProducts !== undefined) {
            _this2.isCategory = true;
            _this2.categoryDetails = response.data.categoryDetails;
            _this2.productCollections = response.data.categoryProducts;
          } else {
            _this2.productCollections = response.data.products;
          }
        } else {
          _this2.productCollections = 0;
        }
        _this2.isLoading = false;
      })["catch"](function (error) {
        _this2.isLoading = false;
        console.log(_this2.__('error.something_went_wrong'));
      });
    },
    /* waiting for element */
    waitForElement: function waitForElement(selector, callback) {
      var _this3 = this;
      if (jQuery(selector).length) {
        callback();
      } else {
        setTimeout(function () {
          _this3.waitForElement(selector, callback);
        }, 100);
      }
    },
    /* setting window width */
    setWindowWidth: function setWindowWidth() {
      var _this4 = this;
      var windowClass = this.getWindowClass();
      this.waitForElement(windowClass, function () {
        _this4.windowWidth = $(windowClass).width();
      });
    },
    /* get window class */
    getWindowClass: function getWindowClass() {
      return this.showRecentlyViewed === 'true' ? '.with-recent-viewed' : '.without-recent-viewed';
    },
    /* on resize set window width */
    onResize: function onResize() {
      this.windowWidth = $(this.getWindowClass()).width();
    },
    /* setting slides on the basis of window width */
    setSlidesPerPage: function setSlidesPerPage(width) {
      if (width >= 1200) {
        this.slidesPerPage = 6;
      } else if (width < 1200 && width >= 992) {
        this.slidesPerPage = 5;
      } else if (width < 992 && width >= 822) {
        this.slidesPerPage = 4;
      } else if (width < 822 && width >= 626) {
        this.slidesPerPage = 3;
      } else {
        this.slidesPerPage = 2;
      }
    }
  },
  /* removing event */
  beforeDestroy: function beforeDestroy() {
    window.removeEventListener('resize', this.onResize);
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-collections.vue?vue&type=template&id=2a55ca4c&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-collections.vue?vue&type=template&id=2a55ca4c& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "container-fluid"
  }, [_vm.isLoading ? _c("shimmer-component") : _vm.productCollections.length > 0 ? [_c("card-list-header", {
    attrs: {
      heading: _vm.isCategory ? _vm.categoryDetails.name : _vm.productTitle,
      "view-all": _vm.isCategory ? "".concat(this.baseUrl, "/").concat(_vm.categoryDetails.url_path) : ""
    }
  }), _vm._v(" "), _c("div", {
    staticClass: "row",
    "class": _vm.localeDirection
  }, [_c("div", {
    staticClass: "col-md-12 no-padding carousel-products",
    "class": _vm.showRecentlyViewed === "true" ? "with-recent-viewed col-lg-9" : "without-recent-viewed col-lg-12"
  }, [_vm.count != 0 ? _c("carousel-component", {
    attrs: {
      "slides-per-page": _vm.slidesPerPage,
      "pagination-enabled": "hide",
      id: _vm.isCategory ? "".concat(_vm.categoryDetails.name, "-carousel") : _vm.productId,
      "locale-direction": _vm.localeDirection,
      "slides-count": _vm.productCollections.length
    }
  }, _vm._l(_vm.productCollections, function (product, index) {
    return _c("slide", {
      key: index,
      attrs: {
        slot: "slide-".concat(index)
      },
      slot: "slide-".concat(index)
    }, [_c("product-card", {
      attrs: {
        list: _vm.list,
        product: product
      }
    })], 1);
  }), 1) : _vm._e()], 1), _vm._v(" "), _vm.showRecentlyViewed === "true" ? _c("recently-viewed", {
    attrs: {
      title: _vm.recentlyViewedTitle,
      "no-data-text": _vm.noDataText,
      "add-class": "col-lg-3 col-md-12 ".concat(_vm.localeDirection),
      quantity: "3",
      "add-class-wrapper": ""
    }
  }) : _vm._e()], 1)] : _vm._e()], 2);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./src/Resources/assets/js/UI/components/product-collections.vue":
/*!***********************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/product-collections.vue ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _product_collections_vue_vue_type_template_id_2a55ca4c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./product-collections.vue?vue&type=template&id=2a55ca4c& */ "./src/Resources/assets/js/UI/components/product-collections.vue?vue&type=template&id=2a55ca4c&");
/* harmony import */ var _product_collections_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./product-collections.vue?vue&type=script&lang=js& */ "./src/Resources/assets/js/UI/components/product-collections.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _product_collections_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _product_collections_vue_vue_type_template_id_2a55ca4c___WEBPACK_IMPORTED_MODULE_0__.render,
  _product_collections_vue_vue_type_template_id_2a55ca4c___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/Resources/assets/js/UI/components/product-collections.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/product-collections.vue?vue&type=script&lang=js&":
/*!************************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/product-collections.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_product_collections_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./product-collections.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-collections.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_product_collections_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/product-collections.vue?vue&type=template&id=2a55ca4c&":
/*!******************************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/product-collections.vue?vue&type=template&id=2a55ca4c& ***!
  \******************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_product_collections_vue_vue_type_template_id_2a55ca4c___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_product_collections_vue_vue_type_template_id_2a55ca4c___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_product_collections_vue_vue_type_template_id_2a55ca4c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./product-collections.vue?vue&type=template&id=2a55ca4c& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/product-collections.vue?vue&type=template&id=2a55ca4c&");


/***/ })

}]);