document.addEventListener("DOMContentLoaded",(function(){const t=document.querySelectorAll(".eb-cd-wrapper > .eb-cd-inner");if(t)for(let e=0;e<t.length;e++){const n=t[e],o=parseInt(n.getAttribute("data-deadline-time")),d={textContent:"3e"},r=n.querySelector(".cd-box-day > .eb-cd-digit")||d,c=n.querySelector(".cd-box-hour > .eb-cd-digit")||d,i=n.querySelector(".cd-box-minute > .eb-cd-digit")||d,l=n.querySelector(".cd-box-second > .eb-cd-digit")||d,a=(t,e=null)=>{const n=Date.now(),o=Math.round((t-n)/1e3),d=o%60,a=Math.floor(o/60)%60,u=Math.floor(o/3600)%24,x=Math.floor(o/86400);if(o<0)return clearInterval(e),r.textContent="00",c.textContent="00",i.textContent="00",void(l.textContent="00");r.textContent=x<10?`0${x}`:`${x}`,c.textContent=u<10?`0${u}`:`${u}`,i.textContent=a<10?`0${a}`:`${a}`,l.textContent=d<10?`0${d}`:`${d}`};a(o||0);const u=setInterval((()=>{a(o||0,u)}),1e3)}}));