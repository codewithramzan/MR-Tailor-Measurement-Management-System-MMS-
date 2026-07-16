document.querySelectorAll(".menu-toggle").forEach(item=>{

item.addEventListener("click",function(e){

e.preventDefault();

const parent=this.parentElement;

parent.classList.toggle("open");

const submenu=parent.querySelector(".submenu");

if(submenu.style.display==="block"){

submenu.style.display="none";

}else{

submenu.style.display="block";

}

});

});