function ajaxLike() {
	document.getElementById("like-button").style.display="none";
	document.getElementById("dislike-button").style.display="inline";
    var el = document.getElementById("id-img");
    var id = "data=" + el.dataset.id;
    var xhr = new XMLHttpRequest();
		xhr.open('POST', '/like-post/', true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.setRequestHeader("Content-lenght", id.lenght);
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {1
				console.log(xhr.responseText);
				 let likes = document.getElementById('likes-number');
				 likes.innerHTML = parseInt(likes.innerHTML) + 1;
			} 
		}
		xhr.send(id); 
}

function ajaxDislike() {
	document.getElementById("like-button").style.display="inline";
	document.getElementById("dislike-button").style.display="none";
    var el = document.getElementById("id-img");
    var id = "data1=" + el.dataset.id;
    var xhr = new XMLHttpRequest();
		xhr.open('POST', '/like-post/', true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.setRequestHeader("Content-lenght", id.lenght);
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {1
				console.log(xhr.responseText);
				 let likes = document.getElementById('likes-number');
				 likes.innerHTML = parseInt(likes.innerHTML) - 1;
			} 
		}
		xhr.send(id);
}

let commentBox = document.getElementById('comment-box'),
	button = document.getElementById('submit-comment');
    comments = document.getElementById('comments');
    let elem = document.getElementById('comments');
    var user = elem.dataset.parent;
    console.log(user); 
	
	button.addEventListener('click', function() {

	var el = document.getElementById("id-img");
	var id = el.dataset.id;
	
	if (commentBox.value.trim().length === 0) {
		alert('Comment must not be empty!');
		return ;
	}

	let fd = new FormData();
	fd.append('action', 'add_comment');
	fd.append('img-id', id);
	fd.append('body', commentBox.value);

	let xhr = new XMLHttpRequest();

	xhr.open('POST', '/add-comment/', true);

	xhr.onload = function () {

		let p = document.createElement('p');
		p.innerHTML = '<b>' + user + '</b> - '  + commentBox.value;

		comments.appendChild(p);
	};
	xhr.send(fd);
});