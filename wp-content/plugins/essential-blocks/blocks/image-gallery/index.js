(()=>{"use strict";var e={d:(t,a)=>{for(var l in a)e.o(a,l)&&!e.o(t,l)&&Object.defineProperty(t,l,{enumerable:!0,get:a[l]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t),r:e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}};((e,t,a)=>{var l={};a.r(l),a.d(l,{CAPTION_TYPOGRAPHY:()=>x});var n=Object.defineProperty,o=Object.getOwnPropertySymbols,r=Object.prototype.hasOwnProperty,s=Object.prototype.propertyIsEnumerable,i=(e,t,a)=>t in e?n(e,t,{enumerable:!0,configurable:!0,writable:!0,value:a}):e[t]=a;const{useBlockProps:c}=wp.blockEditor,{__:p}=wp.i18n,m="wrprBg",g="wrpMargin",b="wrpPadding",y="wrpBorderShadow",d="columns",u="imageGap",v="imgBorderShadow",f="captionMargin",R="captionPadding",k="captionTypo",h="captionWidth",E=[{label:p("Top","essential-blocks"),value:"top"},{label:p("Middle","essential-blocks"),value:"middle"},{label:p("Bottom","essential-blocks"),value:"bottom"}],$=[{label:p("Left","essential-blocks"),value:"left"},{label:p("Center","essential-blocks"),value:"center"},{label:p("Right","essential-blocks"),value:"right"}],w=[{label:p("Left","essential-blocks"),value:"left"},{label:p("Right","essential-blocks"),value:"right"},{label:p("Center","essential-blocks"),value:"center"},{label:p("Justify","essential-blocks"),value:"justify"}],S=[{label:"px",value:"px"},{label:"%",value:"%"}],C=[{label:p("Grid Layout","essential-blocks"),value:"grid"},{label:p("Masonry Layout","essential-blocks"),value:"masonry"}],O=[{label:p("None","essential-blocks"),value:"0"},{label:p("Black & White"),value:"1"},{label:p("Color Overlay","essential-blocks"),value:"2"}],N=[{label:p("From Top","essential-blocks"),value:"overlay-top"},{label:p("From Bottom","essential-blocks"),value:"overlay-bottom"},{label:p("From Left","essential-blocks"),value:"overlay-left"},{label:p("From Right","essential-blocks"),value:"overlay-right"},{label:p("Zoom In Out","essential-blocks"),value:"zoom"}],x="captionTypo";var P=Object.defineProperty,A=Object.getOwnPropertySymbols,B=Object.prototype.hasOwnProperty,M=Object.prototype.propertyIsEnumerable,T=(e,t,a)=>t in e?P(e,t,{enumerable:!0,configurable:!0,writable:!0,value:a}):e[t]=a,L=(e,t)=>{for(var a in t||(t={}))B.call(t,a)&&T(e,a,t[a]);if(A)for(var a of A(t))M.call(t,a)&&T(e,a,t[a]);return e};const{generateDimensionsAttributes:_,generateTypographyAttributes:G,generateBackgroundAttributes:I,generateBorderShadowAttributes:D,generateResponsiveRangeAttributes:j}=eb_controls,H=L(L(L(L(L(L(L(L(L(L(L({resOption:{type:"string",default:"Desktop"},blockId:{type:"string"},blockRoot:{type:"string",default:"essential_block"},blockMeta:{type:"object"},images:{type:"array",default:[]},selectedImgIndex:{type:"number"},layouts:{type:"string",default:"grid"},sources:{type:"array",default:[]},displayCaption:{type:"boolean",default:!1},captionOnHover:{type:"boolean",default:!1},newImage:{type:"string"},captionColor:{type:"string",default:"#ffffff"},captionBGColor:{type:"string",default:"rgba(195 195 195 / 0.7)"},overlayColor:{type:"string",default:"rgba(0 0 0 / 0.7)"},horizontalAlign:{type:"string",default:"center"},verticalAlign:{type:"string",default:"bottom"},textAlign:{type:"string",default:"center"},styleNumber:{type:"string",default:"0"},overlayStyle:{type:"string",default:"overlay-bottom"},disableLightBox:{type:"boolean",default:!1}},G(Object.values(l))),_(g)),_(b)),_(f,{top:0,bottom:0,right:0,left:0,isLinked:!1})),_(R,{top:5,bottom:5,right:10,left:10,isLinked:!1})),D(y,{bdrDefaults:{top:0,bottom:0,right:0,left:0}})),D(v,{bdrDefaults:{top:0,bottom:0,right:0,left:0},noShadow:!0})),I(m,{defaultBgGradient:"linear-gradient(45deg,#ffffff,#ffffff)",noOverlay:!0})),j(d,{defaultRange:3})),j(u,{defaultRange:10})),j(h)),{__:z}=wp.i18n,{InspectorControls:F,PanelColorSettings:V}=wp.blockEditor,{PanelBody:U,SelectControl:q,ToggleControl:Y,Button:J,ButtonGroup:W,BaseControl:K,TabPanel:X}=wp.components,{useEffect:Z}=wp.element,{select:Q}=wp.data,{mimmikCssForResBtns:ee,mimmikCssOnPreviewBtnClickWhileBlockSelected:te,ResponsiveDimensionsControl:ae,TypographyDropdown:le,BorderShadowControl:ne,ResponsiveRangeController:oe,BackgroundControl:re,ColorControl:se}=eb_controls,ie=function(e){const{attributes:t,setAttributes:a}=e,{resOption:l,layouts:n,displayCaption:o,captionOnHover:r,captionColor:s,overlayColor:i,captionBGColor:c,horizontalAlign:p,verticalAlign:x,textAlign:P,styleNumber:A,overlayStyle:B,disableLightBox:M}=t;Z((()=>{a({resOption:Q("core/edit-post").__experimentalGetPreviewDeviceType()})}),[]),Z((()=>{ee({domObj:document,resOption:l})}),[l]),Z((()=>{const e=te({domObj:document,select:Q,setAttributes:a});return()=>{e()}}),[]);const T={setAttributes:a,resOption:l,attributes:t,objAttributes:H};return React.createElement(F,{key:"controls"},React.createElement("div",{className:"eb-panel-control"},React.createElement(X,{className:"eb-parent-tab-panel",activeClass:"active-tab",tabs:[{name:"general",title:"General",className:"eb-tab general"},{name:"styles",title:"Style",className:"eb-tab styles"},{name:"advance",title:"Advanced",className:"eb-tab advance"}]},(e=>React.createElement("div",{className:"eb-tab-controls"+e.name},"general"===e.name&&React.createElement(React.Fragment,null,React.createElement(U,{title:z("General","essential-blocks"),initialOpen:!0},React.createElement(q,{label:z("Layouts","essential-blocks"),value:n,options:C,onChange:e=>a({layouts:e})}),React.createElement(q,{label:z("Styles","essential-blocks"),value:A,options:O,onChange:e=>(e=>{switch(a({styleNumber:e}),e){case"0":case"1":a({});break;case"2":a({displayCaption:!0});break;default:return!1}})(e)}),"2"===A&&React.createElement(q,{label:z("Overlay Styles","essential-blocks"),value:B,options:N,onChange:e=>a({overlayStyle:e})}),React.createElement(Y,{label:z("Display Caption","essential-blocks"),checked:o,onChange:()=>a({displayCaption:!o})}),o&&"0"===A&&React.createElement(Y,{label:z("Display Caption on Hover","essential-blocks"),checked:r,onChange:()=>a({captionOnHover:!r})}),React.createElement(oe,{baseLabel:z("Columns","essential-blocks"),controlName:d,resRequiredProps:T,units:[],min:1,max:8,step:1}),React.createElement(oe,{baseLabel:z("Image Gap","essential-blocks"),controlName:u,resRequiredProps:T,units:[],min:0,max:100,step:1}),React.createElement(Y,{label:z("Disable Light Box","essential-blocks"),checked:M,onChange:()=>a({disableLightBox:!M})}))),"styles"===e.name&&React.createElement(React.Fragment,null,React.createElement(U,{title:z("Image Settings","essential-blocks")},React.createElement(U,{title:z("Border","essential-blocks"),initialOpen:!0},React.createElement(ne,{controlName:v,resRequiredProps:T,noShadow:!0}))),"2"===A&&React.createElement(U,{title:z("Overlay Styles","essential-blocks")},React.createElement(se,{label:z("Overlay Color","essential-blocks"),color:i,onChange:e=>a({overlayColor:e})})),o&&React.createElement(U,{title:z("Caption Styles","essential-blocks")},React.createElement(V,{title:z("Color Controls","essential-blocks"),className:"eb-subpanel",initialOpen:!0,disableAlpha:!1,colorSettings:[{value:s,onChange:e=>a({captionColor:e}),label:z("Text Color","essential-blocks")}]}),React.createElement(se,{label:z("Background Color","essential-blocks"),color:c,onChange:e=>a({captionBGColor:e})}),React.createElement(le,{baseLabel:z("Typography","essential-blocks"),typographyPrefixConstant:k,resRequiredProps:T}),React.createElement(oe,{baseLabel:z("Width","essential-blocks"),controlName:h,resRequiredProps:T,units:S,min:0,max:300,step:1}),o&&React.createElement(React.Fragment,null,React.createElement(K,{label:z("Text Align","essential-blocks")},React.createElement(W,null,w.map((e=>React.createElement(J,{isLarge:!0,isPrimary:P===e.value,isSecondary:P!==e.value,onClick:()=>a({textAlign:e.value})},e.label))))),React.createElement(K,{label:z("Horizontal Align","essential-blocks")},React.createElement(W,null,$.map((e=>React.createElement(J,{isLarge:!0,isPrimary:p===e.value,isSecondary:p!==e.value,onClick:()=>a({horizontalAlign:e.value})},e.label))))),React.createElement(K,{label:z("Vertical Align","essential-blocks")},React.createElement(W,null,E.map((e=>React.createElement(J,{isLarge:!0,isPrimary:x===e.value,isSecondary:x!==e.value,onClick:()=>a({verticalAlign:e.value})},e.label))))),React.createElement(ae,{resRequiredProps:T,controlName:f,baseLabel:"Margin"}),React.createElement(ae,{resRequiredProps:T,controlName:R,baseLabel:"Padding"})))),"advance"===e.name&&React.createElement(React.Fragment,null,React.createElement(U,null,React.createElement(ae,{resRequiredProps:T,controlName:g,baseLabel:"Margin"}),React.createElement(ae,{resRequiredProps:T,controlName:b,baseLabel:"Padding"})),React.createElement(U,{title:z("Background","essential-blocks"),initialOpen:!1},React.createElement(re,{controlName:m,resRequiredProps:T,noOverlay:!0})),React.createElement(U,{title:z("Border & Shadow"),initialOpen:!1},React.createElement(ne,{controlName:y,resRequiredProps:T}))))))))};var ce=Object.defineProperty,pe=Object.getOwnPropertySymbols,me=Object.prototype.hasOwnProperty,ge=Object.prototype.propertyIsEnumerable,be=(e,t,a)=>t in e?ce(e,t,{enumerable:!0,configurable:!0,writable:!0,value:a}):e[t]=a,ye=(e,t)=>{for(var a in t||(t={}))me.call(t,a)&&be(e,a,t[a]);if(pe)for(var a of pe(t))ge.call(t,a)&&be(e,a,t[a]);return e};const{__:de}=wp.i18n,{MediaUpload:ue,MediaPlaceholder:ve,BlockControls:fe,useBlockProps:Re}=wp.blockEditor,{ToolbarGroup:ke,ToolbarItem:he,ToolbarButton:Ee,Button:$e}=wp.components,{Fragment:we}=wp.element,{useEffect:Se}=wp.element,{select:Ce}=wp.data,{softMinifyCssStrings:Oe,generateTypographyStyles:Ne,generateDimensionsControlStyles:xe,generateBorderShadowStyles:Pe,generateResponsiveRangeStyles:Ae,generateBackgroundControlStyles:Be,mimmikCssForPreviewBtnClick:Me,duplicateBlockIdFix:Te}=eb_controls,Le=[{attributes:H,save:({attributes:e})=>{const{blockId:t,layouts:a,sources:l,displayCaption:n,captionOnHover:o,styleNumber:r,overlayStyle:s,horizontalAlign:i,verticalAlign:c}=e;return 0===l.length?null:React.createElement("div",{className:`eb-gallery-img-wrapper ${t} ${a} ${s} caption-style-${r} ${o?"caption-on-hover":""}`,"data-id":t},l.map(((e,t)=>React.createElement("a",{className:"eb-gallery-img-content"},React.createElement("span",{className:"eb-gallery-link-wrapper"},React.createElement("img",{className:"eb-gallery-img",src:e.url,"image-index":t}),n&&e.caption&&e.caption.length>0&&React.createElement("span",{className:`eb-gallery-img-caption ${i} ${c}`},e.caption))))))}}],_e=JSON.parse('{"title":"Image Gallery","name":"essential-blocks/image-gallery","description":"Impress your audience with high-resolution images","category":"essential-blocks","apiVersion":2,"textdomain":"essential-blocks","supports":{"align":["wide","full"]}}');var Ge=Object.defineProperty,Ie=Object.getOwnPropertySymbols,De=Object.prototype.hasOwnProperty,je=Object.prototype.propertyIsEnumerable,He=(e,t,a)=>t in e?Ge(e,t,{enumerable:!0,configurable:!0,writable:!0,value:a}):e[t]=a;const{__:ze}=wp.i18n,{registerBlockType:Fe}=wp.blocks,{name:Ve}=_e;Fe(((e,t)=>{for(var a in t||(t={}))De.call(t,a)&&He(e,a,t[a]);if(Ie)for(var a of Ie(t))je.call(t,a)&&He(e,a,t[a]);return e})({name:Ve},_e),{icon:()=>React.createElement("svg",{id:"Layer_1",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 66 70"},React.createElement("linearGradient",{id:"SVGID_1_GALLERY",gradientUnits:"userSpaceOnUse",x1:"-11.021",y1:"35.1",x2:"79.881",y2:"35.1"},React.createElement("stop",{offset:"0",stopColor:"#1a6dff"}),React.createElement("stop",{offset:"1",stopColor:"#c822ff"})),React.createElement("path",{className:"st0g",d:"M66.1,2.1H-0.1c-0.9,0-1.6,0.7-1.6,1.6v31.4v31.4c0,0.9,0.7,1.6,1.6,1.6h66.2c0.9,0.2,1.6-0.5,1.6-1.4V35.3 V3.7C67.7,2.8,67,2.1,66.1,2.1z M64.6,36.9v5.8v22.5H1.5V33.8V23.5v-18h63.1V36.9z"}),React.createElement("linearGradient",{id:"SVGID_2_GALLERY",gradientUnits:"userSpaceOnUse",x1:"-11.021",y1:"25.217",x2:"79.881",y2:"25.217"},React.createElement("stop",{offset:"0",stopColor:"#1a6dff"}),React.createElement("stop",{offset:"1",stopColor:"#c822ff"})),React.createElement("path",{className:"st1g",d:"M12.4,33.2h15.7c1.7,0,3-1.4,3-3v-10c0-1.7-1.4-3-3-3H12.4c-1.7,0-3,1.4-3,3v10C9.4,31.9,10.8,33.2,12.4,33.2z M12,20.2c0-0.2,0.2-0.4,0.4-0.4h15.7c0.2,0,0.4,0.2,0.4,0.4v10c0,0.2-0.2,0.4-0.4,0.4H12.4c-0.2,0-0.4-0.2-0.4-0.4V20.2z"}),React.createElement("linearGradient",{id:"SVGID_3_GALLERY",gradientUnits:"userSpaceOnUse",x1:"-11.021",y1:"43.836",x2:"79.881",y2:"43.836"},React.createElement("stop",{offset:"0",stopColor:"#1a6dff"}),React.createElement("stop",{offset:"1",stopColor:"#c822ff"})),React.createElement("path",{className:"st2g",d:"M12.4,51.8h15.7c1.7,0,3-1.4,3-3v-10c0-1.7-1.4-3-3-3H12.4c-1.7,0-3,1.4-3,3v10C9.4,50.5,10.8,51.8,12.4,51.8z M12,38.9c0-0.2,0.2-0.4,0.4-0.4h15.7c0.2,0,0.4,0.2,0.4,0.4v10c0,0.2-0.2,0.4-0.4,0.4H12.4c-0.2,0-0.4-0.2-0.4-0.4V38.9z"}),React.createElement("linearGradient",{id:"SVGID_4_GALLERY",gradientUnits:"userSpaceOnUse",x1:"-11.021",y1:"43.836",x2:"79.881",y2:"43.836"},React.createElement("stop",{offset:"0",stopColor:"#1a6dff"}),React.createElement("stop",{offset:"1",stopColor:"#c822ff"})),React.createElement("path",{className:"st3g",d:"M37.5,51.8h15.7c1.7,0,3-1.4,3-3v-10c0-1.7-1.4-3-3-3H37.5c-1.7,0-3,1.4-3,3v10C34.5,50.5,35.9,51.8,37.5,51.8 z M37.1,38.9c0-0.2,0.2-0.4,0.4-0.4h15.7c0.2,0,0.4,0.2,0.4,0.4v10c0,0.2-0.2,0.4-0.4,0.4H37.5c-0.2,0-0.4-0.2-0.4-0.4V38.9z"}),React.createElement("linearGradient",{id:"SVGID_5_GALLERY",gradientUnits:"userSpaceOnUse",x1:"-11.021",y1:"25.217",x2:"79.881",y2:"25.217"},React.createElement("stop",{offset:"0",stopColor:"#1a6dff"}),React.createElement("stop",{offset:"1",stopColor:"#c822ff"})),React.createElement("path",{className:"st4g",d:"M37.5,33.2h15.7c1.7,0,3-1.4,3-3v-10c0-1.7-1.4-3-3-3H37.5c-1.7,0-3,1.4-3,3v10C34.5,31.9,35.9,33.2,37.5,33.2 z M37.1,20.2c0-0.2,0.2-0.4,0.4-0.4h15.7c0.2,0,0.4,0.2,0.4,0.4v10c0,0.2-0.2,0.4-0.4,0.4h0l-4.7-4.9h-0.1l-2.5,2.2l-3.2-4 c0,0,0,0-0.1,0c0,0,0,0-0.1,0l-5,6.7c-0.2-0.1-0.3-0.2-0.3-0.4V20.2z"}),React.createElement("linearGradient",{id:"SVGID_6_GALLERY",gradientUnits:"userSpaceOnUse",x1:"-11.021",y1:"22.534",x2:"79.881",y2:"22.534"},React.createElement("stop",{offset:"0",stopColor:"#1a6dff"}),React.createElement("stop",{offset:"1",stopColor:"#c822ff"})),React.createElement("path",{className:"st5g",d:"M48.1,23.8c0.7,0,1.2-0.6,1.2-1.2s-0.6-1.2-1.2-1.2s-1.2,0.6-1.2,1.2C46.8,23.1,47.3,23.8,48.1,23.8z"})),attributes:H,keywords:[ze("images","essential-blocks"),ze("photos","essential-blocks"),ze("eb image gallery","essential-blocks")],edit:function(e){const{attributes:t,setAttributes:a,clientId:l,isSelected:n}=e,{resOption:o,blockId:r,blockMeta:s,images:i,layouts:c,sources:p,displayCaption:E,captionOnHover:$,newImage:w,captionColor:S,captionBGColor:C,overlayColor:O,horizontalAlign:N,verticalAlign:x,textAlign:P,styleNumber:A,overlayStyle:B}=t;Se((()=>{document.body.className,a({resOption:Ce("core/edit-post").__experimentalGetPreviewDeviceType()})}),[]),Se((()=>{Te({BLOCK_PREFIX:"eb-image-gallery",blockId:r,setAttributes:a,select:Ce,clientId:l})}),[]),Se((()=>{Me({domObj:document,select:Ce})}),[]);const M=Re({className:"eb-guten-block-main-parent-wrapper"}),{typoStylesDesktop:T,typoStylesTab:L,typoStylesMobile:_}=Ne({attributes:t,prefixConstant:k,defaultFontSize:13}),{dimensionStylesDesktop:G,dimensionStylesTab:I,dimensionStylesMobile:D}=xe({controlName:g,styleFor:"margin",attributes:t}),{dimensionStylesDesktop:j,dimensionStylesTab:H,dimensionStylesMobile:z}=xe({controlName:b,styleFor:"padding",attributes:t}),{dimensionStylesDesktop:F,dimensionStylesTab:V,dimensionStylesMobile:U}=xe({controlName:f,styleFor:"margin",attributes:t}),{dimensionStylesDesktop:q,dimensionStylesTab:Y,dimensionStylesMobile:J}=xe({controlName:R,styleFor:"padding",attributes:t}),{rangeStylesDesktop:W,rangeStylesTab:K,rangeStylesMobile:X}=Ae({controlName:d,property:"",attributes:t}),{rangeStylesDesktop:Z,rangeStylesTab:Q,rangeStylesMobile:ee}=Ae({controlName:h,property:"width",attributes:t}),{rangeStylesDesktop:te,rangeStylesTab:ae,rangeStylesMobile:le}=Ae({controlName:u,property:"gap",attributes:t}),{backgroundStylesDesktop:ne,hoverBackgroundStylesDesktop:oe,backgroundStylesTab:re,hoverBackgroundStylesTab:se,backgroundStylesMobile:ce,hoverBackgroundStylesMobile:pe,bgTransitionStyle:me}=Be({attributes:t,controlName:m,noOverlay:!0}),{styesDesktop:ge,styesTab:be,styesMobile:Le,stylesHoverDesktop:_e,stylesHoverTab:Ge,stylesHoverMobile:Ie,transitionStyle:De}=Pe({controlName:y,attributes:t}),{styesDesktop:je,styesTab:He,styesMobile:ze,stylesHoverDesktop:Fe,stylesHoverTab:Ve,stylesHoverMobile:Ue,transitionStyle:qe}=Pe({controlName:v,attributes:t,noShadow:!0}),Ye=`\n\t\t.eb-gallery-img-wrapper.${r}{\n\t\t\t${te}\n\t\t\t${G}\n\t\t\t${j}\n\t\t\t${ge}\n\t\t\t${ne}\n\t\t\ttransition:${me}, ${De};\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r}:hover {\n\t\t\t${_e}\n\t\t\t${oe}\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r}.grid{\n\t\t\tgrid-template-columns: repeat(${W.replace(/[^0-9]/g,"")}, auto);\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r}.masonry{\n\t\t\tcolumns: ${W.replace(/[^0-9]/g,"")};\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r}.masonry .eb-gallery-img-content{\n\t\t\tmargin-bottom: ${te.replace(/[^0-9]/g,"")}px;\n\t\t}\n\t`,Je=`\n\t\t.eb-gallery-img-wrapper.${r}{\n\t\t\t${ae}\n\t\t\t${I}\n\t\t\t${H}\n\t\t\t${be}\n\t\t\t${re}\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r}:hover {\n\t\t\t${Ge}\n\t\t\t${se}\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r}.grid{\n\t\t\tgrid-template-columns: repeat(${K.replace(/[^0-9]/g,"")}, auto);\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r}.masonry{\n\t\t\tcolumns: ${K.replace(/[^0-9]/g,"")};\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r}.masonry .eb-gallery-img-content{\n\t\t\tmargin-bottom: calc(${ae.replace(/[^0-9]/g,"")}px - ${K.replace(/[^0-9]/g,"")}px);\n\t\t}\n\t`,We=`\n\t\t.eb-gallery-img-wrapper.${r}{\n\t\t\t${le}\n\t\t\t${D}\n\t\t\t${z}\n\t\t\t${Le}\n\t\t\t${ce}\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r}:hover {\n\t\t\t${Ie}\n\t\t\t${pe}\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r}.grid{\n\t\t\tgrid-template-columns: repeat(${X.replace(/[^0-9]/g,"")}, auto);\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r}.masonry{\n\t\t\tcolumns: ${X.replace(/[^0-9]/g,"")};\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r}.masonry .eb-gallery-img-content{\n\t\t\tmargin-bottom: calc(${le.replace(/[^0-9]/g,"")}px - ${X.replace(/[^0-9]/g,"")}px);\n\t\t}\n\t`,Ke=`\n\t\t.eb-gallery-img-wrapper.${r} .eb-gallery-img-content img{\n\t\t\t${He}\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r} .eb-gallery-img-content:hover img{\n\t\t\t${Ve}\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r} .eb-gallery-img-content .eb-gallery-img-caption {\n\t\t\t${V}\n\t\t\t${Y}\n\t\t\t${L}\n\t\t\t${Q}\n\t\t}\n\t`,Xe=`\n\t\t.eb-gallery-img-wrapper.${r} .eb-gallery-img-content img{\n\t\t\t${ze}\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r} .eb-gallery-img-content:hover img{\n\t\t\t${Ue}\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r} .eb-gallery-img-content .eb-gallery-img-caption {\n\t\t\t${U}\n\t\t\t${J}\n\t\t\t${_}\n\t\t\t${ee}\n\t\t}\n\t`,Ze=Oe(`\n\t\t${Ye}\n\t\t\n\t\t.eb-gallery-img-wrapper.${r} .eb-gallery-img-content .eb-gallery-link-wrapper {\n\t\t\t${je}\n\t\t\ttransition:${qe};\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r} .eb-gallery-img-content:hover .eb-gallery-link-wrapper {\n\t\t\t${Fe}\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r} .eb-gallery-img-content .eb-gallery-img-caption {\n\t\t\tcolor: ${S};\n\t\t\tbackground-color: ${C};\n\t\t\ttext-align: ${P};\n\t\t\t${F}\n\t\t\t${q}\n\t\t\t${T}\n\t\t\t${Z}\n\t\t}\n\t\t.eb-gallery-img-wrapper.${r}.caption-style-2 .eb-gallery-link-wrapper:after {\n\t\t\tbackground-color: ${O};\n\t\t}\n\t\n\t`),Qe=Oe(`\n\t\t${Je}\n\t\t${Ke}\n\t`),et=Oe(`\n\t\t${We}\n\t\t${Xe}\n\t`);function tt(e){let t=[];e.map((e=>{let a={};a.url=e.url,a.caption=e.caption,t.push(a)})),a({images:e,sources:t})}Se((()=>{const e={desktop:Ze,tab:Qe,mobile:et};JSON.stringify(s)!=JSON.stringify(e)&&a({blockMeta:e})}),[t]);let at=[];return i.map((e=>at.push(e.url))),[n&&i.length>0&&React.createElement(ie,{attributes:t,setAttributes:a}),React.createElement(we,null,0===at.length&&React.createElement(ve,{onSelect:e=>tt(e),accept:"image/*",allowedTypes:["image"],multiple:!0,labels:{title:"Images",instructions:"Drag media files, upload or select files from your library."}})),React.createElement("div",ye({},M),React.createElement("style",null,`\n\t\t\t\t${Ze}\n\n\t\t\t\t/* mimmikcssStart */\n\n\t\t\t\t${"Tablet"===o?Qe:" "}\n\t\t\t\t${"Mobile"===o?Qe+et:" "}\n\n\t\t\t\t/* mimmikcssEnd */\n\n\t\t\t\t@media all and (max-width: 1024px) {\t\n\n\t\t\t\t\t/* tabcssStart */\t\t\t\n\t\t\t\t\t${Oe(Qe)}\n\t\t\t\t\t/* tabcssEnd */\t\t\t\n\t\t\t\t\n\t\t\t\t}\n\t\t\t\t\n\t\t\t\t@media all and (max-width: 767px) {\n\t\t\t\t\t\n\t\t\t\t\t/* mobcssStart */\t\t\t\n\t\t\t\t\t${Oe(et)}\n\t\t\t\t\t/* mobcssEnd */\t\t\t\n\t\t\t\t\n\t\t\t\t}\n\t\t\t\t`),at.length>0&&React.createElement(we,null,React.createElement(fe,null,React.createElement(ke,null,React.createElement(he,null,(()=>React.createElement(ue,{value:i.map((e=>e.id)),onSelect:e=>tt(e),allowedTypes:["image"],multiple:!0,gallery:!0,render:({open:e})=>React.createElement(Ee,{className:"components-toolbar__control",label:de("Edit gallery","essential-blocks"),icon:"edit",onClick:e})}))))),React.createElement("div",{className:`eb-gallery-img-wrapper ${r} ${c} ${B} caption-style-${A} ${$?"caption-on-hover":""}`,"data-id":r},p.map(((e,t)=>React.createElement("a",{key:t,className:"eb-gallery-img-content"},React.createElement("span",{className:"eb-gallery-link-wrapper"},React.createElement("img",{className:"eb-gallery-img",src:e.url,"image-index":t}),E&&e.caption&&e.caption.length>0&&React.createElement("span",{className:`eb-gallery-img-caption ${N} ${x}`},e.caption)))))),React.createElement(ue,{onSelect:e=>{let t=[...i,...e],l=[];t.map((e=>{let t={};t.url=e.url,t.caption=e.caption,l.push(t)})),a({images:t,sources:l})},accept:"image/*",allowedTypes:["image"],multiple:!0,value:w,render:({open:e})=>!w&&React.createElement($e,{className:"eb-gallery-upload-button",label:de("Add Image","essential-blocks"),icon:"plus-alt",onClick:e},"Add More Images")})))]},save:({attributes:e})=>{const{blockId:t,layouts:a,sources:l,displayCaption:n,captionOnHover:p,styleNumber:m,overlayStyle:g,horizontalAlign:b,verticalAlign:y,disableLightBox:d}=e;return 0===l.length?null:React.createElement("div",((e,t)=>{for(var a in t||(t={}))r.call(t,a)&&i(e,a,t[a]);if(o)for(var a of o(t))s.call(t,a)&&i(e,a,t[a]);return e})({},c.save()),React.createElement("div",{className:`eb-gallery-img-wrapper ${t} ${a} ${g} caption-style-${m} ${p?"caption-on-hover":""}`,"data-id":t},l.map(((e,t)=>React.createElement("a",{key:t,"data-fslightbox":"gallery",href:d?"javascript:void(0)":e.url,className:"eb-gallery-img-content"},React.createElement("span",{className:"eb-gallery-link-wrapper"},React.createElement("img",{className:"eb-gallery-img",src:e.url,"image-index":t}),n&&e.caption&&e.caption.length>0&&React.createElement("span",{className:`eb-gallery-img-caption ${b} ${y}`},e.caption)))))))},example:{attributes:{images:["https://essential-addons.com/elementor/wp-content/uploads/2020/01/Maldive.png","https://essential-addons.com/elementor/wp-content/uploads/2020/01/Australia.png","https://essential-addons.com/elementor/wp-content/uploads/2020/01/hongkong.png","https://essential-addons.com/elementor/wp-content/uploads/2020/01/iceland.png","https://essential-addons.com/elementor/wp-content/uploads/2020/01/china.png","https://essential-addons.com/elementor/wp-content/uploads/2020/01/CA.png"],sources:[{url:"https://essential-addons.com/elementor/wp-content/uploads/2020/01/Maldive.png",caption:""},{url:"https://essential-addons.com/elementor/wp-content/uploads/2020/01/Australia.png",caption:""},{url:"https://essential-addons.com/elementor/wp-content/uploads/2020/01/hongkong.png",caption:""},{url:"https://essential-addons.com/elementor/wp-content/uploads/2020/01/iceland.png",caption:""},{url:"https://essential-addons.com/elementor/wp-content/uploads/2020/01/china.png",caption:""},{url:"https://essential-addons.com/elementor/wp-content/uploads/2020/01/CA.png",caption:""}]}},deprecated:Le})})(0,0,e)})();