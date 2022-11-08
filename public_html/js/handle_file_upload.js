const POST_CONTENT = document.getElementById('content');
const POST_ID = document.getElementById('post_id').getAttribute('value');

function uploadImage(url, image, imageName, contentType) {
    let http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.setRequestHeader('Content-type', contentType);
    let params = 'image=' + btoa(image) + '&post_id=' + POST_ID;
    http.send(params);

	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
			console.log(http.responseText);
			let imageURL = http.getResponseHeader('url');
			let markdownImage = `  \n![${imageName}](${imageURL})\n  `;
			POST_CONTENT.value += markdownImage;
		}
	}
}

function dropHandler(ev) {
    console.log('File(s) dropped');
  
    // Prevent default behavior (Prevent file from being opened)
    ev.preventDefault();

	const reader = new FileReader();
  
    if (ev.dataTransfer.items) {
      	// Use DataTransferItemList interface to access the file(s)
		for (let i = 0; i < ev.dataTransfer.items.length; i++) {
			// If dropped items aren't files, reject them
			if (ev.dataTransfer.items[i].kind === 'file') {
				let file = ev.dataTransfer.items[i].getAsFile();
				console.log('... file[' + i + '].name = ' + file.name);
				reader.readAsBinaryString(file)

				reader.onloadend = () => {
					uploadImage(
						'/image/upload', 
						reader.result,
						file.name,
						'application/url-encoded'
					);
				}
				
			}
		}

    } else {
      	// Use DataTransfer interface to access the file(s)
      	for (let i = 0; i < ev.dataTransfer.files.length; i++) {
        	console.log('... file[' + i + '].name = ' + ev.dataTransfer.files[i].name);
      	}
    }
}

let imgInput = document.getElementById('upload_image');
imgInput.addEventListener('change', buttonUploadHandler)

function buttonUploadHandler()
{
	
	let img = imgInput.files[0];
	let reader = new FileReader();

	reader.readAsBinaryString(img);

	reader.onloadend = () => uploadImage(
		'/image/upload', 
		reader.result,
		img.name,
		'application/url-encoded'
	);
}