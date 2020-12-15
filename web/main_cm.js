var button_login = document.getElementById("button_login");
var button_logout = document.getElementById("button_logout");
var button_search = document.getElementById("button_send");
var screen_login = document.getElementById("container_login");
var screen_user = document.getElementById("container_user");
var name_label = document.getElementById("user_name");
var table_label = document.getElementById("table_name");
var firstRow = document.querySelector('#firstRow');
var otherRows = document.querySelector('#otherRows');
var uid = "";



button_login.onclick = function(){
	const xhttp = new XMLHttpRequest();
	let name = document.getElementById("name").value;
	let password = document.getElementById("password").value
	let url = "http://localhost:8080/pbe_server/login.php?username=".concat(name+"&password="+password);
	console.log(url);
	xhttp.open('GET', url, true);
	xhttp.send();
	xhttp.onreadystatechange = function(){
		if(this.readyState ==4 && this.status == 200){
			let data = JSON.parse(this.responseText);
			uid = data.uid;
			if (data.name != "ERROR"){
				screen_login.style.display = "none";
				screen_user.style.display = "block";
				name_label.innerHTML= data.name;
			}
			else{
				alert("Error en la introduccio de dades.");
			}
		}
	}
}

button_search.onclick = function(){
	const xhttp = new XMLHttpRequest();
	let constraints = document.getElementById("constraints").value;
	let constrSeparadas = constraints.split('?');
	let url = "";
	if(constrSeparadas[1] == ""){
		url = "http://localhost:8080/pbe_server/index.php?".concat(constraints+"uid="+uid);
	}
	else{
		url = "http://localhost:8080/pbe_server/index.php?".concat(constraints+"&uid="+uid);
	}
	xhttp.open('GET', url, true);
	xhttp.send();
	xhttp.onreadystatechange = function(){
		if(this.readyState ==4 && this.status == 200){
			let data = JSON.parse(this.responseText);
			let claves = Object.keys(data);
			let valores = Object.values(data);
			table_label.innerHTML= claves[1];
			claves = Object.keys(Object.values(valores[1])[0]);
			firstRow.innerHTML="";
			firstRow.innerHTML +=`
				${crearRegistro(claves)}
			`;
			valores = valores[1];
			otherRows.innerHTML="";
			otherRows.innerHTML+=`
				${crearTabla(valores)}
			`;
		}
	}
}

function crearRegistro(val){
	stringHtml = "";
	let i = 0;
	while(val[i]){
		stringHtml += `<td class="val">${val[i]}</td>`
		i ++;
	}
	return stringHtml;
}

function crearTabla(val){
	stringHtml = "";
	let i=0;
	while(val[i]){
		let registro = Object.values(val[i]);
		stringHtml +=`
			<tr class="reg">
				${crearRegistro(registro)}
			</tr>
		`;
		i ++;
	}
	return stringHtml;
}

button_logout.onclick = function(){
	screen_login.style.display = "flex";
	screen_user.style.display = "none";
	firstRow.innerHTML="";
	otherRows.innerHTML="";
	table_label.innerHTML= "";
	name_label.innerHTML="";
}


