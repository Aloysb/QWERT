(function ($) {
  if (window.location.ref === `${urlroot}`) {
    $('.main_menu').addClass('home_menu');
  }

  function load_unseen_post_notification(view = '') {
    $.ajax({
      url: `${urlroot}single/ajaxAddPostNotification`,
      method: 'POST',
      data: { view: view },
      dataType: 'json',
      success: function (data) {
        if (data.unseen_post_notification > 0) {
          $('.count').html(data.unseen_post_notification);
        } else {
          $('.count').html(0);
          $('.count').addClass('notify-bull-none');
        }
      },
    });
  }

  if (document.querySelector('#subMenu') != null) {
    load_unseen_post_notification();
  }

  function load_unseen_file_notification(view = '') {
    $.ajax({
      url: `${urlroot}single/ajaxAddFileNotification`,
      method: 'POST',
      data: { view: view },
      dataType: 'json',
      success: function (data) {
        if (data.unseen_file_notification > 0) {
          $('.count-file').html(data.unseen_file_notification);
        } else {
          $('.count-file').html(0);
          $('.count-file').addClass('notify-bull-none');
        }
      },
    });
  }
  if (document.querySelector('#subMenu') != null) {
    load_unseen_file_notification();
  }

  function load_unseen_checkup_notification(view = '') {
    $.ajax({
      url: `${urlroot}single/ajaxAddCheckupNotification`,
      method: 'POST',
      data: { view: view },
      dataType: 'json',
      success: function (data) {
        if (data.unseen_checkup_notification > 0) {
          $('.count-checkup').html(data.unseen_checkup_notification);
        } else {
          $('.count-checkup').html(0);
          $('.count-checkup').addClass('notify-bull-none');
        }
      },
    });
  }
  if (document.querySelector('#subMenu') != null) {
    load_unseen_checkup_notification();
  }

  let tabFolder = [];
  let folders = $('#folders').children();
  folders = Array.from(folders);
  folders.forEach(function (element) {
    let idFolder = element.id.split('-');
    tabFolder.push(Number(idFolder[1]));
  });
  function changeColorFolder(tabFolder) {
    $.ajax({
      url: `${urlroot}single/ajaxChangeColorFolderBadge`,
      method: 'POST',
      data: { view: tabFolder },
      dataType: 'json',
      success: function (data) {
        $.each(data, function (index, value) {
          if (value === true) {
            $(`#folder-${index} > span`)
              .removeClass('badge-primary')
              .addClass('badge-danger');
          } else {
            $(`#folder-${index} > span`)
              .removeClass('badge-danger')
              .addClass('badge-primary');
          }
        });
      },
    });
  }
  if (document.querySelector('#subMenu') != null) {
    changeColorFolder(tabFolder);
  }

  if (document.querySelector('#subMenu') != null) {
    setInterval(function () {
      changeColorFolder(tabFolder);
      load_unseen_post_notification();
      load_unseen_file_notification();
      load_unseen_checkup_notification();
    }, 5000);
  }

  window.setTimeout(function () {
    $('.alert')
      .fadeTo(1500, 0)
      .slideDown(1000, function () {
        $(this).remove();
      });
  }, 2000);
})(jQuery);

function changeClassWithQuery(e) {
  if (buttonConnexionElt) {
    if (e.matches) {
      buttonConnexionElt.classList.add('nav-link');
      buttonConnexionElt.classList.remove('btn_2', 'd-none', 'd-lg-block');
    } else {
      buttonConnexionElt.classList.add('btn_2', 'd-none', 'd-lg-block');
      buttonConnexionElt.classList.remove('nav-link');
    }
  }
}

let mql = window.matchMedia('(max-width: 768px)');
const buttonConnexionElt = document.getElementById('button-connexion');
if (mql) {
  mql.addListener(changeClassWithQuery);
}

$('#td').html('<?= $totalofday?>');
$('#tr').html('<?= $total_retrocession?>');

function virgule(text) {
  while (text.indexOf(',') > -1) {
    text = text.replace(',', '.');
  }
  return text;
}

function f() {
  let num1 = $('#totalofday').val();
  let num2 = $('#Retro').val();
  num1 = virgule(num1);
  $('#TRetro').val((num1 * Number(num2 / 100)).toFixed(2));
}
function f1() {
  let num1 = $('#totalofday1').val();
  let num2 = $('#Retro1').val();
  num1 = virgule(num1);
  $('#TRetro1').val((num1 * Number(num2 / 100)).toFixed(2));
}
$('#add').on('click', function (e) {
  $('#inputform').toggleClass('hideclass');
  $('#subbtn').toggleClass('hideclass');

  let plus = $(this).find('i[id=plus]');
  if ($(this).find('i[id=plus]').hasClass('fa-plus')) {
    $(plus).removeClass('fa-plus');
    $(plus).addClass('fa-times');
  } else {
    $(plus).addClass('fa-plus');
    $(plus).removeClass('fa-times');
  }
});

function updater(object) {
  row = object.parentNode.parentNode.parentNode.parentNode;
  let dateFormate = $(row).find('td[class="rdate"]').html();
  dateFormate = dateFormate.split('-');
  dateFormate =
    '20' + dateFormate.reverse().join('-').replace(/\s/g, '').toString();
  document.querySelector('#rudate').value = dateFormate;
  document.querySelector('#rudr').value = row.querySelector(
    'td[class="dr"]'
  ).innerText;
  document.querySelector('#totalofday1').value = row.querySelector(
    'td[class="totd"]'
  ).innerText;
  document.querySelector('#TRetro1').value = row.querySelector(
    'td[class="tret"]'
  ).innerText;
  document.querySelector('#Retro1').value = row
    .querySelector('td[class="ret"]')
    .innerText.replace('%', '');
  document.querySelector('#ucmt').value = row.querySelector(
    'td[class="cmt1"]'
  ).innerText;
  document.querySelector('#urid').value = row.querySelector(
    'td[class="dr"]'
  ).innerText;
  document.querySelector('#id').value = row.querySelector(
    'td[class="rowId"]'
  ).innerText;
}

if (
  window.location.href === `${urlroot}pages/comptabilite` ||
  window.location.href === `${urlroot}users/selectedMonth`
) {
  const totd = document.getElementsByClassName('totd');
  const tret = document.getElementsByClassName('tret');

  let begintotd = 0;
  for (let item of totd) {
    begintotd = Number(item.textContent) + begintotd;
  }
  document.getElementById('totalDay').textContent = begintotd.toFixed(2);

  let begintret = 0;
  for (let item of tret) {
    begintret = Number(item.textContent) + begintret;
  }
  document.getElementById('totalRetrocession').textContent = begintret.toFixed(
    2
  );
}

$(function () {
  $uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
      width: 200,
      height: 200,
      type: 'circle',
    },
    boundary: {
      width: 300,
      height: 300,
    },
    url: '/img/service.png',
  });

  $('#upload').on('change', function (e) {
    let reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop
        .croppie('bind', {
          url: e.target.result,
        })
        .then(function () {});
    };
    reader.readAsDataURL(this.files[0]);
  });

  $('.upload-result').on('click', function (ev) {
    $uploadCrop
      .croppie('result', {
        type: 'canvas',
        size: 'viewport',
      })
      .then(function (resp) {
        $.ajax({
          url: `${urlroot}users/ajaxUpdateAvatar`,
          type: 'POST',
          data: { image: resp },
          success: function (data) {
            html = '<img src="' + resp + '" />';
            $('#upload-demo-i').html(html);
          },
        });
      });
    location.reload();
  });
});

const closeUpdateElt = document.getElementById('closeUpdate');
if (closeUpdateElt) {
  closeUpdateElt.addEventListener('click', function (e) {
    window.location.reload();
    e.preventDefault();
  });
}

const stripe = Stripe(
  'pk_test_51HCO0ZGh4186fMiSpGYFh0ynjLSvXgHU08OHHRZ4Wg4arxgry3zP3Ft7L7kvoUbIKu4GnpSRtvMLD6i31OeBH1pv00IR0bfBM4'
);
const basicPlanElt = document.getElementById('basic-plan-btn');

let dataSession;

if (window.location.href === `${urlroot}pages/confirmation-abonnement`) {
  ajaxGet(`${urlroot}charges/sessionStripe`, function (response) {
    dataSession = response;
  });

  if (basicPlanElt) {
    basicPlanElt.addEventListener('click', function () {
      stripe
        .redirectToCheckout({
          sessionId: JSON.parse(dataSession).id,
        })
        .then(function (result) {
          console.log(result.error.message);
        });
    });
  }
}

$(document).on('focusin', function (e) {
  if (
    $(e.target).closest(
      '.tox-tinymce-aux, .moxman-window, .tam-assetmanager-root'
    ).length
  ) {
    e.stopImmediatePropagation();
  }
});

tinymce.init({
  selector: 'textarea#addEditor',
  content_css: `${urlroot}css/main.css`,
  min_height: 900,
  menubar: false,
  branding: false,
  plugins: 'image advlist lists',
  toolbar:
    'undo redo | formatselect | bold italic underline | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | removeformat | image | myCustomToolbarButton',
  relative_urls: false,
  image_dimensions: false,
  remove_script_host: false,
  document_base_url: `${urlroot}`,
  setup: (editor) => {
    editor.ui.registry.addButton('myCustomToolbarButton', {
      text: 'VALIDER',

      onAction: () => {
        if (
          window.location.href === `${urlroot}pages/fiche` ||
          window.location.href === `${urlroot}pages/exam` ||
          window.location.href === `${urlroot}pages/annuaire` ||
          window.location.href === `${urlroot}pages/conseils`
        ) {
          let ArrayForm = [];
          let title = document.getElementById('myTitle').value;
          let content = tinymce.activeEditor.getContent();
          ArrayForm.push(title);
          ArrayForm.push(content);
          let idFolder;
          let getIdFolder;

          for (
            let i = 0;
            i < document.getElementById('folders').children.length;
            i++
          ) {
            if (
              document
                .getElementById('folders')
                .children[i].classList.contains('active')
            ) {
              getIdFolder = document.getElementById('folders').children[i].id;
              idFolder = getIdFolder.split('-');
              idFolder = Number(idFolder[1]);
              ArrayForm.push(idFolder);
            }
          }

          loadingScreen = `<div class='loadingScreen' style=''><img src="/img/service.png" height="200px" width="auto"/><h1 class='loadingScreen__title'>Nous sommes en train d'enregistrer votre fiche, merci de patienter.</h1><div class='loadingScreen__loader'></div></div><style>
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
            `${urlroot}single/ajaxAddFileByFolderId`,
            ArrayForm,
            function (response) {
              if (response) {
                // console.log(response);
                document.location.reload();
                document.querySelector('.second').classList.remove('animate');
                document.querySelector('.first').classList.remove('animate');
                tinymce.get('addEditor').setContent('');
                document.querySelector('.second').querySelector('input').value =
                  '';
                document.querySelector('.loadingScreen').hidden = true;
                document.querySelector('.folder.active').click();
              } else if (response === false) {
                return false;
              }
            },
            true
          );
        } else {
          document.getElementsByClassName('editorForm')[0].submit();
        }
      },
    });
  },

  images_upload_url: `${urlroot}single/postAcceptor`,
  images_upload_handler: function (blobInfo, success, failure) {
    var xhr, formData;

    xhr = new XMLHttpRequest();
    xhr.withCredentials = false;
    xhr.open('POST', `${urlroot}single/postAcceptor`);

    xhr.onload = function () {
      var json;

      if (xhr.status != 200) {
        failure('HTTP Error: ' + xhr.status);
        return;
      }

      json = JSON.parse(xhr.responseText);

      if (!json || typeof json.location != 'string') {
        failure(
          "Erreur: vous avez dépassé les 1MO ou  le fichier chargé n'est pas un jpeg,jpg, png ou erreur serveur"
        );
        return;
      }

      success(json.location);
    };

    formData = new FormData();
    formData.append('file', blobInfo.blob(), blobInfo.filename());

    xhr.send(formData);
  },
});

tinymce.init({
  selector: 'textarea#editEditor',
  content_css: `${urlroot}css/main.css`,
  min_height: 900,
  menubar: false,
  branding: false,
  plugins: 'image advlist lists',
  toolbar:
    'undo redo | formatselect | bold italic underline | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | removeformat | image | myCustomToolbarButton',
  relative_urls: false,
  image_dimensions: false,
  remove_script_host: false,
  document_base_url: `${urlroot}`,
  setup: (editor) => {
    editor.ui.registry.addButton('myCustomToolbarButton', {
      text: 'VALIDER',

      onAction: () => {
        let ArrayForm = [];
        let title = document.getElementById('title-edit').value;
        let getIdFile = document.getElementById('hidden-file-edit').value;
        let getIdFolder = document.getElementById('hidden-folder-edit').value;
        let content = tinymce.get('editEditor').getContent();

        ArrayForm.push(title);
        ArrayForm.push(content);
        let idFile = getIdFile.split('_');
        idFile = Number(idFile[1]);
        let idFolder = Number(getIdFolder);
        ArrayForm.push(idFile);
        ArrayForm.push(idFolder);

        loadingScreen = `<div class='loadingScreen' style=''><img src="/img/service.png" height="200px" width="auto"/><h1 class='loadingScreen__title'>Nous sommes en train d'enregistrer votre fiche, merci de patienter.</h1><div class='loadingScreen__loader'></div></div><style>
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
          `${urlroot}single/ajaxEditFileByFolderId`,
          ArrayForm,
          function (response) {
            if (response) {
              // console.log(response);
              document.querySelector('.four').classList.remove('animate');
              document.querySelector('.third').classList.add('animate');
              document.getElementById('description-show').innerHTML = content;
              document.getElementById('title-show').innerHTML = title;
              document.querySelector('.loadingScreen').hidden = true;
              document.querySelector('.folder.active').click();
            } else if (response === false) {
              document.location.reload();
              document.querySelector('.four').classList.remove('animate');
              document.querySelector('.first').classList.remove('animate');
            }
          },
          true
        );
      },
    });
  },

  images_upload_url: `${urlroot}single/postAcceptor`,
  images_upload_handler: function (blobInfo, success, failure) {
    var xhr, formData;

    xhr = new XMLHttpRequest();
    xhr.withCredentials = false;
    xhr.open('POST', `${urlroot}single/postAcceptor`);

    xhr.onload = function () {
      var json;

      if (xhr.status != 200) {
        failure('HTTP Error: ' + xhr.status);
        return;
      }

      json = JSON.parse(xhr.responseText);

      if (!json || typeof json.location != 'string') {
        failure(
          "Erreur: vous avez dépassé les 1MO ou  le fichier chargé n'est pas un jpeg,jpg, png ou erreur serveur"
        );
        return;
      }

      success(json.location);
    };

    formData = new FormData();
    formData.append('file', blobInfo.blob(), blobInfo.filename());

    xhr.send(formData);
  },
});
const deleteSingleElt = document.getElementsByClassName('docto-single-delete');

if (deleteSingleElt[0]) {
  deleteSingleElt[0].addEventListener('click', function () {
    let imageTab = [];
    const editorContentElt = document.getElementsByClassName(
      'docto-editor-content'
    );

    let allSrcOfEditor = editorContentElt[0].querySelectorAll('[src]');
    for (let i = 0; i < allSrcOfEditor.length; i++) {
      let item = allSrcOfEditor[i];
      if (item.getAttribute('src') !== null) {
        let srcValue = item.getAttribute('src');
        let arraySrcSplit = srcValue.split('/');
        let imageName = arraySrcSplit[arraySrcSplit.length - 1];
        imageTab.push(imageName);
      }
    }

    ajaxPost(
      `${urlroot}single/ajaxUnlinkFiles`,
      imageTab,
      function () {},
      false
    );
  });
}

if (typeof tinymce !== 'undefined') {
  tinymce.init({
    selector: '#add-article-form',
    content_css: `${urlroot}css/main.css`,
    menubar: false,
    branding: false,
    min_height: 900,
    plugins: 'image advlist lists',
    toolbar:
      'undo redo | formatselect | bold italic underline | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | removeformat | image | myCustomToolbarButton',
    image_dimensions: false,
    relative_urls: false,
    remove_script_host: false,
    document_base_url: `${urlroot}`,
    setup: (editor) => {
      editor.ui.registry.addButton('myCustomToolbarButton', {
        text: 'VALIDER',
        icon: 'sharpen',
        onAction: () => {
          let ArrayForm = [];
          let title = document.getElementById('myPostTitle').value;
          let content = tinymce.activeEditor.getContent();
          ArrayForm.push(title);
          ArrayForm.push(content);

          loadingScreen = `<div class='loadingScreen' style=''><img src="/img/service.png" height="200px" width="auto"/><h1 class='loadingScreen__title'>Nous sommes en train d'enregistrer votre article, merci de patienter.</h1><div class='loadingScreen__loader'></div></div><style>
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
            `${urlroot}single/ajaxAddPostByAdmin`,
            ArrayForm,
            function (response) {
              if (response) {
                // console.log(response);
                window.location.href = `${urlroot}pages/articles`;
              } else if (response === false) {
                return false;
              }
            },
            true
          );
        },
      });
    },

    images_upload_url: `${urlroot}single/addPostAcceptor`,
    images_upload_handler: function (blobInfo, success, failure) {
      var xhr, formData;

      xhr = new XMLHttpRequest();
      xhr.withCredentials = false;
      xhr.open('POST', `${urlroot}single/addPostAcceptor`);

      xhr.onload = function () {
        var json;

        if (xhr.status != 200) {
          failure('HTTP Error: ' + xhr.status);
          return;
        }

        json = JSON.parse(xhr.responseText);

        if (!json || typeof json.location != 'string') {
          failure(
            "Erreur: vous avez dépassé les 1MO ou  le fichier chargé n'est pas un jpeg,jpg, png ou erreur serveur"
          );
          return;
        }

        success(json.location);
      };

      formData = new FormData();
      formData.append('file', blobInfo.blob(), blobInfo.filename());

      xhr.send(formData);
    },
  });
}

if (document.getElementById('select_all')) {
  let select_all = document.getElementById('select_all');

  if (select_all !== null) {
    select_all.addEventListener('click', function () {
      let state = this.checked;
      let select = document.querySelectorAll('.select');
      for (let i = 0; i < select.length; i++) {
        select[i].checked = state;
      }
    });
  }
}

$(document).ready(function () {
  let table = $('#datatable').DataTable({
    columnDefs: [
      { targets: 0, orderable: false },
      { targets: 1, orderable: false },
    ],
    lengthMenu: [
      [10, 20, 30, -1],
      [10, 20, 30, 'All'],
    ],
    order: [[1, 'desc']],
    language: {
      infoFiltered: '(filtré sur _MAX_ entrées au totale)',
      info: 'Affichage _START_ à _END_ sur _TOTAL_ entrées',
      infoEmpty: 'Affichage 0 à 0 sur 0 entrée',
      paginate: {
        first: 'Premier',
        last: 'Dernier',
        next: 'Suivant',
        previous: 'Précédent',
      },
      zeroRecords: 'Aucun enregistrement correspondant trouvé',
    },
  });

  $('.post-search input').on('keyup change clear', function () {
    if (table.search() !== this.value) {
      table.search(this.value).draw();
    }
  });

  $('#post-delete').click(function () {
    if (confirm('Êtes-vous sûr de vouloir supprimer ?')) {
      let idPosts = [];
      let test = $('tr').find('.select:checkbox:checked');
      test.each(function (i) {
        idPosts[i] = $(this).val();
      });
      if (idPosts.length === 0) {
        alert("S'il vous plait sélectionnez au moins une checkbox");
      } else {
        $.ajax({
          url: `${urlroot}single/ajaxDeleteMultiPost`,
          method: 'POST',
          data: { id: idPosts },
          success: function () {
            window.location.href = `/pages/articles`;
          },
        });
      }
    } else {
      return false;
    }
  });
});

if (typeof tinymce !== 'undefined') {
  tinymce.init({
    selector: '#update-article-form',
    content_css: `${urlroot}css/main.css`,
    menubar: false,
    branding: false,
    min_height: 900,
    plugins: 'image advlist lists',
    toolbar:
      'undo redo | formatselect | bold italic underline | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | removeformat | image | myCustomToolbarButton',
    image_dimensions: false,
    relative_urls: false,
    remove_script_host: false,
    document_base_url: `${urlroot}`,
    setup: (editor) => {
      editor.ui.registry.addButton('myCustomToolbarButton', {
        text: 'VALIDER',
        icon: 'sharpen',
        onAction: () => {
          let ArrayForm = [];
          let title = document.getElementById('myPostTitle').value;
          let idPost = document.getElementById('postId').value;
          let content = tinymce.activeEditor.getContent();

          ArrayForm.push(idPost);
          ArrayForm.push(title);
          ArrayForm.push(content);

          loadingScreen = `<div class='loadingScreen' style=''><img src="/img/service.png" height="200px" width="auto"/><h1 class='loadingScreen__title'>Nous sommes en train d'enregistrer votre article, merci de patienter.</h1><div class='loadingScreen__loader'></div></div><style>
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
            `${urlroot}single/ajaxUpdatePostByAdmin`,
            ArrayForm,
            function (response) {
              if (response) {
                window.location.href = `${urlroot}pages/article/${idPost}`;
              } else if (response === false) {
                return false;
              }
            },
            true
          );
        },
      });
    },

    images_upload_url: `${urlroot}single/addPostAcceptor`,
    images_upload_handler: function (blobInfo, success, failure) {
      let xhr, formData;

      xhr = new XMLHttpRequest();
      xhr.withCredentials = false;
      xhr.open('POST', `${urlroot}single/addPostAcceptor`);

      xhr.onload = function () {
        let json;

        if (xhr.status != 200) {
          failure('HTTP Error: ' + xhr.status);
          return;
        }

        json = JSON.parse(xhr.responseText);

        if (!json || typeof json.location != 'string') {
          failure(
            "Erreur: vous avez dépassé les 1MO ou  le fichier chargé n'est pas un jpeg,jpg, png ou erreur serveur"
          );
          return;
        }

        success(json.location);
      };

      formData = new FormData();
      formData.append('file', blobInfo.blob(), blobInfo.filename());

      xhr.send(formData);
    },
  });
}

function deletePost(id) {
  loadingScreen = `<div class='loadingScreen' style=''><img src="/img/service.png" height="200px" width="auto"/><h1 class='loadingScreen__title'>Nous sommes en train de supprimer votre article, merci de patienter.</h1><div class='loadingScreen__loader'></div></div><style>
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
    `${urlroot}single/ajaxDeletePost`,
    id,
    function (response) {
      if (response) {
        // console.log(response);
        window.location.href = `${urlroot}pages/articles`;
      } else {
        return false;
      }
    },
    true
  );
}

$(document).ready(function () {
  let table = $('#datatable-list-user').DataTable({
    columnDefs: [
      { targets: 0, orderable: false },
      { targets: 1, orderable: false },
    ],
    lengthMenu: [
      [10, 20, 30, -1],
      [10, 20, 30, 'All'],
    ],
    order: [[1, 'desc']],
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'csvHtml5',
        className: 'btn_2',
        text: 'Télécharger csv',
        filename: 'liste-des-inscrits-doctofiche',
      },
    ],
    language: {
      infoFiltered: '(filtré sur _MAX_ entrées au totale)',
      info: 'Affichage _START_ à _END_ sur _TOTAL_ entrées',
      infoEmpty: 'Affichage 0 à 0 sur 0 entrée',
      paginate: {
        first: 'Premier',
        last: 'Dernier',
        next: 'Suivant',
        previous: 'Précédent',
      },
      zeroRecords: 'Aucun enregistrement correspondant trouvé',
    },
  });

  $('.post-search input').on('keyup change clear', function () {
    if (table.search() !== this.value) {
      table.search(this.value).draw();
    }
  });
});
