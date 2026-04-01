<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Escanear QR</title>

<script src="https://unpkg.com/html5-qrcode"></script>

</head>

<body>

<h2>Escaneo de asistencia</h2>

<div id="reader" style="width:400px"></div>

<script>
function onScanSuccess(decodedText) {

fetch("includes/registrar_asistencia.php", {

method: "POST",
headers: {
"Content-Type":"application/x-www-form-urlencoded"
},

body:"codigo="+decodedText

})
.then(res=>res.text())
.then(data=>{

document.getElementById("mensaje").innerHTML=data;

setTimeout(()=>{
document.getElementById("mensaje").innerHTML="";
},2000);

});

}
let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", // Debe coincidir con el id del div <div id="reader">
    { fps: 3, qrbox: {width: 250, height: 250} },
    false
);

html5QrcodeScanner.render(onScanSuccess);

</script>
<div id="mensaje"></div>
</body>
</html>