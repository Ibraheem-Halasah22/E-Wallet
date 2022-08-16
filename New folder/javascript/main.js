const icon = document.getElementById('toggler');
const nav = document.getElementById('navbar');
const so=document.getElementById("soso");
so.onclick=(e)=>{
    location.reload();
}
nav.style.display = 'none';
const showNav = E;

    function E(e){
    icon.parentElement.classList.toggle('change-backGround');
        icon.classList.toggle('clicked');


        icon.classList.contains('clicked') ? (nav.style.cssText = 'dispaly: flex;', setTimeout(() => nav.style.transform = 'translateY(0)', 300)) : (nav.style.transform = 'translateY(-100%)', setTimeout(() => nav.style.display = 'none', 700));
}
function e_wallet_main(){
    window.location.href = "";
}
function watch_store_main(){
    window.location.href = "";
}

icon.addEventListener('click', E);
r = document.getElementsByClassName("hello2");
for(i=0;i<r.length;i++){
    r[i].addEventListener('click',E);
}