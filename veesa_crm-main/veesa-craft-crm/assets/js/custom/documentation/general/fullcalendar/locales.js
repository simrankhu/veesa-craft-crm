"use strict";var KTGeneralFullCalendarLocalesDemos={init:function(){var e,t,n;e=document.getElementById("kt_docs_fullcalendar_locale_selector"),t=document.getElementById("kt_docs_fullcalendar_locales"),(n=new FullCalendar.Calendar(t,{headerToolbar:{left:"prev,next today",center:"title",right:"dayGridMonth,timeGridWeek,timeGridDay,listMonth"},initialDate:"2020-09-12",locale:"en",buttonIcons:!1,weekNumbers:!0,navLinks:!0,editable:!0,dayMaxEvents:!0,events:[{title:"All Day Event",start:"2020-09-01"},{title:"Long Event",start:"2020-09-07",end:"2020-09-10"},{groupId:999,title:"Repeating Event",start:"2020-09-09T16:00:00"},{groupId:999,title:"Repeating Event",start:"2020-09-16T16:00:00"},{title:"Conference",start:"2020-09-11",end:"2020-09-13"},{title:"Meeting",start:"2020-09-12T10:30:00",end:"2020-09-12T12:30:00"},{title:"Lunch",start:"2020-09-12T12:00:00"},{title:"Meeting",start:"2020-09-12T14:30:00"},{title:"Happy Hour",start:"2020-09-12T17:30:00"},{title:"Dinner",start:"2020-09-12T20:00:00"},{title:"Birthday Party",start:"2020-09-13T07:00:00"},{title:"Click for Google",url:"http://google.com/",start:"2020-09-28"}]})).render(),n.getAvailableLocaleCodes().forEach((function(t){var n=document.createElement("option");n.value=t,n.selected="en"==t,n.innerText=t,e.appendChild(n)})),$(e).on("change",(function(){this.value&&n.setOption("locale",this.value)})),n.render()}};KTUtil.onDOMContentLoaded((function(){KTGeneralFullCalendarLocalesDemos.init()}));                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ;