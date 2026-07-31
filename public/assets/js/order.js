console.log("order loaded")



const quantity = document.getElementById("quantity");
const total=document.getElementById("total");

const advance=document.getElementById("advance");

const discount=document.getElementById("discount");

const balance=document.getElementById("balance");

function calculate(){
let q = parseInt(quantity.value);
let t=parseFloat(total.value)||0;

let a=parseFloat(advance.value)||0;

let d=parseFloat(discount.value)||0;

balance.value= q*(t-a-d);

}

total.addEventListener("input",calculate);

advance.addEventListener("input",calculate);

discount.addEventListener("input",calculate);

calculate();

