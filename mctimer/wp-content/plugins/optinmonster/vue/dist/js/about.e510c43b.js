(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["about"],{"1e1d3":function(t,e,a){},a1d1:function(t,e,a){"use strict";a.r(e);var s=function(){var t=this,e=t._self._c;return e("core-page",[e("div",{staticClass:"omapi-about-us"},[e("common-tabnav",{attrs:{active:t.currentTab,tabs:t.allTabs},on:{go:t.goTo}}),e("common-alerts",{attrs:{id:"om-plugin-alerts",alerts:t.alerts}}),"about-us"===t.currentTab?e("about-us"):t._e(),"getting-started"===t.currentTab?e("about-getting-started"):t._e(),"lite-pro"===t.currentTab?e("about-lite-vs-pro"):t._e()],1)])},o=[],r=a("2f62"),u=a("f225"),n={mixins:[u["a"]],data(){return{pageSlug:"about"}},computed:{...Object(r["f"])(["error","alerts"])}},b=n,i=(a("e524"),a("2877")),c=Object(i["a"])(b,s,o,!1,null,null,null);e["default"]=c.exports},e524:function(t,e,a){"use strict";a("1e1d3")},f225:function(t,e,a){"use strict";a.d(e,"a",(function(){return u}));var s=a("9b02"),o=a.n(s),r=a("2f62");const u={computed:{...Object(r["d"])("tabs",["settingsTab","settingsTabs"]),allTabs(){return this.$store.getters[`tabs/${this.pageSlug}Tabs`]},currentTab(){return this.$store.getters[`tabs/${this.pageSlug}Tab`]},selectedTab(){return this.$get("$route.params.selectedTab")}},mounted(){this.goToSelected()},watch:{$route(t){this.goTo(o()(t,"params.selectedTab"))}},methods:{...Object(r["c"])("tabs",["goTab"]),navTo(t){this.goTab({page:this.pageSlug,tab:t,baseUrl:""})},goTo(t){this.goTab({page:this.pageSlug,tab:t})},goToSelected(){this.selectedTab&&this.goTo(this.selectedTab)}}}}}]);
//# sourceMappingURL=about.e510c43b.js.map