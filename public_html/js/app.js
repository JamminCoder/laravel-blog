// Automatically resize textareas
// Credit to Stackoverflow user DreamTeK: https://stackoverflow.com/a/25621277/17273033
try {
  const tx = document.getElementsByTagName("textarea");
  for (let i = 0; i < tx.length; i++) {
    tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;overflow-y:hidden;");
    tx[i].addEventListener("input", OnInput, false);
    window.addEventListener('resize', () => {
      tx[i].style.height = "auto";
      console.log(tx[i].style.height);
      tx[i].style.height = (tx[i].scrollHeight) + "px";
    });
  }
} catch (e){};


function OnInput() {
  this.style.height = "auto";
  this.style.height = (this.scrollHeight) + "px";
}

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
