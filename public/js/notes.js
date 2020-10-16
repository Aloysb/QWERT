//Set up initial height of the text areas.
const resizeTextAreas = (e) => {

    setTimeout(() => e.querySelector('textarea').style.height = `${e.querySelector('textarea').scrollHeight}px`, 100);
}


const saveNote = (el) => {
    let card = el.parentNode.parentNode.parentNode;
    let content = card.querySelector('textarea').value;

          $.ajax({
        url: `ajaxAddANote`,
        method: "POST",
        data: { content },
      }).done(function(res) {
        location.reload()
      })
}