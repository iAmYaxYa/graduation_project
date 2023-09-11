let userImg = document.querySelector(".user-img");
let username = document.querySelector(".username");
let profile = document.querySelector(".profile");
let menu = document.querySelector("#menu");
let main = document.querySelector(".main");
let sidebar = document.querySelector(".sidebar");
let input = document.querySelector(".input");
let noticeIcon = document.querySelector(".notice-icon");
let messageIcon = document.querySelector(".message-icon");
let messages = document.querySelector(".messages");
let notice = document.querySelector(".notice");
let preloader = document.querySelector(".preloader");


// window.addEventListener('load',()=>{
//     preloader.style.display = 'none';
// })



userImg.addEventListener("click",()=>{
    profile.classList.toggle("show")
})
username.addEventListener("click",()=>{
    profile.classList.toggle("show")
})

noticeIcon.addEventListener("click",()=>{
    notice.classList.add("show")
    document.addEventListener("click",(e)=>{
        if(e.target.tagName != "I" && e.target != !noticeIcon){
            notice.classList.remove("show")
        }
    })
})

messageIcon.addEventListener("click",()=>{
    messages.classList.add("show")
    document.addEventListener("click",(e)=>{
        if(e.target.tagName != "I" && e.target != !messageIcon){
            messages.classList.remove("show")
        }
    })
})

menu.addEventListener("click",()=>{
    sidebar.classList.toggle("active");
    main.classList.toggle("active");
})

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
