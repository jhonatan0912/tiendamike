let number=1;
element1=document.getElementById('addShoppingCart1');
element2=document.getElementById('addShoppingCart2');
element3=document.getElementById('addShoppingCart3');
element4=document.getElementById('addShoppingCart4');
element5=document.getElementById('addShoppingCart5');
element1.addEventListener("click", mySecondFunction);
element2.addEventListener("click", mySecondFunction);
element3.addEventListener("click", mySecondFunction);
element4.addEventListener("click", mySecondFunction);
element5.addEventListener("click", mySecondFunction);

function mySecondFunction() {
  cantidad=document.getElementById("cantidad--products").innerHTML = number++;
  document.getElementById("cantidad--products").style.backgroundColor="white";
  document.getElementById("cantidad--products").style.borderRadius="50%";
  document.getElementById("cantidad--products").style.fontSize="22px";
}
// fin agregar cantidad de productos a carrito de compras

// MOSTRAR DESCRIPCION PLATO 1

function mostrarDescripcionPlato1(){
  document.getElementById("imagen--plato1").style.visibility="hidden";
  document.getElementById("mostrarContent1").style.background="#eb6974";
  document.getElementById("mostrarContent1").style.marginTop="-180px";
  document.getElementById("mostrarContent1").style.height="135px";
  document.getElementById('mostrarContent1').innerHTML="Sopa de pollo<br>Arroz chaufa<br>Alitas arrebosadas<br>+Wantan Frito";
  document.getElementById('mostrarContent1').style.textAlign="center";
  document.getElementById('mostrarContent1').style.padding="45px 0 0 0";
  document.getElementById('mostrarContent1').style.borderTopRightRadius="20px";
  document.getElementById('mostrarContent1').style.borderTopLeftRadius="20px";
}
function mostrarImagen1(){
  document.getElementById('imagen--plato1').style.visibility="visible";
  document.getElementById('imagen--plato1').style.position="relative";
}
// FIN MOSTRAR DESCRIPCION PLATO 1

// MOSTRAR DESCRIPCION PLATO 2

function mostrarDescripcionPlato2(){
  document.getElementById("imagen--plato2").style.visibility="hidden";
  document.getElementById("mostrarContent2").style.background="#eb6974";
  document.getElementById("mostrarContent2").style.marginTop="-180px";
  document.getElementById("mostrarContent2").style.height="135px";
  document.getElementById('mostrarContent2').innerHTML="Sopa Wantan<br>Pollo en salsa Curry<br>Pollo c/ verduras<br>+Arroz chaufa<br>+Wantan frito";
  document.getElementById('mostrarContent2').style.textAlign="center";
  document.getElementById('mostrarContent2').style.padding="45px 0 0 0";
  document.getElementById('mostrarContent2').style.borderTopRightRadius="20px";
  document.getElementById('mostrarContent2').style.borderTopLeftRadius="20px";
}
function mostrarImagen2(){
  document.getElementById('imagen--plato2').style.visibility="visible";
  document.getElementById('imagen--plato2').style.position="relative";
}
// FIN MOSTRAR DESCRIPCION PLATO 2

// MOSTRAR DESCRIPCION PLATO 3

function mostrarDescripcionPlato3(){
  document.getElementById("imagen--plato3").style.visibility="hidden";
  document.getElementById("mostrarContent3").style.background="#eb6974";
  document.getElementById("mostrarContent3").style.marginTop="-180px";
  document.getElementById("mostrarContent3").style.height="135px";
  document.getElementById('mostrarContent3').innerHTML="Sopa siukai<br>Kanlu wantan<br>Tay pa especial<br>+Arroz chaufa<br>+Wantan frito";
  document.getElementById('mostrarContent3').style.textAlign="center";
  document.getElementById('mostrarContent3').style.padding="45px 0 0 0";
  document.getElementById('mostrarContent3').style.borderTopRightRadius="20px";
  document.getElementById('mostrarContent3').style.borderTopLeftRadius="20px";
}
function mostrarImagen3(){
  document.getElementById('imagen--plato3').style.visibility="visible";
  document.getElementById('imagen--plato3').style.position="relative";
}
// FIN MOSTRAR DESCRIPCION PLATO 3

// MOSTRAR DESCRIPCION PLATO 4

function mostrarDescripcionPlato4(){
  document.getElementById("imagen--plato4").style.visibility="hidden";
  document.getElementById("mostrarContent4").style.background="#eb6974";
  document.getElementById("mostrarContent4").style.marginTop="-180px";
  document.getElementById("mostrarContent4").style.height="135px";
  document.getElementById('mostrarContent4').innerHTML="Sopa de wantan<br>Pollo c/ frutas<br>Chijaukay<br>+Arroz chaufa<br>+Wantan frito";
  document.getElementById('mostrarContent4').style.textAlign="center";
  document.getElementById('mostrarContent4').style.padding="45px 0 0 0";
  document.getElementById('mostrarContent4').style.borderTopRightRadius="20px";
  document.getElementById('mostrarContent4').style.borderTopLeftRadius="20px";
}
function mostrarImagen4(){
  document.getElementById('imagen--plato4').style.visibility="visible";
  document.getElementById('imagen--plato4').style.position="relative";
}
// FIN MOSTRAR DESCRIPCION PLATO 4

// MOSTRAR DESCRIPCION PLATO 5

function mostrarDescripcionPlato5(){
  document.getElementById("imagen--plato5").style.visibility="hidden";
  document.getElementById("mostrarContent5").style.background="#eb6974";
  document.getElementById("mostrarContent5").style.marginTop="-180px";
  document.getElementById("mostrarContent5").style.height="135px";
  document.getElementById('mostrarContent5').innerHTML="Sopa de pollo o Sopa Wantan<br>Chijaukay<br>Taypac especial<br>Pollo con frutas<br>+Arroz chaufa<br>+Wantan frito";
  document.getElementById('mostrarContent5').style.textAlign="center";
  document.getElementById('mostrarContent5').style.padding="45px 0 0 0";
  document.getElementById('mostrarContent5').style.borderTopRightRadius="20px";
  document.getElementById('mostrarContent5').style.borderTopLeftRadius="20px";
}
function mostrarImagen5(){
  document.getElementById('imagen--plato5').style.visibility="visible";
  document.getElementById('imagen--plato5').style.position="relative";
}
// FIN MOSTRAR DESCRIPCION PLATO 5