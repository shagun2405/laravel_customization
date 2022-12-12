/**
 * Main imports.
 */
import $ from 'jquery';
import Accounting from 'accounting';
import Vue         from 'vue';
import VeeValidate from 'vee-validate';
import VueCarousel from 'vue-carousel';
import translate   from '@components/trans';
import './bootstrap';
import axios  from 'axios';
import Flash from './UI/components/flash';
import FlashWrapper from './UI/components/flash-wrapper';


import {
    getBaseUrl,
    isMobile,
    loadDynamicScript,
    showAlert,
    removeTrailingSlash
} from './app-helpers';



 /**
  * Window assignation.
  */
 window.Vue = Vue;
 

 
 window.eventBus = new Vue();
 
 window.axios = axios;
 
 // TODO once every package is migrated to laravel-mix 6, this can be removed safely (jquery will be injected when needed)
 window.jQuery = window.$ = require('jquery');
 
 require('./dropdown.js');
 
 window.BootstrapSass = require('bootstrap-sass');
 
 window.lazySize = require('lazysizes');
 
 window.getBaseUrl = getBaseUrl;
 
 window.isMobile = isMobile;
 
 window.loadDynamicScript = loadDynamicScript;
 
 window.showAlert = showAlert;
 
/**
 * Lang imports.
 */
 import ar from 'vee-validate/dist/locale/ar';
 import de from 'vee-validate/dist/locale/de';
 import fa from 'vee-validate/dist/locale/fa';
 import fr from 'vee-validate/dist/locale/fr';
 import nl from 'vee-validate/dist/locale/nl';
 import tr from 'vee-validate/dist/locale/tr';
 import hi_IN from 'vee-validate/dist/locale/hi';
 import zh_CN from 'vee-validate/dist/locale/zh_CN';

/**
 * Vue plugins.
 */
Vue.use(VueCarousel);
Vue.use(BootstrapSass);
Vue.use(VeeValidate, {
    dictionary: {
        ar: ar,
        de: de,
        fa: fa,
        fr: fr,
        nl: nl,
        tr: tr,
        hi_IN: hi_IN,
        zh_CN: zh_CN
    },
    events: 'input|change|blur'
});
/**
 * Vue prototype.
 */
 Vue.prototype.$http = axios;

/**
 * Filters.
 */
Vue.filter('currency', function(value, argument) {
    return Accounting.formatMoney(value, argument);
});

/**
 * Global components.
 */
Vue.component('flash-wrapper', () => import('@components/flash-wrapper'));
Vue.component('flash', () => import('@components/flash'));
Vue.component('vue-slider', () => import('vue-slider-component'));
Vue.component('mini-cart-button', () => import('@components/mini-cart-button'));
Vue.component('mini-cart', () => import('@components/mini-cart'));
Vue.component('modal-component', () => import('@components/modal'));
Vue.component('add-to-cart', () => import('@components/add-to-cart'));
Vue.component('star-ratings', () => import('@components/star-rating'));
Vue.component('quantity-btn', () => import('@components/quantity-btn'));
Vue.component('quantity-changer', () => import('@components/quantity-changer'));
Vue.component('proceed-to-checkout', () => import('@components/proceed-to-checkout'));
Vue.component('compare-component-with-badge', () => import('@components/header-compare-with-badge'));
Vue.component('searchbar-component', () => import('@components/header-searchbar'));
Vue.component('wishlist-component-with-badge', () => import('@components/header-wishlist-with-badge'));
Vue.component('mobile-header', () => import('@components/header-mobile'));
Vue.component('sidebar-header', () => import('@components/header-sidebar'));
Vue.component('right-side-header', () => import('@components/header-right-side'));
Vue.component('sidebar-component', () => import('@components/sidebar'));
Vue.component('product-card', () => import('@components/product-card'));
Vue.component('wishlist-component', () => import('@components/wishlist'));
Vue.component('carousel-component', () => import('@components/carousel'));
Vue.component('slider-component', () => import('@components/banners'));
Vue.component('child-sidebar', () => import('@components/child-sidebar'));
Vue.component('card-list-header', () => import('@components/card-header'));
Vue.component('logo-component', () => import('@components/image-logo'));
Vue.component('magnify-image', () => import('@components/image-magnifier'));
Vue.component('image-search-component', () => import('@components/image-search'));
Vue.component('compare-component', () => import('@components/product-compare'));
Vue.component('shimmer-component', () => import('@components/shimmer-component'));
Vue.component('responsive-sidebar', () => import('@components/responsive-sidebar'));
Vue.component('product-quick-view', () => import('@components/product-quick-view'));
Vue.component('product-quick-view-btn', () => import('@components/product-quick-view-btn'));
Vue.component('recently-viewed', () => import('@components/recently-viewed'));
Vue.component('product-collections', () => import('@components/product-collections'));
Vue.component('hot-category', () => import('@components/hot-category'));
Vue.component('hot-categories', () => import('@components/hot-categories'));
Vue.component('popular-category', () => import('@components/popular-category'));
Vue.component('popular-categories', () => import('@components/popular-categories'));
Vue.component('velocity-overlay-loader', () => import('@components/overlay-loader'));

Vue.component('vnode-injector', {
    functional: true,
    props: ['nodes'],
    render(h, { props }) {
        return props.nodes;
    }
});
Vue.component('go-top', () => import('@inotom/vue-go-top'));

/**
 * Start from here.
 */
$(function() {
    /**
     * Define a mixin object.
     */
    Vue.mixin(translate);

    // Vue.mixin({
    //     data: function() {
    //         return {
    //             imageObserver: null,
    //             navContainer: false,
    //             headerItemsCount: 0,
    //             sharedRootCategories: [],
    //             responsiveSidebarTemplate: '',
    //             responsiveSidebarKey: Math.random(),
    //             baseUrl: getBaseUrl(),
    //         };
    //     },

    //     methods: {
    //         redirect: function(route) {
    //             route ? (window.location.href = route) : '';
    //         },

           

    //         show: function(element) {
    //             element.show();
    //             element.mouseleave(({ target }) => {
    //                 $(target.closest('.sidebar')).hide();
    //             });
    //         },

    //         hide: function(element) {
    //             element.hide();
    //         },

    //         toggleButtonDisability({ event, actionType }) {
    //             let button = event.target.querySelector('button[type=submit]');

    //             button ? (button.disabled = actionType) : '';
    //         },

    //         onSubmit: function(event) {
    //             this.toggleButtonDisability({ event, actionType: true });

    //             if (typeof tinyMCE !== 'undefined') tinyMCE.triggerSave();

    //             this.$validator.validateAll().then(result => {
    //                 if (result) {
    //                     event.target.submit();
    //                 } else {
    //                     this.toggleButtonDisability({
    //                         event,
    //                         actionType: false
    //                     });

    //                     eventBus.$emit('onFormError');
    //                 }
    //             });
    //         },

    //         isMobile: isMobile,

    //         loadDynamicScript: function(src, onScriptLoaded) {
    //             loadDynamicScript(src, onScriptLoaded);
    //         },

    //         getDynamicHTML: function(input) {
    //             let _staticRenderFns, output;

    //             const { render, staticRenderFns } = Vue.compile(input);

    //             if (this.$options.staticRenderFns.length > 0) {
    //                 _staticRenderFns = this.$options.staticRenderFns;
    //             } else {
    //                 _staticRenderFns = this.$options.staticRenderFns = staticRenderFns;
    //             }

    //             try {
    //                 output = render.call(this, this.$createElement);
    //             } catch (exception) {
    //                 console.log(this.__('error.something_went_wrong'));
    //             }

    //             this.$options.staticRenderFns = _staticRenderFns;

    //             return output;
    //         },

    //         getStorageValue: function(key) {
    //             let value = window.localStorage.getItem(key);

    //             if (value) {
    //                 value = JSON.parse(value);
    //             }

    //             return value;
    //         },

    //         setStorageValue: function(key, value) {
    //             window.localStorage.setItem(key, JSON.stringify(value));

    //             return true;
    //         }
    //     }
    // });

    window.app = new Vue({
        el: '#app',

        data: function() {
            return {
                loading: false,
                modalIds: {},
                miniCartKey: 0,
                quickView: false,
                productDetails: [],
            };
        },

        mounted: function() {
            console.log("HI")
            // this.$validator.localize(document.documentElement.lang);

            this.addServerErrors();
            this.addIntersectionObserver();
        },

        methods: {
            onSubmit: function(event) {
                this.toggleButtonDisability({ event, actionType: true });

                if (typeof tinyMCE !== 'undefined') tinyMCE.triggerSave();

                this.$validator.validateAll().then(result => {
                    if (result) {
                        event.target.submit();
                    } else {
                        this.toggleButtonDisability({
                            event,
                            actionType: false
                        });

                        eventBus.$emit('onFormError');
                    }
                });
            },

            toggleButtonDisable(value) {
                let buttons = document.getElementsByTagName('button');

                for (let i = 0; i < buttons.length; i++) {
                    buttons[i].disabled = value;
                }
            },

            addServerErrors: function(scope = null) {
                for (let key in serverErrors) {
                    let inputNames = [];
                    key.split('.').forEach(function(chunk, index) {
                        if (index) {
                            inputNames.push('[' + chunk + ']');
                        } else {
                            inputNames.push(chunk);
                        }
                    });

                    let inputName = inputNames.join('');

                    const field = this.$validator.fields.find({
                        name: inputName,
                        scope: scope
                    });

                    if (field) {
                        this.$validator.errors.add({
                            id: field.id,
                            field: inputName,
                            msg: serverErrors[key][0],
                            scope: scope
                        });
                    }
                }
            },

            addFlashMessages: function() {
                if (window.flashMessages.alertMessage)
                    window.alert(window.flashMessages.alertMessage);
            },

            showModal: function(id) {
                this.$set(this.modalIds, id, true);
            },

            addIntersectionObserver: function() {
                this.imageObserver = new IntersectionObserver(
                    (entries, imgObserver) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                const lazyImage = entry.target;
                                lazyImage.src = lazyImage.dataset.src;
                            }
                        });
                    }
                );
            },

            showLoader: function() {
                this.loading = true;
            },

            hideLoader: function() {
                this.loading = false;
            },
        }
    });
});
