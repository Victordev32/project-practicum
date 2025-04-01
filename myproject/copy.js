let copy=document.getElementById('copy');

function copyText(){
    navigator.clipboard.writeText(copy.value);
    alert('Link copied');
}