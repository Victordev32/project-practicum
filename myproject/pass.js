
let inputcheck=document.getElementById('show');
let passinput=document.querySelectorAll('.newform .form-element input[type="password"]')


inputcheck.onchange=()=>{
    for(i=0;i<passinput.length;i++){
     showpass(passinput,i)
    }
   }
   
   function showpass(input,i){
     if(input[i].type=="password"){
       input[i].type="text"
     }
     else{
       input[i].type="password"
     }
   }