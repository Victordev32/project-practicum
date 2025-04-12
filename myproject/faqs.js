const faqs=[{
    q: "Can I sign up with my phone number",
    a: "No,this version do not allow signing up with phone numbers"
},{
    q: "Can I a muti-poll in this website",
    a: "No, v1.0 do not have an option for that but later version will have it"
},{
    q: "Can I share my polls online and on social media",
    a:"Yes, you can copy the to your poll then share it with others in social media"
},{
    q: "Can I add poll that can last over a month",
    a: "Yes,the poll can last upto 3 months"
},{
    q: "Must I sign up to access your services",
    a: "No,It is not a requirement for you to sign up.Unless you are adding a poll,this is not a must"
}
,{
    q: "Can I generate pdf files as my poll result",
    a:"No, this version do not have a capality to generate a pdf file as result"
}
]

console.log(faqs)

let faqsElement=document.querySelector(".faqs");

faqs.forEach((faq,index)=>{
   
    let div=document.createElement('div');
    div.classList.add('top')
    let div2=document.createElement('div');
    let p=document.createElement('p');
    let span=document.createElement('span')
     span.innerHTML=">"
     span.dataset.i=index;
     span.classList.add('roll');
     p.innerHTML=faq.q;
     div2.appendChild(p)
     div2.appendChild(span)
     let div3=document.createElement('div')
     div3.classList.add('div3')
      
     div3.innerHTML=faq.a
    div.appendChild(div2)
    div.appendChild(div3)

    faqsElement.appendChild(div)
})

let btn=document.querySelectorAll('.top span')
let show=document.querySelectorAll('.faqs .top  .div3')
console.log(show[1].innerHTML)
btn.forEach((btn,i)=>{
    btn.onclick=(e)=>{
        
        //hide(show)
        if(e.target.dataset.i==i){
         if(show[i].style.display=="block"){
            show[i].style.display="none"
            e.target.style.rotate="0deg"
         
         }else{
          show[i].style.display="block"
           e.target.style.rotate="90deg"
            show[i].style.transition="all 0.9s"
         }
                
            
       
        }
        
          
    
    }
})

function hide(arr){
    
    arr.forEach((a,i)=>{
     a.style.display="none";
     
    })
}