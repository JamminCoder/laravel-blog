function confirmDelete()
{
  let text = {
    delete: 'Delete',
    cancel: 'Cancel'
  };
  let deletePostForm = document.getElementById('delete_post');
  let deletePostButton = document.getElementById('delete_post_button');
  deletePostForm.classList.toggle('hidden');

  if (deletePostButton.innerText === text.delete) {
    deletePostButton.innerText = text.cancel;

  } else {
    deletePostButton.innerText = text.delete;
  }
}
