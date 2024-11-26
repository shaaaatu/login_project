function loginForm(event)
{
	event.preventDefault();
	var data = new FormData(document.getElementById("loginForm"));
	for (var pair of data.entries())
	{
		console.log(pair[0] + ': ' + pair[1]);
	}
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "/src/login.php", true);
	xhr.onload = function()
	{
		if (xhr.status === 200)
		{
			var response = JSON.parse(xhr.responseText);
			if (response.success)
			{
				window.location.href = "/src/dashboard.html";
			}
			else
			{
				document.getElementById("errorMessage").textContent = response.error;
			}
		}
		else
		{
			console.log("error");
			document.getElementById("errorMessage").textContent = "error occured";
		}
	}
	xhr.send(data);
}

function createUser(event)
{
	event.preventDefault();
	var data = new FormData(document.getElementById("createUser"));
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "/src/create_user.php", true);
	xhr.onload = function()
	{
		if (xhr.status === 200)
		{
			var response = JSON.parse(xhr.responseText);
			if (response.success)
			{
				document.getElementById("successMessage").textContent = "success";
			}
			else
			{
				document.getElementById("errorMessage").textContent = "failed to create user";
			}
		}
		else
		{
			document.getElementById("errorMessage").textContent = "error occured";
		}
	}
	xhr.send(data);
}


function createTable()
{
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "/src/create.php", true);
	// xhr.onload = function()
	// {
	// 	if (xhr.status === 200)
	// 	{
	// 		if (response.success)
	// 		{
	// 			document.getElementById("createSuccess").textContent = "success";
	// 		}
	// 		else
	// 		{
	// 			document.getElementById("createError").textContent = "failed to create";
	// 		}
	// 	}
	// 	else
	// 	{
	// 		document.getElementById("createError").textContent = "error occured";
	// 	}
	// }
	xhr.send();
}

function clearTable()
{
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "/src/clear.php", true);
	xhr.send();
}
