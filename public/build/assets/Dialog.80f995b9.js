import{_ as lt,L as rt,o as x,k as _,F as Q,v as fe,z as pe,m as b,s as ot,c as le,l as L,x as je,G as at,K as it,h as S,i as D,p as j,w as $,e as g,d as P,r as f,b as k,g as re,f as G,M as st,j as ut,u as B,n as dt,C as ct,a as W,E as ve}from"./app.25578da0.js";const ft={components:{Link:rt},props:{from:Number,to:Number,total:Number,links:Array,showLabel:Boolean}},pt={key:0},vt={key:0,class:"flex items-center col-span-4 w-full justify-center md:justify-start"},mt=b("span",{class:"col-span-1"},null,-1),ht={class:"inline-flex items-center"},gt={key:0,class:"px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-indigo\xCD",disabled:""},wt=b("svg",{class:"w-4 h-4",fill:"none",stroke:"currentColor",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},[b("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M15 19l-7-7 7-7"})],-1),yt=[wt],bt={key:1,class:"px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-indigo\xCD",disabled:""},Et=b("svg",{class:"w-4 h-4",fill:"none",stroke:"currentColor",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},[b("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M9 5l7 7-7 7"})],-1),St=[Et],Ft=b("svg",{class:"w-4 h-4",fill:"none",stroke:"currentColor",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},[b("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M15 19l-7-7 7-7"})],-1),xt=b("svg",{class:"w-4 h-4",fill:"none",stroke:"currentColor",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},[b("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M9 5l7 7-7 7"})],-1);function kt(e,t,n,l,r,o){const a=at("Link");return n.links.length>1?(x(),_("div",pt,[n.showLabel?(x(),_(Q,{key:0},[n.showLabel?(x(),_("span",vt," Menampilkan "+fe(n.from)+"-"+fe(n.to)+" dari "+fe(n.total)+" item ",1)):pe("",!0),mt],64)):pe("",!0),b("span",{class:je(["flex w-full justify-center mt-4 md:mt-0",{"col-span-4 md:justify-end":n.showLabel,"col-span-9":!n.showLabel}])},[b("nav",null,[b("ul",ht,[(x(!0),_(Q,null,ot(n.links,(i,s)=>(x(),_(Q,null,[i.url?(x(),_("li",{key:s+1},[i.label.includes("Previous")?(x(),le(a,{key:0,href:i.url},{default:L(()=>[Ft]),_:2},1032,["href"])):i.label.includes("Next")?(x(),le(a,{key:1,href:i.url},{default:L(()=>[xt]),_:2},1032,["href"])):(x(),le(a,{key:2,class:je(["px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-indigo",{"bg-indigo-500 dark:bg-indigo-400 text-gray-50 dark:text-gray-100":i.active}]),href:i.url,innerHTML:i.label},null,8,["class","href","innerHTML"]))])):(x(),_("li",{key:s},[i.label.includes("Previous")?(x(),_("button",gt,yt)):(x(),_("button",bt,St))]))],64))),256))])])],2)])):pe("",!0)}const gn=lt(ft,[["render",kt]]);function T(e,t,...n){if(e in t){let r=t[e];return typeof r=="function"?r(...n):r}let l=new Error(`Tried to handle "${e}" but there is no handler defined. Only defined handlers are: ${Object.keys(t).map(r=>`"${r}"`).join(", ")}.`);throw Error.captureStackTrace&&Error.captureStackTrace(l,T),l}var oe=(e=>(e[e.None=0]="None",e[e.RenderStrategy=1]="RenderStrategy",e[e.Static=2]="Static",e))(oe||{}),R=(e=>(e[e.Unmount=0]="Unmount",e[e.Hidden=1]="Hidden",e))(R||{});function A({visible:e=!0,features:t=0,ourProps:n,theirProps:l,...r}){var o;let a=Pt(l,n),i=Object.assign(r,{props:a});if(e||t&2&&a.static)return me(i);if(t&1){let s=(o=a.unmount)==null||o?0:1;return T(s,{[0](){return null},[1](){return me({...r,props:{...a,hidden:!0,style:{display:"none"}}})}})}return me(i)}function me({props:e,attrs:t,slots:n,slot:l,name:r}){var o;let{as:a,...i}=He(e,["unmount","static"]),s=(o=n.default)==null?void 0:o.call(n,l),u={};if(a==="template"){if(s=Me(s),Object.keys(i).length>0||Object.keys(t).length>0){let[c,...d]=s!=null?s:[];if(!At(c)||d.length>0)throw new Error(['Passing props on "template"!',"",`The current component <${r} /> is rendering a "template".`,"However we need to passthrough the following props:",Object.keys(i).concat(Object.keys(t)).sort((v,w)=>v.localeCompare(w)).map(v=>`  - ${v}`).join(`
`),"","You can apply a few solutions:",['Add an `as="..."` prop, to ensure that we render an actual element instead of a "template".',"Render a single element as the child so that we can forward the props onto that element."].map(v=>`  - ${v}`).join(`
`)].join(`
`));return it(c,Object.assign({},i,u))}return Array.isArray(s)&&s.length===1?s[0]:s}return S(a,Object.assign({},i,u),s)}function Me(e){return e.flatMap(t=>t.type===Q?Me(t.children):[t])}function Pt(...e){if(e.length===0)return{};if(e.length===1)return e[0];let t={},n={};for(let l of e)for(let r in l)r.startsWith("on")&&typeof l[r]=="function"?(n[r]!=null||(n[r]=[]),n[r].push(l[r])):t[r]=l[r];if(t.disabled||t["aria-disabled"])return Object.assign(t,Object.fromEntries(Object.keys(n).map(l=>[l,void 0])));for(let l in n)Object.assign(t,{[l](r,...o){let a=n[l];for(let i of a){if(r!=null&&r.defaultPrevented)return;i(r,...o)}}});return t}function wn(e){let t=Object.assign({},e);for(let n in t)t[n]===void 0&&delete t[n];return t}function He(e,t=[]){let n=Object.assign({},e);for(let l of t)l in n&&delete n[l];return n}function At(e){return e==null?!1:typeof e.type=="string"||typeof e.type=="object"||typeof e.type=="function"}let Tt=0;function $t(){return++Tt}function I(){return $t()}var Ie=(e=>(e.Space=" ",e.Enter="Enter",e.Escape="Escape",e.Backspace="Backspace",e.Delete="Delete",e.ArrowLeft="ArrowLeft",e.ArrowUp="ArrowUp",e.ArrowRight="ArrowRight",e.ArrowDown="ArrowDown",e.Home="Home",e.End="End",e.PageUp="PageUp",e.PageDown="PageDown",e.Tab="Tab",e))(Ie||{});function C(e){var t;return e==null||e.value==null?null:(t=e.value.$el)!=null?t:e.value}let Ue=Symbol("Context");var H=(e=>(e[e.Open=0]="Open",e[e.Closed=1]="Closed",e))(H||{});function Dt(){return Ae()!==null}function Ae(){return D(Ue,null)}function Ot(e){j(Ue,e)}function z(e){if(typeof window>"u")return null;if(e instanceof Node)return e.ownerDocument;if(e!=null&&e.hasOwnProperty("value")){let t=C(e);if(t)return t.ownerDocument}return document}let ge=["[contentEditable=true]","[tabindex]","a[href]","area[href]","button:not([disabled])","iframe","input:not([disabled])","select:not([disabled])","textarea:not([disabled])"].map(e=>`${e}:not([tabindex='-1'])`).join(",");var X=(e=>(e[e.First=1]="First",e[e.Previous=2]="Previous",e[e.Next=4]="Next",e[e.Last=8]="Last",e[e.WrapAround=16]="WrapAround",e[e.NoScroll=32]="NoScroll",e))(X||{}),qe=(e=>(e[e.Error=0]="Error",e[e.Overflow=1]="Overflow",e[e.Success=2]="Success",e[e.Underflow=3]="Underflow",e))(qe||{}),_t=(e=>(e[e.Previous=-1]="Previous",e[e.Next=1]="Next",e))(_t||{});function Lt(e=document.body){return e==null?[]:Array.from(e.querySelectorAll(ge))}var We=(e=>(e[e.Strict=0]="Strict",e[e.Loose=1]="Loose",e))(We||{});function jt(e,t=0){var n;return e===((n=z(e))==null?void 0:n.body)?!1:T(t,{[0](){return e.matches(ge)},[1](){let l=e;for(;l!==null;){if(l.matches(ge))return!0;l=l.parentElement}return!1}})}function J(e){e==null||e.focus({preventScroll:!0})}let Ct=["textarea","input"].join(",");function Bt(e){var t,n;return(n=(t=e==null?void 0:e.matches)==null?void 0:t.call(e,Ct))!=null?n:!1}function Nt(e,t=n=>n){return e.slice().sort((n,l)=>{let r=t(n),o=t(l);if(r===null||o===null)return 0;let a=r.compareDocumentPosition(o);return a&Node.DOCUMENT_POSITION_FOLLOWING?-1:a&Node.DOCUMENT_POSITION_PRECEDING?1:0})}function we(e,t,n=!0){var l;let r=(l=Array.isArray(e)?e.length>0?e[0].ownerDocument:document:e==null?void 0:e.ownerDocument)!=null?l:document,o=Array.isArray(e)?n?Nt(e):e:Lt(e),a=r.activeElement,i=(()=>{if(t&5)return 1;if(t&10)return-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),s=(()=>{if(t&1)return 0;if(t&2)return Math.max(0,o.indexOf(a))-1;if(t&4)return Math.max(0,o.indexOf(a))+1;if(t&8)return o.length-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),u=t&32?{preventScroll:!0}:{},c=0,d=o.length,v;do{if(c>=d||c+d<=0)return 0;let w=s+c;if(t&16)w=(w+d)%d;else{if(w<0)return 3;if(w>=d)return 1}v=o[w],v==null||v.focus(u),c+=i}while(v!==r.activeElement);return v.hasAttribute("tabindex")||v.setAttribute("tabindex","0"),t&6&&Bt(v)&&v.select(),2}function ye(e,t,n){typeof window<"u"&&$(l=>{window.addEventListener(e,t,n),l(()=>window.removeEventListener(e,t,n))})}function Rt(e,t,n=g(()=>!0)){function l(r,o){if(!n.value||r.defaultPrevented)return;let a=o(r);if(a===null||!a.ownerDocument.documentElement.contains(a))return;let i=function s(u){return typeof u=="function"?s(u()):Array.isArray(u)||u instanceof Set?u:[u]}(e);for(let s of i){if(s===null)continue;let u=s instanceof HTMLElement?s:C(s);if(u!=null&&u.contains(a))return}return!jt(a,We.Loose)&&a.tabIndex!==-1&&r.preventDefault(),t(r,a)}ye("click",r=>l(r,o=>o.target),!0),ye("blur",r=>l(r,()=>window.document.activeElement instanceof HTMLIFrameElement?window.document.activeElement:null),!0)}var ae=(e=>(e[e.None=1]="None",e[e.Focusable=2]="Focusable",e[e.Hidden=4]="Hidden",e))(ae||{});let be=P({name:"Hidden",props:{as:{type:[Object,String],default:"div"},features:{type:Number,default:1}},setup(e,{slots:t,attrs:n}){return()=>{let{features:l,...r}=e,o={"aria-hidden":(l&2)===2?!0:void 0,style:{position:"absolute",width:1,height:1,padding:0,margin:-1,overflow:"hidden",clip:"rect(0, 0, 0, 0)",whiteSpace:"nowrap",borderWidth:"0",...(l&4)===4&&(l&2)!==2&&{display:"none"}}};return A({ourProps:o,theirProps:r,slot:{},attrs:n,slots:t,name:"Hidden"})}}});var Ee=(e=>(e[e.Forwards=0]="Forwards",e[e.Backwards=1]="Backwards",e))(Ee||{});function Mt(){let e=f(0);return ye("keydown",t=>{t.key==="Tab"&&(e.value=t.shiftKey?1:0)}),e}function Ve(e,t,n,l){typeof window<"u"&&$(r=>{e=e!=null?e:window,e.addEventListener(t,n,l),r(()=>e.removeEventListener(t,n,l))})}var Ge=(e=>(e[e.None=1]="None",e[e.InitialFocus=2]="InitialFocus",e[e.TabLock=4]="TabLock",e[e.FocusLock=8]="FocusLock",e[e.RestoreFocus=16]="RestoreFocus",e[e.All=30]="All",e))(Ge||{});let K=Object.assign(P({name:"FocusTrap",props:{as:{type:[Object,String],default:"div"},initialFocus:{type:Object,default:null},features:{type:Number,default:30},containers:{type:Object,default:f(new Set)}},inheritAttrs:!1,setup(e,{attrs:t,slots:n,expose:l}){let r=f(null);l({el:r,$el:r});let o=g(()=>z(r));Ht({ownerDocument:o},g(()=>Boolean(e.features&16)));let a=It({ownerDocument:o,container:r,initialFocus:g(()=>e.initialFocus)},g(()=>Boolean(e.features&2)));Ut({ownerDocument:o,container:r,containers:e.containers,previousActiveElement:a},g(()=>Boolean(e.features&8)));let i=Mt();function s(){let u=C(r);!u||T(i.value,{[Ee.Forwards]:()=>we(u,X.First),[Ee.Backwards]:()=>we(u,X.Last)})}return()=>{let u={},c={ref:r},{features:d,initialFocus:v,containers:w,...E}=e;return S(Q,[Boolean(d&4)&&S(be,{as:"button",type:"button",onFocus:s,features:ae.Focusable}),A({ourProps:c,theirProps:{...t,...E},slot:u,attrs:t,slots:n,name:"FocusTrap"}),Boolean(d&4)&&S(be,{as:"button",type:"button",onFocus:s,features:ae.Focusable})])}}}),{features:Ge});function Ht({ownerDocument:e},t){let n=f(null),l={value:!1};k(()=>{re(t,(r,o)=>{var a;r!==o&&(!t.value||(l.value=!0,n.value||(n.value=(a=e.value)==null?void 0:a.activeElement)))},{immediate:!0}),re(t,(r,o,a)=>{r!==o&&(!t.value||a(()=>{l.value!==!1&&(l.value=!1,J(n.value),n.value=null)}))},{immediate:!0})})}function It({ownerDocument:e,container:t,initialFocus:n},l){let r=f(null);return k(()=>{re([t,n,l],(o,a)=>{if(o.every((s,u)=>(a==null?void 0:a[u])===s)||!l.value)return;let i=C(t);!i||requestAnimationFrame(()=>{var s,u;let c=C(n),d=(s=e.value)==null?void 0:s.activeElement;if(c){if(c===d){r.value=d;return}}else if(i.contains(d)){r.value=d;return}c?J(c):we(i,X.First|X.NoScroll)===qe.Error&&console.warn("There are no focusable elements inside the <FocusTrap />"),r.value=(u=e.value)==null?void 0:u.activeElement})},{immediate:!0,flush:"post"})}),r}function Ut({ownerDocument:e,container:t,containers:n,previousActiveElement:l},r){var o;Ve((o=e.value)==null?void 0:o.defaultView,"focus",a=>{if(!r.value)return;let i=new Set(n==null?void 0:n.value);i.add(t);let s=l.value;if(!s)return;let u=a.target;u&&u instanceof HTMLElement?qt(i,u)?(l.value=u,J(u)):(a.preventDefault(),a.stopPropagation(),J(s)):J(l.value)},!0)}function qt(e,t){var n;for(let l of e)if((n=l.value)!=null&&n.contains(t))return!0;return!1}let Ce="body > *",V=new Set,N=new Map;function Be(e){e.setAttribute("aria-hidden","true"),e.inert=!0}function Ne(e){let t=N.get(e);!t||(t["aria-hidden"]===null?e.removeAttribute("aria-hidden"):e.setAttribute("aria-hidden",t["aria-hidden"]),e.inert=t.inert)}function Wt(e,t=f(!0)){$(n=>{if(!t.value||!e.value)return;let l=e.value,r=z(l);if(r){V.add(l);for(let o of N.keys())o.contains(l)&&(Ne(o),N.delete(o));r.querySelectorAll(Ce).forEach(o=>{if(o instanceof HTMLElement){for(let a of V)if(o.contains(a))return;V.size===1&&(N.set(o,{"aria-hidden":o.getAttribute("aria-hidden"),inert:o.inert}),Be(o))}}),n(()=>{if(V.delete(l),V.size>0)r.querySelectorAll(Ce).forEach(o=>{if(o instanceof HTMLElement&&!N.has(o)){for(let a of V)if(o.contains(a))return;N.set(o,{"aria-hidden":o.getAttribute("aria-hidden"),inert:o.inert}),Be(o)}});else for(let o of N.keys())Ne(o),N.delete(o)})}})}let ze=Symbol("ForcePortalRootContext");function Vt(){return D(ze,!1)}let Se=P({name:"ForcePortalRoot",props:{as:{type:[Object,String],default:"template"},force:{type:Boolean,default:!1}},setup(e,{slots:t,attrs:n}){return j(ze,e.force),()=>{let{force:l,...r}=e;return A({theirProps:r,ourProps:{},slot:{},slots:t,attrs:n,name:"ForcePortalRoot"})}}});function Gt(e){let t=z(e);if(!t){if(e===null)return null;throw new Error(`[Headless UI]: Cannot find ownerDocument for contextElement: ${e}`)}let n=t.getElementById("headlessui-portal-root");if(n)return n;let l=t.createElement("div");return l.setAttribute("id","headlessui-portal-root"),t.body.appendChild(l)}let Ye=P({name:"Portal",props:{as:{type:[Object,String],default:"div"}},setup(e,{slots:t,attrs:n}){let l=f(null),r=g(()=>z(l)),o=Vt(),a=D(Ke,null),i=f(o===!0||a==null?Gt(l.value):a.resolveTarget());return $(()=>{o||a!=null&&(i.value=a.resolveTarget())}),G(()=>{var s,u;let c=(s=r.value)==null?void 0:s.getElementById("headlessui-portal-root");!c||i.value===c&&i.value.children.length<=0&&((u=i.value.parentElement)==null||u.removeChild(i.value))}),()=>{if(i.value===null)return null;let s={ref:l,"data-headlessui-portal":""};return S(st,{to:i.value},A({ourProps:s,theirProps:e,slot:{},attrs:n,slots:t,name:"Portal"}))}}}),Ke=Symbol("PortalGroupContext"),zt=P({name:"PortalGroup",props:{as:{type:[Object,String],default:"template"},target:{type:Object,default:null}},setup(e,{attrs:t,slots:n}){let l=ut({resolveTarget(){return e.target}});return j(Ke,l),()=>{let{target:r,...o}=e;return A({theirProps:o,ourProps:{},slot:{},attrs:t,slots:n,name:"PortalGroup"})}}}),Qe=Symbol("StackContext");var Fe=(e=>(e[e.Add=0]="Add",e[e.Remove=1]="Remove",e))(Fe||{});function Yt(){return D(Qe,()=>{})}function Kt({type:e,element:t,onUpdate:n}){let l=Yt();function r(...o){n==null||n(...o),l(...o)}k(()=>{r(0,e,t),G(()=>{r(1,e,t)})}),j(Qe,r)}let Je=Symbol("DescriptionContext");function Qt(){let e=D(Je,null);if(e===null)throw new Error("Missing parent");return e}function Jt({slot:e=f({}),name:t="Description",props:n={}}={}){let l=f([]);function r(o){return l.value.push(o),()=>{let a=l.value.indexOf(o);a!==-1&&l.value.splice(a,1)}}return j(Je,{register:r,slot:e,name:t,props:n}),g(()=>l.value.length>0?l.value.join(" "):void 0)}let yn=P({name:"Description",props:{as:{type:[Object,String],default:"p"}},setup(e,{attrs:t,slots:n}){let l=Qt(),r=`headlessui-description-${I()}`;return k(()=>G(l.register(r))),()=>{let{name:o="Description",slot:a=f({}),props:i={}}=l,s=e,u={...Object.entries(i).reduce((c,[d,v])=>Object.assign(c,{[d]:B(v)}),{}),id:r};return A({ourProps:u,theirProps:s,slot:a.value,attrs:t,slots:n,name:o})}}});var Xt=(e=>(e[e.Open=0]="Open",e[e.Closed=1]="Closed",e))(Xt||{});let xe=Symbol("DialogContext");function Z(e){let t=D(xe,null);if(t===null){let n=new Error(`<${e} /> is missing a parent <Dialog /> component.`);throw Error.captureStackTrace&&Error.captureStackTrace(n,Z),n}return t}let te="DC8F892D-2EBD-447C-A4C8-A03058436FF4",Zt=P({name:"Dialog",inheritAttrs:!1,props:{as:{type:[Object,String],default:"div"},static:{type:Boolean,default:!1},unmount:{type:Boolean,default:!0},open:{type:[Boolean,String],default:te},initialFocus:{type:Object,default:null}},emits:{close:e=>!0},setup(e,{emit:t,attrs:n,slots:l,expose:r}){var o;let a=f(!1);k(()=>{a.value=!0});let i=f(0),s=Ae(),u=g(()=>e.open===te&&s!==null?T(s.value,{[H.Open]:!0,[H.Closed]:!1}):e.open),c=f(new Set),d=f(null),v=f(null),w=g(()=>z(d));if(r({el:d,$el:d}),!(e.open!==te||s!==null))throw new Error("You forgot to provide an `open` prop to the `Dialog`.");if(typeof u.value!="boolean")throw new Error(`You provided an \`open\` prop to the \`Dialog\`, but the value is not a boolean. Received: ${u.value===te?void 0:e.open}`);let E=g(()=>a.value&&u.value?0:1),Y=g(()=>E.value===0),U=g(()=>i.value>1),se=D(xe,null)!==null,ue=g(()=>U.value?"parent":"leaf");Wt(d,g(()=>U.value?Y.value:!1)),Kt({type:"Dialog",element:d,onUpdate:(h,m,y)=>{if(m==="Dialog")return T(h,{[Fe.Add](){c.value.add(y),i.value+=1},[Fe.Remove](){c.value.delete(y),i.value-=1}})}});let ee=Jt({name:"DialogDescription",slot:g(()=>({open:u.value}))}),de=`headlessui-dialog-${I()}`,q=f(null),O={titleId:q,panelRef:f(null),dialogState:E,setTitleId(h){q.value!==h&&(q.value=h)},close(){t("close",!1)}};return j(xe,O),Rt(()=>{var h,m,y;return[...Array.from((m=(h=w.value)==null?void 0:h.querySelectorAll("body > *, [data-headlessui-portal]"))!=null?m:[]).filter(p=>!(!(p instanceof HTMLElement)||p.contains(C(v))||O.panelRef.value&&p.contains(O.panelRef.value))),(y=O.panelRef.value)!=null?y:d.value]},(h,m)=>{O.close(),dt(()=>m==null?void 0:m.focus())},g(()=>E.value===0&&!U.value)),Ve((o=w.value)==null?void 0:o.defaultView,"keydown",h=>{h.defaultPrevented||h.key===Ie.Escape&&E.value===0&&(U.value||(h.preventDefault(),h.stopPropagation(),O.close()))}),$(h=>{var m;if(E.value!==0||se)return;let y=w.value;if(!y)return;let p=y==null?void 0:y.documentElement,F=(m=y.defaultView)!=null?m:window,De=p.style.overflow,Oe=p.style.paddingRight,ce=F.innerWidth-p.clientWidth;if(p.style.overflow="hidden",ce>0){let _e=p.clientWidth-p.offsetWidth,Le=ce-_e;p.style.paddingRight=`${Le}px`}h(()=>{p.style.overflow=De,p.style.paddingRight=Oe})}),$(h=>{if(E.value!==0)return;let m=C(d);if(!m)return;let y=new IntersectionObserver(p=>{for(let F of p)F.boundingClientRect.x===0&&F.boundingClientRect.y===0&&F.boundingClientRect.width===0&&F.boundingClientRect.height===0&&O.close()});y.observe(m),h(()=>y.disconnect())}),()=>{let h={...n,ref:d,id:de,role:"dialog","aria-modal":E.value===0?!0:void 0,"aria-labelledby":q.value,"aria-describedby":ee.value},{open:m,initialFocus:y,...p}=e,F={open:E.value===0};return S(Se,{force:!0},()=>[S(Ye,()=>S(zt,{target:d.value},()=>S(Se,{force:!1},()=>S(K,{initialFocus:y,containers:c,features:Y.value?T(ue.value,{parent:K.features.RestoreFocus,leaf:K.features.All&~K.features.FocusLock}):K.features.None},()=>A({ourProps:h,theirProps:p,slot:F,attrs:n,slots:l,visible:E.value===0,features:oe.RenderStrategy|oe.Static,name:"Dialog"}))))),S(be,{features:ae.Hidden,ref:v})])}}}),en=P({name:"DialogOverlay",props:{as:{type:[Object,String],default:"div"}},setup(e,{attrs:t,slots:n}){let l=Z("DialogOverlay"),r=`headlessui-dialog-overlay-${I()}`;function o(a){a.target===a.currentTarget&&(a.preventDefault(),a.stopPropagation(),l.close())}return()=>A({ourProps:{id:r,"aria-hidden":!0,onClick:o},theirProps:e,slot:{open:l.dialogState.value===0},attrs:t,slots:n,name:"DialogOverlay"})}});P({name:"DialogBackdrop",props:{as:{type:[Object,String],default:"div"}},inheritAttrs:!1,setup(e,{attrs:t,slots:n,expose:l}){let r=Z("DialogBackdrop"),o=`headlessui-dialog-backdrop-${I()}`,a=f(null);return l({el:a,$el:a}),k(()=>{if(r.panelRef.value===null)throw new Error("A <DialogBackdrop /> component is being used, but a <DialogPanel /> component is missing.")}),()=>{let i=e,s={id:o,ref:a,"aria-hidden":!0};return S(Se,{force:!0},()=>S(Ye,()=>A({ourProps:s,theirProps:{...t,...i},slot:{open:r.dialogState.value===0},attrs:t,slots:n,name:"DialogBackdrop"})))}}});let tn=P({name:"DialogPanel",props:{as:{type:[Object,String],default:"div"}},setup(e,{attrs:t,slots:n,expose:l}){let r=Z("DialogPanel"),o=`headlessui-dialog-panel-${I()}`;l({el:r.panelRef,$el:r.panelRef});function a(i){i.stopPropagation()}return()=>{let i={id:o,ref:r.panelRef,onClick:a};return A({ourProps:i,theirProps:e,slot:{open:r.dialogState.value===0},attrs:t,slots:n,name:"DialogPanel"})}}}),nn=P({name:"DialogTitle",props:{as:{type:[Object,String],default:"h2"}},setup(e,{attrs:t,slots:n}){let l=Z("DialogTitle"),r=`headlessui-dialog-title-${I()}`;return k(()=>{l.setTitleId(r),G(()=>l.setTitleId(null))}),()=>A({ourProps:{id:r},theirProps:e,slot:{open:l.dialogState.value===0},attrs:t,slots:n,name:"DialogTitle"})}});function ln(e){let t={called:!1};return(...n)=>{if(!t.called)return t.called=!0,e(...n)}}function Xe(){let e=[],t=[],n={enqueue(l){t.push(l)},requestAnimationFrame(...l){let r=requestAnimationFrame(...l);n.add(()=>cancelAnimationFrame(r))},nextFrame(...l){n.requestAnimationFrame(()=>{n.requestAnimationFrame(...l)})},setTimeout(...l){let r=setTimeout(...l);n.add(()=>clearTimeout(r))},add(l){e.push(l)},dispose(){for(let l of e.splice(0))l()},async workQueue(){for(let l of t.splice(0))await l()}};return n}function he(e,...t){e&&t.length>0&&e.classList.add(...t)}function ne(e,...t){e&&t.length>0&&e.classList.remove(...t)}var ke=(e=>(e.Finished="finished",e.Cancelled="cancelled",e))(ke||{});function rn(e,t){let n=Xe();if(!e)return n.dispose;let{transitionDuration:l,transitionDelay:r}=getComputedStyle(e),[o,a]=[l,r].map(i=>{let[s=0]=i.split(",").filter(Boolean).map(u=>u.includes("ms")?parseFloat(u):parseFloat(u)*1e3).sort((u,c)=>c-u);return s});return o!==0?n.setTimeout(()=>t("finished"),o+a):t("finished"),n.add(()=>t("cancelled")),n.dispose}function Re(e,t,n,l,r,o){let a=Xe(),i=o!==void 0?ln(o):()=>{};return ne(e,...r),he(e,...t,...n),a.nextFrame(()=>{ne(e,...n),he(e,...l),a.add(rn(e,s=>(ne(e,...l,...t),he(e,...r),i(s))))}),a.add(()=>ne(e,...t,...n,...l,...r)),a.add(()=>i("cancelled")),a.dispose}function M(e=""){return e.split(" ").filter(t=>t.trim().length>1)}let Te=Symbol("TransitionContext");var on=(e=>(e.Visible="visible",e.Hidden="hidden",e))(on||{});function an(){return D(Te,null)!==null}function sn(){let e=D(Te,null);if(e===null)throw new Error("A <TransitionChild /> is used but it is missing a parent <TransitionRoot />.");return e}function un(){let e=D($e,null);if(e===null)throw new Error("A <TransitionChild /> is used but it is missing a parent <TransitionRoot />.");return e}let $e=Symbol("NestingContext");function ie(e){return"children"in e?ie(e.children):e.value.filter(({state:t})=>t==="visible").length>0}function Ze(e){let t=f([]),n=f(!1);k(()=>n.value=!0),G(()=>n.value=!1);function l(o,a=R.Hidden){let i=t.value.findIndex(({id:s})=>s===o);i!==-1&&(T(a,{[R.Unmount](){t.value.splice(i,1)},[R.Hidden](){t.value[i].state="hidden"}}),!ie(t)&&n.value&&(e==null||e()))}function r(o){let a=t.value.find(({id:i})=>i===o);return a?a.state!=="visible"&&(a.state="visible"):t.value.push({id:o,state:"visible"}),()=>l(o,R.Unmount)}return{children:t,register:r,unregister:l}}let et=oe.RenderStrategy,Pe=P({props:{as:{type:[Object,String],default:"div"},show:{type:[Boolean],default:null},unmount:{type:[Boolean],default:!0},appear:{type:[Boolean],default:!1},enter:{type:[String],default:""},enterFrom:{type:[String],default:""},enterTo:{type:[String],default:""},entered:{type:[String],default:""},leave:{type:[String],default:""},leaveFrom:{type:[String],default:""},leaveTo:{type:[String],default:""}},emits:{beforeEnter:()=>!0,afterEnter:()=>!0,beforeLeave:()=>!0,afterLeave:()=>!0},setup(e,{emit:t,attrs:n,slots:l,expose:r}){if(!an()&&Dt())return()=>S(tt,{...e,onBeforeEnter:()=>t("beforeEnter"),onAfterEnter:()=>t("afterEnter"),onBeforeLeave:()=>t("beforeLeave"),onAfterLeave:()=>t("afterLeave")},l);let o=f(null),a=f("visible"),i=g(()=>e.unmount?R.Unmount:R.Hidden);r({el:o,$el:o});let{show:s,appear:u}=sn(),{register:c,unregister:d}=un(),v={value:!0},w=I(),E={value:!1},Y=Ze(()=>{E.value||(a.value="hidden",d(w),t("afterLeave"))});k(()=>{let m=c(w);G(m)}),$(()=>{if(i.value===R.Hidden&&!!w){if(s&&a.value!=="visible"){a.value="visible";return}T(a.value,{hidden:()=>d(w),visible:()=>c(w)})}});let U=M(e.enter),se=M(e.enterFrom),ue=M(e.enterTo),ee=M(e.entered),de=M(e.leave),q=M(e.leaveFrom),O=M(e.leaveTo);k(()=>{$(()=>{if(a.value==="visible"){let m=C(o);if(m instanceof Comment&&m.data==="")throw new Error("Did you forget to passthrough the `ref` to the actual DOM node?")}})});function h(m){let y=v.value&&!u.value,p=C(o);!p||!(p instanceof HTMLElement)||y||(E.value=!0,s.value&&t("beforeEnter"),s.value||t("beforeLeave"),m(s.value?Re(p,U,se,ue,ee,F=>{E.value=!1,F===ke.Finished&&t("afterEnter")}):Re(p,de,q,O,ee,F=>{E.value=!1,F===ke.Finished&&(ie(Y)||(a.value="hidden",d(w),t("afterLeave")))})))}return k(()=>{re([s],(m,y,p)=>{h(p),v.value=!1},{immediate:!0})}),j($e,Y),Ot(g(()=>T(a.value,{visible:H.Open,hidden:H.Closed}))),()=>{let{appear:m,show:y,enter:p,enterFrom:F,enterTo:De,entered:Oe,leave:ce,leaveFrom:_e,leaveTo:Le,...nt}=e;return A({theirProps:nt,ourProps:{ref:o},slot:{},slots:l,attrs:n,features:et,visible:a.value==="visible",name:"TransitionChild"})}}}),dn=Pe,tt=P({inheritAttrs:!1,props:{as:{type:[Object,String],default:"div"},show:{type:[Boolean],default:null},unmount:{type:[Boolean],default:!0},appear:{type:[Boolean],default:!1},enter:{type:[String],default:""},enterFrom:{type:[String],default:""},enterTo:{type:[String],default:""},entered:{type:[String],default:""},leave:{type:[String],default:""},leaveFrom:{type:[String],default:""},leaveTo:{type:[String],default:""}},emits:{beforeEnter:()=>!0,afterEnter:()=>!0,beforeLeave:()=>!0,afterLeave:()=>!0},setup(e,{emit:t,attrs:n,slots:l}){let r=Ae(),o=g(()=>e.show===null&&r!==null?T(r.value,{[H.Open]:!0,[H.Closed]:!1}):e.show);$(()=>{if(![!0,!1].includes(o.value))throw new Error('A <Transition /> is used but it is missing a `:show="true | false"` prop.')});let a=f(o.value?"visible":"hidden"),i=Ze(()=>{a.value="hidden"}),s=f(!0),u={show:o,appear:g(()=>e.appear||!s.value)};return k(()=>{$(()=>{s.value=!1,o.value?a.value="visible":ie(i)||(a.value="hidden")})}),j($e,i),j(Te,u),()=>{let c=He(e,["show","appear","unmount","onBeforeEnter","onBeforeLeave","onAfterEnter","onAfterLeave"]),d={unmount:e.unmount};return A({ourProps:{...d,as:"template"},theirProps:{},slot:{},slots:{...l,default:()=>[S(dn,{onBeforeEnter:()=>t("beforeEnter"),onAfterEnter:()=>t("afterEnter"),onBeforeLeave:()=>t("beforeLeave"),onAfterLeave:()=>t("afterLeave"),...n,...d,...c},l.default)]},attrs:{},features:et,visible:a.value==="visible",name:"Transition"})}}});const cn={class:"fixed inset-0 z-50 overflow-y-auto"},fn={class:"flex items-center justify-center min-h-screen"},pn=b("div",{class:"absolute inset-0 bg-gray-900 opacity-50"},null,-1),vn={class:"mt-6 text-sm"},mn={class:"flex flex-row justify-end mt-4"},bn={__name:"Dialog",setup(e){const t=f(!1);return k(()=>ct.$on("modal-toggle",()=>t.value=!t.value)),(n,l)=>(x(),le(B(tt),{appear:"",show:t.value,as:"template"},{default:L(()=>[W(B(Zt),{as:"div",onClose:l[0]||(l[0]=r=>t.value=!t.value)},{default:L(()=>[b("div",cn,[b("div",fn,[W(B(Pe),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0","enter-to":"opacity-100",leave:"duration-200 ease-in","leave-from":"opacity-100","leave-to":"opacity-0"},{default:L(()=>[W(B(en),{class:"fixed inset-0"},{default:L(()=>[pn]),_:1})]),_:1}),W(B(Pe),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0 scale-95","enter-to":"opacity-100 scale-100",leave:"duration-200 ease-in","leave-from":"opacity-100 scale-100","leave-to":"opacity-0 scale-95"},{default:L(()=>[W(B(tn),{class:"inline-block w-full max-w-md p-6 my-auto overflow-y-auto text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl dark:bg-gray-800"},{default:L(()=>[W(B(nn),{as:"h3",class:"text-lg font-medium leading-6 text-gray-900 dark:text-gray-50"},{default:L(()=>[ve(n.$slots,"title")]),_:3}),b("div",vn,[ve(n.$slots,"content")]),b("div",mn,[ve(n.$slots,"footer")])]),_:3})]),_:3})])])]),_:3})]),_:3},8,["show"]))}};export{wn as A,jt as F,We as M,He as N,A as P,oe as R,yn as S,Rt as T,bn as _,Ae as a,Ie as b,Ot as c,Jt as d,gn as e,H as l,be as m,C as o,ae as p,I as t,T as u,Nt as w};