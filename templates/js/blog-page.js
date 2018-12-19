$(document).ready(function(){
  let pageNumber = 1,
    blogContainer = document.querySelector('.blog-entry-container'),
    morePosts = $('#more-posts'),
    info = $('#info-space');
  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
    }
  };
  // Collapse now if page is not at top
  navbarCollapse();
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);

  morePosts.on('click', (e) => {
    e.preventDefault();
    loadPosts();
  });

    //load this data with jquery
    /*function loadPosts() {
        let nextPage = pageNumber + 1;
        let url = 'index.php';
        var xhr = new XMLHttpRequest();
        xhr.responseType = "json";
        xhr.onreadystatechange = (e) => {
            if (xhr.readyState === 4 && xhr.status === 200) {        
                //$('#testxhr').text(xhr.response);
                displayNewPosts(xhr.response);
                pageNumber++;
            }
        }
        xhr.open('POST', url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("page="+nextPage);
    }
    */ 
    function loadPosts() {
        let nextPage = pageNumber + 1;
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: 'page='+nextPage,
            dataType: 'json',
            complete: (data) => {
                console.log(data);
                displayNewPosts(data.responseJSON);
                pageNumber++;
            }
        });
    }

    function displayNewPosts(posts) {
        if (posts.length == 0) {
            info.text('No more posts to display');
            morePosts.hide(500);
            return;
        }
        let newPosts = '';
        posts.map((post) => {
          newPosts +=  `
            <div class=\"blog-entry\">
                <h2 class='mb-1 blog-title'><a href=\"view-post.php?p=${post.ID}\">${post.ID} ${post.postTitle}</a></h2>
                <p class='blog-desc'>${post.postDesc}</p>
              </div>
            `;  
        });
        blogContainer.innerHTML += newPosts;
    } 
});
