(window.webpackJsonp_bluehost_wordpress_plugin=window.webpackJsonp_bluehost_wordpress_plugin||[]).push([[21],{147:function(e,t,n){"use strict";n.d(t,"c",(function(){return m})),n.d(t,"b",(function(){return g})),n.d(t,"d",(function(){return y})),n.d(t,"a",(function(){return v}));var r=n(9),o=n.n(r),c=n(141),u=n.n(c),i=n(1),a=n(21),s=n.n(a),l=(n(44),n(17)),f=n(159),b=n(5),p=n(12),d=n(2),O=n(16),w=n.n(O),j=n(38);function h(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}var m=function(){var e=u()(s.a.mark((function e(t){return s.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(null!==document.querySelector(t)){e.next=5;break}return e.next=3,new Promise((function(e){return requestAnimationFrame(e)}));case 3:e.next=0;break;case 5:return e.abrupt("return",document.querySelector(t));case 6:case"end":return e.stop()}}),e)})));return function(_x){return e.apply(this,arguments)}}(),g=function(e,t,n){var r=y(e,t);return r&&(e[r]=Object(b.merge)(e[r],n)),e},y=function(e,t){var n=Object(b.findIndex)(e,{id:t});return-1!==n&&n},v=function(e){var t=e.type,n=e.steps,r=e.options,c=void 0===r?{}:r,u=Object(b.merge)({defaultStepOptions:{cancelIcon:{enabled:!0}},useModalOverlay:!0},function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?h(Object(n),!0).forEach((function(t){o()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):h(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({type:t},c));return Object(i.createElement)(f.a,{steps:n,tourOptions:u},Object(i.createElement)((function(){return window.nfTour=Object(i.useContext)(f.b),function(e,t){Object(j.b)();var n,r=function(){jQuery("a.newfold-tour-relauncher").on("click",(function(e){e.preventDefault(),t.start()}))};(n=document.getElementById("newfold-editortours-loading"))&&(Object(j.c)(),n.classList.add("loaded"));var o=function(e,t){var n={action:"tour-"+e.tour.options.type,category:t,data:{step:e.id}};w()({path:"/newfold-notifications/v1/notifications/events",method:"POST",data:n})},c={id:"newfold-tour-notice",actions:[{url:"#",label:Object(d.__)("Reopen Tour","bluehost-wordpress-plugin"),className:"newfold-tour-relauncher"}]},u=Object(b.capitalize)(t.options.type);t.on("active",(function(){Object(p.dispatch)("core/notices").removeNotice("newfold-tour-notice")})),t.on("show",(function(e){o(e,"show")})),t.on("hide",(function(){Object(p.dispatch)("core/notices").createInfoNotice(u+" "+Object(d.__)("Page tour closed.","bluehost-wordpress-plugin"),c).then((function(){r()}))})),t.on("complete",(function(e){o(e,"complete"),Object(p.dispatch)("core/notices").createSuccessNotice(u+" "+Object(d.__)("Page tour is complete!","bluehost-wordpress-plugin"),c).then((function(){r()}))})),t.on("cancel",(function(e){o(e,"cancel"),Object(p.dispatch)("core/notices").createInfoNotice(u+" "+Object(d.__)("Page tour closed. You can restart it below.","bluehost-wordpress-plugin"),c).then((function(){r()}))}))}(0,window.nfTour),window.nfTourContext===Object(l.getQueryArg)(window.location.href,"tour")?Object(i.createElement)(i.Fragment,null,window.nfTour.start()):Object(i.createElement)(i.Fragment,null)}),null))}},238:function(e,t,n){"use strict";n.r(t),n.d(t,"AboutTour",(function(){return l}));var r=n(3),o=n.n(r),c=n(1),u=n(16),i=n.n(u),a=n(17),s=n(147),l=function(){var e=Object(c.useState)(!1),t=o()(e,2),n=t[0],r=t[1],u=Object(c.useState)([]),l=o()(u,2),f=l[0],b=l[1],p=Object(a.addQueryArgs)("/newfold/v1/tours/blockeditor",{type:"about",brand:"bluehost",lang:"en-us"});return Object(c.useEffect)((function(){i()({path:p}).then((function(e){b(function(e){var t=e;return Object(s.b)(t,"inserter-opened",{beforeShowPromise:function(){return new Promise((function(e){Object(s.c)(".interface-interface-skeleton__secondary-sidebar").then((function(){e()}))}))}})}(e)),r(!0)}))}),[]),!!n&&Object(c.createElement)(s.a,{type:"about",steps:f})};t.default=l}}]);