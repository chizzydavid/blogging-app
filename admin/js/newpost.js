var blogSection = document.querySelector('.blog-container');
  window.addEventListener('message', (e) => {
    if(e.origin === window.location.origin) {
    	sortMessage(e);   
		}
});

function sortMessage(e) {
    var messgStr = e.data;
    var messgArr = messgStr.split(' ');

    switch(messgArr[0]) {
		case 'title': 
			 	messgArr.shift();
			displayMessage('title', messgArr);	    	
		break;

		case 'author': 
			 	messgArr.shift();
			displayMessage('author', messgArr);	    	
		break;	

		case 'description': 
			 	messgArr.shift();
			displayMessage('description', messgArr);	    	
		break;	

		case 'feat-image':
		  messgArr.shift();
		  displayMessage('featured-image', messgArr);
		break;	    	

		case 'heading': 
			 	messgArr.shift();
			insertHeading(messgArr);	    	
		break;	 	    	

		case 'paragraph': 
			 	messgArr.shift();
			insertParagraph(messgArr);	    	
		break;

		case 'insert-image':
			messgArr.shift();
			insertImage(messgArr);
    }  	
}

function displayMessage(string, messageArray) {
    el = document.querySelector('#' + string);
	var newMessgStr = messageArray.join(' ');
	if(string === 'featured-image') {
		el.src = newMessgStr;
		return;
	}
    el.innerHTML = newMessgStr;		      	
}

function insertHeading(array) {
  	var content = array.join(' ');
  	var newHeader = document.createElement('h3');
  	newHeader.innerHTML = content;
  	blogSection.appendChild(newHeader);
}

function insertParagraph(array) {
  	var content = array.join(' ');
  	var newParagraph = document.createElement('p');
  	newParagraph.innerHTML = content;
  	blogSection.appendChild(newParagraph);
}

function insertImage(array) {
  	var imageSrc = array.join(' ');
  	var newImageWrapper = document.createElement('p');
  	newImageWrapper.setAttribute('class', 'new-image');
  	newImageWrapper.innerHTML = `
  	  <img class="image-insert" src="${imageSrc}"/>
  	`;
  	blogSection.appendChild(newImageWrapper);
}