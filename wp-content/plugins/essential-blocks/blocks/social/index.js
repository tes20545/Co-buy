(()=>{"use strict";(()=>{function e({profilesOnly:e,icnEffect:t}){return React.createElement("ul",{className:"socials"},e.map((({link:e,icon:l})=>React.createElement("li",null,React.createElement("a",{className:`${((l||" ").match(/fa-([\w\-]+)/i)||[" "," "])[1]}-original ${t||" "}`,href:e},React.createElement("i",{className:`hvr-icon social-icon ${l}`}))))))}const t="wrpMrg_",l="wrpPad_",a="WrpBg_",n="wrpBdSd_",s="sclBdSd_",o="wrpW_",r="icnZ_",i="icnPd_",c="icnSp_",b="icnRg_",p="sdpr_";var u=Object.defineProperty,d=Object.getOwnPropertySymbols,v=Object.prototype.hasOwnProperty,m=Object.prototype.propertyIsEnumerable,k=(e,t,l)=>t in e?u(e,t,{enumerable:!0,configurable:!0,writable:!0,value:l}):e[t]=l,f=(e,t)=>{for(var l in t||(t={}))v.call(t,l)&&k(e,l,t[l]);if(d)for(var l of d(t))m.call(t,l)&&k(e,l,t[l]);return e};const{generateDimensionsAttributes:h,generateBackgroundAttributes:g,generateBorderShadowAttributes:y,generateResponsiveRangeAttributes:w}=eb_controls,R=f(f(f(f(f(f(f(f(f(f(f({resOption:{type:"string",default:"Desktop"},blockId:{type:"string"},blockRoot:{type:"string",default:"essential_block"},blockMeta:{type:"object"},socialDetails:{type:"array",default:[]},profilesOnly:{type:"array"},iconsJustify:{type:"string",default:"center"},iconsVAlign:{type:"string",default:"center"},isIconsDevider:{type:"boolean",default:!1},icnsDevideColor:{type:"string"},icnSepW:{type:"number",default:1},icnSepH:{type:"number",default:30},hvIcnColor:{type:"string"},hvIcnBgc:{type:"string"},icnEffect:{type:"string"},textShadowColor:{type:"string"},textHOffset:{type:"number"},textVOffset:{type:"number"},blurRadius:{type:"number"}},w(r,{defaultRange:35,noUnits:!0})),w(i,{defaultRange:1,noUnits:!0})),w(c,{defaultRange:20,noUnits:!0})),w(b,{noUnits:!0})),w(o,{defaultUnit:"%",defaultRange:100})),w(p,{defaultRange:23})),g(a,{defaultBgGradient:"linear-gradient(45deg,#7967ff,#c277f2)"})),y(n,{})),y(s,{bdrDefaults:{top:1,bottom:1,right:1,left:1}})),h(t)),h(l,{top:20,bottom:20,left:20,right:20})),{__:S}=wp.i18n,$=[{label:"Center",value:"center"},{label:"Left",value:"flex-start"},{label:"Right",value:"flex-end"},{label:"Space Between",value:"space-between"},{label:"Space Around",value:"space-around"},{label:"Space Evenly",value:"space-evenly"}],E=[{label:S("Select Hover Effect","essential-blocks"),value:""},{label:S("Grow","essential-blocks"),value:"hvr-grow"},{label:S("Shrink","essential-blocks"),value:"hvr-shrink"},{label:S("Pulse","essential-blocks"),value:"hvr-pulse"},{label:S("Pulse Grow","essential-blocks"),value:"hvr-pulse-grow"},{label:S("Pulse Shrink","essential-blocks"),value:"hvr-pulse-shrink"},{label:S("Push","essential-blocks"),value:"hvr-push"},{label:S("Pop","essential-blocks"),value:"hvr-pop"},{label:S("Bounce In","essential-blocks"),value:"hvr-bounce-in"},{label:S("Bounce Out","essential-blocks"),value:"hvr-bounce-out"},{label:S("Rotate","essential-blocks"),value:"hvr-rotate"},{label:S("Grow Rotate","essential-blocks"),value:"hvr-grow-rotate"},{label:S("Float","essential-blocks"),value:"hvr-float"},{label:S("Sink","essential-blocks"),value:"hvr-sink"},{label:S("Bob","essential-blocks"),value:"hvr-bob"},{label:S("Hang","essential-blocks"),value:"hvr-hang"},{label:S("Skew","essential-blocks"),value:"hvr-skew"},{label:S("Skew Forward","essential-blocks"),value:"hvr-skew-forward"},{label:S("Skew Backward","essential-blocks"),value:"hvr-skew-backward"},{label:S("Wobble Horizontal","essential-blocks"),value:"hvr-wobble-horizontal"},{label:S("Wobble Vertical","essential-blocks"),value:"hvr-wobble-vertical"},{label:S("Wobble To Bottom Right","essential-blocks"),value:"hvr-wobble-to-bottom-right"},{label:S("Wobble To Top Right","essential-blocks"),value:"hvr-wobble-to-top-right"},{label:S("Wobble Top","essential-blocks"),value:"hvr-wobble-top"},{label:S("Wobble Bottom","essential-blocks"),value:"hvr-wobble-bottom"},{label:S("Wobble Skew","essential-blocks"),value:"hvr-wobble-skew"},{label:S("Buzz","essential-blocks"),value:"hvr-buzz"},{label:S("Buzz Out","essential-blocks"),value:"hvr-buzz-out"},{label:S("Forward","essential-blocks"),value:"hvr-forward"},{label:S("Fade","essential-blocks"),value:"hvr-fade"},{label:S("Back Pulse","essential-blocks"),value:"hvr-back-pulse"},{label:S("Sweep To Right","essential-blocks"),value:"hvr-sweep-to-right"},{label:S("Sweep To Left","essential-blocks"),value:"hvr-sweep-to-left"},{label:S("Sweep To Bottom","essential-blocks"),value:"hvr-sweep-to-bottom"},{label:S("Sweep To Top","essential-blocks"),value:"hvr-sweep-to-top"},{label:S("Bounce To Right","essential-blocks"),value:"hvr-bounce-to-right"},{label:S("Bounce To Left","essential-blocks"),value:"hvr-bounce-to-left"},{label:S("Bounce To Bottom","essential-blocks"),value:"hvr-bounce-to-bottom"},{label:S("Bounce To Top","essential-blocks"),value:"hvr-bounce-to-top"},{label:S("Radial Out","essential-blocks"),value:"hvr-radial-out"},{label:S("Radial In","essential-blocks"),value:"hvr-radial-in"},{label:S("Rectangle In","essential-blocks"),value:"hvr-rectangle-in"},{label:S("Rectangle Out","essential-blocks"),value:"hvr-rectangle-out"},{label:S("Shutter In Horizontal","essential-blocks"),value:"hvr-shutter-in-horizontal"},{label:S("Shutter Out Horizontal","essential-blocks"),value:"hvr-shutter-out-horizontal"},{label:S("Shutter In Vertical","essential-blocks"),value:"hvr-shutter-in-vertical"},{label:S("Shutter Out Vertical","essential-blocks"),value:"hvr-shutter-out-vertical"},{label:S("Icon Back","essential-blocks"),value:"hvr-icon-back"},{label:S("Icon Forward","essential-blocks"),value:"hvr-icon-forward"},{label:S("Icon Down","essential-blocks"),value:"hvr-icon-down"},{label:S("Icon Up","essential-blocks"),value:"hvr-icon-up"},{label:S("Icon Spin","essential-blocks"),value:"hvr-icon-spin"},{label:S("Icon Drop","essential-blocks"),value:"hvr-icon-drop"},{label:S("Icon Fade","essential-blocks"),value:"hvr-icon-fade"},{label:S("Icon Float Away","essential-blocks"),value:"hvr-icon-float-away"},{label:S("Icon Sink Away","essential-blocks"),value:"hvr-icon-sink-away"},{label:S("Icon Grow","essential-blocks"),value:"hvr-icon-grow"},{label:S("Icon Shrink","essential-blocks"),value:"hvr-icon-shrink"},{label:S("Icon Pulse","essential-blocks"),value:"hvr-icon-pulse"},{label:S("Icon Pulse Grow","essential-blocks"),value:"hvr-icon-pulse-grow"},{label:S("Icon Pulse Shrink","essential-blocks"),value:"hvr-icon-pulse-shrink"},{label:S("Icon Push","essential-blocks"),value:"hvr-icon-push"},{label:S("Icon Pop","essential-blocks"),value:"hvr-icon-pop"},{label:S("Icon Bounce","essential-blocks"),value:"hvr-icon-bounce"},{label:S("Icon Rotate","essential-blocks"),value:"hvr-icon-rotate"},{label:S("Icon Grow Rotate","essential-blocks"),value:"hvr-icon-grow-rotate"},{label:S("Icon Float","essential-blocks"),value:"hvr-icon-float"},{label:S("Icon Sink","essential-blocks"),value:"hvr-icon-sink"},{label:S("Icon Bob","essential-blocks"),value:"hvr-icon-bob"},{label:S("Icon Hang","essential-blocks"),value:"hvr-icon-hang"},{label:S("Icon Wobble Horizontal","essential-blocks"),value:"hvr-icon-wobble-horizontal"},{label:S("Icon Wobble Vertical","essential-blocks"),value:"hvr-icon-wobble-vertical"},{label:S("Icon Buzz","essential-blocks"),value:"hvr-icon-buzz"},{label:S("Icon Buzz Out","essential-blocks"),value:"hvr-icon-buzz-out"},{label:S("Curl Top Left","essential-blocks"),value:"hvr-curl-top-left"},{label:S("Curl Top Right","essential-blocks"),value:"hvr-curl-top-right"},{label:S("Curl Bottom Right","essential-blocks"),value:"hvr-curl-bottom-right"},{label:S("Curl Bottom Left","essential-blocks"),value:"hvr-curl-bottom-left"}],O=[{label:S("Rounded","essential-blocks"),value:"rounded"},{label:S("Circular","essential-blocks"),value:"circular"},{label:S("Square","essential-blocks"),value:"square"}];var B=Object.defineProperty,_=Object.defineProperties,x=Object.getOwnPropertyDescriptors,I=Object.getOwnPropertySymbols,C=Object.prototype.hasOwnProperty,P=Object.prototype.propertyIsEnumerable,D=(e,t,l)=>t in e?B(e,t,{enumerable:!0,configurable:!0,writable:!0,value:l}):e[t]=l;const{__:T}=wp.i18n,{InspectorControls:N}=wp.blockEditor,{useEffect:z}=wp.element,{select:M}=wp.data,{PanelBody:j,SelectControl:H,ToggleControl:U,RangeControl:G,BaseControl:L,TabPanel:A,Button:F,ButtonGroup:V}=wp.components,{mimmikCssForResBtns:W,mimmikCssOnPreviewBtnClickWhileBlockSelected:q,ResponsiveDimensionsControl:J,ResponsiveRangeController:K,ColorControl:X,BorderShadowControl:Z,BackgroundControl:Q,DealSocialProfiles:Y,faIcons:ee,ResetControl:te}=eb_controls,le=function({attributes:e,setAttributes:o}){const{resOption:u,socialDetails:d,iconsJustify:v,isIconsDevider:m,icnsDevideColor:k,icnSepW:f,icnSepH:h,hvIcnColor:g,hvIcnBgc:y,icnEffect:w,iconShape:S,textShadowColor:B,textHOffset:le,textVOffset:ae,blurRadius:ne}=e;z((()=>{o({resOption:M("core/edit-post").__experimentalGetPreviewDeviceType()})}),[]),z((()=>{W({domObj:document,resOption:u})}),[u]),z((()=>{const e=q({domObj:document,select:M,setAttributes:o});return()=>{e()}}),[]),z((()=>{const e=d.map((e=>{return t=((e,t)=>{for(var l in t||(t={}))C.call(t,l)&&D(e,l,t[l]);if(I)for(var l of I(t))P.call(t,l)&&D(e,l,t[l]);return e})({},e),_(t,x({isExpanded:!1}));var t}));o({socialDetails:e})}),[]);const se={setAttributes:o,resOption:u,attributes:e,objAttributes:R};return React.createElement(N,{key:"controls"},React.createElement("div",{className:"eb-panel-control"},React.createElement(A,{className:"eb-parent-tab-panel",activeClass:"active-tab",tabs:[{name:"general",title:"General",className:"eb-tab general"},{name:"styles",title:"Style",className:"eb-tab styles"},{name:"advance",title:"Advanced",className:"eb-tab advance"}]},(e=>React.createElement("div",{className:"eb-tab-controls"+e.name},"general"===e.name&&React.createElement(React.Fragment,null,React.createElement(j,{title:T("Social Profiles","essential-blocks")},React.createElement(React.Fragment,null,React.createElement(Y,{profiles:d,onProfileAdd:e=>o({socialDetails:e}),iconList:ee})))),"styles"===e.name&&React.createElement(React.Fragment,null,React.createElement(j,{title:T("Icons Styles","essential-blocks")},React.createElement(L,{label:T("Icon Shape","essential-blocks")},React.createElement(V,null,O.map((e=>React.createElement(F,{isLarge:!0,isSecondary:S!==e.value,isPrimary:S===e.value,onClick:()=>(e=>{switch(e){case"rounded":o({iconShape:e,sclBdSd_Rds_Bottom:"10",sclBdSd_Rds_Left:"10",sclBdSd_Rds_Right:"10",sclBdSd_Rds_Top:"10",sclBdSd_Rds_Unit:"px",sclBdSd_Rds_isLinked:!0});break;case"circular":o({iconShape:e,sclBdSd_Rds_Bottom:"50",sclBdSd_Rds_Left:"50",sclBdSd_Rds_Right:"50",sclBdSd_Rds_Top:"50",sclBdSd_Rds_Unit:"%",sclBdSd_Rds_isLinked:!0});break;case"square":o({iconShape:e,sclBdSd_Rds_Bottom:void 0,sclBdSd_Rds_Left:void 0,sclBdSd_Rds_Right:void 0,sclBdSd_Rds_Top:void 0,sclBdSd_Rds_Unit:"px",sclBdSd_Rds_isLinked:!0})}})(e.value)},e.label))))),React.createElement(L,{id:"eb-team-icons-alignments",label:"Social Icons Horizontal Alignments"},React.createElement(H,{value:v,options:$,onChange:e=>o({iconsJustify:e})})),React.createElement(K,{noUnits:!0,baseLabel:T("Size","essential-blocks"),controlName:r,resRequiredProps:se,min:5,max:300,step:1}),React.createElement(K,{noUnits:!0,baseLabel:T("Padding","essential-blocks"),controlName:i,resRequiredProps:se,min:0,max:6,step:.1}),React.createElement(K,{noUnits:!0,baseLabel:T("Spacing","essential-blocks"),controlName:c,resRequiredProps:se,min:0,max:100,step:1}),React.createElement(K,{noUnits:!0,baseLabel:T("Rows Gap","essential-blocks"),controlName:b,resRequiredProps:se,min:0,max:100,step:1}),React.createElement("label",{style:{display:"block",margin:"-20px 0 20px"}},React.createElement("i",null,"N.B. 'Rows Gap' is used when you have multiple rows of social profiles. Normally in case of only one row, it's not needed")),React.createElement(U,{label:T("Icons Devider","essential-blocks"),checked:m,onChange:()=>o({isIconsDevider:!m})}),m&&React.createElement(React.Fragment,null,React.createElement(X,{label:T("Color","essential-blocks"),color:k,onChange:e=>o({icnsDevideColor:e})}),React.createElement(G,{label:T("Width","essential-blocks"),value:f,onChange:e=>o({icnSepW:e}),step:1,min:1,max:50}),React.createElement(G,{label:T("Height","essential-blocks"),value:h,onChange:e=>o({icnSepH:e}),step:1,min:1,max:300}),React.createElement(K,{baseLabel:T("Position From Right","essential-blocks"),controlName:p,resRequiredProps:se,min:0,max:80,step:1})),React.createElement(X,{label:T("Hover Color","essential-blocks"),color:g,onChange:e=>o({hvIcnColor:e})}),React.createElement(X,{label:T("Hover Background","essential-blocks"),color:y,onChange:e=>o({hvIcnBgc:e})}),React.createElement(H,{label:T("Icon Hover Effect","essential-blocks"),value:w,options:E,onChange:e=>{o({icnEffect:e})}})),React.createElement(j,{title:T("Icons Border & Box-Shadow"),initialOpen:!1},React.createElement(Z,{controlName:s,resRequiredProps:se})),React.createElement(j,{title:T("Icons Shadow","essential-blocks"),initialOpen:!1},React.createElement(X,{label:T("Shadow Color","essential-blocks"),color:B,onChange:e=>o({textShadowColor:e})}),React.createElement(te,{onReset:()=>o({textHOffset:void 0})},React.createElement(G,{label:T("Horizontal Offset","essential-blocks"),value:le,onChange:e=>o({textHOffset:e}),min:0,max:100})),React.createElement(te,{onReset:()=>o({textVOffset:void 0})},React.createElement(G,{label:T("Vertical Offset","essential-blocks"),value:ae,onChange:e=>o({textVOffset:e}),min:0,max:100})),React.createElement(te,{onReset:()=>o({blurRadius:void 0})},React.createElement(G,{label:T("Blur Radius","essential-blocks"),value:ne,onChange:e=>o({blurRadius:e}),min:0,max:100})))),"advance"===e.name&&React.createElement(React.Fragment,null,React.createElement(j,{title:T("Margin & Padding")},React.createElement(J,{resRequiredProps:se,controlName:t,baseLabel:"Margin"}),React.createElement(J,{resRequiredProps:se,controlName:l,baseLabel:"Padding"})),React.createElement(j,{title:T("Background ","essential-blocks"),initialOpen:!1},React.createElement(Q,{controlName:a,resRequiredProps:se})),React.createElement(j,{title:T("Border & Shadow"),initialOpen:!1},React.createElement(Z,{controlName:n,resRequiredProps:se}))))))))};var ae=Object.defineProperty,ne=Object.defineProperties,se=Object.getOwnPropertyDescriptors,oe=Object.getOwnPropertySymbols,re=Object.prototype.hasOwnProperty,ie=Object.prototype.propertyIsEnumerable,ce=(e,t,l)=>t in e?ae(e,t,{enumerable:!0,configurable:!0,writable:!0,value:l}):e[t]=l,be=(e,t)=>{for(var l in t||(t={}))re.call(t,l)&&ce(e,l,t[l]);if(oe)for(var l of oe(t))ie.call(t,l)&&ce(e,l,t[l]);return e};const{__:pe}=wp.i18n,{useBlockProps:ue}=wp.blockEditor,{useEffect:de}=wp.element,{select:ve}=wp.data,{softMinifyCssStrings:me,generateBackgroundControlStyles:ke,generateDimensionsControlStyles:fe,generateBorderShadowStyles:he,generateResponsiveRangeStyles:ge,mimmikCssForPreviewBtnClick:ye,duplicateBlockIdFix:we}=eb_controls;var Re=Object.defineProperty,Se=Object.getOwnPropertySymbols,$e=Object.prototype.hasOwnProperty,Ee=Object.prototype.propertyIsEnumerable,Oe=(e,t,l)=>t in e?Re(e,t,{enumerable:!0,configurable:!0,writable:!0,value:l}):e[t]=l;const{useBlockProps:Be}=wp.blockEditor,_e=JSON.parse('{"title":"Social Icons","name":"essential-blocks/social","category":"essential-blocks","description":"Add icon links to your social media profiles and grow your audience with animated social icons","apiVersion":2,"textdomain":"essential-blocks","supports":{"align":["wide","full"]}}');var xe=Object.defineProperty,Ie=Object.getOwnPropertySymbols,Ce=Object.prototype.hasOwnProperty,Pe=Object.prototype.propertyIsEnumerable,De=(e,t,l)=>t in e?xe(e,t,{enumerable:!0,configurable:!0,writable:!0,value:l}):e[t]=l;const{__:Te}=wp.i18n,{registerBlockType:Ne}=wp.blocks,{name:ze}=_e;Ne(((e,t)=>{for(var l in t||(t={}))Ce.call(t,l)&&De(e,l,t[l]);if(Ie)for(var l of Ie(t))Pe.call(t,l)&&De(e,l,t[l]);return e})({name:ze},_e),{icon:()=>React.createElement("svg",{xmlns:"http://www.w3.org/2000/svg",id:"eb-social",viewBox:"0 0 64 64"},React.createElement("linearGradient",{id:"SVGID_1__44048",gradientUnits:"userSpaceOnUse",x1:"28",y1:"38.167",x2:"28",y2:"49.844",spreadMethod:"reflect"},React.createElement("stop",{offset:"0",stopColor:"#6dc7ff"}),React.createElement("stop",{offset:"1",stopColor:"#e6abff"})),React.createElement("circle",{cx:"28",cy:"44",r:"5",fill:"url(#SVGID_1__44048)"}),React.createElement("linearGradient",{id:"SVGID_2__44048",gradientUnits:"userSpaceOnUse",x1:"32",y1:"10",x2:"32",y2:"56.363",spreadMethod:"reflect"},React.createElement("stop",{offset:"0",stopColor:"#1a6dff"}),React.createElement("stop",{offset:"1",stopColor:"#c822ff"})),React.createElement("path",{d:"M49,11c-6.617,0-12,5.383-12,12c0,2.949,1.074,5.649,2.845,7.741l-6.234,6.234 C32.071,35.742,30.122,35,28,35s-4.071,0.742-5.611,1.975l-5.077-5.077C18.366,30.542,19,28.846,19,27c0-4.411-3.589-8-8-8 s-8,3.589-8,8s3.589,8,8,8c1.846,0,3.542-0.634,4.897-1.688l5.077,5.077C19.742,39.929,19,41.878,19,44c0,4.963,4.037,9,9,9 s9-4.037,9-9c0-2.122-0.742-4.071-1.975-5.611l6.234-6.234C43.351,33.926,46.051,35,49,35c6.617,0,12-5.383,12-12S55.617,11,49,11z M11,33c-3.309,0-6-2.691-6-6s2.691-6,6-6s6,2.691,6,6S14.309,33,11,33z M28,51c-3.859,0-7-3.141-7-7s3.141-7,7-7s7,3.141,7,7 S31.859,51,28,51z M49,33c-5.514,0-10-4.486-10-10s4.486-10,10-10s10,4.486,10,10S54.514,33,49,33z",fill:"url(#SVGID_2__44048)"}),React.createElement("linearGradient",{id:"SVGID_3__44048",gradientUnits:"userSpaceOnUse",x1:"49",y1:"10",x2:"49",y2:"56.363",spreadMethod:"reflect"},React.createElement("stop",{offset:"0",stopColor:"#1a6dff"}),React.createElement("stop",{offset:"1",stopColor:"#c822ff"})),React.createElement("path",{d:"M49,15c-4.411,0-8,3.589-8,8s3.589,8,8,8s8-3.589,8-8S53.411,15,49,15z M49,29 c-3.309,0-6-2.691-6-6s2.691-6,6-6s6,2.691,6,6S52.309,29,49,29z",fill:"url(#SVGID_3__44048)"})),attributes:R,keywords:[Te("social","essential-blocks"),Te("icons","essential-blocks"),Te("eb essential","essential-blocks")],edit:function({attributes:u,setAttributes:d,isSelected:v,clientId:m}){const{resOption:k,blockId:f,blockMeta:h,socialDetails:g,profilesOnly:y=[],iconsJustify:w,iconsVAlign:R,isIconsDevider:S,icnsDevideColor:$="#cacaca",icnSepW:E=1,icnSepH:O=30,hvIcnColor:B,hvIcnBgc:_,icnEffect:x,textShadowColor:I,textHOffset:C,textVOffset:P,blurRadius:D}=u;de((()=>{const e=g.map((e=>{return t=be({},e),ne(t,se({isExpanded:!1}));var t}));d({socialDetails:e}),g.length>0||d({socialDetails:[{icon:"fab fa-facebook-f",link:"#",isExpanded:!1},{icon:"fab fa-twitter",link:"#",isExpanded:!1},{icon:"fab fa-instagram",link:"#",isExpanded:!1},{icon:"fab fa-youtube",link:"#",isExpanded:!1},{icon:"fab fa-linkedin-in",link:"#",isExpanded:!1}]})}),[]),de((()=>{const e=g.map((({icon:e,link:t})=>({icon:e,link:t})));d({profilesOnly:e})}),[g]),de((()=>{d({resOption:ve("core/edit-post").__experimentalGetPreviewDeviceType()})}),[]),de((()=>{we({BLOCK_PREFIX:"eb-social-links",blockId:f,setAttributes:d,select:ve,clientId:m})}),[]),de((()=>{ye({domObj:document,select:ve})}),[]);const T=ue({className:"eb-guten-block-main-parent-wrapper"}),{rangeStylesDesktop:N,rangeStylesTab:z,rangeStylesMobile:M}=ge({controlName:o,property:"max-width",attributes:u}),{rangeStylesDesktop:j,rangeStylesTab:H,rangeStylesMobile:U}=ge({controlName:r,customUnit:"px",property:"font-size",attributes:u}),{rangeStylesDesktop:G,rangeStylesTab:L,rangeStylesMobile:A}=ge({controlName:i,customUnit:"em",property:"padding",attributes:u}),{rangeStylesDesktop:F,rangeStylesTab:V,rangeStylesMobile:W}=ge({controlName:c,customUnit:"px",property:"column-gap",attributes:u}),{rangeStylesDesktop:q,rangeStylesTab:J,rangeStylesMobile:K}=ge({controlName:b,customUnit:"px",property:"row-gap",attributes:u}),{rangeStylesDesktop:X,rangeStylesTab:Z,rangeStylesMobile:Q}=ge({controlName:p,property:"margin-right",attributes:u}),{backgroundStylesDesktop:Y,hoverBackgroundStylesDesktop:ee,backgroundStylesTab:te,hoverBackgroundStylesTab:ae,backgroundStylesMobile:oe,hoverBackgroundStylesMobile:re,overlayStylesDesktop:ie,hoverOverlayStylesDesktop:ce,overlayStylesTab:pe,hoverOverlayStylesTab:Re,overlayStylesMobile:Se,hoverOverlayStylesMobile:$e,bgTransitionStyle:Ee,ovlTransitionStyle:Oe}=ke({attributes:u,controlName:a}),{dimensionStylesDesktop:Be,dimensionStylesTab:_e,dimensionStylesMobile:xe}=fe({attributes:u,controlName:t,styleFor:"margin"}),{dimensionStylesDesktop:Ie,dimensionStylesTab:Ce,dimensionStylesMobile:Pe}=fe({attributes:u,controlName:l,styleFor:"padding"}),{styesDesktop:De,styesTab:Te,styesMobile:Ne,stylesHoverDesktop:ze,stylesHoverTab:Me,stylesHoverMobile:je,transitionStyle:He}=he({controlName:n,attributes:u}),{styesDesktop:Ue,styesTab:Ge,styesMobile:Le,stylesHoverDesktop:Ae,stylesHoverTab:Fe,stylesHoverMobile:Ve,transitionStyle:We}=he({controlName:s,attributes:u}),qe=g.reduce(((e,{bgColor:t,color:l},a)=>`\n\t\t${e}\n\t\t\n\t\t${t||l?`\n\t\t\t\t.${f}.eb-social-links-wrapper ul.socials li:nth-child(${a+1}) a {\t\t\t\n\t\t\t\t\t${t?`background: ${t};`:""}\n\t\t\t\t\t${l?`color: ${l};`:""}\n\t\t\t\t}\n\t\t\t\t`:""}\n\t\t`),""),Je=`\n\t.${f}.eb-social-links-wrapper {\n\t\t${z}\n\t\t${te}\n\t\t${_e}\n\t\t${Ce}\n\t\t${Te}\n\t}\n\t\n\t.${f}.eb-social-links-wrapper:hover{\n\t\t${ae}\n\t\t${Me}\n\t\t\n\t}\n\t\n\t.${f}.eb-social-links-wrapper:before{\n\t\t${pe}\n\n\t}\n\t\n\t.${f}.eb-social-links-wrapper:hover:before{\n\t\t${Re}\n\n\t}\n\n\t.${f}.eb-social-links-wrapper ul.socials {\n\t\t${V}\n\t\t${J}\n\t}\t\n\n\t${S?`\n\t\t\t.${f}.eb-social-links-wrapper ul.socials li + li:before {\n\t\t\t\t${Z}\n\t\t\t}\n\t\t\t`:""}\n\n\t.${f}.eb-social-links-wrapper ul.socials li a {\n\t\t${H}\n\t\t${L}\n\t\t${Ge}\n\t}\n\t\n\t.${f}.eb-social-links-wrapper ul.socials li:hover a {\t\n\t\t${Fe}\n\t}\n\n\t`,Ke=`\n\t.${f}.eb-social-links-wrapper {\n\t\t${M}\n\t\t${oe}\n\t\t${xe}\n\t\t${Pe}\n\t\t${Ne}\n\t}\n\t\n\t.${f}.eb-social-links-wrapper:hover{\n\t\t${re}\n\t\t${je}\n\t\t\n\t}\n\t\n\t.${f}.eb-social-links-wrapper:before{\n\t\t${Se}\n\n\t}\n\t\n\t.${f}.eb-social-links-wrapper:hover:before{\n\t\t${$e}\n\n\t}\n\n\t.${f}.eb-social-links-wrapper ul.socials {\n\t\t${W}\n\t\t${K}\n\t}\n\n\n\t${S?`\n\t\t\t.${f}.eb-social-links-wrapper ul.socials li + li:before {\n\t\t\t\t${Q}\n\t\t\t}\n\t\t\t`:""}\n\t\t\n\t.${f}.eb-social-links-wrapper ul.socials li a {\n\t\t${U}\n\t\t${A}\n\t\t${Le}\n\t}\n\n\t\n\t.${f}.eb-social-links-wrapper ul.socials li:hover a {\t\n\t\t${Ve}\n\t}\n\n\t`,Xe=me(`\t\t\n\t\t\n\tdiv.eb-social-links-wrapper ul {\n\t\tmargin: 0;\n\t\tpadding:0;\n\t}\n\n\t.${f}.eb-social-links-wrapper {\n\t\tposition:relative;\n\t\tmargin:auto;\n\t\t${N}\n\t\t${Y}\n\t\t${Be}\n\t\t${Ie}\n\t\t${De}\n\t\ttransition: ${Ee}, ${He};\n\t}\n\n\t.${f}.eb-social-links-wrapper:hover{\n\n\t\t${ee}\n\t\t${ze}\n\t}\n\t\n\t.${f}.eb-social-links-wrapper:before{\n\t\t${ie}\n\t\ttransition: ${Oe};\n\n\t}\n\t\n\t.${f}.eb-social-links-wrapper:hover:before{\n\t\t${ce}\n\n\t}\n\t\n\t\n\t.${f}.eb-social-links-wrapper ul.socials {\n\t\tlist-style: none;\n\t\tflex-wrap: wrap;\n\t\talign-items: ${R||"center"};\n\t\tjustify-content: ${w};\n\t\t${F}\n\t\t${q}\n\t\tdisplay: flex;\n\t}\n\n\n\t${qe}\n\n\n\t${S?`\n\t\t.${f}.eb-social-links-wrapper ul.socials li{\n\t\t\tposition:relative;\n\t\t}\n\n\t\t.${f}.eb-social-links-wrapper ul.socials li + li:before {\n\t\t\tcontent: "";\n\t\t\tbackground-color: ${$};\n\t\t\theight: ${O}px;\n\t\t\twidth: ${E}px;\n\t\t\tposition: absolute;\n\t\t\ttop: 2px;\n\t\t\tright: 100%;\n\t\t\t${X}\n\t\t}\n\t\t\n\t\t`:""}\n\n\t.${f}.eb-social-links-wrapper ul.socials li a {\t\t\t\n\t\tbox-sizing:content-box;\n\t\ttext-decoration: none;\n\t\tcursor: pointer;\n\t\tdisplay: flex;\n\t\tjustify-content: center;\n\t\talign-items: center;\n\t\theight: 0;\n\t\twidth: 0;\n\t\t${C||P||D||I?`text-shadow: ${C||0}px ${P||0}px ${D||0}px ${I||"rgba(0,0,0,.5)"};`:""}\n\t\t${j}\n\t\t${G}\n\t\t${Ue}\n\t\ttransition: color 0.5s, background-color 0.5s, ${We};\n\t}\n\t\n\t.${f}.eb-social-links-wrapper ul.socials li:hover a {\t\n\t\tbackground:${B};\n\t\tcolor:${_};\n\t\t${Ae}\n\t}\n\n\n\t`),Ze=me(`\n\t\t${Je}\n\t`),Qe=me(`\n\t\t${Ke}\n\t`);return de((()=>{const e={desktop:Xe,tab:Ze,mobile:Qe};JSON.stringify(h)!=JSON.stringify(e)&&d({blockMeta:e})}),[u]),[v&&React.createElement(le,{attributes:u,setAttributes:d}),React.createElement("div",be({},T),React.createElement("style",null,`\n\t\t\t\t${Xe}\n\n\t\t\t\t/* mimmikcssStart */\n\n\t\t\t\t${"Tablet"===k?Ze:" "}\n\t\t\t\t${"Mobile"===k?Ze+Qe:" "}\n\n\t\t\t\t/* mimmikcssEnd */\n\n\t\t\t\t@media all and (max-width: 1024px) {\t\n\n\t\t\t\t\t/* tabcssStart */\t\t\t\n\t\t\t\t\t${me(Ze)}\n\t\t\t\t\t/* tabcssEnd */\t\t\t\n\t\t\t\t\n\t\t\t\t}\n\t\t\t\t\n\t\t\t\t@media all and (max-width: 767px) {\n\t\t\t\t\t\n\t\t\t\t\t/* mobcssStart */\t\t\t\n\t\t\t\t\t${me(Qe)}\n\t\t\t\t\t/* mobcssEnd */\t\t\t\n\t\t\t\t\n\t\t\t\t}\n\t\t\t\t`),React.createElement("div",{className:`${f} eb-social-links-wrapper`},React.createElement(e,{profilesOnly:y,icnEffect:x})))]},save:function({attributes:t}){const{blockId:l,profilesOnly:a=[],icnEffect:n}=t;return React.createElement("div",((e,t)=>{for(var l in t||(t={}))$e.call(t,l)&&Oe(e,l,t[l]);if(Se)for(var l of Se(t))Ee.call(t,l)&&Oe(e,l,t[l]);return e})({},Be.save()),React.createElement("div",{className:`${l} eb-social-links-wrapper`},React.createElement(e,{profilesOnly:a,icnEffect:n})))},example:{attributes:{}}})})()})();