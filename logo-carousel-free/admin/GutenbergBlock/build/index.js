!function(){"use strict";var e=window.wp.escapeHtml,t=window.wp.element;const o=t.createElement,r={};r.teamPro=o("img",{src:(0,e.escapeAttribute)(sp_logo_carousel_free_g.path+"admin/GutenbergBlock/assets/logo-carousel.svg")});var l=r,s=window.wp.i18n;const a=t.createElement;var c=o=>{let{attributes:{shortcode:r},shortCodeList:l,shortcodeUpdate:c}=o;return(0,t.createElement)(t.Fragment,null,a("div",{className:"splcf-gutenberg-shortcode editor-styles-wrapper"},a("select",{className:"splcf-shortcode-selector",onChange:e=>c(e),value:(0,e.escapeAttribute)(r)},a("option",{value:(0,e.escapeAttribute)("0")},(0,e.escapeHTML)((0,s.__)("-- Select a carousel (shortcode) --","logo-carousel-free"))),l.map((t=>{var o=t.title.length>30?t.title.substring(0,25)+".... #("+t.id+")":t.title+" #("+t.id+")";return a("option",{value:(0,e.escapeAttribute)(t.id.toString()),key:(0,e.escapeAttribute)(t.id.toString())},(0,e.escapeHTML)(o))})))))},n=window.wp.blocks,i=window.wp.components,p=window.wp.blockEditor;const u=wp.serverSideRender,d=t.createElement;(0,n.registerBlockType)("sp-logo-carousel-pro/shortcode",{title:(0,s.__)("Logo Carousel","logo-carousel-free"),description:(0,s.__)("Use Logo Carousel Pro to insert a carousel (shortcode) in your page.","logo-carousel-free"),icon:l.teamPro,category:"common",supports:{html:!1},edit:o=>{const{attributes:r,setAttributes:l}=o;var a=sp_logo_carousel_free_g.shortCodeList;let n=e=>{let t=!1,o=setInterval((function(){let r=jQuery("#logo-carousel-free-"+e).parents().attr("id");document.getElementById(r)&&(jQuery("#lcp-preloader-"+e).css({opacity:0,display:"none"}),jQuery("#lcp-preloader-"+e).animate({opacity:1},600),jQuery.getScript(sp_logo_carousel_free_g.loadScript),t=!0,r=""),t&&clearInterval(o),0==e&&clearInterval(o)}),100)},g=e=>{l({shortcode:e.target.value});let t=e.target.value;n(t)};return document.addEventListener("readystatechange",(e=>{if("complete"===e.target.readyState){let e=r.shortcode;n(e)}})),r.preview?d("div",{},d("img",{src:(0,e.escapeAttribute)(sp_logo_carousel_free_g.path+"admin/GutenbergBlock/assets/logo-carousel-block-preview.svg")})):0===a.length?(0,t.createElement)(t.Fragment,null,d("div",{className:"components-placeholder components-placeholder is-large"},d("div",{className:"components-placeholder__label"},d("img",{className:"block-editor-block-icon",src:(0,e.escapeAttribute)(sp_logo_carousel_free_g.path+"admin/GutenbergBlock/assets/logo-carousel.svg")}),(0,e.escapeHTML)((0,s.__)("Logo Carousel","logo-carousel-free"))),d("div",{className:"components-placeholder__instructions"},(0,e.escapeHTML)((0,s.__)("No logo carousel found. ","logo-carousel-free")),d("a",{href:(0,e.escapeAttribute)(sp_logo_carousel_free_g.url)},(0,e.escapeHTML)((0,s.__)("Create a carousel (shortcode) now!","logo-carousel-free")))))):r.shortcode&&0!=r.shortcode?(0,t.createElement)(t.Fragment,null,(0,t.createElement)(p.InspectorControls,null,(0,t.createElement)(i.PanelBody,{title:"Select a carousel (shortcode)"},(0,t.createElement)(i.PanelRow,null,(0,t.createElement)(c,{attributes:r,shortCodeList:a,shortcodeUpdate:g})))),(0,t.createElement)(u,{block:"sp-logo-carousel-pro/shortcode",attributes:r})):(0,t.createElement)(t.Fragment,null,(0,t.createElement)(p.InspectorControls,null,(0,t.createElement)(i.PanelBody,{title:"Select a carousel (shortcode)"},(0,t.createElement)(i.PanelRow,null,(0,t.createElement)(c,{attributes:r,shortCodeList:a,shortcodeUpdate:g})))),d("div",{className:"components-placeholder components-placeholder is-large"},d("div",{className:"components-placeholder__label"},d("img",{className:"block-editor-block-icon",src:(0,e.escapeAttribute)(sp_logo_carousel_free_g.path+"admin/GutenbergBlock/assets/logo-carousel.svg")}),(0,e.escapeHTML)((0,s.__)("Logo Carousel","logo-carousel-free"))),d("div",{className:"components-placeholder__instructions"},(0,e.escapeHTML)((0,s.__)("Select a carousel (shortcode)","logo-carousel-free"))),(0,t.createElement)(c,{attributes:r,shortCodeList:a,shortcodeUpdate:g})))},save:()=>null})}();