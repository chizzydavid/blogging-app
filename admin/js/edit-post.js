//Caching the dom - Get all control buttons
const form = document.querySelector('#form'),
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
    titleBtn.addEventListener("click", (e) => { displayForm(e,'title', 'Edit Title', 7, 30); });
    authorBtn.addEventListener("click", (e) => { displayForm(e,'author', 'Edit Author', 7, 30); });
    descriptionBtn.addEventListener("click", (e) => { displayForm(e,'description', 'Edit Description', 10, 30); });
    paragraphBtn.addEventListener("click", (e) => { displayForm(e,'paragraph', 'Add Paragraph', 15, 60); });         
    subheadBtn.addEventListener("click", (e) => { displayForm(e,'heading', 'Add Heading', 7, 30); });
    featuredBtn.addEventListener("click", (e) => { displayForm(e,'featured', 'Featured Image'); });        
    imageBtn.addEventListener("click", (e) => { displayForm(e,'image', 'Add Image'); });        
    submitBtn.addEventListener("click", (e) => {sendData(e); });
    /*if (submitBtnState !== 1 ) { return; } else {sendData(e);} });*/
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
        blog.style.width = '90%';
    }
    else {
        blog.style.width = '64%';
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
    e.preventDefault(); var title, author, description, ftImg, contentSection, content, images, imgArray;
    title = iframe.contentDocument.querySelector('#title').innerHTML;
    author  = iframe.contentDocument.querySelector('#author').innerHTML;
    description  = iframe.contentDocument.querySelector('#description').innerHTML;
    ftImg  = iframe.contentDocument.querySelector('#featured-image').src;
    contentSection = iframe.contentDocument.querySelector('#blog-container');
    content = contentSection.outerHTML;
    images = contentSection.querySelectorAll('img');
    imgArray = Array.from(images);
    imgArray.forEach((el) => {
        var imgSrc = el.src;
        var newImgSrc = imgSrc.replace('../', '');
        el.src = newImgSrc;
    });

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
}

btnsHandler();






var post = document.querySelector('#post');

function init() {
    
    iframe.onload = (e) => {

        var postTitle = post.querySelector('#post-title').innerHTML;
        var postAuthor = post.querySelector('#post-author').innerHTML;
        var postDesc = post.querySelector('#post-desc').innerHTML;
        var postFeaturedImg = post.querySelector('#feat-image').innerHTML;
        var postContent = post.querySelector('#post-content').innerHTML;

        iframe.contentDocument.querySelector('#title').innerHTML = postTitle;
        iframe.contentDocument.querySelector('#author').innerHTML = postAuthor;
        iframe.contentDocument.querySelector('#featured-image').src = postFeaturedImg;
        iframe.contentDocument.querySelector('#blog-container').outerHTML = postContent;


        var pargs = iframe.contentDocument.querySelectorAll('p');
        var imgs = iframe.contentDocument.querySelectorAll('img');
        if (pargs.length !== 0) {
            var parArray = Array.from(pargs);
            parArray.forEach(el => {
                el.addEventListener('click', (e) => { editParagraph(e) }, true);
            });
        }

        if (imgs.length !== 0) {
            var imgArray = Array.from(imgs);
            imgArray.forEach(el => {
                el.addEventListener('click', (e) => { editImage(e) });
            });
        }

    }
}

function editParagraph(e) {
    if (cancelBtn.previousElementSibling.id === 'save') {
        return;
    }
    saveBtn = document.createElement('input');
    saveBtn.id = 'save'; saveBtn.value = 'Save'; saveBtn.type = 'submit';
    submitBtn.parentElement.replaceChild(saveBtn, submitBtn);
    var saveBtn = document.querySelector('#save');
    var newValue;
    displayForm(e,'paragraph', 'Edit Paragraph', 15, 60);
    var editForm = document.querySelector('#paragraph');
    var p = e.target;
    p.setAttribute('id', "current-edit");
    editForm.value = p.innerHTML;
    saveBtn.addEventListener('click', (e) => {
        e.preventDefault();
        newValue = e.target.parentElement.parentElement.firstElementChild.value;
        iframe.contentDocument.querySelector('#current-edit').innerHTML = newValue;
        editForm.value = '';
        saveBtn.parentElement.replaceChild(submitBtn, saveBtn);
        p.removeAttribute('current-edit');
    });
}

















function editImage(e) {
    console.log('imgfunc');
    e.preventDefault(); e.stopPropagation();
    if (cancelBtn.previousElementSibling.id === 'save') {
        return;
    }
    saveBtn = document.createElement('input');
    saveBtn.id = 'save-img'; saveBtn.value = 'Save Image'; saveBtn.type = 'submit';
    submitBtn.parentElement.replaceChild(saveBtn, submitBtn);
    var saveImgBtn = document.querySelector('#save');
    var newValue;
    displayForm(e,'paragraph', 'Edit Paragraph', 15, 60);
    var editForm = document.querySelector('#paragraph');
    var curImg = e.target;
    curImg.setAttribute('id', "current-edit-image");
    editForm.value = curImg.src;
    saveBtn.addEventListener('click', (e) => {
        e.preventDefault();
        newValue = e.target.parentElement.parentElement.firstElementChild.value;
        iframe.contentDocument.querySelector('#current-edit').innerHTML = newValue;
        saveBtn.parentElement.replaceChild(submitBtn, saveBtn);
        curImg.removeAttribute('current-edit-image');
    });
}










init();
//Features to be added
//double click on any post element and a popup menu appears. 
//To either Delete, Edit, Insert(Paragraph or Image); 
//Edit Images
//in edit paragraph show the save button after the input field has 'changed'

























