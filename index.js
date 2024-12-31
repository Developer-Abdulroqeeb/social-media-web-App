
  // Attach the event listener for the 'ended' event to each video

// comment checking
const commentButtons = document.querySelectorAll('.comment');
const commentSections = document.querySelectorAll('.show_comment');
commentButtons.forEach((butt, inde) => {
    butt.addEventListener('click', function() {
        commentSections[inde].classList.toggle('comment_show');
    });
});


//  dlete and edit comment

const individual_comment = document.querySelectorAll('.individual_comment');
const edit_comment = document.querySelectorAll('.edit_comment');
individual_comment.forEach((buttdel, indexis) => {
    buttdel.addEventListener('click', function() {
        edit_comment[indexis].classList.toggle('commentdel');
    });
});


//  reply_comment

const reply = document.querySelectorAll('.reply');
const reply_section = document.querySelectorAll('.reply_section');
reply.forEach((butti, inde) => {
    butti.addEventListener('click', function() {
        reply_section[inde].classList.toggle('reply_show');
    });
});
// Select all content divs
var divs = document.querySelectorAll('.each_video');
var currentIndex = 0;
function scrollToDiv(index) {
divs[index].scrollIntoView({ behavior: 'smooth', block: 'start' });
}
scrollToDiv(currentIndex);
document.getElementById('nextButton').addEventListener('click', function() {
if (currentIndex < divs.length - 1) {
currentIndex++;
scrollToDiv(currentIndex);
}
});
document.getElementById('prevButton').addEventListener('click', function() {
if (currentIndex > 0) {
currentIndex--;
scrollToDiv(currentIndex);
}
});

// edit comment
const edit_commentis = document.querySelectorAll('.edit_commentis');
const formedit = document.querySelectorAll('.formedit');
edit_commentis.forEach((butedi, indedit) =>{
    butedi.addEventListener('click', function(){
    formedit[indedit].classList.toggle('editco');
    });
});


// delete mouseover

const dlete = document.querySelectorAll('.delete');
const mouse_move = document.querySelectorAll('.fa-trash');
  mouse_move.forEach((delmous,indmouse) =>{
  delmous.addEventListener('mouseover',function(){
   dlete[indmouse].style.display = "block";
  });
  });

