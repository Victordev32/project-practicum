
let options=document.querySelector(".options")
let insize=document.querySelectorAll('.optn input')

let i=insize.length

function createInput(){
    i++;
     let div=document.createElement('div')
     div.classList.add('form-element');
     div.classList.add('optn')
     div.innerHTML=`
     <label for="option${i}">Option ${i}</label>
     <input type="text" name="options[]" id="option${i}">`;
     options.appendChild(div)
    


}