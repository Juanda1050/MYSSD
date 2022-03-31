var list_num_rectangulares = [];
function addNumber() {
  let num_rectangulares = parseFloat(
    document.getElementById("num_rectangulares").value
  );
  if (isNaN(num_rectangulares)) {
    alert("Ingrese un numero");
  } else {
    list_num_rectangulares.push(num_rectangulares);
    document.getElementById("print_num").innerHTML +=
      "[" + num_rectangulares + "]";
  }
  document.getElementById("num_rectangulares").value = "";
  console.log(list_num_rectangulares);
}

var jsonString = JSON.stringify(list_num_rectangulares);
$.ajax({
  url: "../simulations/kolmogorov_manual.php",
  method: "POST",
  data: { list_num_rectangulares: jsonString },
  success: function () {
    alert('SI');
  },
  error: function () {
    alert("error");
}
});
