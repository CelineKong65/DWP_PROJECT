const openbtn = document.getElementById("openTNG");
const closebtn = document.getElementById("closeTNG");
const method3 = document.getElementById("method1");

openbtn.addEventListener("click",() =>{
    method3.classList.add("open");
})

closebtn.addEventListener("click",() =>{
    method3.classList.remove("open");
})