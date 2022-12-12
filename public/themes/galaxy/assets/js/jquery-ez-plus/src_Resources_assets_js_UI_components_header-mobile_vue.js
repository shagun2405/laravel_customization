"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["src_Resources_assets_js_UI_components_header-mobile_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/header-mobile.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/header-mobile.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: ['isCustomer', 'heading', 'headerContent', 'categoryCount', 'cartItemsCount', 'cartRoute', 'locale', 'allLocales', 'currency', 'allCurrencies'],
  data: function data() {
    return {
      compareCount: 0,
      wishlistCount: 0,
      languages: false,
      hamburger: false,
      currencies: false,
      subCategory: null,
      isSearchbar: false,
      rootCategories: true,
      rootCategoriesCollection: this.$root.sharedRootCategories,
      updatedCartItemsCount: this.cartItemsCount
    };
  },
  watch: {
    hamburger: function hamburger(value) {
      if (value) {
        document.body.classList.add('open-hamburger');
      } else {
        document.body.classList.remove('open-hamburger');
      }
    },
    '$root.headerItemsCount': function $rootHeaderItemsCount() {
      this.updateHeaderItemsCount();
    },
    '$root.miniCartKey': function $rootMiniCartKey() {
      this.getMiniCartDetails();
    },
    '$root.sharedRootCategories': function $rootSharedRootCategories(categories) {
      this.formatCategories(categories);
    }
  },
  created: function created() {
    this.getMiniCartDetails();
    this.updateHeaderItemsCount();
  },
  methods: {
    openSearchBar: function openSearchBar() {
      this.isSearchbar = !this.isSearchbar;
      var footer = $('.footer');
      var homeContent = $('#home-right-bar-container');
      if (this.isSearchbar) {
        footer[0].style.opacity = '.3';
        homeContent[0].style.opacity = '.3';
      } else {
        footer[0].style.opacity = '1';
        homeContent[0].style.opacity = '1';
      }
    },
    toggleHamburger: function toggleHamburger() {
      this.hamburger = !this.hamburger;
    },
    closeDrawer: function closeDrawer() {
      $('.nav-container').hide();
      this.toggleHamburger();
      this.rootCategories = true;
    },
    toggleSubcategories: function toggleSubcategories(index, event) {
      if (index == 'root') {
        this.rootCategories = true;
        this.subCategory = false;
      } else {
        event.preventDefault();
        var categories = this.$root.sharedRootCategories;
        this.rootCategories = false;
        this.subCategory = categories[index];
      }
    },
    toggleMetaInfo: function toggleMetaInfo(metaKey) {
      this.rootCategories = !this.rootCategories;
      this[metaKey] = !this[metaKey];
    },
    updateHeaderItemsCount: function updateHeaderItemsCount() {
      var _this = this;
      if (this.isCustomer != 'true') {
        var comparedItems = this.getStorageValue('compared_product');
        if (comparedItems) {
          this.compareCount = comparedItems.length;
        }
      } else {
        this.$http.get("".concat(this.$root.baseUrl, "/items-count")).then(function (response) {
          _this.compareCount = response.data.compareProductsCount;
          _this.wishlistCount = response.data.wishlistedProductsCount;
        })["catch"](function (exception) {
          console.log(_this.__('error.something_went_wrong'));
        });
      }
    },
    getMiniCartDetails: function getMiniCartDetails() {
      var _this2 = this;
      this.$http.get("".concat(this.$root.baseUrl, "/mini-cart")).then(function (response) {
        if (response.data.status) {
          _this2.updatedCartItemsCount = response.data.mini_cart.cart_items.length;
        }
      })["catch"](function (exception) {
        console.log(_this2.__('error.something_went_wrong'));
      });
    },
    formatCategories: function formatCategories(categories) {
      var slicedCategories = categories;
      var categoryCount = this.categoryCount ? this.categoryCount : 9;
      if (slicedCategories && slicedCategories.length > categoryCount) {
        slicedCategories = categories.slice(0, categoryCount);
      }
      this.rootCategoriesCollection = slicedCategories;
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/header-mobile.vue?vue&type=template&id=453058b7&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/header-mobile.vue?vue&type=template&id=453058b7& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-6"
  }, [_vm.hamburger ? _c("div", {
    staticClass: "nav-container scrollable"
  }, [this.rootCategories ? _c("div", {
    staticClass: "wrapper"
  }, [_c("div", {
    staticClass: "greeting drawer-section fw6"
  }, [_c("i", {
    staticClass: "material-icons"
  }, [_vm._v("perm_identity")]), _vm._v(" "), _c("span", [_vm._t("greetings"), _vm._v(" "), _c("i", {
    staticClass: "material-icons float-right text-dark",
    on: {
      click: function click($event) {
        return _vm.closeDrawer();
      }
    }
  }, [_vm._v("\n                            cancel\n                        ")])], 2)]), _vm._v(" "), _vm.headerContent.length > 0 ? _c("ul", {
    staticClass: "velocity-content",
    attrs: {
      type: "none"
    }
  }, _vm._l(_vm.headerContent, function (content, index) {
    return _c("li", {
      key: index
    }, [_c("a", {
      staticClass: "unset",
      attrs: {
        href: "".concat(_vm.$root.baseUrl, "/").concat(content.page_link)
      },
      domProps: {
        textContent: _vm._s(content.title)
      }
    })]);
  }), 0) : _vm._e(), _vm._v(" "), _vm.rootCategoriesCollection.length > 0 ? _c("ul", {
    staticClass: "category-wrapper",
    attrs: {
      type: "none"
    }
  }, _vm._l(_vm.rootCategoriesCollection, function (category, index) {
    return _c("li", {
      key: index
    }, [_c("a", {
      staticClass: "unset",
      attrs: {
        href: "".concat(_vm.$root.baseUrl, "/").concat(category.slug)
      }
    }, [_c("div", {
      staticClass: "category-logo"
    }, [category.category_icon_url ? _c("img", {
      staticClass: "category-icon",
      attrs: {
        src: category.category_icon_url,
        alt: "",
        width: "20",
        height: "20"
      }
    }) : _vm._e()]), _vm._v(" "), _c("span", {
      domProps: {
        textContent: _vm._s(category.name)
      }
    })]), _vm._v(" "), category.children.length > 0 ? _c("i", {
      staticClass: "rango-arrow-right",
      on: {
        click: function click($event) {
          return _vm.toggleSubcategories(index, $event);
        }
      }
    }) : _vm._e()]);
  }), 0) : _vm._e(), _vm._v(" "), _vm._t("customer-navigation"), _vm._v(" "), _c("ul", {
    staticClass: "meta-wrapper",
    attrs: {
      type: "none"
    }
  }, [_c("li", [_vm.locale ? [_c("div", {
    staticClass: "language-logo-wrapper"
  }, [_vm.locale.image_url ? _c("img", {
    staticClass: "language-logo",
    attrs: {
      src: _vm.locale.image_url,
      alt: ""
    }
  }) : _vm._e()]), _vm._v(" "), _c("span", {
    domProps: {
      textContent: _vm._s(_vm.locale.name)
    }
  }, [_vm._v(_vm._s(_vm.locale.image_url))])] : _vm._e(), _vm._v(" "), _c("i", {
    staticClass: "rango-arrow-right",
    on: {
      click: function click($event) {
        return _vm.toggleMetaInfo("languages");
      }
    }
  })], 2), _vm._v(" "), _c("li", [_c("span", {
    domProps: {
      textContent: _vm._s(_vm.currency.code)
    }
  }), _vm._v(" "), _c("i", {
    staticClass: "rango-arrow-right",
    on: {
      click: function click($event) {
        return _vm.toggleMetaInfo("currencies");
      }
    }
  })]), _vm._v(" "), _vm._t("extra-navigation")], 2)], 2) : _vm.subCategory ? _c("div", {
    staticClass: "wrapper"
  }, [_c("div", {
    staticClass: "drawer-section"
  }, [_c("i", {
    staticClass: "rango-arrow-left fs24 text-down-4",
    on: {
      click: function click($event) {
        return _vm.toggleSubcategories("root");
      }
    }
  }), _vm._v(" "), _c("h4", {
    staticClass: "display-inbl",
    domProps: {
      textContent: _vm._s(_vm.subCategory.name)
    }
  }), _vm._v(" "), _c("i", {
    staticClass: "material-icons float-right text-dark",
    on: {
      click: function click($event) {
        return _vm.closeDrawer();
      }
    }
  }, [_vm._v("\n                        cancel\n                    ")])]), _vm._v(" "), _c("ul", {
    attrs: {
      type: "none"
    }
  }, _vm._l(_vm.subCategory.children, function (nestedSubCategory, index) {
    return _c("li", {
      key: index
    }, [_c("a", {
      staticClass: "unset",
      attrs: {
        href: "".concat(_vm.$root.baseUrl, "/").concat(_vm.subCategory.slug, "/").concat(nestedSubCategory.slug)
      }
    }, [_c("div", {
      staticClass: "category-logo"
    }, [nestedSubCategory.category_icon_url ? _c("img", {
      staticClass: "category-icon",
      attrs: {
        src: nestedSubCategory.category_icon_url,
        alt: "",
        width: "20",
        height: "20"
      }
    }) : _vm._e()]), _vm._v(" "), _c("span", {
      domProps: {
        textContent: _vm._s(nestedSubCategory.name)
      }
    })]), _vm._v(" "), nestedSubCategory.children && nestedSubCategory.children.length > 0 ? _c("ul", {
      staticClass: "nested-category",
      attrs: {
        type: "none"
      }
    }, _vm._l(nestedSubCategory.children, function (thirdLevelCategory, index) {
      return _c("li", {
        key: "index-".concat(index)
      }, [_c("a", {
        staticClass: "unset",
        attrs: {
          href: "".concat(_vm.$root.baseUrl, "/").concat(_vm.subCategory.slug, "/").concat(nestedSubCategory.slug, "/").concat(thirdLevelCategory.slug)
        }
      }, [_c("div", {
        staticClass: "category-logo"
      }, [thirdLevelCategory.category_icon_url ? _c("img", {
        staticClass: "category-icon",
        attrs: {
          src: thirdLevelCategory.category_icon_url,
          alt: "",
          width: "20",
          height: "20"
        }
      }) : _vm._e()]), _vm._v(" "), _c("span", {
        domProps: {
          textContent: _vm._s(thirdLevelCategory.name)
        }
      })])]);
    }), 0) : _vm._e()]);
  }), 0)]) : _vm.languages ? _c("div", {
    staticClass: "wrapper"
  }, [_c("div", {
    staticClass: "drawer-section"
  }, [_c("i", {
    staticClass: "rango-arrow-left fs24 text-down-4",
    on: {
      click: function click($event) {
        return _vm.toggleMetaInfo("languages");
      }
    }
  }), _vm._v(" "), _c("h4", {
    staticClass: "display-inbl",
    domProps: {
      textContent: _vm._s(_vm.__("responsive.header.languages"))
    }
  }), _vm._v(" "), _c("i", {
    staticClass: "material-icons float-right text-dark",
    on: {
      click: function click($event) {
        return _vm.closeDrawer();
      }
    }
  }, [_vm._v("cancel")])]), _vm._v(" "), _c("ul", {
    attrs: {
      type: "none"
    }
  }, _vm._l(_vm.allLocales, function (locale, index) {
    return _c("li", {
      key: index
    }, [_c("a", {
      staticClass: "unset",
      attrs: {
        href: "?locale=".concat(locale.code)
      }
    }, [_c("div", {
      staticClass: "category-logo"
    }, [locale.image_url ? _c("img", {
      staticClass: "category-icon",
      attrs: {
        src: locale.image_url,
        alt: "",
        width: "20",
        height: "20"
      }
    }) : _vm._e()]), _vm._v(" "), _c("span", {
      domProps: {
        textContent: _vm._s(locale.name)
      }
    })])]);
  }), 0)]) : _vm.currencies ? _c("div", {
    staticClass: "wrapper"
  }, [_c("div", {
    staticClass: "drawer-section"
  }, [_c("i", {
    staticClass: "rango-arrow-left fs24 text-down-4",
    on: {
      click: function click($event) {
        return _vm.toggleMetaInfo("currencies");
      }
    }
  }), _vm._v(" "), _c("h4", {
    staticClass: "display-inbl",
    domProps: {
      textContent: _vm._s(_vm.__("shop.general.currencies"))
    }
  }), _vm._v(" "), _c("i", {
    staticClass: "material-icons float-right text-dark",
    on: {
      click: function click($event) {
        return _vm.closeDrawer();
      }
    }
  }, [_vm._v("cancel")])]), _vm._v(" "), _c("ul", {
    attrs: {
      type: "none"
    }
  }, _vm._l(_vm.allCurrencies, function (currency, index) {
    return _c("li", {
      key: index
    }, [_c("a", {
      staticClass: "unset",
      attrs: {
        href: "?currency=".concat(currency.code)
      }
    }, [_c("span", {
      domProps: {
        textContent: _vm._s(currency.code)
      }
    })])]);
  }), 0)]) : _vm._e()]) : _vm._e(), _vm._v(" "), _c("div", {
    staticClass: "hamburger-wrapper",
    on: {
      click: _vm.toggleHamburger
    }
  }, [_c("i", {
    staticClass: "rango-toggle hamburger"
  })]), _vm._v(" "), _vm._t("logo")], 2), _vm._v(" "), _c("div", {
    staticClass: "right-vc-header col-6"
  }, [_vm._t("top-header"), _vm._v(" "), _c("a", {
    staticClass: "unset cursor-pointer",
    on: {
      click: _vm.openSearchBar
    }
  }, [_c("i", {
    staticClass: "material-icons"
  }, [_vm._v("search")])]), _vm._v(" "), _c("a", {
    staticClass: "unset",
    attrs: {
      href: _vm.cartRoute
    }
  }, [_c("i", {
    staticClass: "material-icons text-down-3"
  }, [_vm._v("shopping_cart")]), _vm._v(" "), _c("div", {
    staticClass: "badge-wrapper"
  }, [_c("span", {
    staticClass: "badge",
    domProps: {
      textContent: _vm._s(_vm.updatedCartItemsCount)
    }
  })])])], 2), _vm._v(" "), _vm.isSearchbar ? _c("div", {
    staticClass: "right searchbar"
  }, [_vm._t("search-bar")], 2) : _vm._e()]);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./src/Resources/assets/js/UI/components/header-mobile.vue":
/*!*****************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/header-mobile.vue ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _header_mobile_vue_vue_type_template_id_453058b7___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./header-mobile.vue?vue&type=template&id=453058b7& */ "./src/Resources/assets/js/UI/components/header-mobile.vue?vue&type=template&id=453058b7&");
/* harmony import */ var _header_mobile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./header-mobile.vue?vue&type=script&lang=js& */ "./src/Resources/assets/js/UI/components/header-mobile.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _header_mobile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _header_mobile_vue_vue_type_template_id_453058b7___WEBPACK_IMPORTED_MODULE_0__.render,
  _header_mobile_vue_vue_type_template_id_453058b7___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/Resources/assets/js/UI/components/header-mobile.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/header-mobile.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/header-mobile.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_header_mobile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./header-mobile.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/header-mobile.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_header_mobile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/Resources/assets/js/UI/components/header-mobile.vue?vue&type=template&id=453058b7&":
/*!************************************************************************************************!*\
  !*** ./src/Resources/assets/js/UI/components/header-mobile.vue?vue&type=template&id=453058b7& ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_header_mobile_vue_vue_type_template_id_453058b7___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_header_mobile_vue_vue_type_template_id_453058b7___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_header_mobile_vue_vue_type_template_id_453058b7___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./header-mobile.vue?vue&type=template&id=453058b7& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/Resources/assets/js/UI/components/header-mobile.vue?vue&type=template&id=453058b7&");


/***/ })

}]);