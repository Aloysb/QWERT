function slugify(str) {
  var map = {
    '-': ' ',
    '-': '_',
    a: 'á|à|ã|â|À|Á|Ã|Â',
    e: 'é|è|ê|É|È|Ê',
    i: 'í|ì|î|Í|Ì|Î',
    o: 'ó|ò|ô|õ|Ó|Ò|Ô|Õ',
    u: 'ú|ù|û|ü|Ú|Ù|Û|Ü',
    c: 'ç|Ç',
    n: 'ñ|Ñ',
  };

  str = str.toLowerCase();

  for (var pattern in map) {
    str = str.replace(new RegExp(map[pattern], 'g'), pattern);
  }

  return str;
}
//Add fiches after result research.
const displaySearchResults = (list) => {
  list.forEach((file, index) => {
    const newNameFolderElt = document.getElementById('newNameFolder');
    newNameFolderElt.innerHTML = `<span class="nameFolderBase">Fiches \/</span><span class='nameFolderTitle'> Résultats de la recherche</span>`;
    let buttonFileElt = document.createElement('a');
    buttonFileElt.className = 'list-group-item btn btn-light text-primary';
    buttonFileElt.id = `file_${file.id}`;
    buttonFileElt.textContent = ` ${file.title}`;
    if (file.status == 0) {
      buttonFileElt.insertAdjacentHTML(
        'afterBegin',
        '<img src = "/assets/icon_proto/Icon - Notes.svg" /><span class="badge badge-pill badge-danger">Non lue</span>'
      );
    } else {
      buttonFileElt.insertAdjacentHTML(
        'afterBegin',
        '<img src = "/assets/icon_proto/Icon - Notes.svg" /><span class="badge badge-pill badge-success">Déjà lue</span>'
      );
    }
    listFilesElt.appendChild(buttonFileElt);
  });
};

//Add hidden class to folder not matching research or files id..
const displaySearchResultsFolder = (value, filesId) => {
  let children = document.getElementById('folders').querySelectorAll('a');
  children.forEach((el) => {
    if (
      !slugify(el.innerText).includes(value) &&
      !filesId.includes(el.id.match(/\d+/)[0])
    )
      el.classList.add('hidden');
  });
};

// Remove hidden to all folders.
const displayAllResultsFolder = () => {
  let children = document.getElementById('folders').querySelectorAll('a');
  children.forEach((el) => el.classList.remove('hidden'));
};

const sortFoldersFirst = (searchValue) => {
  let children = document
    .getElementById('folders')
    .querySelectorAll('a:not(.hidden)');
  var re = new RegExp(searchValue, 'i');
  children.forEach((el) => {
    if (el.innerText.match(re)) {
      el.parentNode.prepend(el);
    }
  });
};

const researchFirstInput = (e = 13) => {
  //Clear the active folder bar.
  if (document.querySelector('.list-group').querySelector('.active')) {
    document
      .querySelector('.list-group')
      .querySelector('.active')
      .classList.remove('active');
  }

  let searchValue = slugify(search.value);
  displayAllResultsFolder();
  let filesList = document.getElementById('files');
  filesList.innerHTML = '';
  const newNameFolderElt = document.getElementById('newNameFolder');
  newNameFolderElt.innerHTML = `<span>Fiches</span><span class='nameFolderTitle'></span>`;
  let filteredFiles = files.filter(
    (file) =>
      slugify(file.description).includes(searchValue) ||
      slugify(file.title).includes(searchValue)
  );
  let filteredFilesId = filteredFiles.map((file) => file.medicalFolder_id);
  if (search.value != '') sessionStorage.setItem('searchValue', searchValue);
  if (search.value != '') displaySearchResults(filteredFiles);
  //If no results, display messages.
  if (filteredFiles.length == 0) {
  }
  if (search.value != '') {
    //Put the folders on top of the list
    displaySearchResultsFolder(searchValue, filteredFilesId);
    sortFoldersFirst(searchValue);
  }

  // }
};

const listOfFiles = () => {
  let filesList = document.getElementById('files').querySelectorAll('a');
  let fileID = [...filesList].map((file) => file.id.replace('file_', ''));
  return files.filter((file) => fileID.includes(file.id));
};

let search = document.getElementById('searchMedicalFolder');

//Search event
search.addEventListener('keyup', (e) => researchFirstInput(e));

//Search articles list
const searchArticles = document.getElementById('searchMedicalFile');

// If no search in the first input it still needs to sort the list of files.

searchArticles.addEventListener('keyup', (e) => {
  //Clear the active folder bar.
  if (document.querySelector('.list-group').querySelector('.active')) {
    document
      .querySelector('.list-group')
      .querySelector('.active')
      .classList.remove('active');
  }

  let searchValue = slugify(searchArticles.value);
  let filesList = [...document.getElementById('files').querySelectorAll('a')];
  filesList.map((el) => el.classList.add('hidden'));
  let searchValueFirst = slugify(search.value);
  let filteredFiles = listOfFiles();
  let filteredArticles = filteredFiles
    .filter(
      (file) =>
        slugify(file.description).includes(searchValue) ||
        slugify(file.title).includes(searchValue)
    )
    .map((file) => `file_${file.id}`);

  filesList.map((el) => {
    if (filteredArticles.includes(el.id)) {
      el.classList.remove('hidden');
    }
  });
  if (searchArticles.value != '')
    sessionStorage.setItem('searchValue', searchValue);
});

// Get the list of files.
