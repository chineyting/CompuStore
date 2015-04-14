// function calculateTotal (argument) {
// // 	alert("Hi there");
//     var total = 
//     document.getElementById('total_cost').innerHTML = 
    
// }

// var quantity = new Array();
// quantity["1"]=1;
// quantity["2"]=2;
// quantity["3"]=3;

// function getQuantity() {
// 	var laptopQuantity=0;

// 	var theForm = document.forms["orderForm"];

// 	var selectedQuantity = theForm.elements["laptopNumber"];

// 	laptopQuantity = quantity[selectedQuantity.value];

// 	return laptopQuantity;
// }

// function calculateTotal (argument) {
//     var price = document.getElementById("price");
//     var total = getQuantity() * price;
//     document.getElementById('total_cost').innerHTML = total;
// }

function calculateTotal() {
    var x = document.getElementById("laptopNumber").value;
    var price = document.getElementById("price");
    var total = x * price;
    document.getElementById("total_cost").innerHTML = "Total Cost: " + total;
}
