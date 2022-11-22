import{D as B}from"./DataTable.f67287aa.js";import{_ as S}from"./Dialog.80f995b9.js";import{o as a,c as v,a as n,r as U,j as x,k as u,l,u as h,m as t,F as _,q as y,H as D,s as N,v as o,y as k,z as $,C as z}from"./app.25578da0.js";/* empty css            */function E(r,m){return a(),v("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor","aria-hidden":"true"},[n("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M15 12a3 3 0 11-6 0 3 3 0 016 0z"}),n("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"})])}function F(r,m){return a(),v("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor","aria-hidden":"true"},[n("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"})])}const H=t("title",null,"eAngkot Admin - User",-1),M={class:"my-6"},O=t("h2",{class:"text-2xl font-bold text-gray-700 dark:text-gray-200"},"User",-1),T={class:"px-4 py-3"},V={class:"px-4 py-3"},I={class:"px-4 py-3"},L={class:"px-4 py-3"},A={class:"mx-auto inline-flex items-center justify-evenly px-4 py-3"},q=["onClick"],P=["onClick"],R={__name:"User",props:{auth:Object,errors:Object,users:Object},setup(r){const m=r,p=U({id:0,nama:"",hp:"",email:""}),i=x({type:"",isOpen:!1}),d=x({show:0,search:""}),b=["ID","Nama","No. HP","Email"],f=()=>z.$emit("modal-toggle"),g=(s,c=null)=>{p.value={id:0,nama:"",hp:"",email:""},p.value=m.users.data.find(e=>e.id==c),s=="detail"?i.type="Detail User":s=="edit"&&(i.type="Edit User"),f()},w=s=>{d.show=s,y.Inertia.get(route("admin.akun.user.index"),d,{preserveState:!0})},C=s=>{d.search=s,setTimeout(()=>y.Inertia.get(route("admin.akun.user.index"),d,{preserveState:!0}),150)};return(s,c)=>(a(),u(_,null,[n(h(D),null,{default:l(()=>[H]),_:1}),t("div",M,[O,n(B,{data:r.users,columns:b,onShowing:w,onSearching:C},{default:l(()=>[(a(!0),u(_,null,N(r.users.data,e=>(a(),u("tr",{class:"text-gray-700 dark:text-gray-400",key:e.id},[t("td",T,o(e.id),1),t("td",V,o(e.nama),1),t("td",I,o(e.no_hp),1),t("td",L,o(e.email),1),t("td",A,[t("button",{onClick:j=>g("detail",e.id),class:"mr-2"},[n(h(E),{class:"h-5"})],8,q),t("button",{onClick:j=>g("edit",e.id),class:"ml-2"},[n(h(F),{class:"h-5"})],8,P)])]))),128))]),_:1},8,["data"]),n(S,{class:"grid grid-cols-1"},{title:l(()=>[k(o(i.type),1)]),content:l(()=>[k(o(p.value.id),1)]),footer:l(()=>[t("button",{type:"button",class:"mr-2 inline-flex justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none",onClick:f},o(i.type=="Detail User"?"Tutup":"Batal"),1),i.type=="Edit User"?(a(),u("button",{key:0,type:"button",class:"ml-2 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-400 focus:outline-none",onClick:c[0]||(c[0]=(...e)=>s.submitForm&&s.submitForm(...e))}," Simpan ")):$("",!0)]),_:1})])],64))}};export{R as default};