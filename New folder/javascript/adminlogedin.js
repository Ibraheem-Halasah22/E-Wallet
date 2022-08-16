// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");
let list2=document.querySelectorAll(".hovered")
// function myFunction() {
//   console.log("Mohammad Jondi");
//   document.getElementById("sgnOut").submit();
// }


function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("click", activeLink));

//document.getElementById("sgnOutGo").addEventListener("click", myFunction);
// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};
