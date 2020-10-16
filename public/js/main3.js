const urlroot = `${window.origin}/`;

function ajaxGet(url, callback) {
  let req = new XMLHttpRequest();
  req.open('GET', url);
  req.addEventListener('load', function () {
    if (req.status >= 200 && req.status < 400) {
      callback(req.responseText);
    } else {
      console.error(`${req.status} ${req.statusText} ${url}`);
    }
  });
  req.addEventListener('error', function () {
    console.error(`Erreur réseau avec l'url ${url}`);
  });
  req.send(null);
}

function ajaxPost(url, data, callback, isJson) {
  let req = new XMLHttpRequest();
  req.open('POST', url);
  req.addEventListener('load', function () {
    if (req.status >= 200 && req.status < 400) {
      callback(req.responseText);
    } else {
      console.error(`${req.status} ${req.statusText} ${url}`);
    }
  });
  req.addEventListener('error', function () {
    console.error(`Erreur réseau avec l'url ${url}`);
  });
  if (isJson) {
    req.setRequestHeader('Content-Type', 'application/json');

    data = JSON.stringify(data);
  }
  req.send(data);
}

function htmlDecode(input) {
  var e = document.createElement('div');
  e.innerHTML = input;
  return e.childNodes[0].nodeValue;
}

function htmlspecialchars_decode(string, quoteStyle) {
  var optTemp = 0;
  var i = 0;
  var noquotes = false;

  if (typeof quoteStyle === 'undefined') {
    quoteStyle = 2;
  }
  string = string.toString().replace(/&lt;/g, '<').replace(/&gt;/g, '>');
  var OPTS = {
    ENT_NOQUOTES: 0,
    ENT_HTML_QUOTE_SINGLE: 1,
    ENT_HTML_QUOTE_DOUBLE: 2,
    ENT_COMPAT: 2,
    ENT_QUOTES: 3,
    ENT_IGNORE: 4,
  };
  if (quoteStyle === 0) {
    noquotes = true;
  }
  if (typeof quoteStyle !== 'number') {
    quoteStyle = [].concat(quoteStyle);
    for (i = 0; i < quoteStyle.length; i++) {
      if (OPTS[quoteStyle[i]] === 0) {
        noquotes = true;
      } else if (OPTS[quoteStyle[i]]) {
        optTemp = optTemp | OPTS[quoteStyle[i]];
      }
    }
    quoteStyle = optTemp;
  }
  if (quoteStyle & OPTS.ENT_HTML_QUOTE_SINGLE) {
    string = string.replace(/&#0*39;/g, "'");
  }
  if (!noquotes) {
    string = string.replace(/&quot;/g, '"');
  }
  string = string.replace(/&amp;/g, '&');

  return string;
}

const searchMedicalFolder = document.getElementById('searchMedicalFolder');
const resultMedicalFolder = document.getElementById('resultMedicalFolder');
const listFolderElt = document.getElementById('folders');
const searchMedicalFile = document.getElementById('searchMedicalFile');
const resultMedicalFile = document.getElementById('resultMedicalFile');
const listFilesElt = document.getElementById('files');

let FolderNameArray = [];

function getMatches(inputText, data) {
  let matchList = [];
  for (let i = 0; i < data.length; i++) {
    if (data[i].toLowerCase().lastIndexOf(inputText.toLowerCase(), 0) != -1) {
      matchList.push(data[i]);
    }
  }
  return matchList;
}

let resultsCursor = 0;

function moveCursor(pos, list) {
  for (let i = 0; i < list.children.length; i++) {
    list.children[i].classList.remove('active');
  }
  list.children[pos].classList.add('active');
}

function displayMatches(matchList, list) {
  let tab = [];

  if (list === listFolderElt) {
    for (let i = 0; i < list.children.length; i++) {
      if (matchList[0] === list.children[i].childNodes[1].data) {
        tab.push(list.children[i].id);
      }
    }
    list.insertBefore(document.getElementById(tab[0]), list.childNodes[0]);
    moveCursor(resultsCursor, list);
    resultMedicalFolder.scrollTop = 0;
  } else {
    for (let i = 0; i < list.childNodes.length; i++) {
      if (matchList[0] === list.childNodes[i].childNodes[0].data) {
        tab.push(list.childNodes[i].id);
      }
    }

    list.insertBefore(document.getElementById(tab[0]), list.childNodes[0]);
    moveCursor(resultsCursor, list);
    resultMedicalFolder.scrollTop = 0;
  }
}

function getFiles(idFolder) {
  // Remove notificaiton
  ajaxPost(`${urlroot}single/removeNotifFromFolder`, idFolder, function (
    response
  ) {
    //Hide the notif if successfully removed from db/
    if (document.getElementById(`folder-${idFolder}`).querySelector('.notif')) {
      document
        .getElementById(`folder-${idFolder}`)
        .querySelector('.notif').style.display = 'none';
    }

    //Check if all notified folders have been open or if none exits.
    if (
      [...document.getElementById('folders').querySelectorAll('.notif')].every(
        (el) => el.style.display == 'none'
      ) ||
      [...document.getElementById('folders').querySelectorAll('.notif')] == []
    ) {
      if (
        document
          .querySelector('.category__link--active')
          .querySelector('.notif')
      ) {
        //If that's the case, hide the notification.
        document
          .querySelector('.category__link--active')
          .querySelector('.notif').style.display = 'none';
      }
    }
  });

  listFilesElt.textContent = '';
  ajaxPost(
    `${urlroot}pages/ajaxPostDataFile`,
    idFolder,
    function (response) {
      resultMedicalFile.appendChild(listFilesElt);
      let dataFiles = JSON.parse(response);

      if (dataFiles.length === 0) {
        let buttonFileElt = document.createElement('a');
        buttonFileElt.className = 'list-group-item btn btn-light text-primary';
        buttonFileElt.textContent = 'aucune fiches';
        listFilesElt.appendChild(buttonFileElt);
        searchMedicalFolder.focus();
      } else {
        dataFiles.forEach((element, index) => {
          let buttonFileElt = document.createElement('a');
          buttonFileElt.className =
            'list-group-item btn btn-light text-primary';
          buttonFileElt.id = `file_${element.id}`;
          buttonFileElt.textContent = ` ${element.title}`;
          // console.log(<?=($_SESSION['data_user']->{'role'} == 'ROLE_SUBSCRIBER') || ($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN') ?>)
          if (element.status == 0) {
            buttonFileElt.insertAdjacentHTML(
              'afterBegin',
              `<img src = "/assets/icon_proto/Icon - Notes.svg" />${
                element.notif == 1 ? '<span class="notif"></span>' : ''
              }
                         <div class="three_dots" onClick="setCurrentFileTo(event)">
  <span class="" style="overflow: hidden;" ${
    subscribed
      ? 'type="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"'
      : 'data-toggle="modal" data-target="#exampleUnsubscribing"'
  }
  >
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
  </span>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <div type="" class="dropdown-item" onClick="duplicateFile(event)">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> Dupliquer la fiche</div>
    <div class="dropdown-item" data-toggle="modal" data-target="#moveFileModal">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-in"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>Déplacer la fiche</div>
      </div>
</div>
                    <span class="badge badge-pill badge-danger">Non lue</span>`
            );
          } else {
            buttonFileElt.insertAdjacentHTML(
              'afterBegin',
              `<img src = "/assets/icon_proto/Icon - Notes.svg" />
                    <div class="three_dots" onClick="setCurrentFileTo(event)">
  <span class="" style="overflow: hidden;"   ${
    subscribed
      ? 'type="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"'
      : 'data-toggle="modal" data-target="#exampleUnsubscribing"'
  }>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
  </span>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <div type="" class="dropdown-item" onClick="duplicateFile(event)">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>Dupliquer la fiche</div>
    <div class="dropdown-item" data-toggle="modal" data-target="#moveFileModal">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-in"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>Déplacer la fiche</div>
      </div>
</div>
<span class="badge badge-pill badge-success">Déjà lue</span>`
            );
          }
          if (window.location.pathname.includes('conseil')) {
            buttonFileElt.insertAdjacentHTML(
              'afterBegin',
              `<p class="btn btn-print" onClick = "printAdvice('file_${element.id}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    Imprimer</p>`
            );
          }
          listFilesElt.appendChild(buttonFileElt);
        });
        searchMedicalFile.focus();
      }
    },
    true
  );

  document
    .getElementById('addFileByFolder')
    .addEventListener('click', function () {
      document.querySelector('.first').classList.add('animate');
      document.querySelector('.second').classList.add('animate');
    });
  document
    .getElementById('return-create-file')
    .addEventListener('click', function () {
      document.querySelector('.second').classList.remove('animate');
      document.querySelector('.first').classList.remove('animate');
    });
}

function moveIconFolder() {
  if (
    listFolderElt.children[resultsCursor].childNodes[0].className ===
    'fa fa-folder'
  ) {
    for (let i = 0; i < listFolderElt.children.length; i++) {
      listFolderElt.children[i].childNodes[0].className = 'fa fa-folder';
    }
    listFolderElt.children[resultsCursor].childNodes[0].className =
      'fa fa-folder-open';
  } else if (
    listFolderElt.children[resultsCursor].childNodes[0].className ===
    'fa fa-folder-open'
  ) {
    for (let i = 0; i < listFolderElt.children.length; i++) {
      listFolderElt.children[i].childNodes[0].className = 'fa fa-folder';
    }
    listFolderElt.children[resultsCursor].childNodes[0].className =
      'fa fa-folder';
  }
}

function displayFolderAndNumber(event) {
  if (event.type === 'click') {
    let nameFolder = event.target.firstElementChild.nextSibling.data;
    let numberOfFileForFolder = Number(
      event.target.firstElementChild.nextSibling.nextElementSibling.firstChild
        .data
    );
    const newNameFolderElt = document.getElementById('newNameFolder');
    newNameFolderElt.innerHTML = `<span class="nameFolderBase">Fiches \/</span><span class='nameFolderTitle'>${nameFolder.toLowerCase()}</span>`;
  }
  if (event.type === 'keydown') {
    let nameFolder =
      resultMedicalFolder.children[0].children[resultsCursor].childNodes[1]
        .data;
    let numberOfFileForFolder = Number(
      resultMedicalFolder.children[0].children[resultsCursor].childNodes[1]
        .nextSibling.firstChild.data
    );
    const newNameFolderElt = document.getElementById('newNameFolder');
    newNameFolderElt.innerHTML = `<span class="nameFolderBase">Fiches \/</span><span class='nameFolderTitle'>${nameFolder.toLowerCase()}</span>`;
  }
}

if (searchMedicalFolder) {
  searchMedicalFolder.addEventListener('keydown', function (event) {
    for (let i = 0; i < listFolderElt.children.length; i++) {
      FolderNameArray.push(listFolderElt.children[i].childNodes[1].data);
    }

    switch (event.code) {
      // case 'Enter':
      //     searchMedicalFolder.value = resultMedicalFolder.children[0].children[resultsCursor].childNodes[1].data;
      //     console.log(searchMedicalFolder);
      //     moveIconFolder();
      //     let getIdFolder = resultMedicalFolder.children[0].children[resultsCursor].id;
      //     let idFolder = getIdFolder.split('-');
      //     idFolder = Number(idFolder[1]);
      //     getFiles(searchMedicalFolder.value,idFolder);
      //     displayFolderAndNumber(event);
      //     break;
      case 'ArrowUp':
        if (resultsCursor > 0) {
          resultsCursor--;
          moveCursor(resultsCursor, listFolderElt);
        }
        break;
      case 'ArrowDown':
        if (resultsCursor < FolderNameArray.length - 1) {
          resultsCursor++;
          moveCursor(resultsCursor, listFolderElt);
        }
        break;
    }
  });

  searchMedicalFolder.addEventListener('input', function (event) {
    for (let i = 0; i < listFolderElt.children.length; i++) {
      FolderNameArray.push(listFolderElt.children[i].childNodes[1].data);
    }
    let matches = [];

    if (this.value.length > 0) {
      matches = getMatches(this.value, FolderNameArray);
      if (matches.length > 0) {
        resultsCursor = 0;
        displayMatches(matches, listFolderElt);
      }
    }
  });
}

window.onload = function () {
  let ret;
  let retIdFolder;
  let getIdFolderAdd;
  if (window.location.href === `${urlroot}pages/fiche`) {
    ajaxPost(
      `${urlroot}single/ajaxGetTrackFile`,
      null,
      function (response) {
        if (response) {
          ret = JSON.parse(response);
          if (ret.length > 0) {
            retIdFolder = ret[0].medicalFolder_id;
            getIdFolderAdd = `folder-${Number(retIdFolder)}`;
            if (document.getElementById(getIdFolderAdd)) {
              document
                .getElementById('folders')
                .insertBefore(
                  document.getElementById(getIdFolderAdd),
                  document.getElementById('folders').childNodes[0]
                );
              document
                .getElementById('folders')
                .childNodes[0].classList.add('active');
              moveIconFolder();
              getFiles(ret[0].medicalFolder_id);
              searchMedicalFile.focus();
            }
          }
        } else {
          return;
        }
      },
      true
    );
  }
};

let valueInputSearchMedicalFolder;
if (listFolderElt) {
  listFolderElt.addEventListener('click', function (event) {
    ajaxPost(
      `${urlroot}single/ajaxPostResetTracker`,
      null,
      function () {},
      false
    );
    searchMedicalFolder.classList.remove('is-invalid');
    searchMedicalFolder.classList.add('is-valid');
    searchMedicalFolder.value = event.target.childNodes[1].data.trim();
    valueInputSearchMedicalFolder = searchMedicalFolder.value;

    let dataFolder = event.target.childNodes[1].data;
    let getIdFolder = event.target.id;
    let idFolder = getIdFolder.split('-');
    idFolder = Number(idFolder[1]);

    for (let i = 0; i < listFolderElt.children.length; i++) {
      listFolderElt.children[i].classList.remove('active');
    }

    event.target.childNodes[1].parentElement.classList.add('active');

    // This sort the list of meidcal folders by putting the active element at the top
    // listFolderElt.insertBefore(document.getElementById(getIdFolder), listFolderElt.childNodes[0]);
    moveIconFolder();
    getFiles(idFolder);
    searchMedicalFile.focus();
  });
}

if (searchMedicalFolder) {
  searchMedicalFile.addEventListener('keydown', function (event) {
    let listDataFiles = [];
    resultMedicalFile.childNodes[0].childNodes.forEach((element) => {
      listDataFiles.push(element.childNodes[0].data);
    });

    switch (event.code) {
      // case 'Enter':
      //     let fileEltWithActiveClass = [];
      //     resultMedicalFile.childNodes[0].childNodes.forEach((element) => {
      //         if (element.classList.contains('active')){
      //             fileEltWithActiveClass.push(element.id);
      //         }
      //     });
      //     fileEltWithActiveClass = fileEltWithActiveClass[0].split("_");
      //     let idFile = Number(fileEltWithActiveClass[1]);
      //     window.location.href = `${urlroot}single/index/${idFile}`;
      //     break;
      case 'ArrowUp':
        if (resultsCursor > 0) {
          resultsCursor--;
          moveCursor(resultsCursor, resultMedicalFile.childNodes[0]);
        }
        break;
      case 'ArrowDown':
        if (resultsCursor < listDataFiles.length - 1) {
          resultsCursor++;
          moveCursor(resultsCursor, resultMedicalFile.childNodes[0]);
        }
        break;
      case 'ArrowLeft':
        searchMedicalFolder.focus();
        break;
    }
  });
}

let idFile;
let idFolder;
let ArrayDelete = [];
let regex = /^file_\d+/;

const displayFile = (description) => {
  document.getElementById('description-show').innerHTML = description;
  //Highlight search items.
  if (!sessionStorage.getItem('searchValue')) return;
  else {
    let re = new RegExp(sessionStorage.getItem('searchValue'), 'gi');
    var context = document.getElementById('description-show');
    var instance = new Mark(context);
    instance.mark(sessionStorage.getItem('searchValue'), [
      (caseSensitive = true),
    ]);
    // document.getElementById('description-show').innerHTML = document.getElementById('description-show').innerHTML.replace(re, `<span style="background: gold !important">${sessionStorage.getItem("searchValue")}</span>`)
  }
};

document.addEventListener('click', function (event) {
  if (
    event.target == document.getElementById('return-create-file') ||
    event.target == document.getElementById('return-files-edit')
  ) {
    return;
  }

  if (regex.test(event.target.id)) {
    // console.log(event.target);
    idFile = event.target.id;
    document.querySelector('.first').classList.add('animate');
    document.querySelector('.third').classList.add('animate');
    window.scrollTo(0, 0);
    ajaxPost(`${urlroot}single/ajaxPostGetInfoFile`, idFile, function (
      response
    ) {
      let data;
      let isParseValid = false;
      try {
        data = JSON.parse(response)[0];
        isParseValid = true;
      } catch (e) {
        console.log('here', e);
      }
      idFolder = `${data.medicalFolder_id}`;
      if (isParseValid) {
        document
          .getElementById(`${idFile}`)
          .childNodes[0].classList.remove('badge-danger');
        // document.getElementById(`${idFile}`).childNodes[0].classList.add('badge-success');
        // document.getElementById(`${idFile}`).childNodes[1].textContent = 'Déjà lue';
        document.getElementById('title-show').innerHTML = `${data.title}`;
        console.log(data);
        displayFile(htmlDecode(`${data.description}`));
      } else {
        return false;
      }
    });

    document.addEventListener('click', function (event) {
      if (event.target.id === 'show-update') {
        ajaxPost(
          `${urlroot}single/ajaxPostGetInfoFile`,
          idFile,
          function (response) {
            // console.log(response);
            let data;
            let isParseValid = false;
            try {
              data = JSON.parse(response)[0];
              isParseValid = true;
            } catch (e) {
              console.log('here', e);
            }
            if (isParseValid) {
              document
                .getElementById('title-edit')
                .setAttribute('value', `${data.title}`);
              document
                .getElementById('hidden-file-edit')
                .setAttribute('value', idFile);
              document
                .getElementById('hidden-folder-edit')
                .setAttribute('value', idFolder);
              tinymce
                .get('editEditor')
                .setContent(htmlDecode(`${data.description}`));

              document.querySelector('.four').classList.add('animate');
              document.querySelector('.third').classList.remove('animate');
            } else {
              return false;
            }
          },
          true
        );
      }

      document
        .getElementById('return-files-edit')
        .addEventListener('click', function () {
          document.querySelector('.four').classList.remove('animate');
          document.querySelector('.third').classList.add('animate');
        });
    });

    document.addEventListener('click', function (event) {
      if (event.target.id === 'show-delete') {
        idFileNumber = idFile.split('_');
        ArrayDelete.push(Number(idFileNumber[1]));
        ArrayDelete.push(Number(idFolder));
        loadingScreen = `<div class='loadingScreen' style=''><img src="/img/service.png" height="200px" width="auto"/><h1 class='loadingScreen__title'>Nous sommes en train de supprimer votre fiche, merci de patienter.</h1><div class='loadingScreen__loader'></div></div><style>
                .loadingScreen{
                    height: 100vh; 
                    width: 100vw; 
                    position: absolute; 
                    z-index: 999999; 
                    background: rgba(0,0,0,.7);
                    display: flex;
                    flex-flow: column nowrap;
                    justify-content: center;
                    align-items: center;
                }

                .loadingScreen__title{
                    color: #3498db;
                    padding: 1em;
                }

                .loadingScreen__loader{
border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}</style>

`;
        document
          .querySelector('body')
          .insertAdjacentHTML('afterBegin', loadingScreen);
        ajaxPost(
          `${urlroot}single/ajaxPostDelete`,
          ArrayDelete,
          function (response) {
            document.querySelector('.third').classList.remove('animate');
            document.querySelector('.first').classList.add('animate');
            document.location.reload();
            if (response) {
              document.querySelector('.third').classList.remove('animate');
              document.querySelector('.first').classList.add('animate');
              document.location.reload();
            } else {
              document.querySelector('.third').classList.remove('animate');
              document.querySelector('.first').classList.add('animate');
              document.location.reload();
              return false;
            }
          },
          true
        );
      }

      document
        .getElementById('return-files-edit')
        .addEventListener('click', function () {
          document.querySelector('.four').classList.remove('animate');
          document.querySelector('.third').classList.add('animate');
        });
    });
  }

  document
    .getElementById('return-files-show')
    .addEventListener('click', function () {
      // document.querySelector('.clearable').click();
      document.querySelector('.third').classList.remove('animate');
      document.querySelector('.first').classList.remove('animate');
    });
});

if (searchMedicalFile) {
  searchMedicalFile.addEventListener('input', function () {
    let dataFiles = [];

    if (
      resultMedicalFile.children[0].childNodes[0].childNodes[0].data ===
      'aucune fiche'
    ) {
      searchMedicalFolder.focus();
      return dataFiles;
    } else {
      for (
        let i = 0;
        i < resultMedicalFile.children[0].childNodes.length;
        i++
      ) {
        dataFiles.push(
          resultMedicalFile.children[0].childNodes[i].firstChild.data
        );
      }

      let matches = [];

      // if (this.value.length > 0) {
      //     matches = getMatches(this.value, dataFiles);
      //     if (matches.length > 0) {
      //         resultsCursor = 0;
      //         displayMatches(matches, resultMedicalFile.children[0]);
      //     }
      // }
    }
  });
}

if (resultMedicalFolder) {
  resultMedicalFolder.addEventListener('click', displayFolderAndNumber);
}

if (document.getElementById('editTitleFolder')) {
  document
    .getElementById('editTitleFolder')
    .addEventListener('click', function (event) {});
}

const buttonRenewPasswordElt = document.getElementById('formRenewPassword');

function renewPassword(e) {
  let oldPassword = document.getElementById('oldPassword').value;
  let newPassword = document.getElementById('newPassword').value;
  let formData = new FormData();
  formData.append('oldPassword', oldPassword);
  formData.append('newPassword', newPassword);
  ajaxPost(
    `${urlroot}users/ajaxPostRenewPassword`,
    formData,
    function (response) {
      window.location.reload();
    },
    false
  );
  e.preventDefault();
}
if (buttonRenewPasswordElt) {
  buttonRenewPasswordElt.addEventListener('submit', renewPassword);
}

function getInputValueAddFolder(event) {
  event.preventDefault();
  let nameFolderElt = document.getElementById('newMedicalFolder').value;
  if (nameFolderElt === '') {
    document.getElementById('newMedicalFolder').classList.add('is-invalid');
  } else {
    ajaxPost(
      `${urlroot}pages/ajaxPostAFolder`,
      nameFolderElt,
      function (response) {
        sessionStorage.setItem('newFolder', nameFolderElt);
        if (response && window.location.href == `${urlroot}pages/fiche`) {
          window.location.href = `${urlroot}pages/fiche`;
        } else if (response && window.location.href == `${urlroot}pages/exam`) {
          window.location.href = `${urlroot}pages/exam`;
        } else if (
          response &&
          window.location.href == `${urlroot}pages/annuaire`
        ) {
          window.location.href = `${urlroot}pages/annuaire`;
        } else if (
          response &&
          window.location.href == `${urlroot}pages/conseils`
        ) {
          window.location.href = `${urlroot}pages/conseils`;
        }
      },
      true
    );
  }
}
if (document.getElementById('addTitleFolder')) {
  document
    .getElementById('addTitleFolder')
    .addEventListener('click', function (e) {
      e.preventDefault();
      document.getElementById('editAndAddTemplate').innerHTML = '';
      document
        .getElementById('navbar-folder')
        .insertAdjacentHTML(
          'afterend',
          '<nav class="navbar">\n' +
            '<input class="form-control mr-sm-2 " type="text"  name="newMedicalFolder" id="newMedicalFolder" autocomplete="off">\n' +
            '<span class="invalid-feedback">Vous devez noter un nom de dossier !</span>' +
            '</nav>'
        );

      let add = `


<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248s248-111.033 248-248S392.967 8 256 8zm0 48c110.532 0 200 89.451 200 200c0 110.532-89.451 200-200 200c-110.532 0-200-89.451-200-200c0-110.532 89.451-200 200-200m140.204 130.267l-22.536-22.718c-4.667-4.705-12.265-4.736-16.97-.068L215.346 303.697l-59.792-60.277c-4.667-4.705-12.265-4.736-16.97-.069l-22.719 22.536c-4.705 4.667-4.736 12.265-.068 16.971l90.781 91.516c4.667 4.705 12.265 4.736 16.97.068l172.589-171.204c4.704-4.668 4.734-12.266.067-16.971z" fill="#5a5a5a"/></svg>
Ajouter 
            `;
      let chevron = `                
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
            `;

      document.getElementById('titleFolder').remove();
      document.getElementById('editTitleFolder').remove();
      document
        .getElementById('addTitleFolder')
        .insertAdjacentHTML(
          'afterend',
          `<a href="" class="folder__action" id = "folder__check" onclick="getInputValueAddFolder(event)" style="display:flex; justify-content:center; align-items: center;position: absolute; right: 2em; top: 1em"> ${add}</a>`
        );
      document
        .getElementById('addTitleFolder')
        .insertAdjacentHTML(
          'afterend',
          `<a href="" class="folder__action" id = "returnListFolder">${chevron}Retour</a>`
        );
      document.getElementById('addTitleFolder').remove();
      document.getElementById('deleteFolder').remove();

      document.getElementById('newMedicalFolder').focus();

      document
        .getElementById('returnListFolder')
        .addEventListener('click', function (e) {
          window.location.reload();
          e.preventDefault();
        });
    });
}

if (document.getElementById('deleteFolder')) {
  document
    .getElementById('deleteFolder')
    .addEventListener('click', function (e) {
      e.preventDefault();
      if (document.getElementById('searchMedicalFolder').value === '') {
        document
          .getElementById('searchMedicalFolder')
          .classList.add('is-invalid');
      } else {
        document
          .getElementById('deleteFolder')
          .setAttribute('data-toggle', 'modal');
        document
          .getElementById('deleteFolder')
          .setAttribute('data-target', '#exampleModal');
        document
          .getElementById('deleteAFolder')
          .addEventListener('click', function (e) {
            e.preventDefault();
            let temp = listFolderElt;
            listFolderElt.innerHtml = `Deleting folder ${
              listFolderElt.querySelector('.active').textContent.trim
            }, please wait`;
            let getIdFolder = temp.querySelector('.active').id;
            let idFolder = getIdFolder.split('-');
            idFolder = Number(idFolder[1]);
            ajaxPost(
              `${urlroot}pages/ajaxPostDeleteAFolder`,
              idFolder,
              function (response) {
                if (
                  response &&
                  window.location.href == `${urlroot}pages/fiche`
                ) {
                  window.location.href = `${urlroot}pages/fiche`;
                } else if (
                  response &&
                  window.location.href == `${urlroot}pages/exam`
                ) {
                  window.location.href = `${urlroot}pages/exam`;
                } else if (
                  response &&
                  window.location.href == `${urlroot}pages/annuaire`
                ) {
                  window.location.href = `${urlroot}pages/annuaire`;
                } else if (
                  response &&
                  window.location.href == `${urlroot}pages/conseils`
                ) {
                  window.location.href = `${urlroot}pages/conseils`;
                }
              },
              true
            );
          });
      }
    });
}

if (document.getElementById('editTitleFolder')) {
  document
    .getElementById('editTitleFolder')
    .addEventListener('click', function (e) {
      e.preventDefault();

      if (document.getElementById('searchMedicalFolder').value === '') {
        document
          .getElementById('searchMedicalFolder')
          .classList.add('is-invalid');
      } else {
        let inputValue = document.getElementById('searchMedicalFolder').value;
        document.getElementById('editAndAddTemplate').innerHTML = '';
        document
          .getElementById('navbar-folder')
          .insertAdjacentHTML(
            'afterend',
            '<nav class="navbar bg-white">\n' +
              '<input class="form-control mr-sm-2 " type="text"  name="newMedicalFolder" id="newMedicalFolder" autocomplete="off">\n' +
              '<span class="invalid-feedback">Vous devez noter un nom de dossier !</span>' +
              '</nav>'
          );
        document.getElementById('titleFolder').remove();
        document.getElementById('deleteFolder').remove();
        let save = `
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            `;
        let chevron = `                
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
            `;
        document
          .getElementById('addTitleFolder')
          .insertAdjacentHTML(
            'afterend',
            `<a href="" class="folder__action" id = "saveFolder">${save}</a>`
          );
        document
          .getElementById('addTitleFolder')
          .insertAdjacentHTML(
            'afterend',
            `<a href="" class="folder__action" id = "returnListFolder">${chevron}Retour</a>`
          );
        document.getElementById('addTitleFolder').remove();
        document.getElementById('editTitleFolder').remove();
        document.getElementById('newMedicalFolder').value = inputValue;

        document
          .getElementById('returnListFolder')
          .addEventListener('click', function (e) {
            window.location.reload();
            e.preventDefault();
          });
        document
          .getElementById('saveFolder')
          .addEventListener('click', function (e) {
            e.preventDefault();
            let getIdFolder = listFolderElt.querySelector('.active').id;
            let idFolder = getIdFolder.split('-');
            idFolder = Number(idFolder[1]);
            let updateValue = document.getElementById('newMedicalFolder').value;
            let tabData = [];
            tabData.push(idFolder, updateValue);
            ajaxPost(
              `${urlroot}pages/ajaxUpdateAFolder`,
              tabData,
              function (response) {
                if (
                  response &&
                  window.location.href == `${urlroot}pages/fiche`
                ) {
                  window.location.href = `${urlroot}pages/fiche`;
                } else if (
                  response &&
                  window.location.href == `${urlroot}pages/exam`
                ) {
                  window.location.href = `${urlroot}pages/exam`;
                } else if (
                  response &&
                  window.location.href == `${urlroot}pages/annuaire`
                ) {
                  window.location.href = `${urlroot}pages/annuaire`;
                }
              },
              true
            );
          });
      }
    });
}

// NAVBAR
document.getElementById('user__toggle').addEventListener('click', () => {
  document.getElementById('user__submenu').classList.toggle('hidden');
  document.getElementById('user__chevron').classList.toggle('rotate');
});
