"use strict";var KTVisTimelineGroup={init:function(){!function(){for(var e=Date.now(),t={stack:!0,maxHeight:640,horizontalScroll:!1,verticalScroll:!0,zoomKey:"ctrlKey",start:Date.now()-2592e5,end:Date.now()+18144e5,orientation:{axis:"both",item:"top"}},n=new vis.DataSet,i=new vis.DataSet,o=0;o<300;o++){var r=e+864e5*(o+Math.floor(7*Math.random())),a=r+864e5*(1+Math.floor(5*Math.random()));n.add({id:o,content:"Task "+o,order:o}),i.add({id:o,group:o,start:r,end:a,type:"range",content:"Item "+o})}var s=document.getElementById("kt_docs_vistimeline_group"),l=new vis.Timeline(s,i,n,t);l.setGroups(n),l.setItems(i),l.on("scroll",function(e,t=100){let n;return function(...i){clearTimeout(n),n=setTimeout((()=>{e.apply(this,i)}),t)}}((e=>{let t=l.getVisibleGroups().reduce(((e,t)=>{let n=l.itemSet.groups[t];return n.items&&(e=e.concat(Object.keys(n.items))),e}),[]);l.focus(t)}),200)),document.getElementById("kt_docs_vistimeline_group_button").addEventListener("click",(e=>{e.preventDefault();var t=l.getVisibleGroups();document.getElementById("visibleGroupsContainer").innerHTML="",document.getElementById("visibleGroupsContainer").innerHTML+=t}))}()}};KTUtil.onDOMContentLoaded((function(){KTVisTimelineGroup.init()}));;