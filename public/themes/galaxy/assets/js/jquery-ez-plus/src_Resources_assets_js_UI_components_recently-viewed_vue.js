"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["src_Resources_assets_js_UI_components_recently-viewed_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/recently-viewed.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/recently-viewed.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: ['title', 'noDataText', 'quantity', 'addClass', 'addClassWrapper'],
  data: function data() {
    return {
      recentlyViewed: function () {
        var storedRecentlyViewed = window.localStorage.recentlyViewed;
        if (storedRecentlyViewed) {
          var slugs = JSON.parse(storedRecentlyViewed);
          var updatedSlugs = {};
          slugs = slugs.reverse();
          slugs.forEach(function (slug) {
            updatedSlugs[slug] = {};
          });
          return updatedSlugs;
        }
      }()
    };
  },
  created: function created() {
    var _this = this;
    for (var slug in this.recentlyViewed) {
      if (slug) {
        this.$http("".concat(this.baseUrl, "/product-details/").concat(slug)).then(function (response) {
          if (response.data.status) {
            _this.$set(_this.recentlyViewed, response.data.details.urlKey, response.data.details);
          } else {
            delete _this.recentlyViewed[response.data.slug];
            _this.$set(_this, 'recentlyViewed', _this.recentlyViewed);
            _this.$forceUpdate();
          }
        })["catch"](function (error) {});
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/recently-viewed.vue?vue&type=template&id=319ab85e&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/recently-viewed.vue?vue&type=template&id=319ab85e& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************/
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
    "class": _vm.addClass
  }, [_c("div", {
    staticClass: "row remove-padding-margin"
  }, [_c("div", {
    staticClass: "col-12 no-padding"
  }, [_c("h2", {
    staticClass: "fs20 fw6 mb15",
    domProps: {
      textContent: _vm._s(_vm.title)
    }
  })])]), _vm._v(" "), _c("div", {
    "class": "recently-viewed-products-wrapper ".concat(_vm.addClassWrapper)
  }, [_vm._l(_vm.recentlyViewed, function (product, index) {
    return _c("div", {
      key: Math.random(),
      staticClass: "row small-card-container"
    }, [_c("div", {
      staticClass: "col-4 product-image-container mr15"
    }, [_c("a", {
      staticClass: "unset",
      attrs: {
        href: "".concat(_vm.baseUrl, "/").concat(product.urlKey)
      }
    }, [_c("div", {
      staticClass: "product-image",
      style: "background-image: url(".concat(product.image, ")")
    })])]), _vm._v(" "), product.urlKey ? _c("div", {
      staticClass: "col-8 no-padding card-body align-vertical-top"
    }, [_c("a", {
      staticClass: "unset no-padding",
      attrs: {
        href: "".concat(_vm.baseUrl, "/").concat(product.urlKey)
      }
    }, [_c("div", {
      staticClass: "product-name"
    }, [_c("span", {
      staticClass: "fs16 text-nowrap",
      domProps: {
        textContent: _vm._s(product.name)
      }
    })]), _vm._v(" "), _c("div", {
      staticClass: "fs18 card-current-price fw6",
      domProps: {
        innerHTML: _vm._s(product.priceHTML)
      }
    }), _vm._v(" "), product.rating > 0 ? _c("star-ratings", {
      attrs: {
        "push-class": "display-inbl",
        ratings: product.rating
      }
    }) : _vm._e()], 1)]) : _vm._e()]);
  }), _vm._v(" "), !_vm.recentlyViewed || _vm.recentlyViewed && Object.keys(_vm.recentlyViewed).length == 0 ? _c("span", {
    staticClass: "fs16",
    domProps: {
      textContent: _vm._s(_vm.noDataText)
    }
  }) : _vm._e()], 2)]);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./src/Resources/assets/js/UI/components/recently-viewed.vue":
/*!*******************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/recently-viewed.vue ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _recently_viewed_vue_vue_type_template_id_319ab85e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./recently-viewed.vue?vue&type=template&id=319ab85e& */ "./src/Resources/assets/js/UI/components/recently-viewed.vue?vue&type=template&id=319ab85e&");
/* harmony import */ var _recently_viewed_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./recently-viewed.vue?vue&type=script&lang=js& */ "./src/Resources/assets/js/UI/components/recently-viewed.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _recently_viewed_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _recently_viewed_vue_vue_type_template_id_319ab85e___WEBPACK_IMPORTED_MODULE_0__.render,
  _recently_viewed_vue_vue_type_template_id_319ab85e___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/Resources/assets/js/UI/components/recently-viewed.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/recently-viewed.vue?vue&type=script&lang=js&":
/*!********************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/recently-viewed.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_recently_viewed_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./recently-viewed.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/recently-viewed.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_recently_viewed_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/recently-viewed.vue?vue&type=template&id=319ab85e&":
/*!**************************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/recently-viewed.vue?vue&type=template&id=319ab85e& ***!
  \**************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_recently_viewed_vue_vue_type_template_id_319ab85e___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_recently_viewed_vue_vue_type_template_id_319ab85e___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_recently_viewed_vue_vue_type_template_id_319ab85e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./recently-viewed.vue?vue&type=template&id=319ab85e& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/recently-viewed.vue?vue&type=template&id=319ab85e&");


/***/ })

}]);