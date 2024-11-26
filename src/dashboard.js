function logout()
{
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "/src/logout.php", true);
	xhr.onload = function() {
        if (xhr.status === 200) {
            window.location.href = "/src";  // ログインページにリダイレクト
        } else {
            console.log("Logout failed");
        }
    };
	xhr.send();
}

window.onload = function()
{
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "/src/session.php", true);
	xhr.onload = function()
	{
		if (xhr.status === 200)
		{
			var response = JSON.parse(xhr.responseText);
			console.log(response);
			if (response.success)
			{
				document.getElementById("usernameDisplay").textContent = response.username;
			}
			else
			{
				window.location.href = "/src";
			}
		}
		else
		{
			console.log("error");
			window.location.href = "/src";
		}
	};
	xhr.send();
};
