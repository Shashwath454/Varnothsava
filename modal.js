// Get the modal element and the link that opens it
var modal = document.getElementById('myModal');
var aboutLink = document.getElementById('aboutLink');

// When the user clicks on the link, open the modal
aboutLink.onclick = function() {
  modal.style.display = 'block';
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = 'none';
  }
};

// When the user clicks the close button, close the modal
var closeBtn = document.getElementsByClassName('close')[0];
closeBtn.onclick = function() {
  modal.style.display = 'none';
};
