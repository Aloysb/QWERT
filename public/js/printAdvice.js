function printAdvice(file_id) {
  if (!file_id) {
    print();
    //     html2canvas(document.querySelector(".container-showFile"), {
    //     onrendered: function(canvas) {
    //         var imgData = canvas.toDataURL(
    //             'image/png');
    //         var doc = new jsPDF('p', 'mm');
    //         doc.addImage(imgData, 'PNG', 10, 10);
    //         doc.save('sample-file.pdf');
    //     }
    // });
  } else {
    document.getElementById(file_id).click();
    setTimeout(() => print(), 1000);
  }
}

function printCompta() {
  setTimeout(() => print(), 1000);
}
