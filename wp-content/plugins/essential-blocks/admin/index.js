/*! For license information please see index.js.LICENSE.txt */
(()=>{var e={3783:function(e,t,n){var o,r,i;"undefined"!=typeof self&&self,e.exports=(o=n(7363),r=n(216),i=n(6490),function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=45)}({0:function(e,t){e.exports=o},1:function(e,t){e.exports=r},45:function(e,t,n){"use strict";var o=this&&this.__assign||function(){return(o=Object.assign||function(e){for(var t,n=1,o=arguments.length;n<o;n++)for(var r in t=arguments[n])Object.prototype.hasOwnProperty.call(t,r)&&(e[r]=t[r]);return e}).apply(this,arguments)},r=this&&this.__rest||function(e,t){var n={};for(var o in e)Object.prototype.hasOwnProperty.call(e,o)&&t.indexOf(o)<0&&(n[o]=e[o]);if(null!=e&&"function"==typeof Object.getOwnPropertySymbols){var r=0;for(o=Object.getOwnPropertySymbols(e);r<o.length;r++)t.indexOf(o[r])<0&&Object.prototype.propertyIsEnumerable.call(e,o[r])&&(n[o[r]]=e[o[r]])}return n},i=this&&this.__importDefault||function(e){return e&&e.__esModule?e:{default:e}};Object.defineProperty(t,"__esModule",{value:!0});var a=i(n(0)),s=i(n(1)),c=n(5),u=n(46);t.Button=function(e){var t,n=e.className,i=void 0===n?"":n,c=e.raised,p=void 0!==c&&c,d=e.unelevated,f=void 0!==d&&d,h=e.outlined,v=void 0!==h&&h,m=e.dense,_=void 0!==m&&m,y=e.disabled,b=void 0!==y&&y,g=e.icon,S=e.href,C=e.children,O=e.initRipple,E=e.trailingIcon,A=(e.unbounded,r(e,["className","raised","unelevated","outlined","dense","disabled","icon","href","children","initRipple","trailingIcon","unbounded"])),T=o({className:s.default(u.CSS_CLASSES.ROOT,i,(t={},t[u.CSS_CLASSES.RAISED]=p,t[u.CSS_CLASSES.UNELEVATED]=f,t[u.CSS_CLASSES.OUTLINED]=v,t[u.CSS_CLASSES.DENSE]=_,t)),ref:O,disabled:b},A);return S?a.default.createElement("a",o({},T,{href:S}),E?null:l(g),a.default.createElement("span",{className:u.CSS_CLASSES.LABEL},C),E?l(E):null):a.default.createElement("button",o({},T),E?null:l(g),a.default.createElement("span",{className:u.CSS_CLASSES.LABEL},C),E?l(E):null)};var l=function(e){return e?a.default.cloneElement(e,{className:s.default(u.CSS_CLASSES.ICON,e.props.className)}):null};t.Button.defaultProps={initRipple:function(){}},t.default=c.withRipple(t.Button)},46:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.CSS_CLASSES={ROOT:"mdc-button",ICON:"mdc-button__icon",LABEL:"mdc-button__label",DENSE:"mdc-button--dense",RAISED:"mdc-button--raised",OUTLINED:"mdc-button--outlined",UNELEVATED:"mdc-button--unelevated"}},5:function(e,t){e.exports=i}}))},6490:function(e,t,n){var o,r;"undefined"!=typeof self&&self,e.exports=(o=n(7363),r=n(216),function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=107)}({0:function(e,t){e.exports=o},1:function(e,t){e.exports=r},107:function(e,t,n){"use strict";var o,r=this&&this.__extends||(o=function(e,t){return(o=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(e,t){e.__proto__=t}||function(e,t){for(var n in t)t.hasOwnProperty(n)&&(e[n]=t[n])})(e,t)},function(e,t){function n(){this.constructor=e}o(e,t),e.prototype=null===t?Object.create(t):(n.prototype=t.prototype,new n)}),i=this&&this.__assign||function(){return(i=Object.assign||function(e){for(var t,n=1,o=arguments.length;n<o;n++)for(var r in t=arguments[n])Object.prototype.hasOwnProperty.call(t,r)&&(e[r]=t[r]);return e}).apply(this,arguments)},a=this&&this.__rest||function(e,t){var n={};for(var o in e)Object.prototype.hasOwnProperty.call(e,o)&&t.indexOf(o)<0&&(n[o]=e[o]);if(null!=e&&"function"==typeof Object.getOwnPropertySymbols){var r=0;for(o=Object.getOwnPropertySymbols(e);r<o.length;r++)t.indexOf(o[r])<0&&Object.prototype.propertyIsEnumerable.call(e,o[r])&&(n[o[r]]=e[o[r]])}return n},s=this&&this.__importDefault||function(e){return e&&e.__esModule?e:{default:e}};Object.defineProperty(t,"__esModule",{value:!0});var c=s(n(0)),u=s(n(1)),l=n(155),p=n(38),d=n(108);t.withRipple=function(e){var t;return(t=function(t){function n(){var n,o=null!==t&&t.apply(this,arguments)||this;return o.isComponentMounted=!0,o.isTouched=!1,o.displayName="WithRipple("+((n=e).displayName||n.name||"Component")+")",o.state={classList:new Set,style:{}},o.initializeFoundation=function(e,t){var n=o.createAdapter(e,t);o.foundation=new l.MDCRippleFoundation(n),o.foundation.init()},o.createAdapter=function(e,t){return{browserSupportsCssVars:function(){return p.supportsCssVariables(window)},isUnbounded:function(){return o.props.unbounded},isSurfaceActive:function(){return t?d.matches(t,":active"):d.matches(e,":active")},isSurfaceDisabled:function(){return o.props.disabled},addClass:function(e){o.isComponentMounted&&o.setState({classList:o.state.classList.add(e)})},removeClass:function(e){if(o.isComponentMounted){var t=o.state.classList;t.delete(e),o.setState({classList:t})}},registerDocumentInteractionHandler:function(e,t){return document.documentElement.addEventListener(e,t,p.applyPassive())},deregisterDocumentInteractionHandler:function(e,t){return document.documentElement.removeEventListener(e,t,p.applyPassive())},registerResizeHandler:function(e){return window.addEventListener("resize",e)},deregisterResizeHandler:function(e){return window.removeEventListener("resize",e)},updateCssVariable:o.updateCssVariable,computeBoundingRect:function(){return o.isComponentMounted?o.props.computeBoundingRect?o.props.computeBoundingRect(e):e.getBoundingClientRect():{bottom:0,height:0,left:0,right:0,top:0,width:0,x:0,y:0}},containsEventTarget:function(e){return!(!t||null===e)&&t.contains(e)},registerInteractionHandler:function(){return null},deregisterInteractionHandler:function(){return null},getWindowPageOffset:function(){return{x:window.pageXOffset,y:window.pageYOffset}}}},o.handleFocus=function(e){o.props.onFocus&&o.props.onFocus(e),o.foundation.handleFocus()},o.handleBlur=function(e){o.props.onBlur&&o.props.onBlur(e),o.foundation.handleBlur()},o.handleMouseDown=function(e){o.props.onMouseDown&&o.props.onMouseDown(e),o.isTouched?o.isTouched=!1:o.activateRipple(e)},o.handleMouseUp=function(e){o.props.onMouseUp&&o.props.onMouseUp(e),o.deactivateRipple()},o.handleTouchStart=function(e){o.isTouched=!0,o.props.onTouchStart&&o.props.onTouchStart(e),o.activateRipple(e)},o.handleTouchEnd=function(e){o.props.onTouchEnd&&o.props.onTouchEnd(e),o.deactivateRipple()},o.handleKeyDown=function(e){o.props.onKeyDown&&o.props.onKeyDown(e),o.activateRipple(e)},o.handleKeyUp=function(e){o.props.onKeyUp&&o.props.onKeyUp(e),o.deactivateRipple()},o.activateRipple=function(e){e.persist(),o.foundation.activate(e.nativeEvent)},o.deactivateRipple=function(){o.foundation.deactivate()},o.updateCssVariable=function(e,t){o.isComponentMounted&&o.setState((function(n){var r=Object.assign({},o.state.style,n.style);return null===t?delete r[e]:r[e]=t,Object.assign(n,{style:r})}))},o}return r(n,t),n.prototype.componentDidMount=function(){if(!this.foundation)throw new Error("You must call initRipple from the element's ref prop to initialize the adapter for withRipple")},n.prototype.componentDidUpdate=function(e){this.props.disabled!==e.disabled&&this.props.disabled&&this.foundation.handleBlur()},n.prototype.componentWillUnmount=function(){this.foundation&&(this.isComponentMounted=!1,this.foundation.destroy())},Object.defineProperty(n.prototype,"classes",{get:function(){var e=this.props.className,t=this.state.classList;return u.default(Array.from(t),e)},enumerable:!0,configurable:!0}),Object.defineProperty(n.prototype,"style",{get:function(){var e=this.props.style,t=this.state.style;return Object.assign({},t,e)},enumerable:!0,configurable:!0}),n.prototype.render=function(){var t=this.props,n=(t.unbounded,t.style,t.className,t.onMouseDown,t.onMouseUp,t.onTouchStart,t.onTouchEnd,t.onKeyDown,t.onKeyUp,t.onFocus,t.onBlur,a(t,["unbounded","style","className","onMouseDown","onMouseUp","onTouchStart","onTouchEnd","onKeyDown","onKeyUp","onFocus","onBlur"])),o=i({},n,{onMouseDown:this.handleMouseDown,onMouseUp:this.handleMouseUp,onTouchStart:this.handleTouchStart,onTouchEnd:this.handleTouchEnd,onKeyDown:this.handleKeyDown,onKeyUp:this.handleKeyUp,onFocus:this.handleFocus,onBlur:this.handleBlur,initRipple:this.initializeFoundation,className:this.classes,style:this.style});return c.default.createElement(e,i({},o))},n}(c.default.Component)).defaultProps=i({unbounded:!1,disabled:!1,style:{},className:"",onMouseDown:function(){},onMouseUp:function(){},onTouchStart:function(){},onTouchEnd:function(){},onKeyDown:function(){},onKeyUp:function(){},onFocus:function(){},onBlur:function(){}},e.defaultProps),t}},108:function(e,t,n){"use strict";function o(e,t){if(e.closest)return e.closest(t);for(var n=e;n;){if(r(n,t))return n;n=n.parentElement}return null}function r(e,t){return(e.matches||e.webkitMatchesSelector||e.msMatchesSelector).call(e,t)}n.r(t),n.d(t,"closest",(function(){return o})),n.d(t,"matches",(function(){return r}))},155:function(e,t,n){"use strict";n.r(t),"function"==typeof Symbol&&Symbol.iterator;var o=function(e,t){return(o=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(e,t){e.__proto__=t}||function(e,t){for(var n in t)t.hasOwnProperty(n)&&(e[n]=t[n])})(e,t)},r=function(){return(r=Object.assign||function(e){for(var t,n=1,o=arguments.length;n<o;n++)for(var r in t=arguments[n])Object.prototype.hasOwnProperty.call(t,r)&&(e[r]=t[r]);return e}).apply(this,arguments)},i=function(){function e(e){void 0===e&&(e={}),this.adapter_=e}return Object.defineProperty(e,"cssClasses",{get:function(){return{}},enumerable:!0,configurable:!0}),Object.defineProperty(e,"strings",{get:function(){return{}},enumerable:!0,configurable:!0}),Object.defineProperty(e,"numbers",{get:function(){return{}},enumerable:!0,configurable:!0}),Object.defineProperty(e,"defaultAdapter",{get:function(){return{}},enumerable:!0,configurable:!0}),e.prototype.init=function(){},e.prototype.destroy=function(){},e}(),a={BG_FOCUSED:"mdc-ripple-upgraded--background-focused",FG_ACTIVATION:"mdc-ripple-upgraded--foreground-activation",FG_DEACTIVATION:"mdc-ripple-upgraded--foreground-deactivation",ROOT:"mdc-ripple-upgraded",UNBOUNDED:"mdc-ripple-upgraded--unbounded"},s={VAR_FG_SCALE:"--mdc-ripple-fg-scale",VAR_FG_SIZE:"--mdc-ripple-fg-size",VAR_FG_TRANSLATE_END:"--mdc-ripple-fg-translate-end",VAR_FG_TRANSLATE_START:"--mdc-ripple-fg-translate-start",VAR_LEFT:"--mdc-ripple-left",VAR_TOP:"--mdc-ripple-top"},c={DEACTIVATION_TIMEOUT_MS:225,FG_DEACTIVATION_MS:150,INITIAL_ORIGIN_SCALE:.6,PADDING:10,TAP_DELAY_MS:300},u=n(38);n.d(t,"MDCRippleFoundation",(function(){return f}));var l=["touchstart","pointerdown","mousedown","keydown"],p=["touchend","pointerup","mouseup","contextmenu"],d=[],f=function(e){function t(n){var o=e.call(this,r({},t.defaultAdapter,n))||this;return o.activationAnimationHasEnded_=!1,o.activationTimer_=0,o.fgDeactivationRemovalTimer_=0,o.fgScale_="0",o.frame_={width:0,height:0},o.initialSize_=0,o.layoutFrame_=0,o.maxRadius_=0,o.unboundedCoords_={left:0,top:0},o.activationState_=o.defaultActivationState_(),o.activationTimerCallback_=function(){o.activationAnimationHasEnded_=!0,o.runDeactivationUXLogicIfReady_()},o.activateHandler_=function(e){return o.activate_(e)},o.deactivateHandler_=function(){return o.deactivate_()},o.focusHandler_=function(){return o.handleFocus()},o.blurHandler_=function(){return o.handleBlur()},o.resizeHandler_=function(){return o.layout()},o}return function(e,t){function n(){this.constructor=e}o(e,t),e.prototype=null===t?Object.create(t):(n.prototype=t.prototype,new n)}(t,e),Object.defineProperty(t,"cssClasses",{get:function(){return a},enumerable:!0,configurable:!0}),Object.defineProperty(t,"strings",{get:function(){return s},enumerable:!0,configurable:!0}),Object.defineProperty(t,"numbers",{get:function(){return c},enumerable:!0,configurable:!0}),Object.defineProperty(t,"defaultAdapter",{get:function(){return{addClass:function(){},browserSupportsCssVars:function(){return!0},computeBoundingRect:function(){return{top:0,right:0,bottom:0,left:0,width:0,height:0}},containsEventTarget:function(){return!0},deregisterDocumentInteractionHandler:function(){},deregisterInteractionHandler:function(){},deregisterResizeHandler:function(){},getWindowPageOffset:function(){return{x:0,y:0}},isSurfaceActive:function(){return!0},isSurfaceDisabled:function(){return!0},isUnbounded:function(){return!0},registerDocumentInteractionHandler:function(){},registerInteractionHandler:function(){},registerResizeHandler:function(){},removeClass:function(){},updateCssVariable:function(){}}},enumerable:!0,configurable:!0}),t.prototype.init=function(){var e=this,n=this.supportsPressRipple_();if(this.registerRootHandlers_(n),n){var o=t.cssClasses,r=o.ROOT,i=o.UNBOUNDED;requestAnimationFrame((function(){e.adapter_.addClass(r),e.adapter_.isUnbounded()&&(e.adapter_.addClass(i),e.layoutInternal_())}))}},t.prototype.destroy=function(){var e=this;if(this.supportsPressRipple_()){this.activationTimer_&&(clearTimeout(this.activationTimer_),this.activationTimer_=0,this.adapter_.removeClass(t.cssClasses.FG_ACTIVATION)),this.fgDeactivationRemovalTimer_&&(clearTimeout(this.fgDeactivationRemovalTimer_),this.fgDeactivationRemovalTimer_=0,this.adapter_.removeClass(t.cssClasses.FG_DEACTIVATION));var n=t.cssClasses,o=n.ROOT,r=n.UNBOUNDED;requestAnimationFrame((function(){e.adapter_.removeClass(o),e.adapter_.removeClass(r),e.removeCssVars_()}))}this.deregisterRootHandlers_(),this.deregisterDeactivationHandlers_()},t.prototype.activate=function(e){this.activate_(e)},t.prototype.deactivate=function(){this.deactivate_()},t.prototype.layout=function(){var e=this;this.layoutFrame_&&cancelAnimationFrame(this.layoutFrame_),this.layoutFrame_=requestAnimationFrame((function(){e.layoutInternal_(),e.layoutFrame_=0}))},t.prototype.setUnbounded=function(e){var n=t.cssClasses.UNBOUNDED;e?this.adapter_.addClass(n):this.adapter_.removeClass(n)},t.prototype.handleFocus=function(){var e=this;requestAnimationFrame((function(){return e.adapter_.addClass(t.cssClasses.BG_FOCUSED)}))},t.prototype.handleBlur=function(){var e=this;requestAnimationFrame((function(){return e.adapter_.removeClass(t.cssClasses.BG_FOCUSED)}))},t.prototype.supportsPressRipple_=function(){return this.adapter_.browserSupportsCssVars()},t.prototype.defaultActivationState_=function(){return{activationEvent:void 0,hasDeactivationUXRun:!1,isActivated:!1,isProgrammatic:!1,wasActivatedByPointer:!1,wasElementMadeActive:!1}},t.prototype.registerRootHandlers_=function(e){var t=this;e&&(l.forEach((function(e){t.adapter_.registerInteractionHandler(e,t.activateHandler_)})),this.adapter_.isUnbounded()&&this.adapter_.registerResizeHandler(this.resizeHandler_)),this.adapter_.registerInteractionHandler("focus",this.focusHandler_),this.adapter_.registerInteractionHandler("blur",this.blurHandler_)},t.prototype.registerDeactivationHandlers_=function(e){var t=this;"keydown"===e.type?this.adapter_.registerInteractionHandler("keyup",this.deactivateHandler_):p.forEach((function(e){t.adapter_.registerDocumentInteractionHandler(e,t.deactivateHandler_)}))},t.prototype.deregisterRootHandlers_=function(){var e=this;l.forEach((function(t){e.adapter_.deregisterInteractionHandler(t,e.activateHandler_)})),this.adapter_.deregisterInteractionHandler("focus",this.focusHandler_),this.adapter_.deregisterInteractionHandler("blur",this.blurHandler_),this.adapter_.isUnbounded()&&this.adapter_.deregisterResizeHandler(this.resizeHandler_)},t.prototype.deregisterDeactivationHandlers_=function(){var e=this;this.adapter_.deregisterInteractionHandler("keyup",this.deactivateHandler_),p.forEach((function(t){e.adapter_.deregisterDocumentInteractionHandler(t,e.deactivateHandler_)}))},t.prototype.removeCssVars_=function(){var e=this,n=t.strings;Object.keys(n).forEach((function(t){0===t.indexOf("VAR_")&&e.adapter_.updateCssVariable(n[t],null)}))},t.prototype.activate_=function(e){var t=this;if(!this.adapter_.isSurfaceDisabled()){var n=this.activationState_;if(!n.isActivated){var o=this.previousActivationEvent_;o&&void 0!==e&&o.type!==e.type||(n.isActivated=!0,n.isProgrammatic=void 0===e,n.activationEvent=e,n.wasActivatedByPointer=!n.isProgrammatic&&void 0!==e&&("mousedown"===e.type||"touchstart"===e.type||"pointerdown"===e.type),void 0!==e&&d.length>0&&d.some((function(e){return t.adapter_.containsEventTarget(e)}))?this.resetActivationState_():(void 0!==e&&(d.push(e.target),this.registerDeactivationHandlers_(e)),n.wasElementMadeActive=this.checkElementMadeActive_(e),n.wasElementMadeActive&&this.animateActivation_(),requestAnimationFrame((function(){d=[],n.wasElementMadeActive||void 0===e||" "!==e.key&&32!==e.keyCode||(n.wasElementMadeActive=t.checkElementMadeActive_(e),n.wasElementMadeActive&&t.animateActivation_()),n.wasElementMadeActive||(t.activationState_=t.defaultActivationState_())}))))}}},t.prototype.checkElementMadeActive_=function(e){return void 0===e||"keydown"!==e.type||this.adapter_.isSurfaceActive()},t.prototype.animateActivation_=function(){var e=this,n=t.strings,o=n.VAR_FG_TRANSLATE_START,r=n.VAR_FG_TRANSLATE_END,i=t.cssClasses,a=i.FG_DEACTIVATION,s=i.FG_ACTIVATION,c=t.numbers.DEACTIVATION_TIMEOUT_MS;this.layoutInternal_();var u="",l="";if(!this.adapter_.isUnbounded()){var p=this.getFgTranslationCoordinates_(),d=p.startPoint,f=p.endPoint;u=d.x+"px, "+d.y+"px",l=f.x+"px, "+f.y+"px"}this.adapter_.updateCssVariable(o,u),this.adapter_.updateCssVariable(r,l),clearTimeout(this.activationTimer_),clearTimeout(this.fgDeactivationRemovalTimer_),this.rmBoundedActivationClasses_(),this.adapter_.removeClass(a),this.adapter_.computeBoundingRect(),this.adapter_.addClass(s),this.activationTimer_=setTimeout((function(){return e.activationTimerCallback_()}),c)},t.prototype.getFgTranslationCoordinates_=function(){var e,t=this.activationState_,n=t.activationEvent;return{startPoint:e={x:(e=t.wasActivatedByPointer?Object(u.getNormalizedEventCoords)(n,this.adapter_.getWindowPageOffset(),this.adapter_.computeBoundingRect()):{x:this.frame_.width/2,y:this.frame_.height/2}).x-this.initialSize_/2,y:e.y-this.initialSize_/2},endPoint:{x:this.frame_.width/2-this.initialSize_/2,y:this.frame_.height/2-this.initialSize_/2}}},t.prototype.runDeactivationUXLogicIfReady_=function(){var e=this,n=t.cssClasses.FG_DEACTIVATION,o=this.activationState_,r=o.hasDeactivationUXRun,i=o.isActivated;(r||!i)&&this.activationAnimationHasEnded_&&(this.rmBoundedActivationClasses_(),this.adapter_.addClass(n),this.fgDeactivationRemovalTimer_=setTimeout((function(){e.adapter_.removeClass(n)}),c.FG_DEACTIVATION_MS))},t.prototype.rmBoundedActivationClasses_=function(){var e=t.cssClasses.FG_ACTIVATION;this.adapter_.removeClass(e),this.activationAnimationHasEnded_=!1,this.adapter_.computeBoundingRect()},t.prototype.resetActivationState_=function(){var e=this;this.previousActivationEvent_=this.activationState_.activationEvent,this.activationState_=this.defaultActivationState_(),setTimeout((function(){return e.previousActivationEvent_=void 0}),t.numbers.TAP_DELAY_MS)},t.prototype.deactivate_=function(){var e=this,t=this.activationState_;if(t.isActivated){var n=r({},t);t.isProgrammatic?(requestAnimationFrame((function(){return e.animateDeactivation_(n)})),this.resetActivationState_()):(this.deregisterDeactivationHandlers_(),requestAnimationFrame((function(){e.activationState_.hasDeactivationUXRun=!0,e.animateDeactivation_(n),e.resetActivationState_()})))}},t.prototype.animateDeactivation_=function(e){var t=e.wasActivatedByPointer,n=e.wasElementMadeActive;(t||n)&&this.runDeactivationUXLogicIfReady_()},t.prototype.layoutInternal_=function(){this.frame_=this.adapter_.computeBoundingRect();var e=Math.max(this.frame_.height,this.frame_.width);this.maxRadius_=this.adapter_.isUnbounded()?e:Math.sqrt(Math.pow(this.frame_.width,2)+Math.pow(this.frame_.height,2))+t.numbers.PADDING,this.initialSize_=Math.floor(e*t.numbers.INITIAL_ORIGIN_SCALE),this.fgScale_=""+this.maxRadius_/this.initialSize_,this.updateLayoutCssVars_()},t.prototype.updateLayoutCssVars_=function(){var e=t.strings,n=e.VAR_FG_SIZE,o=e.VAR_LEFT,r=e.VAR_TOP,i=e.VAR_FG_SCALE;this.adapter_.updateCssVariable(n,this.initialSize_+"px"),this.adapter_.updateCssVariable(i,this.fgScale_),this.adapter_.isUnbounded()&&(this.unboundedCoords_={left:Math.round(this.frame_.width/2-this.initialSize_/2),top:Math.round(this.frame_.height/2-this.initialSize_/2)},this.adapter_.updateCssVariable(o,this.unboundedCoords_.left+"px"),this.adapter_.updateCssVariable(r,this.unboundedCoords_.top+"px"))},t}(i);t.default=f},38:function(e,t,n){"use strict";var o,r;function i(e,t){void 0===t&&(t=!1);var n,r=e.CSS;if("boolean"==typeof o&&!t)return o;if(!r||"function"!=typeof r.supports)return!1;var i=r.supports("--css-vars","yes"),a=r.supports("(--css-vars: yes)")&&r.supports("color","#00000000");return n=!(!i&&!a||function(e){var t=e.document,n=t.createElement("div");n.className="mdc-ripple-surface--test-edge-var-bug",t.body.appendChild(n);var o=e.getComputedStyle(n),r=null!==o&&"solid"===o.borderTopStyle;return n.remove(),r}(e)),t||(o=n),n}function a(e,t){if(void 0===e&&(e=window),void 0===t&&(t=!1),void 0===r||t){var n=!1;try{e.document.addEventListener("test",(function(){}),{get passive(){return n=!0}})}catch(e){}r=n}return!!r&&{passive:!0}}function s(e,t,n){if(!e)return{x:0,y:0};var o,r,i=t.x,a=t.y,s=i+n.left,c=a+n.top;if("touchstart"===e.type){var u=e;o=u.changedTouches[0].pageX-s,r=u.changedTouches[0].pageY-c}else{var l=e;o=l.pageX-s,r=l.pageY-c}return{x:o,y:r}}n.r(t),n.d(t,"supportsCssVariables",(function(){return i})),n.d(t,"applyPassive",(function(){return a})),n.d(t,"getNormalizedEventCoords",(function(){return s}))}}))},216:(e,t)=>{var n;!function(){"use strict";var o={}.hasOwnProperty;function r(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var i=typeof n;if("string"===i||"number"===i)e.push(n);else if(Array.isArray(n)){if(n.length){var a=r.apply(null,n);a&&e.push(a)}}else if("object"===i)if(n.toString===Object.prototype.toString)for(var s in n)o.call(n,s)&&n[s]&&e.push(s);else e.push(n.toString())}}return e.join(" ")}e.exports?(r.default=r,e.exports=r):void 0===(n=function(){return r}.apply(t,[]))||(e.exports=n)}()},7284:(e,t,n)=>{"use strict";var o=n(8686);function r(){}function i(){}i.resetWarningCache=r,e.exports=function(){function e(e,t,n,r,i,a){if(a!==o){var s=new Error("Calling PropTypes validators directly is not supported by the `prop-types` package. Use PropTypes.checkPropTypes() to call them. Read more at http://fb.me/use-check-prop-types");throw s.name="Invariant Violation",s}}function t(){return e}e.isRequired=e;var n={array:e,bool:e,func:e,number:e,object:e,string:e,symbol:e,any:e,arrayOf:t,element:e,elementType:e,instanceOf:t,node:e,objectOf:t,oneOf:t,oneOfType:t,shape:t,exact:t,checkPropTypes:i,resetWarningCache:r};return n.PropTypes=n,n}},6562:(e,t,n)=>{e.exports=n(7284)()},8686:e=>{"use strict";e.exports="SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED"},39:(e,t,n)=>{"use strict";n.d(t,{default:()=>b});var o=n(7363),r=n.n(o),i=n(6562),a=n.n(i);function s(){var e=this.constructor.getDerivedStateFromProps(this.props,this.state);null!=e&&this.setState(e)}function c(e){this.setState(function(t){var n=this.constructor.getDerivedStateFromProps(e,t);return null!=n?n:null}.bind(this))}function u(e,t){try{var n=this.props,o=this.state;this.props=e,this.state=t,this.__reactInternalSnapshotFlag=!0,this.__reactInternalSnapshot=this.getSnapshotBeforeUpdate(n,o)}finally{this.props=n,this.state=o}}function l(){return l=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},l.apply(this,arguments)}function p(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}function d(e,t){return(d=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}function f(e,t){return!t||"object"!=typeof t&&"function"!=typeof t?h(e):t}function h(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}function v(e){return(v=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function m(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}s.__suppressDeprecationWarning=!0,c.__suppressDeprecationWarning=!0,u.__suppressDeprecationWarning=!0;var _=n(216),y=function(e){!function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&d(e,t)}(c,e);var t,n,o,i,a,s=(i=c,a=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}(),function(){var e,t=v(i);if(a){var n=v(this).constructor;e=Reflect.construct(t,arguments,n)}else e=t.apply(this,arguments);return f(this,e)});function c(e){var t;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,c),m(h(t=s.call(this,e)),"handleClick",(function(e){var n=t.state.checked,o=t.props.onClick,r=!n;t.setChecked(r,e),o&&o(r,e)})),m(h(t),"handleKeyDown",(function(e){37===e.keyCode?t.setChecked(!1,e):39===e.keyCode&&t.setChecked(!0,e)})),m(h(t),"handleMouseUp",(function(e){var n=t.props.onMouseUp;t.node&&t.node.blur(),n&&n(e)})),m(h(t),"saveNode",(function(e){t.node=e}));var n;return n="checked"in e?!!e.checked:!!e.defaultChecked,t.state={checked:n},t}return t=c,o=[{key:"getDerivedStateFromProps",value:function(e){var t={},n=e.checked;return"checked"in e&&(t.checked=!!n),t}}],(n=[{key:"componentDidMount",value:function(){var e=this.props,t=e.autoFocus,n=e.disabled;t&&!n&&this.focus()}},{key:"setChecked",value:function(e,t){var n=this.props,o=n.disabled,r=n.onChange;o||("checked"in this.props||this.setState({checked:e}),r&&r(e,t))}},{key:"focus",value:function(){this.node.focus()}},{key:"blur",value:function(){this.node.blur()}},{key:"render",value:function(){var e,t=this.props,n=t.className,o=t.prefixCls,i=t.disabled,a=t.loadingIcon,s=t.checkedChildren,c=t.unCheckedChildren,u=function(e,t){if(null==e)return{};var n,o,r=function(e,t){if(null==e)return{};var n,o,r={},i=Object.keys(e);for(o=0;o<i.length;o++)n=i[o],t.indexOf(n)>=0||(r[n]=e[n]);return r}(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(o=0;o<i.length;o++)n=i[o],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(r[n]=e[n])}return r}(t,["className","prefixCls","disabled","loadingIcon","checkedChildren","unCheckedChildren"]),p=this.state.checked,d=_((m(e={},n,!!n),m(e,o,!0),m(e,"".concat(o,"-checked"),p),m(e,"".concat(o,"-disabled"),i),e));return r().createElement("button",l({},u,{type:"button",role:"switch","aria-checked":p,disabled:i,className:d,ref:this.saveNode,onKeyDown:this.handleKeyDown,onClick:this.handleClick,onMouseUp:this.handleMouseUp}),a,r().createElement("span",{className:"".concat(o,"-inner")},p?s:c))}}])&&p(t.prototype,n),o&&p(t,o),c}(o.Component);y.propTypes={className:a().string,prefixCls:a().string,disabled:a().bool,checkedChildren:a().any,unCheckedChildren:a().any,onChange:a().func,onMouseUp:a().func,onClick:a().func,tabIndex:a().number,checked:a().bool,defaultChecked:a().bool,autoFocus:a().bool,loadingIcon:a().node},y.defaultProps={prefixCls:"rc-switch",checkedChildren:null,unCheckedChildren:null,className:"",defaultChecked:!1},function(e){var t=e.prototype;if(!t||!t.isReactComponent)throw new Error("Can only polyfill class components");if("function"!=typeof e.getDerivedStateFromProps&&"function"!=typeof t.getSnapshotBeforeUpdate)return e;var n=null,o=null,r=null;if("function"==typeof t.componentWillMount?n="componentWillMount":"function"==typeof t.UNSAFE_componentWillMount&&(n="UNSAFE_componentWillMount"),"function"==typeof t.componentWillReceiveProps?o="componentWillReceiveProps":"function"==typeof t.UNSAFE_componentWillReceiveProps&&(o="UNSAFE_componentWillReceiveProps"),"function"==typeof t.componentWillUpdate?r="componentWillUpdate":"function"==typeof t.UNSAFE_componentWillUpdate&&(r="UNSAFE_componentWillUpdate"),null!==n||null!==o||null!==r){var i=e.displayName||e.name,a="function"==typeof e.getDerivedStateFromProps?"getDerivedStateFromProps()":"getSnapshotBeforeUpdate()";throw Error("Unsafe legacy lifecycles will not be called for components using new component APIs.\n\n"+i+" uses "+a+" but also contains the following legacy lifecycles:"+(null!==n?"\n  "+n:"")+(null!==o?"\n  "+o:"")+(null!==r?"\n  "+r:"")+"\n\nThe above lifecycles should be removed. Learn more about this warning here:\nhttps://fb.me/react-async-component-lifecycle-hooks")}if("function"==typeof e.getDerivedStateFromProps&&(t.componentWillMount=s,t.componentWillReceiveProps=c),"function"==typeof t.getSnapshotBeforeUpdate){if("function"!=typeof t.componentDidUpdate)throw new Error("Cannot polyfill getSnapshotBeforeUpdate() for components that do not define componentDidUpdate() on the prototype");t.componentWillUpdate=u;var l=t.componentDidUpdate;t.componentDidUpdate=function(e,t,n){var o=this.__reactInternalSnapshotFlag?this.__reactInternalSnapshot:n;l.call(this,e,t,o)}}}(y);const b=y},1072:(e,t,n)=>{e.exports=n(39)},7363:e=>{"use strict";e.exports=React}},t={};function n(o){var r=t[o];if(void 0!==r)return r.exports;var i=t[o]={exports:{}};return e[o].call(i.exports,i,i.exports,n),i.exports}n.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return n.d(t,{a:t}),t},n.d=(e,t)=>{for(var o in t)n.o(t,o)&&!n.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},n.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{"use strict";var e=n(7363),t=n.n(e);const o=ReactDOM;var r=n.n(o);const{__:i}=wp.i18n,a=()=>t().createElement("header",{className:"eb-admin-header"},t().createElement("h4",null,i("Blocks Controller","essential-blocks")),t().createElement("p",null,i("Disable the blocks you are not using to minimize resource loading","essential-blocks")));var s=n(1072),c=n(3783),u=n.n(c);const{__:l}=wp.i18n,p=()=>t().createElement("div",{id:"eb-save-admin-options"},t().createElement(u(),{raised:!0},l("Save","essential-blocks")));var d=Object.defineProperty,f=Object.getOwnPropertySymbols,h=Object.prototype.hasOwnProperty,v=Object.prototype.propertyIsEnumerable,m=(e,t,n)=>t in e?d(e,t,{enumerable:!0,configurable:!0,writable:!0,value:n}):e[t]=n,_=(e,t)=>{for(var n in t||(t={}))h.call(t,n)&&m(e,n,t[n]);if(f)for(var n of f(t))v.call(t,n)&&m(e,n,t[n]);return e},y=(e,t,n)=>(m(e,"symbol"!=typeof t?t+"":t,n),n);const{all_blocks:b}=EssentialBlocksAdmin;class g extends e.Component{constructor(e){super(e),y(this,"onEnableAllClick",(()=>{let e=_({},this.state.blocks);Object.keys(e).map((t=>e[t].visibility="true")),this.setState({blocks:e})})),y(this,"onDisableAllClick",(()=>{let e=_({},this.state.blocks);Object.keys(e).map((t=>e[t].visibility="false")),this.setState({blocks:e})})),y(this,"onChange",((e,t)=>{let n=_({},this.state.blocks);Object.keys(n).map((o=>n[o].value===t&&(n[o].visibility=String(e)))),this.setState({blocks:n})})),this.state={blocks:{},enabledBlocks:{}}}componentDidMount(){let e=b;if(Object.keys(e).length){let t=_({},this.state.enabledBlocks);Object.keys(e).map((n=>{"true"===e[n].visibility&&(t[e[n].value]=n)})),this.setState({blocks:e,enabledBlocks:t})}}render(){const{blocks:e}=this.state;return[t().createElement("div",{className:"eb-admin-global-control"},t().createElement("div",{className:"eb-admin-button eb-admin-button-enable",onClick:()=>this.onEnableAllClick()},"Enable All"),t().createElement("div",{className:"eb-admin-button eb-admin-button-disable",onClick:()=>this.onDisableAllClick()},"Disable All")),t().createElement("div",{className:"eb-admin-checkboxes-wrapper"},Object.keys(e).map(((n,o)=>t().createElement("div",{key:o,className:"eb-admin-checkbox"},t().createElement("label",{htmlFor:e[n].value,className:"eb-admin-checkbox-label"},e[n].label,t().createElement(s.default,{checked:"true"==e[n].visibility,onChange:t=>this.onChange(t,e[n].value),defaultChecked:"true"==e[n].visibility,disabled:!1,checkedChildren:"ON",unCheckedChildren:"OFF"})))))),t().createElement(p,null)]}}const S=()=>t().createElement("div",null,t().createElement(a,null),t().createElement(g,null));r().render(t().createElement(S,null),document.getElementById("admin-root"))})()})();