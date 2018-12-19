//Caching the dom - Get all control buttons
var navbar = document.querySelector('#navigation-list'),
  form = document.querySelector('#form'),
  titleBtn = document.querySelector('.add-title'),
  authorBtn = document.querySelector('.add-author'),
  descriptionBtn = document.querySelector('.add-description'),
  featuredBtn = document.querySelector('.add-featured-image'),
  paragraphBtn = document.querySelector('.add-paragraph'),
  imageBtn = document.querySelector('.add-image'),
  subheadBtn = document.querySelector('.add-subheading'),
  submitBtn = document.querySelector('#done'),
  cancelBtn = document.querySelector('#cancel'),
  submitPostBtn = document.querySelector('#submit-post'),

  resultShow = document.querySelector('#result'),
  formCont = document.querySelector('.form-space'),   
  formHeader = document.querySelector('.form-space h2'),
  blog = document.querySelector('.blog-post'),
  iframe = document.querySelector('#blog-iframe');

function btnsHandler() {
    titleBtn.addEventListener("click", (e) => { displayForm(e,'title', 'Add Title', 7, 30); });
    authorBtn.addEventListener("click", (e) => { displayForm(e,'author', 'Add Author', 7, 30); });
    descriptionBtn.addEventListener("click", (e) => { displayForm(e,'description', 'Add Description', 10, 30); });
    paragraphBtn.addEventListener("click", (e) => { displayForm(e,'paragraph', 'Add Paragraph', 15, 60); });         
    subheadBtn.addEventListener("click", (e) => { displayForm(e,'heading', 'Add Heading', 7, 30); });
    featuredBtn.addEventListener("click", (e) => { displayForm(e,'featured', 'Featured Image'); });        
    imageBtn.addEventListener("click", (e) => { displayForm(e,'image', 'Add Image'); });        
    submitBtn.addEventListener("click", (e) => { sendData(e); });
    cancelBtn.addEventListener("click", (e) => { pageLayout(e); });
    submitPostBtn.addEventListener("click", (e) => { sendPost(e); });
}

function displayForm(e, name, placeholder, rows, cols) {
    e.preventDefault();
    var newTarget = e.target;
    if (typeof(lastTarget) === "undefined"){
        pageLayout();
        lastTarget = newTarget;
    }
    else {
        if(newTarget === lastTarget) {
            pageLayout();
            lastTarget = newTarget;
        }
        else {
            lastTarget = newTarget;
            if(formCont.classList.contains('form-hidden')) {
               pageLayout();
            }
        }
    }

    if(e.target === featuredBtn || e.target === imageBtn ) {
        var div = document.createElement('div');

        if(e.target === featuredBtn) {
            div.setAttribute('id', 'feat-image');
        }
        else if(e.target === imageBtn) {
            div.setAttribute('id', 'insert-image');
        }

        div.innerHTML = `
            <img src="" id="image-preview" data-url="">
            <p>Select an image to preview it:</p>
            <input id="image-insert" type="file" accept="image/*" />
        `;
        if(form.childElementCount == 2) {
            form.removeChild(form.firstElementChild);
        }
        formHeader.innerHTML = placeholder;
        form.insertBefore(div, form.lastElementChild);

        imgPreview = document.querySelector('#image-preview');
        imgInsert = document.querySelector('#image-insert');

        imgInsert.addEventListener('change', (e) => {
            let url;
            url = URL.createObjectURL(e.target.files[0]);
            imgPreview.src = url;
            imgPreview.addEventListener('load', (e) => {
                window.URL.revokeObjectURL(e.target.src);
            });
              
        });
        return;             
    }

    var textarea = document.createElement('textarea');
    textarea.setAttribute('name', name);
    textarea.setAttribute('placeholder', placeholder);
    textarea.setAttribute('rows', rows);
    textarea.setAttribute('cols', cols);
    textarea.setAttribute('id', name);

    if(form.childElementCount == 2) {
        form.removeChild(form.firstElementChild);
    }
    formHeader.innerHTML = placeholder;
    form.insertBefore(textarea, form.lastElementChild);
}

function pageLayout(e) {
    (e) ? e.preventDefault() : '';
    formCont.classList.toggle('form-hidden');
    if (formCont.classList.contains('form-hidden')) {
        //blog.style.width = '90%';
    }
    else {
        //blog.style.width = '64%';
    }
}

function sendData(e) {
    e.preventDefault();
    let value, message;
    let idTag = e.target.parentElement.parentElement.firstElementChild.id;
    (idTag === 'feat-image' || idTag === 'insert-image')  ? sendImage() : sendText() ;

    //Upload Text
    function sendText() {
        value = e.target.parentElement.parentElement.firstElementChild.value;
        message = idTag + ' ' + value;
        iframe.contentWindow.postMessage(message, '*'); 
        e.target.parentElement.parentElement.firstElementChild.value = '';     
    }

    //Upload Image
    function sendImage() {
        let imgUrl;

        let uploadedImage = imgInsert.files[0];
        let formData = new FormData();
        formData.append('image', uploadedImage);

        let serverUrl = 'upload-image.php';
        let xhr = new XMLHttpRequest();
        xhr.responseType = "text";
        xhr.onreadystatechange = (e) => {
            if (xhr.readyState === 4 && xhr.status === 200) {        
                imgUrl = xhr.response;
                message = idTag + ' ' + imgUrl;
                iframe.contentWindow.postMessage(message, '*');
            }
        }
        xhr.open('POST', serverUrl, true);
        xhr.send(formData); 
    }
}

function sendPost(e) {
    e.preventDefault(); 
    const title = iframe.contentDocument.querySelector('#title').innerHTML,
      author  = iframe.contentDocument.querySelector('#author').innerHTML,
      description  = iframe.contentDocument.querySelector('#description').innerHTML,
      ftImg  = iframe.contentDocument.querySelector('#featured-image').src,
      contentSection = iframe.contentDocument.querySelector('#blog-container'),
      oldContent = contentSection.innerHTML;
      content = changeImgSrc(oldContent, 'src="../', 'src="')
    console.log(content);

    var url = 'upload-post.php';
    var xhr = new XMLHttpRequest();
    xhr.responseType = "text";
    xhr.onreadystatechange = (e) => {
        if (xhr.readyState === 4 && xhr.status === 200) {        
            resultShow.innerHTML = xhr.response;
        }
    }
    xhr.open('POST', url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("title=" + title + "&author=" + author + "&description=" + description + "&featuredImage=" + ftImg + "&content=" + content);

    function changeImgSrc(content, oldSrc, newSrc) {
        let newContent = content;
        while (newContent.search(oldSrc) >= 0) {
            newContent = newContent.replace(oldSrc, newSrc);
        }
        return newContent;
    }

}
function mobileNav() {  
    if (navbar.classList.contains("show")) navbar.classList.value = 'mynavbar responsive';
    else if (navbar.classList.value == 'mynavbar') navbar.classList.value = 'mynavbar responsive show';
    else {navbar.classList.add('show');}
}

btnsHandler();

