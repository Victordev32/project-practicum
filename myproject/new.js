let updateinput=document.querySelectorAll(".opt-update .form-element input");
let optUpdate=document.querySelector('.opt-update')
console.log(updateinput);
let i=updateinput.length;
function addnewupdateOption(){
   let div=document.createElement('div');
   div.classList.add('form-element');

   div.innerHTML+=`
   
                <label for="upt-opt${i+1}">Option ${i+1}</label>
                <input type="text" name="newoptions[]" id="upt-opt${i+1} value="">
            
   `
   optUpdate.appendChild(div)
   console.log(i)
    i++;
}