(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["settings"],{1471:function(t,e,n){"use strict";var o=n("1c6e"),a=n.n(o);a.a},"1c6e":function(t,e,n){},b41f:function(t,e,n){"use strict";n.r(e);var o=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("core-page",[n("div",{staticClass:"omapi-settings"},[n(t.componentName,{tag:"component",scopedSlots:t._u([{key:"tabs",fn:function(){return[n("common-tabnav",{attrs:{active:t.currentTab,tabs:t.allTabs},on:{go:t.goTo}})]},proxy:!0}])})],1)])},a=[],s=n("f225"),r={mixins:[s["a"]],data:function(){return{pageSlug:"settings"}},computed:{componentName:function(){return"settings-".concat(this.currentTab)}},methods:{goTo:function(t){if("billing"===t){"billing"===this.selectedTab&&this.goTab({page:this.pageSlug});var e=window.location.href;return window.open(this.$urls.app("account/billing/?utm_source=WordPress&utm_medium=BillingSettingsTab&utm_campaign=Plugin&return=".concat(e)))}if("subaccounts"===t){"subaccounts"===this.selectedTab&&this.goTab({page:this.pageSlug});var n=window.location.href;return window.open(this.$urls.app("account/users/?utm_source=WordPress&utm_medium=SubAccountsSettingsTab&utm_campaign=Plugin&return=".concat(n)))}this.goTab({page:this.pageSlug,tab:t})}}},c=r,i=(n("1471"),n("2877")),u=Object(i["a"])(c,o,a,!1,null,null,null);e["default"]=u.exports},f225:function(t,e,n){"use strict";n.d(e,"a",(function(){return u}));n("8e6e"),n("ac6a"),n("456d");var o=n("bd86"),a=n("9b02"),s=n.n(a),r=n("2f62");function c(t,e){var n=Object.keys(t);return Object.getOwnPropertySymbols&&n.push.apply(n,Object.getOwnPropertySymbols(t)),e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n}function i(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?c(n,!0).forEach((function(e){Object(o["a"])(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):c(n).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}var u={mounted:function(){this.goToSelected()},watch:{$route:function(t,e){this.goTo(s()(t,"params.selectedTab"))}},computed:i({},Object(r["d"])("tabs",["settingsTab","settingsTabs"]),{allTabs:function(){return this.$store.getters["tabs/".concat(this.pageSlug,"Tabs")]},currentTab:function(){return this.$store.getters["tabs/".concat(this.pageSlug,"Tab")]},selectedTab:function(){return this.$get("$route.params.selectedTab")}}),methods:i({},Object(r["c"])("tabs",["goTab"]),{navTo:function(t){this.goTab({page:this.pageSlug,tab:t,baseUrl:""})},goTo:function(t){this.goTab({page:this.pageSlug,tab:t})},goToSelected:function(){this.selectedTab&&this.goTo(this.selectedTab)}})}}}]);
//# sourceMappingURL=settings.b9e025d0.js.map