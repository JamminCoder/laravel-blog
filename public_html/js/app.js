// Auto resizing textarea code from: https://codepen.io/shshaw/pen/azzvBv

(function(){
  
  var textareas = document.querySelectorAll('textarea'),
      
      resize = function(t) {
        t.style.height = 'auto';
        t.style.overflow = 'hidden'; // Ensure scrollbar doesn't interfere with the true height of the text.
        t.style.height = (t.scrollHeight + t.offset ) + 'px';
        t.style.overflow = '';
      },
      
      attachResize = function(t) {
        if ( t ) {
          t.offset = !window.opera ? (t.offsetHeight - t.clientHeight) : (t.offsetHeight + parseInt(window.getComputedStyle(t, null).getPropertyValue('border-top-width')));

          resize(t);

          if ( t.addEventListener ) {
            t.addEventListener('input', function() { resize(t); });
            t.addEventListener('mouseup', function() { resize(t); }); // set height after user resize
          }

          t['attachEvent'] && t.attachEvent('onkeyup', function() { resize(t); });
        }
      };
  
  for (var i = 0; i < textareas.length; i++ ) {
    attachResize(textareas[i]);
  }
  
})();

function confirmDelete()
{
  let text = {
    delete: 'Delete',
    cancel: 'Cancel'
  };
  let deletePostForm = document.getElementById('delete_post');
  let deletePostButton = document.getElementById('delete_post_button');
  deletePostForm.classList.toggle('hide');

  if (deletePostButton.innerText === text.delete) {
    deletePostButton.innerText = text.cancel;
  } else {
    deletePostButton.innerText = text.delete;
  }
}
