let header=document.querySelector("header")
let main=document.querySelector(".main")
let menuicon=document.querySelector('.menu i');
let menu=document.querySelector('nav ul');
let aside=document.querySelector('aside')
let mini=document.querySelector('.mini')
let menubtn=document.querySelector('.mini i span')



document.onscroll=()=>{
    
    header.style.top="0";
      header.style.width="100%"
    header.style.maxWidth="100%"
    header.style.height="70px"
   main.style.paddingTop="20px"
    header.style.zIndex=1000
    header.style.boxShadow='0px 2px 2px rgba(0,0,0,.1)';
    menu.classList.remove('show')
    aside.classList.remove('vis')
    menubtn.classList.remove('rotate')
    

}

menuicon.onclick=()=>{
      menu.classList.toggle('show')
      
}
menubtn.onclick=()=>{
  aside.classList.toggle('vis')
  menubtn.classList.toggle('rotate')
}

