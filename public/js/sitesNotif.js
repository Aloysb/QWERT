function removeNotifSites() {
  $('#sites-modal').on('hidden.bs.modal', function () {
    $.ajax({
      url: `${urlroot}admin/removeNotifSites`,
      method: 'POST',
      success: function (data) {},
    });
    if (document.querySelector('.sites-notes__link').querySelector('.notif')) {
      document
        .querySelector('.sites-notes__link')
        .querySelector('.notif').hidden = true;
    }
    if (document.getElementById('sites-modal').querySelector('.notif')) {
      let sitesWithNotifBadge = [
        ...document.getElementById('sites-modal').querySelectorAll('.notif'),
      ];

      sitesWithNotifBadge.map((site) => (site.hidden = true));
    }
  });
}
